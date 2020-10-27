<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>cu smart solution</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-">
            <div class="container mt-5 p-0 bg-white">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">

                            @if(Session::has('message'))
                            <div class="alert alert-success">
                            {{Session::get('message')}}
                            </div>
                            @endif


                            <h1 class="mb-0">สมัครสมาชิก</h1>
                            <p>กรอกข้อมูลของท่านเพื่อสมัครเข้าใช้งานระบบ.</p>
                            <form class="mt-4" method="POST" action="register_wait">
                                @csrf
                                @foreach ($users as $out_users)
                                <div class="form-group">
                                    <label for="Fullname">ชื่อจริง</label>
                                    <input id="name" type="text"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        name="name" value="{{ $out_users->first_name }}" required autocomplete="name"
                                        autofocus placeholder="ชื่อ">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label for="Lastname">นามสกุล</label>
                                    {{-- <input type="text" class="form-control mb-0" id="Lastname" placeholder="กรุณากรอกนามสกุลของท่าน"> --}}
                                    <input id="surname" type="text"
                                        class="form-control form-control-sm @error('surname') is-invalid @enderror"
                                        name="surname" value="{{ $out_users->last_name }}" required autocomplete="surname"
                                        autofocus placeholder="นามสกุล">

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">รหัสพนักงาน</label>
                                    {{-- <input type="number" class="form-control mb-0" id="employee_code" name="employee_code" placeholder="รหัสพนักงาน"> --}}
                                    <input id="employee_code" type="text"
                                        class="form-control form-control-sm @error('employee_code') is-invalid @enderror"
                                        name="employee_code" value="{{ $out_users->employee_code }}" required
                                        autocomplete="employee_code" placeholder="รหัสพนักงาน">

                                    @error('employee_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="email">อีเมล</label>
                                    {{-- <input type="email" class="form-control mb-0" id="email" placeholder="อีเมลล์"> --}}
                                    <input id="email" type="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        name="email" value="{{ $out_users->email }}" required autocomplete="email" placeholder="อีเมล">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">ทีม</label>
                                    <select class="form-control" id="code_team" name="code_team" value="{{ old('code_team') }}" required autocomplete="code_team">
                                        <option value="{{ $out_users->code_team_register }}" selected>{{ $out_users->name_team }}</option>
                                            @foreach ($team as $out_team)
                                                @if($out_team->code_team != $out_users->code_team_register )
                                                    <option value="{{ $out_team->code_team }}">{{ $out_team->name_team }}</option>
                                                @endif
                                            @endforeach
                                    </select>

                                </div>
                                {{ Form::hidden('users_id',$out_users->id, ['class' => 'form-control']) }}
                                <div class="d-inline-block w-100">

                                    <button type="submit" class="btn btn-primary float-right">{{ __('แก้ไขข้อมูล') }}</button>
                                </div>
                                <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">คุณมีบัญชีผู้ใช้งานระบบอยู่แล้วใช่หรือไม่ ? <a href="login">Log In</a></span>

                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid" alt="logo"></a>
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->

        <div class="modal fade" id="STATUS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="card">
                    <br>
                        @if($users_approved->users_status == '0')
                            <p style="text-align: center;">
                                <i class="fa fa-spinner" aria-hidden="true" style="font-size:84px;color:blue;"></i>
                            </p>
                            <h3 style="text-align: center;color:blue;">
                                <b>รออนุมัติ</b>
                            </h3>
                        @else
                            <p style="text-align: center;">
                                <i class="fa fa-times-circle" aria-hidden="true" style="font-size:84px;color:red;"></i>
                            </p>
                            <h3 style="text-align: center;color:red;">
                                <b>ไม่อนุมัติ</b>
                                <br>
                                @if($users_approved->note != '')
                                    <label style="color: red;font-size: 18px;"> เนื่องจาก : {{ $users_approved->note }}</label>
                                @endif
                            </h3>
                        @endif
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <div class="row button-group">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">แก้ไขข้อมูล</button>&nbsp;&nbsp;&nbsp;
                            <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger" >ออกจากระบบ</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>

      <script type="text/javascript">
        $(window).on('load',function(){
            $('#STATUS').modal('show');
        });
    </script>
   </body>
</html>
