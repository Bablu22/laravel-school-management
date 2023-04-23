<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmployeeAttendanceController extends Controller
{
    public function AttendanceView(): View
    {
        $data['allData'] = EmployeeAttendance::select('date', DB::raw('MAX(id) as max_id'))
            ->groupBy('date')
            ->orderBy('max_id', 'DESC')
            ->get();

        // $data['allData'] = EmployeeAttendance::orderBy('id','DESC')->get();
        return view('admin.employees.attendance.employee_attendance_view', $data);
    }

    public function AttendanceAdd(): View
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('admin.employees.attendance.employee_attendance_add', $data);

    }

    public function AttendanceStore(Request $request): RedirectResponse
    {
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);
        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        return redirect()->back()->with('success', 'Employee attendance added successfully');
    }

    public function AttendanceEdit($date): View
    {
        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('admin.employees.attendance.employee_attendance_edit', $data);
    }

    public function AttendanceDetails($date): View
    {
        $data['details'] = EmployeeAttendance::where('date', $date)->get();
        return view('admin.employees.attendance.employee_attendance_details', $data);

    }
}
