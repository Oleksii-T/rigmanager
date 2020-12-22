@extends('layouts.mail')

@section('content')
    @if ($type==1)
        <p>{{__('mail.subExpired')}}</p>
    @elseif ($type==2)
        <p>{{__('mail.subWillExpire', ['date'=>$expire])}}</p>
    @endif

    <p>{{__('mail.subDetails')}} <a href="{{loc_url(route('profile.subscription'))}}">{{__('mail.subProfile')}}</a> {{__('mail.subOr')}} <a href="{{loc_url(route('plans'))}}">{{__('mail.subPlans')}}</a>.</p>
@endsection