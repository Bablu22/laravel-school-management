<?php

use Illuminate\Support\Facades\Auth;
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
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'active_user', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    // User related all routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/all', 'index')->name('user.all');
        Route::get('/user/create', 'create')->name('user.create');
        Route::get('/user/update/{user}', 'update')->name('user.update');
        Route::post('/user/user/{user}', 'storeUpdate')->name('user.store.update');
        Route::post('/user/store', 'store')->name('user.store');
        Route::put('/users/{user}/deactivate', 'deactivateUser')->name('users.deactivate');
        Route::put('/users/{user}/activate', 'activateUser')->name('users.activate');
        Route::get('/user/{user}', 'destroy')->name('user.destroy');
    });

    // Profile related all routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'indexProfile')->name('profile.show');
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
        Route::get('/subjects-assign/{subjectAssign}', 'destroy')->name('subject-assign.destroy');
        Route::put('/subjects-assign/{id}', 'update')->name('subject-assign.update');
    });

    // Student assign subjects management setup
    Route::controller(DesignationController::class)->group(function () {
        Route::get('/designations', 'designationIndex')->name('designation.all');
        Route::post('/designations/store', 'designationStore')->name('designation.store');
        Route::get('/designations/{designation}', 'destroy')->name('designation.destroy');
        Route::put('/designations/{id}', 'update')->name('designation.update');
    });

});


