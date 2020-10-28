@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/password_forget.css')}}" />
@endsection

@section('content')
    <div class="pass-forget-wraper">
        <div class="pass-forget-content">
            <div class="pass-forget-header">
                <p>{{ __('ui.passReset') }}</p>
            </div>
            <div class="pass-forget-body">
                @if (session('status'))
                    <div class="pass-forget-alert" role="alert">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
                <div class="pass-forget-guide">
                    <p>{{__('ui.passForgetGuide1')}}</p>
                    <p>{{__('ui.passForgetGuide2')}}</p>
                    <p>{{__('ui.passForgetGuide3')}}</p>
                    <p>{{__('ui.passForgetGuide4')}}</p>
                </div>
                <form class="pass-forget-form" id="pass-forget-email-form" method="POST" action="{{ loc_url(route('password.email')) }}">
                    @csrf
                    <div>
                        <label for="inputEmail">{{ __('E-Mail Address') }}</label>
                        <div class="pass-forget-input-field">
                            <input class="pass-forget-input" id="inputEmail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="pass-forget-submit def-button">{{ __('ui.submit') }}</button>
                    </div>
                </form>
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
                <div class="pass-forget-misc">
                    <a class="pass-forget-back" href="{{route('login')}}">{{__('ui.backToLogin')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            //Validate the form
            $('#pass-forget-email-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        //remote: '{{ route('email.exist') }}',
                        maxlength: 254
                    }
                },
                messages: {
                    email: {
                        required: '{{ __("validation.required") }}',
                        remote: '{{ __("validation.unique-email") }}',
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    }
                }
            });

        });
    </script>
@endsection
