@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">

@endsection

@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-body">
                {{ Form::open(['id' => 'form_export', 'method' => 'POST' , 'url' => 'weekly_plan/export/'.Auth::user()->employee_code, 'target' => '_blank']) }}
                <div class="row flex-grow mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>วันที่เริ่ม</label>
                            <input class="form-control form-control-sm" type="date" name="date_start" id="date_start"
                                placeholder="วันที่เริ่ม" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>วันที่จบ</label>
                            <input class="form-control form-control-sm" type="date" name="date_end" id="date_end"
                                placeholder="วันที่จบ" required>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">

                        <button type="button" class="btn btn-danger btn-sm" name="clearBtn" id="clearBtn">Clear</button>
                        <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal"
                            data-target="#EXPORT">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> บันทึกเป็น PDF </button>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                            <tr>
                                <th style="width: 5%">ลำดับ</th>
                                <th style="width: 8%">วันที่เริ่ม</th>
                                <th style="width: 8%">เวลาเริ่ม</th>
                                <th style="width: 8%">วันที่จบ</th>
                                <th style="width: 8%">เวลาจบ</th>
                                <th style="width: 23%">เรื่องที่พบ</th>
                                <th style="width: 20%">บุคคลติดต่อ</th>
                                <th style="width: 20%">หน่วยงาน</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- {{ Form::open(['method' => 'POST' , 'url' => 'weekly_plan/export/'.Auth::user()->employee_code, 'target' => '_blank']) }}
<div class="modal fade" id="EXPORT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title">บันทึกเป็น PDF</h4>
                <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i
                        class="mdi mdi-close"></i></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">วันที่เริ่ม</label>
                                <div class="col-sm-9">
                                    {{ Form::date('date_start',null, ['class' => 'form-control form-control-sm','placeholder' => 'วันที่เริ่ม','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">วันที่สิ้นสุด</label>
                                <div class="col-sm-9">
                                    {{ Form::date('date_end',null, ['class' => 'form-control form-control-sm','placeholder' => 'วันที่สิ้นสุด','required']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">ส่งออก</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }} --}}
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

<script>
    $(function() {
        var table = $('#table').DataTable({
            lengthMenu: [[10,20, 50, 100, -1], [10,20, 50, 100, "All"]],
            processing: true,
            responsive: true,
            'language':{ 
                "loadingRecords": "&nbsp;",
                "processing": "Loading..."
            },
            // serverSide: true,
            sortable: true,
            searchable: true,
            ajax: {
                url: 'report/event',
                contentType: "application/json",
                type: "GET",
            },
            columns: [
                { data: 'id', name: 'id', searchable: false},
                { data: 'start_date', name: 'start_date' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'event_name', name: 'event_name' },
                { data: 'contact_person', name: 'contact_person' },
                { data: 'customer_name', name: 'customer_name' },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    "targets": 1,
                    "type": "date-uk",
                    render: function(data, type, row)
                    {
                        var c = new Date(data);
                        if(!isNaN(c)) {
                            var t = data.split('/');
                            return "<span style='display:none;'>"+t+"</span>"+c.toLocaleDateString();
                        } else {
                            return "";
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 2,
                    render: function(data, type, row)
                    {
                        var c = new Date(data);
                        if(!isNaN(c)) {
                            var t = data.split('/');
                            var h = c.getHours();
                            var m = c.getMinutes();
                            var s = c.getSeconds();
                            var ms = c.getMilliseconds();
                            if(h < 10) {
                                h = "0"+h;
                            }
                            if(m <10) {
                                m = "0"+m;
                            }
                            // alert(data);
                            // var t = data.split('/');
                            return "<span style='display:none;'>"+t+"</span>"+h+":"+m;
                        } else {
                            return "";
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 3,
                    "type": "date-uk",
                    render: function(data, type, row)
                    {
                        var c = new Date(data);
                        if(!isNaN(c)) {
                            var t = data.split('/');
                            return "<span style='display:none;'>"+t+"</span>"+c.toLocaleDateString();
                        } else {
                            return "";
                        }
                    },
                    "className": "text-center",
                    
                },
                {
                    "targets": 4,
                    render: function(data, type, row)
                    {
                        var c = new Date(data);
                        if(!isNaN(c)) {
                            var t = data.split('/');
                            var h = c.getHours();
                            var m = c.getMinutes();

                            if(h < 10) {
                                h = "0"+h;
                            }
                            if(m <10) {
                                m = "0"+m;
                            }

                            // var t = data.split('/');
                            return "<span style='display:none;'>"+t+"</span>"+h+":"+m;
                        } else {
                            return "";
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 5,
                },
                {
                    "targets": 6,
                },                
                {
                    "targets": 7,
                }
            ],
            "order": [[ 1, 'asc' ]]
        });

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $("#date_start").change(function () {
            if($("#date_end").val().length != 0){
                var date_start = $("#date_start").val();
                var date_end = $("#date_end").val();
                var query_string = $.param({"start_date" : date_start, "end_date" : date_end})
                var ajax_source = "report/eventbydate?" + query_string;
                table.ajax.url(ajax_source).load();
            }
        });

        $("#date_end").change(function () {
            if($("#date_start").val().length != 0){
                var date_start = $("#date_start").val();
                var date_end = $("#date_end").val();
                var query_string = $.param({"start_date" : date_start, "end_date" : date_end})
                var ajax_source = "report/eventbydate?" + query_string;
                table.ajax.url(ajax_source).load();
            }
        });

        $("#clearBtn").click(function() {
                var date_start = $("#date_start").val();
                var date_end = $("#date_end").val();
                var query_string = $.param({"start_date" : date_start, "end_date" : date_end})
                var ajax_source = "report/event";
                table.ajax.url(ajax_source).load();
                $("#date_start").val("");
                $("#date_end").val("");
        });
    });
</script>

@endsection