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
        <link type="text/css" href="{{ asset('css/components/items.css') }}" rel="stylesheet" />
        <link type="text/css" href="{{ asset('css/mailerNotification.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="wraper">
            <h1 id="heading"><a class="mailer-link" href="{{route('home')}}">{{ env('APP_NAME') }}</a></h1>
            <div id="content">
                <h2>{{__('ui.mailerNotifGreetings')}}</h2>
                <p>{{__('ui.mailerNotifHeader')}}</p>
                <div class="item">
                    <div class="imgWraper">
                        @if ( $post->images->isEmpty() )
                            <img src="{{ asset('icons/noImageIcon.svg') }}" alt="Оборудывание нефть и газ."></li>
                        @else    
                            <img src="{{ $post->images()->where('version', 'optimized')->first()->url }}" alt="Оборудывание нефть и газ."></li>
                        @endif
                    </div>
                    
                    <div class="textWraper">
                        <h3 class="heading4">{{ $post->title }}</h3>
                        <p class="desc">{{ $post->description }}</p>
                        <ul id="ulMisc">
                            @if ($post->location)
                                <li><p class="location misc">{{ $post->location }}</p></li>
                                <li><p>s &#x02022</p></li>
                            @endif
                            <li><p class="date misc" >{{ $post->created_at }}</p></li>
                            @if ($post->cost)
                                <li><p>&#x02022</p></li>
                                <li><p class="cost misc">{{ $post->cost }}</p></li>
                            @endif
                        </ul>
                    </div>
        
                    <a href="{{ route('posts.show', $post->id) }}"><span class="globalItemButton item_id_{{$post->id}}"></span></a>
                </div>
                <p class="notification-body">{{__('ui.mailerNotifBody', ['reason' => $reason])}} 
                    <span>{{$reasonValue}}.</span>
                    {{__('ui.mailerNotifBody2')}} <a class="mailer-link" href="{{route('mailer.index')}}">{{__('ui.settingUpMailer')}}</a>.
                </p>
                <p>{{__('ui.mailerNotifSlg')}}<br>
                <a class="mailer-link" href="{{route('home')}}">{{ env('APP_NAME') }}</a></p>
            </div>
            <p id="copy-right">© 2020 <a class="mailer-link" href="{{route('home')}}">{{ env('APP_NAME') }}</a>. {{__('ui.footerCopyright')}}</p>
        </div>
    </body>
</html>