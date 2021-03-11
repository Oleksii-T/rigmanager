@extends('layouts.page')

@section('meta')
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">{{__('ui.footerBlog')}}</span></span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='blog'/>

		<div class="content">
			<h1>{{__('ui.footerBlog')}}</h1>
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