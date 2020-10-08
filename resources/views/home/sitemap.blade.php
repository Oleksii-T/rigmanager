@extends('layouts.app')

@section('styles')
    <style>
        #sitemap-wraper {
            padding: 20px;
        }
        p.page-desc {
            font-size: 130%;
            margin-bottom: 40px;
        }
        div.links-wraper {
            display: flex;
            justify-content: space-around;
        }
        div.col-1 {
        }
        .links {
            margin-bottom: 30px;
        }
        h3.links-title {
            font-size: 160%;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-weight: 50;
        }
        ul.links-list li{
            padding-left: 15px;
            margin-bottom: 5px;
            list-style-position: inside;
        }
        a.link{
            font-size: 130%;
            transition: 0.2s;
        }
        a.link:hover{
            color: #FE9042;
        }
    </style>
@endsection

@section('content')
    <div id="sitemap-wraper">
        <h1 class="page-title">{{__('ui.footerSiteMap')}}</h1>
        <p class="page-desc">{{__('ui.siteMapDesc')}}</p>
        <div class="links-wraper">
            <div class="col col-1">
                <div class="links home-links">
                    <h3 class="links-title">{{__('ui.stMain')}}</h3>
                    <ul class="links-list">
                        <li><a class="link" href="{{loc_url(route('home'))}}">{{__('ui.home')}}</a></li>
                    </ul>
                </div>
                <div class="links post-links">
                    <h3 class="links-title">{{__('ui.stPost')}}</h3>
                    <ul class="links-list">
                        <li><a class="link" href="{{loc_url(route('posts.create'))}}">{{__('ui.addPostEq')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('service.create'))}}">{{__('ui.addPostSe')}}</a></li>
                    </ul>
                </div>
                <div class="links auth-links">
                    <h3 class="links-title">{{__('ui.stAuth')}}</h3>
                    <ul class="links-list">
                        <li><a class="link" href="{{loc_url(route('login'))}}">{{__('ui.signIn')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('login.social', ['social'=>'facebook']))}}">{{__('ui.socialSignIn')}} Facebook</a></li>
                        <li><a class="link" href="{{loc_url(route('login.social', ['social'=>'google']))}}">{{__('ui.socialSignIn')}} Google</a></li>
                        <li><a class="link" href="{{loc_url(route('register'))}}">{{__('ui.signUp')}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col col-2">
                <div class="links profile-links">
                    <h3 class="links-title">{{__('ui.stProfile')}}</h3>
                    <ul class="links-list">
                        <li><a class="link" href="{{loc_url(route('profile'))}}">{{__('ui.profile')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('profile.posts'))}}">{{__('ui.myPosts')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('profile.favourites'))}}">{{__('ui.favourites')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('mailer.index'))}}">{{__('ui.mailer')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('profile.subscription'))}}">{{__('ui.mySubscription')}}</a></li>
                    </ul>
                </div>
                <div class="links footer-links">
                    <h3 class="links-title">{{__('ui.stMisc')}}</h3>
                    <ul class="links-list">
                        <li><a class="link" href="{{loc_url(route('faq'))}}">{{__('ui.foterFAQ')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('plans'))}}">{{__('ui.footerSubscription')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('privacy'))}}">{{__('ui.footerPrivacy')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('contacts'))}}">{{__('ui.footerContact')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('terms'))}}">{{__('ui.footerTerms')}}</a></li>
                        <li><a class="link" href="{{loc_url(route('site.map'))}}">{{__('ui.footerSiteMap')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection