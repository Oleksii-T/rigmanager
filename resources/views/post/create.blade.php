@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/itemEdit.css')}}" />
@endsection

@section('content')
    <div id="editItemBody">
        <p id="pageTitle">{{__('ui.postCreate')}}</p>

        <form method="post" id="formNewpost" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div id="title" class="element">
                <div>
                    <label class="elementHeading" for="inputTitle">{{__('ui.title')}}</label><br>
                    <input id="inputTitle" name="title" placeholder="{{__('ui.title')}}" value="{{ old('title') }}"/>
                </div>
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
                
                <input id="hiddenTag" type="text" name="tag" value="{{ old('tag') ?? 'Другое' }}" hidden/>

                <div id="navTags">
                    <ul>
                        <li><button type="button" class="tagsTrigger drillingEq">{{__('ui.drillingEq')}}</button></li>
                        <li><button type="button" class="tagsTrigger repairEq">{{__('ui.repairEq')}}</button></li>
                        <li><button type="button" class="tagsTrigger productionEq">{{__('ui.productionEq')}}</button></li>
                        <li><button type="button" class="tagsTrigger loggingEq">{{__('ui.loggingEq')}}</button></li>
                    </ul>
                </div>

                <div id="dropDown">

                    <div class="typeOfEq" id="drillingEq">
                        <ul id="mainMenu">
                            <x-tags.drilling.substructure/>
                            <x-tags.drilling.mast/>
                            <x-tags.drilling.logging/> 
                            <x-tags.drilling.bop/> 
                            <x-tags.drilling.emergency/> 
                            <x-tags.drilling.hse/>
                            <x-tags.drilling.power/> 
                            <x-tags.drilling.lifting/> 
                            <x-tags.drilling.rotory/> 
                            <x-tags.drilling.drillString/> 
                            <x-tags.drilling.bha/> 
                            <x-tags.drilling.grouning/> 
                            <x-tags.drilling.mud/>
                            <li><a href="#">{{__('ui.other')}}</a></li>
                        </ul>
                    </div>
        
                    <div class="typeOfEq" id="repairEq">
                        <ul id="mainMenu">
                            <x-tags.repair.substructure/> 
                            <x-tags.repair.logging/> 
                            <x-tags.repair.bop/> 
                            <x-tags.repair.emergency/> 
                            <x-tags.repair.wellHead/>
                            <x-tags.repair.power/>
                            <x-tags.repair.lifting/> 
                            <x-tags.repair.rotory/> 
                            <x-tags.repair.drillString/> 
                            <x-tags.repair.fhf/>
                            <x-tags.repair.collTubing/>
                            <li><a href="#">{{__('ui.other')}}</a></li> 
                        </ul>
                    </div>
                    
                    <div class="typeOfEq" id="productionEq">
                        <ul id="mainMenu">
                            <x-tags.production.tubing/> 
                            <x-tags.production.wellHead/>
                            <x-tags.production.xMassTree/> 
                        </ul>
                    </div>
        
                    <div class="typeOfEq" id="loggingEq">
                        <ul id="mainMenu">
                            <x-tags.logging.sensors/>
                            <x-tags.logging.eq/>
                        </ul>
                    </div>

                </div>

                <p id="choosenTags">{{__('ui.chosenTags')}}: <span id="ChoosedTags">{{ old('tag') ?? __('ui.other')}}</span></p>
                
                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div id="desc" class="element">
                <label class="elementHeading" for="inputDecs">{{__('ui.description')}}</label><br>
                <textarea name="description" id="inputDecs" form="formNewpost" rows="15" maxlength="9000">{{ old('description') }}</textarea>
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

                <div class="gallery">
                    <p>{{__('ui.preview')}}: {{__('ui.empty')}}</p>
                </div>

                <div class="help">
                    <p><i>{{__('ui.imageHelp')}}</i></p>
                </div>
            </div>

            <div id="miscInfo" class="element">
                <div>
                    <label class="elementHeading" for="inputCost">{{__('ui.cost')}}</label><br>
                    <input id="inputCost" name="cost" type="text" placeholder="{{__('ui.cost')}}" value="{{ old('cost') }}"/>
                    <x-server-input-error errorName='cost' inputName='inputCost' errorClass='error'/>
                </div>

                <div id="locationField">
                    <label class="elementHeading" for="inputLocation">{{__('ui.location')}}</label><br>
                    <input id="inputLocation" name="location" type="text" placeholder="{{__('ui.location')}}" value="{{ old('location') }}"/>
                    <x-server-input-error errorName='location' inputName='inputLocation' errorClass='error'/>
                </div>
                
                <div class="help">
                    <p id="h"><i>{{__('ui.costLocationHelp')}}</i></p>
                </div>
            </div>
            
            <div id="contact" class="element">
                <div id="emailField">
                    <label class="elementHeading" for="inputEmail">{{__('ui.email')}}</label><br>
                    <input id="inputEmail" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{ old('user_email') ?? $user->email }}" autocomplete="email">
                    <x-server-input-error errorName='user_email' inputName='inputEmail' errorClass='error'/>
                </div>

                <div id="phoneField">
                    <label class="elementHeading" id="phoneHeader" for="inputPhone">{{__('ui.phone')}}</label><br>
                    <input id="inputPhone" name="user_phone" type="text" placeholder="{{__('ui.phone')}}" value="{{ old('user_phone') ?? $user->phone }}" autocomplete="phone">
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
                <button type="submit">{{__('ui.save')}}</button>
                <a href="{{ route('home') }}">{{__('ui.cancel')}}</a>
            </div>
        </form>
    </div> 
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script> 
    <script src="{{ asset('js/myValidators.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            //add active effect in nav bar
            $('#addItemTab').addClass('isActiveBtn');

            //print choosen tag to user
            var tag_ = $('#hiddenTag').attr('value');
            $('#TagChoosen').text(tag_);

            //static generator of unique ids for gallery`s div
            function Generator() {};
            Generator.prototype.rand = 1;
            Generator.prototype.getId = function() {return this.rand++;};
            var idGen =new Generator();

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
                parent = $(this).parent();
                var allTags = '';
                do {
                    var text = parent.text();
                    var array = text.split('\n')[0];
                    var text = array.split('  ')[0];
                    allTags += text+'>';
                    parent = $(parent).parent();
                    if ( parent.get(0).tagName == 'UL' ) { parent = $(parent).parent(); }
                } while ( parent.get(0).tagName != 'DIV' );
                allTags = allTags.substring(0, allTags.length - 1);
                allTags = allTags.split('>');
                var res = '';
                for ( i=0 ; i<allTags.length ; i++ ) {
                    res += allTags[allTags.length - i - 1] + ", ";
                }
                res = res.substring(0, res.length - 2);
                $('#hiddenTag').attr("value",res); //write result to hidden field
                $('#ChoosedTags').text(res); //write result to user
            });

            //make pre-view gallery whenever user submits files
            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, gallery) {

                    if (input.files) {
                        var filesAmount = input.files.length;

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
            $('#formNewpost').validate({
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
                        required: 'Минимум 10 символов',
                        minlength: 'Минимум 10 символов',
                        maxlength: 'Максимум 70 символов'
                    },
                    description: {
                        required: 'Минимум 10 символов',
                        minlength: 'Минимум 10 символов',
                        maxlength: 'Максимум 255 символов'
                    },
                    cost: {
                        maxlength: 'Максимум 50 символов'
                    },
                    location: {
                        maxlength: 'Максимум 100 символов'
                    },
                    user_email: {
                        email: 'Не верный адрес почты',
                        maxlength: 'Максимум 254 символов'
                    },
                    user_phone: {
                        minlength: 'Минимум 8 символов',
                        maxlength: 'Максимум 20 символов',
                        validPhone: 'Не правильный номер'
                    }
                }
            });
            
        });
    </script>

@endsection
