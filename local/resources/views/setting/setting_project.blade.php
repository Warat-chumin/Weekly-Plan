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
                        <h5>ข้อมูลโปรเจค</h5>
                    </div>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ADD">เพิ่มโปรเจค</a>
                </div>
            </div>

            <div class="iq-card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                            <tr>
                                <th style="width:50%">ชื่อโปรเจค</th>
                                <th style="width:30%">ทีม</th>
                                <th style="width:20%">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project_member as $out_project_member)
                            <tr>
                                <td>{{ $out_project_member->name_project }}</td>
                                <td>{{ $out_project_member->name_team }}</td>
                                <td>
                                    @if($out_project_member->status == "0")
                                        <span class="badge bg-warning">รออนุมัติ</span>
                                    @elseif($out_project_member->status == "1")
                                        <span class="badge bg-success">&nbsp;&nbsp;อนุมัติ&nbsp;&nbsp;</span>
                                    @elseif($out_project_member->status == "2")
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


{{ Form::open(['method' => 'POST' , 'url' => 'setting/project/add']) }}
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
                                    {{ Form::text('name_project',NULL, ['class' => 'form-control','placeholder' => 'ชื่อโปรเจค','required']) }}
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
