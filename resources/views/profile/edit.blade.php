@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_edit.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    
    <div id="profileContentWraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <ul>
                    <li><a id="personlaInfoBtn" href="{{route('profile')}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{route('mailer.index')}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{route('profile.subscription')}}">{{__('ui.mySubscription')}}</a></li>
                </ul>
            </nav>

            <div id="userData">
                <form method="POST" id="formProfile" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div>
                        <h1>{{__('ui.profileSettings')}}</h1>
                        <table>
                            <tr id="avaEdit">
                                <td class="nameOfField"><p>{{__('ui.avatar')}}</p></td>
                                <td class="valueOfField">
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
                                    @if ($user->image)
                                        <button class="def-button delete-button" type="button" id="modalShow">{{__('ui.deleteProfileImg')}}</button>
                                    @endif
                                    @error('ava')
                                        <div class="error">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr id="nameShow">
                                <td class="nameOfField"><p>{{__('ui.userName')}}</p></td>
                                <td class="valueOfField">
                                    <input class="def-input" id="inputName" name="name" type="text" placeholder="Имя" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus/>
                                    <x-server-input-error errorName='name' inputName='inputName' errorClass='error'/>
                                    <div class="help"><p><i>{{__('ui.userNameHelp')}}</i></p></div>
                                </td>
                            </tr>
                            <tr id="phoneShow">
                                <td class="nameOfField"><p>{{__('ui.phone')}}</p></td>
                                <td class="valueOfField">
                                    <input class="def-input" id="inputPhone" name="phone" type="text" placeholder="Ном. телефона" value="{{ old('phone') ?? $user->phone}}" autocomplete="phone" autofocus/>
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
                                <td class="nameOfField"><p>{{__('ui.login')}}</p></td>
                                <td class="valueOfField">
                                    <input class="def-input" id="inputEmail" type="email" name="email" type="email" placeholder="Логин" value="{{ old('email') ?? $user->email}}" required autocomplete="email"/> 
                                    <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                                    <div class="help"><p><i>{{__('ui.loginHelp')}}</i></p></div>
                                </td>
                            </tr>
                            <tr id="passShow">
                                <td class="nameOfField"><p>{{__('ui.password')}}</p></td>
                                <td class="valueOfField">
                                    <input class="def-input" type="password" id="inputPassword" name="password" placeholder="Новый пароль..."/>
                                    <x-server-input-error errorName='password' inputName='inputPassword' errorClass='error'/>
                                    <div class="help"><p><i>{{__('ui.passwordEditHelp')}}</i></p></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button class="def-button submit-button" id="sumbitBtn" type="submit">{{__('ui.save')}}</button>
                    <a class="def-button cancel-button" id="cancelBtn" href="{{ route('profile') }}">{{__('ui.cancel')}}</a>
                </form>
            </div>
        </div>
    </div>
    <div class="modalView animate" id="modalProfileImgDelete">
        <div class="modalContent"> 
            <p>{{__('ui.sure?')}}</p>
            <div>
                <button class="def-button submit-button" type="button" id="modalHide">{{__('ui.no')}}</button>
                <button class="def-button cancel-button" id="modalSubmit">{{__('ui.delete')}}</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/hideShowPassword.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/myValidators.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#modalSubmit').click(function(){
                $.ajax({
                    url: "{{route('profile.img.delete')}}",
                    type: 'PATCH',
                    data: {
                        _method: "PATCH",
                        _token: "{{ csrf_token() }}",
                    },
                    success: function() {
                        //location.reload();
                        $('#avaPreview img').attr('src', "");
                        $('#modalProfileImgDelete').css("display", "none");
                        showPopUpMassage(true, "{{ __('messages.profileImgDeleted') }}");
                    },
                    error: function() {
                        // Print error massage
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });

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
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}'
                    },
                    phone: {
                        minlength: '{{ __("validation.min.string", ["min" => 8]) }}',
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
                        minlength: '{{ __("validation.min.string", ["min" => 6]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}'
                    }
                }
            });

            // Show password toggle button
            $('#inputPassword').hideShowPassword({
                show: false,
                innerToggle: 'focus'
            });

            //open modal delete confirm when user ask to
            $('#modalShow').click(function(){
                $('#modalProfileImgDelete').css("display", "block");
            });

            //close delete confirmation
            $('#modalHide').click(function(){
                $('#modalProfileImgDelete').css("display", "none");
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                if (event.target == document.getElementById("modalProfileImgDelete")) {
                    $('#modalProfileImgDelete').css("display", "none");
                }
            }

        });
    </script>
@endsection
