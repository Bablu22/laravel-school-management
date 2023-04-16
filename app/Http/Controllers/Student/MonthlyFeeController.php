<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonthlyFeeController extends Controller
{
    public function MonthlyFeeCreateView(): View
    {
        $years = StudentYear::all();
        $classes = FeeCategoryAmount::select('class_id')
            ->where('fee_category_id', 3)
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
        return view('admin.students.all_monthly_fees',);
    }

}



