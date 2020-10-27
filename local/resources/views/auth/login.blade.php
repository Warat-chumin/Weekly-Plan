
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Weekly Plan Online</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('css/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('css/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="sign-in-from">
                                <h1 class="mb-0">เข้าสู่ระบบ</h1>
                                <p>กรอกอีเมลล์และรหัสผ่านของท่านเพื่อเข้าใช้งานระบบ.</p>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">อีเมลล์</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="อีเมลล์">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">รหัสผ่าน</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="รหัสผ่าน">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-inline-block w-100">
                                        <button type="submit" class="btn btn-primary float-right">
                                            {{ __('เข้าสู่ระบบ') }}
                                        </button>
                                    </div>
                                    <div class="sign-info">
                                        <span class="dark-color d-inline-block line-height-2">คุณยังไม่มีบัญชีผู้ใช้งานระบบใช่หรือไม่? <a href="register">สมัครสมาชิก</a></span>

                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid" alt="logo"></a>
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
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
      <script src="{{ asset('js/jquery.min.js')}}"></script>
      <script src="{{ asset('js/popper.min.js')}}"></script>
      <script src="{{ asset('js/bootstrap.min.js')}}"></script>
      <!-- Appear JavaScript -->
      <script src="{{ asset('js/jquery.appear.js')}}"></script>
      <!-- Countdown JavaScript -->
      <script src="{{ asset('js/countdown.min.js')}}"></script>
      <!-- Counterup JavaScript -->
      <script src="{{ asset('js/waypoints.min.js')}}"></script>
      <script src="{{ asset('js/jquery.counterup.min.js')}}"></script>
      <!-- Wow JavaScript -->
      <script src="{{ asset('js/wow.min.js')}}"></script>
      <!-- Apexcharts JavaScript -->
      <script src="{{ asset('js/apexcharts.js')}}"></script>
      <!-- Slick JavaScript -->
      <script src="{{ asset('js/slick.min.js')}}"></script>
      <!-- Select2 JavaScript -->
      <script src="{{ asset('js/select2.min.js')}}"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{ asset('js/smooth-scrollbar.js')}}"></script>
      <!-- Chart Custom JavaScript -->
      <script src="{{ asset('js/chart-custom.js')}}"></script>
      <!-- Custom JavaScript -->
      <script src="{{ asset('js/custom.js')}}"></script>
   </body>
</html>
