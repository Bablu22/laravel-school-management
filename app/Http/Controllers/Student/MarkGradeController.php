<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MarkGrade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MarkGradeController extends Controller
{
    public function MarksGradeView(): View
    {
        $data['allData'] = MarkGrade::all();
        return view('admin.students.marks.grade_marks_view', $data);

    }


    public function MarksGradeAdd(): View
    {
        return view('admin.students.marks.grade_marks_add');
    }


    public function MarksGradeStore(Request $request): RedirectResponse
    {

        $rules = [
            'grade_name' => 'required|string',
            'grade_point' => 'required|numeric|min:0|max:5',
            'start_marks' => 'required|integer|min:0|max:100',
            'end_marks' => 'required|integer|min:0|max:100|gt:start_marks',
            'start_point' => 'required|numeric|min:0|max:5',
            'end_point' => 'required|numeric|min:0|max:5|gt:start_point',
            'remarks' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        $data = new MarkGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        return redirect()->back()->with('success', 'Mark grade add success');

    }

    public function MarksGradeEdit($id): View
    {
        $data['editData'] = MarkGrade::find($id);
        return view('admin.students.marks.grade_marks_edit', $data);

    }


    public function MarksGradeUpdate(Request $request, $id): RedirectResponse
    {
        $rules = [
            'grade_name' => 'required|string',
            'grade_point' => 'required|numeric|min:0|max:5',
            'start_marks' => 'required|integer|min:0|max:100',
            'end_marks' => 'required|integer|min:0|max:100|gt:start_marks',
            'start_point' => 'required|numeric|min:0|max:5',
            'end_point' => 'required|numeric|min:0|max:5|gt:start_point',
            'remarks' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }
        $data = MarkGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        return redirect()->back()->with('success', 'Mark grade update success');

    }

}
