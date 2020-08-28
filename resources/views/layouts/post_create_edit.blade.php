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
                @yield('inputs-tag')

                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div id="desc" class="element">
                <h3 class="elementHeading" for="inputDecs">{{__('ui.description')}}</h3>
                @yield('input-description')
                <x-server-input-error errorName='description' inputName='inputDecs' errorClass='error'/>
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
                    <h3 class="elementHeading" for="inputCost">{{__('ui.cost')}}</h3>
                    @yield('input-cost')
                    <x-server-input-error errorName='cost' inputName='inputCost' errorClass='error'/>
                </div>

                <div id="provinceField">
                    <h3 class="elementHeading" for="inputProvince">{{__('ui.locationProvince')}}</h3>
                    <div class="autocomplete autocomplete-province">
                        @yield('input-province')
                    </div>
                    <x-server-input-error errorName='province' inputName='inputProvince' errorClass='error'/>
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
                    <x-server-input-error errorName='user_phone' inputName='inputPhone' errorClass='error'/>
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

            function autocomplete(inp, arr) {
                /*the autocomplete function takes two arguments,
                the text field element and an array of possible autocompleted values:*/
                var currentFocus;
                /*execute a function when someone writes in the text field:*/
                inp.addEventListener("input", function(e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) { return false;}
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                        }
                    }
                });
                /*execute a function presses a key on the keyboard:*/
                inp.addEventListener("keydown", function(e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                        /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                        currentFocus++;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 38) { //up
                        /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                        currentFocus--;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 13) {
                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                        e.preventDefault();
                        if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                        }
                    }
                });
                function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
                }
                function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                    }
                }
                function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                    }
                }
                }
                /*execute a function when someone clicks in the document:*/
                document.addEventListener("click", function (e) {
                    closeAllLists(e.target);
                });
            }

            var provinces = ["Одеська область","Дніпропетровська область","Чернігівська область","Харківська область","Житомирська область","Полтавська область","Херсонська область","Київська область","Запорізька область","Луганська область","Донецька область","Вінницька область","Автономна Республіка Крим","Миколаївська область","Кіровоградська область", "Сумська область","Львівська область","Черкаська область","Хмельницька область","Волинська область","Рівненська область","Івано-Франківська область","Тернопільська область","Закарпатська область","Чернівецька область"];
            
            autocomplete( document.getElementById("inputProvince"), provinces );

            // formate phone field
            $('#inputPhone').focusin(function(){
                var newVal = phoneFormater( $(this).val(), false );
                $(this).val(newVal);
            });

            // formate phone field
            $('#inputPhone').focusout(function(){
                var newVal = phoneFormater( $(this).val(), false );
                var newVal = phoneFormater( newVal, true );
                $(this).val(newVal);
            });

            function phoneFormater(phone, mode) {
                if (phone) {
                    if (mode) {
                        phone = '('+phone;
                        for (let i = 0; i < phone.length; i++) {
                            if (i==4) {
                                phone = phone.slice(0, i) + ') ' + phone.slice(i);
                                i+=2;
                            }
                            else if (i==8 || i==11) {
                                phone = phone.slice(0, i) + '-' + phone.slice(i);
                                i++;
                            }
                        }
                        return phone;
                    } else {
                        return phone.replace(/[^0-9]+/g,"");
                    }
                }
            };

            // show town-input field if province has any value
            $('#inputProvince').on('keyup change', function(){
                if ($(this).val() == '') {
                    $('#townField').addClass('hidden');
                    $('#inputTown').val('');
                } else {
                    $('#townField').removeClass('hidden');
                }
            });

            // open/close tags when user choosed master tag category
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
                    location: {
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
                    location: {
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
                    ? localStringToNumber($(this).val())
                    : '';
                $(this).val(newVal);
            });

            $(".input-cost").focusout(function(){
                currency = $('#inputCurrency').children('option:selected').val();
                var options = {
                    maximumFractionDigits : 2,
                    currency              : currency,
                    style                 : "currency",
                    currencyDisplay       : "symbol"
                }
                newVal = $(this).val()
                    ? localStringToNumber($(this).val()).toLocaleString(undefined, options)
                    : '';
                if (currency == "UAH") {
                    newVal = newVal.replace('UAH', '₴');
                }
                $(this).val(newVal);
            });

            $('#inputCurrency').on('change', function (e){
                oldVal = localStringToNumber( $(".input-cost").val() );
                if (oldVal) {
                    currency = $(this).children('option:selected').val();
                    var options = {
                        maximumFractionDigits : 2,
                        currency              : currency,
                        style                 : "currency",
                        currencyDisplay       : "symbol"
                    }
                    newVal = oldVal.toLocaleString(undefined, options);
                    if (currency == "UAH") {
                        newVal = newVal.replace('UAH', '₴');
                    }
                    $(".input-cost").val(newVal);
                }
            });

            function localStringToNumber( s ){
                return Number(String(s).replace(/[^0-9.]+/g,""))
            }

        });
    </script>

@endsection
