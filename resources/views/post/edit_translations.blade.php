@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.post.edit-trans')}}</title>
	<meta name="description" content="{{__('meta.description.user.post.edit-trans')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    @if (isset($post))
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('profile.posts'))}}"><span itemprop="name">{{__('ui.myPosts')}}</span></a>
            <meta itemprop="position" content="2" />
        </li>
        <li class="crop-bc-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}"><span itemprop="name">{{$post->title_localed}}</span></a>
            <meta itemprop="position" content="3" />
        </li>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('posts.edit', ['post'=>$post->url_name]))}}"><span itemprop="name">{{__('ui.postSettings')}}</span></a>
            <meta itemprop="position" content="4" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name">{{__('ui.postTransSettings')}}</span>
            <meta itemprop="position" content="5" />
        </li>
    @endif
@endsection

@section('content')
	<div class="main-block">
        <x-profile-nav active='posts'/>

		<div class="content">
			<h1>{{__('ui.postTransSettings')}}</h1>
			<div class="content-top-text">{{__('ui.postTransSettingsHelp')}} <a href="{{loc_url(route('faq'))}}#WhatIsAutoTranslator">{{__('ui.here')}}</a>.
                <span style="font-weight:500">{{__('ui.trasnlationEditWarning')}}</span></div>
            <div class="form-block">
                <form id="form-post" method="POST" action="{{loc_url(route('posts.trans.update', ['post'=>$post->id]))}}">
                    @method('PATCH')
                    @csrf
                    <fieldset>
                        <div class="form-section"> <!--title-->
                            <label class="label">{{__('ui.originalTitle')}} (<span class="orange">{{$post->origin_lang}}</span>)</label>
                            <p class="fake-input">{{$post->title}}</p>

                            @if ($post->origin_lang!='uk')
                                <label class="label">{{__('ui.ukTitle')}} <span class="orange">*</span></label>
                                <input class="input input-long" name="title_uk" type="text" placeholder="{{__('ui.ukTitle')}}" value="{{old('title') ?? $post->title_uk}}"/>
                                <x-server-input-error inputName='title_uk'/>
                            @endif

                            @if ($post->origin_lang!='ru')
                                <label class="label">{{__('ui.ruTitle')}} <span class="orange">*</span></label>
                                <input class="input input-long" name="title_ru" type="text" placeholder="{{__('ui.ruTitle')}}" value="{{old('title') ?? $post->title_ru}}"/>
                                <x-server-input-error inputName='title_ru'/>
                            @endif

                            @if ($post->origin_lang!='en')
                                <label class="label">{{__('ui.enTitle')}} <span class="orange">*</span></label>
                                <input class="input input-long" name="title_en" type="text" placeholder="{{__('ui.enTitle')}}" value="{{old('title') ?? $post->title_en}}"/>
                                <x-server-input-error inputName='title_en'/>
                            @endif
                        </div>
                        <div class="form-section"> <!--description-->
                            <label class="label">{{__('ui.originalDescription')}} (<span class="orange">{{$post->origin_lang}}</span>)</label>
                            <p class="fake-input">{{$post->description}}</p>

                            @if ($post->origin_lang!='uk')
                                <label class="label">{{__('ui.ukDescription')}} <span class="orange">*</span></label>
                                <textarea cols="30" rows="10" maxlength="9000" class="textarea" name="description_uk" form="form-post">{{old('description') ?? $post->description_uk}}</textarea>
                                <x-server-input-error inputName='description_uk'/>
                            @endif

                            @if ($post->origin_lang!='ru')
                                <label class="label">{{__('ui.ruDescription')}} <span class="orange">*</span></label>
                                <textarea cols="30" rows="10" maxlength="9000" class="textarea" name="description_ru" form="form-post">{{old('description') ?? $post->description_ru}}</textarea>
                                <x-server-input-error inputName='description_ru'/>
                            @endif

                            @if ($post->origin_lang!='en')
                                <label class="label">{{__('ui.enDescription')}} <span class="orange">*</span></label>
                                <textarea cols="30" rows="10" maxlength="9000" class="textarea" name="description_en" form="form-post">{{old('description') ?? $post->description_en}}</textarea>
                                <x-server-input-error inputName='description_en'/>
                            @endif
                        </div>
                        <div class="form-button-block">
                            <button type="submit" class="button">{{__('ui.saveChanges')}}</button>
                        </div>
                    </fieldset>
                </form>
		    </div>
		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            //Validate the form
            $('#form-postt').validate({
                rules: {
                    title_uk: {
                        required: true,
                        minlength: 10,
                        maxlength: 70
                    },
                    title_ru: {
                        required: true,
                        minlength: 10,
                        maxlength: 70
                    },
                    title_en: {
                        required: true,
                        minlength: 10,
                        maxlength: 70
                    },
                    description_uk: {
                        required: true,
                        minlength: 10,
                        maxlength: 9000
                    },
                    description_ru: {
                        required: true,
                        minlength: 10,
                        maxlength: 9000
                    },
                    description_en: {
                        required: true,
                        minlength: 10,
                        maxlength: 9000
                    },
                },
                messages: {
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