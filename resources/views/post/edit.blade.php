@extends('layouts.post_create_edit')

@section('page-title')
    <p id="pageTitle">{{__('ui.postSettings')}}</p>
@endsection

@section('form')
    <form method="POST" class="post-form" id="formUpdatePost" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
@endsection

@section('input-title')
    <input class="def-input" id="inputTitle" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{ old('title') ?? $post->title }}"/>
@endsection 

@section('input-condition')
    <input type="radio" id="conditionNew" name="condition" value="2" {{$post->condition==2 ? 'checked="checked"' : "" }}>
    <label for="conditionNew">{{__('ui.conditionNew')}}</label><br>
    <input type="radio" id="conditionSH" name="condition" value="3" {{$post->condition==3 ? 'checked="checked"' : "" }}>
    <label for="conditionSH">{{__('ui.conditionSH')}}</label><br>
    <input type="radio" id="conditionForParts" name="condition" value="4" {{$post->condition==4 ? 'checked="checked"' : "" }}>
    <label for="conditionForParts">{{__('ui.conditionForParts')}}</label><br>
    <input type="radio" id="other" name="condition" value="1"  {{$post->condition==1 ? 'checked="checked"' : "" }}>
    <label for="other">{{__('ui.other')}}</label>
@endsection

@section('inputs-tag')
    <!--Hidden field for encoded tag for DB-->
    <input id="tagEncodedHidden" type="text" name="tag_encoded" value="{{ old('tag_encoded') ?? $post->tag_encoded }}" hidden/>
    
    <!--Hidden and visible fields for readable tag-->
    <input id="tagReadbleHidden" type="text" name="tagReadbleHidden" value="{{ old('tagReadbleHidden') ?? $post->tag_readable }}" hidden/>
    <p id="choosenTags">{{__('ui.chosenTags')}}: <span id="tagReadbleVisible">{{ old('tagReadbleHidden') ?? $post->tag_readable }}</span></p>
    
    <button class="def-button delete-button {{$post->tag_encoded ? '' : 'hidden'}}" id="clearTagsBtn" type="button">{{__('ui.clearTagsFromPost')}}</button>
@endsection 

@section('input-description')
    <textarea name="description" id="inputDecs" form="formUpdatePost" rows="15" maxlength="9000">{{ old('description') ?? $post->description }}</textarea>
@endsection 

@section('dz-message')
    @if ($post->images->isEmpty())
        <div class="dz-message"><span>{{__('ui.dzDesc')}}</span></div>
    @endif
@endsection

@section('images-errors')
    @error('images.*')
        <div class="error">
            <p>{{ $message }}</p>
            @if (Session::has('tooManyImagesError'))
                <p>{{ Session::get('tooManyImagesError') }}</p>
            @endif
        </div>
    @enderror
@endsection 

@section('input-cost')
    <input class="def-input input-cost" id="inputCost" name="cost" type="text" placeholder="{{__('ui.cost')}}" value="{{ old('cost') ?? $post->cost_readable }}"/>
        
    <select id="inputCurrency" name="currency">
        <option value="UAH" {{$post->currency=='UAH' ? 'selected' : ''}}>{{__('ui.grivna')}}</option>
        <option value="USD" {{$post->currency=='USD' ? 'selected' : ''}}>{{__('ui.dollar')}}</option>
    </select>
@endsection 

@section('input-province')
    <input class="def-input" id="inputProvince" name="province" type="text" placeholder="{{__('ui.province')}}" value="{{ old('province') ?? $post->province }}">
@endsection 

@section('input-town')
    <div class="{{$post->province ? '' : 'hidden'}}" id="townField">
        <h3 class="elementHeading" for="inputTown">{{__('ui.locationTown')}}</h3>
        <input class="def-input" id="inputTown" name="town" type="text" placeholder="{{__('ui.town')}}" value="{{ old('town') ?? $post->town }}">
        <x-server-input-error errorName='town' inputName='inputTown' errorClass='error'/>
    </div>
@endsection 
    
@section('input-email')
    <input class="def-input" id="inputEmail" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{ old('user_email') ?? $post->user_email }}">
