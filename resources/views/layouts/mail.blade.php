<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-size: 19px;
                font-family: 'Roboto', Arial, Helvetica, sans-serif;
                color:#000000;
            }
            a:hover {
                text-decoration: none;
            }
        </style>
    </head>
    <body style="padding: 20px 0px">
        <h1 style="margin-top:20px;text-align:center;"><a style="font-size:125%;" href="{{loc_url(route('home'))}}">{{env('APP_NAME')}}</a></h1>
        <div style="width:550px;height:auto;margin:20px auto;padding:20px;">
            <h2 style="margin-bottom:20px;font-size:115%;">{{__('mail.mailGreetings')}}!</h2>
            <p style="">@yield('intro')</p>
            <div style="margin:10px auto 20px auto;height:auto;width:530px;display:flex;background-color:#cacaca;border-radius:8px;padding:20px">
                <div style="overflow:hidden">
                    @yield('content')
                </div>
            </div>
            <p style="white-space:pre-line;margin-bottom:15px;">@yield('outro')</p>
            <p style="white-space:pre-line;margin-bottom:15px;">{{__('mail.contactBack')}} <a href="mailto:{{env('MAIL_TO_ADDRESS')}}">{{env('MAIL_TO_ADDRESS')}}</a></p>
            <p id="slg">{{__('mail.mailSlg')}}<br>
            <a href="{{loc_url(route('home'))}}">{{env('APP_NAME')}}</a></p>
        </div>
        <p style="text-align:center;margin-bottom:15px;">&copy; {{date("Y")}} <a href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a>. {{__('ui.footerCopyright')}}</p>
    </body>
</html>
