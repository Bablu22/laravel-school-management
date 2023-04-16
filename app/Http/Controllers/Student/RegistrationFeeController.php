<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PDF;
class RegistrationFeeController extends Controller
{
    public function RegistrationFeeView(): View
    {

        $allStudent = AssignStudent::with('discount')->get();
        $data = [
            'allStudents' => $allStudent,
        ];
        return view('admin.students.all_registration_fees', $data);
    }


    public function RegFeePayslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $allStudent['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $pdf = PDF::loadView('admin.students.registration_fee_slip_pdf', $allStudent);
        return $pdf->stream('document.pdf');

    }
}
