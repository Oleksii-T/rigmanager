@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}" />
@endsection

@section('content')
    <div id="contantsWraper">
        <h1>{{__('ui.contactInfo')}}</h1>
        <p>{{__('ui.workInProgress')}}</p>
    </div>
@endsection

@section('scripts')

@endsection