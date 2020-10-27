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
                        <h5><i class="ri-time-line text-primary mr-2"></i></h5>
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

                        <h5>
                            บันทึกการลงเวลาเข้า - ออกงาน
                            {{-- {{ $strDate }} --}}
                        </h5>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6">
                    <div class="user-list-files d-flex float-right">
                        <form action="{{ url('check_in/add_in') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success mb-3" style="font-size: 16px;">&nbsp;Check in&nbsp;</button>
                            <input type="hidden" value="ลงเวลาเข้างาน" name="check">
                            <input type="hidden" id="latitude_checkin" name="latitude">
                            <input type="hidden" id="longitude_checkin" name="longitude">
                        </form>
                        &nbsp;&nbsp;
                        <form action="{{ url('check_in/add_out') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger mb-3" style="font-size: 16px;">Check out</button>
                            <input type="hidden" value="ลงเวลาเลิกงาน" name="check">
                            <input type="hidden" id="latitude_checkout"name="latitude">
                            <input type="hidden" id="longitude_checkout" name="longitude">
                        </form>
                      </div>
                 </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table id="Check-inTable" class="table">
                        <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                            <tr>
                                <th style="width:5%">ลำดับ</th>
                                <th style="width:5%">สถานะ</th>
                                <th style="width:13%">วันที่</th>
                                <th style="width:10%">เวลา</th>
                                <th style="width:67%">สถานที่ลงเวลาทำงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1 ?>
                            @foreach ($checkin as $out_checkin)
                            <tr>
                                <?php
                                    $date_data = date("m/d/Y",strtotime($out_checkin->timestamp));
                                    $time_current = date("H:i:s",strtotime($out_checkin->timestamp));

                                    $strYear = date("Y",strtotime($date_data))+543;
                                    $strMonth= date("n",strtotime($date_data));
                                    $strDay= date("j",strtotime($date_data));
                                    // $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                                    $strMonthThai=$strMonthCut[$strMonth];
                                    $strDate = $strDay ." ". $strMonthThai ." ". $strYear;
                                ?>
                                <td align="center">{{ $count }}</td>
                                <td>
                                    @if($out_checkin->status == "ลงเวลาเข้างาน")
                                        <span class="badge iq-bg-success">Check-in&nbsp;&nbsp;</span>
                                    @elseif($out_checkin->status == "ลงเวลาเลิกงาน")
                                        <span class="badge iq-bg-danger">Check-out</span>
                                    @endif
                                </td>
                                <td>{{ $strDate }}</td>
                                <td>{{ $time_current }}</td>
                                <td>{{ $out_checkin->address }}</td>
                                <?php $count = $count + 1 ?>
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
    $(document).ready( function () {
        $('#Check-inTable').DataTable({
            // "aaSorting": [[ 2, "desc" ]]
            // "aaSorting": ["bSortable": false]
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    showPosition(position);
                },
                function(error){
                    alert(error.message);
                }, {
                    enableHighAccuracy: true
                        ,timeout : 5000
                }
            );
        }

    } );
</script>
<script>
    function showPosition(position) {
        $('#latitude_checkin').val(position.coords.latitude);
        $('#latitude_checkout').val(position.coords.latitude);
        $('#longitude_checkin').val(position.coords.longitude);
        $('#longitude_checkout').val(position.coords.longitude);
    }
</script>
@endsection
