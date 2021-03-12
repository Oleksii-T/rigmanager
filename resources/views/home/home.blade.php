@extends('layouts.app')

@section('meta')
    <title>{{__('meta.title.home')}}</title>
    <meta name="description" content="{{__('meta.description.home')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('page-content')
    <div class="header-main">
        <x-header/>
        <section class="top-section">
            <div class="holder">
                <h1>{{__('ui.introduction')}}</h1>
                <div class="top-links">
                    <div class="top-links-item">
                        <a href="{{loc_url(route('search', ['type'=>'equipment-sell']))}}">{{__('ui.introSellEq')}}</a>
                    </div>
                    <div class="top-links-item">
                        <a href="{{loc_url(route('search', ['type'=>'equipment-buy']))}}">{{__('ui.introBuyEq')}}</a>
                    </div>
                    <div class="top-links-item">
                        <a href="{{loc_url(route('search', ['type'=>'services']))}}">{{__('ui.introSe')}}</a>
                    </div>
                    <div class="top-links-item">
                        <a class="not-ready" href="{{loc_url(route('search', ['type'=>'tenders']))}}">{{__('ui.introTender')}}</a>
                    </div>
                </div>
                <div class="top-form">
                    <form action="{{loc_url(route('search'))}}">
                        <fieldset>
                            <div class="top-form-line">
                                <input type="text" class="input" name="text" placeholder="{{__('ui.search')}}" required>
                                <button class="button">{{__('ui.search')}}</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <section class="main-section">
        <div class="holder">
            <div class="main-category">
                <ul class="tabs">
                    <li><a href="#tab1">{{__('ui.equipment')}}</a></li>
                    <li><a href="#tab2">{{__('ui.service')}}</a></li>
                </ul>
                <div id="tab1" class="tab-content">
                    <div class="main-category-block">
                        <ul class="main-category-col">
                            <li><a href="{{loc_url(route('tag-1'))}}">{{__('tags.bit')}}</a></li>
                            <li><a href="{{loc_url(route('tag-2'))}}">{{__('tags.dp')}}</a></li>
                            <li><a href="{{loc_url(route('tag-3'))}}">{{__('tags.rig')}}</a></li>
                            <li><a href="{{loc_url(route('tag-4'))}}">{{__('tags.pump')}}</a></li>
                            <li><a href="{{loc_url(route('tag-5'))}}">{{__('tags.mud')}}</a></li>
                            <li><a href="{{loc_url(route('tag-6'))}}">{{__('tags.boreholeSurvey')}}</a></li>
                            <li><a href="{{loc_url(route('tag-7'))}}">{{__('tags.miscHelpEq')}}</a></li>
                            <li><a href="{{loc_url(route('tag-8'))}}">{{__('tags.motor')}}</a></li>
                            <li><a href="{{loc_url(route('tag-9'))}}">{{__('tags.parts')}}</a></li>
                            <li><a href="{{loc_url(route('tag-10'))}}">{{__('tags.control')}}</a></li>
                            <li><a href="{{loc_url(route('tag-11'))}}">{{__('tags.stub')}}</a></li>
                        </ul>
                        <ul class="main-category-col">
                            <li><a href="{{loc_url(route('tag-12'))}}">{{__('tags.camp')}}</a></li>
                            <li><a href="{{loc_url(route('tag-13'))}}">{{__('tags.casingCementing')}}</a></li>
                            <li><a href="{{loc_url(route('tag-14'))}}">{{__('tags.emergency')}}</a></li>
                            <li><a href="{{loc_url(route('tag-15'))}}">{{__('tags.lubricator')}}</a></li>
                            <li><a href="{{loc_url(route('tag-16'))}}">{{__('tags.tubingEq')}}</a></li>
                            <li><a href="{{loc_url(route('tag-17'))}}">{{__('tags.wellHeadEq')}}</a></li>
                            <li><a href="{{loc_url(route('tag-18'))}}">{{__('tags.packer')}}</a></li>
                            <li><a href="{{loc_url(route('tag-19'))}}">{{__('tags.airUtility')}}</a></li>
                            <li><a href="{{loc_url(route('tag-20'))}}">{{__('tags.boe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-21'))}}">{{__('tags.rotory')}}</a></li>
                            <li><a href="{{loc_url(route('tag-22'))}}">{{__('tags.power')}}</a></li>
                            <li><a href="{{loc_url(route('tag-23'))}}">{{__('tags.simCasing')}}</a></li>
                        </ul>
                        <ul class="main-category-col">
                            <li><a href="{{loc_url(route('tag-24'))}}">{{__('tags.diselStorage')}}</a></li>
                            <li><a href="{{loc_url(route('tag-25'))}}">{{__('tags.specMachinery')}}</a></li>
                            <li><a href="{{loc_url(route('tag-26'))}}">{{__('tags.lifting')}}</a></li>
                            <li><a href="{{loc_url(route('tag-27'))}}">{{__('tags.pipeHandling')}}</a></li>
                            <li><a href="{{loc_url(route('tag-28'))}}">{{__('tags.hseEq')}}</a></li>
                            <li><a href="{{loc_url(route('tag-29'))}}">{{__('tags.tong')}}</a></li>
                            <li><a href="{{loc_url(route('tag-30'))}}">{{__('tags.chemics')}}</a></li>
                            <li><a href="{{loc_url(route('tag-31'))}}">{{__('tags.chemLab')}}</a></li>
                            <li><a href="{{loc_url(route('tag-32'))}}">{{__('tags.jar')}}</a></li>
                            <li><a href="{{loc_url(route('tag-0'))}}">{{__('tags.other')}}</a></li>
                        </ul>
                        
                    </div>
                </div>
                <div id="tab2" class="tab-content">
                    <div class="main-category-block">
                        <ul class="main-category-col">
                            <li><a href="{{loc_url(route('tag-51'))}}">{{__('tags.multipleService')}}</a></li>
                            <li><a href="{{loc_url(route('tag-52'))}}">{{__('tags.emergencySe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-53'))}}">{{__('tags.controll')}}</a></li>
                            <li><a href="{{loc_url(route('tag-75'))}}">{{__('tags.drillingCntr')}}</a></li>
                            <li><a href="{{loc_url(route('tag-54'))}}">{{__('tags.airWaste')}}</a></li>
                            <li><a href="{{loc_url(route('tag-55'))}}">{{__('tags.loggingSe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-56'))}}">{{__('tags.ndt')}}</a></li>
                            <li><a href="{{loc_url(route('tag-57'))}}">{{__('tags.bitSe')}}</a></li>
                        </ul>
                        <ul class="main-category-col">
                            <li><a href="{{loc_url(route('tag-58'))}}">{{__('tags.dhmSe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-59'))}}">{{__('tags.grounding')}}</a></li>
                            <li><a href="{{loc_url(route('tag-61'))}}">{{__('tags.directionalDrilling')}}</a></li>
                            <li><a href="{{loc_url(route('tag-62'))}}">{{__('tags.casingSe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-63'))}}">{{__('tags.guard')}}</a></li>
                            <li><a href="{{loc_url(route('tag-64'))}}">{{__('tags.bopSe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-65'))}}">{{__('tags.training')}}</a></li>
                            <li><a href="{{loc_url(route('tag-66'))}}">{{__('tags.pipeShipment')}}</a></li>
                            <li><a href="{{loc_url(route('tag-67'))}}">{{__('tags.sellControllFuel')}}</a></li>
                        </ul>
                        <ul class="main-category-col">
                            <li><a href="{{loc_url(route('tag-68'))}}">{{__('tags.vihacle')}}</a></li>
                            <li><a href="{{loc_url(route('tag-69'))}}">{{__('tags.builders')}}</a></li>
                            <li><a href="{{loc_url(route('tag-70'))}}">{{__('tags.loggingSt')}}</a></li>
                            <li><a href="{{loc_url(route('tag-71'))}}">{{__('tags.transport')}}</a></li>
                            <li><a href="{{loc_url(route('tag-72'))}}">{{__('tags.recyclingSe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-73'))}}">{{__('tags.lab')}}</a></li>
                            <li><a href="{{loc_url(route('tag-74'))}}">{{__('tags.cementingSe')}}</a></li>
                            <li><a href="{{loc_url(route('tag-50'))}}">{{__('tags.otherService')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="brand-line">
                <div class="brand-slider">
                    @foreach ($partners as $partner)
                        <div class="brand-slide">
                            @if ($partner)
                                <a href="{{loc_url(route('search', ['author'=>$partner->user->url_name]))}}" class="brand-item"><img src="{{asset($partner->logo)}}" alt=""></a>
                            @else
                                <a href="{{loc_url(route('faq'))}}#WhatIsPartner" class="brand-item"><img src="{{asset('icons/partnerIcon.svg')}}" alt=""></a>
                            @endif
                        </div>
                    @endforeach
                    <div class="brand-slide">
                        <a href="#" class="brand-item brand-more not-ready">{{__('ui.otherPartners')}}</a>
                    </div>
                </div>
            </div>
            <div class="ad-section">
                <h2>{{__('ui.newPosts')}}</h2>
                <div class="ad-list">
                    <x-home-items :posts="$new_posts"/>
                    <div class="ad-col ad-col-more">
                        <a href="{{loc_url(route('list'))}}" class="ad-more">{{__('ui.morePosts')}}</a>
                    </div>
                </div>
            </div>
            @if ($urgent_posts->isNotEmpty())
                <div class="ad-section">
                    <h2>{{__('ui.urgentPosts')}}</h2>
                    <div class="ad-list">
                        <x-home-items :posts="$urgent_posts"/>
                    </div>
                    <!--
                    <div class="button-holder">
                        <a href="" class="button button-more">Більше пропозицій</a>
                    </div>
                    -->
                </div>
            @endif
        </div>
    </section>
    <section class="main-about">
        <div class="holder">
            <div class="main-about-block">
                <div class="main-about-logo">
                    <img src="{{asset('icons/logo-big.svg')}}" alt="">
                </div>
                <p>{{__('ui.epilogue1')}}</p>
                <p>{{__('ui.epilogue2')}}</p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection