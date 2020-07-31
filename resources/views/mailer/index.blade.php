@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/mailer_show.css')}}" />
    <link rel="stylesheet" href="{{asset('css/profile_layout.css')}}" />
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
            <div class="mailerContent">
                @if ($mailer)
                    <div class="mailerBody">

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
                            
                        @if ($mailer->keywords)                            
                            <h3 class="elementHeader">{{__('ui.mailerDescription')}}:</h3>
                            <p id="description">{{$mailer->keywords}}</p>
                        @endif

                        @if ($mailer->tags)
                            <h3 class="elementHeader">{{__('ui.mailerTags')}}:</h3>
                            <ol class="orderedList">
                                @foreach ($mailer->tagsNames as $tag)
                                    <li>{{$tag}}</li>    
                                @endforeach
                            </ol>
                        @endif

                        @if ($mailer->authors)
                            <h3 class="elementHeader">{{__('ui.mailerAuthors')}}:</h3>
                            <ol class="orderedList">
                                @foreach ($mailer->authorsNames as $author)
                                    <li>{{$author}}</li>    
                                @endforeach
                            </ol>
                        @endif
                    </div>

                    <div class="mailerBtns">
                        <a id="editBtn" href="{{ route('mailer.edit') }}">{{__('ui.edit')}}</a>
                        <button type="button" id="modalMailerDeleteShow">{{__('ui.deleteMailer')}}</button>
                        <a class="mailerBtn" id="helpBtn" href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}?</a>
                    </div>
                @else
                    <div class="mailerBody">
                        <p>{{__('ui.noMailer')}}</p>
                    </div>

                    <div class="mailerBtns">
                        <a class="mailerBtn" id="editBtn" href="{{ route('mailer.create') }}">{{__('ui.setUpMailer')}}</a>
                        <a class="mailerBtn" id="helpBtn" href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}?</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($mailer)
        <div class="modalView animate" id="modalMailerDelete">
            <div class="modalContent"> 
                <p>{{__('ui.sure?')}}</p>
                <div>
                    <button type="button" class="modalCancelDelete" id="modalMailerDeleteHide">{{__('ui.no')}}</button>
                    
                    <form method="POST" action="{{ route('mailer.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <button class="modalSubmitDelete" >{{__('ui.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //static generator of unique ids for popUpMassages
            function Generator() {};
            Generator.prototype.rand = 1;
            Generator.prototype.getId = function() {return this.rand++;};
            var idGen =new Generator();

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
                    error: function() {
                        popUpMassage("{{ __('messages.error') }}");
                    }
                });
            });

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

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
