<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeRegController extends Controller
{
    public function EmployeeView(): View
    {

        $data['allData'] = User::where('usertype', 'Employee')->get();
        return view('admin.employees.all_employees_list', $data);
    }

    public function EmployeeCreateView(): View
    {
        $data['designations'] = Designation::all();
        return view('admin.employees.create_employee', $data);
    }

    public function EmployeeStore(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'religion' => 'required|string',
            'date_of_birth' => 'required|date',
            'designation_id' => 'required|numeric',
            'salary' => 'required|string',
            'join_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        DB::transaction(function () use ($request) {
            $checkYear = date('Ym', strtotime($request->join_date));
            //dd($checkYear);
            $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first();

            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            } else {
                $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }

            } // end else=
            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));

            if ($request->hasFile('profile_photo_path')) {
                $image = $request->file('profile_photo_path');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/uploads/employee', $imageName);

                // Save the file name to the database
                $user->profile_photo_path = $imageName;
            }

            $user->save();
            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();

        });
        return redirect()->back()->with('success', 'Employee registration successfully');

    }

    public function EditEmployee($id): View
    {
        $data['editData'] = User::find($id);
        $data['designations'] = Designation::all();
        return view('admin.employees.edit_employee', $data);
    }

    public function EmployeeUpdate(Request $request, $id): ?RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'religion' => 'required|string',
            'date_of_birth' => 'required|date',
            'designation_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->designation_id = $request->designation_id;
        $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));

        if ($request->hasFile('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads/employee', $imageName);

            // unlink old image if exists
            if (Storage::disk('public')->exists('/uploads/employee/' . $user->profile_photo_path)) {
                Storage::disk('public')->delete('/uploads/employee/' . $user->profile_photo_path);
            }

            // Save the file name to the database
            $user->profile_photo_path = $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Employee update successfully');
    }

    public function EmployeeDetails($id): Response
    {
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('admin.employees.employee_details_pdf', $data);
        return $pdf->stream('document.pdf');
    }

    public function EmployeeDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $employee_log = EmployeeSalaryLog::where('employee_id', $user->id);
            $employee_log->delete();
            $user->delete();
            return redirect()->back()->with('success', 'Employee deleted successfully');
        }

    }
}

