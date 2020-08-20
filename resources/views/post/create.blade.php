@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post_create_edit.css')}}" />
@endsection

@section('content')
    <div id="editItemBody">
        <p id="pageTitle">{{__('ui.postCreate')}}</p>

        <form method="post" id="formNewPost" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div id="title" class="element">
                <label class="elementHeading" for="inputTitle">{{__('ui.title')}}</label><br>
                <input class="def-input" id="inputTitle" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{ old('title') }}"/>
                <x-server-input-error errorName='title' inputName='inputTitle' errorClass='error'/>
                <div class="help">
                    <p><i>{{__('ui.titleHelp')}}</i></p>
                </div>
            </div>

            <div id="condition" class="element">
                <label class="elementHeading" for="inputCondition">{{__('ui.chooseCondition')}}</label><br>
                <select id="inputCondition" name="condition">
                    <option value="Новое">{{__('ui.conditionNew')}}</option>
                    <option value="Б/У">{{__('ui.conditionSH')}}</option>
                </select>
            </div>

            <div id="tag" class="element">
                <p class="elementHeading">{{__('ui.tag')}}</p>
                
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
                <input id="tagEncodedHidden" type="text" name="tag" value="{{ old('tag') ?? 0 }}" hidden/>

                <!--Hidden and visible fields for readable tag-->
                <input id="tagReadbleHidden" type="text" name="tagReadbleHidden" value="{{ old('tagReadbleHidden') ?? __('tags.other') }}" hidden/>
                <p id="choosenTags">{{__('ui.chosenTags')}}: <span id="tagReadbleVisible">{{ old('tagReadbleHidden') ?? __('tags.other')}}</span></p>
                
                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div id="desc" class="element">
                <label class="elementHeading" for="inputDecs">{{__('ui.description')}}</label><br>
                <textarea name="description" id="inputDecs" form="formNewPost" rows="15" maxlength="9000">{{ old('description') }}</textarea>
                <x-server-input-error errorName='description' inputName='inputDecs' errorClass='error'/>
                <div class="help">
                    <p><i>{{__('ui.descriptionHelp')}}</i></p>
                </div>
            </div>

            <div id="imgs" class="element">
                <div>
                    <p class="elementHeading">{{__('ui.image')}}</p>
                    <div>
                        <label for="inputImg">{{__('ui.uploadFile')}}</label><br>
                    </div>
                    <input type="file" id="inputImg" name="images[]" hidden multiple />
                </div>

                @error('images.*')
                    <div class="error">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                <div class="gallery"></div>

                <div class="help">
                    <p><i>{{__('ui.imageHelp')}}</i></p>
                </div>
            </div>

            <div id="miscInfo" class="element">
                <div>
                    <label class="elementHeading" for="inputCost">{{__('ui.cost')}}</label><br>
                    <input class="def-input" id="inputCost" name="cost" type="text" placeholder="{{__('ui.cost')}}" value="{{ old('cost') }}"/>
                    <x-server-input-error errorName='cost' inputName='inputCost' errorClass='error'/>
                </div>

                <div id="locationField">
                    <label class="elementHeading" for="inputLocation">{{__('ui.location')}}</label><br>
                    <input class="def-input" id="inputLocation" name="location" type="text" placeholder="{{__('ui.location')}}" value="{{ old('location') }}"/>
                    <x-server-input-error errorName='location' inputName='inputLocation' errorClass='error'/>
                </div>
                
                <div class="help">
                    <p id="h"><i>{{__('ui.costLocationHelp')}}</i></p>
                </div>
            </div>
            
            <div id="contact" class="element">
                <div id="emailField">
                    <label class="elementHeading" for="inputEmail">{{__('ui.email')}}</label><br>
                    <input class="def-input" id="inputEmail" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{ old('user_email') ?? $user->email }}" autocomplete="email">
                    <x-server-input-error errorName='user_email' inputName='inputEmail' errorClass='error'/>
                </div>

                <div id="phoneField">
                    <label class="elementHeading" id="phoneHeader" for="inputPhone">{{__('ui.phone')}}</label><br>
                    <input class="def-input" id="inputPhone" name="user_phone" type="text" placeholder="{{__('ui.phone')}}" value="{{ old('user_phone') ?? $user->phone }}" autocomplete="phone">
                    <x-server-input-error errorName='user_phone' inputName='inputPhone' errorClass='error'/>
                    <div class="mediaCheckBoxes">
                        <div>
                            <input type="checkbox" id="viberInput" name="viber" value="1" {{ $user->viber ? 'checked' : '' }}>
                            <label for="viberInput">
                                Viber
                                <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ $user->telegram ? 'checked' : '' }}>
                            <label for="telegramInput">
                                Telegram
                                <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ $user->whatsapp ? 'checked' : '' }}>
                            <label for="whatsappInput">
                                WhatsApp
                                <img src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="help">
                    <p><i>{{__('ui.emailPhoneHelp')}}</i></p>
                </div>
            </div>

            <div id="btns" class="element">
                <button class="def-button submit-button" type="submit">{{__('ui.save')}}</button>
                <a class="def-button cancel-button" href="{{ route('home') }}">{{__('ui.cancel')}}</a>
            </div>
        </form>
    </div> 
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/myValidators.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            //add active effect in nav bar
            $('#addItemTab').addClass('isActiveBtn');

            //print choosen tag to user
            var tag_ = $('#hiddenTag').attr('value');
            $('#TagChoosen').text(tag_);

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

            //action when user chose tag
            $('#dropDown a').click(function($e){
                $e.preventDefault();
                //get readable tags path via ajax request
                var tagId = $(this).attr('id');
                var tagEncoded = $(this).attr('id');
                var ajaxUrl = '{{ route("get.readble.tag", ":tagId") }}';
                ajaxUrl = ajaxUrl.replace(':tagId', tagId);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function(data) {
                        //write encoded tag to hidden input for DB
                        $('#tagEncodedHidden').attr("value",tagEncoded);
                        //write readble tag to hidden input for old() feature
                        $('#tagReadbleHidden').attr("value",data);
                        //write readble tag to visible field for user
                        $('#tagReadbleVisible').text(data);
                        //remove wait cursor
                        $('#dropDown a').removeClass('loading'); 
                    },
                    error: function() {
                        //print error massage and remove wait cursor
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        $('#dropDown a').removeClass('loading'); 
                    }
                });
            });

            //make pre-view gallery whenever user submits files
            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, gallery) {

                    if (input.files) {
                        var filesAmount = input.files.length;
                        if ( !$('#previewText').length ) {
                            $($.parseHTML("<p id='previewText'>{{__('ui.preview')}}:</p>")).appendTo(gallery);
                        } 
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                var imgWraper = "num"+idGen.getId();
                                $($.parseHTML('<div></div>')).attr({'class': 'previewImg', 'id': imgWraper}).appendTo(gallery);
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo("#"+imgWraper);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#inputImg').on('change', function() {
                    var gallery = $('div.gallery');
                    $(".gallery").empty();
                    imagesPreview(this, gallery);
                });
            });
            
            //Validate the form
            $('#formNewPost').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 10,
                        maxlength: 70
                    },
                    description: {
                        required: true,
                        minlength: 10,
                        maxlength: 9000
                    },
                    cost: {
                        maxlength: 50
                    },
                    location: {
                        maxlength: 100
                    },
                    user_email: {
                        email: true,
                        maxlength: 254
                    },
                    user_phone: {
                        minlength: 8,
                        maxlength: 20,
                        validPhone: true
                    }
                },
                messages: {
                    title: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    description: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9000]) }}'
                    },
                    cost: {
                        maxlength: '{{ __("validation.max.string", ["max" => 50]) }}'
                    },
                    location: {
                        maxlength: '{{ __("validation.max.string", ["max" => 100]) }}'
                    },
                    user_email: {
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    },
                    user_phone: {
                        minlength: '{{ __("validation.min.string", ["min" => 8]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 20]) }}',
                        validPhone: '{{ __("validation.phone") }}'
                    }
                }
            });
            
        });
    </script>

@endsection
