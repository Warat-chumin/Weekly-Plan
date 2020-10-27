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

                        <h5>{{ $strDate }}</h5>
                    </div>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="#" class="btn btn-primary"><i class="ri-add-line mr-2"></i>เพิ่มแผนงาน</a>
                </div>
            </div>
            <div class="iq-card-body">
                {{-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and
            <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> --}}
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%">วันที่</th>
                                <th style="width:25%">โปรเจค</th>
                                <th style="width:15%">หัวข้อ</th>
                                <th style="width:5%">เริ่ม</th>
                                <th style="width:5%">จบ</th>
                                <th style="width:15%">บุคคลติดต่อ</th>
                                <th style="width:15%">หน่วยงาน</th>
                                <th style="width:15%">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $out_events)
                            <tr>
                                <?php
                            $date = substr($out_events->start_date, 0, 10);
                            $time_start = substr($out_events->start_date, 11, 5);
                            $time_stop = substr($out_events->end_date, 11, 5);

                            $day =  date("d/m/Y", strtotime($date));
                        ?>
                                <td>{{ $day }}</td>
                                <td>{{ $out_events->project_name }}</td>
                                <td>{{ $out_events->subject_name }}</td>
                                <td>{{ $time_start }}</td>
                                <td>{{ $time_stop }}</td>
                                <td>{{ $out_events->contact_person }}</td>
                                <td>{{ $out_events->customer_name }}</td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="รายละเอียด" href="#"><i class="ri-search-line"></i></a>
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="แก้ไข" href="#"><i class="ri-pencil-line"></i></a>
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="ยกเลิก" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
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
{{-- <script src="{{ asset('assets/js/shared/modal-demo.js')}}"></script> --}}
<script>
    $(function() {
          $('#datatable').DataTable({
            "aaSorting": [[ 0, "asc" ]]
       });
    });
</script>
@endsection
