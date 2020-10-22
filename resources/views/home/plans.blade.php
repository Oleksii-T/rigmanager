@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home_plans.css')}}" />
@endsection

@section('content')
    <div class="plans-wraper">
        <div class="plans-content">
            <div class="free-access">
                <h2>{{__('ui.plansFreeAccessTitle')}}</h2>
                <p class="p-1">{{__('ui.plansFreeAccessBody1')}}</p>
                <p class="p-2">{{__('ui.plansFreeAccessBody2')}}</p>
                <p class="p-3">{{__('ui.plansFreeAccessBody3')}}</p>
            </div>
            <div class="deliter-line"></div>
            <table class="plans-table">
                <caption>{{__('ui.plansHeader')}}
                </caption>
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
                        <td class="table-key">{{__('ui.plansBrowse')}}</td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansSearch')}}
                            <span>{{__('ui.plansSearchHelp')}}</span>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansFilter')}}</td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansFav')}}</td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansContacts')}}</td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansCreate1')}}
                            <span>{{__('ui.plansCreate1Help')}}</span>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansMailer')}}</td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansTranslator')}}</td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansCreate2')}}
                            <span>{{__('ui.plansCreate2Help')}}</span>
                        </td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/noIcon.svg')}}" alt=""></td>
                        <td class="table-value"><img src="{{asset('icons/yesIcon.svg')}}" alt=""></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">{{__('ui.plansTopPost')}}</td>
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
    <script type="text/javascript">
        $(document).ready(function(){
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