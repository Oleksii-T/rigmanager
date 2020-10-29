@extends('layouts.app')

@section('styles')
    <style>
        .contants-wraper {
            background-color: rgba(11, 11, 11, 0.6);
            width: 75%;
            margin: 0 auto;
            padding: 30px
        }
        .field {
            margin-bottom: 25px;
        }
        .field-header {
            margin-bottom: 15px;
            font-size: 110%;
        }
        .page-header {
            text-align: center;
        }
        .name-input,
        .email-input,
        .subject-input {
            width: 60%;
        }
        .master-wraper {
            padding-top: 1px;
        }
        .contacts-list {
            margin-top: 110px;
            text-align: center;
            margin-bottom: 50px
        }
        .list-header {
            font-size: 260%;
            font-weight: 100;
            letter-spacing: 0.5em;
            margin-bottom: 80px;
        }
        .list-body {
            font-size: 125%;
            margin-bottom: 25px;
            border-bottom: 2px solid #fe9042;
            display: inline-block;
            font-style: italic;
        }
        .list-item {
            font-size: 120%;
            margin-bottom: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="master-wraper">
        <h1 class="page-header">{{__('ui.fromUserTitle')}}</h1>
        <form class="contants-wraper" id="contact-form" method="POST" action="{{loc_url(route('contact.us'))}}">
            @csrf
            <div class="field name-field">
                <p class="field-header">{{__('ui.userName')}}<span class="required-input">*</span></p>
                <input type="text" class="def-input name-input" id="name-input" name="name"
                @auth
                    value="{{old('name') ?? auth()->user()->name}}"
                @else
                    value="{{old('name')}}"
                @endauth
                required>
                <x-server-input-error errorName='name' inputName='name-input' errorClass='error'/>
            </div>
            <div class="field email-field">
                <p class="field-header">{{__('ui.fromUserEmail')}}<span class="required-input">*</span></p>
                <input type="email" class="def-input email-input" id="email-input" name="email"
                @auth
                    value="{{old('email') ?? auth()->user()->email}}"
                    @else
                        value="{{old('email')}}"
                @endauth
                required>
                <x-server-input-error errorName='email' inputName='email-input' errorClass='error'/>
            </div>
            <div class="field subject-file">
                <p class="field-header">{{__('ui.fromUserSubject')}}<span class="required-input">*</span></p>
                <input type="text" class="def-input subject-input" id="subject-input" name="subject" value="{{old('subject')}}" required>
                <x-server-input-error errorName='subject' inputName='subject-input' errorClass='error'/>
            </div>
            <div class="field text-field">
                <p class="field-header">{{__('ui.fromUserText')}}<span class="required-input">*</span></p>
                <textarea name="text" id="text-input" rows="10" maxlength="5000" class="def-textarea" placeholder="{{__('ui.fromUserTextPlaceholder')}}" required>{{old('text')}}</textarea>
                <x-server-input-error errorName='text' inputName='text-input' errorClass='error'/>
            </div>
            <div class="field btns-field">
                <button class="def-button submit-button">{{__('ui.fromUserSubmit')}}</button>
                <a class="def-button cancel-button" href="{{loc_url(route('home'))}}">{{__('ui.cancel')}}</a>
            </div>
            <div class="contacts-list">
                <p class="list-header">{{__('ui.or')}}</p>
                <p class="list-body">{{__('ui.contactsFooter')}}</p>
                <p class="list-item">{{env('MAIL_TO_ADDRESS')}}</p>
                <p class="list-item">web.rigmanager@gmail.com</p>
                <p class="list-item">{{env('CONTACT_PHONE')}}</p>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

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

            //Validate the form
            $('#contact-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 40,
                        validName: true
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 254
                    },
                    subject: {
                        required: true,
                        minlength: 3,
                        maxlength: 70
                    },
                    text: {
                        required: true,
                        minlength: 10,
                        maxlength: 5000
                    }
                },
                messages: {
                    name: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 40]) }}'
                    },
                    email: {
                        required: '{{ __("validation.required") }}',
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    },
                    subject: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    text: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 5000]) }}'
                    }
                }
            });
        });
    </script>
@endsection