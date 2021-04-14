@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.info.sitemap')}}</title>
    <meta name="description" content="{{__('meta.description.info.sitemap')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{__('ui.footerSiteMap')}}</span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='sitemap'/>

		<div class="content">
			<h1>{{__('ui.footerSiteMap')}}</h1>
			<ul class="sitemap">
				<li><a href="">{{__('ui.stMain')}}</a>
					<ul class="sitemap-sub">
						<li><a href="{{loc_url(route('home'))}}">{{__('ui.home')}}</a></li>
						<li><a href="{{loc_url(route('catalog'))}}">{{__('ui.catalog')}}</a></li>
					</ul>
				</li>
				<li><a href="">{{__('ui.stPost')}}</a>
					<ul class="sitemap-sub">
						<li><a href="{{loc_url(route('posts.create'))}}">{{__('ui.addPostEq')}}</a></li>
						<li><a href="{{loc_url(route('service.create'))}}">{{__('ui.addPostSe')}}</a></li>
						<li><a class="not-ready" href="{{loc_url(route('tender.create'))}}">{{__('ui.addPostTe')}}</a></li>
					</ul>
				</li>
				<li><a href="">{{__('ui.stAuth')}}</a>
					<ul class="sitemap-sub">
						<li><a href="{{loc_url(route('login'))}}">{{__('ui.signIn')}}</a></li>
						<li><a href="{{route('login.social', ['social'=>'facebook'])}}">{{__('ui.signInVia')}} Facebook</a></li>
						<li><a href="{{route('login.social', ['social'=>'google'])}}">{{__('ui.signInVia')}} Google</a></li>
						<li><a href="{{loc_url(route('register'))}}">{{__('ui.signUp')}}</a></li>
					</ul>
				</li>
				<li><a href="">{{__('ui.stProfile')}}</a>
					<ul class="sitemap-sub">
						<li><a href="{{loc_url(route('profile'))}}">{{__('ui.profile')}}</a></li>
						<li><a href="{{loc_url(route('profile.posts'))}}">{{__('ui.myPosts')}}</a></li>
						<li><a href="{{loc_url(route('profile.favourites'))}}">{{__('ui.favourites')}}</a></li>
						<li><a href="{{loc_url(route('mailer.index'))}}">{{__('ui.mailer')}}</a></li>
						<li><a href="{{loc_url(route('profile.subscription'))}}">{{__('ui.mySubscription')}}</a></li>
					</ul>
				</li>
				<li><a href="">{{__('ui.info')}}</a>
					<ul class="sitemap-sub">
						<li><a href="{{loc_url(route('about.us'))}}">{{__('ui.footerAbout')}}</a></li>
						<li><a href="{{loc_url(route('blog'))}}">{{__('ui.footerBlog')}}</a></li>
						<li><a href="{{loc_url(route('terms'))}}">{{__('ui.footerTerms')}}</a></li>
						<li><a href="{{loc_url(route('privacy'))}}">{{__('ui.footerPrivacy')}}</a></li>
						<li><a href="{{loc_url(route('site.map'))}}">{{__('ui.footerSiteMap')}}</a></li>
						<li><a href="{{loc_url(route('plans'))}}">{{__('ui.footerSubscription')}}</a></li>
						<li><a href="{{loc_url(route('contacts'))}}">{{__('ui.footerContact')}}</a></li>
						<li><a href="{{loc_url(route('import.rules'))}}">{{__('postImportRules.title')}}</a></li>
						<li><a href="{{loc_url(route('faq'))}}">FAQ</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
@endsection