@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href=""><span itemprop="name">{{__('ui.mailer')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.editing')}} "{{$mailer->title}}"</span></span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='mailer'/>
        <div class="content">
            <h1>{{__('ui.editing')}} "{{$mailer->title}}"</h1>
            <div class="form-block">
                <form id="form-mailer" method="POST" action="{{loc_url(route('mailer.update', ['mailer'=>$mailer->id]))}}">
                    @csrf
                    @method('PATCH')
                    <fieldset>
                        <div class="form-section">
                            <label class="label">{{__('ui.mailerTitle')}} <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="title" placeholder="{{__('ui.mailerTitle')}}" value="{{old('title') ?? $mailer->title}}">
                            <x-server-input-error inputName='title'/>
                            <div class="form-note">{{__('ui.mailerTitleHelp')}}</div>

                            <label class="label">{{__('ui.mailerKeyword')}}</label>
                            <input type="text" class="input input-long" name="keyword" placeholder="{{__('ui.mailerKeywords')}}" value="{{old('keyword') ?? $mailer->keyword}}">
                            <x-server-input-error inputName='keyword'/>
                            <div class="form-note">{{__('ui.mailerKeywordHelp')}}</div>

                            <label class="label">{{__('ui.tag')}}, 
                                <div class="tumbler-inline">
                                    <div class="tumbler">
                                        <a href="" class="tumbler-left tags-switch {{$mailer->tag ? ($mailer->tag_is_eq ? 'active' : '') : 'active'}}">{{__('ui.equipment')}}</a>
                                        <span class="tumbler-block"></span>
                                        <a href="" class="tumbler-right tags-switch {{$mailer->tag ? (!$mailer->tag_is_eq ? 'active' : '') : ''}}">{{__('ui.service')}}</a>
                                    </div>
                                </div>
                            </label>
                            <div class="form-category">
                                <a href="#popup-select-eq-tag" data-fancybox class="form-category-button {{$mailer->tag ? ($mailer->tag_is_eq ? '' : 'hidden') : ''}}">{{__('ui.tags')}}</a>
                                <a href="#popup-select-se-tag" data-fancybox class="form-category-button {{$mailer->tag ? (!$mailer->tag_is_eq ? '' : 'hidden') : 'hidden'}}">{{__('ui.tags')}}</a>
                                <ul class="form-category-list">
                                    @if ($mailer->tag)
                                        @foreach ($mailer->tag_map as $tag)
                                            <li>{{$tag}}</li>
                                        @endforeach
                                    @else
                                        <li>{{__('tags.other')}}</li>
                                    @endif
                                </ul>
                                <input type="text" name="tag_encoded" value="{{$mailer->tag}}" hidden>
                            </div>

                            @if ($mailer->author)
                                <label class="label">{{__('ui.author')}}</label>
                                <input type="text" class="input" value="{{$mailer->author_name}}" disabled>
                                <input type="text" class="hidden" name="author" value="{{$mailer->author}}">
                                <div class="form-note remove-author-btn">{{__('ui.mailerAuthorHelp')}} <a href="">{{__('ui.removed')}}</a></div>
                            @endif
                        </div>
                        <div class="form-section">
                            <label class="label">
                                {{__('ui.cost')}}, 
                                <div class="tumbler-inline">
                                    <div class="tumbler">
                                        <a href="" class="tumbler-left currency-switch uah {{$mailer->currency=='UAH' ? 'active' : ''}}">UAH</a>
                                        <span class="tumbler-block"></span>
                                        <a href="" class="tumbler-right currency-switch usd {{$mailer->currency=='USD' ? 'active' : ''}}">USD</a>
                                    </div>
                                </div>
                                <input type="text" name="currency" value="{{$mailer->currency}}" hidden>
                            </label>
                            <div class="price-input">
                                <input type="text" class="input format-cost" name="cost_from" placeholder="{{__('ui.from')}}" value="{{old('cost_from') ?? $mailer->cost_from_readable}}">
                                <span class="price-input-divider">-</span>
                                <input type="text" class="input format-cost" name="cost_to" placeholder="{{__('ui.to')}}" value="{{old('cost_to') ?? $mailer->cost_to_readable}}">
                            </div>
                            <x-server-input-error inputName='cost_from'/>
                            <x-server-input-error inputName='cost_to'/>

                            <label class="label">{{__('ui.region')}}</label>
                            <div class="select-block">
                                <x-region-select locale='{{app()->getLocale()}}' :defValue="$mailer->region"/>
                            </div>

                            <div class="add-radio">
                                <div class="add-radio-col type-cb">
                                    <label class="label">{{__('ui.type')}} <span class="orange">*</span></label>
                                    <div class="check-block">
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="type[]" value="1" id="ch1" {{in_array('1', $mailer->type) ? 'checked' : ''}}>
                                            <label for="ch1" class="check-label">{{__('ui.postTypeSell')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="type[]" value="2" id="ch2" {{in_array('2', $mailer->type) ? 'checked' : ''}}>
                                            <label for="ch2" class="check-label">{{__('ui.postTypeBuy')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="type[]" value="3" id="ch3" {{in_array('3', $mailer->type) ? 'checked' : ''}}>
                                            <label for="ch3" class="check-label">{{__('ui.postTypeRent')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="type[]" value="4" id="ch4" {{in_array('4', $mailer->type) ? 'checked' : ''}}>
                                            <label for="ch4" class="check-label">{{__('ui.postTypeLeas')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="type[]" value="5" id="ch5" {{in_array('5', $mailer->type) ? 'checked' : ''}}>
                                            <label for="ch5" class="check-label">{{__('ui.postTypeGiveS')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="type[]" value="6" id="ch6" {{in_array('6', $mailer->type) ? 'checked' : ''}}>
                                            <label for="ch6" class="check-label">{{__('ui.postTypeGetS')}}</label>
                                        </div>
                                    </div>
                                    <x-server-input-error inputName='type'/>
                                </div>
                                <div class="add-radio-col condition-cb">
                                    <label class="label">{{__('ui.condition')}} <span class="orange">*</span></label>
                                    <div class="check-block">
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="condition[]" value="2" id="ch7" {{in_array('2', $mailer->condition) ? 'checked' : ''}}>
                                            <label for="ch7" class="check-label">{{__('ui.conditionNew')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="condition[]" value="3" id="ch8" {{in_array('3', $mailer->condition) ? 'checked' : ''}}>
                                            <label for="ch8" class="check-label">{{__('ui.conditionSH')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="condition[]" value="4" id="ch9" {{in_array('4', $mailer->condition) ? 'checked' : ''}}>
                                            <label for="ch9" class="check-label">{{__('ui.conditionForParts')}}</label>
                                        </div>
                                    </div>
                                    <x-server-input-error inputName='condition'/>
                                </div>

                            </div>

                            <div class="add-radio">
                                <div class="add-radio-col role-cb">
                                    <label class="label">{{__('ui.postRole')}} <span class="orange">*</span></label>
                                    <div class="check-block">
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="role[]" value="1" id="ch10" {{in_array('1', $mailer->role) ? 'checked' : ''}}>
                                            <label for="ch10" class="check-label">{{__('ui.postRolePrivate')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="role[]" value="2" id="ch11" {{in_array('2', $mailer->role) ? 'checked' : ''}}>
                                            <label for="ch11" class="check-label">{{__('ui.postRoleBusiness')}}</label>
                                        </div>
                                    </div>
                                    <x-server-input-error inputName='role'/>
                                </div>
                                <div class="add-radio-col thread-cb">
                                    <label class="label">{{__('ui.thread')}} <span class="orange">*</span></label>
                                    <div class="check-block">
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="thread[]" value="1" id="ch12" {{in_array('1', $mailer->thread) ? 'checked' : ''}}>
                                            <label for="ch12" class="check-label">{{__('ui.equipment')}}</label>
                                        </div>
                                        <div class="check-item">
                                            <input type="checkbox" class="check-input" name="thread[]" value="2" id="ch13" {{in_array('2', $mailer->thread) ? 'checked' : ''}}>
                                            <label for="ch13" class="check-label">{{__('ui.service')}}</label>
                                        </div>
                                    </div>
                                    <x-server-input-error inputName='thread'/>
                                </div>
                            </div>
                        </div>
                        <div class="form-button-block">
                            <button class="button">{{__('ui.saveChanges')}}</button>
                            <a href="#popup-delete-post" data-fancybox class="button button-warning">{{__('ui.deleteMailer')}}</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <x-service-tags/>
    <x-equipment-tags/>
    <div id="popup-delete-post" class="popup">
        <div class="popup-title">{{__('ui.sure?')}}</div>
        <div class="sure-dialog">
            <form method="POST" action="{{ loc_url(route('mailer.destroy', ['mailer'=>$mailer->id])) }}">
                @csrf
                @method('DELETE')
                <button type="submit">{{__("ui.deleteMailer")}}</button>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //remove author from mailer
            $('.remove-author-btn a').click(function(e){
                e.preventDefault();
                //TODO
            });

            //swith che equipment
            $('.tags-switch').click(function(){
                $('.tags-switch').toggleClass('active');
                $('.form-category-button').toggleClass('hidden');
            });

            $.validator.addMethod("atLeastOneType", function(value, elem, param) {
                return $(".type-cb input:checked").length > 0;
            },"{{ __('messages.mailerEmptyTypesError') }}");

            $.validator.addMethod("atLeastOneCondition", function(value, elem, param) {
                return $(".condition-cb input:checked").length > 0;
            },"{{ __('messages.mailerEmptyConditionsError') }}");

            $.validator.addMethod("atLeastOneRole", function(value, elem, param) {
                return $(".role-cb input:checked").length > 0;
            },"{{ __('messages.mailerEmptyRolesError') }}");

            $.validator.addMethod("atLeastOneThread", function(value, elem, param) {
                return $(".thread-cb input:checked").length > 0;
            },"{{ __('messages.mailerEmptyThreadsError') }}");

            // change default error-lable insertion location
            $.validator.setDefaults({
                errorPlacement: function(error, element) {
                    if (element.prop('name') === 'cost_from' || element.prop('name') === 'cost_to') {
                        error.insertAfter(element.parent());
                    } else if (element.prop('name') === 'type[]' || element.prop('name') === 'condition[]' || element.prop('name') === 'role[]' || element.prop('name') === 'thread[]') {
                        error.insertAfter(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            //Validate the form
            $('#form-mailer').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    cost_from: {
                        maxlength: 50
                    },
                    cost_to: {
                        maxlength: 50
                    },
                    keyword: {
                        minlength: 3,
                        maxlength: 50
                    },
                    "type[]": {
                        atLeastOneType: true
                    },
                    "condition[]": {
                        atLeastOneCondition: true
                    },
                    "role[]": {
                        atLeastOneRole: true
                    },
                    "thread[]": {
                        atLeastOneThread: true
                    }
                },
                messages: {
                    title: {
                        required: '{{ __("validation.required") }}',
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 50]) }}'
                    },
                    cost_from: {
                        maxlength: '{{ __("validation.max.string", ["max" => 50]) }}'
                    },
                    cost_to: {
                        maxlength: '{{ __("validation.max.string", ["max" => 50]) }}'
                    },
                    keyword: {
                        minlength: '{{ __("validation.min.string", ["min" => 3]) }}',
                        maxlength: '{{ __("validation.max.string", ["max" => 50]) }}'
                    }
                },
                errorElement: 'div',
				errorClass: 'form-error'
            });
        });
    </script>
@endsection