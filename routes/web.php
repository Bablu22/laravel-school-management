<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Admin\StudentYearController;
use App\Http\Controllers\Admin\StudentGroupController;
use App\Http\Controllers\Admin\StudentShiftController;
use App\Http\Controllers\Admin\FeeCategoryController;
use App\Http\Controllers\Admin\FeeCategoryAmountController;
use App\Http\Controllers\Admin\ExamTypeController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\AssignSubjectController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Student\StudentRegController;
use App\Http\Controllers\Student\RegistrationFeeController;
use App\Http\Controllers\Student\MonthlyFeeController;
use App\Http\Controllers\Student\ExamFeeController;
use App\Http\Controllers\Employee\EmployeeRegController;
use App\Http\Controllers\Employee\EmployeeSalaryController;
use App\Http\Controllers\Employee\EmployeeLeaveController;
use App\Http\Controllers\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Employee\MonthlySalaryController;
use App\Http\Controllers\Student\MarkController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Student\MarkGradeController;
use App\Http\Controllers\Account\StudentFeeController;
use App\Http\Controllers\Account\AccountSalaryController;
use App\Http\Controllers\Account\AccountOtherCostController;
use App\Http\Controllers\Profite\ProfiteController;
use App\Http\Controllers\Account\MarkSheetController;
use App\Http\Controllers\Report\AttendanceController;
use App\Http\Controllers\Report\ResultReportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
});

