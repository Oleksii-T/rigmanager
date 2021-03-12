@extends('layouts.mail_plain')

@section('content')
    {{__('mail.subNotifSubject')}}

    @if ($type==1)
        {{__('mail.subExpired')}}
    @elseif ($type==2)
        {{__('mail.subWillExpire', ['date'=>$expire])}}
    @endif
    
    {{__('mail.subDetailsFull', ['profile'=>loc_url(route('profile.subscription')), 'plans'=>loc_url(route('plans'))])}}.
@endsection