@extends('layouts.page')

@section('bc')
    @if (isset($post))
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <span itemprop="item"><span itemprop="name"></span></span>
            <a itemprop="item" href="{{loc_url(route('profile.posts'))}}"><span itemprop="name">{{__('ui.myPosts')}}</span></a>
            <meta itemprop="position" content="2" />
        </li>
        <li class="crop-bc-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            @if (!App::isLocale($post->origin_lang) && auth()->user()->is_standart && $post->{'title_'.App::getLocale()})
                <a itemprop="item" href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}"><span itemprop="name">{{ $post->{'title_'.App::getLocale()} }}</span></a>
            @else
                <a itemprop="item" href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}"><span itemprop="name">{{$post->title}}</span></a>
            @endif
            <meta itemprop="position" content="3" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <span itemprop="item"><span itemprop="name">{{__('ui.postSettings')}}</span></span>
            <meta itemprop="position" content="4" />
        </li>
    @else
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <span itemprop="item"><span itemprop="name">{{__('ui.postCreate')}}. {{__('ui.equipment')}}</span></span>
            <meta itemprop="position" content="2" />
        </li>
    @endif
@endsection

@section('content')
    <div class="main-block">
        @if (isset($post))
            <x-profile-nav active='posts'/>
        @else
            <x-post-create-nav active='eq'/>
        @endif
        <div class="content">
            <h1>{{isset($post) ? __('ui.postSettings') : __('ui.postCreate') . '. ' . __('ui.equipment')}}</h1>
            <div class="form-block">
                <span id="post-id-flag" hidden>{{isset($post) ? $post->id : ''}}</span>
                <form id="form-post" method="POST" action="{{isset($post) ? loc_url(route('posts.update', ['post'=>$post->id])) : loc_url(route('posts.store'))}}" enctype="multipart/form-data">
                    @if (isset($post))
                        @method('PATCH')
                    @endif
                    @csrf
                    <input type="text" name="thread" value="1" hidden>
                    <fieldset>
                        <div class="form-section"> <!--title+tag-->
                            <label class="label">{{__('ui.title')}} <span class="orange">*</span></label>
                            <input class="input input-long" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{isset($post) ? (old('title') ?? $post->title) : old('title')}}"/>
                            <x-server-input-error inputName='title'/>

                            <label class="label">{{__('ui.chooseTag')}} <span class="orange">*</span></label>
                            <div class="form-category">
                                <a href="#popup-select-eq-tag" data-fancybox class="form-category-button">{{__('ui.tags')}}</a>
                                <ul class="form-category-list">
                                    @if (isset($post))
                                        <li>{{$post->tag_readable}}</li>
                                    @else
                                        <li>{{__('tags.other')}}</li>
                                    @endif
                                </ul>
                            </div>
                            <input type="text" name="tag_encoded" value="{{isset($post) ? $post->tag_encoded : (old('tag_encoded') ?? 0)}}" hidden/>
                            <div class="form-note">{{__('ui.tagHelp')}}</div>
                        </div>
                        <div class="form-section"> <!--type+role+condition+optionals-->
                            <div class="add-radio">
                                <div class="add-radio-col">
                                    <label class="label">{{__('ui.choosePostType')}} <span class="orange">*</span></label>
                                    <div class="radio-block">
                                        <div class="radio-item">
                                            <input type="radio" name="type" class="radio-input" id="r1" value="1" {{isset($post) ? ($post->type==1 ? 'checked' : '') : 'checked'}}>
                                            <label for="r1" class="radio-label">{{__('ui.postTypeSell')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="type" class="radio-input" id="r2" value="2" {{isset($post) && $post->type==2 ? 'checked' : ''}}>
                                            <label for="r2" class="radio-label">{{__('ui.postTypeBuy')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="type" class="radio-input" id="r3" value="3" {{isset($post) && $post->type==3 ? 'checked' : ''}}>
                                            <label for="r3" class="radio-label">{{__('ui.postTypeRent')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="type" class="radio-input" id="r4" value="4" {{isset($post) && $post->type==4 ? 'checked' : ''}}>
                                            <label for="r4" class="radio-label">{{__('ui.postTypeLeas')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-radio-col">
                                    <label class="label">{{__('ui.choosePostRole')}} <span class="orange">*</span></label>
                                    <div class="radio-block">
                                        <div class="radio-item">
                                            <input type="radio" name="role" class="radio-input" id="r11" value="1" {{isset($post) ? ($post->role==1 ? 'checked' : '') : 'checked'}}>
                                            <label for="r11" class="radio-label">{{__('ui.postRolePrivate')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="role" class="radio-input" id="r12" value="2" {{isset($post) && $post->role==2 ? 'checked' : ''}}>
                                            <label for="r12" class="radio-label">{{__('ui.postRoleBusiness')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-radio-col">
                                    <label class="label">{{__('ui.chooseCondition')}} <span class="orange">*</span></label>
                                    <div class="radio-block">
                                        <div class="radio-item">
                                            <input type="radio" name="condition" class="radio-input" id="r21" value="2" {{isset($post) ? ($post->condition==2 ? 'checked' : '') : 'checked'}}>
                                            <label for="r21" class="radio-label">{{__('ui.conditionNew')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="condition" class="radio-input" id="r22" value="3" {{isset($post) && $post->condition==3 ? 'checked' : ''}}>
                                            <label for="r22" class="radio-label">{{__('ui.conditionSH')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="condition" class="radio-input" id="r23" value="4" {{isset($post) && $post->condition==4 ? 'checked' : ''}}>
                                            <label for="r23" class="radio-label">{{__('ui.conditionForParts')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-item optionals">
                                <a href="" class="faq-top">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
                                        <path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
                                    </svg>
                                    <span class="text-show">{{__('ui.showOptionals')}}</span>
                                </a>
                                <div class="faq-hidden">   

                                    <div class="company hidden">
                                        <label class="label">{{__('ui.company')}}</label>
                                        <input class="input" name="company" type="text" placeholder="{{__('ui.companyP')}}" value="{{isset($post) ? (old('company') ?? $post->company) : old('company')}}"/>
                                        <x-server-input-error inputName='company'/>
                                    </div>

                                    <label class="label">{{__('ui.chooseAmount')}}</label>
                                    <input class="input" name="amount" type="text" value="{{isset($post) ? (old('amount') ?? $post->amount) : old('amount')}}"/>
                                    <x-server-input-error inputName='amount'/>
                                    <div class="form-note">{{__('ui.amountHelp')}}</div>
    
                                    <label class="label">{{__('ui.locationRegion')}}</label>
                                    <div class="select-block">
                                        @if (isset($post))
                                            <x-region-select locale='{{app()->getLocale()}}' :defValue="$post->region_encoded"/>
                                        @else
                                            <x-region-select locale='{{app()->getLocale()}}'/>
                                        @endif
                                    </div>
    
                                    <div class="town hidden">
                                        <label class="label">{{__('ui.locationTown')}}</label>
                                        <input class="input" name="town" type="text" placeholder="{{__('ui.town')}}" value="{{isset($post) ? (old('town') ?? $post->town) : old('town')}}">
                                        <x-server-input-error inputName='town'/>
                                    </div>
    
                                    <label class="label">{{__('ui.chooseManufacturer')}}</label>
                                    <input class="input" name="manufacturer" type="text" value="{{isset($post) ? (old('manufacturer') ?? $post->manufacturer) : old('manufacturer')}}"/>
                                    <x-server-input-error inputName='manufacturer'/>
    
                                    <label class="label">{{__('ui.chooseManufacturedDate')}}</label>
                                    <input class="input" name="manufactured_date" type="text" value="{{isset($post) ? (old('manufactured_date') ?? $post->manufactured_date) : old('manufactured_date')}}"/>
                                    <x-server-input-error inputName='manufactured_date'/>
    
                                    <label class="label">{{__('ui.choosePartNum')}}</label>
                                    <input class="input" name="part_number" type="text" value="{{isset($post) ? (old('part_number') ?? $post->part_number) : old('part_number')}}"/>
                                    <x-server-input-error inputName='part_number'/>
    
                                    <label class="label">
                                        {{__('ui.cost')}}, 
                                        <div class="tumbler-inline">
                                            <div class="tumbler">
                                                <a href="" class="tumbler-left currency-switch uah {{isset($post) ? ($post->currency=='UAH' ? 'active' : '') : 'active'}}">UAH</a>
                                                <span class="tumbler-block"></span>
                                                <a href="" class="tumbler-right currency-switch usd {{isset($post) ? ($post->currency=='USD' ? 'active' : '') : ''}}">USD</a>
                                            </div>
                                            <input type="text" name="currency" hidden {{isset($post) ? "value=$post->currency" : ""}}>
                                        </div>
                                    </label>
                                    <input class="input format-cost" name="cost" type="text" placeholder="{{__('ui.cost')}}" value="{{isset($post) ? (old('cost') ?? $post->cost_readable) : old('cost')}}"/>
                                    <x-server-input-error inputName='cost'/>
                                </div>
                            </div>
                        </div>
                        <div class="form-section"> <!--description-->
                            <label class="label">{{__('ui.description')}} <span class="orange">*</span></label>
                            <textarea cols="30" rows="10" maxlength="9000" class="textarea" name="description" form="form-post">{{isset($post) ? (old('description') ?? $post->description) : old('description')}}</textarea>
                            <x-server-input-error inputName='description'/>
                        </div>
                        <div class="form-section"> <!--images-->
                            <label class="label">{{__('ui.image')}}</label>
                            <div class="upload-zone">
                                <div class="dz-message"><span>{{__('ui.dzDesc')}}</span></div>
                            </div>
                            <x-server-input-error inputName='images'/>
                        </div>
                        <div class="form-section"> <!--lifetime+special-->
                            <label class="label">{{__('ui.chooseActiveTo')}} <span class="orange">*</span></label>
                            @if (isset($post))
                                <div class="check-block">
                                    <div class="check-item">
                                        <input type="checkbox" name="lifetime_changed" class="check-input" id="ch21" value="1">
                                        <label for="ch21" class="check-label">{{__('ui.change')}}</label>
                                    </div>
                                </div>
                                @if ($post->lifetime==3)
                                    <div class="form-note lifetime-note-pre">{{__('ui.willNotHide')}}</div>
                                @else
                                    <div class="form-note lifetime-note-pre">{{__('ui.hiddenOn')}}: <span class="orange">{{$post->active_to}}</span></div>
                                @endif
                            @endif
                            <div class="select-block">
                                <select class="styled {{isset($post) ? 'hidden' : ''}}" name="lifetime">
                                    <option value="1" {{isset($post) ? ($post->lifetime==1 ? 'selected' : '') : (old('lifetime')==1 ? 'selected' : '')}}>{{__('ui.activeOneMonth')}}</option>
                                    <option value="2" {{isset($post) ? ($post->lifetime==2 ? 'selected' : '') : (old('lifetime')==2 ? 'selected' : '')}}>{{__('ui.activeTwoMonth')}}</option>
                                    <option value="3" {{isset($post) ? ($post->lifetime==3 ? 'selected' : '') : (old('lifetime')==3 ? 'selected' : '')}}>{{__('ui.activeForever')}}</option>
                                </select>
                            </div>
                            @if (old('lifetime')==1 || old('lifetime')==null)
                                <div class="form-note lifetime-note {{isset($post) ? 'hidden' : ''}}">{{__('ui.hiddenOn')}}: <span class="orange">{{\Carbon\Carbon::now()->addMonth()->toDateString()}}</span></div>
                            @elseif (old('lifetime')==2)
                                <div class="form-note lifetime-note {{isset($post) ? 'hidden' : ''}}">{{__('ui.hiddenOn')}}: <span class="orange">{{\Carbon\Carbon::now()->addMonths(2)->toDateString()}}</span></div>
                            @endif
                            <x-server-input-error inputName='lifetime'/>

                            <label class="label">{{__('ui.specialPostsStatus')}}</label>
                            <div class="check-block">
                                <div class="check-item">
                                    <input type="checkbox" name="is_urgent" class="check-input" id="ch22" value="1" {{isset($post) && $post->is_urgent ? 'checked' : ''}}>
                                    <label for="ch22" class="check-label">{{__('ui.makePostUrgent')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-section"> <!--phone+email-->
                            <label class="label">{{__('ui.phone')}} <span class="orange">*</span></label>
                            <input class="input format-phone" name="user_phone_raw" type="text" placeholder="_ (__) ___ __ __" value="{{isset($post) ? (old('user_phone_raw') ?? $post->user_phone_readable) : (old('user_phone_raw') ?? $user->phone_readable)}}" autocomplete="phone">
                            <x-server-input-error inputName='user_phone_raw'/>

                            <label class="label">{{__('ui.email')}} <span class="orange">*</span></label>
                            <input class="input" name="user_email" type="email" placeholder="{{__('ui.email')}}" value="{{isset($post) ? (old('user_email') ?? $post->user_email) : (old('user_email') ?? $user->email)}}" autocomplete="email">
                            <x-server-input-error inputName='user_email'/>
                            <div class="form-note">{{__('ui.contactHelp')}}</div>
                        </div>
                        <div class="form-button-block">
                            <button type="submit" class="button">{{isset($post) ? __('ui.saveChanges') : __('ui.publish')}}</button>
                            @if (isset($post))
                                <a href="#popup-delete-post" data-fancybox class="button button-warning">{{__('ui.deletePost')}}</a>
                            @endif
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <x-equipment-tags/>
    @if (isset($post))
        <div id="popup-delete-post" class="popup">
            <div class="popup-title">{{__('ui.sure?')}}</div>
            <div class="sure-dialog">
                <form method="POST" action="{{ loc_url(route('posts.destroy', ['post'=>$post->id])) }}">
                    @csrf
                    @method('DELETE')
                    <button class="">{{__('ui.deletePost')}}</button>
                </form>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            var oneMPast = "{{\Carbon\Carbon::now()->addMonth()->toDateString()}}";
            var twoMPast = "{{\Carbon\Carbon::now()->addMonths(2)->toDateString()}}";

            $('input[name=lifetime_changed]').change(function(){
                $('select[name=lifetime]').toggleClass('hidden');
                $('.lifetime-note').toggleClass('hidden');
                $('.lifetime-note-pre').toggleClass('hidden');
            });

            //select all values if it is editing 
            if ("{{isset($post)}}") {
                //show company field
                if ($('input:checked[name=role]').val()==2) {
                    $('div.company').removeClass('hidden');
                }
                //select region
                $('select[name=region_encoded]').selectmenu('refresh');
                //show town field
                if ($('input[name=town]').val()!='') {
                    $('div.town').removeClass('hidden');
                }
                //select lifetime
                $('select[name=lifetime]').selectmenu('refresh');
                //select tag
                var tags = $('.form-category-list > li').text().split(', ');
                $('.form-category-list').empty();
                tags.forEach(tag => {
                    $('.form-category-list').append('<li>'+tag+'</li>');
                });
                /*
                var tag = $('input[name=tag_encoded]').val();
                console.log(tag);
                $('#popup-select-eq-tag option').each(function(){
                    if ( $(this).attr('value')==tag ) {
                        console.log( $(this) );
                        $(this).parent().removeClass('hidden');
                        $(this).parent().val(tag);
                        $(this).parent().selectmenu('refresh');
                    }
                });
                */
            }

            //show/hide "company" input
            $('input[name=role]').change(function(){
                $('input[name=role]:checked').val() == 2
                    ? $('div.company').removeClass('hidden')
                    : $('div.company').addClass('hidden');
            });

            //show/hide "town" input
            $('select[name=region_encoded]').selectmenu({
                change: function (event, ui) {
                    console.log('changed region!');
                    var val = $(this).find('option:selected').val();
                    if (val==0) {
                        $('div.town').addClass('hidden');
                        $('input[name=town]').val('');
                    } else {
                        $('div.town').removeClass('hidden');
                    }
                }
            });

            //store choosed cost to hidden input
            $('.currency-switch').click(function(){
                var currency = $(this).hasClass('usd')
                    ? 'USD'
                    : 'UAH';
                $('input[name=currency]').val(currency);
            });

            // change help-note when changing lifetime
            $('select[name=lifetime]').selectmenu({
                change: function (event, ui) {
                    var val = $(this).find('option:selected').val();
                    switch (val) {
                        case '1':
                            $('.lifetime-note').removeClass('hidden');
                            $('.lifetime-note span').text(oneMPast);
                            break;
                        case '2':
                            $('.lifetime-note').removeClass('hidden');
                            $('.lifetime-note span').text(twoMPast);
                            break;
                        case '3':
                            $('.lifetime-note').addClass('hidden');
                            //check for valid subscription plan
                            break;
                        default:
                            break;
                    }
                }
            });

            //change text when hide/show optionals fields
            $('.optionals > a').click(function(){
                var text = $('.optionals > a span');
                if (text.hasClass('text-show')) {
                    text.text("{{__('ui.hideOptionals')}}");
                } else {
                    text.text("{{__('ui.showOptionals')}}");
                }
                text.toggleClass('text-show');
            });

            // createa file upload form (dropzone)
            if ("{{isset($post)}}") {
                var postId = $('#post-id-flag').text();
                var dzUrl = "{{route('posts.update', ['post'=>':postId'])}}".replace(':postId', postId);
                $('.upload-zone').dropzone({
                    url: dzUrl,
                    paramName: "images",
                    uploadMultiple: true,
                    parallelUploads: 5,
                    maxFilesize: 5, // MB
                    addRemoveLinks: true,
                    timeout: 5000,
                    maxFiles: 5,
                    acceptedFiles: '.jpeg,.jpg,.png',
                    autoProcessQueue: false,
                    dictDefaultMessage: "",
                    dictFileTooBig: "{{__('ui.dzBigFile')}}",
                    dictInvalidFileType: "{{__('ui.dzInvalidMime')}}",
                    dictResponseError: "{{__('ui.dzServerError')}}",
                    dictUploadCanceled: "{{__('ui.dzUploadCanceled')}}",
                    dictRemoveFile: "{{__('ui.dzUploadRemoveLink')}}",
                    dictMaxFilesExceeded: "{{__('ui.dzTooFewFiles')}}",
                    init: function () {
                        var thisDropzone = this;

                        if ('{{isset($images) && $images}}') {
                            var images = JSON.parse('{!! isset($post) ? $images : "" !!}');
                            $.each(images, function(key,value){
                                var mockFile = { name: value.name, size: value.size, id: value.id };
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.url);
                            });
                        }

                        this.on("removedfile", function(file) {
                            if (file.id !== undefined) {
                                ajaxUrl = "{{route('posts.img.delete', ['post'=>':postId', 'image'=>':imgNo'])}}";
                                ajaxUrl = ajaxUrl.replace(':imgNo', file.id);
                                ajaxUrl = ajaxUrl.replace(':postId', postId);
                                $.ajax({
                                    type: "POST",
                                    url: ajaxUrl,
                                    data: {
                                        _method: 'PATCH',
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function(data) {
                                        data
                                            ? showPopUpMassage(true, "{{ __('messages.postImgDeleted') }}")
                                            : showPopUpMassage(false, "{{ __('messages.error') }}");
                                    },
                                    error: function() {
                                        showPopUpMassage(false, "{{ __('messages.error') }}");
                                    }
                                });
                            }
                        });

                        $("#form-post button[type=submit]").click(function (e) {
                            e.preventDefault();
                            $('.dz-error').empty();
                            $('.dz-error').addClass('hidden');
                            $(this).addClass('loading');
                            if (thisDropzone.getQueuedFiles().length > 0) {
                                thisDropzone.processQueue();
                            } else {
                                $('#form-post').submit();
                            }
                        });

                        this.on('sending', function(file, xhr, formData) {
                            // Append all form inputs to the formData Dropzone will POST
                            var data = $('#form-post').serializeArray();
                            $.each(data, function(key, el) {
                                formData.append(el.name, el.value);
                            });
                        });

                        this.on("successmultiple", function(){
                            window.location="{{ loc_url(route('posts.update.fake')) }}";
                        });

                        this.on("errormultiple", function(file, errorMessage, xhr){
                            showErrorsFromDropzone(thisDropzone, errorMessage);
                        });
                    },
                });
            } else {
                $('.upload-zone').dropzone({
                    url: "{{route('posts.store')}}",
                    paramName: "images",
                    uploadMultiple: true,
                    parallelUploads: 5,
                    maxFilesize: 5, // MB
                    addRemoveLinks: true,
                    timeout: 5000,
                    maxFiles: 5,
                    acceptedFiles: '.jpeg,.jpg,.png',
                    autoProcessQueue: false,
                    dictDefaultMessage: "",
                    dictFileTooBig: "{{__('ui.dzBigFile')}}",
                    dictInvalidFileType: "{{__('ui.dzInvalidMime')}}",
                    dictResponseError: "{{__('ui.dzServerError')}}",
                    dictUploadCanceled: "{{__('ui.dzUploadCanceled')}}",
                    dictRemoveFile: "{{__('ui.dzUploadRemoveLink')}}",
                    dictMaxFilesExceeded: "{{__('ui.dzTooFewFiles')}}",
                    init: function () {
                        var myDropzone = this;

                        $("#form-post button[type=submit]").click(function (e) {
                            e.preventDefault();
                            $('.dz-error').empty();
                            $('.dz-error').addClass('hidden');
                            $(this).addClass('loading');
                            if (myDropzone.getQueuedFiles().length > 0) {
                                myDropzone.processQueue();
                            } else {
                                $('#form-post').submit();
                            }
                        });

                        this.on('sending', function(file, xhr, formData) {
                            // Append all form inputs to the formData Dropzone will POST
                            var data = $('#form-post').serializeArray();
                            $.each(data, function(key, el) {
                                formData.append(el.name, el.value);
                            });
                        });

                        this.on("successmultiple", function(){
                            window.location="{{ loc_url(route('posts.store.fake')) }}";
                        });

                        this.on("errormultiple", function(file, errorMessage, xhr){
                            showErrorsFromDropzone(myDropzone, errorMessage);
                        });
                    },
                });
            }

            // show error from submit post with dropzone 
            function showErrorsFromDropzone(dz, error) {
                $("#form-post button[type=submit]").removeClass('loading');
                // parse error messages
                if (typeof error['message'] != 'undefined' && error['message'] == "The given data was invalid.") { // if it is error from input fields
                    showPopUpMassage(false, "{{ __('messages.postInputErrors') }}");
                    var invalidInputErrors = error['errors'];
                    $.each(invalidInputErrors, function(key, value) {
                        $('.'+key+'.dz-error').text(value);
                        $('input[name='+key+']').addClass('form-error');
                        $('textarea[name='+key+']').addClass('form-error');
                        $('select[name='+key+']').addClass('form-error');
                        $('.'+key+'.dz-error').removeClass('hidden');
                    });
                } else if (error['code'] == 111 && typeof error['message'] != 'undefined') {// if it is custom error from post upload 
                    showPopUpMassage(false, error['message']);
                //} else if (typeof error['code'] != 'undefined') { // if it is any error with error code
                    //showPopUpMassage(false, error['code'] + ". " + "{{__('messages.error')}}");
                } else {
                    showPopUpMassage(false, "{{__('messages.error')}}");
                }
                dz.removeAllFiles();
            }

            //Validate the form
            $('#form-post').validate({
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
                    amount: {
                        digits: true,
                        maxlength: 9
                    },
                    town: {
                        maxlength: 100
                    },
                    manufacturer: {
                        minlength: 5,
                        maxlength: 70
                    },
                    manufactured_date: {
                        minlength: 4,
                        maxlength: 70
                    },
                    part_number: {
                        minlength: 3,
                        maxlength: 70
                    },
                    cost: {
                        maxlength: 51
                    },
                    description: {
                        required: true,
                        minlength: 10,
                        maxlength: 9000
                    },
                    user_phone_raw: {
                        minlength: 16,
                        maxlength: 16
                    },
                    user_email: {
                        email: true,
                        maxlength: 254
                    }
                },
                messages: {
                    title: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 70]) }}'
                    },
                    amount: {
                        digits: '{{ __("validation.integer") }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9]) }}'
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
                        minlength: '{{ __("validation.min.string", ["min" => 4]) }}',
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
                errorElement: 'div',
				errorClass: 'form-error',
                invalidHandler: function(event, validator) {
                    $("#form-post button[type=submit]").removeClass('loading');
                }
            });
        });
    </script>
@endsection