<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarkController extends Controller
{

    public function MarksAdd(): View
    {
        $data['years'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('admin.students.marks.add_marks', $data);

    }


    public function MarksStore(Request $request): RedirectResponse
    {

        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();

            }
        }
        return redirect()->back()->with('success', 'Marks entry success');

    }


    public function MarksEdit(): View
    {
        $data['years'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('admin.students.marks.marks_edit', $data);
    }


    public function MarksEditGetStudents(Request $request): JsonResponse
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $getStudent = StudentMarks::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->where('assign_subject_id', $assign_subject_id)->where('exam_type_id', $exam_type_id)->get();

        return response()->json($getStudent);

    }


    public function MarksUpdate(Request $request): RedirectResponse
    {

        StudentMarks::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('assign_subject_id', $request->assign_subject_id)->where('exam_type_id', $request->exam_type_id)->delete();

        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();

            }
        }
        return redirect()->back()->with('success', 'Marks update success');

    }
}
