@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}" />
@endsection

@section('content')

<!--
    <div id="developmentStage">
        <p id="developmentStageText">{{__('ui.development')}}</p>
        <br>
        <a href = "mailto: web.rigmanager@gmail.com">web.rigmanager@gmail.com</a>
    </div>
--> 

    <div class="authBody">
        <div>
            <nav>
                <ul>
                    <li><a id="loginBtn" href="{{loc_url(route('login'))}}">{{__('ui.signIn')}}</a></li>
                    <li><a id="registerBtn" href="{{loc_url(route('register'))}}">{{__('ui.signUp')}}</a></li>
                </ul>
            </nav>

            <div id="authWraper">
                <form method="POST" action="{{ loc_url(route('login')) }}">
                    @csrf
                    <div id="emailField">
                        <label for="inputEmail">{{__('ui.login')}}</label>
                        <input id="inputEmail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <div id="passwordField">
                        <label for="inputPassword">{{__('ui.password')}}</label>
                        <input id="inputPassword" type="password" name="password" required autocomplete="current-password">
                        @error('email')
                                <script type="text/javascript">
                                    document.getElementById('inputPassword').className += 'invalidInput';
                                    document.getElementById('inputEmail').className += 'invalidInput';
                                </script>
                                <div class="error">
                                    <p>{{ $message }}</p>
                                </div>
                        @enderror
                    </div>
                    
                    <div id="rememberField">
                        <input type="checkbox" name="remember" id="InputRememberMe" {{ old('remember') ? 'checked' : '' }}>
                        <label for="InputRememberMe">{{__('ui.remember me')}}</label>
                    </div>

                    <div id="btns">
                        <button class="def-button submit-button" type="submit">{{__('ui.signIn')}}</button>
                        <a href="{{loc_url(route('password.request'))}}">{{__('ui.forget password')}}</a>
                    </div>
            
                </form>

                <div class="social">
                    <p class="socialText">{{__('ui.socialSignIn')}}:</p>
                    <div>
                        <a class="socialLink" href="{{route('login.social', ['social'=>'google'])}}">
                            <img class="socialLogo" src="{{ asset('icons/googleIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            Google
                        </a>
                    </div>
                    <div>
                        <!--{{route('login.social', ['social'=>'facebook'])}}-->
                        <a class="socialLink" href="{{route('in.progress')}}">
                            <img class="socialLogo" src="{{ asset('icons/facebookIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/hideShowPassword.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            // Show password toggle button
            $('#inputPassword').hideShowPassword({
                show: false,
                innerToggle: 'focus'
            });

            //make cursor wait
            $('#submitBtn').click(function(){
                document.body.style.cursor = "wait"
                $('button').css('cursor', 'inherit');
                $('input').css('cursor', 'inherit');
                $('label').css('cursor', 'inherit');
                $('a').css('cursor', 'inherit');
            });

            //add hover effect on item when hover on addToFavBlocked btn
            $("div.social").hover(function(){
                $('p.socialText').css('display', 'block');
                $(this).css('width', '150px');
                }, function(){
                $('p.socialText').css('display', 'none');
                $(this).css('width', '45px');
            });

        });
    </script>
@endsection
