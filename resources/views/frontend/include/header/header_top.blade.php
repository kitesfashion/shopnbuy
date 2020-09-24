@php
    use App\DeliveryZone;
    $customerId = Session::get('customerId');
    $deliveryZoneList = DeliveryZone::all();

@endphp
<form method="GET" action="{{route('search')}}">
    {{ csrf_field() }}
    <nav _ngcontent-c1="" class="navbar fixed-top navbar-expand-md navbar-light double-nav scrolling-navbar">
        <a _ngcontent-c1="" class="closeit menu-toggle" onclick="CollapseMenu('hide')"></a>
        <div _ngcontent-c1="" class="toggle-icon">
            <a _ngcontent-c1="" class="button-collapse" data-activates="slide-out" onclick="CollapseMenu('show')">
                <i _ngcontent-c1="" class="fa fa-bars"></i>
                <span _ngcontent-c1="" aria-hidden="true" class="sr-only">
                    Toggle side navigation
                </span>
            </a>
        </div>
        
        <div _ngcontent-c1="" class="pl-2 d-none d-md-block search-container">
            <input _ngcontent-c1="" class="form-control ng-untouched ng-pristine ng-valid" id="search-deafult" placeholder="Search your desired product here" type="text" value="{{@$search}}" name="search_query" required="">
        </div>

        <div _ngcontent-c1="" class="d-block d-md-none d-xl-none text-center" id="mobile-logo" tabindex="0">
            <a href="{{url('/')}}">
                <img _ngcontent-c1="" class="mobile-logo" src="{{asset('/').@$information->siteLogo}}">
            </a>
        </div>
        <div _ngcontent-c1="" id="mobile-search">
            <input _ngcontent-c1="" autocomplete="off" class="form-control ng-untouched ng-pristine ng-valid" name="searchm" placeholder="Search desired product here" type="text">
        </div>
        <ul _ngcontent-c1="" class="nav navbar-nav nav-flex-icons top-right-buttons text-white">
           <li _ngcontent-c1="" class="nav-item" id="top-location">
                <a _ngcontent-c1="" class="nav-link waves-effect dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"  href="javascript:void(0)"> 
                    <span _ngcontent-c1=""> 
                        <i _ngcontent-c1="" aria-hidden="true" class="fa fa-map-marker"></i>
                    </span> 
                    <span _ngcontent-c1="" class="ng-untouched ng-pristine ng-valid" id="currentDeliveryZone"> 
                          
                    </span>
                    <b _ngcontent-c1="" class="caret"> 
                    </b>
                </a>
                <ul _ngcontent-c1="" class="dropdown-menu">
                    @foreach ($deliveryZoneList as $deliveryZone)
                        <li _ngcontent-c1="">
                            <a _ngcontent-c1="" onclick="ChangeDeliveryZone('{{$deliveryZone->id}}','{{$deliveryZone->name}}')">{{$deliveryZone->name}}</a>
                        </li>
                    @endforeach
                    
                </ul>
            </li>

            @if(isset($customerId))
                <li _ngcontent-c1="" class="nav-item d-md-block d-xl-block d-none" id="top-login">
                    <a _ngcontent-c1="" class="nav-link waves-effect dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="javascript:void(0)"> 
                        <span _ngcontent-c1=""> 
                            <i _ngcontent-c1="" aria-hidden="true" class="fa fa-user"></i>
                        </span> 
                        <span _ngcontent-c1="" class="ng-untouched ng-pristine ng-valid">   
                            Account  
                        </span>
                        <b _ngcontent-c1="" class="caret"></b>
                    </a>
                    <ul _ngcontent-c1="" class="dropdown-menu" >
                        <li _ngcontent-c1="">
                            <a _ngcontent-c1="" href="{{route('customer.profile',$customerId)}}">Profile</a>
                        </li>
                        <li _ngcontent-c1="">
                            <a _ngcontent-c1="" href="{{route('customer.order')}}">Order History</a>
                        </li>
                        <li _ngcontent-c1="">
                            <a _ngcontent-c1="" href="{{route('customer.logout')}}">Logout</a>
                        </li>
                    </ul>
                </li>
            @else
                <li _ngcontent-c1="" class="nav-item d-md-block d-xl-block d-none" id="top-login">
                    <a _ngcontent-c1="" class="nav-link waves-effect" href="{{ route('customer.login') }}">
                        <span _ngcontent-c1="" class="clearfix d-none d-sm-inline-block">Login/Signup</span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
</form>
<div _ngcontent-c1="" id="sidenav-overlay"></div>