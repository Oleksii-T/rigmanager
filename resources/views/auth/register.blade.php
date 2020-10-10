@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/register.css')}}" />
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
        #developmentStage a {
            font-size: 120%;
        }
    </style>
@endsection

@section('content')

<!--
    <div id="developmentStage">
        <p id="developmentStageText">{{__('ui.development')}}</p>
        <br>
        <a href = "mailto: web.rigmanager@gmail.com">web.rigmanager@gmail.com</a>
    </div>
-->
    <div id="userData">
        <form id="formSignup" method="POST" action="{{loc_url(route('register'))}}" enctype="multipart/form-data">
            @csrf
            <div id="formContent">
                <nav>
                    <ul>
                        <li><a id="loginBtn" href="{{loc_url(route('login'))}}">{{__('ui.signIn')}}</a></li>
                        <li><a id="registerBtn" href="{{loc_url(route('register'))}}">{{__('ui.signUp')}}</a></li>
                    </ul>
                </nav>
                <p>{{__('ui.signUp')}}</p>
                <table>
                    <tr id="avaEdit">
                        <td class="nameOfField"><p>{{__('ui.avatar')}}</p></td>
                        <td class="valueOfField">
                            <label for="inputAva">
                                <div id="avaPreview"><img src="{{ asset('icons/emptyUserIcon.svg') }}" alt="{{__('alt.keyword')}}"></div>
                            </label>
                            <input id="inputAva" type="file" name="ava">
                            @error('ava')
                                <div class="error" id="fileError">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </td>
                    </tr>

                    <tr id="nameShow">
                        <td class="nameOfField"><p>{{__('ui.userName')}}<span class="required-input">*</span></p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputName" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <x-server-input-error errorName='name' inputName='inputName' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.userNameHelp')}}</i></p></div>
                        </td>
                    </tr>

                    <tr id="phoneShow">
                        <td class="nameOfField"><p>{{__('ui.phone')}}</p></td>
                        <td class="valueOfField">
                            <div class="phone-wraper">
                                <div class="phone-prefix">
                                    <img class="country-flag" src="{{asset('icons/ukraineIcon.svg')}}" alt="{{__('alt.keyword')}}">
                                    <span class="country-code">+38</span>
                                </div>
                                <input class="def-input format-phone" id="inputPhone" name="phone_raw" type="text" placeholder="0 (00) 000 00 00" value="{{ old('phone_raw')}}" autocomplete="phone" autofocus/>
                            </div>
                            <x-server-input-error errorName='phone_raw' inputName='inputPhone' errorClass='error'/>
                            <div class="mediaCheckBoxes">
                                <div>
                                    <input type="checkbox" id="viberInput" name="viber" value="1" {{ old('viber') ? 'checked' : '' }}>
                                    <label for="viberInput">
                                        Viber
                                        <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ old('telegram') ? 'checked' : '' }}>
                                    <label for="telegramInput">
                                        Telegram
                                        <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ old('whatsapp') ? 'checked' : '' }}>
                                    <label for="whatsappInput">
                                        WhatsApp
                                        <img src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                    </label>
                                </div>
                            </div>
                            <div class="help"><p><i>{{__('ui.phoneHelp')}}</i></p></div>
                        </td> 
                    </tr>

                    <tr id="emailShow">
                        <td class="nameOfField"><p>{{__('ui.login')}}<span class="required-input">*</span></p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputEmail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.loginHelp')}}</i></p></div>
                        </td>
                    </tr>

                    <tr id="passShow">
                        <td class="nameOfField"><p>{{__('ui.password')}}<span class="required-input">*</span></p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputPassword" type="password" name="password" required autocomplete="new-password">
                            <x-server-input-error errorName='password' inputName='inputPassword' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.passwordHelp')}}</i></p></div>
                        </td>
                    </tr>

                    <tr id="agreementShow">
                        <td>
                            <label class="cb-container" for="inputAgreement">{{__('ui.iAgree')}} <a href="{{loc_url(route('terms'))}}">{{__('ui.iAgreeLink')}}</a>
                                <input id="inputAgreement" type="checkbox" name="agreement" value="1">
                                <span class="cb-checkmark"></span>
                            </label>
                            <x-server-input-error errorName='agreement' inputName='inputAgreement' errorClass='error'/>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <button class="def-button submit-button" type="submit">{{__('ui.signUp')}}</button>
                <div class="social">
                    <p class="socialText"><span>{{__('ui.or')}}</span>{{__('ui.socialSignIn')}}:</p>
                    <div>
                        <a class="socialLink" href="{{route('login.social', ['social'=>'google'])}}">
                            <img class="socialLogo" src="{{ asset('icons/googleIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            Google
                        </a>
                    </div>
                    <div>
                        <a class="socialLink" href="{{route('login.social', ['social'=>'facebook'])}}">
                            <img class="socialLogo" src="{{ asset('icons/facebookIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/hideShowPassword.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            // formate phone field
            $('.format-phone').focusin(function(){
                var newVal = phoneFormater( $(this).val(), false );
                $(this).val(newVal);
            });

            // formate phone field
            $('.format-phone').focusout(function(){
                var newVal = phoneFormater( $(this).val(), false );
                var newVal = phoneFormater( newVal, true );
                $(this).val(newVal);
            });

            // formate phone field helper
            function phoneFormater(phone, mode) {
                if (phone) {
                    if (mode) {
                        for (let i = phone.length-1; i >= 0; i--) {
                            if (i==1) {
                                phone = phone.slice(0, i) + ' (' + phone.slice(i);
                            } else if (i==3) {
                                phone = phone.slice(0, i) + ') ' + phone.slice(i);
                            }
                            else if (i==8 || i==6) {
                                phone = phone.slice(0, i) + ' ' + phone.slice(i);
                            }
                        }
                        return phone;
                    } else {
                        return phone.replace(/[^0-9]+/g,"").substring(0,10);
                    }
                }
            };

            //make cursor wait
            function makeCursorWait() {
                document.body.style.cursor = "wait"
                $('button').css('cursor', 'inherit');
                $('input').css('cursor', 'inherit');
                $('label').css('cursor', 'inherit');
                $('a').css('cursor', 'inherit');
                $('img').css('cursor', 'inherit');
                return false;
            }

            //show image (help func)
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#avaPreview img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            //if user submits image, preview it
            $("#inputAva").change(function() {
                readURL(this);
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

            // add regex validation of name
            $.validator.addMethod('validName',
                function(value, element, param) {
                    if (value != '') {
                        if (value.match(/^[а-яёґєіїА-ЯЁҐЄІЇa-zA-Z0-9\s]*$/u) == null) {
                            return false;
                        }
                    }
                    return true;
                },
                '{{__("validation.username")}}'
            );

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
            $('#formSignup').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 40,
                        validName: true,
                        remote: '{{ route('username.exist') }}',
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: '{{ route('email.exist') }}',
                        maxlength: 254
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        validPassword: true,
                        maxlength: 20
                    },
                    agreement: {
                        required: true
                    }
                },
                messages: {
                    name: { 
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}',
                        remote: '{{ __("validation.unique-username") }}',
                    },
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
                    agreement: {
                        required: '{{ __("validation.agreement") }}'
                    }
                },
                submitHandler: function (form) {
                    document.body.style.cursor = "wait"
                    $('button').css('cursor', 'inherit');
                    $('input').css('cursor', 'inherit');
                    $('label').css('cursor', 'inherit');
                    $('a').css('cursor', 'inherit');
                    $('img').css('cursor', 'inherit');
                    form.submit(); // submit the form
                }
            });

            //Show password toggle button
            $('#inputPassword').hideShowPassword({
                show: false,
                innerToggle: 'focus'
            });
        });
    </script>
@endsection
