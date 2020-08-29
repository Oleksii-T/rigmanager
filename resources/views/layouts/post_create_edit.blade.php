@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post_create_edit.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/dropzone.css')}}" />
@endsection

@section('content')
    <div id="editItemBody">
        @yield('page-title')

        @yield('form')

            <div id="title" class="element">
                <h3 class="elementHeading" for="inputTitle">{{__('ui.title')}}</h3>
                @yield('input-title')
                <x-server-input-error errorName='title' inputName='inputTitle' errorClass='error'/>
                <div class="title error error-dz hidden"></div>
                <div class="help">
                    <p><i>{{__('ui.titleHelp')}}</i></p>
                </div>
            </div>

            <div id="condition" class="element">
                <h3 class="elementHeading" for="inputCondition">{{__('ui.chooseCondition')}}</h3>
                @yield('input-condition')
            </div>

            <div id="tag" class="element">
                <h3 class="elementHeading">{{__('ui.tag')}}</h3>
                
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
                    <div class="typeOfEq hidden" id="hseEq">
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

                    <div class="typeOfEq hidden" id="drillingEq">
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
        
                    <div class="typeOfEq hidden" id="repairEq">
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
                    
                    <div class="typeOfEq hidden" id="productionEq">
                        <ul id="mainMenu">
                            <x-tags.production.tubing/> 
                            <x-tags.production.well-head/>
                            <x-tags.production.x-mass-tree/> 
                            <li><a href="#" id="4.0">{{__('tags.other')}}</a></li> 
                        </ul>
                    </div>
        
                    <div class="typeOfEq hidden" id="loggingEq">
                        <ul id="mainMenu">
                            <x-tags.logging.sensors/>
                            <x-tags.logging.eq/>
                            <li><a href="#" id="5.0">{{__('tags.other')}}</a></li> 
                        </ul>
                    </div>

                </div>

                <!--Hidden field for encoded tag for DB-->
                @yield('inputs-tag')

                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div id="desc" class="element">
                <h3 class="elementHeading" for="inputDecs">{{__('ui.description')}}</h3>
                @yield('input-description')
                <x-server-input-error errorName='description' inputName='inputDecs' errorClass='error'/>
                <div class="description error error-dz hidden"></div>
                <div class="help">
                    <p><i>{{__('ui.descriptionHelp')}}</i></p>
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

            <div id="miscInfo" class="element">
                <div id="costField">
                    <h3 class="elementHeading">{{__('ui.cost')}}</h3>
                    @yield('input-cost')
                    <x-server-input-error errorName='cost' inputName='inputCost' errorClass='error'/>
                    <div class="cost error error-dz hidden"></div>
                </div>

                <div id="regionField">
                    <h3 class="elementHeading">{{__('ui.locationRegion')}}</h3>
                    <div class="region-wraper">
                        @yield('input-region')
                        <span class="arrow arrowDown"></span>
                    </div>
                    <x-server-input-error errorName='region_encoded' inputName='inputregion' errorClass='error'/>
                    <div class="region_encoded error error-dz hidden"></div>
                </div>

                @yield('input-town')

                <div class="help">
                    <p><i>{{__('ui.costLocationHelp')}}</i></p>
                </div>
            </div>
            
            <div id="contact" class="element">
                <div id="emailField">
                    <h3 class="elementHeading" for="inputEmail">{{__('ui.email')}}</h3>
                    @yield('input-email')
                    <x-server-input-error errorName='user_email' inputName='inputEmail' errorClass='error'/>
                    <div class="user_email error error-dz hidden"></div>
                </div>

                <div id="phoneField">
                    <h3 class="elementHeading" id="phoneHeader" for="inputPhone">{{__('ui.phone')}}</h3>
                    <div class="phone-wraper">
                        <div class="phone-prefix">
                            <img class="country-flag" src="{{asset('icons/ukraineIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <span class="country-code">+38</span>
                        </div>
                        @yield('input-phone')
                    </div>
                    <x-server-input-error errorName='user_phone_raw' inputName='inputPhone' errorClass='error'/>
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
                    <p><i>{{__('ui.emailPhoneHelp')}}</i></p>
                </div>
            </div>

            <div id="btns" class="element">
                <button class="def-button submit-button" id="form-submit">{{__('ui.save')}}</button>
                <a class="def-button cancel-button" href="{{ route('home') }}">{{__('ui.cancel')}}</a>
                @yield('buttons')
            </div>
            
        </form>
        @yield('modals')
    </div> 
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/myValidators.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dropzone.min.js') }}"></script>
    @yield('post-scripts')
    <script type="text/javascript">
        $(document).ready(function() {            

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
                        return phone.replace(/[^0-9]+/g,"");
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

            // open/close tags when user choosed master tag category
            $('.tagsTrigger').click(function(){
                var type = $(this).attr('class').split(' ')[1];
                _this = $(this);
                if ( _this.hasClass('isActiveBtn') ) {
                    _this.removeClass('isActiveBtn');
                    $('#'+type).addClass('hidden')
                } else {
                    $('.typeOfEq').addClass('hidden');
                    $('.tagsTrigger').removeClass('isActiveBtn');
                    _this.addClass('isActiveBtn');
                    $('#'+type).removeClass('hidden')
                }
            });

            //action when user chose tag
            $('#dropDown a').click(function($e){
                $e.preventDefault();
                // show delete tags btm
                $('#clearTagsBtn').removeClass('hidden');
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

            //clean chosen catorories
            $('#clearTagsBtn').click(function(){
                //write encoded tag to hidden input for DB
                $('#tagEncodedHidden').attr("value",'0');
                //write readble tag to hidden input for old() feature
                $('#tagReadbleHidden').attr("value","{{__('tags.other')}}");
                //write readble tag to visible field for user
                $('#tagReadbleVisible').text("{{__('tags.other')}}");
                // hide this btn
                $(this).addClass('hidden');
            });

            //Validate the form
            $('.post-formm').validate({
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
                    town: {
                        maxlength: 100
                    },
                    user_email: {
                        email: true,
                        maxlength: 254
                    },
                    user_phone_raw: {
                        minlength: 15,
                        maxlength: 15
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
                var step = 1;
                for (let i = res.length-4; i >= 0; i--,step++) {
                    if (step == 3) {
                        res = res.slice(0, i) + ',' + res.slice(i);
                        step = 0;
                    }
                    
                }
                currency=='UAH' ? res='₴'+res : res='$'+res;
                return res;
            }

        });
    </script>

@endsection
