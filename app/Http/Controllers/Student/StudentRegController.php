<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentRegistration;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PDF;


class StudentRegController extends Controller
{
    public function registrationIndex(): View
    {

        $data['year_id'] = StudentYear::orderBy('id', 'desc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'desc')->first()->id;
        // dd($data['class_id']);
        $data['assignStudents'] = AssignStudent::all();;

        return view('admin.students.students_list', $data);
    }

    public function registrationCreate(): View
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['shifts'] = StudentShift::all();
        $data['groups'] = StudentGroup::all();
        return view('admin.students.create_registration', $data);
    }

    public function update($id): View
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['shifts'] = StudentShift::all();
        $data['groups'] = StudentGroup::all();
        $data['editData'] = AssignStudent::with(['student', 'discount'])
            ->where('student_id', $id)
            ->first();

        return view('admin.students.update_registration', $data);
    }

    public function registrationStore(Request $request): RedirectResponse
    {
        $lastId = User::max('id');
        $yearId = $request->input('year');
        $year = StudentYear::findOrFail($yearId)->name;
        $groupId = $request->input('group');
        $group = StudentGroup::findOrFail($groupId)->name;

        $classId = $request->input('class');
        $class = StudentClass::findOrFail($classId)->name;


        $programAbbreviation = '';

        if ($group == 'Commerce') {
            $programAbbreviation = 'COM';
        } else if ($group == 'Science') {
            $programAbbreviation = 'SCI';
        } else if ($group == 'Arts') {
            $programAbbreviation = 'ART';
        }
        $studentId = sprintf('%s-%s-%04d', $year, $programAbbreviation, $lastId + 1);

        $yearName = DB::table('student_years')->where('id', $yearId)->value('name');

        // count the number of students in the same class, group, and year
        $studentCount = DB::table('assign_students')
            ->join('users', 'assign_students.student_id', '=', 'users.id')
            ->join('student_classes', 'assign_students.class_id', '=', 'student_classes.id')
            ->join('student_groups', 'assign_students.group_id', '=', 'student_groups.id')
            ->join('student_years', 'assign_students.year_id', '=', 'student_years.id')
            ->where('student_classes.id', $classId)
            ->where('student_groups.id', $groupId)
            ->where('student_years.id', $yearId)
            ->count();

        // generate the roll number based on the student count
        $roll = $studentCount + 1;

        // generate the roll number with year, class, and group prefixes
        $rollNumber = sprintf('%s%d%d%03d', $yearName, $classId, $groupId, $roll);


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'religion' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'year' => 'required|exists:student_years,id',
            'class' => 'required|exists:student_classes,id',
            'group' => 'required|exists:student_groups,id',
            'shift' => 'required|exists:student_shifts,id',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }
        $code = Str::random(8, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()');

        $student = new User();
        $this->extracted($request, $student, $studentId, $code, $rollNumber);

        $assign_student = new AssignStudent();
        $assign_student->student_id = $student->id;
        $assign_student->year_id = $request->year;
        $assign_student->class_id = $request->class;
        $assign_student->group_id = $request->group;
        $assign_student->shift_id = $request->shift;
        $assign_student->save();

        $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%registration%')->pluck('id')->first();

        if ($request->discount) {
            if ($fee_category_id) {
                $discount_student = new  DiscountStudent();
                $discount_student->assign_student_id = $assign_student->id;
                $discount_student->discount = $request->discount;
                $discount_student->fee_category_id = $fee_category_id;
                $discount_student->save();
            } else {
                return redirect()->back()->with('error', 'You do not have an any registration category');
            }
        }

        return redirect()->back()->with('success', 'Student registration success');
    }


    public function updateStore(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'religion' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        $student = User::findOrFail($id);
        $student->name = $request->name;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->religion = $request->religion;
        $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));

        if ($request->hasFile('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads/avatar', $imageName);

            // unlink old image if exists
            if (Storage::disk('public')->exists('/uploads/avatar/' . $student->profile_photo_path)) {
                Storage::disk('public')->delete('/uploads/avatar/' . $student->profile_photo_path);
            }

            // Save the file name to the database
            $student->profile_photo_path = $imageName;
        }

        $student->save();
        return redirect()->back()->with('success', 'Student update success');
    }


    public function details($id)
    {
        $data['details'] = AssignStudent::with(['student', 'discount'])
            ->where('student_id', $id)
            ->first();
        $pdf = PDF::loadView('admin.students.student_details_pdf', $data);
        return $pdf->stream('document.pdf');
    }

    public function deleteStudent($id): RedirectResponse
    {
        // Get the user instance by ID
        $user = User::findOrFail($id);

        // Get the assigned student record (if exist) for this user
        $assignedStudent = AssignStudent::where('student_id', $user->id)->first();

        if ($assignedStudent) {
            // Get the discount record (if exist) for this assigned student
            $discount = DiscountStudent::where('assign_student_id', $assignedStudent->id)->first();

            if ($discount) {
                // Delete the discount record
                $discount->delete();
            }

            // Delete the assigned student record
            $assignedStudent->delete();
        }

        // Delete the user
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }


    /**
     * @param Request $request
     * @param $student
     * @param string $studentId
     * @param string $code
     * @param string $newRollNumber
     * @return void
     */
    public function extracted(Request $request, $student, string $studentId, string $code, string $newRollNumber): void
    {
        $student->name = $request->name;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->religion = $request->religion;
        $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $student->id_no = $studentId;
        $student->usertype = 'Student';
        $student->password = bcrypt($code);
        $student->code = $code;
        $student->roll = $newRollNumber;

        if ($request->hasFile('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads/avatar', $imageName);

            // unlink old image if exists
            if (Storage::disk('public')->exists('/uploads/avatar/' . $student->profile_photo_path)) {
                Storage::disk('public')->delete('/uploads/avatar/' . $student->profile_photo_path);
            }

            // Save the file name to the database
            $student->profile_photo_path = $imageName;
        }
        $student->save();
    }
}


