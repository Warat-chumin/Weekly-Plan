@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('main')
<div class="row">
    <div class="col-sm-12">

        <div class="iq-card">
            <br>
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <div class="todo-date d-flex mr-3">
                        <h5><i class="ri-calendar-2-line text-primary mr-2"></i></h5>
                        <h5>จัดการข้อมูลลูกค้า</h5>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="user-list-files d-flex float-right">
                        <button type="submit" class="btn btn-success mb-3" style="font-size: 16px;" data-toggle="modal" data-target="#ADD">เพิ่มลูกค้า</button>
                      </div>
                 </div>
            </div>
            <div class="iq-card-body">
                {{-- <p>Take that same HTML, but use <code>.nav-pills</code> instead:</p> --}}
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab"
                            aria-controls="pills-all" aria-selected="true">ลูกค้าทั้งหมด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="false">รออนุมัติ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                            aria-controls="pills-profile" aria-selected="false">อนุมัติ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                            aria-controls="pills-contact" aria-selected="false">ไม่อนุมัติ</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent-2">
                    <br>
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="table-responsive">
                            <table id="datatable0" class="table">
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
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="datatable1" class="table">
                                    <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                                        <tr>
                                            <th style="width:15%">ชื่อคนขอ</th>
                                            <th style="width:10%">ตำแหน่ง</th>
                                            <th style="width:30%">ชื่อลูกค้า</th>
                                            <th style="width:15%">ประเภท</th>
                                            <th style="width:10%">ชนิดลูกค้า</th>
                                            <th style="width:20%">ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer_users_wait as $out_customer_users_wait)
                                        <tr>
                                            <td>{{ $out_customer_users_wait->first_name }}  {{ $out_customer_users_wait->last_name }}</td>
                                            <td>{{ $out_customer_users_wait->position }}</td>
                                            <td>{{ $out_customer_users_wait->name_customer }}</td>
                                            <td>{{ $out_customer_users_wait->type_customer_name }}</td>
                                            <td>
                                                @if($out_customer_users_wait->customer_status == '1')
                                                    ลูกค้าในระบบ
                                                @else
                                                    ลูกค้าใหม่
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#ACCEPT{{$out_customer_users_wait->id}}">&nbsp;&nbsp;อนุมัติ&nbsp;&nbsp;</button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#CANCEL{{$out_customer_users_wait->id}}">ไม่อนุมัติ</button>
                                               </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive">
                            <table id="datatable2" class="table">
                                <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                                    <tr>
                                        <th style="width:20%">ชื่อคนขอ</th>
                                        <th style="width:15%">ตำแหน่ง</th>
                                        <th style="width:35%">ชื่อลูกค้า</th>
                                        <th style="width:15%">ประเภท</th>
                                        <th style="width:15%">ชนิดลูกค้า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer_users_approve as $out_customer_users_approve)
                                    <tr>
                                        <td>{{ $out_customer_users_approve->first_name }}  {{ $out_customer_users_approve->last_name }}</td>
                                        <td>{{ $out_customer_users_approve->position }}</td>
                                        <td>{{ $out_customer_users_approve->name_customer }}</td>
                                        <td>{{ $out_customer_users_approve->type_customer_name }}</td>
                                        <td>
                                            @if($out_customer_users_approve->customer_status == '1')
                                                ลูกค้าในระบบ
                                            @else
                                                ลูกค้าใหม่
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="table-responsive">
                            <table id="datatable3" class="table">
                                <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                                    <tr>
                                        <th style="width:20%">ชื่อคนขอ</th>
                                        <th style="width:15%">ตำแหน่ง</th>
                                        <th style="width:35%">ชื่อลูกค้า</th>
                                        <th style="width:15%">ประเภท</th>
                                        <th style="width:15%">ชนิดลูกค้า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer_users_not_approve as $out_customer_users_not_approve)
                                    <tr>
                                        <td>{{ $out_customer_users_not_approve->first_name }}  {{ $out_customer_users_not_approve->last_name }}</td>
                                        <td>{{ $out_customer_users_not_approve->position }}</td>
                                        <td>{{ $out_customer_users_not_approve->name_customer }}</td>
                                        <td>{{ $out_customer_users_not_approve->type_customer_name }}</td>
                                        <td>
                                            @if($out_customer_users_not_approve->customer_status == '1')
                                                ลูกค้าในระบบ
                                            @else
                                                ลูกค้าใหม่
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

    </div>
</div>

