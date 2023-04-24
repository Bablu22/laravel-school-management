<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\ExamFee;
use App\Models\ExamType;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\MonthlyFee;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ExamFeeController extends Controller
{
    public function ExamFeeView(): View
    {
        $examFees = [];
        $exam_fees = ExamFee::with('discount')->latest()->get();

        foreach ($exam_fees as $exam_fee) {

            $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%exam%')->pluck('id')->first();

            $exam_fee_category_amount = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                ->where('class_id', $exam_fee->class_id)
                ->first();

            $original_fee = $exam_fee_category_amount ? $exam_fee_category_amount->amount : 0;
            $discount = isset($exam_fee['discount']) ? $exam_fee['discount']['discount'] : 0;
            $discounted_fee = $discount / 100 * $original_fee;
            $total = number_format((float)$original_fee - (float)$discounted_fee, 2, '.', '');


            $examFee = [
                'name' => $exam_fee['student']['name'],
                'id_no' => $exam_fee['student']['id_no'],
                'roll' => $exam_fee['student']['roll'],
                'year' => $exam_fee['year']['name'],
                'class' => $exam_fee['class']['name'],
                'group' => $exam_fee['group']['name'],
                'student_id' => $exam_fee->student_id,
                'class_id' => $exam_fee->class_id,
                'examFee' => $original_fee,
                'discount' => $discount,
                'discounted_fee' => $total,
            ];
            $examFees[] = $examFee;
        }

        $data ['examFees'] = $examFees;
        return view('admin.students.all_exam_fee', $data);
    }

    public function ExamFeeCreateView(): View
    {
        $years = StudentYear::all();
        $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%exam%')->pluck('id')->first();
        $classes = FeeCategoryAmount::select('class_id')
            ->where('fee_category_id', $fee_category_id)
            ->get();
        $groups = StudentGroup::all();
        $allStudent = AssignStudent::all();
        $examTypes = ExamType::all();
        $data['years'] = $years;
        $data['classes'] = $classes;
        $data['groups'] = $groups;
        $data['students'] = $allStudent;
        $data['examTypes'] = $examTypes;
        return view('admin.students.add_exam_fee', $data);
    }

    public function ExamFeeStore(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'class' => 'required|integer',
            'group' => 'required|integer',
            'exam_type' => 'required|integer',
            'name' => 'required|string|max:255',
            'roll' => 'required|string|max:255',
            'discount' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        $studentId = User::where('name', $request->name)
            ->where('roll', $request->roll)
            ->value('id');
        $assignStudent = AssignStudent::where('student_id', $studentId)
            ->where('class_id', $request->class)
            ->where('year_id', $request->year)
            ->where('group_id', $request->group)
            ->first();

        if (!$assignStudent) {
            return redirect()->back()->with('error', 'Invalid student information');
        }

        $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%exam%')->pluck('id')->first();
        $feeCategoryAmount = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
            ->where('class_id', $request->class)
            ->first();

        if (!$feeCategoryAmount) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        $amount = $feeCategoryAmount->amount;

        $examFee = new ExamFee();
        $examFee->year_id = $request->input('year');
        $examFee->class_id = $request->input('class');
        $examFee->group_id = $request->input('group');
        $examFee->exam_type_id = $request->input('exam_type');
        $examFee->student_id = $studentId;
        $examFee->amount = $amount;
        $examFee->save();

        if ($request->discount) {
            if ($fee_category_id) {
                $discount_student = new  DiscountStudent();
                $discount_student->assign_student_id = $examFee->id;
                $discount_student->discount = $request->discount;
                $discount_student->fee_category_id = $fee_category_id;
                $discount_student->save();
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
        return redirect()->back()->with('success', 'Exam fee added success');
    }

    public function ExamFeePayslip(Request $request): Response
    {
        $examFees = [];
        $student_id = $request->input('student_id');
        $exam_fee = ExamFee::with('discount')
            ->where('student_id', $student_id)
            ->latest()
            ->first();

        $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%exam%')->pluck('id')->first();
        $exam_fee_category_amount = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
            ->where('class_id', $exam_fee['class_id'])
            ->first();
        $original_fee = $exam_fee_category_amount ? $exam_fee_category_amount->amount : 0;
        $discount = isset($exam_fee['discount']) ? $exam_fee['discount']['discount'] : 0;
        $discounted_fee = $discount / 100 * $original_fee;
        $total = number_format((float)$original_fee - (float)$discounted_fee, 2, '.', '');

        $examFee = [
            'name' => $exam_fee['student']['name'],
            'id_no' => $exam_fee['student']['id_no'],
            'roll' => $exam_fee['student']['roll'],
            'father_name' => $exam_fee['student']['father_name'],
            'year' => $exam_fee['year']['name'],
            'class' => $exam_fee['class']['name'],
            'group' => $exam_fee['group']['name'],
            'exam_type' => $exam_fee['exam_type']['name'],
            'student_id' => $exam_fee->student_id,
            'class_id' => $exam_fee->class_id,
            'examFee' => $original_fee,
            'discount' => $discount,
            'discounted_fee' => $total,
        ];

        $pdf = PDF::loadView('admin.students.exam_fee_slip_pdf', $examFee);
        return $pdf->stream('document.pdf');

    }
}
