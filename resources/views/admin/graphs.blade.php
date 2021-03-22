@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.admin')}}</title>
	<meta name="description" content="{{__('meta.description.user.admin')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('profile'))}}"><span itemprop="name">{{__('ui.profile')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Graphs</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='graphs'/>
        <div class="content">
            <h1>Graphs</h1>
            <div class="content-top-text"></div>
            <div class="faq">
				<div class="faq-item active">
					<a href="" id="our-purpose" class="faq-top active">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						TODO
					</a>
					<div class="faq-hidden" style="display: block">
						<p>TODO</p>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection