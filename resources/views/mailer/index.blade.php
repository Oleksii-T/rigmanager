@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/mailer_show.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <x-profile-nav/>
            </nav> 
            <div class="mailerContent">
                @if ($mailer)
                    <div class="mailerBody">
                        <div>
                            @if ($mailer->is_active)
                                <label id="checkboxContainer" class="enable">
                                    <h2 class="mailerHeader">{{__('ui.mailerIsActive')}}</h2>
                                    <input type="checkbox" name="is_active" value="1" checked>
                                    <span class="checkmark"></span>
                                </label>
                            @else
                                <label id="checkboxContainer" class="disable">
                                    <h2 class="mailerHeader">{{__('ui.mailerNotActive')}}</h2>
                                    <input type="checkbox" name="is_active" value="1">
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                        </div>

                        <h3 class="elementHeader">{{__('ui.mailerDescription')}}:</h3>
                        @if ($mailer->keywords)
                            <p id="description">{{$mailer->keywords}}</p>
                        @else
                            <p class="empty-value">{{__('ui.empty')}}</p>
                        @endif

                        <h3 class="elementHeader">{{__('ui.mailerEqTags')}}:</h3>
                        @if ($mailer->eq_tags_encoded)
                            <ol class="orderedList">
                                @foreach ($mailer->eq_tags_map as $tag)
                                    <li><span>{{$tag}}</span></li>
                                @endforeach
                            </ol>
                        @else
                            <p class="empty-value">{{__('ui.empty')}}</p>
                        @endif

                        <h3 class="elementHeader">{{__('ui.mailerSeTags')}}:</h3>
                        @if ($mailer->se_tags_encoded)
                            <ol class="orderedList">
                                @foreach ($mailer->se_tags_map as $tag)
                                    <li><span>{{$tag}}</span></li>
                                @endforeach
                            </ol>
                        @else
                            <p class="empty-value">{{__('ui.empty')}}</p>
                        @endif

                        <h3 class="elementHeader">{{__('ui.mailerAuthors')}}:</h3>
                        @if ($mailer->authors_encoded)
                            <ol class="orderedList">
                                @foreach ($mailer->authors_map as $author)
                                    <li><span>{{$author}}</span></li>
                                @endforeach
                            </ol>
                        @else
                            <p class="empty-value">{{__('ui.empty')}}</p>
                        @endif

                        <h3 class="elementHeader">{{__('ui.postType')}}:</h3>
                        @if ($mailer->types)
                        <ul class="orderedList">
                            @foreach ($mailer->types_map as $type)
                                <li><span>{{$type}}</span></li>
                            @endforeach
                        </ul>
                        @else
                            <p class="empty-value">{{__('ui.empty')}}</p>
                        @endif
                    </div>

                    <div class="mailerBtns">
                        <a class="def-button" id="editBtn" href="{{ loc_url(route('mailer.edit')) }}">{{__('ui.edit')}}</a>
                        <a id="helpBtn" href="{{loc_url(route('faq'))}}#WhatIsMailer">{{__('ui.whatIsMailer')}}?</a>
                        <button class="def-button delete-button" type="button" id="modalMailerDeleteShow">{{__('ui.deleteMailer')}}</button>
                    </div>
                @else
                    <div class="mailerBody">
                        <p>{{__('ui.noMailer')}}</p>
                    </div>

                    <div class="mailerBtns">
                        <a class="def-button" id="editBtn" href="{{ loc_url(route('mailer.create')) }}">{{__('ui.setUpMailer')}}</a>
                        <a id="helpBtn" href="{{loc_url(route('faq'))}}#WhatIsMailer">{{__('ui.whatIsMailer')}}?</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($mailer)
        <div class="modalView" id="modalMailerDelete">
            <div class="modalContent">
                <p>{{__('ui.sure?')}}</p>
                <div>
                    <button class="def-button submit-button" type="button" id="modalMailerDeleteHide">{{__('ui.no')}}</button>

                    <form method="POST" action="{{ loc_url(route('mailer.destroy')) }}">
                        @csrf
                        @method('DELETE')
                        <button class="def-button cancel-button">{{__('ui.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // user clicks on is_active checkbox
            $('#checkboxContainer input').click(function() {
                $element = $('#checkboxContainer');
                if ( $element.attr('class') == "enable" ) {
                    // disable mailer
                    $element.removeClass('enable');
                    $element.addClass('disable');
                    $('#checkboxContainer h2').text("{{__('ui.mailerNotActive')}}");
                }else {
                    // anable mailer
                    $element.removeClass('disable');
                    $element.addClass('enable');
                    $('#checkboxContainer h2').text("{{__('ui.mailerIsActive')}}");
                }
                $.ajax({
                    type: "GET",
                    url: "{{ route('mailer.toggle') }}",
                    success: function(data) {
                        showPopUpMassage(true, "{{ __('messages.mailerUploaded') }}");
                    },
                    error: function() {
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });

            //open modal delete confirm when user ask to
            $('#modalMailerDeleteShow').click(function(){
                $('#modalMailerDelete').css("display", "block");
            });

            //close delete confirmation
            $('#modalMailerDeleteHide').click(function(){
                $('#modalMailerDelete').css("display", "none");
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var modal = document.getElementById("modalImgsDelete");
                if (event.target == modal) {
                    $('#modalImgsDelete').css("display", "none");
                }
                var modal = document.getElementById("modalMailerDelete");
                if (event.target == modal) {
                    $('#modalMailerDelete').css("display", "none");
                }
            }
        });

    </script>
@endsection
