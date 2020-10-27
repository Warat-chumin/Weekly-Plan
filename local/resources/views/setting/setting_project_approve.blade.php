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
                        <h5>จัดการข้อมูลโปรเจค</h5>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="user-list-files d-flex float-right">
                        <button type="submit" class="btn btn-success mb-3" style="font-size: 16px;" data-toggle="modal" data-target="#ADD">เพิ่มโปรเจค</button>
                      </div>
                 </div>
            </div>
            <div class="iq-card-body">
                {{-- <p>Take that same HTML, but use <code>.nav-pills</code> instead:</p> --}}
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab"
                            aria-controls="pills-all" aria-selected="true">โปรเจคทั้งหมด</a>
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
                                        <th style="width:50%">ชื่อโปรเจค</th>
                                        <th style="width:30%">ทีม</th>
                                        <th style="width:20%">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project as $out_project)
                                    <tr>
                                        <td>{{ $out_project->name_project }}</td>
                                        <td>{{ $out_project->name_team }}</td>
                                        <td>
                                            @if($out_project->status == "0")
                                                <span class="badge bg-warning">รออนุมัติ</span>
                                            @elseif($out_project->status == "1")
                                                <span class="badge bg-success">&nbsp;&nbsp;อนุมัติ&nbsp;&nbsp;</span>
                                            @elseif($out_project->status == "2")
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
                                            <th style="width:25%">ชื่อคนขอ</th>
                                            <th style="width:10%">ตำแหน่ง</th>
                                            <th style="width:30%">ชื่อโปรเจค</th>
                                            <th style="width:15%">ทีม</th>
                                            <th style="width:20%">ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project_member_wait as $out_project_member_wait)
                                        <tr>
                                            <td>{{ $out_project_member_wait->first_name }}  {{ $out_project_member_wait->last_name }}</td>
                                            <td>{{ $out_project_member_wait->position }}</td>
                                            <td>{{ $out_project_member_wait->name_project }}</td>
                                            <td>{{ $out_project_member_wait->name_team }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#ACCEPT{{$out_project_member_wait->id}}">&nbsp;&nbsp;อนุมัติ&nbsp;&nbsp;</button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#CANCEL{{$out_project_member_wait->id}}">ไม่อนุมัติ</button>
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
                                        <th style="width:25%">ชื่อคนขอ</th>
                                        <th style="width:20%">ตำแหน่ง</th>
                                        <th style="width:30%">ชื่อโปรเจค</th>
                                        <th style="width:25%">ทีม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project_member_approve as $out_project_member_approve)
                                    <tr>
                                        <td>{{ $out_project_member_approve->first_name }}  {{ $out_project_member_approve->last_name }}</td>
                                        <td>{{ $out_project_member_approve->position }}</td>
                                        <td>{{ $out_project_member_approve->name_project }}</td>
                                        <td>{{ $out_project_member_approve->name_team }}</td>
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
                                        <th style="width:25%">ชื่อคนขอ</th>
                                        <th style="width:20%">ตำแหน่ง</th>
                                        <th style="width:30%">ชื่อโปรเจค</th>
                                        <th style="width:25%">ทีม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project_member_not_approve as $out_project_member_not_approve)
                                    <tr>
                                        <td>{{ $out_project_member_not_approve->first_name }}  {{ $out_project_member_not_approve->last_name }}</td>
                                        <td>{{ $out_project_member_not_approve->position }}</td>
                                        <td>{{ $out_project_member_not_approve->name_project }}</td>
                                        <td>{{ $out_project_member_not_approve->name_team }}</td>
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

@foreach ($project_member_wait as $out_project_member_wait)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/project_approve/accept']) }}
<div class="modal fade" id="ACCEPT{{$out_project_member_wait->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                    {{ Form::text('employee_code',$out_project_member_wait->first_name ." ". $out_project_member_wait->last_name, ['class' => 'form-control','placeholder' => 'ชื่อคนขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ตำแหน่ง</label>
                                <div class="col-sm-8">
                                    {{ Form::text('position',$out_project_member_wait->position, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">โปรเจค</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_project',$out_project_member_wait->name_project, ['class' => 'form-control','placeholder' => 'โปรเจค','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ทีม</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_team',$out_project_member_wait->name_team, ['class' => 'form-control','placeholder' => 'ทีม','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">เวลาที่ขอ</label>
                                <div class="col-sm-8">
                                    {{ Form::text('updated_at',$out_project_member_wait->updated_at, ['class' => 'form-control','placeholder' => 'เวลาที่ขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::hidden('id',$out_project_member_wait->id, ['class' => 'form-control']) }}
            {{ Form::hidden('code_project',$out_project_member_wait->code_project, ['class' => 'form-control']) }}
            {{ Form::hidden('code_team',$out_project_member_wait->code_team, ['class' => 'form-control']) }}
            {{ Form::hidden('employee_code',$out_project_member_wait->employee_code, ['class' => 'form-control']) }}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">อนุมัติ</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@endforeach

@foreach ($project_member_wait as $out_project_member_wait)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/project_approve/cancel']) }}
<div class="modal fade" id="CANCEL{{$out_project_member_wait->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                    {{ Form::text('employee_code',$out_project_member_wait->first_name ." ". $out_project_member_wait->last_name, ['class' => 'form-control','placeholder' => 'ชื่อคนขอ','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ตำแหน่ง</label>
                                <div class="col-sm-8">
                                    {{ Form::text('position',$out_project_member_wait->position, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">โปรเจค</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_project',$out_project_member_wait->name_project, ['class' => 'form-control','placeholder' => 'โปรเจค','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ทีม</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_team',$out_project_member_wait->name_team, ['class' => 'form-control','placeholder' => 'ทีม','style' => 'background-color: white;','readonly']) }}
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
            {{ Form::hidden('id',$out_project_member_wait->id, ['class' => 'form-control']) }}
            {{ Form::hidden('code_project',$out_project_member_wait->code_project, ['class' => 'form-control']) }}
            {{ Form::hidden('code_team',$out_project_member_wait->code_team, ['class' => 'form-control']) }}
            {{ Form::hidden('employee_code',$out_project_member_wait->employee_code, ['class' => 'form-control']) }}
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

{{ Form::open(['method' => 'POST' , 'url' => 'setting/project_approve/add']) }}
<div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">เพิ่มโปรเจค</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">ชื่อโปรเจค</label>
                                <div class="col-sm-9">
                                    {{ Form::text('name_project',NULL, ['class' => 'form-control','placeholder' => 'ชื่อโปรเจค']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">ทีม</label>
                                <div class="control-label col-sm-9 align-self-center mb-0">
                                    <select class="form-control"  name="code_team" id="code_team" >
                                        @foreach ($team as $out_team)
                                            <option value={{ $out_team->code_team }}>{{ $out_team->name_team }}</option>
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

