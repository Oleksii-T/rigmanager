@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.info')}}</title>
	<meta name="description" content="{{__('meta.description.user.info')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{__('ui.profileInfo')}}</span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='profile'/>
        <div class="content">
            <h1>{{__('ui.profileInfo')}}</h1>
            <div class="profile">
                <div class="profile-side">
                    @if ($user->image)
                        <div class="profile-ava" style="background-image:url({{$user->image->url}})"></div>
                    @else
                        <div class="profile-ava" style="background-image:url({{asset('icons/emptyAva.svg')}})"></div>
                    @endif
                    <br>
                    <a href="{{loc_url(route('profile.edit'))}}" class="profile-edit-link">{{__('ui.edit')}}<br>{{__('ui.profile')}}</a>
                </div>
                <div class="profile-content">
                    <div class="profile-name">{{$user->name}}
                        @if ($user->is_social)
                            <br>
                            <a href="{{loc_url(route('faq'))}}#WhatIsSocialAcc">{{__('ui.socialAcc')}}</a>
                        @endif
                    </div>
                    <div class="profile-info">
                        <div class="profile-info-title">{{__('ui.phone')}}</div>
                        @if ($user->phone_raw)
                            <div class="profile-info-text">{{$user->phone_intern}}</div>
                        @else
                            <div class="profile-info-text">{{__('ui.notSpecified')}}</div>
                        @endif
                    </div>
                    <div class="profile-info">
                        <div class="profile-info-title">{{__('ui.login')}}</div>
                        <div class="profile-info-text">{{$user->email}}</div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-info-title">{{__('ui.subscription')}}</div>
                        @if ( auth()->user()->subscription && auth()->user()->subscription->is_active )
                            <div class="profile-info-text green">{{__('ui.active')}} «{{auth()->user()->subscription->role_readable}}» {{__('ui.until')}} {{auth()->user()->subscription->expire_at}}</div>
                        @else
                            <div class="profile-info-text">{{__('ui.inactive')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection