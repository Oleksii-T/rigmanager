@extends('layouts.page')

@section('meta')
    <title>{{__('meta.title.home')}}</title>
    <meta name="description" content="{{__('meta.description.home')}}">
    <meta name="robots" content="index, nofollow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{__('ui.maintenance')}}</span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
    <div class="main-block">
        <div class="content maintenance">
            <h1 class="maintenance-header">{{__('ui.maintenanceHeader')}}</h1>
            <h2 class="maintenance-body">{{__('ui.maintenanceText')}} <span>{{env('MAINTENANCE_END') ? env('MAINTENANCE_END') : __('ui.maintenanceSoon')}}</span></h2>
            <p >{{__('ui.maintenanceContact')}}</p>
            <p>{{env('CONTACT_PHONE')}}<br>
                <a href="mailto:{{env('MAIL_TO_ADDRESS')}}">{{env('MAIL_TO_ADDRESS')}}</a></p>
            
        </div>
    </div>
@endsection