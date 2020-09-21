@extends('layouts.mailer_create_edit')

@section('page-title')
    <h1>{{__('ui.settingUpMailer')}}</h1>
@endsection

@section('form')
    <form class="mailer-form" id="formNewMailer" method="post" action="{{ route('mailer.store') }}">
        @csrf
@endsection

@section('input-type')
    <label class="cb-container" for="typeSell">{{__('ui.postTypeSell')}}
        <input id="typeSell" type="checkbox" name="types[]" value="1" checked="checked">
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeBuy">{{__('ui.postTypeBuy')}}
        <input id="typeBuy" type="checkbox" name="types[]" value="2" checked="checked">
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeRent">{{__('ui.postTypeRent')}}
        <input id="typeRent" type="checkbox" name="types[]" value="3" checked="checked">
        <span class="cb-checkmark"></span>
    </label>
    <x-server-input-error errorName='types' inputName='typeSell' errorClass='error'/>
@endsection

@section('input-keywords')
    <textarea id="inputKeywords" name="keywords" form="formNewMailer" rows="5" maxlength="9000">{{ old('keywords') }}</textarea>
@endsection

@section('input-equipment-tags')
    <!--Hidden field for encoded tag (eq. and se. at ones) for DB-->
    <input id="tagEqEncodedHidden" type="text" name="eq_tags_encoded" value="" hidden/>

    <!--Visible fields for readable tag-->                        
    <div class="chosen-tags equipment">
        <p>{{__('ui.mailerEqTags')}}:</p>
        <ol class="orderedList"></ol>
    </div>
@endsection

@section('input-service-tags')
    <!--Hidden field for encoded tag (eq. and se. at ones) for DB-->
    <input id="tagSeEncodedHidden" type="text" name="se_tags_encoded" value="" hidden/>

    <!--Visible fields for readable tag-->                        
    <div class="chosen-tags service">
        <p>{{__('ui.mailerSeTags')}}:</p>
        <ol class="orderedList">
        </ol>
    </div>
@endsection

@section('input-authors')
    <p id="noAuthors">{{__('ui.mailerNoAuthors')}}</p>
@endsection

@section('mailer-scripts')
    <script type="text/javascript">
        var chosenTags = [];
    </script>
@endsection