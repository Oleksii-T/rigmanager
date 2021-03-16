@extends('layouts.page')

@section('meta')
    <title>{{__('meta.title.error')}}</title>
    <meta name="description" content="{{__('meta.description.error')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{__('ui.error')}}</span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
<div class="main-block">
    <div class="content">
        <div class="server-error">
            <div>
                <h3>{{__('ui.serverErrorTittle')}}</h3>
                <p>{{__('ui.serverErrorDesc')}}</p>
                <p>
                    @yield('error')
                </p>
                <p><a href="{{loc_url(route('contacts'))}}">{{__('ui.serverErrorContact')}}</a>
                    <br>
                    <a href="{{loc_url(route('home'))}}">{{__('ui.serverErrorGoHome')}}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
