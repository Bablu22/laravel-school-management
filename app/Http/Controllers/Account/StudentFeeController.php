<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\ExamFee;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\MonthlyFee;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentFeeController extends Controller
{
    public function StudentFeeView(): View
    {
        $data['allData'] = AccountStudentFee::all();
        return view('admin.account.student.student_fee_view', $data);
    }


    public function StudentRegFeeAdd(): View
    {
        $allStudent = AssignStudent::with('discount')->get();
        $registrationFees = [];

        foreach ($allStudent as $student) {
            $fee_category_id = FeeCategory::where('name', 'LIKE', '%registration%')->value('id');
            $registration_fee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                ->where('class_id', $student['class']['id'])
                ->first();

            $original_fee = $registration_fee ? $registration_fee->amount : 0;
            $discount = isset($student['discount']) ? $student['discount']['discount'] : 0;
            $discounted_fee = $discount / 100 * $original_fee;
            $registrationFee = number_format((float)$original_fee - (float)$discounted_fee, 2, '.', '');
            $registrationFees[] = [
                'name' => $student['student']['name'],
                'id_no' => $student['student']['id_no'],
                'roll' => $student['student']['roll'],
                'year' => $student['year']['name'],
                'class' => $student['class']['name'],
                'student_id' => $student->student_id,
                'class_id' => $student->class_id,
                'year_id' => $student->year_id,
                'registrationFee' => $registrationFee,
                'discount' => $discount,
                'original_fee' => $original_fee,
                'fee_category_id' => $fee_category_id,
                'fee_category_name' => $registration_fee['fee_category']['name']
            ];
        }
        $data ['registrationFees'] = $registrationFees;
        return view('admin.account.student.student_fee_add', $data);

    }

    public function StudentMonthlyFeeAdd(): View
    {
        $allMonthlyFees = MonthlyFee::all();
        $monthlyFees = [];

        foreach ($allMonthlyFees as $student) {
            $fee_category_id = FeeCategory::where('name', 'LIKE', '%monthly%')->value('id');
            $monthly_fee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                ->where('class_id', $student['class']['id'])
                ->first();

            $original_fee = $monthly_fee ? $monthly_fee->amount : 0;
            $monthlyFees[] = [
                'name' => $student['student']['name'],
                'id_no' => $student['student']['id_no'],
                'roll' => $student['student']['roll'],
                'year' => $student['year']['name'],
                'class' => $student['class']['name'],
                'student_id' => $student->student_id,
                'class_id' => $student->class_id,
                'year_id' => $student->year_id,
                'original_fee' => $original_fee,
                'fee_category_id' => $fee_category_id,
                'fee_category_name' => $monthly_fee['fee_category']['name']
            ];
        }
        $data ['monthlyFees'] = $monthlyFees;
        return view('admin.account.student.add_monthly_fee_account', $data);
    }

    public function StudentExamFeeAdd(): View
    {
        $allExamFees = ExamFee::with('discount')->get();
        $examFees = [];

        foreach ($allExamFees as $student) {
            $fee_category_id = FeeCategory::where('name', 'LIKE', '%exam%')->value('id');
            $exam_fee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                ->where('class_id', $student['class']['id'])
                ->first();

            $original_fee = $exam_fee ? $exam_fee->amount : 0;
            $discount = isset($student['discount']) ? $student['discount']['discount'] : 0;
            $discounted_fee = $discount / 100 * $original_fee;
            $examTotalFee = number_format((float)$original_fee - (float)$discounted_fee, 2, '.', '');

            $examFees[] = [
                'name' => $student['student']['name'],
                'id_no' => $student['student']['id_no'],
                'roll' => $student['student']['roll'],
                'year' => $student['year']['name'],
                'class' => $student['class']['name'],
                'student_id' => $student->student_id,
                'class_id' => $student->class_id,
                'year_id' => $student->year_id,
                'original_fee' => $original_fee,
                'fee_category_id' => $fee_category_id,
                'discount' => $discount,
                'fee' => $examTotalFee,
                'fee_category_name' => $exam_fee['fee_category']['name']
            ];
        }
        $data ['examFees'] = $examFees;
        return view('admin.account.student.add_exam_fee_account', $data);
    }

    public function StudentFeeStore(Request $request): RedirectResponse
    {
        $date = date('Y-m', strtotime($request->date));

        foreach ($request->input('checkmanage', []) as $index => $checked) {
            if ($checked) {
                $studentId = $request->input('student_id.' . $index);
                $yearId = $request->input('year_id.' . $index);
                $classId = $request->input('class_id.' . $index);
                $feeCategoryId = $request->input('fee_category_id.' . $index);
                $registrationFee = $request->input('fee.' . $index);

                $existingRecords = AccountStudentFee::where('year_id', $yearId)
                    ->where('class_id', $classId)
                    ->where('fee_category_id', $feeCategoryId)
                    ->where('date', $date)
                    ->get();

                if ($existingRecords->count() > 0) {
                    return redirect()->back()->with('error', 'Account fee is already inserted.');
                }

                $studentFeeAccount = new AccountStudentFee();
                $studentFeeAccount->year_id = $yearId;
                $studentFeeAccount->class_id = $classId;
                $studentFeeAccount->student_id = $studentId;
                $studentFeeAccount->fee_category_id = $feeCategoryId;
                $studentFeeAccount->amount = $registrationFee;
                $studentFeeAccount->date = $date;
                $studentFeeAccount->save();
            }
        }
        return redirect()->back()->with('success', 'Student fee added successfully!');

    }

}
