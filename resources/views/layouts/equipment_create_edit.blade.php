@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post_create_edit.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/dropzone.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/tags.css')}}" />
    <style>
        #equipment-create {
            background-color: #FE9042;
        }
    </style>
@endsection

@section('content')
    <div id="editItemBody">
        @yield('page-title')

        @yield('form')

            <input type="text" name="thread" value="1" hidden>

            <div id="title" class="element">
                <h3 class="elementHeading">{{__('ui.title')}}<span class="required-input">*</span></h3>
                <div class="input-field">
                    @yield('input-title')
                    <div class="input-help title-help hidden">
                        <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                        <p><i>{{__('ui.titleEqHelp')}}</i></p>
                    </div>
                </div>
                <x-server-input-error errorName='title' inputName='inputTitle' errorClass='error'/>
                <div class="title error error-dz hidden"></div>
                <div class="title-translations">
                    <p class="translations-header">{{__('ui.autoTranslateHeader')}} <a class="auto-translator-link" href="{{loc_url(route('faq'))}}#autoTranslator">{{__('ui.autoTranslate')}}</a></p>
                    
                    <div class="translations-help">
                        <img id="helpImg" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        <p>{{__('ui.translationHelp')}}</p>
                    </div>
            
                    <div class="{{ App::isLocale('uk') ? 'hidden' : '' }}">
                        <label class="cb-container" for="titleTranslateUk">{{__('ui.AutoTranslateToUk')}}
                            @if ( old('title_translate') && !array_key_exists('uk', old('title_translate')) )
                                <input id="titleTranslateUk" type="checkbox" name="title_translate[uk]" value="1">
                            @else
                                @yield('checkbox-title-uk')
                            @endif   
                            <span class="cb-checkmark"></span>
                        </label>
                        @yield('field-title-uk')
                            <x-server-input-error errorName='title_uk' inputName='inputTitleUk' errorClass='error'/>
                            <div class="title_uk error error-dz hidden"></div>
                        </div>
                    </div>
            
                    <div class="{{ App::isLocale('ru') ? 'hidden' : '' }}">
                        <label class="cb-container" for="titleTranslateRu">{{__('ui.AutoTranslateToRu')}}
                            @if ( old('title_translate') && !array_key_exists('ru', old('title_translate')) )
                                <input id="titleTranslateRu" type="checkbox" name="title_translate[ru]" value="1">
                            @else
                                @yield('checkbox-title-ru')
                            @endif 
                            <span class="cb-checkmark"></span>
                        </label>
                        @yield('field-title-ru')
                            <x-server-input-error errorName='title_ru' inputName='inputTitleRu' errorClass='error'/>
                            <div class="title_ru error error-dz hidden"></div>
                        </div>
                    </div>
            
                    <div class="{{ App::isLocale('en') ? 'hidden' : '' }}">
                        <label class="cb-container" for="titleTranslateEn">{{__('ui.AutoTranslateToEn')}}
                            @if ( old('title_translate') && !array_key_exists('en', old('title_translate')) )
                                <input id="titleTranslateEn" type="checkbox" name="title_translate[en]" value="1">
                            @else
                                @yield('checkbox-title-en')
                            @endif 
                            <span class="cb-checkmark"></span>
                        </label>
                        @yield('field-title-en')
                            <x-server-input-error errorName='title_en' inputName='inputTitleEn' errorClass='error'/>
                            <div class="title_en error error-dz hidden"></div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('input-status')

            <div id="type" class="element">
                <h3 class="elementHeading">{{__('ui.choosePostType')}}</h3>
                @yield('input-type')
                <div class="help">
                    <p><i>{{__('ui.postTypeHelp')}}</i></p>
                </div>
            </div>

            <div id="role" class="element">
                <h3 class="elementHeading">{{__('ui.choosePostRole')}}</h3>
                @yield('input-role')
            </div>

            <div id="company" class="element hidden">
                <h3 class="elementHeading">{{__('ui.company')}}</h3>
                @yield('input-company')
                <x-server-input-error errorName='company' inputName='inputCompany' errorClass='error'/>
                <div class="company error error-dz hidden"></div>
            </div>

            <div id="condition" class="element">
                <h3 class="elementHeading">{{__('ui.chooseCondition')}}</h3>
                @yield('input-condition')
            </div>

            <div id="tag" class="element">
                <h3 class="elementHeading">{{__('ui.chooseTag')}}</h3>
                
                <x-equipment-tags role="1"/>

                @yield('inputs-tag')

                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div class="element" id="misc-info">
                <h2 class="sub-header">{{__('ui.miscEqInfo')}}</h2>
                <div id="manufacturer">
                    <h3 class="elementHeading">{{__('ui.chooseManufacturer')}}</h3>
                    <div class="input-field">
                        @yield('input-manufacturer')
                        <div class="input-help manuf-help hidden">
                            <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <p><i>{{__('ui.manufHelp')}}</i></p>
                        </div>
                    </div>
                    <x-server-input-error errorName='manufacturer' inputName='inputManufacturer' errorClass='error'/>
                    <div class="manufacturer error error-dz hidden"></div>
                </div>
    
                <div id="manufactured_date">
                    <h3 class="elementHeading">{{__('ui.chooseManufacturedDate')}}</h3>
                    <div class="input-field">
                        @yield('input-manufactured-date')
                        <div class="input-help manuf-date-help hidden">
                            <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <p><i>{{__('ui.manufDateHelp')}}</i></p>
                        </div>
                    </div>
                    <x-server-input-error errorName='manufactured_date' inputName='inputManufacturedDate' errorClass='error'/>
                    <div class="manufactured_date error error-dz hidden"></div>
                </div>
    
                <div id="part_number">
                    <h3 class="elementHeading">{{__('ui.choosePartNumber')}}</h3>
                    <div class="input-field">
                        @yield('input-part-number')
                        <div class="input-help part-num-help hidden">
                            <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <p><i>{{__('ui.partNumHelp')}}</i></p>
                        </div>
                    </div>
                    <x-server-input-error errorName='part_number' inputName='inputPartNumber' errorClass='error'/>
                    <div class="part_number error error-dz hidden"></div>
                </div>
    
                <div id="costField">
                    <h3 class="elementHeading">{{__('ui.cost')}}</h3>
                    <div class="input-field">
                        @yield('input-cost')
                        <div class="input-help cost-help hidden">
                            <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <p><i>{{__('ui.costHelp')}}</i></p>
                        </div>
                    </div>
                    <x-server-input-error errorName='cost' inputName='inputCost' errorClass='error'/>
                    <div class="cost error error-dz hidden"></div>
                </div>
            </div>

            <div id="desc" class="element">
                <h3 class="elementHeading">{{__('ui.description')}}<span class="required-input">*</span></h3>
                <div class="input-field">
                    @yield('input-description')
                    <div class="input-help desc-help hidden">
                        <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                        <p><i>{{__('ui.descriptionEqHelp')}}</i></p>
                    </div>
                </div>
                <x-server-input-error errorName='description' inputName='inputDesc' errorClass='error'/>
                <div class="description error error-dz hidden"></div>
                <div class="desc-translations">
                    <p class="translations-header">{{__('ui.autoTranslateHeader')}} <a class="auto-translator-link" href="{{loc_url(route('faq'))}}#autoTranslator">{{__('ui.autoTranslate')}}</a></p>
                    
                    <div class="translations-help">
                        <img id="helpImg" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        <p>{{__('ui.translationHelp')}}</p>
                    </div>

                    <div class="{{ App::isLocale('uk') ? 'hidden' : '' }}">
                        <label class="cb-container" for="descTranslateUk">{{__('ui.AutoTranslateToUk')}}
                            @if ( old('desc_translate') && !array_key_exists('uk', old('desc_translate')) )
                                <input id="descTranslateUk" type="checkbox" name="desc_translate[uk]" value="1">
                            @else
                                @yield('checkbox-description-uk')
                            @endif
                            <span class="cb-checkmark"></span>
                        </label>
                        @yield('field-description-uk')
                            <x-server-input-error errorName='description_uk' inputName='inputDescUk' errorClass='error'/>
                            <div class="description_uk error error-dz hidden"></div>
                        </div>
                    </div>

                    <div class="{{ App::isLocale('ru') ? 'hidden' : '' }}">
                        <label class="cb-container" for="descTranslateRu">{{__('ui.AutoTranslateToRu')}}
                            @if ( old('desc_translate') && !array_key_exists('ru', old('desc_translate')) )
                                <input id="descTranslateRu" type="checkbox" name="desc_translate[ru]" value="1">
                            @else
                                @yield('checkbox-description-ru')
                            @endif
                            <span class="cb-checkmark"></span>
                        </label>
                        @yield('field-description-ru')
                            <x-server-input-error errorName='description_ru' inputName='inputDescRu' errorClass='error'/>
                            <div class="description_ru error error-dz hidden"></div>
                        </div>
                    </div>
                    
                    <div class="{{ App::isLocale('en') ? 'hidden' : '' }}">
                        <label class="cb-container" for="descTranslateEn">{{__('ui.AutoTranslateToEn')}}
                            @if ( old('desc_translate') && !array_key_exists('en', old('desc_translate')) )
                                <input id="descTranslateEn" type="checkbox" name="desc_translate[en]" value="1">
                            @else
                                @yield('checkbox-description-en')
                            @endif
                            <span class="cb-checkmark"></span>
                        </label>
                        @yield('field-description-en')
                            <x-server-input-error errorName='description_en' inputName='inputDescEn' errorClass='error'/>
                            <div class="description_en error error-dz hidden"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="imgs" class="element">
                <h3 class="elementHeading">{{__('ui.image')}}</h3>
                
                <div class="upload-zone">
                    @yield('dz-message')
                </div>

                @yield('images-errors')

                <div class="help">
                    <p><i>{{__('ui.imageHelp')}}</i></p>
                </div>
            </div>
            
            <div id="contact" class="element">
                <h2 class="sub-header">{{__('ui.contactInfo')}}</h2>
                <div id="regionField">
                    <h3 class="elementHeading">{{__('ui.locationRegion')}}</h3>
                    <div class="def-select-wraper">
                        @yield('input-region')
                        <span class="arrow arrowDown"></span>
                    </div>
                    <x-server-input-error errorName='region_encoded' inputName='inputregion' errorClass='error'/>
                    <div class="region_encoded error error-dz hidden"></div>
                </div>

                @yield('input-town')

                <div id="emailField">
                    <h3 class="elementHeading">{{__('ui.email')}}<span class="required-input">*</span></h3>
                    @yield('input-email')
                    <x-server-input-error errorName='user_email' inputName='inputEmail' errorClass='error'/>
                    <div class="user_email error error-dz hidden"></div>
                </div>
                
                <div id="phoneField">
                    <h3 class="elementHeading" id="phoneHeader">{{__('ui.phone')}}<span class="required-input">*</span></h3>
                    <div class="phone-wraper">
                        <div class="phone-prefix">
                            <img class="country-flag" src="{{asset('icons/ukraineIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <span class="country-code">+38</span>
                        </div>
                        <div class="input-field">
                            @yield('input-phone')
                            <div class="input-help phone-help hidden">
                                <img src="{{asset('icons/rightArrowOrangeIcon.svg')}}" alt="{{__('alt.keyword')}}">
                                <p><i>{{__('ui.phoneHelp')}}</i></p>
                            </div>
                        </div>
                    </div>
                    <x-server-input-error errorName='user_phone_raw' inputName='inputPhone' errorClass='error'/>
                    <div class="user_phone_raw error error-man hidden">
                        <p>{{__('validation.phoneLength')}}</p>
                    </div>
                    <div class="user_phone_raw error error-dz hidden"></div>
                    <div class="mediaCheckBoxes">
                        <div>
                            @yield('input-viber')
                            <label for="viberInput">
                                Viber
                                <img class="messengers-image" src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                        <div>
                            @yield('input-telegram')
                            <label for="telegramInput">
                                Telegram
                                <img class="messengers-image" src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                        <div>
                            @yield('input-whatsapp')
                            <label for="whatsappInput">
                                WhatsApp
                                <img class="messengers-image" src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="help">
                    <p><i>{{__('ui.contactHelp')}}</i></p>
                </div>
            </div>

            <div id="btns" class="element">
                <button class="def-button submit-button" id="form-submit">{{__('ui.save')}}</button>
                @yield('buttons')
            </div>
            
        </form>
        @yield('modals')
    </div> 
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mousewheel.min.js') }}"></script>
    @yield('post-scripts')
    <script type="text/javascript">
        $(document).ready(function() {            

            var titleValidationRules = {
                required: true,
                minlength: 10,
                maxlength: 70
            };

            var descValidationRules = {
                required: true,
                minlength: 10,
                maxlength: 9000
            };

            //show phone help when active input
            $("#inputPhone").focusin(function(){
                $('div.phone-help').removeClass('hidden');
            });
            
            //hide phone date help when active input
            $("#inputPhone").focusout(function(){
                $('div.phone-help').addClass('hidden');
            });

            //show cost help when active input
            $("#inputCost").focusin(function(){
                $('div.cost-help').removeClass('hidden');
            });
            
            //hide cost date help when active input
            $("#inputCost").focusout(function(){
                $('div.cost-help').addClass('hidden');
            });

            //show part number help when active input
            $("#inputPartNumber").focusin(function(){
                $('div.part-num-help').removeClass('hidden');
            });
            
            //hide part number date help when active input
            $("#inputPartNumber").focusout(function(){
                $('div.part-num-help').addClass('hidden');
            });

            //show manufacture date help when active input
            $("#inputManufacturedDate").focusin(function(){
                $('div.manuf-date-help').removeClass('hidden');
            });
            
            //hide manufacture date help when active input
            $("#inputManufacturedDate").focusout(function(){
                $('div.manuf-date-help').addClass('hidden');
            });

            //show manufacturer help when active input
            $("#inputManufacturer").focusin(function(){
                $('div.manuf-help').removeClass('hidden');
            });
            
            //hide manufacturer help when active input
            $("#inputManufacturer").focusout(function(){
                $('div.manuf-help').addClass('hidden');
            });

            //show description help when active input
            $("#inputDesc, #inputDescUk, #inputDescRu, #inputDescEn").focusin(function(){
                $('div.desc-help').removeClass('hidden');
            });
            
            //hide description help when active input
            $("#inputDesc, #inputDescUk, #inputDescRu, #inputDescEn").focusout(function(){
                $('div.desc-help').addClass('hidden');
            });

            //show title help when active input
            $("#inputTitle, #inputTitleUk, #inputTitleRu, #inputTitleEn").focusin(function(){
                $('div.title-help').removeClass('hidden');
            });
            
            //hide title help when active input
            $("#inputTitle, #inputTitleUk, #inputTitleRu, #inputTitleEn").focusout(function(){
                $('div.title-help').addClass('hidden');
            });

            // show translation input for title Uk
            $('#titleTranslateUk').change(function(){
                if ( $(this).is(':checked') ) {
                    $('div.field-title-uk').addClass('hidden');
                    $('#inputTitleUk').rules('remove');
                } else {
                    $('div.field-title-uk').removeClass('hidden');
                    $('#inputTitleUk').rules('add', titleValidationRules);
                }
            });

            // show translation input for title Ru
            $('#titleTranslateRu').change(function(){
                if ( $(this).is(':checked') ) {
                    $('div.field-title-ru').addClass('hidden')
                    $('#inputTitleRu').rules('remove');
                } else {
                    $('div.field-title-ru').removeClass('hidden')
                    $('#inputTitleRu').rules('add', titleValidationRules);
                }
            });

            // show translation input for title En
            $('#titleTranslateEn').change(function(){
                if ( $(this).is(':checked') ) {
                    $('div.field-title-en').addClass('hidden')
                    $('#inputTitleEn').rules('remove');
                } else {
                    $('div.field-title-en').removeClass('hidden')
                    $('#inputTitleEn').rules('add', titleValidationRules);
                }
            });
         
            // show translation input for Desc Uk
            $('#descTranslateUk').change(function(){
                if ( $(this).is(':checked') ) {
                    $('div.field-description-uk').addClass('hidden')
                    $('#inputDescUk').rules('remove');
                } else {
                    $('div.field-description-uk').removeClass('hidden')
                    $('#inputDescUk').rules('add', descValidationRules);
                }
            });

            // show translation input for Desc Ru
            $('#descTranslateRu').change(function(){
                if ( $(this).is(':checked') ) {
                    $('div.field-description-ru').addClass('hidden')
                    $('#inputDescRu').rules('remove');
                } else {
                    $('div.field-description-ru').removeClass('hidden')
                    $('#inputDescRu').rules('add', descValidationRules);
                }
            });

            // show translation input for Desc En
            $('#descTranslateEn').change(function(){
                if ( $(this).is(':checked') ) {
                    $('div.field-description-en').addClass('hidden')
                    $('#inputDescEn').rules('remove');
                } else {
                    $('div.field-description-en').removeClass('hidden')
                    $('#inputDescEn').rules('add', descValidationRules);
                }
            });

            // if user chooses business post, show fild for company name
            $('input[name=role]').change(function(){
                if ( $('input[name=role]:checked').val() == 2 ) {
                    //show Company fild
                    $('#company').removeClass('hidden');
                } else {
                    //hide Company field
                    $('#company').addClass('hidden');
                }
            });

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

            // formate phone field
            $('.format-phone').focusin(function(){
                var newVal = phoneFormater( $(this).val(), false );
                $(this).val(newVal);
            });

            // formate phone field
            $('.format-phone').focusout(function(){
                var newVal = phoneFormater( $(this).val(), false );
                var newVal = phoneFormater( newVal, true );
                $(this).val(newVal);
            });

            // formate phone field helper
            function phoneFormater(phone, mode) {
                if (phone) {
                    if (mode) {
                        for (let i = phone.length-1; i >= 0; i--) {
                            if (i==1) {
                                phone = phone.slice(0, i) + ' (' + phone.slice(i);
                            } else if (i==3) {
                                phone = phone.slice(0, i) + ') ' + phone.slice(i);
                            }
                            else if (i==8 || i==6) {
                                phone = phone.slice(0, i) + ' ' + phone.slice(i);
                            }
                        }
                        return phone;
                    } else {
                        return phone.replace(/[^0-9]+/g,"").substring(0,10);
                    }
                }
            };

            // show town-input field if region has any value
            $('.region-select').on('change', function(){
                val = $(this).children('option:selected').val();
                if (val==0) {
                    $('#townField').addClass('hidden');
                    $('#inputTown').val('');
                } else {
                    $('#townField').removeClass('hidden');
                }
            });

            //Validate the form
            // add variable for title and description messages
            $('.post-form').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 10,
                        maxlength: 70
                    },
                    company: {
                        minlength: 5,
                        maxlength: 200
                    },
                    manufacturer: {
                        minlength: 5,
                        maxlength: 70
                    },
                    manufactured_date: {
                        minlength: 5,
                        maxlength: 70
                    },
                    part_number: {
                        minlength: 3,
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
                    town: {
                        maxlength: 100
                    },
                    user_email: {
                        email: true,
                        maxlength: 254
                    },
                    user_phone_raw: {
                        minlength: 16,
                        maxlength: 16
                    }
                },
                messages: {
                    title: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    title_uk: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    title_ru: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    title_en: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    company: {
                        minlength: '{{ __("validation.min.string", ["min" => 5]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 200]) }}'
                    },
                    manufacturer: {
                        minlength: '{{ __("validation.min.string", ["min" => 5]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    manufactured_date: {
                        minlength: '{{ __("validation.min.string", ["min" => 5]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    part_number: {
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    description: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9000]) }}'
                    },
                    description_uk: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9000]) }}'
                    },
                    description_ru: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9000]) }}'
                    },
                    description_en: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9000]) }}'
                    },
                    cost: {
                        maxlength: '{{ __("validation.max.string", ["max" => 50]) }}'
                    },
                    town: {
                        maxlength: '{{ __("validation.max.string", ["max" => 100]) }}'
                    },
                    user_email: {
                        email: '{{ __("validation.email") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 254]) }}'
                    },
                    user_phone_raw: {
                        minlength: '{{ __("validation.phoneLength") }}',
                        maxlength: '{{ __("validation.phoneLength") }}'
                    }
                },
                invalidHandler: function(event, validator) {
                    $("#form-submit").removeClass('loading');
                }
            });

            $(".input-cost").focusin(function(){
                newVal = $(this).val()
                    ? CurrencyToNumber($(this).val())
                    : '';
                $(this).val(newVal);
            });

            $(".input-cost").focusout(function(){
                if ($(this).val()){
                    var currency = $('#inputCurrency').children('option:selected').val();
                    $(this).val( NumberToCurrency( currency, $(this).val() ) );
                }
            });

            $('#inputCurrency').on('change', function (e){
                oldVal = $(".input-cost").val();
                if (oldVal) {
                    currency = $(this).children('option:selected').val();
                    currency = currency=='UAH' ? '₴' : '$';
                    newVal = oldVal.replace(oldVal[0], currency);
                    $(".input-cost").val( newVal );
                }
            });

            function CurrencyToNumber(str){
                return str.replace(/[^0-9.]+/g,"");
            }

            function NumberToCurrency(currency, string) {
                res = CurrencyToNumber(string);
                res = res.replace(/^0*/g, '');
                if (!res || res[0] == '.') {
                    return null;
                }
                if ( res.includes('.') ) {
                    var firstDot = res.indexOf('.');
                    var dots = (res.match(/\./g) || []).length;
                    if ( dots != 1 ) {
                        res = res.replace(/\./g,"");
                        res = res.slice(0, firstDot) + '.' + res.slice(firstDot);
                    }
                    var coins = res.substring(firstDot);
                    if ( coins.length > 3 ) {
                        toCrop = coins.length - 3;
                        res = res.substring(0, res.length-toCrop);
                    } else if ( coins.length < 3 ) {
                        // add coins
                        toAdd = 3-coins.length;
                        res = res+'0';
                        if (toAdd == 2) {
                            res = res+'0';
                        }
                    }
                } else {
                    res = res + ".00";
                }
                for (let i=res.length-4, step=1; i >= 0; i--,step++) {
                    if (step == 4) {
                        res = res.slice(0, i+1) + ',' + res.slice(i+1);
                        step = 1;
                    }
                    
                }
                currency=='UAH' ? res='₴'+res : res='$'+res;
                return res;
            }

        });
    </script>

@endsection
