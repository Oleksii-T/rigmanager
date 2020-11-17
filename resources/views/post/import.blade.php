@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post_import.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <h1 class="page-title">{{__('ui.postImport')}}</h1>
        <div class="page-content">
            <nav class="creation-type content-nav">
                <ul>
                    <li><a id="equipment-create" href="{{loc_url(route('posts.create'))}}">{{__('ui.equipment')}}</a></li>
                    <li><a id="service-create" href="{{loc_url(route('service.create'))}}">{{__('ui.service')}}</a></li>
                    <li><a id="post-import" href="{{loc_url(route('post.import'))}}">{{__('ui.postImport')}}</a></li>
                </ul>
            </nav>
            <div class="content-body">
                <h2 class="body-title">{{__('ui.postImportTitle')}}</h2>
                @if (Session::has('import-error'))
                    <div class="import-errors">
                        <p>{{Session::get('import-error')}}

                        {{__('ui.importErrorAfter')}}</p>
                    </div>
                @endif
                <div class="content-btns">
                    <div class="input-field">
                        <label class="btn-label" for="download-import">{{__('ui.postImportDownload')}}:</label>
                        <a id="download-import" class="def-button submit-button" href="{{route('download.post.import')}}">{{__('ui.download')}}</a>
                    </div>
                    <div class="input-field">
                        <form id="import-form" action="{{loc_url(route('import.upload'))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <p class="btn-label">{{__('ui.postImportUpload')}}:</p>
                            <div class="choose-file-field">
                                <label class="def-button" for="input-file">{{__('ui.chooseFile')}}</label>
                                <p class="file-name hidden"></p>
                                <input class="hidden" id="input-file" type="file" name="import-file">
                            </div>
                            <button type="submit" class="def-button submit-button submit-import hidden">{{__('ui.upload')}}</button>
                        </form>
                    </div>
                </div>
                <div class="content-text">
                    <p class="body-intro">{{__('ui.postImportIntro')}}</p>
                    <p class="body-text">{{__('ui.postImportHow')}}</p>
                    <a class="learn-rules" href="{{loc_url(route('import.rules'))}}">{{__('ui.postImportRules')}}</a>
                    <p class="body-last">{{__('ui.postImportWarning')}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function() {
            $('#input-file').change(function(){
                var file = $(this)[0].files[0];
                if (file.name) {
                    $('.file-name').html(file.name);
                    $('.file-name').removeClass('hidden');
                    $('.submit-import').removeClass('hidden');
                }
            });
        });

    </script>
@endsection
