@extends('layouts.app')

@section('styles')
    <style>
        div.server-error-wraper {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        div.server-error {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        div.error-img {
            margin-right: 20px;
        }
        div.error-img img{
            width: 250px;
            height: 250px;
        }
        h3.error-title {
            font-size: 220%;
            margin-bottom: 20px;
            color: #FE9042;
        }
        p.error-desc {
            font-size: 170%;
            white-space: pre-line;
            margin-bottom: 10px;
        }
        p.error-message {
            display: inline-block;
            font-size: 170%;
            border-bottom: 2px solid #FE9042;
            margin-bottom: 20px;
        }
        a.link {
            transition: 0.2s;
            display: inline-block;
            margin-bottom: 7px;
            padding-left: 5px;
        }
        a.link:hover {
            color: #FE9042;
        }
    </style>
@endsection

@section('content')
    <div class="server-error-wraper">
        <div class="server-error">
            <div class="error-img">
                <img src="{{asset('icons/serverErrorIcon.svg')}}" alt="{{__('alt.keyword')}}">
            </div>
            <div class="error-text">
                <h3 class="error-title">{{__('ui.serverErrorTittle')}}</h3>
                <p class="error-desc">{{__('ui.serverErrorDesc')}}</p>
                <p class="error-message">
                    @yield('error')
                </p>
                <div class="server-error-links">
                    <a class="link" href="{{route('contacts')}}">{{__('ui.serverErrorContact')}}</a>
                    <br>
                    <a class="link" href="{{ url()->previous() }}">{{__('ui.serverErrorGoBack')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
