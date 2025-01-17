
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Weekly Plan Online</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('css/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('css/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">

      @yield('style')
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
      <!-- Sidebar  -->
      @if(Auth::user()->type_id == 1)
        @include('layouts.menu-manage')
      @elseif(Auth::user()->type_id == 2)
        @include('layouts.menu-users')
      @elseif(Auth::user()->type_id == 3)
        @include('layouts.menu-admin')
      @endif
      <!-- TOP Nav Bar -->
      @include('layouts.navbar')
      <!-- TOP Nav Bar END -->
      <!-- Responsive Breadcrumb End-->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                @yield('main')
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      @include('layouts.footer')
      <!-- Footer END -->
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
      <!-- lottie JavaScript -->
      <script src="{{ asset('js/lottie.js')}}"></script>
      <!-- Chart Custom JavaScript -->
      <script src="{{ asset('js/chart-custom.js')}}"></script>
      <!-- Custom JavaScript -->
      <script src="{{ asset('js/custom.js')}}"></script>

      @yield('script')
   </body>
</html>
