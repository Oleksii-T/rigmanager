@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_subsription.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <ul>
                    <li><a id="personlaInfoBtn" href="{{loc_url(route('profile'))}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{loc_url(route('mailer.index'))}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{loc_url(route('profile.subscription'))}}">{{__('ui.mySubscription')}}</a></li>
                </ul>
            </nav>
            <div class="subscription-content">
                @if ($subscription)
                    <p class="subscription-header">{{__('ui.planStatus')}}</p>
                    <h1 class="subscription-plan">{{$subscription->roleReadable}}</h1>
                    <p class="subscription-active-to">{{__('ui.planActiveTo')}}: {{$subscription->expire_at_readable}}</p>
                @else
                    <p class="subscription-header">{{__('ui.planNotActive')}}</p>
                @endif
                <div class="deliter-line"></div>
                <p class="subscription-more">{{__('ui.planDetails')}}</p>
                <a class="def-button subscription-plans" href="{{loc_url(route('plans'))}}">{{__('ui.planDetailsBtn')}}</a>
                <br>
                @if ($subscription)
                    <button class="def-button delete-button subscription-cancel">{{__('ui.planCancel')}}</button>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            $('.subscription-cancel').click(function(){
                showPopUpMassage(false, "{{ __('messages.planCancelPremium+') }}");
            });

        });
    </script>
@endsection
