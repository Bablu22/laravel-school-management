<?php

namespace App\Http\Controllers\Profite;

use App\Http\Controllers\Controller;
use App\Models\AccountSalary;
use App\Models\AccountStudentFee;
use App\Models\OtherCostAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfiteController extends Controller
{
    public function MonthlyProfitView(): View
    {
        return view('admin.reports.profit.profit_view');

    }

    public function MonthlyProfitDatewais(Request $request): JsonResponse
    {

        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = OtherCostAccount::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        $html['thsource'] = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit </th>';
        $html['thsource'] .= '<th>Action</th>';

        $color = 'success';
        $html['tdsource'] = '<td>' . $student_fee . '</td>';
        $html['tdsource'] .= '<td>' . $other_cost . '</td>';
        $html['tdsource'] .= '<td>' . $emp_salary . '</td>';
        $html['tdsource'] .= '<td>' . $total_cost . '</td>';
        $html['tdsource'] .= '<td>' . $profit . '</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PDF" target="_blanks" href="' . route("report.profit.pdf") . '?start_date=' . $sdate . '&end_date=' . $edate . '">Pay Slip</a>';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);

    }


    public function MonthlyProfitPdf(Request $request): Response
    {

        $data['start_date'] = date('Y-m', strtotime($request->start_date));
        $data['end_date'] = date('Y-m', strtotime($request->end_date));
        $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
        $data['edate'] = date('Y-m-d', strtotime($request->end_date));

        $pdf = PDF::loadView('admin.reports.profit.profit_pdf', $data);
        return $pdf->stream('document.pdf');

    }
}
