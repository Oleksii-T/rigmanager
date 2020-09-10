@extends('layouts.app')

@section('styles')
    <style>
        div.empty-search-wraper {
            margin: 50px auto 100px auto;
            height: 100%;
            display: flex;
            align-items:center;
            justify-content: center;
        }

        p.empty-search-text {
            white-space: pre-line;
            font-size: 140%;
        }
        img.fail-icon {
            margin-right: 20px;
            height: 150px;
            width: 150px;
        }
    </style>
@endsection

@section('content')
    <div class="empty-search-wraper">
        <img class="empty-search-icon fail-icon" src="{{asset('icons/failIcon.svg')}}" alt="{{__('alt.keyword')}}">
        <p class="empty-search-text">{{__('ui.postInactiveError')}}</p>
    </div>
@endsection

@section('scripts')

@endsection
