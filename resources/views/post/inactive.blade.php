@extends('layouts.page')

@section('meta')
    <title>{{$post->title . ' - ' . $post->tag_map[array_key_last($post->tag_map)] . ' ' . __('meta.title.post.inactive')}}</title>
    <meta name="description" content="{{($post->cost ? $post->cost_readable : '') . ': ' . (strlen($post->description)>90 ? substr($post->description, 0, 90) . '...' : $post->description)}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('catalog'))}}"><span itemprop="name">{{__('ui.catalog')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    @foreach ($post->tag_map as $id => $tag)
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('tag-'.$id))}}"><span itemprop="name">{{$tag}}</span></a>
            <meta itemprop="position" content="{{$loop->index+3}}" />
        </li>
        @if ($loop->last)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if (auth()->user() && !App::isLocale($post->origin_lang) && auth()->user()->is_standart && $post->{'title_'.App::getLocale()})
                    <span itemprop="name">{{ $post->{'title_'.App::getLocale()} }}</span>
                @else
                    <span itemprop="name">{{$post->title}}</span>
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