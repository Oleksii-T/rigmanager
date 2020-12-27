@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_subsription.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <x-profile-nav/>
            </nav> 
            <div class="subscription-content">
                @if ($subscription && $subscription->is_active)
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
                @if ($subscription && $subscription->history)
                    <div class="history-wraper">
                        <button id="open-history">See subscription history</button>
                        <div class="history hidden">
                            <table>
                                <th>#</th>
                                <th>{{__('ui.from')}}</th>
                                <th>{{__('ui.to')}}</th>
                                <th>{{__('ui.planRole')}}</th>
                                <th>{{__('ui.payment')}}</th>
                                <th>{{__('ui.comment')}}</th>
                                @if ($subscription && $subscription->is_active)
                                    <tr>
                                        <td>{{count($subscription->history)+1}}</td>
                                        <td>{{$subscription->activated_at}}</td>
                                        <td>{{$subscription->expire_at}}</td>
                                        <td>{{$subscription->roleReadable}}</td>
                                        <td>{{$subscription->payment}}</td>
                                        <td>{{__('ui.active')}}</td>
                                    </tr>
                                @endif
                                @foreach (array_reverse($subscription->history, true) as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item['period']['from']}}</td>
                                        <td>{{$item['period']['to']}}</td>
                                        @if ($item['role'] == 1)
                                            <td>{{__('ui.planPremium')}}</td>
                                        @elseif ($item['role'] == 2)
                                            <td>{{__('ui.planPremium+')}}</td>
                                        @endif
                                        <td>{{$item['payment']}}</td>
                                        <td>{{$item['comment']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
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

            // show subsciption history
            $('#open-history').click(function(){
                $('.history').removeClass('hidden');
            });

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            // show message that free subscription can not be canceled
            $('.subscription-cancel').click(function(){
                showPopUpMassage(false, "{{ __('messages.planCancelPremium+') }}");
            });

        });
    </script>
@endsection
