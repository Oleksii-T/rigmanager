<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>{{ config('app.name') }}</title>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!--  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">  -->
    
        <!-- Styles -->
        <link type="text/css" href="{{ asset('css/normalize.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('css/example.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <div id="pop-up-container">
                <div class="flash flash-success">
                    <p><img src="{{asset('icons/successIcon.svg')}}" alt="{{__('alt.keyword')}}">Sample flash massage!</p>
                    <div class="animated-line"></div>
                </div>
                <div class="flash flash-success">
                    <p><img src="{{asset('icons/successIcon.svg')}}" alt="{{__('alt.keyword')}}">Another flash massage!</p>
                    <div class="animated-line"></div>
                </div>
                <div class="flash flash-success">
                    <p><img src="{{asset('icons/successIcon.svg')}}" alt="{{__('alt.keyword')}}">Pop me up !</p>
                    <div class="animated-line"></div>
                </div>
            </div>
        </div>
    </body>
</html>