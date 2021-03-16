@extends('layouts.page')

@section('meta')
    <title>{{__('meta.title.info.contacts')}}</title>
    <meta name="description" content="{{__('meta.description.info.contacts')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{__('ui.footerContact')}}</span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='contact'/>

		<div class="content">
			<h1>{{__('ui.footerContact')}}</h1>
			<div class="content-top-text">{{__('ui.contactsFooter')}}

				{{env('MAIL_TO_ADDRESS')}}
				{{env('CONTACT_PHONE')}}</div>
			<div class="form-block">
				<form id="form-contact" method="POST" action="{{loc_url(route('contact.us'))}}">
					@csrf
                    <fieldset>
						<label class="label">{{__('ui.userName')}} <span class="orange">*</span></label>
						<input id="input-name" type="text" class="input" name="name"
							@auth
								value="{{old('name') ?? auth()->user()->name}}"
							@else
								value="{{old('name')}}"
							@endauth
						required>
                        <x-server-input-error inputName='name'/>

						<label class="label">{{__('ui.fromUserEmail')}} <span class="orange">*</span></label>
						<input id="input-email" type="text" class="input" name="email" 
							@auth
								value="{{old('email') ?? auth()->user()->email}}"
							@else
								value="{{old('email')}}"
							@endauth
						required>
                        <x-server-input-error inputName='email'/>

						<label class="label">{{__('ui.fromUserSubject')}} <span class="orange">*</span></label>
						<input id="input-subject" type="text" class="input" name="subject" value="{{old('subject')}}" required>
                        <x-server-input-error inputName='subject'/>

						<label class="label">{{__('ui.fromUserText')}} <span class="orange">*</span></label>
						<textarea id="input-text" cols="30" rows="10" maxlength="5000" name="text" class="textarea" placeholder="{{__('ui.fromUserTextPlaceholder')}}">{{old('text')}}</textarea>
                        <x-server-input-error inputName='text'/>

						<div class="form-button">
							<button type="submit" class="button">{{__('ui.fromUserSubmit')}}</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //anti bot protection
            $('#form-contact button[type=submit]').click(function(e){
                e.preventDefault();
                $('#form-contact').append('<input type="text" name="anti-bot-protection" value="1" hidden>');
                $('#form-contact').submit();
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

            //Validate the form
            $('#form-contact').validate({
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
                },
				errorElement: 'div',
				errorClass: 'form-error'
            });
        });
    </script>
@endsection
