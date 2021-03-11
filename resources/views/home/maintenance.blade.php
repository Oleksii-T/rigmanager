@extends('layouts.page')

@section('meta')
    <meta name="robots" content="index, nofollow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">{{__('ui.maintenance')}}</span></span>
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