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
        </div>

        <div class="side-background"></div>
        
        <div id="container">
            <header>
                <!-- Header of all web pages -->
                <div id="header">
                    <a href="{{ loc_url(route('home')) }}"><img id="logo" title="{{__('ui.home')}}" src="{{ asset('icons/logo3orange.png') }}" alt="{{__('alt.keyword')}}"></a>
                    <ul>
                        @if (App::isLocale('uk'))
                            <li>UKR</li>
                        @else
                            <li><a href="{{ loc_url(route('locale.setting', ['lang'=>'uk'])) }}">UKR</a></li>
                        @endif
                        
                        <li> | </li>
                        
                        @if (App::isLocale('ru'))
                            <li>RU</li>
                        @else
                            <li><a href="{{ loc_url(route('locale.setting', ['lang'=>'ru'])) }}">RU</a></li>
                        @endif
                        
                        <li> | </li>
                        
                        @if (App::isLocale('en'))
                            <li>ENG</li>
                        @else
                            <li><a href="{{ loc_url(route('locale.setting', ['lang'=>'en'])) }}">ENG</a></li>
                        @endif
                    </ul>

                    @auth    
                        <div class="logged-user-name">
                            <p>{{__('ui.loggedAs')}}: {{auth()->user()->name}}</p>
                        </div>
                    @endauth
                </div> 

                <!-- Navigation bar of all web pages -->
                <nav class="main-navigation">
                    <a id="homeTab" href="{{ loc_url(route('home')) }}">
                        <div class="iconWraper">
                            <img src="{{ asset('icons/homeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </div>
                        <p>{{__('ui.home')}}</p>
                    </a>
                    <a id="myItemsTab" href="{{ loc_url(route('profile.posts')) }}">
                        <div class="iconWraper">
                            <img src="{{ asset('icons/myItemsIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </div>
                        <p>{{__('ui.myPosts')}}</p>
                    </a>
                    <a id="favItemsTab" href="{{ loc_url(route('profile.favourites')) }}">
                        <div class="iconWraper">
                            <img src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @if ( auth()->user() )
                                <span> {{ auth()->user()->favPosts->count() }}</span>
                            @endif
                        </div>
                        <p>{{__('ui.favourites')}}</p>
                    </a>
                    <a id="profileTab" href="{{loc_url(route('profile'))}}">
                        <div class="iconWraper">
                            <img src="{{ asset('icons/profileIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </div>
                        <p>{{__('ui.profile')}}</p>
                    </a>
                    @guest
                        <a id="loginTab" href="{{ loc_url(route('login')) }}">
                            <div class="iconWraper">
                                <img src="{{ asset('icons/logInIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </div>
                            <p>{{__('ui.signIn')}}</p>
                        </a>
                    @else
                        <a href="#" onclick="document.getElementById('logout-form').submit();">
                            <div class="iconWraper">
                                <img src="{{ asset('icons/logOutIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </div>
                            <p>{{__('ui.signOut')}}</p>
                        </a>
                        <form id="logout-form" action="{{ loc_url(route('logout')) }}" method="POST" style="display: none">@csrf</form>
                    @endguest
                    <a id="addItemTab" href="{{ loc_url(route('posts.create')) }}">
                        <div class="iconWraper">
                            <img src="{{ asset('icons/addItemIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </div>
                        <p>{{__('ui.addPost')}}</p>
                    </a>
                </nav>
            </header>

            <!-- Main content -->
            <main>
                <!--Yielding content of each page-->
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div id="footerWraper">
                    <div id="leftS">
                        <a href="{{ loc_url(route('home')) }}"><img id="logo" src="{{ asset('icons/logo3orange.png') }}" alt="{{__('alt.keyword')}}"></a>
                        <a class="footerLinks" id="footerFAQ" href="{{loc_url(route('faq'))}}">{{__('ui.foterFAQ')}}</a>
                    </div>
                    <div id="rightS">
                        <p>&copy; {{env('COPY_RIGHT_YEAR')}} <span>rigmanager.com.ua</span>. {{__('ui.footerCopyright')}}</p>
                        <p>{{__('ui.footerIconsRef')}} <a class="footerLinks" href="https://www.flaticon.com/authors/roundicons" title="Roundicons">Roundicons</a> (<a class="footerLinks" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>)</p>
                        <table>
                            <tr>
                                <td><a class="footerLinks" href="{{loc_url(route('plans'))}}">{{__('ui.footerSubscription')}}</a></td>
                                <td><a class="footerLinks" href="{{loc_url(route('contacts'))}}">{{__('ui.footerContact')}}</a></td>
                                <td><a class="footerLinks wrap" href="{{loc_url(route('terms'))}}">{{__('ui.footerTerms')}}</a></td>
                            </tr>
                            <tr>
                                <td><a class="footerLinks" href="https://github.com/Oleksii-T/rigmanager">{{__('ui.footerDevelop')}}</a></td>
                                <td><a class="footerLinks wrap" href="{{loc_url(route('privacy'))}}">{{__('ui.footerPrivacy')}}</a></td>
                                <td><a class="footerLinks wrap" href="{{loc_url(route('site.map'))}}">{{__('ui.footerSiteMap')}}</a></td>
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
