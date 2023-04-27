<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\MarkGrade;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MarkSheetController extends Controller
{
    public function MarkSheetView()
    {
        $marks = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'id_no')
            ->distinct()
            ->get();

        $data['years'] = StudentYear::whereIn('id', $marks->pluck('year_id'))->orderBy('id', 'desc')->get();
        $data['class'] = StudentClass::whereIn('id', $marks->pluck('class_id'))->get();
        $data['exam_type'] = ExamType::whereIn('id', $marks->pluck('exam_type_id'))->get();
        $students = AssignStudent::join('users', 'assign_students.student_id', '=', 'users.id')
            ->join('student_marks', function ($join) use ($marks) {
                $join->on('users.id', '=', 'student_marks.student_id')
                    ->whereIn('student_marks.year_id', $marks->pluck('year_id'))
                    ->whereIn('student_marks.class_id', $marks->pluck('class_id'));
            })
            ->select('assign_students.*', 'users.id_no')
            ->distinct()
            ->get();

        $data['students'] = $students;
        return view('admin.reports.marksheet.marksheet_view', $data);

    }


    public function MarkSheetGet(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('marks', '<', '33')->get()->count();
        // dd($count_fail);
        $singleStudent = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();

        if ($singleStudent) {

            $allMarks = StudentMarks::with(['assign_subject', 'year'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            // dd($allMarks->toArray());
            $allGrades = MarkGrade::all();
            return view('admin.reports.marksheet.markshet_pdf', compact('allMarks', 'allGrades', 'count_fail'));
        } else {

            return redirect()->back()->with('error', 'This student information does not match');
        }

    }
}
