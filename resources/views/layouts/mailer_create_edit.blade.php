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
                        
                        @yield('input-equipment-tags')
                        <x-equipment-tags role="3"/>
                    
                        @yield('input-service-tags')
                        <x-service-tags role="3"/>

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
            
            // user submits the chosen equipment tag
            $('button.equipment.submit-tags').click(function(){
                $('div.modal-view').addClass('hidden');
                $('body').removeClass('noscroll');
                id = $('input.hidden-encoded-tag.equipment').val();
                tags = $('div.selected-tags.equipment span').text();
                if ( !id ) {
                    return;
                } else if ( Object.keys(eqTags) && Object.keys(eqTags).length == 10 ) {
                    showPopUpMassage(false, "{{ __('messages.mailerToManyTags') }}");
                } else if ( eqTags[id] != undefined ) {
                    showPopUpMassage(false, "{{ __('messages.tagAlreadyChosen') }}");
                } else {
                    eqTags[id] = tags;
                    $( "div.chosen-tags.equipment ol" ).append( "<li><button id=\"encoded_"+id+"\" type=\"button\" title=\"{{__('ui.delete')}}\">"+tags+"</button></li>" );
                    // hide all chosen effects
                    $('p.equipment.tag').removeClass('isActiveBtn');
                    $('input.hidden-encoded-tag.equipment').val('');
                    $('div.selected-tags.equipment span').text("{{__('ui.empty')}}");
                    $('div.equipment.tags.second').addClass('hidden');
                    $('div.equipment.tags.third').addClass('hidden');
                }
            });

            // user clicks of first tag
            $('p.equipment.tag.first').click(function(){
                var id = $(this).attr('id'); //get tag code
                var tag = $(this).text(); // get tag name
                $('p.equipment.tag').removeClass('isActiveBtn');
                $(this).addClass('isActiveBtn')
                $('div.equipment.tags.second').addClass('hidden');
                $('div.equipment.tags.third').addClass('hidden');
                $('input.equipment.hidden-encoded-tag').val(id); // bug
                $('div.equipment.tags_'+id).removeClass('hidden');
                $('div.equipment.selected-tags span').empty();
                $('div.equipment.selected-tags span').text(tag); // bug
            });

            // user clicks of second tag
            $('p.equipment.tag.second').click(function(){
                var tag = $(this).text(); //get tag code
                var id = $(this).attr('id'); // get tag name
                var parentTag =  $('#'+parentId).text();
                var parentId = id.match(/^[0-9]*/)[0];
                var tags = parentTag + ' > ' + tag;
                $('p.equipment.tag.second').removeClass('isActiveBtn');
                $(this).addClass('isActiveBtn');
                $('p.equipment.tag.third').removeClass('isActiveBtn');
                $('div.equipment.tags.third').addClass('hidden');
                $('input.equipment.hidden-encoded-tag').val(id);
                $('div.equipment.tags_'+id.replace('.', '\\.') ).removeClass('hidden');
                $('div.equipment.selected-tags span').empty();
                $('div.equipment.selected-tags span').text(tags);
            });

            // user clicks of third tag
            $('p.tag.third').click(function(){
                id = $(this).attr('id');
                tag = $(this).text();
                var parentId = id.match(/^[0-9]*\.[0-9]*/)[0].replace('.', '\\.');
                var parentTag =  $('#'+parentId).text();
                var grandParentId = id.match(/^[0-9]*/)[0];
                var grandParentTag =  $('#'+grandParentId).text();
                var tags = grandParentTag + ' > ' +parentTag + ' > ' + tag;
                $('p.equipment.tag.third').removeClass('isActiveBtn');
                $(this).addClass('isActiveBtn');
                $('input.equipment.hidden-encoded-tag').val(id);
                $('div.equipment.selected-tags span').empty();
                $('div.equipment.selected-tags span').text(tags);
            });

            $('div.equipment.chosen-tags').on('click', 'button', function(){
                id = getIdFromClasses( $(this).attr('class'), 'encoded_' );
                console.log('deleting...'+id);
            });

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
