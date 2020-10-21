@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home_plans.css')}}" />
@endsection

@section('content')
    <div class="plans-wraper">
        <div class="plans-content">
            <table class="plans-table">
                <caption>Cost and comparison of
                    rigmanager.com.ua plans
                </caption>
                <thead class="table-header">
                    <tr class="header plan-name">
                        <th></th>
                        <th>Guest
                            Account
                        </th>
                        <th>Premium
                            Account
                        </th>
                        <th>Premium+
                            Account
                        </th>
                    </tr>
                    <tr class="plan-sale">
                        <th></th>
                        <th></th>
                        <th>
                            <img src="{{asset('icons/saleIcon.svg')}}" alt="">
                            <span>100% off!</span>
                        </th>
                        <th>
                            <img src="{{asset('icons/saleIcon.svg')}}" alt="">
                            <span>100% off!</span>
                        </th>
                    </tr>
                    <tr class="header plan-cost">
                        <th></th>
                        <th>00.00$/month</th>
                        <th>00.00$/month</th>
                        <th>00.00$/month</th>
                    </tr>
                    <tr class="header plan-choose">
                        <th></th>
                        <th></th>
                        <th><button class="def-button choose-plan">Choose</button></th>
                        <th><button class="def-button choose-plan">Choose</button></th>
                    </tr>
                    <tr class="header plan-help">
                        <th></th>
                        <th class="plan-column">For those who want to get acquainted with our service</th>
                        <th class="plan-column">Suitable for most</th>
                        <th class="plan-column">Suitable for those who want to place a lot of Posts and for a long time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-key">Browse all posts</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Searching
                            <span>(by author, category, text)</span>
                        </td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Filtering</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Favourites</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">See contacts</td>
                        <td class="table-value">NO</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Create Post
                            <span>(lifetime < 2m, pices < 150)</span>
                        </td>
                        <td class="table-value">NO</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Mailer</td>
                        <td class="table-value">NO</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Auto-Translator</td>
                        <td class="table-value">NO</td>
                        <td class="table-value">YES</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Create Post
                            <span>(unlimited)</span>
                        </td>
                        <td class="table-value">NO</td>
                        <td class="table-value">NO</td>
                        <td class="table-value">YES</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-key">Premium Posts status</td>
                        <td class="table-value">NO</td>
                        <td class="table-value">NO</td>
                        <td class="table-value">YES</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

@endsection