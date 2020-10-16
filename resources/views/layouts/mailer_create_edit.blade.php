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
                    <li><a id="personlaInfoBtn" href="{{loc_url(route('profile'))}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{loc_url(route('mailer.index'))}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{loc_url(route('profile.subscription'))}}">{{__('ui.mySubscription')}}</a></li>
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

                        <x-server-input-error errorName='eq_tags_encoded' inputName='' errorClass='error'/>

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
                        <a class="def-button cancel-button" href="{{ loc_url(route('mailer.index')) }}">{{__('ui.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mousewheel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    <!--Sub script-->
    @yield('mailer-scripts')
    <!--General scrip-->
    <script type="text/javascript">
        $(document).ready(function(){

            // disable scrolling on master page when hovering the column
            $(".tags-modal .column").bind('mousewheel', function(e, d) {
                var t = $(this);
                if (d > 0 && t.scrollTop() === 0) {
                    e.preventDefault();
                }
                else {
                    if (d < 0 && (t.scrollTop() == t.get(0).scrollHeight - t.innerHeight())) {
                        e.preventDefault();
                    }
                }
            });

            //get digit from classes of DOM element (depends on prefix)
            function getIdFromClasses(classes, prefix) {
                // regex special chars does not escaped in prefix!!!
                var reg = new RegExp("^"+prefix+"[0-9]+\.*$", 'g');
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

            // user submits the chosen equipment tags
            $('button.equipment.submit-tags').click(function(){
                $('div.modal-view').addClass('hidden');
                id = $('input.equipment.hidden-encoded-tag').val();
                tags = $('div.equipment.selected-tags span').text();
                if ( !id ) {
                    return;
                } else if ( chosenEqTags.length >= 10 ) {
                    showPopUpMassage(false, "{{ __('messages.mailerToManyTags') }}");
                } else if ( chosenEqTags.includes(id) ) {
                    showPopUpMassage(false, "{{ __('messages.tagAlreadyChosen') }}");
                } else {
                    chosenEqTags.push(id); //save new tag to js global array
                    $( "div.equipment.chosen-tags ol" ).append( "<li><button class='chosen_"+id+"' type='button' title='{{__('ui.delete')}}'>"+tags+"<img src='{{asset('icons/closeRedIcon.svg')}}' alt='{{__('alt.keyword')}}'></button></li>" ); //append chosen tag to chosen tags view
                    $('#tagEqEncodedHidden').val(JSON.stringify(chosenEqTags)); // save encoded tags to hidden input
                    $('button.equipment-tags-show span').html('{{__("ui.chooseMore")}}'); // change text of button depends of chosen tags amount
                    // hide all chosen effects
                    $('p.equipment.tag').removeClass('isActiveBtn');
                    $('input.equipment.hidden-encoded-tag').val('');
                    $('div.equipment.selected-tags span').text("{{__('ui.empty')}}");
                    $('div.equipment.tags.second').addClass('hidden');
                    $('div.equipment.tags.third').addClass('hidden');
                }
            });

            // user submits the chosen service tags
            $('button.service.submit-tags').click(function(){
                $('div.modal-view').addClass('hidden');
                id = $('input.hidden-encoded-tag.service').val();
                tags = $('div.selected-tags.service span').text();
                if ( !id ) {
                    return;
                } else if ( chosenSeTags.length >= 10 ) {
                    showPopUpMassage(false, "{{ __('messages.mailerToManyTags') }}");
                } else if ( chosenSeTags.includes(id) ) {
                    showPopUpMassage(false, "{{ __('messages.tagAlreadyChosen') }}");
                } else {
                    chosenSeTags.push(id); //save new tag to js global array
                    $( "div.chosen-tags.service ol" ).append( "<li><button class='chosen_"+id+"' type='button' title='{{__('ui.delete')}}'>"+tags+"<img src='{{asset('icons/closeRedIcon.svg')}}' alt='{{__('alt.keyword')}}'></button></li>" ); //append chosen tag to chosen tags view
                    $('#tagSeEncodedHidden').val(JSON.stringify(chosenSeTags)); // save encoded tags to hidden input
                    $('button.service-tags-show span').html('{{__("ui.chooseMore")}}'); // change text of button depends of chosen tags amount
                    // hide all chosen effects
                    $('p.service.tag').removeClass('isActiveBtn');
                    $('input.service.hidden-encoded-tag').val('');
                    $('div.service.selected-tags span').text("{{__('ui.empty')}}");
                    $('div.service.tags.second').addClass('hidden');
                    $('div.service.tags.third').addClass('hidden');
                }
            });

            // remove equipment tag
            $('div.equipment.chosen-tags').on('click', 'button', function(){
                id = getIdFromClasses( $(this).attr('class'), 'chosen_' );
                var index = chosenEqTags.indexOf(id);
                chosenEqTags.splice(index, 1);
                $(this).parent().remove(); //delete tag from chosen view
                $('#tagEqEncodedHidden').val(JSON.stringify(chosenEqTags)); //save new json tags to hidden input
                // change text of button depends of chosen tags amount
                if ( chosenEqTags.length == 0 ) {
                    $('button.equipment-tags-show span').html('{{__("ui.choose")}}');
                    $('#tagEqEncodedHidden').val(null);
                }
            });

            // remove service tag
            $('div.service.chosen-tags').on('click', 'button', function(){
                id = getIdFromClasses( $(this).attr('class'), 'chosen_' );
                var index = chosenSeTags.indexOf(id);
                chosenSeTags.splice(index, 1);
                $(this).parent().remove(); //delete tag from chosen view
                $('#tagSeEncodedHidden').val(JSON.stringify(chosenSeTags)); //save new json tags to hidden input
                // change text of button depends of chosen tags amount
                if ( chosenSeTags.length == 0 ) {
                    $('button.service-tags-show span').html('{{__("ui.choose")}}');
                    $('#tagSeEncodedHidden').val(null);
                }
            });

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
