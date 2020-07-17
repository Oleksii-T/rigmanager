@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/register_new.css')}}" />
@endsection

@section('content')
<div id="userData">
    <form id="formSignup" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <nav>
                <ul>
                    <li><a id="loginBtn" href="{{route('login')}}">{{__('ui.signIn')}}</a></li>
                    <li><a id="registerBtn" href="{{route('register')}}">{{__('ui.signUp')}}</a></li>
                </ul>
            </nav>
            <p>{{__('ui.signUp')}}</p>
            <table>
                <tr id="avaEdit">
                    <td><p>{{__('ui.avatar')}}</p></td>
                    <td>
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
                    <td><p>{{__('ui.userName')}}</p></td>
                    <td>
                        <input id="inputName" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <x-server-input-error errorName='name' inputName='inputName' errorClass='error'/>
                        <div class="help"><p><i>{{__('ui.userNameHelp')}}</i></p></div>
                    </td>
                </tr>

                <tr id="phoneShow">
                    <td><p>{{__('ui.phone')}}</p></td>
                    <td>
                        <input id="inputPhone" type="text" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
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
                    <td><p>{{__('ui.login')}}</p></td>
                    <td>
                        <input id="inputEmail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                        <div class="help"><p><i>{{__('ui.loginHelp')}}</i></p></div>
                    </td>
                </tr>

                <tr id="passShow">
                    <td><p>{{__('ui.password')}}</p></td>
                    <td>
                        <input id="inputPassword" type="password" name="password" required autocomplete="new-password">
                        <x-server-input-error errorName='password' inputName='inputPassword' errorClass='error'/>
                        <div class="help"><p><i>{{__('ui.passwordHelp')}}</i></p></div>
                    </td>
                </tr>
            </table>
        </div>
        <button id="sumbitBtn" type="submit">{{__('ui.signUp')}}</button>
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
                        required: 'Это поле обязательно',
                        minlength: 'Минимум 3 символа',
                        maxlength: 'Максимум 40 символов'
                    },
                    phone: {
                        minlength: 'Минимум 8 символов',
                        maxlength: 'Максимум 20 символов',
                        validPhone: 'Не правильный номер'
                    },
                    email: {
                        required: 'Это поле обязательно',
                        remote: 'Такая электронная почта уже используется',
                        email: 'Не верный адрес почты',
                        maxlength: 'Максимум 254 символов'
                    },
                    password: {
                        required: 'Это поле обязательно',
                        minlength: 'Минимум 6 символов',
                        maxlength: 'Максимум 20 символов'
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
