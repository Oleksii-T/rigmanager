@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.postImport')}}</span></span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-post-create-nav active='import'/>
        <div class="content">
            <h1>{{__('ui.postImport')}}</h1>
            <div class="import">
                <div class="import-top">
                    <div class="import-top-text">{{__('ui.postImportTitle')}}</div>
                    <form id="form-import" action="{{loc_url(route('import.upload'))}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <label class="label">{{__('ui.postImportUpload')}} <span class="orange">*</span></label>
                            <div class="upload-zone">
                                <div class="dz-message"><span>{{__('ui.dzDesc')}}</span></div>
                            </div>
                            <div class="form-note-import hidden">{{__('ui.fileImporting')}}</div>
                            <div class="form-error"></div>
                            <div class="form-button">
                                <button class="button" type="submit">{{__('ui.publish')}}</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="import-bottom">
                    <div class="import-bottom-title">{{__('ui.importHow?')}}</div>
                    <div class="import-bottom-text">
                        <p>{{__('ui.postImportHow')}}</p>
                        <p>{{__('ui.postImportRules')}} <a href="{{loc_url(route('import.rules'))}}">{{__('postImportRules.title')}}</a>.</p>
                    </div>
                    <a href="{{route('download.post.import')}}" class="button button-blue">{{__('ui.postImportDownload')}}</a>
                    <div class="warning">{{__('ui.postImportWarning')}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // create file upload form (dropzone)
            $('.upload-zone').dropzone({
                url: "{{loc_url(route('import.upload'))}}",
                paramName: "import-file",
                uploadMultiple: false,
                parallelUploads: 5,
                maxFilesize: 1, // MB
                addRemoveLinks: true,
                timeout: 60000, //ms
                maxFiles: 1,
                acceptedFiles: '.xlsx',
                autoProcessQueue: false,
                dictDefaultMessage: "",
                dictFileTooBig: "{{__('ui.dzBigFile')}}",
                dictInvalidFileType: "{{__('ui.dzInvalidMimeXlsx')}}",
                dictResponseError: "{{__('ui.dzServerError')}}",
                dictUploadCanceled: "{{__('ui.dzUploadCanceled')}}",
                dictRemoveFile: "{{__('ui.dzUploadRemoveLink')}}",
                dictMaxFilesExceeded: "{{__('ui.dzTooFewFiles')}}",
                init: function () {
                    var myDropzone = this;

                    $("#form-import button[type=submit]").click(function (e) {
                        e.preventDefault();
                        $('#form-import .form-error').empty();
                        if (myDropzone.getQueuedFiles().length < 1) {
                            $('#form-import .form-error').text("{{__('ui.importFileRequireError')}}");
                        } else {
                            $(this).addClass('loading');
                            $('.form-note-import').removeClass('hidden');
                            myDropzone.processQueue();
                        }
                    });

                    this.on('sending', function(file, xhr, formData) {
                        formData.append("_token", "{{ csrf_token() }}");
                    });

                    this.on("success", function(){
                        $("#form-import button[type=submit]").removeClass('loading');
                        $('.form-note-import').addClass('hidden');
                        showPopUpMassage(true, "{{ __('messages.postImportSuccess') }}");
                        myDropzone.removeAllFiles();
                    });

                    this.on("error", function(file, errorMessage, xhr){
                        $("#form-import button[type=submit]").removeClass('loading');
                        $('.form-note-import').addClass('hidden');
                        myDropzone.removeAllFiles();
                        if (typeof errorMessage == 'string') {
                            $('#form-import .form-error').text(errorMessage);
                        }
                        else if (errorMessage['message']) {
                            $('#form-import .form-error').text(errorMessage['message']);
                        } else {
                            $('#form-import .form-error').text("{{ __('messages.error') }}");
                        }
                    });
                },
            });
            
        });
    </script>
@endsection