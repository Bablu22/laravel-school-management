<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EmployeeSalaryController extends Controller
{
    public function SalaryView(): View
    {
        $data['allData'] = User::where('usertype', 'employee')->get();
        return view('admin.employees.employee_salary', $data);
    }


    public function SalaryStore(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'increment_salary' => 'required|numeric|min:0',
            'effected_salary' => 'required|date',
        ]);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();

        return redirect()->back()->with('success', 'Employee salary increment successfully');
    }

    public function SalaryDetails($id): View
    {
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id', $data['details']->id)->get();
        //dd($data['salary_log']->toArray());
        return view('admin.employees.employee_salary_details', $data);

    }
}
