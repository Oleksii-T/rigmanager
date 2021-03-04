@extends('layouts.mail')

@section('intro')
    {{__('ui.mailerNotifHeader')}}.
@endsection

@section('content')
    <ol style="list-style-position:inside;max-width:100%;">
        @foreach ($found_posts as $p)
            <li style="width:100%;color:#ff8d11;margin-bottom:5px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href="{{loc_url(route('posts.show', ['post'=>$p['url_name']]))}}">{{$p['title']}}</a></li>
        @endforeach
    </ol>
@endsection
    
@section('outro')
{{__('ui.mailerNotifBody2')}} <a href="{{loc_url(route('mailer.index'))}}">{{__('ui.settingUpMailer')}}</a>.
@endsection