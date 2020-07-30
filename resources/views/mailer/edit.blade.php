@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/mailer_create_edit.css')}}" />
    <link rel="stylesheet" href="{{asset('css/profile_layout.css')}}" />
@endsection

@section('content')
    <div id="profileContentWraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <ul>
                    <li><a id="personlaInfoBtn" href="{{route('profile')}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{route('mailer.index')}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{route('profile.subscription')}}">{{__('ui.mySubscription')}}</a></li>
                </ul>
            </nav>
            <div class="mailerContent">
                <h1>{{__('ui.settingUpMailer')}}</h1>
                <form id="formUpdateMailer" method="POST" action="{{ route('mailer.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="element" id="keywords">
                        <label class="elementHeading" for="inputKeywords">{{__('ui.mailerChooseDescription')}}</label><br>
                        <textarea id="inputKeywords" name="keywords" form="formUpdateMailer" rows="5" maxlength="9000">{{ old('keywords') ?? $mailer->keywords }}</textarea>
                        <x-server-input-error errorName='keywords' inputName='inputKeywords' errorClass='error'/>
                    </div>

                    <div class="element" id="tags" >
                        <p class="elementHeading">{{__('ui.mailerChooseTags')}}</p>
                        
                        <div id="navTags">
                            <ul>
                                <li><button type="button" class="tagsTrigger hseEq">{{__('tags.hseEq')}}<span class="arrow arrowDown"></span></button></li>
                                <li><button type="button" class="tagsTrigger drillingEq">{{__('tags.drillingEq')}}</button></li>
                                <li><button type="button" class="tagsTrigger repairEq">{{__('tags.repairEq')}}</button></li>
                                <li><button type="button" class="tagsTrigger productionEq">{{__('tags.productionEq')}}</button></li>
                                <li><button type="button" class="tagsTrigger loggingEq">{{__('tags.loggingEq')}}</button></li>
                            </ul>
                        </div>
                        
                        <div id="dropDown">
                            
                            <div class="typeOfEq" id="hseEq">
                                <ul id="mainMenu">
                                    <x-tags.hse.fire-hazard/>
                                    <x-tags.hse.life-support/> 
                                    <x-tags.hse.light/>
                                    <x-tags.hse.misc-eq/> 
                                    <x-tags.hse.ppo/>
                                    <x-tags.hse.signalization/>
                                    <li><a href="#" id="1.0">{{__('tags.other')}}</a></li>
                                </ul>
                            </div>
        
                            <div class="typeOfEq" id="drillingEq">
                                <ul id="mainMenu">
                                    <x-tags.drilling.substructure/>
                                    <x-tags.drilling.mast/>
                                    <x-tags.drilling.logging/> 
                                    <x-tags.drilling.boe/> 
                                    <x-tags.drilling.emergency/> 
                                    <x-tags.drilling.power/> 
                                    <x-tags.drilling.lifting/> 
                                    <x-tags.drilling.rotory/> 
                                    <x-tags.drilling.drill-string/> 
                                    <x-tags.drilling.bha/> 
                                    <x-tags.drilling.grouning/> 
                                    <x-tags.drilling.mud/>
                                    <li><a href="#" id="2.0">{{__('tags.other')}}</a></li>
                                </ul>
                            </div>
                
                            <div class="typeOfEq" id="repairEq">
                                <ul id="mainMenu">
                                    <x-tags.repair.substructure/> 
                                    <x-tags.repair.logging/> 
                                    <x-tags.repair.boe/> 
                                    <x-tags.repair.emergency/> 
                                    <x-tags.repair.well-head/>
                                    <x-tags.repair.power/>
                                    <x-tags.repair.lifting/> 
                                    <x-tags.repair.rotory/> 
                                    <x-tags.repair.drill-string/> 
                                    <x-tags.repair.frac/>
                                    <x-tags.repair.coll-tubing/>
                                    <li><a href="#" id="3.0">{{__('tags.other')}}</a></li> 
                                </ul>
                            </div>
                            
                            <div class="typeOfEq" id="productionEq">
                                <ul id="mainMenu">
                                    <x-tags.production.tubing/> 
                                    <x-tags.production.well-head/>
                                    <x-tags.production.x-mass-tree/> 
                                    <li><a href="#" id="4.0">{{__('tags.other')}}</a></li> 
                                </ul>
                            </div>
                
                            <div class="typeOfEq" id="loggingEq">
                                <ul id="mainMenu">
                                    <x-tags.logging.sensors/>
                                    <x-tags.logging.eq/>
                                    <li><a href="#" id="5.0">{{__('tags.other')}}</a></li> 
                                </ul>
                            </div>
        
                        </div>
        
                        <!--Hidden field for encoded tag for DB-->
                        <input id="tagEncodedHidden" type="text" name="tags" value="{{$mailer->tags}} " hidden/>
        
                        <!--Visible fields for readable tag-->                        
                        <div id="choosenTags">
                            <p>{{__('ui.chosenTags')}}:</p>
                            <ol class="orderedList">
                                @if ($mailer->tags)
                                    @foreach ($mailer->tagsIdsAndNames as $id => $tag)
                                        <li id="encoded_{{$id}}"><button class="removeTag" type="button" title="{{__('ui.delete')}}">{{$tag}}</button></li>
                                    @endforeach
                                @endif
                            </ol>
                        </div>
                        <x-server-input-error errorName='tags' inputName='tagEncodedHidden' errorClass='error'/>
                        <div class="help">
                            <p><i>{{__('ui.mailerTagsHelp')}}</i></p>
                        </div>
                    </div>

                    <div class="element" id="authors">
                        <p class="elementHeading" for="inputKeywords">{{__('ui.mailerAuthors')}}</p>
                        <input id="inputAuthors" name="authors" value="{{ $mailer->authors }} " hidden>
                        @if ($mailer->authors)
                            <ol class="orderedList">
                                @foreach ($mailer->authorsIdsAndNames as $id => $author)
                                    <li id="author_{{$id}}"><button type="button" onclick="removeAuthor({{$id}})" title="{{__('ui.delete')}}">{{$author}} </button></li>
                                @endforeach
                            </ol>
                        @else
                            <p id="noAuthors">{{__('ui.mailerNoAuthors')}}</p>
                        @endif
                        <div class="help">
                            <p><i>{{__('ui.mailerAuthorsHelp')}}</i></p>
                        </div>
                    </div>
                    
                    <div class="element" id="btns">
                        <button class="submitBtn" type="submit">{{__('ui.save')}}</button>
                        <a class="cancelBtn" href="{{ route('mailer.index') }}">{{__('ui.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    
<script type="text/javascript">

    // Remove author
    function removeAuthor ($id) {
        //remove from hidden input
        newValue = $('#inputAuthors').attr('value').replace($id+" ", "");
        $('#inputAuthors').attr('value', newValue);
        //remove from visible list
        var element = $('#author_'+$id);
        element.empty();
        element.remove();
        //check if empty
        //if ( $('#inputAuthors').attr('value') == "" ) { TODO }
    }

    // User choosed already choosen tag or removing the tag
    function removeFromChoosenTags (clickedTag) {
        if (typeof clickedTag == 'object') {
            var tagEncoded = clickedTag.attr('id');
        } else {
            var tagEncoded = clickedTag;
            clickedTag = $('#'+tagEncoded.replace(/\./g, '\\.'));
        }
        //remove class from tag btn
        clickedTag.removeClass('choosen');
        clickedTag.removeClass('isActiveBtn');
        //remove from hidden array
        newValue = $('#tagEncodedHidden').attr('value').replace(tagEncoded+" ", "");
        $('#tagEncodedHidden').attr('value', newValue);
        //remove from visible
        var element = $('#encoded_'+tagEncoded.replace(/\./g, '\\.'));
        element.empty();
        element.remove();
        //check for empty
        if ( $('#tagEncodedHidden').attr('value') == "" ) {
            $('#choosenTags').css('display', 'none');
        }
    };

    $(document).ready(function(){

        // If there is any tags choosen
        if ("{{$mailer->tags}}") {
            // Show choosen tags
            $('#choosenTags').css('display', 'block');
            // Mark choosen tags in drop down menu
            var choosenTags = "{{$mailer->tags}}".split(' ');
            choosenTags.forEach(tag => {
                $('#'+tag.replace(/\./g, '\\.')).addClass('choosen');
                $('#'+tag.replace(/\./g, '\\.')).addClass('isActiveBtn');
            });
        }

        //static generator of unique ids for popUpMassages
        function Generator() {};
        Generator.prototype.rand = 1;
        Generator.prototype.getId = function() {return this.rand++;};
        var idGen =new Generator();

        //fade out flash massages
        $("div.flash").delay(3000).fadeOut(350);

        //main Eq Types buttons to open tags to choose
        $('.tagsTrigger').click(function(){
            var type = $(this).attr('class').split(' ')[1];
            var display = $("#"+type).css('display');
            var color = $(this).css('background-color');
            $('.tagsTrigger').removeClass('isActiveBtn');
            if ( color == 'rgba(149, 149, 149, 0.8)' ) {
                $(this).addClass('isActiveBtn');
            } else {
                $(this).removeClass('isActiveBtn');
            }
            
            $('.typeOfEq').css('display', 'none');
            if (display == 'none') {
                $("#"+type).css('display', 'block');
            } else {
                $("#"+type).css('display', 'none');
            }
        });

        //make pop up massage from text
        function popUpMassage (text) {
            var uniqueId = "num" + idGen.getId();
            $('#container').append('<div class="popUp" id="'+uniqueId+'"><p>'+text+'</p></div>');
            $('#'+uniqueId).addClass('popUpShow');
            $('#'+uniqueId).click(function(){ $(this).removeClass('popUpShow') });
            setTimeout(function(){
                $('#'+uniqueId).removeClass('popUpShow');
            }, 3000);
        }

        // User click tag from drop down menu
        $('#dropDown a').click(function($e){
            $e.preventDefault();
            if ( $(this).hasClass('choosen') ) {
                removeFromChoosenTags($(this));
            } else {
                if ( $('#tagEncodedHidden').attr('value').split(' ').length > 9 ) {
                    popUpMassage("{{ __('messages.mailerToManyTags') }}");
                } else {
                    // Make cursor wait
                    $('#dropDown a').addClass('loading');
                    $(document.body).css('cursor', 'wait');
                    // Choose the tag
                    addToChoosenTags($(this));
                }
            }
        });

        // User adding new tag to choosen tags
        function addToChoosenTags (clickedTag) {
            var tagId = clickedTag.attr('id');
            var tagEncoded = clickedTag.attr('id');
            var ajaxUrl = '{{ route("get.readble.tag", ":tagId") }}';
            ajaxUrl = ajaxUrl.replace(':tagId', tagId);
            // Get readable tags path via ajax request
            $.ajax({
                type: "GET",
                url: ajaxUrl,
                success: function(data) {
                    clickedTag.addClass('choosen');
                    clickedTag.addClass('isActiveBtn');
                    $('#choosenTags').css('display', 'block');
                    // Write encoded tag to hidden form field
                    var newValue = $('#tagEncodedHidden').attr('value') + tagEncoded + " ";
                    $('#tagEncodedHidden').attr('value', newValue);
                    // Write readble tag to visible form field for user
                    $( "#choosenTags ol" ).append( "<li id=\"encoded_"+tagEncoded+"\"><button onclick=\"removeFromChoosenTags('"+tagEncoded+"')\" type=\"button\" title=\"{{__('ui.delete')}}\">"+data+"</button></li>" );
                    // Remove wait cursor
                    $(document.body).css('cursor', 'default');
                    $('#dropDown a').removeClass('loading'); 
                },
                error: function() {
                    // Print error massage
                    popUpMassage("{{ __('messages.error') }}");
                    // Remove wait cursor
                    $(document.body).css('cursor', 'default');
                    $('#dropDown a').removeClass('loading'); 
                }
            });
        };

        //Validate the form
        $('#formUpdateMailer').validate({
            rules: {
                keywords: {
                    maxlength: 255
                }
            },
            messages: {
                keywords: {
                    maxlength: 'Максимум 255 символов'
                }
            }
        });

    });
    
</script>
@endsection
