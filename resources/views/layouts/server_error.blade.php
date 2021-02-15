@extends('layouts.page')

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">{{__('ui.error')}}</span></span>
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
                    <a href="{{ url()->previous() }}">{{__('ui.serverErrorGoBack')}}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
