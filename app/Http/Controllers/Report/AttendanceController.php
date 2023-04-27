<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    public function AttenReportView(): View
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('admin.reports.attend_report.attend_report_view', $data);
    }


    public function AttenReportGet(Request $request)
    {

        $employee_id = $request->employee_id;
        $where = [];
        if ($employee_id != '') {
            $where[] = ['employee_id', $employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->get();

        if ($singleAttendance) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get();
            // dd($data['allData']->toArray());

            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Absent')->get()->count();

            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Leave')->get()->count();

            $data['month'] = date('m-Y', strtotime($request->date));

            $pdf = PDF::loadView('admin.reports.attend_report.attend_report_pdf', $data);
            return $pdf->stream('document.pdf');

        } else {
            return redirect()->back()->with('error', 'This information does not match');
        }


    }
}
