@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/subscription_show.css')}}" />
    <link rel="stylesheet" href="{{asset('css/profile_layout.css')}}" />
@endsection

@section('content')
    <div id="profileContentWraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <ul>
                    <li><a id="personlaInfoBtn" href="{{route('profile')}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{route('mailer.index')}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{route('profile.subscription')}}">{{__('ui.mySubscription')}}</a></li>
                </ul>
            </nav>
            <div>
                <p id="in-progress" style="margin: 20px; font-size: 150%;">{{__('ui.workInProgress')}}</p>
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
