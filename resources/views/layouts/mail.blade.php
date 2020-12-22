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
        </style>
    </head>
    <body>
        <h1 style="margin-top:20px;text-align:center;"><a style="font-size:125%;" href="{{loc_url(route('home'))}}">{{env('APP_NAME')}}</a></h1>
        <div style="width:550px;height:auto;margin:30px auto;padding:20px;border: 2px solid #bebebe; border-radius: 10px">
            <h2 style="margin-bottom:20px;font-size:115%;">{{__('mail.mailGreetings')}} {{$userName}},</h2>
            <div style="margin-bottom:20px">
                @yield('content')
            </div>
            <p>{{__('mail.mailSlg')}}<br>
            <a href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a></p>
        </div>
        <p style="text-align:center;margin-bottom:15px;">&copy; {{ env('COPY_RIGHT_YEAR') }} <a href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a>. {{__('ui.footerCopyright')}}</p>
    </body>
</html>