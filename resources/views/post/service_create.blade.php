@extends('layouts.service_create_edit')

@section('page-title')
    <p id="pageTitle">{{__('ui.postCreate')}}</p>
@endsection

@section('form')
    <form method="POST" class="post-form" id="formCreatePost" action="{{ loc_url(route('posts.store')) }}" enctype="multipart/form-data">
        @csrf
        <x-post-creation-types/>
@endsection

@section('input-title')
    <input class="def-input" id="inputTitle" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{ old('title') }}"/>
@endsection

@section('checkbox-title-uk')
    <input id="titleTranslateUk" type="checkbox" name="title_translate[uk]" value="1" checked="checked">
@endsection

@section('field-title-uk')
    <div class="translation-input-field field-title-uk {{old('title_translate') && !array_key_exists('uk', old('title_translate')) ? '' : 'hidden'}}">
        <input class="def-input" id="inputTitleUk" name="title_uk" type="text" placeholder="Заголовок" value="{{ old('title_uk') }}"/>
@endsection

@section('checkbox-title-ru')
    <input id="titleTranslateRu" type="checkbox" name="title_translate[ru]" value="1" checked="checked">
@endsection

@section('field-title-ru')
    <div class="translation-input-field field-title-ru {{old('title_translate') && !array_key_exists('ru', old('title_translate')) ? '' : 'hidden'}}">
        <input class="def-input" id="inputTitleRu" name="title_ru" type="text" placeholder="Заголовок" value="{{ old('title_ru') }}"/>
@endsection

@section('checkbox-title-en')
    <input id="titleTranslateEn" type="checkbox" name="title_translate[en]" value="1" checked="checked">
@endsection

@section('field-title-en')
    <div class="translation-input-field field-title-en {{old('title_translate') && !array_key_exists('en', old('title_translate')) ? '' : 'hidden'}}">
        <input class="def-input" id="inputTitleEn" name="title_en" type="text" placeholder="Title" value="{{old('title_en')}}"/>
@endsection

@section('input-company')
    <input class="def-input" id="inputCompany" name="company" type="text" placeholder="{{__('ui.companyP')}}" value="{{ old('company') }}"/>
@endsection

@section('input-type')
    <label class="radio-container" for="typeGive">{{__('ui.postTypeGiveS')}}
        <input id="typeGive" type="radio" name="type" value="5" checked="checked">
        <span class="radio-checkmark"></span>
    </label>
    <label class="radio-container" for="typeGet">{{__('ui.postTypeGetS')}}
        <input id="typeGet" type="radio" name="type" value="6">
        <span class="radio-checkmark"></span>
    </label>
@endsection

@section('inputs-tag')
    <!--Hidden field for encoded tag for DB-->
    <input id="tagEncodedHidden" type="text" name="tag_encoded" value="{{ old('tag_encoded') ?? 50 }}" hidden/>

    <!--Hidden and visible fields for readable tag-->
    <input id="tagReadbleHidden" type="text" name="tagReadbleHidden" value="{{ old('tagReadbleHidden') ?? __('tags.otherService') }}" hidden/>
    <p id="tagReadbleVisible">{{__('ui.chosenTags')}}: <span>{{ old('tagReadbleHidden') ?? __('tags.otherService')}}</span></p>
@endsection

@section('input-description')
    <textarea class="def-textarea" id="inputDesc" name="description" form="formCreatePost" rows="15" maxlength="9000">{{ old('description') }}</textarea>
@endsection

@section('checkbox-description-uk')
    <input id="descTranslateUk" type="checkbox" name="desc_translate[uk]" value="1" checked="checked">
@endsection

@section('field-description-uk')
    <div class="translation-input-field field-description-uk {{old('desc_translate') && !array_key_exists('uk', old('desc_translate')) ? '' : 'hidden'}}">
        <textarea class="def-textarea" id="inputDescUk" name="description_uk" form="formCreatePost" rows="15" maxlength="9000">{{ old('description_uk') }}</textarea>
@endsection

@section('checkbox-description-ru')
    <input id="descTranslateRu" type="checkbox" name="desc_translate[ru]" value="1" checked="checked">
@endsection

@section('field-description-ru')
    <div class="translation-input-field field-description-ru {{old('desc_translate') && !array_key_exists('ru', old('desc_translate')) ? '' : 'hidden'}}">
        <textarea class="def-textarea" id="inputDescRu" name="description_ru" form="formCreatePost" rows="15" maxlength="9000">{{ old('description_ru') }}</textarea>
@endsection

@section('checkbox-description-en')
    <input id="descTranslateEn" type="checkbox" name="desc_translate[en]" value="1" checked="checked">
@endsection

@section('field-description-en')
    <div class="translation-input-field field-description-en {{old('desc_translate') && !array_key_exists('en', old('desc_translate')) ? '' : 'hidden'}}">
        <textarea class="def-textarea" id="inputDescEn" name="description_en" form="formCreatePost" rows="15" maxlength="9000">{{ old('description_en') }}</textarea>
@endsection

@section('dz-message')
    <div class="dz-message"><span>{{__('ui.dzDesc')}}</span></div>
@endsection

@section('images-errors')
    @error('images.*')
        <div class="error">
            <p>{{ $message }}</p>
        </div>
    @enderror
@endsection

