@extends('layouts.mail_plain')

@section('content')
    {{__('ui.postHiddenNotifHeader')}}.

    @foreach ($found_posts as $p)
        {{$loop->index+1 . '. ' . $p['title'] . ' ('.loc_url(route('posts.show', ['post'=>$p['url_name']])).')'}}
        
    @endforeach

    {{__('ui.postHiddenNotifBody1')}}
@endsection