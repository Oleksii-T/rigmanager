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
            <p class="answer">{{__('faq.aBuy1')}} <a class="link" href="{{ loc_url(route('home')) }}">{{__('faq.aBuyLink')}}</a> {{__('faq.aBuy2')}}</p>
            
            <a class="question" id="Sell">{{__('faq.qSell')}}</a>
            <p class="answer">{{__('faq.aSell1')}} <a class="link" href="{{ loc_url(route('posts.create')) }}">{{__('faq.aSellLink')}}</a>, {{__('faq.aSell2')}}</p>

            <a class="question" id="WhyWe">{{__('faq.qWhyWe')}}</a>
            <p class="answer">{{__('faq.aWhyWe')}}</p>

            <a class="question" id="WhatIsMailer">{{__('faq.qWhatIsMailer')}}</a>
            <p class="answer">{{__('faq.aWhatIsMailer1')}} <a class="link" href="{{loc_url(route('mailer.index'))}}">{{__('faq.aWhatIsMailerLink')}}</a> {{__('faq.aWhatIsMailer2')}}</p>

            <a class="question" id="WhatIsSocialAcc">{{__('faq.qWhatIsSocialAcc')}}</a>
            <p class="answer">{{__('faq.aWhatIsSocialAcc')}} <a class="link" href="{{loc_url(route('login.social', ['social'=>'google']))}}">Google</a> / <a class="link" href="{{loc_url(route('in.progress'))}}">Facebook</a>.</p><!--{{loc_url(route('login.social', ['social'=>'facebook']))}}-->
            
            <a class="question" id="autoTranslator">{{__('faq.qAutoTranslator')}}</a>
            <p class="answer">{{__('faq.aAutoTranslator')}}</p>

            <a class="question" id="release">{{__('faq.qRelease')}}</a>
            <p class="answer">{{__('faq.aRelease')}}</p>
            
            <div id="contacts">
                <p id="slgText" id="sig">{{__('faq.slg1')}} <span>rigmanager.com.ua</span>.
                    {{__('faq.slg2')}} <a class="link" href = "{{loc_url(route('contacts'))}}">{{__('faq.slg3')}}</a>.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection