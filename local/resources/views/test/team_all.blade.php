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
                {{-- <p>Badges can be used as part of buttons to provide a counter.</p> --}}
                {{-- <button type="button" class="btn mb-1 btn-outline-primary">
                    Notifications <span class="badge badge-primary ml-2">4</span>
                </button>
                <button type="button" class="btn mb-1 btn-outline-success">
                    Notifications <span class="badge badge-success ml-2">4</span>
                </button>
                <button type="button" class="btn mb-1 btn-outline-danger">
                    Notifications <span class="badge badge-danger ml-2">4</span>
                </button> --}}

                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Sale Enterprise</h6>
                                   <p class="mb-0">10 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Sale government</h6>
                                   <p class="mb-0">3 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Key Account</h6>
                                   <p class="mb-0">3 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Sale Service</h6>
                                   <p class="mb-0">7 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Smart solution</h6>
                                   <p class="mb-0">5 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Presales</h6>
                                   <p class="mb-0">9 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <div class="alert bg-white alert-primary" role="alert">
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img" class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                   <h6>Human Resources</h6>
                                   <p class="mb-0">2 Members</p>
                                </div>
                             </li>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
