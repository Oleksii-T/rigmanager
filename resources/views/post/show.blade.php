@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/item.css')}}" />
@endsection

@section('content')
    <div id="itemWraper">
        <div id="leftContent">
            @if ( !$post->images->isEmpty() )
                <div class="element" id="mainImgWraper">
                    <a target="_blank" href="{{ asset('icons/noImageIcon.svg') }}">
                        <img id="mainImg" src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    </a>
                </div>

                <div class="element" id="otherImg">
                    @foreach ($post->images as $image)
                        <div class="moreImg">
                            <img class="imgTriger" src="{{ $image->url }}" alt="{{__('alt.keyword')}}">
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="element" id="mainInfo">
                <h1>{{ $post->title }}</h1>
                <p id="allTags" hidden >{{ $post->tag }}</p>
                <p>{{ $post->description }}</p>
            </div>
        </div>

        <div id="misc">
            @if ($post->user_id != Auth::id())
                <div class="element" id="addToFavBtn">
                    @if ($isFav)
                        <p>{{__('ui.inFav')}}</p>
                        <button class="addToFavButton id_{{$post->id}}">
                            <img src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </button>
                    @else
                        <p>{{__('ui.addToFav')}}</p>
                        <button class="addToFavButton id_{{$post->id}}">
                            <img src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </button>
                    @endif
                </div>
            @else
                <div class="element" id="editBtn">
                    <p>{{__('ui.yoursPost')}}</p>
                    <a href="{{ route('posts.edit', $post->id) }}">{{__('ui.edit')}}</a>
                </div>
            @endif

            <div class="element" id="authorView">
                <h4>{{__('ui.postAuthor')}}</h4>
                <div id="authorInfo">
                    @if ($post->user->image)
                        <img src="{{ $post->user->image->url }}" alt="{{__('alt.keyword')}}">
                    @else
                        <img src="{{ asset('icons/emptyUserIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    @endif
                    <div>
                        <p>{{ $post->user->name }}</p>
                    </div>
                    <!-- mb add time how many days registered -->
                </div>
                <a href="#">{{__('ui.otherAuthorPosts')}}</a>
                <button id="modalTriger">{{__('ui.showContacts')}}</button>
            </div>

            <div class="element" id="status">
                <p>{{__('ui.condition')}}: {{ $post->condition }}</p>
            </div>

            @if ($post->location)
                <div class="element" id="location">
                    <p>{{__('ui.location')}}: {{ $post->location }}</p>
                </div>
            @endif

            @if ($post->cost)
                <div class="element" id="cost">
                    <div>
                        <p>{{__('ui.cost')}}: {{ $post->cost }} </p>
                    </div>
                </div>
            @endif

            <div class="element" id="createdOn">
                <p>{{__('ui.postCreated')}}: {{ $post->created_at }} </p>
            </div>

        </div>

        <div class="modalView animate" id="modal">
            <div class="modalContent"> 
                <h1>{{__('ui.contactInfo')}}:</h1>
                <ul>
                    @if ($post->user_email)
                        <li>{{__('ui.email')}}: {{ $post->user_email }}</li>
                    @else
                        <li>{{__('ui.email')}}: {{__('ui.empty')}}.</li>
                    @endif
                    @if ($post->user_phone)
                        <li>
                            {{__('ui.phone')}}:  {{ $post->user_phone }}
                            @if ( $post->viber )
                                <img src="{{ asset('icons/viberIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                            @if ( $post->telegram )
                                <img src="{{ asset('icons/telegramIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                            @if ( $post->whatsapp )
                                <img src="{{ asset('icons/whatsappIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                        </li>
                    @else
                        <li>{{__('ui.phone')}}: {{__('ui.empty')}}.</li>
                    @endif
                </ul>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function() {

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            //put first image from images preview field to big preview field
            var url = $('#otherImg > div img').attr('src');
            $('#mainImgWraper a').attr('href', url);
            $('#mainImgWraper a img').attr('src', url);

            //add active effect in nav bar
            if ( '{{Auth::id()}}' == '{{$post->user_id}}' ) {
                $('#myItemsTab').addClass('isActiveBtn');
            }

            //for each item tag make button
            var allTags = $('#allTags').text().split(',');
            allTags.forEach(displayTagBtn);

            //static generator of unique ids for popUp massages
            function Generator() {};
            Generator.prototype.rand =  0;
            Generator.prototype.getId = function() {return this.rand++;};
            var idGen =new Generator();

            //make button for tag
            function displayTagBtn (tag, index) {
                $('#mainInfo div').append('<button class="itemTag">'+tag+'</button>');
            }

            //redirect to search result of clicked tag
            $('.itemTag').click(function(){
                var tag = $(this).text();
                window.location.href = "#?targetTag="+tag;
            });

            //show popup massage
            function popUpMassage (text) {
                var uniqueId = "num" + idGen.getId();
                $('#container').append('<div class="popUp" id="'+uniqueId+'"><p>'+text+'</p></div>');
                $('#'+uniqueId).addClass('popUpShow');
                $('#'+uniqueId).click(function(){ $(this).removeClass('popUpShow') });
                setTimeout(function(){
                    $('#'+uniqueId).removeClass('popUpShow');
                }, 3000);
            }

            //action when clicked on addToFav btn
            $(".addToFavButton").click(function(){
                var id = $(this).attr("class").split(' ')[1].split('_')[1];
                $(".id_"+id).attr('disabled', true); //disable button antill db gives feedback
                $.ajax({
                    type: "POST",
                    url: "/profile/fav",
                    data: { id: id },
                    success: function(data) {
                        confirmation(data, id);
                    }
                });
            });

            //visual confirmation that item was added to FavList
            function confirmation(data, id) {
                if ( !data.includes("Произошла ошибка.") ) {
                    var target = $(".id_"+id+" img");
                    var n = $("#favIcon span").text();
                    n = parseInt(n,10);
                    if ( target.attr("src") != "{{ asset('icons/heartOrangeIcon.svg') }}" ) {
                        $("#favIcon span").html(n+1);
                        target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                    }   else {
                        $("#favIcon span").html(n-1);
                        target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                    }
                }
                $(".id_"+id).attr('disabled', false);
                popUpMassage(data);
            }

            //show modal contacts 
            $('#modalTriger').click(function(){
                $('.modalView').css("display", "block");
            });

            //change main image to clicked image from gallery
            $(".imgTriger").click(function(){
                var img_path = $(this).attr("src");
                $("#mainImgWraper img").attr("src",img_path)
            });

            //close modal if clicked beyong the modal
            window.onclick = function(event) {
                var modal = document.getElementById("modal");
                if (event.target == modal) {
                    $('#modal').css("display", "none");
                }
            }

        });
    </script>
@endsection
