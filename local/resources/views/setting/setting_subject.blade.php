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
                        <h5>จัดการข้อมูลหัวข้อ</h5>
                    </div>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ADD"><i class="ri-add-line mr-2"></i>เพิ่มแผนงาน</a>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                            <tr>
                                <th style="width:15%">ลำดับ</th>
                                <th style="width:50%">หัวข้อ</th>
                                <th style="width:20%">สี</th>
                                <th style="width:15%">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1 ?>
                            @foreach ($subject as $out_subject)
                            <tr>
                                <td align="center">{{ $count }}</td>
                                <td>{{ $out_subject->name_subject }}</td>
                                <td>{{ Form::color('color_code',$out_subject->color_code, ['class' => 'form-control','placeholder' => 'สีแสดงผล','style' => 'background-color: white;','disabled']) }}</td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary" href="#" data-toggle="modal" data-target="#EDIT{{ $out_subject->id }}"><i class="ri-pencil-line"></i></a>
                                          <a class="iq-bg-danger"href="#" data-toggle="modal" data-target="#DELETE{{ $out_subject->id }}"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $count = $count + 1 ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{ Form::open(['method' => 'POST' , 'url' => 'setting/subject/add']) }}
<div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">เพิ่มหัวข้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">ชื่อหัวข้อ</label>
                                <div class="col-sm-10">
                                    {{ Form::text('name_subject',NULL, ['class' => 'form-control','placeholder' => 'ชื่อหัวข้อ','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">สีหัวข้อ</label>
                                <div class="col-sm-10">
                                    {{ Form::color('color_code',NULL, ['class' => 'form-control','placeholder' => 'สีแสดงผล','required']) }}
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

@foreach ($subject as $out_subject)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/subject/edit/'.$out_subject->id]) }}
<div class="modal fade" id="EDIT{{$out_subject->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">ชื่อหัวข้อ</label>
                                <div class="col-sm-10">
                                    {{ Form::text('name_subject',$out_subject->name_subject, ['class' => 'form-control','placeholder' => 'ชื่อหัวข้อ','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">สีหัวข้อ</label>
                                <div class="col-sm-10">
                                    {{ Form::color('color_code',$out_subject->color_code, ['class' => 'form-control','placeholder' => 'สีแสดงผล','required']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@endforeach

@foreach ($subject as $out_subject)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/subject/delete/'.$out_subject->id]) }}
<div class="modal fade" id="DELETE{{$out_subject->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">ลบหัวข้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">ชื่อหัวข้อ</label>
                                <div class="col-sm-10">
                                    {{ Form::text('name_subject',$out_subject->name_subject, ['class' => 'form-control','placeholder' => 'ชื่อหัวข้อ','required','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">สีหัวข้อ</label>
                                <div class="col-sm-10">
                                    {{ Form::color('color_code',$out_subject->color_code, ['class' => 'form-control','placeholder' => 'สีแสดงผล','style' => 'background-color: white;','disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-danger">&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@endforeach

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
