@extends('layouts.app')
    <link rel="stylesheet" href="{{asset('css/item_create_edit.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/components/popUpAndFlash.css') }}" />
@section('styles')

@endsection

@section('content')
    <div id="editItemBody">
        <p id="pageTitle">{{__('ui.postSettings')}}</p>

        <form method="POST" id="formUpdateItem" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div id="title" class="element">
                <label class="elementHeading" for="inputTitle">{{__('ui.title')}}</label><br>
                <input id="inputTitle" name="title" placeholder="{{__('ui.title')}}" value="{{ old('title') ?? $post->title }}"/>
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
                <input id="tagEncodedHidden" type="text" name="tag" value="{{ old('tag') ?? $post->tag }}" hidden/>
                
                <!--Hidden and visible fields for readable tag-->
                <input id="tagReadbleHidden" type="text" name="tagReadbleHidden" value="{{ old('tagReadbleHidden') ?? $tagReadble }}" hidden/>
                <p id="choosenTags">{{__('ui.chosenTags')}}: <span id="tagReadbleVisible">{{ old('tagReadbleHidden') ?? $tagReadble }}</span></p>
                
                <button type="button" id="clearTagsBtn">{{__('ui.clearTagsFromPost')}}</button>

                <div class="help">
                    <p><i>{{__('ui.tagHelp')}}</i></p>
                </div>

            </div>

            <div id="desc" class="element">
                <label class="elementHeading" for="inputDecs">{{__('ui.description')}}</label><br>
                <textarea name="description" id="inputDecs" form="formUpdateItem" rows="15" maxlength="9000">{{ old('description') ?? $post->description }}</textarea>
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
                    <input type="file" id="inputImg" name="images[]" style="display: none;" multiple />
                </div>

                @error('images.*')
                    <div class="error">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                @if (Session::has('tooManyImagesError'))
                    <div class="error">
                        <p>{{ Session::get('tooManyImagesError') }}</p>
                    </div>
                @endif
                
                
                <div class="gallery">
                    @if ( $post->images->isNotEmpty() )
                        <p id="previewText">{{__('ui.preview')}}:</p>
                        @foreach ($post->images->where('version', 'optimized') as $image)
                            <div class="previewImg">
                                <img src="{{ $image->url }}" alt="{{__('alt.keyword')}}">
                            </div>
                        @endforeach
                    @endif
                </div>

                @if ( $post->images->isNotEmpty() )
                    <button type="button" id="modalImgsDeleteOn">{{__('ui.deleteAllImgs')}}</button>
                @endif

                <div class="help">
                    <p><i>{{__('ui.imageHelp')}}</i></p>
                </div>
            </div>

            <div id="miscInfo" class="element">
                <div>
                    <label class="elementHeading" for="inputCost">{{__('ui.cost')}}</label><br>
                    <input id="inputCost" name="cost" type="text" placeholder="{{__('ui.cost')}}" value="{{ old('cost') ?? $post->cost }}"/>
                    <x-server-input-error errorName='cost' inputName='inputCost' errorClass='error'/>
                </div>

                <div>
                    <label class="elementHeading" for="inputTitle">{{__('ui.location')}}</label><br>
                    <input id="inputLocation" name="location" type="text" placeholder="{{__('ui.location')}}" value="{{ old('location') ?? $post->location }}"/>
                    <x-server-input-error errorName='location' inputName='inputLocation' errorClass='error'/>
                </div>

                <div class="help">
                    <p id="h"><i>{{__('ui.costLocationHelp')}}</i></p>
                </div>
            </div>
            
            <div id="contact" class="element">
                <div id="emailField">
                    <label class="elementHeading" for="inputEmail">{{__('ui.email')}}</label><br>
                    <input id="inputEmail" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{ old('user_email') ?? $post->user_email }}">
                    <x-server-input-error errorName='user_email' inputName='inputEmail' errorClass='error'/>
                </div>

                <div id="phoneField">
                    <label class="elementHeading" id="phoneHeader" for="inputPhone">{{__('ui.phone')}}</label><br>
                    <input id="inputPhone" name="user_phone" type="text" placeholder="{{__('ui.phone')}}" value="{{ old('user_phone') ?? $post->user_phone }}">
                    <x-server-input-error errorName='user_phone' inputName='inputPhone' errorClass='error'/>
                    <div class="mediaCheckBoxes">
                        <div>
                            <input type="checkbox" id="viberInput" name="viber" value="1" {{ $post->viber ? 'checked' : '' }}>
                            <label for="viberInput">
                                Viber
                                <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="telegramInput" name="telegram" value="1" {{ $post->telegram ? 'checked' : '' }}>
                            <label for="telegramInput">
                                Telegram
                                <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="whatsappInput" name="whatsapp" value="1" {{ $post->whatsapp ? 'checked' : '' }}>
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
                <a href="{{ route('posts.show', $post->id) }}">{{__('ui.cancel')}}</a>
                <button type="button" id="modalPostDeleteOn">{{__('ui.deletePost')}}</button>
            </div>
        </form>

        <div class="modalView animate" id="modalImgsDelete">
            <div class="modalContent"> 
                <p>{{__('ui.sure?')}}</p>
                <div>
                    <button type="button" id="modalImgsDeleteOff">{{__('ui.no')}}</button>
                    <form method="POST" action="{{ route('posts.imgs.delete', $post->id) }}">
                        @csrf
                        @method('PATCH')
                        <button>{{__('ui.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modalView animate" id="modalPostDelete">
            <div class="modalContent"> 
                <p>{{__('ui.sure?')}}</p>
                <div>
                    <button type="button" id="modalPostDeleteOff">{{__('ui.no')}}</button>
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button>{{__('ui.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{asset('js/myValidators.js')}}"></script> 
    <script src={{ asset('js/popUpAndFlash.js') }}></script>

    <script type="text/javascript">

        $(document).ready(function() {

            //add active effect in nav bar
            $('#myItemsTab').addClass('isActiveBtn');

            //print choosen tag to user
            var tag_ = $('#hiddenTag').attr('value');
            $('#TagChoosen').text(tag_);

            //static generator of unique ids for gallery`s div
            function Generator() {};
            Generator.prototype.rand = 1;
            Generator.prototype.getId = function() {return this.rand++; };
            var idGen =new Generator();

            //clean chosen catorories
            $('#clearTagsBtn').click(function(){
                //write encoded tag to hidden input for DB
                $('#tagEncodedHidden').attr("value",'0');
                //write readble tag to hidden input for old() feature
                $('#tagReadbleHidden').attr("value","{{__('tags.other')}}");
                //write readble tag to visible field for user
                $('#tagReadbleVisible').text("{{__('tags.other')}}");
            });

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
                //make cursor wait
                $('#dropDown a').addClass('loading');
                $(document.body).css('cursor', 'wait');
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
                        $(document.body).css('cursor', 'default');
                        $('#dropDown a').removeClass('loading'); 
                    },
                    error: function() {
                        //print error massage and remove wait cursor
                        popUpMassage("{{ __('messages.error') }}");
                        $(document.body).css('cursor', 'default');
                        $('#dropDown a').removeClass('loading'); 
                    }
                });
            });

            //make pop up massage from text
            function popUpMassage (text) {
                var uniqueId = "num" + idGen.getId();
                $('#container').append('<div class="popUp" id="'+uniqueId+'"><p>'+text+'</p></div>');
                $('#'+uniqueId).addClass('popUpShow');
                $('#'+uniqueId).click(function(){ $(this).removeClass('popUpShow') });
                setTimeout(function(){
                    $('#'+uniqueId).removeClass('popUpShow');
                }, 3000);
            }

            //open modal delete confirm when user ask to
            $('#modalPostDeleteOn').click(function(){
                $('#modalPostDelete').css("display", "block");
            });

            //close delete confirmation
            $('#modalPostDeleteOff').click(function(){
                $('#modalPostDelete').css("display", "none");
            });

            //open modal delete confirm when user ask to
            $('#modalImgsDeleteOn').click(function(){
                $('#modalImgsDelete').css("display", "block");
            });

            //close delete confirmation
            $('#modalImgsDeleteOff').click(function(){
                $('#modalImgsDelete').css("display", "none");
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var modal = document.getElementById("modalImgsDelete");
                if (event.target == modal) {
                    $('#modalImgsDelete').css("display", "none");
                }
                var modal = document.getElementById("modalPostDelete");
                if (event.target == modal) {
                    $('#modalPostDelete').css("display", "none");
                }
            }

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
                    imagesPreview(this, gallery);
                });
            });
            
            //Validate the form
            $('#formUpdateItem').validate({
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
                        required: 'Минимум 10 символов.',
                        minlength: 'Минимум 10 символов.',
                        maxlength: 'Максимум 70 символов'
                    },
                    description: {
                        required: 'Минимум 10 символов.',
                        minlength: 'Минимум 10 символов.',
                        maxlength: 'Максимум 9000 символов'
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
