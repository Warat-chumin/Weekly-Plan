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
                        <h5>ข้อมูลลูกค้า</h5>
                    </div>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#SELECT">เลือกลูกค้า</a>&nbsp;
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ADD">เพิ่มลูกค้า</a>
                </div>
            </div>

            <div class="iq-card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                            <tr>
                                <th style="width:50%">ชื่อลูกค้า</th>
                                <th style="width:30%">ประเภท</th>
                                <th style="width:20%">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer_users as $out_customer_users)
                            <tr>
                                <td>{{ $out_customer_users->name_customer }}</td>
                                <td>{{ $out_customer_users->type_customer_name }}</td>
                                <td>
                                    @if($out_customer_users->status == "0")
                                        <span class="badge bg-warning">รออนุมัติ</span>
                                    @elseif($out_customer_users->status == "1")
                                        <span class="badge bg-success">&nbsp;&nbsp;อนุมัติ&nbsp;&nbsp;</span>
                                    @elseif($out_customer_users->status == "2")
                                        <span class="badge bg-danger">ไม่อนุมัติ</span>
                                    @endif
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


{{ Form::open(['method' => 'POST' , 'url' => 'setting/customer/add']) }}
<div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">เพิ่มลูกค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">ชื่อลูกค้า</label>
                                <div class="col-sm-10">
                                    {{ Form::text('name_customer',NULL, ['class' => 'form-control','placeholder' => 'ชื่อลูกค้า','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">ประเภท</label>
                                <div class="control-label col-sm-10 align-self-center mb-0">
                                    <select class="form-control"  name="type_customer" id="type_customers" >
                                        @foreach ($type_customers as $out_type_customers)
                                            <option value={{ $out_type_customers->id }}>{{ $out_type_customers->type_customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">&nbsp;&nbsp;เพิ่ม&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

{{ Form::open(['method' => 'POST' , 'url' => 'setting/customer/select']) }}
<div class="modal fade" id="SELECT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">เลือกลูกค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">ชื่อลูกค้า</label>
                                <div class="control-label col-sm-10 align-self-center mb-0">
                                    <select class="form-control"  name="name_customer" id="name_customer" >
                                        @foreach ($customer as $out_customer)
                                            <option value={{ $out_customer->code_customer }}>{{ $out_customer->name_customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">&nbsp;&nbsp;เลือก&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}


@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
          $('#datatable').DataTable({
            "aaSorting": [[ 0, "asc" ]]
       });
    });
</script>
@endsection
