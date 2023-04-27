<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountSalary;
use App\Models\EmployeeAttendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AccountSalaryController extends Controller
{
    public function AccountSalaryView(): View
    {

        $data['allData'] = AccountSalary::all();
        return view('admin.account.employee.employee_salary_account', $data);

    }


    public function AccountSalaryAdd(): View
    {

        $allStudentAttendance = EmployeeAttendance::select('employee_id')
            ->groupBy('employee_id')
            ->with(['user'])
            ->get();

        $employeeAttendances = [];

        foreach ($allStudentAttendance as $key => $attend) {
            $accountSalary = AccountSalary::where('employee_id', $attend->employee_id)
                ->first();

            if ($accountSalary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $totalAttend = EmployeeAttendance::with(['user'])
                ->where('employee_id', $attend->employee_id)
                ->get();

            $absentCount = count($totalAttend->where('attend_status', 'Absent'));

            $salary = (float)$attend['user']['salary'];
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus = (float)$absentCount * (float)$salaryPerDay;
            $totalSalary = (float)$salary - (float)$totalSalaryMinus;

            $employeeAttendances[] = [
                'id' => $attend->id,
                'id_no' => $attend['user']['id_no'],
                'name' => $attend['user']['name'],
                'salary' => $attend['user']['salary'],
                'total_salary' => $totalSalary,
                'employee_id' => $attend->employee_id,
                'checked' => $checked,
            ];
        }

        $data ['employeeAttendances'] = $employeeAttendances;
        return view('admin.account.employee.employee_salary_add_account', $data);
    }

    public function AccountSalaryStore(Request $request): RedirectResponse
    {

        $date = date('Y-m', strtotime($request->date));
        $selectedIds = $request->input('selected');
        $employeeData = [];

        foreach ($selectedIds as $id) {
            $employeeId = $request->input('employee_id.' . $id);
            $salary = $request->input('salary.' . $id);
            $totalSalary = $request->input('total_salary.' . $id);
            $date = $request->input('date');

            // Validate if the combination of employee_id, date, and amount is unique
            $validator = Validator::make([
                'employee_id' => $employeeId,
                'date' => $date,
                'amount' => $totalSalary,
            ], [
                'employee_id' => 'required',
                'date' => 'required|date',
                'amount' => 'required',
            ]);
            $validator->after(function ($validator) use ($employeeId, $date, $totalSalary) {
                $existingRecord = AccountSalary::where('employee_id', $employeeId)
                    ->where('date', $date)
                    ->where('amount', $totalSalary)
                    ->first();

                if ($existingRecord) {
                    $validator->errors()->add('employee_id', 'This record already exists');
                }
            });

            if ($validator->fails()) {
                return handleValidationErrors($validator);
            }

            $employeeData[] = [
                'employee_id' => $employeeId,
                'date' => $date,
                'amount' => $totalSalary,
            ];
        }

        // Insert the data to the database
        foreach ($employeeData as $data) {
            $accountSalary = new AccountSalary();
            $accountSalary->employee_id = $data['employee_id'];
            $accountSalary->date = $data['date'];
            $accountSalary->amount = $data['amount'];
            $accountSalary->save();
        }

        return redirect()->back()->with('success', 'Data inserted successfully.');

    }
}
