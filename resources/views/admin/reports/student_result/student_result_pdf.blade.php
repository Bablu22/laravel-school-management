<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Result</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>


@foreach($allMarks as $data)

    <table id="customers">
        <tr>
            <td><h2>
                        <?php $image_path = '/uploads/logo.png'; ?>
                    <img src="{{ public_path() . $image_path }}" alt="" width="200">

                </h2></td>
            <td><h2>Easy School ERP</h2>
                <p>School Address</p>
                <p>Phone : 343434343434</p>
                <p>Email : support@eschool.com</p>
                <p><b>Student Result Report </b></p>

            </td>
        </tr>

    </table>

    <div class="row">

        <div class="col-md-12">


            <table class="table table-bordered" border="1"
                   style="border-color: #ffffff;" width="100%"
                   cellpadding="8" cellspacing="2">


                <tr>
                    <td width="50%">Student Id</td>
                    <td>{{ $data->first()->student->id_no }}</td>
                </tr>

                <tr>
                    <td width="50%">Roll No</td>
                    <td>{{ $data->first()->student->roll }}</td>
                </tr>

                <tr>
                    <td width="50%">Name</td>
                    <td>{{ $data->first()->student->name }}</td>
                </tr>


                <tr>
                    <td width="50%">Class</td>
                    <td>{{ $data->first()->student_class->name }}</td>
                </tr>


                <tr>
                    <td width="50%">Session</td>
                    <td>{{ $data->first()->year->name }}</td>
                </tr>

            </table>

        </div> <!-- // end col md 6 -->


        <div class="col-md-12">


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

    </div>

    <br>
    <div class="row"> <!-- 3td row start -->
        <div class="col-md-12">
            <table class="table table-bordered" style="border-color: #ffffff;" width="100%" cellpadding="1"
                   cellspacing="1" border="1">
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


                @foreach($data as $key=> $mark)
                    @php
                        $total_point = 0;
                    @endphp
                    @php
                        $get_mark = $mark->marks;
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
                    @php

                        @endphp
                @endforeach

                @php
                    $total_marks = 0;
                @endphp

                @foreach($data as $key => $mark)
                    @php
                        $get_mark = $mark->marks;
                        $total_marks += (float)$get_mark;
                        // rest of the code
                    @endphp
                @endforeach

                <tr>
                    <td colspan="3"><strong style="padding-left: 30px;">Total Marks</strong></td>
                    <td colspan="3"><strong style="padding-left: 38px;">{{ $total_marks }}</strong></td>
                </tr>

                </tbody>
            </table>


        </div> <!-- // end Col md -12    -->
    </div>
    <br>
    <div class="row">  <!--  4th row start -->
        <div class="col-md-12">

            <table class="table table-bordered" style="border-color: #ffffff;" width="100%" cellpadding="1"
                   cellspacing="1" border="1">
                @php
                    $total_grade_point = 0;
                    $total_subject = count($data);
                    $count_fail = 0;
                    foreach($data as $key => $mark) {
                        $get_mark = $mark->marks;
                        $grade_marks = App\Models\MarkGrade::where([['start_marks','<=', (int)$get_mark],['end_marks', '>=',(int)$get_mark ]])->first();
                        if($grade_marks == null || $grade_marks->grade_point == null){
                            $count_fail++;
                        }
                        $grade_point = number_format((float)$grade_marks->grade_point,2);
                        $total_grade_point += (float)$grade_point;
                    }
                    $grade_point_avg = $total_grade_point / $total_subject;
                    $total_grade = App\Models\MarkGrade::where([['start_point','<=',$grade_point_avg],['end_point','>=',$grade_point_avg]])->first();
                @endphp
                <tr>
                    <td width="50%"><strong>Grade Point Average</strong></td>
                    <td width="50%">
                        @if($count_fail > 0)
                            0.00
                        @else
                            {{ number_format((float)$grade_point_avg, 2) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="50%"><strong>Letter Grade </strong></td>
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
                    <td width="50%"><strong>{{ $total_marks }}</strong></td>
                </tr>
            </table>

        </div>
    </div>   <!--  End 4th row start -->


    <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
@endforeach


</body>
</html>
