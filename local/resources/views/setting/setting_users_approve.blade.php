@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('main')
<div class="row">
    <div class="col-sm-12">

        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">ตั้งค่าการอนุมัติผู้ใช้งาน</h4>
                </div>
            </div>
            <div class="iq-card-body">
                {{-- <p>Take that same HTML, but use <code>.nav-pills</code> instead:</p> --}}
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="true">รออนุมัติ</a>
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
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="datatable1" class="table">
                                    <thead class="thead-info text-center" style="background-color: rgb(0,144,255); color:#fff;">
                                        <tr>
                                            <th style="width:20%">รหัสพนักงาน</th>
                                            <th style="width:25%">ชื่อผู้ใช้งาน</th>
                                            <th style="width:20%">อีเมล</th>
                                            <th style="width:15%">ประเภทผู้ใช้</th>
                                            <th style="width:20%">ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_wait as $out_users_wait)
                                        <tr>
                                            <td>{{ $out_users_wait->employee_code }}</td>
                                            <td>{{ $out_users_wait->username }}</td>
                                            <td>{{ $out_users_wait->email }}</td>
                                            <td>{{ $out_users_wait->name_type_users }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#ACCEPT{{$out_users_wait->employee_code}}">&nbsp;&nbsp;อนุมัติ&nbsp;&nbsp;</button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#CANCEL{{$out_users_wait->employee_code}}">ไม่อนุมัติ</button>
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
                            <table id="datatable2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:20%">รหัสพนักงาน</th>
                                        <th style="width:25%">ชื่อผู้ใช้งาน</th>
                                        <th style="width:25%">อีเมล</th>
                                        <th style="width:15%">ประเภทผู้ใช้</th>
                                        <th style="width:15%">ทีม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users_approve as $out_users_approve)
                                    <tr data-toggle="modal" data-target="#DETAIL{{$out_users_approve->employee_code}}">
                                        <td>{{ $out_users_approve->employee_code }}</td>
                                        <td>{{ $out_users_approve->username }}</td>
                                        <td>{{ $out_users_approve->email }}</td>
                                        <td>{{ $out_users_approve->name_type_users }}</td>
                                        <td>{{ $out_users_approve->name_team }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="table-responsive">
                            <table id="datatable3" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:20%">รหัสพนักงาน</th>
                                        <th style="width:25%">ชื่อผู้ใช้งาน</th>
                                        <th style="width:25%">อีเมล</th>
                                        <th style="width:15%">ประเภทผู้ใช้</th>
                                        <th style="width:15%">ทีม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users_not_approve as $out_users_not_approve)
                                    <tr data-toggle="modal" data-target="#DETAIL{{$out_users_not_approve->employee_code}}">
                                        <td>{{ $out_users_not_approve->employee_code }}</td>
                                        <td>{{ $out_users_not_approve->username }}</td>
                                        <td>{{ $out_users_not_approve->email }}</td>
                                        <td>{{ $out_users_not_approve->name_type_users }}</td>
                                        <td>{{ $out_users_not_approve->name_team }}</td>
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

@foreach ($users_all as $out_users)
<div class="modal fade" id="DETAIL{{$out_users->employee_code}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="myModalLabel">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">รหัสพนักงาน</label>
                                <div class="col-sm-8">
                                    {{ Form::text('employee_code',$out_users->employee_code, ['class' => 'form-control','placeholder' => 'รหัสพนักงาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อผู้ใช้งาน</label>
                                <div class="col-sm-8">
                                    {{ Form::text('username',$out_users->username, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">อีเมล</label>
                                <div class="col-sm-8">
                                    {{ Form::text('email',$out_users->email, ['class' => 'form-control','placeholder' => 'อีเมล','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ประเภทผู้ใช้</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_type_users',$out_users->name_type_users, ['class' => 'form-control','placeholder' => 'ประเภทผู้ใช้','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ทีม</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_team',$out_users->name_team, ['class' => 'form-control','placeholder' => 'ทีม','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">แก้ไขล่าสุด</label>
                                <div class="col-sm-8">
                                    {{ Form::text('updated_at',$out_users->updated_at, ['class' => 'form-control','placeholder' => 'แก้ไขล่าสุด','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($out_users->note != NULL)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0">หมายเหตุ</label>
                                <div class="col-sm-10">
                                    {{ Form::text('note',$out_users->note, ['class' => 'form-control','placeholder' => 'หมายเหตุ','style' => 'background-color: white; color: red;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">อนุมัติ</button>
            </div> --}}
        </div>
    </div>
</div>
@endforeach


@foreach ($users_all as $out_users)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/approve/accept']) }}
<div class="modal fade" id="ACCEPT{{$out_users->employee_code}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                <label class="control-label col-sm-4 align-self-center mb-0">รหัสพนักงาน</label>
                                <div class="col-sm-8">
                                    {{ Form::text('employee_code',$out_users->employee_code, ['class' => 'form-control','placeholder' => 'รหัสพนักงาน']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อผู้ใช้งาน</label>
                                <div class="col-sm-8">
                                    {{ Form::text('username',$out_users->username, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">อีเมล</label>
                                <div class="col-sm-8">
                                    {{ Form::text('email',$out_users->email, ['class' => 'form-control','placeholder' => 'อีเมล','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ประเภทผู้ใช้</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_type_users',$out_users->name_type_users, ['class' => 'form-control','placeholder' => 'ประเภทผู้ใช้','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ทีม</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_team',$out_users->name_team, ['class' => 'form-control','placeholder' => 'ทีม','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ประเภทผู้ใช้ทีม</label>
                                <div class="control-label col-sm-8 align-self-center mb-0">
                                    <select class="form-control"  name="type_id" id="type_id" >
                                        <option value="1">หัวหน้าทีม</option>
                                        <option value="2" selected>ลูกทีม</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::hidden('code_team',$out_users->code_team_register, ['class' => 'form-control']) }}
            {{ Form::hidden('username',$out_users->username, ['class' => 'form-control']) }}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">อนุมัติ</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@endforeach


@foreach ($users_all as $out_users)
{{ Form::open(['method' => 'POST' , 'url' => 'setting/approve/cancel']) }}
<div class="modal fade" id="CANCEL{{$out_users->employee_code}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                <label class="control-label col-sm-4 align-self-center mb-0">รหัสพนักงาน</label>
                                <div class="col-sm-8">
                                    {{ Form::text('employee_code',$out_users->employee_code, ['class' => 'form-control','placeholder' => 'รหัสพนักงาน']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ชื่อผู้ใช้งาน</label>
                                <div class="col-sm-8">
                                    {{ Form::text('username',$out_users->username, ['class' => 'form-control','placeholder' => 'ชื่อผู้ใช้งาน','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">อีเมล</label>
                                <div class="col-sm-8">
                                    {{ Form::text('email',$out_users->email, ['class' => 'form-control','placeholder' => 'อีเมล','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ประเภทผู้ใช้</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_type_users',$out_users->name_type_users, ['class' => 'form-control','placeholder' => 'ประเภทผู้ใช้','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">ทีม</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name_team',$out_users->name_team, ['class' => 'form-control','placeholder' => 'ทีม','style' => 'background-color: white;','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 align-self-center mb-0">หมายเหตุ</label>
                                <div class="col-sm-8">
                                    {{ Form::text('note',null, ['class' => 'form-control','placeholder' => 'รายละเอียด']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ Form::hidden('username',$out_users->username, ['class' => 'form-control']) }}
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

