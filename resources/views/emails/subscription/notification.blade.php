@extends('layouts.mail')

@section('intro')
    {{__('mail.subNotifSubject')}}
@endsection

@section('content')
    @if ($type==1)
        <p style="white-space:pre-line">{{__('mail.subExpired')}}</p>
    @elseif ($type==2)
        <p>{{__('mail.subWillExpire', ['date'=>$expire])}}</p>
    @endif
@endsection
    
@section('outro')
    {{__('mail.subDetails')}} <a href="{{loc_url(route('profile.subscription'))}}">{{__('mail.subProfile')}}</a> {{__('mail.subOr')}} <a href="{{loc_url(route('plans'))}}">{{__('mail.subPlans')}}</a>.
@endsection