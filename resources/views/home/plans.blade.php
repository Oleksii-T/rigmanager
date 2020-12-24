@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home_plans.css')}}" />
@endsection

@section('content')
    <div class="plans-wraper">
        <div class="plans-content">
            @if (Session::has('subscription-required'))
                <div class="subscription-required">
                    <p>{{Session::get('subscription-required')}}</p>
                </div>
            @endif
            <div class="free-access">
                <h2>{{__('ui.plansFreeAccessTitle')}}</h2>
                <p class="p-1">{{__('ui.plansFreeAccessBody1')}}</p>
                <p class="p-2">{{__('ui.plansFreeAccessBody2')}}</p>
                <p class="p-3">{{__('ui.plansFreeAccessBody3')}}</p>
            </div>
            <div class="deliter-line"></div>
            <h1 class="plans-caption">{{__('ui.plansHeader')}}</h1>
            <table class="plans-table">
                <thead class="table-header">
                    <tr class="header plan-name">
                        <th></th>
                        <th>{{__('ui.plansGuestAcc')}}
                        </th>
                        <th>{{__('ui.plansPremiumAcc')}}
                        </th>
                        <th>{{__('ui.plansPremium+Acc')}}
                        </th>
                    </tr>
                    <tr class="plan-sale">
                        <th></th>
                        <th></th>
                        <th>
                            <img src="{{asset('icons/saleIcon.svg')}}" alt="">
                            <span>100% {{__('ui.plansOff')}}!</span>
                        </th>
                        <th>
                            <img src="{{asset('icons/saleIcon.svg')}}" alt="">
                            <span>100% {{__('ui.plansOff')}}!</span>
                        </th>
                    </tr>
                    <tr class="header plan-cost">
                        <th></th>
                        <th>00.00₴ / {{__('ui.plansMonth')}}</th>
                        <th>00.00₴ / {{__('ui.plansMonth')}}</th>
                        <th>00.00₴ / {{__('ui.plansMonth')}}</th>
                    </tr>
                    <tr class="header plan-choose">
                        <th></th>
                        <th></th>
                        <th><button class="def-button">{{__('ui.plansChoose')}}</button></th>
                        <th><button class="def-button">{{__('ui.plansChoose')}}</button></th>
                    </tr>
                    <tr class="header plan-help">
                        <th></th>
                        <th class="plan-column">{{__('ui.plansGuestAccHelp')}}</th>
                        <th class="plan-column">{{__('ui.plansPremiumAccHelp')}}</th>
                        <th class="plan-column">{{__('ui.plansPremium+AccHelp')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansBrowse')}}</p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansSearch')}}<img class="help-img" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}"><span class="functionality-help hidden">{{__('ui.plansSearchHelp')}}</span></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansFilter')}}</p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansFav')}}</p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansContacts')}}</p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansCreate1')}}<img class="help-img" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}"><span class="functionality-help hidden">{{__('ui.plansCreate1Help')}}</span></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansMailer')}}<a class="help-link" href="{{loc_url(route('faq'))}}#WhatIsMailer">?</a></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansTranslate')}}<a class="help-link" href="{{loc_url(route('faq'))}}#autoTranslator">?</a></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansCreate2')}}<img class="help-img" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}"><span class="functionality-help hidden">{{__('ui.plansCreate2Help')}}</span></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.tenders')}}<img class="help-img" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}"><span class="functionality-help hidden">{{__('ui.tendersHelp')}}</span></p></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansPostImport')}}<a class="help-link" href="{{loc_url(route('faq'))}}#import">?</a></p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">
                            <p>{{__('ui.plansPostTracking')}}</p>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script id="widget-wfp-script" language="javascript" type="text/javascript" src="https://secure.wayforpay.com/server/pay-widget.js"></script>
    <script type="text/javascript">

        var wayforpay = new Wayforpay(); 	
        var pay = function () { 		
            wayforpay.run(
                {			
                    "requestType": "CREATE",
                    "merchantAccount": "test_merch_n1",
                    "merchantPassword": "d485396ae413eb60dc251b0899b261c2",
                    "regularMode": "monthly",
                    "amount": "10",
                    "currency": "UAH",
                    "dateBegin": "01.11.2020",
                    "dateEnd": "01.02.2021",
                    "orderReference": "P21435306374431",
                    "email": "alex.media.t@gmail.com"
                }, 			
                function (response) {
                    console.log ('approved.');
                    console.log (response);
                    // on approved				 			
                }, 			
                function (response) {
                    console.log ('declined');
                    console.log (response);
                    // on declined 			
                }, 			
                function (response) {
                    console.log ('pending or in pocessing...');
                    console.log (response);
                    // on pending or in processing 			
                } 		
            );
        }

        $(document).ready(function(){

            $('.help-img').hover(
                function() {
                    $(this).parent().find('span').removeClass('hidden');
                }, function() {
                    $(this).parent().find('span').addClass('hidden');
                }
            );

            isLoggedIn = "{{Auth::check()}}";
            $('.plan-choose button').click(function(){
                if (isLoggedIn) {
                    showPopUpMassage(true, "{{ __('messages.planAlreadyPremium+') }}");
                } else {
                    showPopUpMassage(false, "{{ __('messages.authError') }}");
                }
            });
        });
    </script>
@endsection