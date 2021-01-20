<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- meta -->
    @yield('meta')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">  -->

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components/popUpAndFlash.css') }}" >
    @yield('styles')
</head>
<body>

    <div class="development-notif">
        <p>{{__('ui.development')}}</p>
    </div>

    <div class="mobile-alert">
        <p>{{__('ui.mobileDev')}}</p>
    </div>

    <div id="app">
        <div id="pop-up-container">
            <!-- Session flash massages -->
            @if (Session::has('message-success'))
                <div class="flash flash-success">
                    <p><img src="{{asset('icons/successIcon.svg')}}" alt="{{__('alt.keyword')}}">{{ Session::get('message-success') }}</p>
                    <div class="animated-line"></div>
                </div>
            @endif
            @if (Session::has('message-error'))
                <div class="flash flash-error">
                    <p><img src="{{asset('icons/alertIcon.svg')}}" alt="{{__('alt.keyword')}}">{{ Session::get('message-error') }}</p>
                    <div class="animated-line"></div>
                </div>
            @endif
            @if (session('status'))
                <div class="flash flash-success">
                    <p><img src="{{asset('icons/successIcon.svg')}}" alt="{{__('alt.keyword')}}">{{ session('status') }}</p>
                    <div class="animated-line"></div>
                </div>
            @endif
        </div>

        <div class="side-background"></div>

        <div id="container">
            <header>
                <div class="header-l">
                    <a class="header-logo" href="{{ loc_url(route('home')) }}"><img title="{{__('ui.home')}}" src="{{ asset('icons/rigmanagerLogoIcon.svg') }}" alt="{{__('alt.keyword')}}"></a>
                    <a class="header-catalog header-btn" href="{{ loc_url(route('list')) }}"><span><img src="{{asset('icons/catalogIcon.svg')}}" alt=""></span>{{__('ui.catalog')}}</a>
                </div>
                <div class="header-r">
                    <a class="header-add-post header-btn" href="{{ loc_url(route('posts.create')) }}">{{__('ui.addPost')}}</a>
                    @guest
                        <a class="header-profile header-btn" href="{{loc_url(route('login'))}}">{{__('ui.signIn')}}</a>
                    @else
                        <a class="header-profile header-btn" href="{{loc_url(route('profile'))}}">{{__('ui.cabinet')}}</a>
                    @endguest
                    @if (!App::isLocale('uk'))
                        <a class="header-locale" href="{{ loc_url(route('locale.setting', ['lang'=>'uk'])) }}">UKR</a>
                    @endif
                    @if (!App::isLocale('ru'))
                        <a class="header-locale" href="{{ loc_url(route('locale.setting', ['lang'=>'ru'])) }}">RU</a>
                    @endif
                    @if (!App::isLocale('en'))
                        <a class="header-locale" href="{{ loc_url(route('locale.setting', ['lang'=>'en'])) }}">ENG</a>
                    @endif
                </div>
            </header>

            <main>
                @yield('content')
            </main>

            <footer class="footer">
                <!--
                <div class="footel-layer footer-partners">
                    <p class="partners-title">{{__('ui.ourPartners')}}</p>
                    <x-partners/>
                </div>

                <div class="footer-delim"></div>
                -->

                <div class="footel-layer footer-slg">
                    <div class="footer-keywords">
                        <p>&copy; {{env('COPY_RIGHT_YEAR')}} <span>«Rigmanager»</span> - {{__('ui.introduction')}}.</p>
                        <p>{{__('ui.footerCopyright')}}</p>
                    </div>

                    <div class="footer-links">
                        <table>
                            <tr>
                                <td><a class="footer-link not-allowed" href="{{loc_url(route('home'))}}">{{__('ui.footerAbout')}}</a></td>
                                <td><a class="footer-link" href="{{loc_url(route('plans'))}}">{{__('ui.footerSubscription')}}</a></td>
                                <td><a class="footer-link" href="{{loc_url(route('terms'))}}">{{__('ui.footerTerms')}}</a></td>
                                <td><a class="footer-link" href="{{ loc_url(route('locale.setting', ['lang'=>'uk'])) }}">Ukr</a></td>
                            </tr>
                            <tr>
                                <td><a class="footer-link not-allowed" href="{{loc_url(route('home'))}}">{{__('ui.footerNews')}}</a></td>
                                <td><a class="footer-link" href="{{loc_url(route('contacts'))}}">{{__('ui.footerContact')}}</a></td>
                                <td><a class="footer-link" href="{{loc_url(route('privacy'))}}">{{__('ui.footerPrivacy')}}</a></td>
                                <td><a class="footer-link" href="{{ loc_url(route('locale.setting', ['lang'=>'ru'])) }}">Rus</a></td>
                            </tr>
                            <tr>
                                <td><a class="footer-link" href="{{loc_url(route('list'))}}">{{__('ui.catalog')}}</a></td>
                                <td><a class="footer-link" href="{{loc_url(route('faq'))}}">{{__('ui.footerFAQ')}}</a></td>
                                <td><a class="footer-link" href="{{loc_url(route('site.map'))}}">{{__('ui.footerSiteMap')}}</a></td>
                                <td><a class="footer-link" href="{{ loc_url(route('locale.setting', ['lang'=>'en'])) }}">Eng</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </footer>
        </div>

        <div class="side-background"></div>

    </div>
    <!-- Scripts -->
    <script type="text/javascript" src={{ asset('js/jquery-3.1.1.min.js') }}></script>
    <script type="text/javascript" src={{ asset('js/popUpAndFlash.js') }}></script>
    @yield('scripts')
    <noscript>
        <div id="noscript">
            <p>{{__('ui.noscript')}}</p>
        </div>
    </noscript>
</body>
</html>
