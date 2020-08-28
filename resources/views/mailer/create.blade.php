@extends('layouts.mailer_create_edit')

@section('page-title')
    <h1>{{__('ui.settingUpMailer')}}</h1>
@endsection

@section('form')
    <form class="mailer-form" id="formNewMailer" method="post" action="{{ route('mailer.store') }}">
        @csrf
@endsection

@section('input-keywords')
    <textarea id="inputKeywords" name="keywords" form="formNewMailer" rows="5" maxlength="9000">{{ old('keywords') }}</textarea>
@endsection

@section('input-tags')
    <!--Hidden field for encoded tag for DB-->
    <input id="tagEncodedHidden" type="text" name="tags_encoded" value="" hidden/>

    <!--Visible fields for readable tag-->                        
    <div id="choosenTags">
        <p>{{__('ui.chosenTags')}}:</p>
        <ol class="orderedList"></ol>
    </div>
    <x-server-input-error errorName='tags' inputName='tagEncodedHidden' errorClass='error'/>
@endsection

@section('input-authors')
    <p id="noAuthors">{{__('ui.mailerNoAuthors')}}</p>
@endsection