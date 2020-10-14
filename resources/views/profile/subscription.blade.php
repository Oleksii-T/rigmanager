@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/subscription_show.css')}}" />
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
            <div>
                <x-in-progress/>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

        });
    </script>
@endsection
