@extends('layouts.page')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.passReset')}}</span></span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="login">
        <div class="login-title">{{__('ui.passReset')}}</div>
        <form id="form-pass-reset" method="POST" action="{{loc_url(route('password.email'))}}">
            @csrf
            <fieldset>
                <input class="input" type="email" name="email" value="{{old('email')}}" required autocomplete="email" autofocus placeholder="{{__('ui.login')}}">
                <x-server-input-error inputName='email'/>
                <div class="form-note">{{__('ui.passResetEmailHelp')}}</div>
                <button class="button">{{__('ui.sendPassResetLink')}}</button>
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

            //Validate the form
            $('#form-pass-reset').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        //remote: '{{ route('email.exist') }}',
                        maxlength: 254
                    }
                },
                messages: {
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

        });
    </script>
@endsection