@foreach ($customer_users_wait as $out_customer_users_wait)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/customer_approve/accept']) }}
<div class="modal fade" id="ACCEPT{{$out_customer_users_wait->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">อนุมัติ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อคนขอ</label>
                                <div class="col-sm-8">
                                    {{ Form::text('employee_code',$out_customer_users_wait->first_name ." ". $out_customer_users_wait->last_name, ['class' => 'form-control','placeholder' => 'ชื่อคนขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ตำแหน่ง</label>
                                <div class="col-sm-8">
                                    {{ Form::text('position',$out_customer_users_wait->position, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อลูกค้า</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_customer',$out_customer_users_wait->name_customer, ['class' => 'form-control','placeholder' => 'ชื่อลูกค้า','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ประเภท</label>
                                <div class="col-sm-8">
                                    {{ Form::text('type_customer_name',$out_customer_users_wait->type_customer_name, ['class' => 'form-control','placeholder' => 'ประเภท','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชนิดลูกค้า</label>
                                <div class="col-sm-8">
                                    @if($out_customer_users_wait->customer_status == '1')
                                        <?php $type_cus = 'ลูกค้าในระบบ' ?>
                                    @else
                                        <?php $type_cus = 'ลูกค้าใหม่' ?>
                                    @endif
                                    {{ Form::text('type_cus',$type_cus, ['class' => 'form-control','placeholder' => 'ชนิดลูกค้า','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">เวลาที่ขอ</label>
                                <div class="col-sm-8">
                                    {{ Form::text('updated_at',$out_customer_users_wait->updated_at, ['class' => 'form-control','placeholder' => 'เวลาที่ขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::hidden('id',$out_customer_users_wait->id, ['class' => 'form-control']) }}
            {{ Form::hidden('code_customer',$out_customer_users_wait->code_customer, ['class' => 'form-control']) }}
            {{ Form::hidden('employee_code',$out_customer_users_wait->employee_code, ['class' => 'form-control']) }}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">อนุมัติ</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@endforeach

@foreach ($customer_users_wait as $out_customer_users_wait)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/customer_approve/cancel']) }}
<div class="modal fade" id="CANCEL{{$out_customer_users_wait->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">ไม่อนุมัติ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อคนขอ</label>
                                <div class="col-sm-8">
                                    {{ Form::text('employee_code',$out_customer_users_wait->first_name ." ". $out_customer_users_wait->last_name, ['class' => 'form-control','placeholder' => 'ชื่อคนขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ตำแหน่ง</label>
                                <div class="col-sm-8">
                                    {{ Form::text('position',$out_customer_users_wait->position, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อลูกค้า</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_customer',$out_customer_users_wait->name_customer, ['class' => 'form-control','placeholder' => 'ชื่อลูกค้า','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ประเภท</label>
                                <div class="col-sm-8">
                                    {{ Form::text('type_customer_name',$out_customer_users_wait->type_customer_name, ['class' => 'form-control','placeholder' => 'ประเภท','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชนิดลูกค้า</label>
                                <div class="col-sm-8">
                                    @if($out_customer_users_wait->customer_status == '1')
                                        <?php $type_cus = 'ลูกค้าในระบบ' ?>
                                    @else
                                        <?php $type_cus = 'ลูกค้าใหม่' ?>
                                    @endif
                                    {{ Form::text('type_cus',$type_cus, ['class' => 'form-control','placeholder' => 'ชนิดลูกค้า','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">เวลาที่ขอ</label>
                                <div class="col-sm-8">
                                    {{ Form::text('updated_at',$out_customer_users_wait->updated_at, ['class' => 'form-control','placeholder' => 'เวลาที่ขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">หมายเหตุ</label>
                                <div class="col-sm-10">
                                    {{ Form::text('note',null, ['class' => 'form-control','placeholder' => 'รายละเอียด']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::hidden('id',$out_customer_users_wait->id, ['class' => 'form-control']) }}
            {{ Form::hidden('code_customer',$out_customer_users_wait->code_customer, ['class' => 'form-control']) }}
            {{ Form::hidden('employee_code',$out_customer_users_wait->employee_code, ['class' => 'form-control']) }}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-danger">ไม่อนุมัติ</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@endforeach


@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

{{ Form::open(['method' => 'POST' , 'url' => 'setting/customer_approve/add']) }}
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
                                    {{ Form::text('name_customer',NULL, ['class' => 'form-control','placeholder' => 'ชื่อลูกค้า']) }}
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

<script>
    $(function() {
          $('#datatable0').DataTable({
            "aaSorting": [[ 0, "asc" ]]
       });
    });
</script>

<script>
    $(function() {
          $('#datatable1').DataTable({
            "aaSorting": [[ 0, "asc" ]]
       });
    });
</script>

<script>
    $(function() {
          $('#datatable2').DataTable({
            "aaSorting": [[ 0, "asc" ]]
       });
    });
</script>

<script>
    $(function() {
          $('#datatable3').DataTable({
            "aaSorting": [[ 0, "asc" ]]
       });
    });
</script>
@endsection

