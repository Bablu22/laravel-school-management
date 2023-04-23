<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EmployeeLeaveController extends Controller
{
    public function LeaveView(): View
    {
        $data['allData'] = EmployeeLeave::orderBy('id', 'desc')->get();
        return view('admin.employees.leave.employee_leave_view', $data);
    }

    public function LeaveAdd(): View
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('admin.employees.leave.employee_leave_add', $data);
    }

    public function LeaveStore(Request $request): RedirectResponse
    {
        $rules = [
            'employee_id' => 'required|integer',
            'start_date' => 'required|date',
            'leave_purpose_id' => 'required|integer',
            'end_date' => 'nullable|date_format:d-M-Y',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Handle validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));
        $data->save();
        return redirect()->back()->with('success', 'Employee leave add successfully');

    }


    public function LeaveEdit($id): View
    {
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('admin.employees.leave.employee_leave_edit', $data);

    }

    public function LeaveUpdate(Request $request, $id): RedirectResponse
    {

        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));
        $data->save();

        return redirect()->back()->with('success', 'Employee leave update successfully');

    }


    public function LeaveDelete($id): RedirectResponse
    {
        $leave = EmployeeLeave::find($id);
        $leave->delete();

        return redirect()->back()->with('success', 'Employee leave delete successfully');
    }
}
