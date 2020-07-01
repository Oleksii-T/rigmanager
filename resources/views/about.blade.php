@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}" />
@endsection

@section('content')
    <div id="aboutWraper">
        <div id="paragraphTitle">
            <h1>{{__('about.title')}} <span>rigmanager.com.ua</span>!</h1>
        </div>
        <div id="paragraphBody">
            <p id="intro">{{__('about.intro')}}</p>
            <h2 class="question">{{__('about.qPurpose')}}</h2>
            <p class="answer">{{__('about.aPurpose1')}}</p>
            <ul>
                <li>{{__('about.aPurposeListDrilling')}}</li>
                <li>{{__('about.aPurposeListRepair')}}</li>
                <li>{{__('about.aPurposeListProduction')}}</li>
                <li>{{__('about.aPurposeListLogging')}}</li>
            </ul>
            <p class="answer">{{__('about.aPurpose2')}}</p>

            <h2 class="question">{{__('about.qForWhat')}}</h2>
            <p class="answer">{{__('about.aForWhat')}}</p>

            <h2 class="question">{{__('about.qBuy')}}</h2>
            <p class="answer">{{__('about.aBuy1')}} <a href="{{ route('home') }}">{{__('about.aBuyLink')}}</a> {{__('about.aBuy2')}}</p>
            
            <h2 class="question">{{__('about.qSell')}}</h2>
            <p class="answer">{{__('about.aSell1')}} <a href="{{ route('posts.create') }}">{{__('about.aSellLink')}}</a>, {{__('about.aSell2')}}</p>

            <h2 class="question">{{__('about.qWhyWe')}}</h2>
            <p class="answer">{{__('about.aWhyWe')}}</p>
            
            <p id="slgText" id="sig">{{__('about.slg1')}} <span>rigmanager.com.ua</span>.
                {{__('about.slg2')}}</p>
            <a href = "mailto: web.rigmanager@gmail.com">web.rigmanager@gmail.com</a>
        </div>
    </div>
@endsection

@section('scripts')

@endsection