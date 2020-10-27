<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <div class="iq-sidebar-logo">
         <div class="top-logo">
            <a href="index.html" class="logo">
               <img src="{{ url('/images/logo.gif') }}" class="img-fluid" alt="">
               <span>Weekly Plan</span>
            </a>
         </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light p-0">
         <div class="navbar-left">
            <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
               <li class="nav-item">
                  <a href="{{url('/calendar/team_all')}}" class="nav-link font-weight-bold search-box-toggle">
                     <i class="ri-calendar-line"></i>
                  </a>
               </li>

               <li class="nav-item">
                  <a href="{{url('/check_in')}}" class="nav-link font-weight-bold search-box-toggle">
                     <i class="ri-time-line"></i>
                  </a>
               </li>

               <li class="nav-item">
                  <a href="{{url('/report')}}" class="nav-link font-weight-bold search-box-toggle">
                     <i class="ri-file-2-line"></i>
                  </a>
               </li>

               <li class="nav-item">
                  <a href="{{url('/profile')}}" class="nav-link font-weight-bold search-box-toggle">
                     <i class="ri-account-box-line"></i>
                  </a>
               </li>
            </ul>
            <div class="iq-search-bar">
               <form action="#" class="searchbox">
                  <input type="text" class="text search-input" placeholder="ค้นหา..." readonly>
                  <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                  <div class="searchbox-datalink">
                     <h6 class="pl-3 pt-3">หน้าต่างๆ</h6>
                     <ul class="m-0 pl-3 pr-3 pb-3">
                        <li class="iq-bg-primary-hover rounded"><a href="{{url('/calendar/team_all')}}"
                              class="nav-link router-link-exact-active router-link-active pr-2"><i
                                 class="ri-calendar-line pr-2"></i>ปฎิทิน</a></li>
                        <li class="iq-bg-primary-hover rounded"><a href="{{url('/check_in')}}" class="nav-link"><i
                                 class="ri-map-pin-line pr-2"></i>ลงเวลางาน</a></li>
                        <li class="iq-bg-primary-hover rounded"><a href="{{url('/report')}}" class="nav-link"><i
                                 class="ri-file-2-line pr-2"></i>รายงาน</a></li>
                        <li class="iq-bg-primary-hover rounded"><a href="{{url('/profile')}}" class="nav-link"><i
                                 class="ri-profile-line pr-2"></i>ข้อมูลส่วนตัว</a></li>
                     </ul>
                  </div>
               </form>
            </div>
         </div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
         </button>
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
               <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
            </div>
         </div>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
            </ul>
         </div>
         <ul class="navbar-list">
            <li class="bg-primary rounded">
               <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                  @if(Auth::user()->profile_pic != NULL)
                  <img src="{{ url('assets/profile').'/'. Auth::user()->profile_pic }}" class="img-fluid rounded mr-3"
                     alt="user">
                  @else
                  <img src="{{ url('/images/user/user-7.jpg') }}" class="img-fluid rounded mr-3" alt="user">
                  @endif
                  <div class="caption">
                     @foreach ( $events_employee as $events_employee)
                     <h6 class="mb-0 line-height text-white">
                        {{ $events_employee->first_name }} {{ $events_employee->last_name }}
                     </h6>
                     <span class="font-size-12 text-white">{{ $events_employee->position }}</span>
                     @endforeach
                  </div>
               </a>
               <div class="iq-sub-dropdown iq-user-dropdown">
                  <div class="iq-card shadow-none m-0">
                     <div class="iq-card-body p-0 ">
                        <a href="{{url('/profile')}}" class="iq-sub-card iq-bg-primary-hover">
                           <div class="media align-items-center">
                              <div class="rounded iq-card-icon iq-bg-primary">
                                 <i class="ri-file-user-line"></i>
                              </div>
                              <div class="media-body ml-3">
                                 <h6 class="mb-0 ">โปรไฟล์</h6>
                                 <p class="mb-0 font-size-12 text-dark">รายละเอียดของข้อมูลส่วนตัว</p>
                              </div>
                           </div>
                        </a>
                        <a href="{{url('/calendar/team_all')}}" class="iq-sub-card iq-bg-primary-hover">
                           <div class="media align-items-center">
                              <div class="rounded iq-card-icon iq-bg-primary">
                                 <i class="ri-calendar-line"></i>
                              </div>
                              <div class="media-body ml-3">
                                 <h6 class="mb-0 ">ปฏิทิน</h6>
                                 <p class="mb-0 font-size-12 text-dark">รายละเอียดของแผนงาน</p>
                              </div>
                           </div>
                        </a>
                        <div class="d-inline-block w-100 text-center p-3">
                           <a class="bg-primary iq-sign-btn" href="{{url('/logout')}}" role="button">ออกจากระบบ<i
                                 class="ri-login-box-line ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
   </div>
</div>