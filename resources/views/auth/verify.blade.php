@extends('layouts.app')

@section('styles')
    <style>
        #verifyNoticeBody {
            margin-top: 20px;
            padding: 40px;
            text-align: center;
        }

        #verifyNoticeBody h1 {
            white-space: pre-line;
            font-size: 210%;
            color: #FE9042;
        }

        #verifyNoticeBody p {
            font-size: 150%;
            white-space: pre-line;
            display: inline;
        }

        #verifyNoticeBody form {
            margin-top: 10px;
            display: inline;
        }

        #verifyNoticeBody button {
            font-size: 140%;
            cursor: pointer;
            border: none;
            padding: 5px 7px;
            background: none;
            background-color: rgb(149, 149, 149, 0.7);
        }

        #verifyNoticeBody button:hover {
            background-color: rgb(149, 149, 149);
        }

        #resendBody {
            margin-top: 30px;
        }

        #resendBody p {
            border-bottom: 2px solid #FE9042;
        }

    </style>
@endsection

@section('content')
    <div id="verifyNoticeBody">
        <h1>{{__('ui.verifyNoticeThank')}}</h1>
        <p>{{__('ui.verifyNoticeBody')}}</p>
        <form method="POST" action="{{ loc_url(route('verification.resend')) }}">
            @csrf
            <button type="submit">{{ __('ui.verifyClickToResend') }}</button>.
        </form>
        @if (session('resent'))
            <div id="resendBody">
                <p>{{__('ui.verifyNoticeResend')}}</p>
            </div>
        @endif
    </div>
@endsection
