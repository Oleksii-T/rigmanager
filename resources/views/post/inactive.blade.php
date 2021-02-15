@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('catalog'))}}"><span itemprop="name">{{__('ui.catalog')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    @foreach ($post->tag_map as $id => $tag)
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('tag-'.$id))}}"><span itemprop="name">{{$tag}}</span></a>
            <meta itemprop="position" content="{{$loop->index+3}}" />
        </li>
        @if ($loop->last)
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                @if (!App::isLocale($post->origin_lang) && auth()->user()->is_standart && $post->{'title_'.App::getLocale()})
                    <span itemprop="item"><span itemprop="name">{{ $post->{'title_'.App::getLocale()} }}</span></span>
                @else
                    <span itemprop="item"><span itemprop="name">{{$post->title}}</span></span>
                @endif
                <meta itemprop="position" content="{{$loop->index+4}}" />
            </li>
        @endif
    @endforeach
@endsection

@section('content')
    <div class="main-block">
        <div class="content inactive-prod">
            <h1>{{__('ui.postInactiveError')}}</h1>
        </div>
    </div>
@endsection