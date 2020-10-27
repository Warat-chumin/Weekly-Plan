@extends('layouts.master')

@section('main')
<div class="row">
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">รายชื่อทีมทั้งหมด</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="row">
                    @foreach ($team_all as $out_team_all)
                        @foreach ($team as $out_team)
                            @if($out_team->code_team == $out_team_all->code_team)
                            {{-- <a href="{{ url('calendar/team').'/'. $out_team_all->code_team }}" class="nav-link"> --}}
                                <div class="col-sm-12 col-lg-4">
                                    <a href="{{ url('calendar/team').'/'. $out_team_all->code_team }}" class="nav-link">
                                    <div class="alert bg-white alert-primary" role="alert">
                                        <li class="d-flex align-items-center">
                                            @if($out_team_all->team_pic != NULL)
                                                <div class="user-img img-fluid"><img src="{{ url('assets/profile').'/'. $out_team_all->team_pic }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                            @else
                                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                            @endif
                                            <div class="media-support-info ml-3">
                                            <h6>{{ $out_team_all->name_team }}</h6>
                                            <p class="mb-0"
                                            >@foreach ($team_count as $out_team_count)
                                                @if($out_team_count->code_team == $out_team->code_team)
                                                    {{ $out_team_count->team_member }}
                                                @endif
                                            @endforeach Members</p>
                                            </div>
                                        </li>
                                    </div>
                                    </a>
                                </div>
                            {{-- </a> --}}
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
