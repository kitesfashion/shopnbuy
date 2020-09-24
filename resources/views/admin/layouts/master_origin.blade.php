<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/').@$information->adminsmalLogo }}">
    
    <title>{{@$information->adminTitle}} @if(@$title)- {{@$title}} @endif</title>
    {{-- @yield('title') --}}
    <style type="text/css">
        .modal {
            position: absolute;
            top: 10px;
            right: 100px;
            bottom: 0;
            left: 0;
            z-index: 10040;
            overflow: auto;
            overflow-y: auto;
        }

        .car-pad{
            padding-bottom: 20px;
        }
    </style>
    @yield('custom_css')

    @include('admin.partials.header-assets')
</head>
<body class="skin-default fixed-layout">

   {{--  @include('admin.partials.preloader') --}}

    <div id="main-wrapper">

        <header class="topbar">
            @include('admin.partials.top-navbar')
        </header>
               
        @include('admin.partials.menu')
       
        <div class="page-wrapper">
           
            <div class="container-fluid">
               
                @yield('bread-crumb')

                @yield('content')
               
                @include('admin.partials.right-sidebar')
                
            </div>
        </div>
                <footer class="footer">
            © 2019 Developed by <a target="_blank" href="http://www.technoparkbd.com/">Techno Park</a>
           
        </footer>
       
    </div>
   

    @include('admin.partials.footer-assets')

    @yield('custom-js')

</body>
</html>