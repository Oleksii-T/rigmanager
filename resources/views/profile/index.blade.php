@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_show.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/modal_confirm.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <x-profile-nav/>
            </nav> 

            <div id="avaShow">
                @if ($user->image)
                    <img src="{{ $user->image->url }}" alt="{{__('alt.keyword')}}">
                @else
                    <img src="{{ asset('icons/emptyUserIcon.svg') }}" alt="{{__('alt.keyword')}}">
                @endif
            </div>

            <table>
                <tr id="usernameField">
                    <td class="fieldName">
                        <p>{{__('ui.userName')}}</p>
                    </td>
                    <td class="fieldValue">
                        <p>{{ $user->name }}</p>
                    </td>
                </tr>
                <tr id="phoneField">
                    <td class="fieldName">
                        <p>{{__('ui.phone')}}</p>
                    </td>
                    <td class="fieldValue">
                        @if ($user->phone_raw)
                            <p style="display: inline">{{ $user->phone_intern }}</p>
                            @if ( $user->viber )
                                <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                            @if ( $user->telegram )
                                <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                            @if ( $user->whatsapp )
                                <img src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                        @else
                            <p>{{__('ui.notSpecified')}}</p>
                        @endif
                    </td>
                </tr>
                <tr id="emailField">
                    <td class="fieldName">
                        <p>{{__('ui.login')}}</p>
                    </td>
                    <td class="fieldValue">
                        <p>{{ $user->email }}</p>
                    </td>
                </tr>
                @if (!$user->is_social)
                    <tr id="passwordField">
                        <td class="fieldName">
                            <p>{{__('ui.password')}}</p>
                            <img id="helpImg" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </td>
                        <td class="fieldValue">
                            <p>&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022</p>
                            <p class="helpText hidden"><i>{{__('ui.passwordEncrypted')}}</i></p>
                        </td>
                    </tr>
                @endif
            </table>
            <div id="editBtnField">
                <a class="def-button" id="editBtn" href="{{ loc_url(route('profile.edit')) }}">{{__('ui.edit')}}</a>
                @if ($user->is_social)
                    <p class="social-acc-help"><img src="{{asset('icons/alertIcon.svg')}}" alt="{{__('alt.keyword')}}">{{__('ui.uHave')}} <a href="{{loc_url(route('faq'))}}#WhatIsSocialAcc">{{__('ui.socialAcc')}}</a></p>
                @endif
                <button id="modalProfileDeleteOn">{{__('ui.deleteProfile')}}</button>
            </div>
        </div>
    </div>
    <div class="modalView animate hidden" id="modalProfileDelete">
        <div class="modalContent">
            <p class="modal-header">{{__('ui.sure?')}}</p>
            <p class="modal-misc-info">{{__('ui.deleteProfileHelp')}}</p>
            <div class="modal-btns">
                <button class="def-button submit-button close-modal" type="button" id="modalProfileDeleteOff">{{__('ui.no')}}</button>
                <form id="delete-profile" action="{{loc_url(route('profile.delete'))}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <button class="def-button cancel-button delete-profile">{{__('ui.deleteProfile')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#modalProfileDeleteOn').click(function(){
                $('#modalProfileDelete').removeClass('hidden');
            });

            $('#modalProfileDeleteOff').click(function(){
                $('#modalProfileDelete').addClass('hidden');
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var modal = document.getElementById("modalProfileDelete");
                if (event.target == modal) {
                    $('#modalProfileDelete').addClass('hidden');
                } 
            }

            //show help image
            $("#helpImg").hover(function(){
                    $(".helpText").removeClass("hidden");
                }, function(){
                    $(".helpText").addClass("hidden");
            });
        });

    </script>
@endsection
