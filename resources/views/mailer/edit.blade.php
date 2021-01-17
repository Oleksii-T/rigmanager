@extends('layouts.mailer_create_edit')

@section('page-title')
    <h1>{{__('ui.settingUpMailer')}}</h1>
@endsection

@section('form')
    <form class="mailer-form" id="formUpdateMailer" method="POST" action="{{ loc_url(route('mailer.update')) }}">
        @csrf
        @method('PATCH')
@endsection

@section('input-title')
    <input class="def-input" id="inputTitle" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{ old('title') ?? $mailer->title }}"/>
@endsection

@section('input-keywords')
    <textarea id="inputKeywords" name="keywords" form="formUpdateMailer" rows="5" maxlength="9000">{{ old('keywords') ?? $mailer->keywords }}</textarea>
@endsection

@section('tags')
    <p class="tags-selected">
        @foreach ($mailer->tags_map as $tag)
        {{$tag}}
        <span class="tags-selecte-delim">&#x02192;</span>
        @endforeach
    </p>
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

@section('input-cost')
    <input class="input-cost cost-from-input" name="costFrom" type="text" placeholder="{{__('ui.from')}}">
    <span class="cost-delimeter">-</span>
    <input class="input-cost cost-to-input" name="costTo" type="text" placeholder="{{__('ui.to')}}">
@endsection

@section('input-region')
    <x-region-select locale='{{app()->getLocale()}}' :defValue='$mailer->region'/>
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
