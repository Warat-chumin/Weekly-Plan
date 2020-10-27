<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html">
            <img src="{{ url('/images/logo.gif') }}" class="img-fluid" alt="">
            <span style="font-size: 20px;">Weekly Plan</span>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                    <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                {{-- <li>
                    <a href="{{url('/dashboard')}}" class="iq-waves-effect"><i
                            class="ri-pie-chart-line"></i><span>ภาพรวมระบบ</span></a>
                </li> --}}
                <li>
                    <a href="{{url('/calendar/team_all')}}" class="iq-waves-effect"><i
                            class="ri-calendar-line"></i><span>ปฏิทิน</span></a>
                </li>
                {{-- <li>
                    <a href="{{url('/weekly_plan').'/'.Auth::user()->employee_code}}" class="iq-waves-effect"><i
                            class="ri-menu-3-line"></i><span>แผนงาน</span></a>
                </li> --}}
                <li>
                    <a href="{{url('/check_in')}}" class="iq-waves-effect"><i
                            class="ri-map-pin-line"></i><span>ลงเวลางาน</span></a>
                </li>
                <li>
                    <a href="{{url('/report')}}" class="iq-waves-effect"><i
                            class="ri-file-2-line"></i><span>รายงาน</span></a>
                </li>

                <li>
                    <a href="{{url('/profile')}}" class="iq-waves-effect"><i
                            class="ri-account-box-line"></i><span>ข้อมูลส่วนตัว</span></a>
                </li>

                <li>
                    <a href="#userinfo" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-settings-3-line"></i><span>ตั้งค่า</span><i
                            class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        {{-- <li><a href="{{url('/profile')}}"><i class="ri-account-box-line"></i>ข้อมูลส่วนตัว</a></li> --}}
                        <li><a href="{{url('/setting/customer')}}"><i class="ri-shield-user-line"></i>ลูกค้า</a></li>
                        <li><a href="{{url('/setting/project')}}"><i class="ri-shield-user-line"></i>โปรเจค</a>
                    </ul>
                </li>

                <li>
                    <a href="{{url('/logout')}}" class="iq-waves-effect"><i
                            class="ri-logout-box-line"></i><span>ออกจากระบบ</span></a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
