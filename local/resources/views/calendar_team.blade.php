@extends('layouts.master')

@section('main')
<div class="row">
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">รายชื่อสมาชิกทีม</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="row">
                    @foreach ($team_member as $out_team_member)
                        @foreach ($users as $out_users)
                            @if($out_users->employee_code == $out_team_member->employee_code)
                                @foreach ($employee as $out_employee)
                                    @if($out_employee->employee_code == $out_users->employee_code)
                                    <div class="col-sm-12 col-lg-4">
                                        <a href="{{url('/calendar').'/'.$out_users->employee_code.'/all'}}" class="nav-link">
                                            <div class="alert bg-white alert-primary" role="alert">
                                                <li class="d-flex align-items-center">
                                                    @if($out_users->profile_pic != NULL)
                                                    <div class="user-img img-fluid"><img
                                                            src="{{ url('assets/profile').'/'. $out_users->profile_pic }}"
                                                            alt="story-img" class="rounded-circle avatar-40"></div>
                                                    @else
                                                    <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}"
                                                            alt="story-img" class="rounded-circle avatar-40"></div>
                                                    @endif
                                                    <div class="media-support-info ml-3">
                                                        <h6>{{ $out_employee->first_name }} {{ $out_employee->last_name }}</h6>
                                                        <p class="mb-0">{{ $out_employee->position }}</p>
                                                    </div>
                                                </li>
                                            </div>
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