Route::middleware(['auth:sanctum', 'active_user', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    // User related all routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/all', 'index')->name('user.all')->middleware('auth', 'role:Admin');
        Route::get('/user/create', 'create')->name('user.create')->middleware('auth', 'role:Admin');
        Route::get('/user/update/{user}', 'update')->name('user.update')->middleware('auth', 'role:Admin');
        Route::post('/user/user/{user}', 'storeUpdate')->name('user.store.update')->middleware('auth', 'role:Admin');
        Route::post('/user/store', 'store')->name('user.store')->middleware('auth', 'role:Admin');
        Route::put('/users/{user}/deactivate', 'deactivateUser')->name('users.deactivate')->middleware('auth', 'role:Admin');
        Route::put('/users/{user}/activate', 'activateUser')->name('users.activate')->middleware('auth', 'role:Admin');
        Route::get('/user/{user}', 'destroy')->name('user.destroy')->middleware('auth', 'role:Admin');
    });

    // Profile related all routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'indexProfile')->name('profile');
        Route::get('/profile/edit', 'editProfile')->name('profile.edit');
        Route::post('/profile/store/{user}', 'storeProfile')->name('profile.store');
        //Change password
        Route::get('/profile/password', 'passwordChange')->name('password.change');
        Route::post('/profile/password/store', 'passwordChangeStore')->name('password.store');
    });

    // Student class management setup
    Route::controller(StudentClassController::class)->group(function () {
        Route::get('/class', 'classIndex')->name('class.all');
        Route::post('/class/store', 'classStore')->name('class.store');
        Route::get('/class/{class}', 'destroy')->name('class.destroy');
        Route::put('/class/{id}', 'update')->name('class.update');
    });

    // Student year management setup
    Route::controller(StudentYearController::class)->group(function () {
        Route::get('/years', 'yearsIndex')->name('years.all');
        Route::post('/years/store', 'yearsStore')->name('years.store');
        Route::get('/years/{year}', 'destroy')->name('years.destroy');
        Route::put('/years/{id}', 'update')->name('years.update');
    });

    // Student group management setup
    Route::controller(StudentGroupController::class)->group(function () {
        Route::get('/groups', 'groupIndex')->name('group.all');
        Route::post('/groups/store', 'groupStore')->name('group.store');
        Route::get('/groups/{group}', 'destroy')->name('group.destroy');
        Route::put('/groups/{id}', 'update')->name('group.update');
    });

    // Student shift management setup
    Route::controller(StudentShiftController::class)->group(function () {
        Route::get('/shifts', 'shiftIndex')->name('shift.all');
        Route::post('/shifts/store', 'shiftStore')->name('shift.store');
        Route::get('/shifts/{shift}', 'destroy')->name('shift.destroy');
        Route::put('/shifts/{id}', 'update')->name('shift.update');
    });

    // Student fee category management setup
    Route::controller(FeeCategoryController::class)->group(function () {
        Route::get('/fees', 'feeIndex')->name('fee_category.all');
        Route::post('/fees/store', 'feeStore')->name('fee_category.store');
        Route::get('/fees/{id}', 'destroy')->name('fee_category.destroy');
        Route::put('/fees/{id}', 'update')->name('fee_category.update');
    });

    // Student fee amount management setup
    Route::controller(FeeCategoryAmountController::class)->group(function () {
        Route::get('/fees-amount', 'feeAmountIndex')->name('fee_category_amount.all');
        Route::post('/fees-amount/store', 'feeAmountStore')->name('fee_category_amount.store');
        Route::get('/fees-amount/{id}', 'destroy')->name('fee_category_amount.destroy');
        Route::put('/fees-amount/{id}', 'update')->name('fee_category_amount.update');
    });

    // Student exam type management setup
    Route::controller(ExamTypeController::class)->group(function () {
        Route::get('/exam-types', 'examTypeIndex')->name('exam_type.all');
        Route::post('/exam-types/store', 'examTypeStore')->name('exam_type.store');
        Route::get('/exam-types/{examType}', 'destroy')->name('exam_type.destroy');
        Route::put('/exam-types/{id}', 'update')->name('exam_type.update');
    });

    // Student subjects management setup
    Route::controller(SubjectController::class)->group(function () {
        Route::get('/subjects', 'subjectIndex')->name('subject.all');
        Route::post('/subjects/store', 'subjectStore')->name('subject.store');
        Route::get('/subjects/{subject}', 'destroy')->name('subject.destroy');
        Route::put('/subjects/{id}', 'update')->name('subject.update');
    });

    // Student assign subjects management setup
    Route::controller(AssignSubjectController::class)->group(function () {
        Route::get('/subjects-assign', 'subjectAssignIndex')->name('subject-assign.all');
        Route::post('/subjects-assign/store', 'subjectAssignStore')->name('subject-assign.store');
        Route::get('/subjects-assign/{class_id}', 'details')->name('subject-assign.details');
        Route::put('/subjects-assign/{id}', 'update')->name('subject-assign.update');
    });

    // Student assign subjects management setup
    Route::controller(DesignationController::class)->group(function () {
        Route::get('/designations', 'designationIndex')->name('designation.all');
        Route::post('/designations/store', 'designationStore')->name('designation.store');
        Route::get('/designations/{designation}', 'destroy')->name('designation.destroy');
        Route::put('/designations/{id}', 'update')->name('designation.update');
    });

    // Student student registration management setup
    Route::controller(StudentRegController::class)->group(function () {
        Route::get('/student-registration', 'registrationIndex')->name('student-registration.all');
        Route::get('/student-registration/create', 'registrationCreate')->name('student-registration.create');
        Route::post('/student-registration/store', 'registrationStore')->name('student-registration.store');
        Route::get('/student-update/{id}', 'update')->name('student-registration.update');
        Route::post('/student-update/store/{id}', 'updateStore')->name('student-registration.updateStore');
        Route::get('/student-registration/{id}', 'details')->name('student-registration.details');
        Route::get('/student-registration/delete/{id}', 'deleteStudent')->name('student-registration.delete');
    });

    // Student student registration fee management setup
    Route::controller(RegistrationFeeController::class)->group(function () {
        Route::get('/registration/fees', 'RegistrationFeeView')->name('reg-fee.all');
        Route::get('/registration/fees/payslip', 'RegFeePayslip')->name('reg-fee.payslip');

    });

    // Student student monthly fee management setup
    Route::controller(MonthlyFeeController::class)->group(function () {
        Route::get('/student/monthly-fees', 'MonthlyFeeView')->name('monthly-fee.all');
        Route::get('/student/monthly-fees/create', 'MonthlyFeeCreateView')->name('monthly-fee.create');
        Route::post('/student/monthly-fees/store', 'MonthlyFeeStore')->name('monthly-fee.store');
        Route::get('/student/monthly-fees/payslip', 'MonthlyFeePayslip')->name('monthly-fee.payslip');

    });

    // Student student exam fee management setup
    Route::controller(ExamFeeController::class)->group(function () {
        Route::get('/student/exam-fees', 'ExamFeeView')->name('exam-fee.all');
        Route::get('/student/exam-fees/create', 'ExamFeeCreateView')->name('exam-fee.create');
        Route::post('/student/exam-fees/store', 'ExamFeeStore')->name('exam-fee.store');
        Route::get('/student/exam-fees/payslip', 'ExamFeePayslip')->name('exam-fee.payslip');

    });

    // Employee registration management setup
    Route::controller(EmployeeRegController::class)->group(function () {
        Route::get('/employees', 'EmployeeView')->name('employee.all');
        Route::get('/employee/create', 'EmployeeCreateView')->name('employee.create');
        Route::post('/employee/store', 'EmployeeStore')->name('employee.store');
        Route::get('/employee/edit/{id}', 'EditEmployee')->name('employee.edit');
        Route::get('/employee/details/{id}', 'EmployeeDetails')->name('employee.details');
        Route::get('/employee/delete/{id}', 'EmployeeDelete')->name('employee.delete');
        Route::post('/employee/update/{id}', 'EmployeeUpdate')->name('employee.update');

    });

    // Employee salary management setup
    Route::controller(EmployeeSalaryController::class)->group(function () {
        Route::get('salary/employee/view', 'SalaryView')->name('employee.salary.view');
        Route::post('salary/employee/store/{id}', 'SalaryStore')->name('update.increment.store');
        Route::get('salary/employee/details/{id}', 'SalaryDetails')->name('employee.salary.details');

    });

    // Employee leave management setup
    Route::controller(EmployeeLeaveController::class)->group(function () {
        Route::get('leave/employee/view', 'LeaveView')->name('employee.leave.view');
        Route::get('leave/employee/add', 'LeaveAdd')->name('employee.leave.add');
        Route::post('leave/employee/store', 'LeaveStore')->name('store.employee.leave');
        Route::get('leave/employee/edit/{id}', 'LeaveEdit')->name('employee.leave.edit');
        Route::post('leave/employee/update/{id}', 'LeaveUpdate')->name('update.employee.leave');
        Route::get('leave/employee/delete/{id}', 'LeaveDelete')->name('employee.leave.delete');

    });

    // Employee attendance management setup
    Route::controller(EmployeeAttendanceController::class)->group(function () {
        Route::get('attendance/employee/view', 'AttendanceView')->name('employee.attendance.view');
        Route::get('attendance/employee/add', 'AttendanceAdd')->name('employee.attendance.add');
        Route::post('attendance/employee/store', 'AttendanceStore')->name('store.employee.attendance');
        Route::get('attendance/employee/edit/{date}', 'AttendanceEdit')->name('employee.attendance.edit');
        Route::get('attendance/employee/details/{date}', 'AttendanceDetails')->name('employee.attendance.details');

    });

    // Employee monthly salary management setup
    Route::controller(MonthlySalaryController::class)->group(function () {
        Route::get('monthly/salary/view', 'MonthlySalaryView')->name('employee.monthly.salary');
        Route::get('monthly/salary/get', 'MonthlySalaryGet')->name('employee.monthly.salary.get');
        Route::get('monthly/salary/payslip/{employee_id}', 'MonthlySalaryPayslip')->name('employee.monthly.salary.payslip');
    });

    // students marks management setup
    Route::controller(MarkController::class)->group(function () {
        Route::get('marks/entry/add', 'MarksAdd')->name('marks.entry.add');
        Route::post('marks/entry/store', 'MarksStore')->name('marks.entry.store');
        Route::get('marks/entry/edit', 'MarksEdit')->name('marks.entry.edit');
        Route::get('marks/getstudents/edit', 'MarksEditGetStudents')->name('student.edit.getstudents');
        Route::post('marks/entry/update', 'MarksUpdate')->name('marks.entry.update');
    });

    // student grade management setup
    Route::controller(MarkGradeController::class)->group(function () {
        Route::get('marks/grade/view', 'MarksGradeView')->name('marks.entry.grade');
        Route::get('marks/grade/add', 'MarksGradeAdd')->name('marks.grade.add');
        Route::post('marks/grade/store', 'MarksGradeStore')->name('store.marks.grade');
        Route::get('marks/grade/edit/{id}', 'MarksGradeEdit')->name('marks.grade.edit');
        Route::post('marks/grade/update/{id}', 'MarksGradeUpdate')->name('update.marks.grade');
    });

    Route::get('marks/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');
    Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');


    /// Account Management Routes
    Route::controller(StudentFeeController::class)->group(function () {
        Route::get('account/student/fee/view', 'StudentFeeView')->name('student.fee.view');
        Route::get('account/student/registration-fee/add', 'StudentRegFeeAdd')->name('student.reg.fee.add');
        Route::get('account/student/monthly-fee/add', 'StudentMonthlyFeeAdd')->name('student.monthly.fee.add');
        Route::get('account/student/exam-fee/add', 'StudentExamFeeAdd')->name('student.exam.fee.add');
        Route::post('account/student/fee/store', 'StudentFeeStore')->name('account.fee.store');
    });

    /// Account employee salary Management Routes
    Route::controller(AccountSalaryController::class)->group(function () {
        Route::get('account/salary/view', 'AccountSalaryView')->name('account.salary.view');
        Route::get('account/salary/add', 'AccountSalaryAdd')->name('account.salary.add');
        Route::post('account/salary/store', 'AccountSalaryStore')->name('account.salary.store');
    });

    /// Account other cost Management Routes
    Route::controller(AccountOtherCostController::class)->group(function () {
        Route::get('account/others/view', 'AccountOtherCostView')->name('account.others.view');
        Route::post('account/others/store', 'AccountOtherCostStore')->name('account.others.store');
        Route::post('account/others/update/{id}', 'AccountOtherCostUpdate')->name('account.others.update');
        Route::get('account/others/delete/{id}', 'AccountOtherCostDelete')->name('account.others.delete');
    });

    /// Account profit Management Routes
    Route::controller(ProfiteController::class)->group(function () {
        Route::get('reports/profit/view', 'MonthlyProfitView')->name('monthly.profit.view');
        Route::get('reports/profit/datewais', 'MonthlyProfitDatewais')->name('report.profit.datewais.get');
        Route::get('reports/profit/pdf', 'MonthlyProfitPdf')->name('report.profit.pdf');
    });

    /// Account mark sheet generate Management Routes
    Route::controller(MarkSheetController::class)->group(function () {
        Route::get('marksheet/generate/view', 'MarkSheetView')->name('marksheet.generate.view');
        Route::get('marksheet/generate/get', 'MarkSheetGet')->name('report.marksheet.get');
    });

    /// Attendance report Management Routes
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('attendance/report/view', 'AttenReportView')->name('attendance.report.view');
        Route::get('report/attendance/get', 'AttenReportGet')->name('report.attendance.get');
    });

    /// Result report  Management Routes
    Route::controller(ResultReportController::class)->group(function () {
        Route::get('student/result/view', 'ResultView')->name('student.result.view');
        Route::get('student/result/get', 'ResultGet')->name('report.student.result.get');


        // Student ID Card Routes
        Route::get('student/idcard/view', 'IdcardView')->name('student.idcard.view');
        Route::get('student/idcard/get', 'IdcardGet')->name('report.student.idcard.get');
    });


});


