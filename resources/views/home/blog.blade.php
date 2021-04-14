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
			<h1>{{__('ui.footerBlog')}}</h1>
			@if ($blogs->isEmpty())
				<p>{{__('ui.emptyBlog')}}</p>
			@else
				<div class="catalog blog">
					@foreach ($blogs as $b)
						<div class="catalog-item">
							<a href="{{loc_url(route('blog.article', ['article'=>$b->slug]))}}" class="catalog-img"><img src="{{$b->thumbnail}}" alt=""></a>
							<div class="catalog-content">
								<div class="catalog-name"><a href="{{loc_url(route('blog.article', ['article'=>$b->slug]))}}">{{$b->title_localed}}</a><span class="blog-date">{{$b->created_at->toDateString()}}</span></div>
								<div class="catalog-text">{{preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $b->description)}}</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="pagination-field">
					{{$blogs->appends(request()->input())->links()}}
				</div>				
			@endif
		</div>
	</div>
@endsection