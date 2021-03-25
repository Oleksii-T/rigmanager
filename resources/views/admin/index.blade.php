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
        <span itemprop="name">Overview</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='overview'/>
        <div class="content">
            <h1>Overview</h1>
            <div class="content-top-text"></div>
            <div class="faq">
				<div class="faq-item active">
					<a href="" id="our-purpose" class="faq-top active">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						Posts
					</a>
					<div class="faq-hidden" style="display: block">
						<p>Overall: {{\App\Post::all()->count()}}</p>
						<p>Hidden: {{\App\Post::where('is_active', '0')->count()}}</p>
						<p>Not verified: {{\App\Post::where('is_verified', false)->count()}}</p>
						<p>Created last day: {{\App\Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(1))->count()}}</p>
						@if (\App\Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(1))->count() != 0)
							<ol>
								@foreach (\App\Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(1))->get() as $p)
									<li><a class="orange" href="{{loc_url(route('posts.show', ['post'=>$p->url_name]))}}">{{$p->title}}</a></li>
								@endforeach
							</ol>
						@endif
						<p>Created last week: {{\App\Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(7))->count()}}</p>
						@if (\App\Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(7))->count() != 0)
							<ol>
								@foreach (\App\Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(7))->get() as $p)
									<li><a class="orange" href="{{loc_url(route('posts.show', ['post'=>$p->url_name]))}}">{{$p->title}}</a>. verified={{$p->is_verified}}</li>
								@endforeach
							</ol>
						@endif
					</div>
				</div>
				<div class="faq-item active">
					<a href="" id="our-purpose" class="faq-top active">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						Users
					</a>
					<div class="faq-hidden" style="display: block">
						<p>Overall: {{\App\User::all()->count()}}</p>
						<p>Not verified: {{\App\User::where('email_verified_at', 'null')->get()->count()}}</p>
						<p>Google acc: {{\App\User::where('google_id', '!=', 'null')->get()->count()}}</p>
						<p>Facebook acc: {{\App\User::where('facebook_id', '!=', 'null')->get()->count()}}</p>
						<p>Created last day: {{\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(1))->count()}}</p>
						@if (\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(1))->count() != 0)
							<ol>
								@foreach (\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(1))->get() as $u)
									<li>{{$u->name}}. Id={{$u->id}}. Verified={{$u->email_verified_at}}. Posts={{$u->posts()->count()}}</li>
								@endforeach
							</ol>
						@endif
						<p>Created last week: {{\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(7))->count()}}</p>
						@if (\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(7))->count() != 0)
							<ol>
								@foreach (\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(7))->get() as $u)
									<li>{{$u->name}}. Id={{$u->id}}. Verified={{$u->email_verified_at}}. Posts={{$u->posts()->count()}}</li>
								@endforeach
							</ol>
						@endif
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection