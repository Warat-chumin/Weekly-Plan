@extends('layouts.master')

@section('style')

@endsection

@section('main')

@foreach ($employee as $out_employee)
<div class="row">
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-body profile-page p-0">
                <div class="profile-header">
                    <div class="cover-container">
                        @if(Auth::user()->title_pic != NULL)
                        <img src="{{ url('assets/profile/').'/'. Auth::user()->title_pic }}" alt="profile-bg" class="rounded img-fluid">
                        @else
                        <img src="{{ url('images/bg.png') }}" alt="profile-bg" class="rounded img-fluid">
                        @endif
                        <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                            <li><a href="{{ url('/profile_edit') }}"><i class="ri-pencil-line"></i></a></li>
                        </ul>
                    </div>
                    <div class="profile-info p-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="user-detail pl-5">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="profile-img pr-4">
                                            @if(Auth::user()->profile_pic != NULL)
                                            <img src="{{ url('assets/profile/').'/'. Auth::user()->profile_pic }}" alt="profile-img"
                                                class="avatar-130 img-fluid" />
                                            @else
                                            <img src="{{ url('/images/user/user-7.jpg') }}" alt="profile-img"
                                                class="avatar-130 img-fluid" />
                                            @endif
                                        </div>
                                        <div class="profile-detail d-flex align-items-center">
                                            <h3>{{ $out_employee->first_name }}  {{ $out_employee->last_name }}</h3>
                                            <p class="m-0 pl-3"> - {{ $out_employee->position }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <ul class="nav nav-pills d-flex align-items-end float-right profile-feed-items p-0 m-0">
                                    <li>
                                        <a class="nav-link active" data-toggle="pill" href="#profile-profile">โปรไฟล์</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-toggle="pill" href="#profile-activity">กิจกรรม</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-toggle="pill" href="#profile-friends">เพื่อนร่วมทีม</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-3 profile-left">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">งานวันนี้</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="m-0 p-0">
                            @if($events_today->isEmpty())
                                <li class="d-flex mb-2">
                                    <div class="news-icon"><i class="ri-chat-4-fill"></i></div>
                                    <p class="news-detail mb-0">ไม่มีงานในวันนี้</p>
                                </li>
                            @else
                                @foreach ( $events_today as $out_events_today)
                                <li class="d-flex mb-2">
                                    <?php
                                        $date = substr($out_events_today->start_date, 0, 10);
                                        $time_start = substr($out_events_today->start_date, 11, 5);
                                        $time_stop = substr($out_events_today->end_date, 11, 5);
                                        $day =  date("d/m/Y", strtotime($date));
                                    ?>

                                    <div class="news-icon"><i class="ri-chat-4-fill"></i></div>
                                    <p class="news-detail mb-0">{{ $out_events_today->event_name }}
                                        <br>{{ $time_start }} ถึง {{ $time_stop }}</p>
                                </li>
                                @endforeach

                            @endif
                            {{-- <li class="d-flex">
                                <div class="news-icon mb-0"><i class="ri-chat-4-fill"></i></div>
                                <p class="news-detail mb-0">20% off coupon on selected items at pharmaprix </p>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                {{-- <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Gallery</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <p class="m-0">132 pics</p>
                        </div>
                    </div>
                    <div class="iq-card-body p-0">
                        <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-1"><a href="javascript:void();"><img
                                        src="images/page-img/g1.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-1"><a href="javascript:void();"><img
                                        src="images/page-img/g2.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-1"><a href="javascript:void();"><img
                                        src="images/page-img/g3.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-1"><a href="javascript:void();"><img
                                        src="images/page-img/g4.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-1"><a href="javascript:void();"><img
                                        src="images/page-img/g5.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-1"><a href="javascript:void();"><img
                                        src="images/page-img/g6.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-0"><a href="javascript:void();"><img
                                        src="images/page-img/g7.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-0"><a href="javascript:void();"><img
                                        src="images/page-img/g8.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                            <li class="col-md-4 col-6 pl-1 pr-0 pb-0"><a href="javascript:void();"><img
                                        src="images/page-img/g9.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">การติดต่อ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="pages-lists m-0 p-0">
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/page-img/tel.png') }}" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>เบอร์ติดต่อ</h6>
                                    <p class="mb-0">
                                        @if($out_employee->tel != NULL)
                                            {{ $out_employee->tel }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/page-img/mail.png') }}" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>อีเมล</h6>
                                    <p class="mb-0">
                                        @if($out_employee->email != NULL)
                                            {{ $out_employee->email }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/page-img/line.jpg') }}" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>ไลน์</h6>
                                    <p class="mb-0">
                                        @if($out_employee->line != NULL)
                                            {{ $out_employee->line }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/page-img/mess.png') }}" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>อื่นๆ</h6>
                                    <p class="mb-0">
                                        @if($out_employee->etc != NULL)
                                            {{ $out_employee->etc }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                {{-- <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Recent Places</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="pages-lists m-0 p-0">
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/page-img/46.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h5>Foodtown</h5>
                                </div>

                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/page-img/47.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h5>Touro Univercity</h5>
                                </div>

                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/page-img/48.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h5>Moviehouse & Eatery</h5>
                                </div>

                            </li>
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="images/page-img/49.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h5>Coffee + Crisp</h5>
                                </div>

                            </li>

                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-6 profile-center">
                <div class="tab-content">
                    {{-- <div class="tab-pane fade active show" id="profile-feed" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-body p-0">
                                <div class="user-post-data p-3">
                                    <div class="d-flex flex-wrap">
                                        <div class="media-support-user-img mr-3">
                                            <img class="rounded-circle img-fluid" src="images/user/01.jpg" alt="">
                                        </div>
                                        <div class="media-support-info mt-2">
                                            <h5 class="mb-0"><a href="#" class="">Anna Sthesia</a></h5>
                                            <p class="mb-0 text-primary">colleages</p>
                                        </div>
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton52"
                                                    data-toggle="dropdown">
                                                    <a href="#" class="text-secondary">29 mins <i
                                                            class="ri-more-2-line ml-3"></i></a>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right p-0">
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-share-forward-line mr-2"></i>Share</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-file-copy-line mr-2"></i>Copy Link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-post">
                                    <a href="javascript:void();"><img src="images/page-img/p1.jpg" alt="post-image"
                                            class="img-fluid" /></a>
                                </div>
                                <div class="comment-area p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center feather-icon mr-3">
                                                <a href="javascript:void();"><i class="ri-heart-line"></i></a>
                                                <span class="ml-1">140</span>
                                            </div>
                                            <div class="d-flex align-items-center message-icon">
                                                <a href="javascript:void();"><i class="ri-chat-4-line"></i></a>
                                                <span class="ml-1">140</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="iq-media-group">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/05.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/06.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/07.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/08.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/09.jpg" alt="">
                                                </a>
                                            </div>
                                            <span class="ml-2">+140 more</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla
                                        dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus
                                        mollis pharetra. Proin blandit ac massa sed rhoncus</p>
                                    <hr>
                                    <ul class="post-comments p-0 m-0">
                                        <li class="mb-2">
                                            <div class="d-flex flex-wrap">
                                                <div class="user-img">
                                                    <img src="images/user/02.jpg" alt="userimg"
                                                        class="avatar-35 rounded-circle img-fluid">
                                                </div>
                                                <div class="comment-data-block ml-3">
                                                    <h6>Monty Carlo</h6>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                    <div class="d-flex flex-wrap align-items-center comment-activity">
                                                        <a href="javascript:void();">like</a>
                                                        <a href="javascript:void();">reply</a>
                                                        <a href="javascript:void();">translate</a>
                                                        <span> 5 minit </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex flex-wrap">
                                                <div class="user-img">
                                                    <img src="images/user/03.jpg" alt="userimg"
                                                        class="avatar-35 rounded-circle img-fluid">
                                                </div>
                                                <div class="comment-data-block ml-3">
                                                    <h6>Paul Molive</h6>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                    <div class="d-flex flex-wrap align-items-center comment-activity">
                                                        <a href="javascript:void();">like</a>
                                                        <a href="javascript:void();">reply</a>
                                                        <a href="javascript:void();">translate</a>
                                                        <span> 5 minit </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <form class="comment-text d-flex align-items-center mt-3"
                                        action="javascript:void(0);">
                                        <input type="text" class="form-control rounded" placeholder="Lovely!">
                                        <div class="comment-attagement d-flex">
                                            <a href="javascript:void();"><i class="ri-user-smile-line mr-2"></i></a>
                                            <a href="javascript:void();"><i class="ri-camera-line mr-2"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card">
                            <div class="iq-card-body p-0">
                                <div class="user-post-data p-3">
                                    <div class="d-flex flex-wrap">
                                        <div class="media-support-user-img mr-3">
                                            <img class="rounded-circle img-fluid" src="images/user/02.jpg" alt="">
                                        </div>
                                        <div class="media-support-info mt-2">
                                            <h5 class="mb-0"><a href="#" class="">jenny issad</a></h5>
                                            <p class="mb-0 text-primary">colleages</p>
                                        </div>
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton53"
                                                    data-toggle="dropdown">
                                                    <a href="#" class="text-secondary">1 hr <i
                                                            class="ri-more-2-line ml-3"></i></a>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right p-0">
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-share-forward-line mr-2"></i>Share</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-file-copy-line mr-2"></i>Copy Link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-0">
                                <p class="p-3 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus
                                    faucibus mollis pharetra. Proin blandit ac massa sed rhoncus</p>

                                <div class="comment-area p-3">
                                    <hr class="mt-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center feather-icon mr-3">
                                                <a id="clickme" href="javascript:void();"><i
                                                        class="ri-heart-line"></i></a>
                                                <span class="ml-1">140</span>
                                            </div>
                                            <div class="d-flex align-items-center message-icon">
                                                <a href="javascript:void();"><i class="ri-chat-4-line"></i></a>
                                                <span class="ml-1">140</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="iq-media-group">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/05.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/06.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/07.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/08.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="images/user/09.jpg" alt="">
                                                </a>
                                            </div>
                                            <span class="ml-2">+140 more</span>
                                        </div>
                                    </div>
                                    <form class="comment-text d-flex align-items-center mt-3"
                                        action="javascript:void(0);">
                                        <input type="text" class="form-control rounded" placeholder="Lovely!">
                                        <div class="comment-attagement d-flex">
                                            <a href="javascript:void();"><i class="ri-user-smile-line mr-2"></i></a>
                                            <a href="javascript:void();"><i class="ri-camera-line mr-2"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="tab-pane fade" id="profile-activity" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">รายละเอียดกิจกรรม</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton5"
                                            data-toggle="dropdown">
                                            ดูทั้งหมด
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-0">
                                            <a class="dropdown-item" href="{{url('/calendar/team_all')}}"><i
                                                    class="ri-user-unfollow-line mr-2"></i>รายละเอียด</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <ul class="iq-timeline">
                                    @if($events_con->isEmpty())
                                        <li>
                                            <div class="timeline-dots"></div>
                                            <h6 class="float-left mb-1">ไม่มีกิจกรรม</h6>
                                            <small class="float-right mt-1">ไม่มีเวลา</small>
                                            <div class="d-inline-block w-100">
                                                <p>ไม่มีรายละเอียด</p>
                                            </div>
                                        </li>
                                    @else
                                        @foreach($events_con as $events_con)
                                        <?php
                                            $date = substr($events_con->start_date, 0, 10);
                                            $time_start = substr($events_con->start_date, 11, 5);
                                            $time_stop = substr($events_con->end_date, 11, 5);
                                            $date_data =  date("m/d/Y", strtotime($date));

                                            $strYear = date("Y",strtotime($date_data))+543;
                                            $strMonth= date("n",strtotime($date_data));
                                            $strDay= date("j",strtotime($date_data));
                                            // $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                                            $strMonthThai=$strMonthCut[$strMonth];
                                            $strDate = $strDay ." ". $strMonthThai ." ". $strYear;
                                        ?>
                                        <li>
                                            @if($events_con->subject == 'S01')
                                                <div class="timeline-dots border-primary"></div>
                                            @elseif($events_con->subject == 'S02')
                                                <div class="timeline-dots border-success"></div>
                                            @elseif($events_con->subject == 'S03')
                                                <div class="timeline-dots border-danger"></div>
                                            @else
                                                <div class="timeline-dots"></div>
                                            @endif
                                            <h6 class="float-left mb-1">{{ $events_con->event_name }}</h6>
                                            <small class="float-right mt-1">{{ $strDate }} - {{ $time_start }} ถึง {{ $time_stop }}</small>
                                            <div class="d-inline-block w-100">
                                                <p>สถานที่ : {{ $events_con->address }}</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-friends" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">สมาชิกทีม</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <ul class="suggestions-lists m-0 p-0">
                                    @foreach ( $team_member as $team_member)
                                    <li class="d-flex mb-4 align-items-center">
                                        @if($team_member->profile_pic != NULL)
                                            <div class="user-img img-fluid"><img src="{{ url('assets/profile/').'/'. $team_member->profile_pic }}" alt="story-img"
                                                class="rounded-circle avatar-40"></div>
                                        @else
                                            <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img"
                                                class="rounded-circle avatar-40"></div>
                                        @endif
                                        <div class="media-support-info ml-3">
                                            <h6>{{ $team_member->first_name }}  {{ $team_member->last_name }}</h6>
                                            <p class="mb-0">{{ $team_member->position }}</p>
                                        </div>
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton41"
                                                    data-toggle="dropdown">
                                                    <i class="ri-more-2-line"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right p-0">
                                                    <a class="dropdown-item" href="{{url('profile/'.$team_member->employee_code)}}"><i
                                                            class="ri-user-unfollow-line mr-2"></i>รายละเอียด</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade active show" id="profile-profile" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">โปรไฟล์</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="user-detail">
                                    <div class="user-profile text-center">
                                        @if(Auth::user()->profile_pic != NULL)
                                            <img src="{{ url('assets/profile/').'/'. Auth::user()->profile_pic }}" alt="profile-img" class="avatar-130 img-fluid">
                                        @else
                                            <img src="{{ url('/images/user/user-7.jpg') }}" alt="profile-img" class="avatar-130 img-fluid">
                                        @endif
                                    </div>
                                    <div class="profile-detail mt-3 text-center">
                                        <h3 class="d-inline-block">{{ $out_employee->first_name }}  {{ $out_employee->last_name }}</h3>
                                        <p class="d-inline-block pl-3"> - {{ $out_employee->position }}</p>
                                        <p class="mb-0">รายละเอียดข้อมูลส่วนตัวของผู้ใช้</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>รหัสพนักงาน:</h6>
                                        <p>{{ $out_employee->employee_code }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>ชื่อเล่น:</h6>
                                        <p>
                                            @if($out_employee->nick_name != NULL)
                                                {{ $out_employee->nick_name }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>ตำแหน่ง:</h6>
                                        <p>{{ $out_employee->position }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 profile-right">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">เกี่ยวกับ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="about-info m-0 p-0">
                            <div class="row">
                                <div class="col-12">
                                    <p>รายละเอียดข้อมูลทั่วไปของผู้ใช้</p>
                                </div>
                                <div class="col-3">อีเมล:</div>
                                <div class="col-9"> {{ $out_employee->email }}  </div>
                                <div class="col-3">เบอร์:</div>
                                <div class="col-9">
                                    @if($out_employee->tel != NULL)
                                        {{ $out_employee->tel }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="col-3">ประเทศ:</div>
                                <div class="col-9">ไทย</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">ลูกค้า</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="pages-lists m-0 p-0">
                            @if($customer_users->isEmpty())
                                <li class="d-flex mb-4 align-items-center">
                                    <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img"
                                            class="rounded-circle avatar-40"></div>
                                    <div class="media-support-info ml-3">
                                        <h6>ไม่มีลูกค้า</h6>
                                        <p class="mb-0">
                                            -
                                        </p>
                                    </div>
                                </li>
                            @else
                                @foreach ( $customer_users as $customer_users)
                                <li class="d-flex mb-4 align-items-center">
                                    <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img"
                                            class="rounded-circle avatar-40"></div>
                                    <div class="media-support-info ml-3">
                                        <h6>{{ $customer_users->name_customer }}</h6>
                                        <p class="mb-0">
                                            {{ $customer_users->type_customer_name }}
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
