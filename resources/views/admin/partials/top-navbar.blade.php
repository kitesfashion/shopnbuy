<?php
    use Illuminate\Support\Facades\URL;
    $userId =  Auth::user()->id;
?>
<style type="text/css">
    
</style>
<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    
    <div class="navbar-header">
        <a class="navbar-brand logo-link" target="_blank" href="{{url('/')}}">
            <span class="small-logo">
                <img src="{{ asset('/').@$information->adminsmalLogo }}" alt="mini" />
            </span>
            <span class="logo-lg">
                <img style="width: 100%" src="{{ asset('/').@$information->adminLogo }}" class="light-logo large-logo" alt="large" />
            </span>
        </a>
    </div>

    <div class="navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"> 
                <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> 
            </li>

             <li class="nav-item"> 
                <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> 
             </li>

        </ul>

        <ul class="navbar-nav my-lg-0">
          
            <li class="nav-item dropdown u-pro">
                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/public/admin-elite/') }}/assets/images/users/1.jpg" alt="user" class=""> <span class="hidden-md-down">{{ Auth::user()? Auth::user()->name:"Admin" }} <i class="fa fa-angle-down"></i></span> </a>
                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                    <!-- text-->
                    <a href="{{ route('user.account') }}" class="dropdown-item"><i class="ti-user"></i> My Account</a>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="{{ route('userAccount.password',$userId) }}" class="dropdown-item"><i class="fa fa-exchange text-inverse m-r-10"></i> Change Password</a>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->

                    <!-- first check admin then user then customer-->

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <a href="{{ Auth::guard('admin')->check() ? route('admin.logout') : (Auth::guard('web')->check() ? route('user.logout') : (Auth::guard('customer')->check() ? route('customer.logout') : route('logout'))) }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                    <!-- text-->
                </div>
            </li>

            <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
        </ul>
    </div>
</nav>