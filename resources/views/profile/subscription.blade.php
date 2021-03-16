@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.subscription')}}</title>
	<meta name="description" content="{{__('meta.description.user.subscription')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{__('ui.mySubscription')}}</span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='subscription'/>
        <div class="content">
            <h1>{{__('ui.mySubscription')}}</h1>
            <div class="pack">
                <div class="pack-side">
                    @if (auth()->user()->subscription && auth()->user()->subscription->is_active)
                        <div class="pack-name">{{__('ui.planActivated')}} «<span class="orange">{{auth()->user()->subscription->role_readable}}</span>»</div>
                        <div class="pack-text"><span class="pack-text-min">{{__('ui.planActiveTo')}} {{auth()->user()->subscription->expire_at}}</span>  / <a class="not-ready" href="#">{{__('ui.planCancel')}}</a></div>
                    @else
                        <div class="pack-name">{{__('ui.planActivated')}} «<span class="orange">{{__('ui.planStart')}}</span>»</div>
                        <div class="pack-text"><span class="pack-text-min">{{__('ui.planStartChoosedHelp')}}</span></div>
                    @endif
                </div>
                <div class="pack-button">
                    <a href="{{loc_url(route('plans'))}}" class="button button-light">{{__('ui.changePlan')}}</a>
                </div>
            </div>
            
            <div class="history">
                <div class="history-top">
                    <div class="history-title">{{__('ui.history')}}</div>
                </div>
                <div class="history-table">
                    <table>
                        <tr>
                            <th>№ {{__('ui.operation')}}</th>
                            <th>{{__('ui.planRole')}}</th>
                            <th>{{__('ui.from')}}</th>
                            <th>{{__('ui.to')}}</th>
                            <th>{{__('ui.payment')}}</th>
                            <th>{{__('ui.status')}}</th>
                        </tr>
                        @if ($subscription && $subscription->is_active)
                            <tr>
                                <td>{{$subscription->number}} <span class="history-table-date">{{$subscription->issued}}</span></td>
                                <td>{{$subscription->roleReadable}}</td>
                                <td>{{$subscription->activated_at}}</td>
                                <td>{{$subscription->expire_at}}</td>
                                <td>{{$subscription->payment}}</td>
                                <td><span class="history-status history-status-active">{{__('ui.active')}}</span></td>
                            </tr>
                        @endif
                        @if ($subscription && $subscription->history)
                            @foreach (array_reverse($subscription->history, true) as $item)
                                <tr>
                                    <td>{{$item['number']}} <span class="history-table-date">{{$item['issued']}}</span></td>
                                    @if ($item['role'] == 1)
                                        <td>{{__('ui.planStandart')}}</td>
                                    @elseif ($item['role'] == 2)
                                        <td>{{__('ui.planPro')}}</td>
                                    @endif
                                    <td>{{$item['period']['from']}}</td>
                                    <td>{{$item['period']['to']}}</td>
                                    <td>{{$item['payment']}}</td>
                                    @if ($item['status']==0)
                                        <td><span class="history-status">{{__('ui.expired')}}</span></td>
                                    @elseif ($item['status']==1)
                                        <td><span class="history-status">{{__('ui.canceled')}}</span></td>
                                    @else
                                        <td><span class="history-status">{{__('ui.inactive')}}</span></td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            
        </div>
    </div>
@endsection
