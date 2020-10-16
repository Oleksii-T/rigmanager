@extends('layouts.mailer_create_edit')

@section('page-title')
    <h1>{{__('ui.settingUpMailer')}}</h1>
@endsection

@section('form')
    <form class="mailer-form" id="formUpdateMailer" method="POST" action="{{ loc_url(route('mailer.update')) }}">
        @csrf
        @method('PATCH')
@endsection

@section('input-type')
    <label class="cb-container" for="typeSell">{{__('ui.postTypeSellFull')}}
        <input id="typeSell" type="checkbox" name="types[]" value="1" {{array_key_exists("1", $mailer->types_map) ? 'checked="checked"' : "" }}>
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeBuy">{{__('ui.postTypeBuyFull')}}
        <input id="typeBuy" type="checkbox" name="types[]" value="2" {{array_key_exists("2", $mailer->types_map) ? 'checked="checked"' : "" }}>
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeRent">{{__('ui.postTypeRentFull')}}
        <input id="typeRent" type="checkbox" name="types[]" value="3" {{array_key_exists("3", $mailer->types_map) ? 'checked="checked"' : "" }}>
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeLeas">{{__('ui.postTypeLeasFull')}}
        <input id="typeLeas" type="checkbox" name="types[]" value="4" {{array_key_exists("4", $mailer->types_map) ? 'checked="checked"' : "" }}>
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeGiveS">{{__('ui.postTypeGiveS')}}
        <input id="typeGiveS" type="checkbox" name="types[]" value="5" {{array_key_exists("5", $mailer->types_map) ? 'checked="checked"' : "" }}>
        <span class="cb-checkmark"></span>
    </label>
    <label class="cb-container" for="typeGetS">{{__('ui.postTypeGetS')}}
        <input id="typeGetS" type="checkbox" name="types[]" value="6" {{array_key_exists("6", $mailer->types_map) ? 'checked="checked"' : "" }}>
        <span class="cb-checkmark"></span>
    </label>
    <x-server-input-error errorName='types' inputName='typeSell' errorClass='error'/>
@endsection

@section('input-keywords')
    <textarea id="inputKeywords" name="keywords" form="formUpdateMailer" rows="5" maxlength="9000">{{ old('keywords') ?? $mailer->keywords }}</textarea>
@endsection

@section('input-equipment-tags')
    <!--Hidden field for encoded tag for DB-->
    <input id="tagEqEncodedHidden" type="text" name="eq_tags_encoded" value="{{$mailer->eq_tags_encoded ? json_encode($mailer->eq_tags_encoded) : ''}}" hidden/>

    <!--Visible fields for readable tag-->                        
    <div class="chosen-tags equipment">
        <p>{{__('ui.mailerEqTags')}}:</p>
        <ol class="orderedList">
            @if ($mailer->eq_tags_encoded)
                @foreach ($mailer->eq_tags_map as $id => $tag)
                    <li><button class="removeTag chosen_{{$id}}" type="button" title="{{__('ui.delete')}}">{{$tag}}<img src="{{asset('icons/closeRedIcon.svg')}}" alt="{{__('alt.keyword')}}"></button></li>
                @endforeach
            @endif
        </ol>
    </div>
@endsection

@section('input-service-tags')    
    <!--Hidden field for encoded tag for DB-->
    <input id="tagSeEncodedHidden" type="text" name="se_tags_encoded" value="{{$mailer->se_tags_encoded ? json_encode($mailer->se_tags_encoded) : ''}}" hidden/>

    <!--Visible fields for readable tag-->                        
    <div class="chosen-tags service">
        <p>{{__('ui.mailerSeTags')}}:</p>
        <ol class="orderedList">
            @if ($mailer->se_tags_encoded)
                @foreach ($mailer->se_tags_map as $id => $tag)
                    <li><button class="removeTag chosen_{{$id}}" type="button" title="{{__('ui.delete')}}">{{$tag}}<img src="{{asset('icons/closeRedIcon.svg')}}" alt="{{__('alt.keyword')}}"></button></li>
                @endforeach
            @endif
        </ol>
    </div>
@endsection

@section('input-authors')  
    <input id="inputAuthors" name="authors_encoded" value="{{ $mailer->authors_string }} " hidden>
    @if ($mailer->authors_encoded)
        <ol class="orderedList">
            @foreach ($mailer->authors_map as $id => $author)
                <li><button class="remove-author author_{{$id}}" type="button" title="{{__('ui.delete')}}">{{$author}}<img src="{{asset('icons/closeRedIcon.svg')}}" alt="{{__('alt.keyword')}}"></button></li>
            @endforeach
        </ol>
    @else
        <p id="noAuthors">{{__('ui.mailerNoAuthors')}}</p>
    @endif
@endsection

@section('mailer-scripts')
    <script type="text/javascript">
        var chosenEqTags = [];
        var chosenSeTags = [];
        $(document).ready(function(){

            //get digit from classes of DOM element (depends on prefix)
            function getIdFromClassesE(classes, prefix) {
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
                var id = getIdFromClassesE($(this).attr('class'), 'author_');
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

            preTags = $('#tagEqEncodedHidden').val();
            if (preTags) {
                JSON.parse(preTags).forEach(element => {
                    chosenEqTags.push(element);
                });
            }
            preTags = $('#tagSeEncodedHidden').val();
            if (preTags) {
                JSON.parse(preTags).forEach(element => {
                    chosenSeTags.push(element);
                });
            }
        });
    </script>
@endsection
