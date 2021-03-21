@extends('layouts.page')

@section('meta')
    <title>{{$post->title_localed . ' - ' . $post->tag_map[array_key_last($post->tag_map)] . ' ' . __('meta.title.post.inactive')}}</title>
    <meta name="description" content="{{($post->cost ? $post->cost_readable : '') . ': ' . (strlen($post->description_localed)>90 ? substr($post->description_localed, 0, 90) . '...' : $post->description_localed)}}">
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
                <span itemprop="name">{{$post->title_localed}}</span>
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