@endsection 

@section('input-phone')
    <input class="def-input" id="inputPhone" name="user_phone_raw" maxlength="10" type="text" placeholder="(000) 00-00-000" value="{{ old('user_phone_raw') ?? $post->user_phone_readable }}">
@endsection 

@section('input-viber')
    <input type="checkbox" id="viberInput" name="viber" value="1" {{ $post->viber ? 'checked' : '' }}>
@endsection 

@section('input-telegram')
    <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ $post->telegram ? 'checked' : '' }}>
@endsection 

@section('input-whatsapp')
    <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ $post->whatsapp ? 'checked' : '' }}>
@endsection 

@section('buttons')
    <button class="def-button delete-button" type="button" id="modalPostDeleteOn">{{__('ui.deletePost')}}</button>
@endsection

@section('modals')
    <div class="modalView animate" id="modalPostDelete">
        <div class="modalContent"> 
            <p>{{__('ui.sure?')}}</p>
            <div>
                <button class="def-button submit-button" type="button" id="modalPostDeleteOff">{{__('ui.no')}}</button>
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="def-button cancel-button">{{__('ui.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('post-scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // add visual effect on header nav button
            $('#myItemsTab').addClass('isActiveBtn');

            // createa file upload form (dropzone)
            $('.upload-zone').dropzone({
                url: "{{ route('posts.update', $post->id) }}",
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
                    var thisDropzone = this;
                    
                    if ('{{$images}}') {
                        var images = JSON.parse('{!! $images !!}');
                        $.each(images, function(key,value){
                            var mockFile = { name: value.name, size: value.size, id: value.id };
                            thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                            thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.url);
                        });
                    }

                    this.on("removedfile", function(file) {
                        if (file.id !== undefined) {
                            ajaxUrl = "{{route('posts.img.delete', [$post->id, ':imgNo'])}}";
                            ajaxUrl = ajaxUrl.replace(':imgNo', file.id);
                            $.ajax({
                                type: "POST",
                                url: ajaxUrl,
                                data: {
                                    _method: 'PATCH',
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    data 
                                        ? showPopUpMassage(true, "{{ __('messages.postImgDeleted') }}") 
                                        : showPopUpMassage(false, "{{ __('messages.error') }}");
                                },
                                error: function() {
                                    showPopUpMassage(false, "{{ __('messages.error') }}");
                                }
                            });
                        }
                    }); 

                    $("#form-submit").click(function (e) {
                        e.preventDefault();
                        $('.error').empty();
                        $('.error').addClass('hidden');
                        $(this).addClass('loading');
                        if (thisDropzone.getQueuedFiles().length > 0) {
                            thisDropzone.processQueue();
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
                            thisDropzone.removeAllFiles();
                        }
                        else if ( errorMessage['message'] == "The given data was invalid." ) {
                            showPopUpMassage(false, "{{ __('messages.postInputErrors') }}");
                            var invalidInputErrors = errorMessage['errors'];
                            $.each(invalidInputErrors, function(key, value) {
                                $('.'+key+'.error').append("<p>"+value+"</p>");
                                $('.'+key+'.error').removeClass('hidden');
                            });
                            thisDropzone.removeAllFiles();
                        } else {
                            showPopUpMassage(false, errorMessage);
                        }
                    });
                },
            });

            // show town field if there is town specified
            if ("{{$post->town}}") {
                $('#townField').removeClass('hidden');
            }

            //open modal delete confirm when user ask to
            $('#modalPostDeleteOn').click(function(){
                $('#modalPostDelete').css("display", "block");
            });

            //close delete confirmation
            $('#modalPostDeleteOff').click(function(){
                $('#modalPostDelete').css("display", "none");
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var modal = document.getElementById("modalImgsDelete");
                if (event.target == modal) {
                    $('#modalImgsDelete').css("display", "none");
                }
                var modal = document.getElementById("modalPostDelete");
                if (event.target == modal) {
                    $('#modalPostDelete').css("display", "none");
                }
            }
        });
    </script>
@endsection
