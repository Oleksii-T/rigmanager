@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}" />
@endsection

@section('content')
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

                    <div class="social">
                        <a class="social-link google-link" href="{{route('login.social', ['social'=>'google'])}}">
                            <img class="social-logo google-logo" src="{{ asset('icons/googleIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            <span class="social-text google-text">{{__('ui.socialSignIn')}} Google</span>
                        </a>
                        <a class="social-link fb-link" href="{{route('login.social', ['social'=>'facebook'])}}">
                            <img class="social-logo fb-logo" src="{{ asset('icons/facebookIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            <span class="social-text fb-text">{{__('ui.socialSignIn')}} Facebook</span>
                        </a>
                    </div>

                    <div id="btns">
                        <button class="def-button submit-button" type="submit">{{__('ui.signIn')}}</button>
                        <a href="{{loc_url(route('password.request'))}}">{{__('ui.forget password')}}</a>
                    </div>

                </form>
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

        });
    </script>
@endsection
