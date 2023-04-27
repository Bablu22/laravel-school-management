@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        list</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student-registration.create')}}">Student
                                        registration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Mark sheet</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="content-wrapper">
                                <div class="container-full">

                                    <section class="content">
                                        <div class="row">


                                            <div class="col-12">
                                                <div class="box bb-3 border-warning">
                                                    <div class="box-header">
                                                        <h4 class="box-title">Manage <strong>MarkSheet PDF View</strong>
                                                        </h4>
                                                    </div>

                                                    <div class="box-body" style="border: solid 1px; padding: 10px;">


                                                        <div class="row">  <!-- start 1st row -->
                                                            <div style="float: right" class="col-md-2 text-center">
                                                                <img src="{{ url('uploads/logo.png') }}"
                                                                     style="width: 120px; height: 100px;">
                                                            </div>

                                                            <div class="col-md-2 text-center">

                                                            </div>

                                                            <div class="col-md-4 text-center" style="float: left;">
                                                                <h4><strong>Easy School</strong></h4>
                                                                <h6><strong>Dhaka Bangladesh</strong></h6>
                                                                <h5><strong><u><i>Academic Transcript</i></u></strong>
                                                                </h5>
                                                                <h6>
                                                                    <strong>{{ $allMarks['0']['exam_type']['name'] }}</strong>
                                                                </h6>

                                                            </div>

                                                            <div class="col-md-12">
                                                                <hr style="border: solid 1px; width: 100%; color: #ddd; margin-bottom: 0px;">
                                                                <p style="text-align: right;"><u><i>Print
                                                                            Date: </i>{{ date('d M Y') }} </u></p>

                                                            </div>


                                                        </div>


                                                        <div class="row">

                                                            <div class="col-md-6">


                                                                <table class="table table-bordered" border="1"
                                                                       style="border-color: #ffffff;" width="100%"
                                                                       cellpadding="8" cellspacing="2">
                                                                    @php
                                                                        $assign_student = App\Models\AssignStudent::select('assign_students.*', 'users.roll')
    ->join('users', 'assign_students.student_id', '=', 'users.id')
    ->where('assign_students.year_id', $allMarks['0']->year_id)
    ->where('assign_students.class_id', $allMarks['0']->class_id)
    ->first();

                                                                    @endphp

                                                                    <tr>
                                                                        <td width="50%">Student Id</td>
                                                                        <td width="50%">{{ $allMarks['0']['id_no'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td width="50%">Roll No</td>
                                                                        <td width="50%">{{ $assign_student->roll }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td width="50%">Name</td>
                                                                        <td width="50%">{{ $allMarks['0']['student']['name'] }}</td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td width="50%">Class</td>
                                                                        <td width="50%">{{ $allMarks['0']['student_class']['name'] }}</td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td width="50%">Session</td>
                                                                        <td width="50%">{{ $allMarks['0']['year']['name'] }}</td>
                                                                    </tr>

                                                                </table>

                                                            </div> <!-- // end col md 6 -->


                                                            <div class="col-md-6">


                                                                <table class="table table-bordered" border="1"
                                                                       style="border-color: #ffffff;" width="100%"
                                                                       cellpadding="8" cellspacing="2">
                                                                    <thead>
                                                                    <tr>
                                                                        <th> Letter Grade</th>
                                                                        <th> Marks Interval</th>
                                                                        <th> Grade Point</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($allGrades as $mark)
                                                                        <tr>
                                                                            <td>{{ $mark->grade_name }}</td>
                                                                            <td>{{ $mark->start_marks }}
                                                                                - {{ $mark->end_marks }}</td>
                                                                            <td>{{ number_format((float)$mark->grade_point,2) }}
                                                                                - {{ ($mark->grade_point == 5)?(number_format((float)$mark->grade_point,2)):(number_format((float)$mark->grade_point+1,2) - (float)0.01) }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>

                                                                </table>

                                                            </div> <!-- // end col md 6 -->

                                                        </div> <!--  end 2nd row -->


                                                        <br><br>
                                                        <div class="row"> <!-- 3td row start -->
                                                            <div class="col-md-12">

                                                                <table class="table table-bordered"
                                                                       style="border-color: #ffffff;" width="100%"
                                                                       cellpadding="1" cellspacing="1">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">SL</th>
                                                                        <th class="text-center">Subject Name</th>
                                                                        <th class="text-center">Get Marks</th>
                                                                        <th class="text-center">Letter Grade</th>
                                                                        <th class="text-center">Grade Point</th>
                                                                    </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                    @php
                                                                        $total_marks = 0;
                                                                        $total_point = 0;
                                                                    @endphp

                                                                    @foreach($allMarks as $key => $mark)
                                                                        @php
                                                                            $get_mark = $mark->marks;
                                                                            $total_marks = (float)$total_marks+(float)$get_mark;
                                                                            $total_subject = App\Models\StudentMarks::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)->where('exam_type_id',$mark->exam_type_id)->where('student_id',$mark->student_id)->get()->count();
                                                                        @endphp
                                                                        <tr>
                                                                            <td class="text-center">{{ $key+1 }}</td>
                                                                            <td class="text-center">{{ $mark['assign_subject']['subject']['name'] }}
                                                                            </td>
                                                                            <td class="text-center">{{ $get_mark }}</td>

                                                                            @php
                                                                                $grade_marks = App\Models\MarkGrade::where([['start_marks','<=', (int)$get_mark],['end_marks', '>=',(int)$get_mark ]])->first();
                                                                                $grade_name = $grade_marks->grade_name;
                                                                                $grade_point = number_format((float)$grade_marks->grade_point,2);
                                                                                $total_point = (float)$total_point+(float)$grade_point;
                                                                            @endphp
                                                                            <td class="text-center">{{ $grade_name }}</td>
                                                                            <td class="text-center">{{ $grade_point }}</td>

                                                                        </tr>
                                                                    @endforeach

                                                                    <tr>
                                                                        <td colspan="3"><strong
                                                                                style="padding-left: 30px;">Total
                                                                                Maks</strong></td>
                                                                        <td colspan="3"><strong
                                                                                style="padding-left: 38px;">{{ $total_marks }}</strong>
                                                                        </td>
                                                                    </tr>

                                                                    </tbody>
                                                                </table>

                                                            </div> <!-- // end Col md -12    -->
                                                        </div> <!-- end 3td row start -->


                                                        <br><br>


                                                        <div class="row">  <!--  4th row start -->
                                                            <div class="col-md-12">

                                                                <table class="table table-bordered"
                                                                       style="border-color: #ffffff;" width="100%"
                                                                       cellpadding="1" cellspacing="1">
                                                                    @php
                                                                        $total_grade = 0;
                                                                        $point_for_letter_grade = (float)$total_point/(float)$total_subject;
                                                                        $total_grade = App\Models\MarkGrade::where([['start_point','<=',$point_for_letter_grade],['end_point','>=',$point_for_letter_grade]])->first();

                                                                        $grade_point_avg = (float)$total_point/(float)$total_subject;

                                                                    @endphp
                                                                    <tr>
                                                                        <td width="50%"><strong>Grade Point
                                                                                Average</strong></td>
                                                                        <td width="50%">
                                                                            @if($count_fail > 0)
                                                                                0.00
                                                                            @else
                                                                                {{number_format((float)$grade_point_avg,2)}}
                                                                            @endif
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td width="50%"><strong>Letter Grade </strong>
                                                                        </td>
                                                                        <td width="50%">
                                                                            @if($count_fail > 0)
                                                                                F
                                                                            @else
                                                                                @if($total_grade != null)
                                                                                    {{ $total_grade->grade_name }}
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="50%">Total Marks with Fraction</td>
                                                                        <td width="50%">
                                                                            <strong>{{ $total_marks }}</strong></td>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </div>   <!--  End 4th row start -->


                                                        <br><br>

                                                        <div class="row">  <!--  5th row start -->
                                                            <div class="col-md-12">

                                                                <table class="table table-bordered"
                                                                       style="border-color: #ffffff;" width="100%"
                                                                       cellpadding="1" cellspacing="1">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <strong>Remrks:</strong>
                                                                            @if($count_fail > 0)
                                                                                Fail
                                                                            @else
                                                                                @if($total_grade != null)
                                                                                    {{ $total_grade->remarks }}
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>   <!--  End 5th row start -->


                                                        <br><br><br><br>

                                                        <div class="row"> <!--  6th row start -->
                                                            <div class="col-md-4">
                                                                <hr style="border: solid 1px; widows: 60%; color: #ffffff; margin-bottom: -3px;">
                                                                <div class="text-center">Teacher</div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <hr style="border: solid 1px; widows: 60%; color: #ffffff; margin-bottom: -3px;">
                                                                <div class="text-center">Parents / Guardian</div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <hr style="border: solid 1px; widows: 60%; color: #ffffff; margin-bottom: -3px;">
                                                                <div class="text-center">Principal / Headmaster</div>
                                                            </div>

                                                        </div>  <!--  End 6th row start -->


                                                        <br><br>


                                                    </div>

                                                </div>

                                    </section>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
