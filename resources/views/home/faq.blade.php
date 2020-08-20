@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_faq.css') }}" />
@endsection

@section('content')
    <div id="aboutWraper">
        <div id="paragraphTitle">
            <h1>{{__('faq.intro')}}</h1>
        </div>
        <div id="paragraphBody">
            
            <a class="question" id="Purpose">{{__('faq.qPurpose')}}</a>
            <p class="answer">{{__('faq.aPurpose1')}}</p>
            <ul>
                <li>{{__('faq.aPurposeListDrilling')}}</li>
                <li>{{__('faq.aPurposeListRepair')}}</li>
                <li>{{__('faq.aPurposeListProduction')}}</li>
                <li>{{__('faq.aPurposeListLogging')}}</li>
            </ul>
            <p class="answer">{{__('faq.aPurpose2')}}</p>

            <a class="question" id="ForWhat">{{__('faq.qForWhat')}}</a>
            <p class="answer">{{__('faq.aForWhat')}}</p>

            <a class="question" id="Buy">{{__('faq.qBuy')}}</a>
            <p class="answer">{{__('faq.aBuy1')}} <a class="link" href="{{ route('home') }}">{{__('faq.aBuyLink')}}</a> {{__('faq.aBuy2')}}</p>
            
            <a class="question" id="Sell">{{__('faq.qSell')}}</a>
            <p class="answer">{{__('faq.aSell1')}} <a class="link" href="{{ route('posts.create') }}">{{__('faq.aSellLink')}}</a>, {{__('faq.aSell2')}}</p>

            <a class="question" id="WhyWe">{{__('faq.qWhyWe')}}</a>
            <p class="answer">{{__('faq.aWhyWe')}}</p>

            <a class="question" id="WhatIsMailer">{{__('faq.qWhatIsMailer')}}</a>
            <p class="answer">{{__('faq.aWhatIsMailer1')}} <a class="link" href="{{route('mailer.index')}}">{{__('faq.aWhatIsMailerLink')}}</a> {{__('faq.aWhatIsMailer2')}}</p>
            
            <div id="contacts">
                <p id="slgText" id="sig">{{__('faq.slg1')}} <span>rigmanager.com.ua</span>.
                    {{__('faq.slg2')}}</p>
                <a class="link" href = "mailto: web.rigmanager@gmail.com">web.rigmanager@gmail.com</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection