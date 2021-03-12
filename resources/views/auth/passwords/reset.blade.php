@extends('layouts.page')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{__('ui.passReset')}}</span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="login">
        <div class="login-title">{{__('ui.passReset')}}</div>
        <form id="form-pass-reset" method="POST" action="{{loc_url(route('password.update'))}}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <fieldset>
                <label class="label">{{__('ui.login')}} <span class="orange">*</span></label>
                <input class="input" type="email" name="email" value="{{old('email')}}" required autocomplete="email" autofocus placeholder="{{__('ui.login')}}">
                <x-server-input-error inputName='email'/>
                
                <label class="label">{{__('ui.password')}} <span class="orange">*</span></label>
                <input class="input" id="password" type="password" name="password" value="{{old('password')}}" required autocomplete="new-password" placeholder="{{__('ui.password')}}">
                <x-server-input-error inputName='email'/>
                <div class="form-note">{{__('ui.passwordHelp')}}</div>
                
                <label class="label">{{__('ui.rePass')}} <span class="orange">*</span></label>
                <input class="input" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" required autocomplete="new-password" placeholder="{{__('ui.rePass')}}">
                <x-server-input-error inputName='email'/>
                <div class="form-note">{{__('ui.rePassHelp')}}</div>

                <button class="button">{{__('Reset Password')}}</button>
                <div class="login-bottom">
                    <a href="{{loc_url(route('login'))}}">{{__('ui.backToSignIn')}}</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // add regex validation of password
            $.validator.addMethod('validPassword',
                function(value, element, param) {
                    if (value != '') {
                        if (value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/) == null) {
                            return false;
                        }
                    }
                    return true;
                },
                '{{__("validation.password")}}'
            );
            //Validate the form
            $('#form-pass-reset').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        //remote: '{{ route('email.exist') }}',
                        maxlength: 254
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        validPassword: true,
                        maxlength: 20
                    },
                    password_confirmation: {
                        equalTo: '#password',
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: '{{ __("validation.required") }}',
                        remote: '{{ __("validation.unique-email") }}',
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    },
                    password: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 6]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 20]) }}'
                    },
                    password_confirmation: {
                        equalTo: '{{ __("validation.confirmed") }}',
                        required: '{{ __("validation.required") }}'
                    }
                },
                errorElement: 'div',
				errorClass: 'form-error'
            });

        });
    </script>
@endsection