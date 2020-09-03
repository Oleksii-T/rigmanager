@extends('layouts.post_create_edit')

@section('page-title')
    <p id="pageTitle">{{__('ui.postCreate')}}</p>
@endsection

@section('form')
    <form method="POST" class="post-form" id="formCreatePost" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
@endsection

@section('input-title')
    <input class="def-input" id="inputTitle" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{ old('title') }}"/>
@endsection    

@section('input-condition')
    <input type="radio" id="conditionNew" name="condition" value="2">
    <label for="conditionNew">{{__('ui.conditionNew')}}</label><br>
    <input type="radio" id="conditionSH" name="condition" value="3">
    <label for="conditionSH">{{__('ui.conditionSH')}}</label><br>
    <input type="radio" id="conditionForParts" name="condition" value="4">
    <label for="conditionForParts">{{__('ui.conditionForParts')}}</label><br>
    <input type="radio" id="other" name="condition" value="1" checked="checked">
    <label for="other">{{__('ui.notSpecified')}}</label>
@endsection

@section('inputs-tag')
    <!--Hidden field for encoded tag for DB-->
    <input id="tagEncodedHidden" type="text" name="tag_encoded" value="{{ old('tag_encoded') ?? 0 }}" hidden/>

    <!--Hidden and visible fields for readable tag-->
    <input id="tagReadbleHidden" type="text" name="tagReadbleHidden" value="{{ old('tagReadbleHidden') ?? __('tags.other') }}" hidden/>
    <p id="choosenTags">{{__('ui.chosenTags')}}: <span id="tagReadbleVisible">{{ old('tagReadbleHidden') ?? __('tags.other')}}</span></p>

    <button class="def-button delete-button hidden" id="clearTagsBtn" type="button">{{__('ui.clearTagsFromPost')}}</button>
@endsection
    
@section('input-description')
    <textarea class="def-textarea" id="inputDecs" name="description" form="formCreatePost" rows="15" maxlength="9000">{{ old('description') }}</textarea>
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

@section('input-region')
    <x-region-select locale='{{app()->getLocale()}}'/>
@endsection

@section('input-town')
    <div class="hidden" id="townField">
        <h3 class="elementHeading" for="inputTown">{{__('ui.locationTown')}}</h3>
        <input class="def-input" id="inputTown" name="town" type="text" placeholder="{{__('ui.town')}}" value="{{ old('town') }}">
        <x-server-input-error errorName='town' inputName='inputTown' errorClass='error'/>
    </div>
@endsection

@section('input-email')
    <input class="def-input" id="inputEmail" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{ old('user_email') ?? $user->email }}" autocomplete="email">
@endsection

@section('input-phone')
    <input class="def-input format-phone" id="inputPhone" name="user_phone_raw" maxlength="10" type="text" placeholder="0 (00) 000 00 00" value="{{ old('user_phone_raw') ?? $user->phone_readable }}" autocomplete="phone">
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
                        $('.error').empty();
                        $('.error').addClass('hidden');
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
                        window.location="{{ route('posts.store.fake') }}";
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