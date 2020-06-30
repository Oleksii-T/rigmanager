@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/profile_edit.css')}}" />
@endsection

@section('content')
    <div id="userData">
        <form method="POST" id="formProfile" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div>
                <p>{{__('ui.profileSettings')}}</p>
                <table>
                    <tr id="avaEdit">
                        <td><p>{{__('ui.avatar')}}</p></td>
                        <td>
                            <label for="inputAva">
                                <div id="avaPreview">
                                    @if ($user->image)
                                        <img src="{{ $user->image->url }}" alt="{{__('alt.keyword')}}">
                                    @else
                                        <img src="{{ asset('icons/emptyUserIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                    @endif
                                </div>
                            </label>
                            <input id="inputAva" type="file" name="ava" hidden>
                            @error('ava')
                                <div class="error">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr id="nameShow">
                        <td><p>{{__('ui.userName')}}</p></td>
                        <td>
                            <input id="inputName" name="name" type="text" placeholder="Имя" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus/>
                            <x-server-input-error errorName='name' inputName='inputName' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.userNameHelp')}}</i></p></div>
                        </td>
                    </tr>
                    <tr id="phoneShow">
                        <td><p>{{__('ui.phone')}}</p></td>
                        <td>
                            <input id="inputPhone" name="phone" type="text" placeholder="Ном. телефона" value="{{ old('phone') ?? $user->phone}}" autocomplete="phone" autofocus/>
                            <x-server-input-error errorName='phone' inputName='inputPhone' errorClass='error'/>
                            <div>
                                <input type="checkbox" id="viberInput" name="viber" value="1" {{ $user->viber ? 'checked' : '' }}>
                                <label for="viberInput">
                                    Viber
                                    <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                </label>
                                <br>
                                <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ $user->telegram ? 'checked' : '' }}>
                                <label for="telegramInput">
                                    Telegram
                                    <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                                </label>
                                <br>
                                <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ $user->whatsapp ? 'checked' : '' }}>
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
                            <input id="inputEmail" type="email" name="email" type="email" placeholder="Логин" value="{{ old('email') ?? $user->email}}" required autocomplete="email"/> 
                            <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.loginHelp')}}</i></p></div>
                        </td>
                    </tr>
                    <tr id="passShow">
                        <td><p>{{__('ui.password')}}</p></td>
                        <td>
                            <input type="password" id="inputPassword" name="password" placeholder="Новый пароль..."/>
                            <x-server-input-error errorName='password' inputName='inputPassword' errorClass='error'/>
                            <div class="help"><p><i>{{__('ui.passwordEditHelp')}}</i></p></div>
                        </td>
                    </tr>
                </table>
            </div>
            <button id="sumbitBtn" type="submit">{{__('ui.save')}}</button>
            <a id="cancelBtn" href="{{ route('profile') }}">{{__('ui.cancel')}}</a>
        </form>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script> 
<script src="{{ asset('js/hideShowPassword.min.js') }}"></script>
<script src="{{ asset('js/myValidators.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        //fade out flash massages
        $("div.flash").delay(3000).fadeOut(350);

        //pre-view of picture
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avaPreview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        //when user submit new image preview it
        $("#inputAva").change(function() {
            readURL(this);
        });

        $("#helpImg").hover(function(){
            $(".helpText").css("opacity", "1");
            }, function(){
            $(".helpText").css("opacity", "0");
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
        /*
                    remote: {
                        url: '/account/validate-email',
                        data: {
                            ignore_id: function() {
                                return userId;
                            }
                        }
                    },
        */
        //Validate the form
        var userId = '{{ $user->id }}';
        $('#formProfile').validate({
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
                    remote: {
                        url: '{{ route('email.exist') }}',
                        data: {
                            ignoreId: '{{ $user->id }}'
                        }
                    },
                    maxlength: 254
                },
                password: {
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
                    minlength: 'Минимум 6 символов',
                    maxlength: 'Максимум 40 символов'
                }
            }
        });


        // Show password toggle button
        $('#inputPassword').hideShowPassword({
            show: false,
            innerToggle: 'focus'
        });

    });
</script>
@endsection
