<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\MonthlyFee;
use App\Models\StudentClass;
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

class MonthlyFeeController extends Controller
{
    public function MonthlyFeeCreateView(): View
    {
        $years = StudentYear::all();
        $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%monthly%')->pluck('id')->first();
        $classes = FeeCategoryAmount::select('class_id')
            ->where('fee_category_id', $fee_category_id)
            ->get();
        $groups = StudentGroup::all();
        $allStudent = AssignStudent::all();
        $data['years'] = $years;
        $data['classes'] = $classes;
        $data['groups'] = $groups;
        $data['students'] = $allStudent;
        return view('admin.students.add_monthly_fee', $data);
    }

    public function MonthlyFeeView(): View
    {
        $data['monthly_fees'] = MonthlyFee::latest()->get();
        return view('admin.students.all_monthly_fees', $data);
    }

    public function MonthlyFeeStore(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'class' => 'required',
            'group' => 'required',
            'name' => 'required',
            'roll' => 'required',
            'month' => 'required',
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
        $fee_category_id = DB::table('fee_categories')->where('name', 'LIKE', '%monthly%')->pluck('id')->first();
        $feeCategoryAmount = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
            ->where('class_id', $request->class)
            ->first();

        if (!$feeCategoryAmount) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        $amount = $feeCategoryAmount->amount;
        $studentMonthlyFee = new MonthlyFee();
        $studentMonthlyFee->student_id = $studentId;
        $studentMonthlyFee->year_id = $request->year;
        $studentMonthlyFee->class_id = $request->class;
        $studentMonthlyFee->group_id = $request->group;
        $studentMonthlyFee->month = $request->month;
        $studentMonthlyFee->amount = $amount;
        $studentMonthlyFee->save();
        return redirect()->back()->with('success', 'Monthly fee added success');
    }

    public function MonthlyFeePayslip(Request $request): Response
    {
        $data['monthly_fees'] = MonthlyFee::latest()
            ->where('student_id', $request->student_id)
            ->first();
        $pdf = PDF::loadView('admin.students.monthly_fee_slip_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}



