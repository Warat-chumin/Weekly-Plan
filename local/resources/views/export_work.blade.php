<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url('{{ asset('fonts/THSarabunNew.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url('{{ asset('fonts/THSarabunNew Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url('{{ asset('fonts/THSarabunNew Italic.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url('{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}') format('truetype');
        }

        table,
        th,
        td {
            font-family: 'THSarabunNew';
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            font-family: 'THSarabunNew';
            padding: 5px;
            text-align: left;
        }

        body {
            font-family: 'THSarabunNew';
        }
    </style>
</head>

<body>

    <h1 align="center">Weely Plan</h1>

    @foreach ( $employee as $out_employee )
    <h3 align="center">
        ชื่อพนักงาน : {{ $out_employee->first_name }} {{ $out_employee->last_name }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        ตำแหน่ง : {{ $out_employee->position }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php $myDate = date('d/m/y'); ?>
        ยื่นวันที่ : {{ $myDate }}
    </h3>
    @endforeach
    <br>

    @foreach ( $events as $out_events )
    <table style="width:100%">
        {{-- <caption>{{ $out_events->start_date }} ถึง {{ $out_events->end_date }}</caption> --}}
        <tr>
            <?php
                $date = substr($out_events->start_date, 0, 10);
                $time_start = substr($out_events->start_date, 11, 5);
                $time_stop = substr($out_events->end_date, 11, 5);
                $day =  date("d/m/Y", strtotime($date));
            ?>
            <th width="15%">วันเวลา</th>
            <th width="85%">{{ $day }} เวลา {{ $time_start }} ถึง {{ $time_stop }}</th>
        </tr>
        <tr>
            <th>เรื่องที่พบ</th>
            <th>{{ $out_events->event_name }}</th>
        </tr>
        <tr>
            <th>บุคคลติดต่อ</th>
            <th>{{ $out_events->contact_person }}</th>
        </tr>
        <tr>
            <th>สถานที่</th>
            <th>{{$out_events->address}}</th>
        </tr>
        <tr>
            <th>หน่วยงาน</th>
            <th>{{ $out_events->name_customer }}</th>
        </tr>
        <tr>
            <th>หมายเหตุ</th>
            <th>{{ $out_events->note }}</th>
        </tr>
    </table>
    <br><br>
    @endforeach


</body>

</html>