@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" />
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

    <div id="developmentStage">
        <p id="developmentStageText">{{__('ui.development')}}</p>
        <br>
        <a href = "mailto: web.rigmanager@gmail.com">web.rigmanager@gmail.com</a>
    </div>

    <div id="userData">
        <form id="formSignup" method="POST" action="#" enctype="multipart/form-data">
            @csrf
            <div id="formContent">
                <nav>
                    <ul>
                        <li><a id="loginBtn" href="{{route('login')}}">{{__('ui.signIn')}}</a></li>
                        <li><a id="registerBtn" href="{{route('register')}}">{{__('ui.signUp')}}</a></li>
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
                        <td class="nameOfField"><p>{{__('ui.userName')}}</p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputName" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <x-server-input-error errorName='name' inputName='inputName' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.userNameHelp')}}</i></p></div>
                        </td>
                    </tr>

                    <tr id="phoneShow">
                        <td class="nameOfField"><p>{{__('ui.phone')}}</p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputPhone" type="text" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                            <x-server-input-error errorName='phone' inputName='inputPhone' errorClass='error'/>
                            <div>
                                <input type="checkbox" id="viberInput" name="viber" value="1" {{ old('viber') ? 'checked' : '' }}>
                                <label for="viberInput">
                                    Viber
                                    <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                </label>
                                <br>
                                <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ old('telegram') ? 'checked' : '' }}>
                                <label for="telegramInput">
                                    Telegram
                                    <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                </label>
                                <br>
                                <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ old('whatsapp') ? 'checked' : '' }}>
                                <label for="whatsappInput">
                                    WhatsApp
                                    <img src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                </label>
                            </div>
                            <div class="help"><p><i>{{__('ui.phoneHelp')}}</i></p></div>
                        </td> 
                    </tr>

                    <tr id="emailShow">
                        <td class="nameOfField"><p>{{__('ui.login')}}</p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputEmail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.loginHelp')}}</i></p></div>
                        </td>
                    </tr>

                    <tr id="passShow">
                        <td class="nameOfField"><p>{{__('ui.password')}}</p></td>
                        <td class="valueOfField">
                            <input class="def-input" id="inputPassword" type="password" name="password" required autocomplete="new-password">
                            <x-server-input-error errorName='password' inputName='inputPassword' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.passwordHelp')}}</i></p></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <button class="def-button submit-button" type="submit">{{__('ui.signUp')}}</button>
                <div class="social">
                    <p class="socialText"><span>{{__('ui.or')}}</span>{{__('ui.socialSignIn')}}:</p>
                    <div>
                        <a class="socialLink" href="{{route('login.social', 'google')}}">
                            <img class="socialLogo" src="{{ asset('icons/googleIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            Google
                        </a>
                    </div>
                    <div>
                        <a class="socialLink" href="{{route('login.social', 'facebook')}}">
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
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script> 
    <script src="{{ asset('js/hideShowPassword.min.js') }}"></script>
    <script src="{{ asset('js/myValidators.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            
            //make cursor wait
            function makeCursorWait() {
                alert('here');
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

            //Validate the form          
            $('#formSignup').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 40,
                        validName: true
                    },
                    phone: {
                        minlength: 8,
                        maxlength: 20,
                        validPhone: true
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
                    }
                },
                messages: {
                    name: { 
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}'
                    },
                    phone: {
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 20]) }}',
                        validPhone: '{{ __("validation.phone") }}'
                    },
                    email: {
                        required: '{{ __("validation.required") }}',
                        remote: '{{ __("validation.unique") }}',
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    },
                    password: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 6]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 20]) }}'
                    }
                },
                submitHandler: function (form) {
                    alert('submitHandler');
                    document.body.style.cursor = "wait"
                    $('button').css('cursor', 'inherit');
                    $('input').css('cursor', 'inherit');
                    $('label').css('cursor', 'inherit');
                    $('a').css('cursor', 'inherit');
                    $('img').css('cursor', 'inherit');
                    /*
                    $(form).ajaxSubmit();
                    window.location.href='{{ route("verification.notice") }}';
                    */
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
