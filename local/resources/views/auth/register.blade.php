<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weekly Plan Online</title>
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
                        <form class="mt-4" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="Fullname">ชื่อจริง</label>
                                <input id="name" type="text"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ชื่อ">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="Lastname">นามสกุล</label>
                                {{-- <input type="text" class="form-control mb-0" id="Lastname" placeholder="กรุณากรอกนามสกุลของท่าน"> --}}
                                <input id="surname" type="text"
                                    class="form-control form-control-sm @error('surname') is-invalid @enderror"
                                    name="surname" value="{{ old('surname') }}" required autocomplete="surname"
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
                                    name="employee_code" value="{{ old('employee_code') }}" required
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
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="อีเมล">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">รหัสผ่าน</label>
                                {{-- <input type="password" class="form-control mb-0" id="password" placeholder="รหัสผ่าน"> --}}
                                <input id="password" type="password"
                                    class="form-control form-control-sm @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="รหัสผ่าน">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Confirm_Password">ยืนยันรหัสผ่าน</label>
                                {{-- <input type="Password" class="form-control mb-0" id="Confirm_Password" placeholder="ยืนยันรหัสผ่าน"> --}}
                                <input id="password-confirm" type="password" class="form-control form-control-sm"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="ยืนยันรหัสผ่าน">
                            </div>
                            <div class="form-group">
                                <label for="password">ทีม</label>
                                <select class="form-control" id="code_team" name="code_team"
                                    value="{{ old('code_team') }}" required autocomplete="code_team">
                                    @foreach ($team as $item)
                                    <option value="{{$item->code_team}}">
                                        {{$item->name_team}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-inline-block w-100">

                                <button type="submit" class="btn btn-primary float-right">{{ __('สมัคร') }}</button>
                            </div>
                            <div class="sign-info">
                                <span
                                    class="dark-color d-inline-block line-height-2">คุณมีบัญชีผู้ใช้งานระบบอยู่แล้วใช่หรือไม่
                                    ? <a href="login">เข้าสู่ระบบ</a></span>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="sign-in-detail text-white">
                        <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid"
                                alt="logo"></a>
                        <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false"
                            data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1"
                            data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                            <div class="item">
                                <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Weekly Plan</h4>
                                {{-- <p>It is a long established fact that a reader will be distracted by the readable content.</p> --}}
                            </div>
                            <div class="item">
                                <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Weekly Plan</h4>
                                {{-- <p>It is a long established fact that a reader will be distracted by the readable content.</p> --}}
                            </div>
                            <div class="item">
                                <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Weekly Plan</h4>
                                {{-- <p>It is a long established fact that a reader will be distracted by the readable content.</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign in END -->
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
</body>

</html>