<header class="header">	
    <div class="holder">
        <div class="header-block">
            <a href="" class="mob-nav-icon"><span class="mob-nav-block"></span></a>
            <div class="header-logo">
                <a href="{{loc_url(route('home'))}}"><img src="{{asset('icons/logo-big.svg')}}" alt=""></a>
            </div>
            <a href="{{loc_url(route('catalog'))}}" class="header-catalog">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M0.000,11.000 L0.000,10.000 L11.000,10.000 L11.000,11.000 L0.000,11.000 ZM0.000,5.000 L11.000,5.000 L11.000,6.000 L0.000,6.000 L0.000,5.000 ZM0.000,0.000 L11.000,0.000 L11.000,1.000 L0.000,1.000 L0.000,0.000 Z"/>
                </svg>
                {{__('ui.catalog')}}
            </a>
            <div class="header-search">
                <a href="" class="header-search-link"></a>
                <div class="header-search-form">
                    <form action="{{loc_url(route('search'))}}">
                        <fieldset>
                            <input type="text" name="text" class="header-search-input" placeholder="{{__('ui.search')}}" required>
                            <button class="header-search-button"></button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="header-right">
                @if (!App::isLocale('uk'))
                    <a href="{{ loc_url(route('locale.setting', ['lang'=>'uk'])) }}" class="header-language">Ukr</a>
                @endif
                @if (!App::isLocale('ru'))
                    <a href="{{ loc_url(route('locale.setting', ['lang'=>'ru'])) }}" class="header-language">Rus</a>
                @endif
                @if (!App::isLocale('en'))
                    <a href="{{ loc_url(route('locale.setting', ['lang'=>'en'])) }}" class="header-language">Eng</a>
                @endif
                <a href="{{loc_url(route('profile'))}}" class="header-cabinet">{{auth()->check() ? __('ui.cabinet') : __('ui.signIn')}}</a>
                <a href="{{loc_url(route('posts.create'))}}" class="header-button">{{__('ui.addPost')}}</a>
            </div>
            <div class="mob-nav">
                <div class="holder">
                    <a href="{{loc_url(route('catalog'))}}" class="header-catalog">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M0.000,11.000 L0.000,10.000 L11.000,10.000 L11.000,11.000 L0.000,11.000 ZM0.000,5.000 L11.000,5.000 L11.000,6.000 L0.000,6.000 L0.000,5.000 ZM0.000,0.000 L11.000,0.000 L11.000,1.000 L0.000,1.000 L0.000,0.000 Z"/>
                        </svg>
                        {{__('ui.catalog')}}
                    </a>
                    <ul class="mob-nav-list">
                        <li><a href="{{loc_url(route('profile'))}}">{{auth()->check() ? __('ui.cabinet') : __('ui.signIn')}}</a></li>
                        <li><a href="{{loc_url(route('posts.create'))}}">{{__('ui.addPost')}}</a></li>
                    </ul>
                    <ul class="mob-nav-list">
                        <li><a href="{{loc_url(route('about.us'))}}">{{__('ui.footerAbout')}}</a></li>
                        <li><a href="{{loc_url(route('blog'))}}">{{__('ui.footerBlog')}}</a></li>
                        <li><a href="{{loc_url(route('plans'))}}">{{__('ui.footerSubscription')}}</a></li>
                        <li><a href="{{loc_url(route('contacts'))}}">{{__('ui.footerContact')}}</a></li>
                        <li><a href="{{loc_url(route('faq'))}}">FAQ</a></li>
                    </ul>
                    <ul class="mob-nav-list">
                        <li><a href="{{loc_url(route('search', ['type'=>'equipment-sell']))}}">{{__('ui.introSellEq')}}</a></li>
                        <li><a href="{{loc_url(route('search', ['type'=>'equipment-buy']))}}">{{__('ui.introBuyEq')}}</a></li>
                        <li><a href="{{loc_url(route('search', ['type'=>'services']))}}">{{__('ui.introSe')}}</a></li>
                        <li><a class="not-ready" href="{{loc_url(route('search', ['type'=>'tenders']))}}">{{__('ui.introTender')}}</a></li>
                    </ul>
                    <ul class="mob-nav-list">
                        @if (!App::isLocale('uk'))
                            <li><a href="{{ loc_url(route('locale.setting', ['lang'=>'uk'])) }}">Ukr</a></li>
                        @endif
                        @if (!App::isLocale('ru'))
                            <li><a href="{{ loc_url(route('locale.setting', ['lang'=>'ru'])) }}">Rus</a></li>
                        @endif
                        @if (!App::isLocale('en'))
                            <li><a href="{{ loc_url(route('locale.setting', ['lang'=>'en'])) }}">Eng</a></li>
                        @endif
                    </ul>
                    <ul class="mob-nav-list mob-nav-grey">
                        <li><a href="{{loc_url(route('terms'))}}">{{__('ui.footerTerms')}}</a></li>
                        <li><a href="{{loc_url(route('privacy'))}}">{{__('ui.footerPrivacy')}}</a></li>
                        <li><a href="{{loc_url(route('site.map'))}}">{{__('ui.footerSiteMap')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>	
</header>