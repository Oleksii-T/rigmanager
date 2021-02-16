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
            <span itemprop="item"><span itemprop="name">{{__('ui.postCreate')}}. {{__('ui.service')}}</span></span>
            <meta itemprop="position" content="2" />
        </li>
    @endif
@endsection

@section('content')
    <div class="main-block">
        @if (isset($post))
            <x-profile-nav active='posts'/>
        @else
            <x-post-create-nav active='se'/>
        @endif
        <div class="content">
            <h1>{{isset($post) ? __('ui.postSettings') : __('ui.postCreate') . '. ' . __('ui.service')}}</h1>
            <div class="form-block">
                <span id="post-id-flag" hidden>{{isset($post) ? $post->id : ''}}</span>
                <form id="form-post" method="POST" action="{{isset($post) ? loc_url(route('posts.update', ['post'=>$post->id])) : loc_url(route('posts.store'))}}">
                    @if (isset($post))
                        @method('PATCH')
                    @endif
                    @csrf
                    <input type="text" name="thread" value="2" hidden>
                    <input type="text" name="role" value="2" hidden>
                    <fieldset>
                        <div class="form-section"> <!--title+tag-->
                            <label class="label">{{__('ui.title')}} <span class="orange">*</span></label>
                            <input class="input input-long" name="title" type="text" placeholder="{{__('ui.title')}}" value="{{isset($post) ? (old('title') ?? $post->title) : old('title')}}"/>
                            <x-server-input-error inputName='title'/>

                            <label class="label">{{__('ui.chooseTag')}} <span class="orange">*</span></label>
                            <div class="form-category">
                                <a href="#popup-select-se-tag" data-fancybox class="form-category-button">{{__('ui.tags')}}</a>
                                <ul class="form-category-list">
                                    @if (isset($post))
                                        <li>{{$post->tag_readable}}</li>
                                    @else
                                        <li>{{__('tags.otherService')}}</li>
                                    @endif
                                </ul>
                            </div>
                            <input type="text" name="tag_encoded" value="{{isset($post) ? $post->tag_encoded : (old('tag_encoded') ?? 50)}}" hidden/>
                            <div class="form-note">{{__('ui.tagHelp')}}</div>
                        </div>
                        <div class="form-section"> <!--type-->
                            <div class="add-radio">
                                <div class="add-radio-col">
                                    <label class="label">{{__('ui.choosePostType')}} <span class="orange">*</span></label>
                                    <div class="radio-block">
                                        <div class="radio-item">
                                            <input type="radio" name="type" class="radio-input" id="r1" value="5" {{isset($post) ? ($post->type==5 ? 'checked' : '') : 'checked'}}>
                                            <label for="r1" class="radio-label">{{__('ui.postTypeGiveS')}}</label>
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="type" class="radio-input" id="r2" value="6" {{isset($post) && $post->type==6 ? 'checked' : ''}}>
                                            <label for="r2" class="radio-label">{{__('ui.postTypeGetS')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-section"> <!--company-->
                            <label class="label">{{__('ui.company')}}</label>
                            <input class="input" name="company" type="text" value="{{isset($post) ? (old('company') ?? $post->company) : old('company')}}"/>
                            <x-server-input-error inputName='company'/>
                        </div>
                        <div class="form-section"> <!--description-->
                            <label class="label">{{__('ui.description')}} <span class="orange">*</span></label>
                            <textarea cols="30" rows="10" maxlength="9000" class="textarea" name="description" form="form-post">{{isset($post) ? (old('description') ?? $post->description) : old('description')}}</textarea>
                            <x-server-input-error inputName='description'/>
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
    <x-service-tags/>
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
                    company: {
                        minlength: '{{ __("validation.min.string", ["min" => 5]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 200]) }}'
                    },
                    description: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 10]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 9000]) }}'
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