@extends('layouts.mail_plain')

@section('content')
    {{__('ui.mailerNotifHeader')}}.

    @foreach ($found_posts as $p)
        {{$loop->index+1 . '. ' . $p['title'] . ' ('.loc_url(route('posts.show', ['post'=>$p['url_name']])).')'}}
        
    @endforeach

    {{__('ui.mailerNotifBody2') . ' ' . __('ui.settingUpMailer') . '(' . loc_url(route('mailer.index')) . ').'}}
@endsection