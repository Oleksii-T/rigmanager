<!DOCTYPE html>
<html lang="{{$lang}}">
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
            }
        </style>
    </head>
    <body>
        <h1 style="margin-top:20px;text-align:center;"><a style="font-size:125%;" href="{{loc_url(route('home'))}}">{{env('APP_NAME')}}</a></h1>
        <div style="width:550px;height:auto;margin:20px auto;background-color:#efefef;padding:20px;">
            <h2 style="margin-bottom:20px;font-size:115%;">{{__('ui.mailerNotifGreetings')}}!</h2>
            <p id="intro">{{__('ui.mailerNotifHeader')}}.</p>
            <div style="margin:10px auto 20px auto;padding:10px;display:flex;background-color:#a7a6a6;">
                <div style="margin-right:10px;width:25%;">
                    <a style="color:initial;text-decoration:none;" href="{{ loc_url(route('posts.show', ['post'=>$post->id])) }}">
                        @if ($post->images->isNotEmpty())
                            <img style="height:100%;width:100%;object-fit:contain;" src="{{ $message->embed($post->images()->where('version', 'optimized')->first()->url) }}" alt="{{__('alt.keyword')}}">
                        @else
                            <img style="height:100%;width:100%;object-fit:contain;" src="{{ $message->embed(asset('icons/noImageIcon.svg')) }}" alt="{{__('alt.keyword')}}"><!---->
                        @endif
                    </a>
                </div>
                <div style="width:70%;">
                    <a style="color:initial;text-decoration:none;" href="{{ loc_url(route('posts.show', ['post'=>$post->id])) }}">
                        <h2 style="color:#FE9042;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:5px;font-size:115%;">{{ $post->title }}</h2>
                        <p style="white-space:pre-line;height:4.4em;overflow:hidden;">{{ $post->description}}</p>
                    </a>
                </div>
            </div>
            <p style="white-space:pre-line;margin-bottom:15px;">{{__('ui.mailerNotifBody', ['reason' => $reason])}}:
                <span style="padding-left: 5px;margin:5px 0px 5px 5px;font-size:105%;white-space:normal;display:inline-block;border-left:2px solid #FE9042;">{{$reasonValue}}.</span>
                {{__('ui.mailerNotifBody2')}} <a class="mailer-link" href="{{loc_url(route('mailer.index'))}}">{{__('ui.settingUpMailer')}}</a>.
                {{__('ui.mailerNotifBody3')}}: <a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ loc_url(route('posts.show', ['post'=>$post->id])) }}</a>.
            </p>
            <p id="slg">{{__('ui.mailerNotifSlg')}}<br>
            <a class="mailer-link" href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a></p>
        </div>
        <p style="text-align:center;margin-bottom:15px;">&copy; {{ env('COPY_RIGHT_YEAR') }} <a class="mailer-link" href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a>. {{__('ui.footerCopyright')}}</p>
    </body>
</html>