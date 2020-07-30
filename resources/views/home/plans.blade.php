@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}" />
@endsection

@section('content')
    <div id="plansWraper">
        <h1>{{__('ui.footerSubscription')}}</h1>
        <p>{{__('ui.workInProgress')}}</p>
    </div>
@endsection

@section('scripts')

@endsection