@section('input-cost')
    <input class="def-input input-cost" id="inputCost" name="cost" type="text" placeholder="{{__('ui.cost')}}" value="{{ old('cost') }}"/>

    <div class="def-select-wraper">
        <select class="def-select" id="inputCurrency" name="currency">
            <option value="UAH">{{__('ui.grivna')}}</option>
            <option value="USD">{{__('ui.dollar')}}</option>
        </select>
        <span class="arrow arrowDown"></span>
    </div>
@endsection

@section('input-email')
    <input class="def-input" id="inputEmail" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{ old('user_email') ?? $user->email }}" autocomplete="email">
@endsection

@section('input-phone')
    <input class="def-input format-phone" id="inputPhone" name="user_phone_raw" type="text" placeholder="0 (00) 000 00 00" value="{{ old('user_phone_raw') ?? $user->phone_readable }}" autocomplete="phone">
@endsection

@section('input-viber')
    <input type="checkbox" id="viberInput" name="viber" value="1" {{ $user->viber ? 'checked' : '' }}>
@endsection

@section('input-telegram')
    <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ $user->telegram ? 'checked' : '' }}>
@endsection

@section('input-whatsapp')
    <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ $user->whatsapp ? 'checked' : '' }}>
@endsection

@section('input-lifetime')
    <h3 class="elementHeading">{{__('ui.chooseActiveTo')}}</h3>
    <div class="def-select-wraper">
        <select class="def-select lifetime-select" id="inputLifetime" name="lifetime">
            <option value="1" {{old('lifetime')==1 ? 'selected' : ''}}>{{__('ui.activeOneMonth')}}</option>
            <option value="2" {{old('lifetime')==2 ? 'selected' : ''}}>{{__('ui.activeTwoMonth')}}</option>
            <option value="3" {{old('lifetime')==3 ? 'selected' : ''}}>{{__('ui.activeForever')}}</option>
        </select>
        <span class="arrow arrowDown"></span>
    </div>
    <x-server-input-error errorName='lifetime' inputName='inputLifetime' errorClass='error'/>
    <div class="lifetime error error-dz hidden"></div>
    @if (old('lifetime')==1 || old('lifetime')==null)
        <p class="active-to-time">{{__('ui.hiddenOn')}}: <span>{{\Carbon\Carbon::now()->addMonth()->toDateString()}}</span></p>
    @elseif (old('lifetime')==2)
        <p class="active-to-time">{{__('ui.hiddenOn')}}: <span>{{\Carbon\Carbon::now()->addMonths(2)->toDateString()}}</span></p>
    @endif
    <div class="help">
        <p><i>{{__('ui.activeToHelp')}}</i></p>
    </div>
@endsection

@section('urgent-input')
    <input id="urgent" type="checkbox" name="is_urgent" value="1">
@endsection

@section('post-scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // createa file upload form (dropzone)
            $('.upload-zone').dropzone({
                url: "{{ route('posts.store') }}",
                paramName: "images",
                uploadMultiple: true,
                parallelUploads: 5,
                maxFilesize: 5, // MB
                addRemoveLinks: true,
                timeout: 5000,
                maxFiles: 5,
                acceptedFiles: '.jpeg,.jpg,.png',
                autoProcessQueue: false,
                dictDefaultMessage: "",
                dictFileTooBig: "{{__('ui.dzBigFile')}}",
                dictInvalidFileType: "{{__('ui.dzInvalidMime')}}",
                dictResponseError: "{{__('ui.dzServerError')}}",
                dictUploadCanceled: "{{__('ui.dzUploadCanceled')}}",
                dictRemoveFile: "{{__('ui.dzUploadRemoveLink')}}",
                dictMaxFilesExceeded: "{{__('ui.dzTooFewFiles')}}",
                init: function () {
                    var myDropzone = this;

                    $("#form-submit").click(function (e) {
                        e.preventDefault();
                        $('.error-dz').empty();
                        $('.error-dz').addClass('hidden');
                        $(this).addClass('loading');
                        if (myDropzone.getQueuedFiles().length > 0) {
                            myDropzone.processQueue();
                        } else {
                            $('.post-form').submit();
                        }
                    });

                    this.on('sending', function(file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $('.post-form').serializeArray();
                        $.each(data, function(key, el) {
                            formData.append(el.name, el.value);
                        });
                    });

                    this.on("successmultiple", function(){
                        window.location="{{ loc_url(route('posts.store.fake')) }}";
                    });

                    this.on("errormultiple", function(file, errorMessage, xhr){
                        $("#form-submit").removeClass('loading');
                        // parse error messages
                        if ( errorMessage['message'] == "Server Error" ) {
                            showPopUpMassage(false, "{{__('messages.error')}}");
                            myDropzone.removeAllFiles();
                        }
                        else if ( errorMessage['message'] == "The given data was invalid." ) {
                            showPopUpMassage(false, "{{ __('messages.postInputErrors') }}");
                            var invalidInputErrors = errorMessage['errors'];
                            $.each(invalidInputErrors, function(key, value) {
                                $('.'+key+'.error-dz').append("<p>"+value+"</p>");
                                $('input[name='+key+']').addClass('error');
                                $('textarea[name='+key+']').addClass('error');
                                $('.'+key+'.error-dz').removeClass('hidden');
                            });
                            myDropzone.removeAllFiles();
                        } else {
                            showPopUpMassage(false, errorMessage);
                        }
                    });
                },
            });

            //add active effect in nav bar
            $('#addItemTab').addClass('isActiveBtn');
        });
    </script>
@endsection