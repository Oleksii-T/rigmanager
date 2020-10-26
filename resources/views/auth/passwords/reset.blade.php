@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/password_forget.css')}}" />
@endsection

@section('content')
    <div class="pass-forget-wraper">
        <div class="pass-forget-content">
            <div class="pass-forget-header">
                <p>{{ __('Reset Password') }}</p>
            </div>
            <div class="pass-forget-body">
                <form method="POST" id="pass-forget-reset-form" action="{{ loc_url(route('password.update')) }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="inputEmail">{{ __('E-Mail Address') }}</label>
                        <div class="pass-forget-input-field">
                            <input class="pass-forget-input" id="inputEmail" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                        </div>
                    </div>

                    <div>
                        <label for="inputPassword">{{ __('Password') }}</label>
                        <div class="pass-forget-input-field">
                            <input class="pass-forget-input" id="inputPassword" type="password" name="password" required autocomplete="new-password">
                            <x-server-input-error errorName='password' inputName='inputPassword' errorClass='error'/>
                        </div>
                    </div>

                    <div>
                        <label for="input-password-confirm">{{ __('Confirm Password') }}</label>
                        <div class="pass-forget-input-field">
                            <input class="pass-forget-input" id="input-password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <x-server-input-error errorName='password_confirmation' inputName='input-password-confirm' errorClass='error'/>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="pass-forget-submit def-button">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hideShowPassword.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            //Show password toggle button
            $('#inputPassword, #input-password-confirm').hideShowPassword({
                show: false,
                innerToggle: 'focus'
            });

            // change default error-lable insertion location
            $.validator.setDefaults({
                errorPlacement: function(error, element) {
                    if (element.prop('type') === 'password') {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

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
            $('#pass-forget-reset-formm').validate({
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
                        equalTo: '#inputPassword',
                        required: true,
                        minlength: 6,
                        validPassword: true,
                        maxlength: 20,
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
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 6]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 20]) }}'
                    }
                }
            });

        });
    </script>
@endsection

