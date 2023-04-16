<!DOCTYPE html>
<html>
<head>
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


<table id="customers">
    <tr>
        <td><h2>
                <?php $image_path = '/uploads/logo.png'; ?>
                <img src="{{ public_path() . $image_path }}" alt="" width="200">

            </h2></td>
        <td><h2>Easy School ERP</h2>
            <p>School Address</p>
            <p>Phone : 343434343434</p>
            <p>Email : support@easylerningbd.com</p>
            <p><b> Student Registration Fee</b></p>

        </td>
    </tr>


</table>

@php
    $fee_category_id = \App\Models\FeeCategory::where('name', 'LIKE', '%registration%')->value('id');
       $registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$details->class_id)->first();
       $originalfee = $registrationfee->amount ??0;
               $discount = $details['discount']['discount'];
               $discounttablefee = $discount/100*$originalfee;
               $finalfee = (float)$originalfee-(float)$discounttablefee;

@endphp

<table id="customers">
    <tr>
        <th width="10%">Sl</th>
        <th width="45%">Student Details</th>
        <th width="45%">Student Data</th>
    </tr>
    <tr>
        <td>1</td>
        <td><b>Student ID No</b></td>
        <td>{{ $details['student']['id_no'] }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td><b>Roll No</b></td>
        <td>{{ $details['student']['roll'] }}</td>
    </tr>

    <tr>
        <td>3</td>
        <td><b>Student Name</b></td>
        <td>{{ $details['student']['name'] }}</td>
    </tr>

    <tr>
        <td>4</td>
        <td><b>Father's Name</b></td>
        <td>{{ $details['student']['father_name'] }}</td>
    </tr>
    <tr>
        <td>5</td>
        <td><b>Session</b></td>
        <td>{{ $details['year']['name'] }}</td>
    </tr>
    <tr>
        <td>6</td>
        <td><b>Class </b></td>
        <td>{{ $details['class']['name'] }}</td>
    </tr>
    <tr>
        <td>7</td>
        <td><b>Registration Fee</b></td>
        <td>{{ $originalfee }} $</td>
    </tr>
    <tr>
        <td>8</td>
        <td><b>Discount Fee </b></td>
        <td>{{ $discount  }} %</td>
    </tr>

    <tr>
        <td>9</td>
        <td><b>Fee For this Student </b></td>
        <td>{{ $finalfee }} $</td>
    </tr>


</table>
<br>


<hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 0px">
<br>
<table id="customers">
    <tr>
        <th width="10%">Sl</th>
        <th width="45%">Student Details</th>
        <th width="45%">Student Data</th>
    </tr>
    <tr>
        <td>1</td>
        <td><b>Student ID No</b></td>
        <td>{{ $details['student']['id_no'] }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td><b>Roll No</b></td>
        <td>{{ $details['student']['roll']}}</td>
    </tr>

    <tr>
        <td>3</td>
        <td><b>Student Name</b></td>
        <td>{{ $details['student']['name'] }}</td>
    </tr>

    <tr>
        <td>4</td>
        <td><b>Father's Name</b></td>
        <td>{{ $details['student']['father_name'] }}</td>
    </tr>
    <tr>
        <td>5</td>
        <td><b>Session</b></td>
        <td>{{ $details['year']['name'] }}</td>
    </tr>
    <tr>
        <td>6</td>
        <td><b>Class </b></td>
        <td>{{ $details['class']['name'] }}</td>
    </tr>
    <tr>
        <td>7</td>
        <td><b>Registration Fee</b></td>
        <td>{{ $originalfee }} $</td>
    </tr>
    <tr>
        <td>8</td>
        <td><b>Discount Fee </b></td>
        <td>{{ $discount  }} %</td>
    </tr>

    <tr>
        <td>9</td>
        <td><b>Fee For this Student </b></td>
        <td>{{ $finalfee }} $</td>
    </tr>


</table>

</body>
</html>