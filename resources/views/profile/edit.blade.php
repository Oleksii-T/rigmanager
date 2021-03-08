@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('profile'))}}"><span itemprop="name">{{__('ui.profileInfo')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.profileEditing')}}</span></span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='profile'/>
        <div class="content">
            <h1>{{__('ui.profileEditing')}}</h1>
            <div class="profile-edit">
                <div class="profile-edit-column">
                    <form method="POST" id="form-profile" action="{{loc_url(route('profile.update'))}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <fieldset>
                            <div class="form-title">{{__('ui.profileInfo')}}
                                @if ($user->is_social)
                                    <br>    
                                    <a href="{{loc_url(route('faq'))}}#WhatIsSocialAcc">{{__('ui.socialAcc')}}</a>
                                @endif
                            </div>

                            <label class="label">{{__('ui.login')}} <span class="orange">*</span></label>
                            <input type="email" class="input" name="email" value="{{old('email') ?? $user->email}}" placeholder="{{__('ui.login')}}" required autocomplete="email" {{$user->is_social ? 'disabled' : ''}}>
                            <x-server-input-error inputName='email'/>
                            <div class="form-note">{{__('ui.loginHelp')}}</div>

                            <label class="label">{{__('ui.userName')}} <span class="orange">*</span></label>
                            <input type="text" class="input" name="name" value="{{old('name') ?? $user->name}}" placeholder="{{__('ui.userName')}}" required autocomplete="name">
                            <x-server-input-error inputName='name'/>
                            <div class="form-note">{{__('ui.userNameHelp')}}</div>

                            <label class="label">{{__('ui.phone')}}</label>
                            <input type="tel" class="input format-phone" name="phone_raw" value="{{old('phone_raw') ?? $user->phone_readable}}" placeholder="+38 ( _ _ _ ) _ _ _ - _ _ - _ _" autocomplete="phone">
                            <x-server-input-error inputName='phone_raw'/>
                            <div class="form-note">{{__('ui.phoneHelp')}}</div>

                            <div class="edit-ava">
                                @if ($user->image)
                                    <div class="edit-ava-img" style="background-image:url({{$user->image->url}})"></div>
                                @else
                                    <div class="edit-ava-img" style="background-image:url({{asset('icons/emptyAva.svg')}})"></div>
                                @endif
                                <div class="edit-ava-button">
                                    <input id="ava" type="file" name="ava">
                                    <label for="ava" class="edit-ava-label">{{__('ui.changeProfilePic')}}</label>
                                </div>
                            </div>

                            <div class="form-button">
                                <button class="button">{{__('ui.saveChanges')}}</button>
                            </div>	
                        </fieldset>
                    </form>
                </div>
                @if (!$user->is_social)
                    <div class="profile-edit-column">
                        <form method="POST" id="form-password" action="{{loc_url(route('profile.update.pass'))}}">
                            @csrf
                            @method('PATCH')
                            <fieldset>
                                <div class="form-title">{{__('ui.password')}}</div>

                                <label class="label">{{__('ui.curPass')}} <span class="orange">*</span></label>
                                <input type="password" name="old_password" class="input" placeholder="{{__('ui.password')}}">
                                <x-server-input-error inputName='old_password'/>

                                <label class="label">{{__('ui.newPass')}} <span class="orange">*</span></label>
                                <input type="password" name="password" id="password" class="input" placeholder="{{__('ui.newPass')}}">
                                <x-server-input-error inputName='password'/>
                                <div class="form-note">{{__('ui.passwordHelp')}}</div>

                                <label class="label">{{__('ui.reNewPass')}} <span class="orange">*</span></label>
                                <input type="password" name="password_confirmation" class="input" placeholder="{{__('ui.reNewPass')}}">
                                <x-server-input-error inputName='password_confirmation'/>
                                <div class="form-note">{{__('ui.rePassHelp')}}</div>

                                <div class="form-button">
                                    <button class="button">{{__('ui.changePassword')}}</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //pre-view of picture
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.edit-ava-img').css('background-image', 'url('+e.target.result+')');
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            //when user submit new image preview it
            $(".edit-ava-button input").change(function() {
                readURL(this);
            });

            //Validate the form
            var userId = '{{ $user->id }}';
            $('#form-profile').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 40,
                        validName: true,
                        remote: {
                            url: '{{ route('username.exist') }}',
                            data: {
                                ignoreId: userId
                            }
                        },
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: '{{ route('email.exist') }}',
                            data: {
                                ignoreId: userId
                            }
                        },
                        maxlength: 254
                    }
                },
                messages: {
                    name: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}',
                        remote: '{{ __("validation.unique-username") }}',
                        validName: '{{__("validation.username")}}'
                    },
                    email: {
                        required: '{{ __("validation.required") }}',
                        remote: '{{ __("validation.unique-email") }}',
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    }
                },
                errorElement: 'div',
				errorClass: 'form-error'
            });

            //Validate the form
            $('#form-password').validate({
                rules: {
                    password: {
                        minlength: 6,
                        validPassword: true,
                        maxlength: 20
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        minlength: '{{ __("validation.min.string", ["min" => 6]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}',
                        validPassword: '{{__("validation.password")}}'
                    },
                    password_confirmation: {
                        required: '{{ __("validation.required") }}',
                        equalTo: '{{ __("validation.passEqual") }}'
                    }
                },
                errorElement: 'div',
				errorClass: 'form-error'
            });
        });
    </script>
@endsection