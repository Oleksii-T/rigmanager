@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post_create_edit.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/dropzone.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/tags.css')}}" />
@endsection

@section('content')
    <div id="editItemBody">
        @yield('page-title')

        @yield('form')

            <input type="text" name="thread" value="1" hidden>

            <div id="title" class="element">
                <h3 class="elementHeading" for="inputTitle">{{__('ui.title')}}<span class="required-input">*</span></h3>
                @yield('input-title')
                <x-server-input-error errorName='title' inputName='inputTitle' errorClass='error'/>
                <div class="title error error-dz hidden"></div>
                <div class="help">
                    <p><i>{{__('ui.titleHelp')}}</i></p>
                </div>
            </div>

            @yield('input-status')

            <div id="type" class="element">
                <h3 class="elementHeading">{{__('ui.choosePostType')}}</h3>
                @yield('input-type')
            </div>

            <div id="role" class="element">
                <h3 class="elementHeading">{{__('ui.choosePostRole')}}</h3>
                @yield('input-role')
            </div>

            <div id="condition" class="element">
                <h3 class="elementHeading">{{__('ui.chooseCondition')}}</h3>
                @yield('input-condition')
            </div>

            <div id="tag" class="element">
                <h3 class="elementHeading">{{__('ui.chooseTag')}}</h3>
                
                <x-equipment-tags btnText="{{__('ui.tags')}}"/>

                @yield('inputs-tag')

                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div id="desc" class="element">
                <h3 class="elementHeading" for="inputDecs">{{__('ui.description')}}<span class="required-input">*</span></h3>
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
                    <div class="def-select-wraper">
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
                    <h3 class="elementHeading" for="inputEmail">{{__('ui.email')}}<span class="required-input">*</span></h3>
                    @yield('input-email')
                    <x-server-input-error errorName='user_email' inputName='inputEmail' errorClass='error'/>
                    <div class="user_email error error-dz hidden"></div>
                </div>
                
                <div id="phoneField">
                    <h3 class="elementHeading" id="phoneHeader" for="inputPhone">{{__('ui.phone')}}<span class="required-input">*</span></h3>
                    <div class="phone-wraper">
                        <div class="phone-prefix">
                            <img class="country-flag" src="{{asset('icons/ukraineIcon.svg')}}" alt="{{__('alt.keyword')}}">
                            <span class="country-code">+38</span>
                        </div>
                        @yield('input-phone')
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
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    @yield('post-scripts')
    <script type="text/javascript">
        $(document).ready(function() {            

            $('button.equipment-tags-show').click(function(){
                $('div.modal-view').removeClass('hidden');
                $('body').addClass('noscroll');
            });

            //close modal if clicked beyong the modal
            window.onclick = function(event) {
                var modal = document.getElementById("equipment-tags-modal");
                if (event.target == modal) {
                    $('#equipment-tags-modal').addClass('hidden');
                    $('body').removeClass('noscroll');
                }
            }

            $('p.tag.first').click(function(){
                $('p.tag').removeClass('isActiveBtn');
                $('div.tags.second').addClass('hidden');
                $('div.tags.third').addClass('hidden');
                $(this).addClass('isActiveBtn')
                var id = $(this).attr('id');
                $('div.tags_'+id).removeClass('hidden');
            });

            $('p.tag.second').click(function(){
                $('p.tag.second').removeClass('isActiveBtn');
                $('p.tag.third').removeClass('isActiveBtn');
                $('div.tags.third').addClass('hidden');
                $(this).addClass('isActiveBtn');
                var id = $(this).attr('id');
                id = id.replace('.', '\\.');
                $('div.tags_'+id).removeClass('hidden');
            });

            $('p.tag.third').click(function(){
                console.log ('you have chosed: ' + $(this).attr('id'));
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
            $('.post-form').validate({
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
