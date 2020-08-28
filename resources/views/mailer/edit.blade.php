@extends('layouts.mailer_create_edit')

@section('page-title')
    <h1>{{__('ui.settingUpMailer')}}</h1>
@endsection

@section('form')
    <form class="mailer-form" id="formUpdateMailer" method="POST" action="{{ route('mailer.update') }}">
        @csrf
        @method('PATCH')
@endsection

@section('input-keywords')
    <textarea id="inputKeywords" name="keywords" form="formUpdateMailer" rows="5" maxlength="9000">{{ old('keywords') ?? $mailer->keywords }}</textarea>
@endsection

@section('input-tags')
    <!--Hidden field for encoded tag for DB-->
    <input id="tagEncodedHidden" type="text" name="tags_encoded" value="{{$mailer->tags_string}} " hidden/>

    <!--Visible fields for readable tag-->                        
    <div id="choosenTags">
        <p>{{__('ui.chosenTags')}}:</p>
        <ol class="orderedList">
            @if ($mailer->tags_encoded)
                @foreach ($mailer->tags_map as $id => $tag)
                    <li id="encoded_{{$id}}"><button class="removeTag" type="button" onclick="removeFromChoosenTags('{{$id}}')" title="{{__('ui.delete')}}">{{$tag}}</button></li>
                @endforeach
            @endif
        </ol>
    </div>
    <x-server-input-error errorName='tags' inputName='tagEncodedHidden' errorClass='error'/>
@endsection

@section('input-authors')  
    <input id="inputAuthors" name="authors_encoded" value="{{ $mailer->authors_string }} " hidden>
    @if ($mailer->authors_encoded)
        <ol class="orderedList">
            @foreach ($mailer->authors_map as $id => $author)
                <li><button class="remove-author author_{{$id}}" type="button" title="{{__('ui.delete')}}">{{$author}} </button></li>
            @endforeach
        </ol>
    @else
        <p id="noAuthors">{{__('ui.mailerNoAuthors')}}</p>
    @endif
@endsection

@section('mailer-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            
            //get digit from classes of DOM element (depends on prefix)
            function getIdFromClasses(classes, prefix) {
                // regex special chars does not escaped in prefix!!!
                var reg = new RegExp("^"+prefix+"[0-9]+$", 'g');
                var result = '';
                classes.split(' ').every(function(string){
                    result = reg.exec(string);
                    if ( result != null ) {
                        result = result + '';
                        result = result.split('_')[1];
                        return false;
                    } else {
                        return true;
                    }
                });
                return result;
            }

            // Remove author
            $('.remove-author').click(function(){
                var id = getIdFromClasses($(this).attr('class'), 'author_');
                //remove from hidden input
                newValue = $('#inputAuthors').attr('value').replace(id+" ", "");
                $('#inputAuthors').attr('value', newValue);
                //remove from visible list
                $(this).parent().remove();
                //check if empty
                if ( $('#inputAuthors').attr('value') == "" ) {
                    $('#clickToDeleteHelp').addClass('hidden');
                    $('#noAuthors').removeClass('hidden');
                }
            });

            // If there is any tags choosen
            if ("{{$mailer->tags_string}}") {
                // Show choosen tags
                $('#choosenTags').css('display', 'block');
                // Mark choosen tags in drop down menu
                var choosenTags = "{{$mailer->tags_string}}".split(' ');
                choosenTags.forEach(tag => {
                    $('#'+tag.replace(/\./g, '\\.')).addClass('choosen');
                    $('#'+tag.replace(/\./g, '\\.')).addClass('isActiveBtn');
                });
            }
        });
    </script>
@endsection
