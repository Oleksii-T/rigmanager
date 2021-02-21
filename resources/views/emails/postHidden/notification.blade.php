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
            <h2 style="margin-bottom:20px;font-size:115%;">{{__('ui.postHiddenNotifGreetings')}}!</h2>
            <p style="">{{__('ui.postHiddenNotifHeader')}}.</p>
            <div style="margin:10px auto 20px auto;height:auto;width:530px;display:flex;background-color:#cacaca;border-radius:8px;padding:20px">
                <ol style="list-style-position:inside;max-width:100%;">
                    @foreach ($found_posts as $p)
                        <li style="width:100%;color:#ff8d11;margin-bottom:5px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href="{{loc_url(route('posts.show', ['post'=>$p['url_name']]))}}">{{$p['title']}}</a></li>
                    @endforeach
                </ol>
            </div>
            <p style="white-space:pre-line;margin-bottom:15px;">{{__('ui.postHiddenNotifBody1')}}</p>
            <p id="slg">{{__('ui.postHiddenNotifSlg')}}<br>
            <a href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a></p>
        </div>
        <p style="text-align:center;margin-bottom:15px;">&copy; {{ env('COPY_RIGHT_YEAR') }} <a href="{{loc_url(route('home'))}}">{{ env('APP_NAME') }}</a>. {{__('ui.footerCopyright')}}</p>
    </body>
</html>