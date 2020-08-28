@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_show.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    <div id="profileContentWraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <ul>
                    <li><a id="personlaInfoBtn" href="{{route('profile')}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a id="mailerBtn" href="{{route('mailer.index')}}">{{__('ui.mailer')}}</a></li>
                    <li><a id="mySubscriptionBtn" href="{{route('profile.subscription')}}">{{__('ui.mySubscription')}}</a></li>
                </ul>
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
                <tr id="passwordField">
                    <td class="fieldName">
                        <p>{{__('ui.password')}}</p>
                        <img id="helpImg" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    </td>
                    <td class="fieldValue">
                        <p>&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022</p>
                    </td>
                </tr>
                <tr id="editBtnField">
                    <td>
                        <a class="def-button" id="editBtn" href="{{ route('profile.edit') }}">{{__('ui.edit')}}</a>
                    </td>
                </tr>
            </table>

            <p class="helpText"><i>{{__('ui.passwordEncrypted')}}</i></p>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //show help image
            $("#helpImg").hover(function(){
                $(".helpText").css("opacity", "1");
                }, function(){
                $(".helpText").css("opacity", "0");
            });
        });
        
    </script>
@endsection
