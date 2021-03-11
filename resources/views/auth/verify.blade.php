@extends('layouts.page')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.registerVerify')}}</span></span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active=''/>
        <div class="content">
            <h1>{{__('ui.verifyNoticeThank')}}</h1>
            <p>{{__('ui.verifyNoticeBody')}}</p>
            <form method="POST" action="{{ loc_url(route('verification.resend')) }}">
                @csrf
                <button type="submit" class="button">{{ __('ui.verifyClickToResend') }}</button>
            </form>
            @if (session('resent'))
                <div id="resendBody">
                    <p>{{__('ui.verifyNoticeResend')}}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
