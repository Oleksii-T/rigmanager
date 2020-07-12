<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link type="text/css" href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/normalize.css') }}" rel="stylesheet" >
    @yield('styles')
    <!---->
    <style>
        #developmentStage {
            position: fixed;
            left: 50%; 
            transform: translateX(-50%);
            top: 20px;
            z-index: 10;
            background-color: rgb(255, 0, 0, 0.7);
            text-align: center;
            border-radius: 10px;
            padding: 5px
        }
        #developmentStage p {
            font-size: 120%;
            white-space: pre-line;
            display: inline;
        }
    </style>
    
</head>
<body>
    <div id="container">
        <div class="sideBg" id="leftBg"></div>
        <div class="sideBg" id="rightBg"></div>

        <!-- Session flash massages -->
        @if (Session::has('message-success'))
            <div class="flash flash-success">
                <p>{{ Session::get('message-success') }}</p>
            </div>
        @endif
        @if (Session::has('message-error'))
            <div class="flash flash-error">
                <p>{{ Session::get('message-error') }}</p>
            </div>
        @endif
        @if (Session::has('message-info'))
            <div class="flash flash-info">
                <p>{{ Session::get('message-info') }}</p>
            </div>
        @endif
        
        <!-- Header of all web pages -->
        <div id="header">
            <a href="{{ route('home') }}"><img id="logo" src="{{ asset('icons/logo3orange.png') }}" alt="{{__('alt.keyword')}}"></a>
            <!--{{ config('app.name') }}-->
            <ul>
                @if (App::isLocale('uk'))
                    <li>UKR</li>
                @else
                    <li><a href="{{ route('locale.setting', 'uk') }}">UKR</a></li>
                @endif
                
                <li> | </li>
                
                @if (App::isLocale('ru'))
                    <li>RU</li>
                @else
                    <li><a href="{{ route('locale.setting', 'ru') }}">RU</a></li>
                @endif
                
                <li> | </li>
                
                @if (App::isLocale('en'))
                    <li>ENG</li>
                @else
                    <li><a href="{{ route('locale.setting', 'en') }}">ENG</a></li>
                @endif
            </ul>
        </div> 

        <!-- Navigation bar of all web pages -->
        <nav class="mainNav">
            <a id="homeTab" href="{{ route('home') }}">
                <div class="iconWraper">
                    <img src="{{ asset('icons/homeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </div>
                <p>{{__('ui.home')}}</p>
            </a>
            <a id="myItemsTab" href="{{ route('myPosts') }}">
                <div class="iconWraper">
                    <img src="{{ asset('icons/myItemsIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </div>
                <p>{{__('ui.myPosts')}}</p>
            </a>
            <a id="favItemsTab" href="{{ route('favPosts') }}">
                <div class="iconWraper">
                    <img src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    @if ( auth()->user() )
                        <span> {{ auth()->user()->favPosts->count() }}</span>
                    @endif
                </div>
                <p>{{__('ui.favourites')}}</p>
            </a>
            <a id="profileTab" href="{{route('profile')}}">
                <div class="iconWraper">
                    <img src="{{ asset('icons/profileIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </div>
                <p>{{__('ui.profile')}}</p>
            </a>
            @guest
                <a id="loginTab" href="{{ route('login') }}">
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
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">@csrf</form>
            @endguest
            <a id="addItemTab" href="{{ route('posts.create') }}">
                <div class="iconWraper">
                    <img src="{{ asset('icons/addItemIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </div>
                <p>{{__('ui.addPost')}}</p>
            </a>
        </nav>

        <!-- Main content -->
        <main>
            <!---->
            <div id="developmentStage">
                <p id="developmentStageText">{{__('ui.development')}}</p>
                <a href="{{route('about')}}">{{__('ui.foterAbout')}}</a>
            </div>
            
            @yield('content')
        </main>

        <!-- Footer -->
        <div class="footer">
            <div id="footerWraper">
                <div id="leftS">
                    <a href="{{ route('home') }}"><img id="logo" src="{{ asset('icons/logo3orange.png') }}" alt="{{__('alt.keyword')}}"></a>
                    <a class="footerLinks" id="footerAbout" href="{{route('about')}}">{{__('ui.foterAbout')}}</a>
                </div>
                <div id="rightS">
                    <p>&copy; 2020 <span>rigmanager.com.ua</span>. {{__('ui.footerCopyright')}}</p>
                    <p>{{__('ui.footerIconsRef')}} <a class="footerLinks" href="https://www.flaticon.com/authors/roundicons" title="Roundicons">Roundicons</a> (<a class="footerLinks" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>)</p>
                    <table>
                        <tr>
                            <td><a class="footerLinks" href="#">{{__('ui.footerSubscription')}}</a></td>
                            <td><a class="footerLinks" href="#">{{__('ui.footerContact')}}</a></td>
                        </tr>
                        <tr>
                            <td><a class="footerLinks wrap" href="#">{{__('ui.footerTerms')}}</a></td>
                            <td><a class="footerLinks" href="https://github.com/Oleksii-T/rigmanager">{{__('ui.footerDevelop')}}</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src={{ asset('js/jquery-3.1.1.min.js') }}></script>
    @yield('scripts')
    <noscript>
        <div id="noscript">
            <p>{{__('ui.noscript')}}</p>
        </div>
    </noscript>
</body>
</html>
