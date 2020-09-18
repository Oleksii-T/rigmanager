@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/mailer_create_edit.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/tags.css')}}" />
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
                        
                        <x-equipment-tags role="3"/>
                        @yield('input-equipment-tags')
                    
                        <x-service-tags role="3"/>
                        @yield('input-service-tags')

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
        $(document).ready(function(){

            var eqTags = new Object();
            var seTags = new Object();

            // show modal equipment tags 
            $('button.equipment-tags-show').click(function(){
                $('#equipment-tags-modal').removeClass('hidden');
                $('body').addClass('noscroll');
            });

            // show modal service tags 
            $('button.service-tags-show').click(function(){
                $('#service-tags-modal').removeClass('hidden');
                $('body').addClass('noscroll');
            });

            //close modal if clicked beyong the modal
            window.onclick = function(event) {
                var modalEq = document.getElementById("equipment-tags-modal");
                var modalSe = document.getElementById("service-tags-modal");
                if (event.target == modalEq) {
                    $('#equipment-tags-modal').addClass('hidden');
                    $('body').removeClass('noscroll');
                } else if (event.target == modalSe) {
                    $('#service-tags-modal').addClass('hidden');
                    $('body').removeClass('noscroll');
                }
            }

            // close modal tags if clicke on cancel btn
            $('button.close-tags').click(function(){
                $('div.modal-view').addClass('hidden');
                $('body').removeClass('noscroll');
            });
            $('#equipment-tags-modal p.tag.first').click(function(){
                var id = $(this).attr('id'); //get tag code
                var tag = $(this).text(); // get tag name
                if ( $(this).hasClass('isActiveBtn') ) {
                    console.log( 'Old equipment tags object:' );
                    console.log( eqTags );
                    var regex = new RegExp ('^'+id+'(\..*)?$', 'g');
                    console.log( regex );
                    for (tag in eqTags) {
                        console.log( 'analizing tag: '+'['+tag+']'+eqTags[tag] );
                        if ( tag.match(regex) ) {
                            console.log('match founds: '+'['+tag+']'+eqTags[tag]);
                            delete eqTags[tag];
                        }
                    }
                    $(this).removeClass('isActiveBtn');
                    console.log( 'FIRST tag removed. New equipment tags object:' );
                    console.log( eqTags );
                } else {
                    eqTags[id] = tag;
                    showChosenTags();
                    $(this).addClass('isActiveBtn'); // add active btn effect
                    $('#modal-hidden-tag').val(id); //save tag code to hiden input
                    $('div.tags_'+id).removeClass('hidden'); //show sub tags of chosen tag
                    $('div.selected-tags span').empty(); // clear preview of chosen tags
                    $('div.selected-tags span').text(tag); // write tag name to preview
                    console.log( 'New FIRST tag chosen. Equipment tags object:' );
                    console.log( eqTags );
                }
            });

            function showChosenTags() {
                console.log( 'showing tags...' );
            }

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

            /*
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
            */

            //Validate the form
            $('.mailer-form').validate({
                rules: {
                    keywords: {
                        minlength: 3,
                        maxlength: 255
                    }
                },
                messages: {
                    keywords: {
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    }
                }
            });

        });
        
    </script>
@endsection
