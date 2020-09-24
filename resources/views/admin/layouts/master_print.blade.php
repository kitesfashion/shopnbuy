<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <link href="{{ asset('/public/admin-elite/dist/css/prints.css') }}" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">
            body {
                font-family: 'common', sans-serif;
            }
        </style>
    </head>
    <style type="text/css">
    	.print-table{
    		border-bottom: 1px solid #333;
    	}
    </style>
    <body>
        <div style="margin-bottom: 0px; text-align: center;">
            <p>
                <span style="font-size: 16px;">
                    {{$information->siteName}}
                </span> 
                <br>
                <span style="font-size: 12px;">
                    {{$information->siteAddress1}} <br>
                    {{$information->siteAddress2}}
                </span>
                <br>
                <span style="font-size: 12px;">
                    Email: {{$information->siteEmail1}}
                </span>
            </p>
        </div>
        
        @yield('print')
    </body>
</html>

