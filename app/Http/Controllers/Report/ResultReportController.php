<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\MarkGrade;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;


class ResultReportController extends Controller
{
    public function ResultView(): View
    {
        $data['years'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('admin.reports.student_result.student_result', $data);

    }


    public function ResultGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('marks', '<', '33')->get()->count();
        $studentMarks = StudentMarks::with(['assign_subject', 'year', 'student'])
            ->select('year_id', 'class_id', 'exam_type_id', 'student_id', 'assign_subject_id', 'marks',)
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->get();

        if ($studentMarks->isNotEmpty()) {
            $data['allMarks'] = $studentMarks->groupBy('student_id');
            $data['allGrades'] = MarkGrade::all();
            $data['count_fail'] = $count_fail;
            $pdf = PDF::loadView('admin.reports.student_result.student_result_pdf', $data);
            return $pdf->stream('document.pdf');
        } else {
            return redirect()->back()->with('error', "Sorry, these criteria do not match any student marks.");
        }


    }


    public function IdcardView(): View
    {
        $data['years'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        return view('admin.reports.id_card.id_card_view', $data);
    }


    public function IdcardGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $check_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->first();

        if ($check_data) {
            $data['allData'] = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();
            // dd($data['allData']->toArray());

            $pdf = PDF::loadView('admin.reports.id_card.id_card_pdf', $data);
            return $pdf->stream('document.pdf');

        } else {

            return redirect()->back()->with("error", "No data found");

        }


    }
}
