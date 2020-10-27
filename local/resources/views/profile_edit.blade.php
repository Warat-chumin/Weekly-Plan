@extends('layouts.master')

@section('style')

@endsection

@section('main')

<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-body p-0">
                <div class="iq-edit-list">
                    <ul class="iq-edit-profile d-flex nav nav-pills">
                        <li class="col-md-4 p-0">
                            <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                ข้อมูลทั่วไป
                            </a>
                        </li>
                        <li class="col-md-4 p-0">
                            <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                เปลี่ยนรหัสผ่าน
                            </a>
                        </li>
                        <li class="col-md-4 p-0">
                            <a class="nav-link" data-toggle="pill" href="#emailandsms">
                                รูปโปรไฟล์และหน้าปก
                            </a>
                        </li>
                        {{-- <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                Manage Contact
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="iq-edit-list-data">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">แก้ไขข้อมูลทั่วไป</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            @foreach ($users as $out_users)
                                @foreach ($employee as $out_employee)
                                {{ Form::open(['method' => 'POST' , 'url' => 'profile_edit/data']) }}
                                    {{-- <div class="form-group row align-items-center">
                                        <div class="col-md-12">
                                            <div class="profile-img-edit">
                                                <img class="profile-pic" src="images/user/11.png" alt="profile-pic">
                                                <div class="p-image">
                                                    <i class="ri-pencil-line upload-button"></i>
                                                    <input class="file-upload" type="file" accept="image/*" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class=" row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <label for="fname">ชื่อ:</label>
                                            {{ Form::text('first_name',$out_employee->first_name, ['class' => 'form-control','placeholder' => 'ชื่อ']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="lname">นามสกุล:</label>
                                            {{ Form::text('last_name',$out_employee->last_name, ['class' => 'form-control','placeholder' => 'นามสกุล']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="uname">ชื่อเล่น:</label>
                                            {{ Form::text('nick_name',$out_employee->nick_name, ['class' => 'form-control','placeholder' => 'ชื่อเล่น']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="cname">ตำแหน่ง:</label>
                                            {{ Form::text('position',$out_employee->position, ['class' => 'form-control','placeholder' => 'ตำแหน่ง']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="uname">อีเมล:</label>
                                            {{ Form::email('email',$out_users->email, ['class' => 'form-control','placeholder' => 'อีเมล์']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="uname">เบอร์โทร:</label>
                                            {{ Form::text('tel',$out_employee->tel, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="uname">ไลน์:</label>
                                            {{ Form::text('line',$out_employee->line, ['class' => 'form-control','placeholder' => 'ไลน์']) }}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="uname">อื่นๆ:</label>
                                            {{ Form::text('etc',$out_employee->etc, ['class' => 'form-control','placeholder' => 'อื่นๆ']) }}
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>คำอธิบาย:</label>
                                            {{ Form::textarea('description',$out_employee->description, ['class' => 'form-control','placeholder' => 'คำอธิบาย','row' => '5','style' => 'line-height: 22px;']) }}
                                        </div>
                                    </div>
                                    {{ Form::hidden('id_employee',$out_employee->id, ['class' => 'form-control']) }}
                                    {{ Form::hidden('id_users',$out_users->id, ['class' => 'form-control']) }}
                                    <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
                                    <a href="{{ url('/profile')}}"><button type="button" class="btn iq-bg-danger">ยกเลิก</button></a>
                                {{ Form::close() }}
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                    <div class="iq-card">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">แก้ไขรหัสผ่าน</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            {{ Form::open(['method' => 'POST' , 'url' => 'profile_edit/password']) }}
                                <div class="form-group">
                                    <label for="cpass">รหัสผ่านเก่า:</label>
                                    {{ Form::text('old_password',NULL, ['class' => 'form-control','placeholder' => 'รหัสผ่านเก่า']) }}
                                </div>
                                <div class="form-group">
                                    <label for="npass">รหัสผ่านใหม่:</label>
                                    {{ Form::text('password',NULL, ['class' => 'form-control','placeholder' => 'รหัสผ่านใหม่']) }}
                                </div>
                                <div class="form-group">
                                    <label for="vpass">ยืนยันรหัสผ่านใหม่:</label>
                                    {{ Form::text('password_confirmation',NULL, ['class' => 'form-control','placeholder' => 'ยืนยันรหัสผ่านใหม่']) }}
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
                                <a href="{{ url('/profile')}}"><button type="button" class="btn iq-bg-danger">ยกเลิก</button></a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">เปลี่ยนรูปโปรไฟล์และหน้าปก</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            {{ Form::open(['method' => 'POST' , 'url' => 'profile_edit/avatar', 'files' => true]) }}
                                <div class="form-group row align-items-center">
                                    <div class="col-md-12">
                                        <label>รูปโปรไฟล์:</label><br>
                                        <div class="profile-img-edit">
                                            @if(Auth::user()->profile_pic != NULL)
                                            <img class="profile-pic" src="{{ url('assets/profile/').'/'. Auth::user()->profile_pic }}" alt="profile-pic">
                                            @else
                                            <img class="profile-pic" src="{{ url('/images/user/user-7.jpg') }}" alt="profile-pic">
                                            @endif
                                            <div class="p-image">
                                                <i class="ri-pencil-line upload-button"></i>
                                                <input class="file-upload" type="file" name="profile_pic" accept="image/*" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>รูปโปรหน้าปก:</label>
                                    <input type="file" class="form-control" name="title_pic" accept="image/*" style="height: 70px;">
                                 </div>
                                 {{ Form::hidden('id_users',$out_users->id, ['class' => 'form-control']) }}
                                <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
                                <a href="{{ url('/profile')}}"><button type="button" class="btn iq-bg-danger">ยกเลิก</button></a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Manage Contact</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form>
                                <div class="form-group">
                                    <label for="cno">Contact Number:</label>
                                    <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" value="nikjone@demo.com">
                                </div>
                                <div class="form-group">
                                    <label for="url">Url:</label>
                                    <input type="text" class="form-control" id="url" value="https://getbootstrap.com">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn iq-bg-danger">Cancle</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
