@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/profile_show.css')}}" />
@endsection

@section('content')

    <p class="heading1">{{__('ui.profileInfo')}}</p>

    <div id="avaShow">
        @if ($user->image)
            <img src="{{ $user->image->url }}" alt="{{__('alt.keyword')}}">
        @else
            <img src="{{ asset('icons/emptyUserIcon.svg') }}" alt="{{__('alt.keyword')}}">
        @endif
    </div>

    <div id="userData">
        <table>
            <tr id="nameShow">
                <td><p>{{__('ui.userName')}}</p></td>
                <td><p>{{ $user->name }}</p></td>
            </tr>
            @if ($user->phone)
                <tr id="phoneShow">
                    <td><p>{{__('ui.phone')}}</p></td>
                    <td>
                        <p style="display: inline">{{ $user->phone }}</p>
                        @if ( $user->viber )
                            <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        @endif
                        @if ( $user->telegram )
                            <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        @endif
                        @if ( $user->whatsapp )
                            <img src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        @endif
                    </td> 
                </tr>
            @endif
            <tr id="emailShow">
                <td><p>{{__('ui.login')}}</p></td>
                <td><p>{{ $user->email }}</p></td>
            </tr>
            <tr id="passShow">
                <td>
                    <p>{{__('ui.password')}}</p>
                    <img id="helpImg" src="{{ asset('icons/informationIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </td>
                <td><p>&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022&#x02022</p></td>
            </tr>
        </table>
        <p class="helpText"><i>{{__('ui.passwordEncrypted')}}</i></p>
    </div>

    <a id="editBtn" href="{{ route('profile.edit') }}">{{__('ui.edit')}}</a>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            //show help image
            $("#helpImg").hover(function(){
                $(".helpText").css("opacity", "1");
                }, function(){
                $(".helpText").css("opacity", "0");
            });
        });
        
    </script>
@endsection
