@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.info.blog')}}</title>
	<meta name="description" content="{{__('meta.description.info.blog')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{__('ui.footerBlog')}}</span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='blog'/>
        <div class="content">
            <article class="article">
                <h1>{{$blog->title_localed}}</h1>
                <p class="blog-misc-info">By <span>{{$blog->author_localed}}</span>, posted <span>{{$blog->created_at_readable}}</span>.</p>
                <a href="{{asset('icons/main-header-bg.jpg')}}" data-fancybox="blog-photos" class="article-img"><img src="{{asset('icons/main-header-bg.jpg')}}" alt=""></a>
                <p class="blog-paragraph">{{$blog->intro_localed}}</p>
                <p class="blog-paragraph">{{$blog->body_localed}}</p>
                <p class="blog-paragraph">{{$blog->outro_localed}}</p>
                @if ($blog->imgs)
                    <div class="blog-slideshow">
                        <a href="" class="prod-arrow prod-prev"></a>
                        <div class="blog-slider">
                            @foreach ($blog->imgs as $img)
                                <div class="blog-slider-slide">
                                    <a href="{{$img}}" data-fancybox="blog-photos" class="article-img"><img src="{{$img}}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                        <a href="" class="prod-arrow prod-next"></a>
                    </div>
                @endif
            </article>
        </div>
	</div>
@endsection