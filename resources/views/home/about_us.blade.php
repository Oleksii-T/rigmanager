@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.home')}}</title>
	<meta name="description" content="{{__('meta.description.home')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{__('ui.footerAbout')}}</span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='blog'/>

		<div class="content">
			<h1>{{__('ui.footerAbout')}}</h1>
			<article class="policy">
				<ol class="policy-list">
					<li>
						{{__('ui.workInProgress')}}
					</li>
				</ol>
			</article>
		</div>
	</div>
@endsection