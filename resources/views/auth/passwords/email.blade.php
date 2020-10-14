@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="in-progress">
        <h1 style="text-align: center;text-decoration: underline;font-style: italic;">{{__('ui.workInProgress')}}</h1>
    </div>
<!--
<div class="container">
    <div>{{ __('Reset Password') }}</div>
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ loc_url(route('password.email')) }}">
            @csrf
            <div>
                <label for="email">{{ __('E-Mail Address') }}</label>
                <div>
                    <input id="inputEmail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <x-server-input-error errorName='email' inputName='inputEmail' errorClass='error'/>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
            </div>
        </form>
    </div>
</div>
-->
@endsection
