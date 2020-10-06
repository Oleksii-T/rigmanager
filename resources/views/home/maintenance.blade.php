@extends('layouts.app')

@section('styles')
    <style>
        #header {
            background-color: transparent;
        }
        nav.main-navigation,
        footer,
        #logo,
        .logged-user-name {
            display: none;
        }
        .maintenance-view {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .maintenance-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 90%;
        }
        .logo {
            margin-bottom: 80px;
        }
        .line {
            width: 300px;
            border-bottom: 2px solid #888888;
            margin: 0 auto;
        }
        .header {
            font-size: 250%;
            margin: 20px 0px;
            letter-spacing: 10px;
            font-weight: 100;
        }
        .text {
            font-size: 160%;
            margin-top: 50px;
            margin-bottom: 50px;
            white-space: pre-line;
            line-height: 40px;
        }
        .text span {
            font-size: inherit;
            text-decoration: underline;
        }
        .contact-email {
            margin-bottom: 50px;
            display: block;
        }
        .copy {
            font-size: 85%;
            color: #888888;
        }
        .copy span {
            font-size: inherit;
            color: inherit;
        }
    </style>
@endsection

@section('content')
    <div class="maintenance-view">
        <div class="maintenance-content">
            <img class="logo" title="{{__('ui.home')}}" src="{{ asset('icons/logo3orange.png') }}" alt="{{__('alt.keyword')}}">
            <div class="line"></div>
            <h1 class="header">{{__('ui.maintenanceHeader')}}</h1>
            <div class="line"></div>
            <h2 class="text">{{__('ui.maintenanceText')}} <span>{{env('MAINTENANCE_END') ? env('MAINTENANCE_END') : __('ui.maintenanceSoon')}}</span></h2>
            <p class="contact contact-text">{{__('ui.maintenanceContact')}}</p>
            <a class="contact contact-email" href="mailto:{{env('MAIL_TO_ADDRESS')}}">{{env('MAIL_TO_ADDRESS')}}</a>
            <p class="copy">&copy; {{env('COPY_RIGHT_YEAR')}} <span>rigmanager.com.ua</span>. {{__('ui.footerCopyright')}}</p>
        </div>
    </div>
@endsection

@section('scripts')

@endsection