@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home_faq.css') }}" />
@endsection

@section('content')
    <div id="aboutWraper">
        <div id="paragraphTitle">
            <h1>{{__('faq.intro')}}</h1>
        </div>
        <div id="paragraphBody">
            
            <h2 class="question">{{__('faq.qPurpose')}}</h2>
            <p class="answer">{{__('faq.aPurpose1')}}</p>
            <ul>
                <li>{{__('faq.aPurposeListDrilling')}}</li>
                <li>{{__('faq.aPurposeListRepair')}}</li>
                <li>{{__('faq.aPurposeListProduction')}}</li>
                <li>{{__('faq.aPurposeListLogging')}}</li>
            </ul>
            <p class="answer">{{__('faq.aPurpose2')}}</p>

            <h2 class="question">{{__('faq.qForWhat')}}</h2>
            <p class="answer">{{__('faq.aForWhat')}}</p>

            <h2 class="question">{{__('faq.qBuy')}}</h2>
            <p class="answer">{{__('faq.aBuy1')}} <a href="{{ route('home') }}">{{__('faq.aBuyLink')}}</a> {{__('faq.aBuy2')}}</p>
            
            <h2 class="question">{{__('faq.qSell')}}</h2>
            <p class="answer">{{__('faq.aSell1')}} <a href="{{ route('posts.create') }}">{{__('faq.aSellLink')}}</a>, {{__('faq.aSell2')}}</p>

            <h2 class="question">{{__('faq.qWhyWe')}}</h2>
            <p class="answer">{{__('faq.aWhyWe')}}</p>
            
            <p id="slgText" id="sig">{{__('faq.slg1')}} <span>rigmanager.com.ua</span>.
                {{__('faq.slg2')}}</p>
            <a href = "mailto: web.rigmanager@gmail.com">web.rigmanager@gmail.com</a>
        </div>
    </div>
@endsection

@section('scripts')

@endsection