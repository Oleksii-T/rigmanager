@extends('layouts.page')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    @if (isset($post))
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('profile.posts'))}}"><span itemprop="name">{{__('ui.myPosts')}}</span></a>
            <meta itemprop="position" content="2" />
        </li>
        <li class="crop-bc-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            @if (!App::isLocale($post->origin_lang) && auth()->user()->is_standart && $post->{'title_'.App::getLocale()})
                <a itemprop="item" href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}"><span itemprop="name">{{ $post->{'title_'.App::getLocale()} }}</span></a>
            @else
                <a itemprop="item" href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}"><span itemprop="name">{{$post->title}}</span></a>
            @endif
            <meta itemprop="position" content="3" />
        </li>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('posts.edit', ['post'=>$post->url_name]))}}"><span itemprop="name">{{__('ui.postSettings')}}</span></a>
            <meta itemprop="position" content="4" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name">{{__('ui.postTransSettings')}}</span>
            <meta itemprop="position" content="5" />
        </li>
    @endif
@endsection

@section('content')
	<div class="main-block">
        <x-profile-nav active='posts'/>

		<div class="content">
			<h1>{{__('ui.postTransSettings')}}</h1>
			<p>{{__('ui.workInProgress')}}</p>
		</div>
	</div>
@endsection