<!DOCTYPE html>
<html lang="eng">
<head>
    <title>ID CARD</title>
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
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            white-space: nowrap;
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
            <p><b>Student ID Card </b></p>

        </td>
    </tr>


</table>

@foreach($allData as $value)

    <table id="customers">
        <tr align="center">
            <td rowspan="4">

                    <?php $image_path = '/uploads/no-image.png'; ?>
                <img src="{{ public_path() . $image_path }}" alt="" width="100" >

            </td>
            <td colspan="2">Easy School</td>
        </tr>
        <tr>
            <td colspan="2">Student Id Card</td>
        </tr>
        <tr>
            <td>Name : {{ $value['student']['name'] }}</td>
            <td>Session : {{ $value['year']['name'] }}</td>
        </tr>
        <tr>
            <td>Roll : {{ $value['student']['roll'] }} </td>
            <td>ID No : {{ $value['student']['id_no'] }}</td>
        </tr>
        <tr>
            <td colspan="3">Class : {{ $value['class']['name'] }}</td>
        </tr>
        <tr>
            <td colspan="3">Mobile:{{ $value['student']['phone'] }} </td>
        </tr>
    </table>

@endforeach







</body>
</html>
