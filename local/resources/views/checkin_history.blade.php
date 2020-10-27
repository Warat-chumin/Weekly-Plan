@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <br>
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <div class="todo-date d-flex mr-3">
                        <h5><i class="ri-calendar-2-line text-primary mr-2"></i></h5>
                        <?php
                          $ThDay = array ( "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์" );
                          $week = date( "w" ); // ค่าวันในสัปดาห์ (0-6)
                          $day = $ThDay[$week];
                          $strYear = date("Y")+543;
                          $strMonth= date("n");
                          $strDay= date("j");
                          $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                          $strMonthThai=$strMonthCut[$strMonth];
                          $strDate = "วัน".$day .", ". $strDay ." ". $strMonthThai ." ". $strYear;
                        ?>

                        <h5>สรุปการเข้าออกงานประจำ{{ $strDate }}</h5>
                    </div>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%">โปรไฟล์</th>
                                <th style="width:19%">ชื่อพนักงาน</th>
                                <th style="width:10%">ตำแหน่ง</th>
                                <th style="width:5%">เข้า</th>
                                <th style="width:5%">ออก</th>
                                <th style="width:28%">สถานที่เข้างาน</th>
                                <th style="width:28%">สถานที่ออกงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $out_employee)
                            <tr>
                                <td class="text-center">
                                    <span class="pro-pic">
                                        @if($out_employee->profile_pic == NULL)
                                            <img class="rounded-circle img-fluid avatar-40" src="{{ url('/images/user/user-7.jpg') }}" alt="profile">
                                        @else
                                            <img class="rounded-circle img-fluid avatar-40" src="{{ url('assets/profile').'/'. $out_employee->profile_pic }}" alt="profile">
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $out_employee->first_name }}  {{ $out_employee->last_name }}</td>
                                <td>{{ $out_employee->position }}</td>

                                <?php
                                    $time_start = "-";
                                    $time_stop = "-";
                                    $address_start = "-";
                                    $address_stop = "-";
                                ?>

                                @foreach ($checkin as $out_checkin)
                                    @if($out_checkin->employee_code == $out_employee->employee_code)
                                        @if($out_checkin->status == 'ลงเวลาเข้างาน')
                                            <?php
                                                $time_start = date("H:i:s", strtotime($out_checkin->timestamp));
                                                $address_start = $out_checkin->address;
                                            ?>
                                        @endif

                                        @if($out_checkin->status == 'ลงเวลาเลิกงาน')
                                        <?php
                                            $time_stop = date("H:i:s", strtotime($out_checkin->timestamp));
                                            $address_stop = $out_checkin->address;
                                        ?>
                                        @endif
                                    @endif
                                @endforeach

                                <td>{{ $time_start }}</td>
                                <td>{{ $time_stop }}</td>
                                <td>{{ $address_start }}</td>
                                <td>{{ $address_stop }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
          $('#datatable').DataTable();
    });
</script>
@endsection
