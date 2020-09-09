@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/mailer_create_edit.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <ul>
                    <li><a id="personlaInfoBtn" href="{{route('profile')}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{route('mailer.index')}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{route('profile.subscription')}}">{{__('ui.mySubscription')}}</a></li>
                </ul>
            </nav>

            <div class="mailerContent">
                @yield('page-title')
                
                @yield('form')

                    <div class="element" id="type">
                        <h3 class="elementHeading">{{__('ui.choosePostType')}}</h3>
                        @yield('input-type')
                        <div class="help">
                            <p><i>{{__('ui.mailerTypesHelp')}}</i></p>
                        </div>
                    </div>

                    <div class="element" id="keywords">
                        <h3 class="elementHeading">{{__('ui.mailerChooseDescription')}}</h3>
                        @yield('input-keywords')
                        <x-server-input-error errorName='keywords' inputName='inputKeywords' errorClass='error'/>
                        <div class="help">
                            <p><i>{{__('ui.mailerDescriptionHelp')}}</i></p>
                        </div>
                    </div>

                    <div class="element" id="tags">
                        <h3 class="elementHeading">{{__('ui.mailerChooseTags')}}</h3>
                        
                        <div id="navTags">
                            <ul>
                                <li><button type="button" class="tagsTrigger hseEq">{{__('tags.hseEq')}}<span class="arrow arrowDown"></span></button></li>
                                <li><button type="button" class="tagsTrigger drillingEq">{{__('tags.drillingEq')}}<span class="arrow arrowDown"></span></button></li>
                                <li><button type="button" class="tagsTrigger repairEq">{{__('tags.repairEq')}}<span class="arrow arrowDown"></span></button></li>
                                <li><button type="button" class="tagsTrigger productionEq">{{__('tags.productionEq')}}<span class="arrow arrowDown"></span></button></li>
                                <li><button type="button" class="tagsTrigger loggingEq">{{__('tags.loggingEq')}}<span class="arrow arrowDown"></span></button></li>
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
        
                        @yield('input-tags')
                        <div class="help">
                            <p><i>{{__('ui.mailerTagsHelp')}}</i></p>
                        </div>
                    </div>

                    <div class="element" id="authors">
                        <h3 class="elementHeading" for="inputKeywords">{{__('ui.mailerAuthors')}}</h3>
                        @yield('input-authors')
                        <div class="help">
                            <p><i>{{__('ui.mailerAuthorsHelp')}}</i></p>
                        </div>
                    </div>
                    
                    <div id="btns">
                        <button class="def-button submit-button" type="submit">{{__('ui.save')}}</button>
                        <a class="def-button cancel-button" href="{{ route('mailer.index') }}">{{__('ui.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    @yield('mailer-scripts')
    <script type="text/javascript">

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
            //remove from array
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
                        // Mark drop down button as choosen
                        clickedTag.addClass('choosen');
                        clickedTag.addClass('isActiveBtn');
                        // Show help text and choosen tag
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
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#dropDown a').removeClass('loading'); 
                    }
                });
            };

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

            // User click tag from drop down menu
            $('#dropDown a').click(function($e){
                $e.preventDefault();
                if ( $(this).hasClass('choosen') ) {
                    removeFromChoosenTags($(this));
                    $(this).removeClass('loading');
                } else {
                    if ( $('#tagEncodedHidden').attr('value').split(' ').length > 9 ) {
                        showPopUpMassage(false, "{{ __('messages.mailerToManyTags') }}");
                        $(this).removeClass('loading');
                    } else {
                        // Make cursor wait
                        $(document.body).css('cursor', 'wait');
                        // Choose the tag
                        addToChoosenTags($(this));
                    }
                }
            });

            //Validate the form
            $('.mailer-form').validate({
                rules: {
                    keywords: {
                        maxlength: 255
                    }
                },
                messages: {
                    keywords: {
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    }
                }
            });

        });
        
    </script>
@endsection
