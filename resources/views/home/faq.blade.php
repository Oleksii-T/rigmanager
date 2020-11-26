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

            <a class="question" id="ForWhat">{{__('faq.qForWhat')}}</a>
            <p class="answer">{{__('faq.aForWhat1')}}</p>
            <ul>
                <li>{{__('faq.aForWhatCM1')}}</li>
                <li>{{__('faq.aForWhatCM2')}}</li>
                <li>{{__('faq.aForWhatCM3')}}</li>
            </ul>
            <p class="answer">{{__('faq.aForWhat2')}}</p>
            <ul>
                <li>{{__('faq.aForWhatSD1')}}</li>
                <li>{{__('faq.aForWhatSD2')}}</li>
                <li>{{__('faq.aForWhatSD3')}}</li>
                <li>{{__('faq.aForWhatSD4')}}</li>
                <li>{{__('faq.aForWhatSD5')}}</li>
                <li>{{__('faq.aForWhatSD6')}}</li>
            </ul>
            <p class="answer">{{__('faq.aForWhat3')}}</p>
            <ul>
                <li>{{__('faq.aForWhatSaD1')}}</li>
                <li>{{__('faq.aForWhatSaD2')}}</li>
                <li>{{__('faq.aForWhatSaD3')}}</li>
                <li>{{__('faq.aForWhatSaD4')}}</li>
            </ul>

            <a class="question" id="WhyWe">{{__('faq.qWhyWe')}}</a>
            <p class="answer">{{__('faq.aWhyWe')}}</p>

            <a class="question" id="Buy">{{__('faq.qBuy')}}</a>
            <p class="answer">{{__('faq.aBuy1')}} <a class="link" href="{{ loc_url(route('home')) }}">{{__('faq.aBuyLink')}}</a> {{__('faq.aBuy2')}}</p>

            <a class="question" id="Sell">{{__('faq.qSell')}}</a>
            <p class="answer">{{__('faq.aSell1')}} <a class="link" href="{{ loc_url(route('posts.create')) }}">{{__('faq.aSellLink')}}</a>, {{__('faq.aSell2')}}</p>

            <a class="question" id="WhatIsMailer">{{__('faq.qWhatIsMailer')}}</a>
            <p class="answer">{{__('faq.aWhatIsMailer1')}} <a class="link" href="{{loc_url(route('mailer.index'))}}">{{__('faq.aWhatIsMailerLink')}}</a> {{__('faq.aWhatIsMailer2')}}</p>

            <a class="question" id="WhatIsSocialAcc">{{__('faq.qWhatIsSocialAcc')}}</a>
            <p class="answer">{{__('faq.aWhatIsSocialAcc')}} <a class="link" href="{{loc_url(route('login.social', ['social'=>'google']))}}">Google</a> / <a class="link" href="{{route('login.social', ['social'=>'facebook'])}}">Facebook</a>.</p>

            <a class="question" id="autoTranslator">{{__('faq.qAutoTranslator')}}</a>
            <p class="answer">{{__('faq.aAutoTranslator')}}</p>

            <a class="question" id="premiumPost">{{__('faq.qPremiumPost')}}</a>
            <p class="answer">{{__('faq.aPremiumPost')}}</p>

            <a class="question" id="import">{{__('faq.qImport')}}</a>
            <p class="answer">{{__('faq.aImport')}}</p>

            <a class="question" id="postTracker">{{__('faq.qPostTracker')}}</a>
            <p class="answer">{{__('faq.aPostTracker')}}</p>

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