<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationFeeController extends Controller
{
    public function RegistrationFeeView(): View
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
                'registrationFee' => $registrationFee,
                'discount' => $discount,
                'original_fee' => $original_fee,
            ];
        }
        $data ['registrationFees'] = $registrationFees;
        return view('admin.students.all_registration_fees', $data);
    }

    public function RegFeePayslip(Request $request): Response
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $details = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $fee_category_id =FeeCategory::where('name', 'LIKE', '%registration%')->value('id');
        $registration_fee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
            ->where('class_id', $details->class_id)
            ->first();
        $original_fee = $registration_fee ? $registration_fee->amount : 0;
        if ($details['discount'] !== null) {
            $discount = $details['discount']['discount'];
        } else {
            $discount = 0;
        }
        $discounted_fee = $discount / 100 * $original_fee;
        $final_fee = (float)$original_fee - (float)$discounted_fee;

        $data = [
            'details' => $details,
            'original_fee' => $original_fee,
            'discounted_fee' => $discounted_fee,
            'final_fee' => $final_fee
        ];

        $pdf = PDF::loadView('admin.students.registration_fee_slip_pdf', $data);
        return $pdf->stream('document.pdf');

    }
}
