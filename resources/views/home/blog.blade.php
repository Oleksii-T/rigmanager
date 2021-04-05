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
			<h1>Блог</h1>
			<div class="blog">
				@foreach ($blogs as $b)
					<div class="blog-item">
						<div class="blog-img"><a href="{{loc_url(route('blog.article', ['article'=>$b->slug]))}}"><img src="{{$b->thumbnail}}" alt=""></a></div>
						<div class="blog-content">
							<div class="blog-title"><a href="{{loc_url(route('blog.article', ['article'=>$b->slug]))}}">{{$b->title_localed}}</a><span class="blog-date">{{$b->created_at->toDateString()}}</span></div>
							<div class="blog-text">{{$b->description}}</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection