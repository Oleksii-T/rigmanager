@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/item.css')}}" />
@endsection

@section('content')
    <div id="itemWraper">
        <div id="leftContentWraper">
            <div id="leftContent">
                @if ( $post->images->isNotEmpty() )
                    <div class="element" id="mainImgWraper">
                        <a target="_blank" href="{{ $post->images->where('version', 'origin')->first()->url }}">
                            <img id="mainImg" src="{{ $post->images->where('version', 'origin')->first()->url }}" alt="{{__('alt.keyword')}}">
                        </a>
                    </div>

                    <div class="element" id="otherImg">
                        @foreach ($post->images->where('version', 'optimized') as $image)
                            <div class="moreImg">
                                <img class="imgTriger" src="{{ $image->url }}" alt="{{__('alt.keyword')}}">
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="element" id="mainInfo">
                    <h1>{{ $post->title }}</h1>
                    <div>
                        @foreach ($tagsArray as $id => $tag)
                            <button class="itemTag" id="{{$id}}">{{$tag}}</button>
                        @endforeach
                    </div>
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>
        
        <div id="rightContentWraper">
            <div id="rightContent">
                @if ($post->user_id != Auth::id())
                    <div class="element" id="addToFavBtn">
                        @if ($isFav === false)
                            <p>{{__('ui.addToFav')}}</p>
                            <button class="addToFavButton id_{{$post->id}}">
                                <img src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            </button>   
                        @else
                            <p>{{__('ui.inFav')}}</p>
                            <button class="addToFavButton id_{{$post->id}}">
                                <img src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
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
                    <a href="{{route('searchAuthor', $post->user->id)}}">{{__('ui.otherAuthorPosts')}}</a>
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
        </div>

        <div class="modalView" id="modal">
            <div class="modalContent"> 
                <h1>{{__('ui.contactInfo')}}:</h1>
                <ul>
                    @if ($post->user_email)
                        <li>{{__('ui.email')}}: <span>{{ $post->user_email }}</span></li>
                    @else
                        <li>{{__('ui.email')}}: <span>{{__('ui.empty')}}.</span></li>
                    @endif
                    @if ($post->user_phone)
                        <li>
                            {{__('ui.phone')}}:  <span>{{ $post->user_phone }}</span>
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

            //add active effect in nav bar
            if ( '{{Auth::id()}}' == '{{$post->user_id}}' ) {
                $('#myItemsTab').addClass('isActiveBtn');
            }

            //static generator of unique ids for popUp massages
            function Generator() {};
            Generator.prototype.rand =  0;
            Generator.prototype.getId = function() {return this.rand++;};
            var idGen =new Generator();

            //redirect to search result of clicked tag
            $('.itemTag').click(function(){
                var tag = $(this).text();
                window.location.href = "#?targetTag="+tag;
            });

            //search for clicked category 
            $('#mainInfo button').click(function(){
                var id = $(this).attr('id');
                var url = '{{ route("searchTag", ":id") }}';
                url = url.replace(':id', id);
                window.location.href=url;
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

            //action when user clicks on addToFav icon
            $(".addToFavButton").click(function(){
                $(".id_"+item_id).attr('disabled', true); //disable button until feedback
                $(document.body).css('cursor', 'wait');
                var item_id = $(this).attr("class").split(' ')[1].split('_')[1];
                $.ajax({
                    type: "GET",
                    url: '{{ route('toFav') }}',
                    data: { post_id: item_id },
                    success: function(data) {
                        confirmation(data, item_id);
                    }
                });
            });

            //paint addToFav btn into red and incr/decr number of  favItems if succes
            function confirmation(data, item_id) {
                if ( data ) {
                    var target = $(".id_"+item_id+" img");
                    var n = $("#favItemsTab span").text();
                    n = parseInt(n,10);
                    if ( target.attr("src") != "{{ asset('icons/heartOrangeIcon.svg') }}" ) {
                        $("#favItemsTab span").html(n+1);
                        target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                        $('#addToFavBtn p').html('{{__('ui.inFav')}}');
                        popUpMassage("{{ __('messages.postAddedFav') }}");
                    }   else {
                        $("#favItemsTab span").html(n-1);
                        target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                        $('#addToFavBtn p').html('{{__('ui.addToFav')}}');
                        popUpMassage("{{ __('messages.postRemovedFav') }}");
                    }
                } else {
                    popUpMassage("{{ __('messages.postAddFavError') }}");
                }
                $(document.body).css('cursor', 'default');
                $(".id_"+item_id).attr('disabled', false);
            }

            //show modal contacts 
            $('#modalTriger').click(function(){
                $('.modalView').css("display", "block");
            });

            //change main image to clicked image from gallery
            $(".imgTriger").click(function(){
                var smallUrl = $(this).attr('src');
                var url = smallUrl.replace('optimized', 'origin');
                $("#mainImgWraper img").attr("src",url);
                $("#mainImgWraper a").attr("href",url);
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
