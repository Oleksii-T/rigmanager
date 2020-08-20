@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post_show.css')}}" />
@endsection

@section('content')
    <article id="itemWraper">
        <div id="leftContentWraper">
            <div id="leftContent">
                @if ( $post->images->isNotEmpty() )
                    <figure class="element" id="mainImgWraper">
                        <a target="_blank" href="{{ $post->images->where('version', 'origin')->first()->url }}">
                            <img id="mainImg" src="{{ $post->images->where('version', 'origin')->first()->url }}" alt="{{__('alt.keyword')}}">
                        </a>
                    </figure>

                    <figure class="element" id="otherImg">
                        @foreach ($post->images->where('version', 'optimized') as $image)
                            <div class="moreImg">
                                <img class="imgTriger" src="{{ $image->url }}" alt="{{__('alt.keyword')}}">
                            </div>
                        @endforeach
                    </figure>
                @endif
                <section class="element" id="mainInfo">
                    <h1>{{ $post->title }}</h1>
                    <div id="item-tag-section">
                        @foreach ($tagsArray as $tagId => $tagReadable)
                            <a class="item-tag" href="{{route('search.tag', $tagId)}}">{{$tagReadable}}</a>
                            <span class="item-tag-delim">></span>
                        @endforeach
                    </div>
                    <p>{{ $post->description }}</p>
                </section>
            </div>
        </div>
        
        <div id="rightContentWraper">
            <div id="rightContent">
                @if ($post->user_id != Auth::id())
                    <aside class="element" id="addToFavBtn">
                        @if (auth()->user()->favPosts->contains($post))
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
                    </aside>
                @else
                    <aside class="element" id="editBtn">
                        <p>{{__('ui.yoursPost')}}</p>
                        <a class="def-button" href="{{ route('posts.edit', $post->id) }}">{{__('ui.edit')}}</a>
                    </aside>
                @endif

                <section class="element" id="authorView">
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
                    <a class="def-button" href="{{route('search.author', $post->user->id)}}">{{__('ui.otherAuthorPosts')}}</a>
                    <button class="def-button" id="modalTriger">{{__('ui.showContacts')}}</button>
                    @if ($post->user_id != Auth::id())
                        <button class="def-button" id="mailerAddAuthor">    
                            @if (auth()->user()->mailer)
                                @if ( in_array( $post->user_id, explode(" ", auth()->user()->mailer->authors) ) )
                                    {{__('ui.mailerRemoveAuthor')}}
                                @else
                                    {{__('ui.mailerAddAuthor')}}
                                @endif
                            @else
                                {{__('ui.mailerAddAuthor')}}
                            @endif
                        </button>
                    @endif
                </section>

                <aside class="element" id="status">
                    <p>{{__('ui.condition')}}: {{ $post->condition }}</p>
                </aside>

                @if ($post->location)
                    <aside class="element" id="location">
                        <p>{{__('ui.location')}}: {{ $post->location }}</p>
                    </aside>
                @endif

                @if ($post->cost)
                    <aside class="element" id="cost">
                        <div>
                            <p>{{__('ui.cost')}}: {{ $post->cost }} </p>
                        </div>
                    </aside>
                @endif

                <aside class="element" id="createdOn">
                    <time>{{__('ui.postCreated')}}: {{ $post->created_at }} </time>
                </aside>
            </div>
        </div>

        <div class="modalView" id="modal">
            <address class="modalContent"> 
                <h1>{{__('ui.contactInfo')}}:</h1>

                <ul>
                    <li>
                        <p>{{__('ui.email')}}:</p>
                        <span class="emailField"></span>
                    </li>
                    <li class="phoneField">
                        <p>{{__('ui.phone')}}: </p>
                        <span></span>
                    </li>
                </ul>
            </address>
        </div>
    </article>

@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function() {

            //get digit from classes of DOM element (depends on prefix)
            function getIdFromClasses(classes, prefix) {
                // regex special chars does not escaped in prefix!!!
                var reg = new RegExp("^"+prefix+"[0-9]+$", 'g');
                var result = '';
                classes.split(' ').every(function(string){
                    result = reg.exec(string);
                    if ( result != null ) {
                        result = result + '';
                        result = result.split('_')[1];
                        return false;
                    } else {
                        return true;
                    }
                });
                return result;
            }

            //add active effect in nav bar
            if ( '{{Auth::id()}}' == '{{$post->user_id}}' ) {
                $('#myItemsTab').addClass('isActiveBtn');
            }

            //remove last '>' symbol from searched tags
            $('#item-tag-section span').last().remove();

            // user click add author to mailer btn
            $('#mailerAddAuthor').click(function() {
                var button = $(this);
                button.addClass('loading');
                $.ajax({
                    type: "GET",
                    url: "{{ route('mailer.add.remove.author', $post->user_id) }}",
                    success: function(data) {
                        if (data) {
                            // Author was added to Mailer
                            showPopUpMassage(true, "{{ __('messages.mailerAddedAuthor') }}");
                            $('#mailerAddAuthor').html("{{__('ui.mailerRemoveAuthor')}}");
                        } else {
                            // Author was removed from Mailer
                            showPopUpMassage(true, "{{ __('messages.mailerRemovedAuthor') }}");
                            $('#mailerAddAuthor').html("{{__('ui.mailerAddAuthor')}}");
                        }
                        button.removeClass('loading');
                    },
                    error: function() {
                        // Print error massage
                        button.removeClass('loading');
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });

            //action when user clicks on addToFav icon
            $(".addToFavButton").click(function(){
                var postId = getIdFromClasses($(this).attr("class"), 'id_');
                var button = $(this);
                button.addClass('loading');
                $.ajax({
                    type: "GET",
                    url: "{{ route('toFav') }}",
                    data: { post_id: postId },
                    success: function(data) {
                        confirmation(data, postId);
                        button.removeClass('loading');
                    },
                    error: function() {
                        // Print error massage
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            });

            //change addToFav btn color and incr/decr number of favItems if succes
            function confirmation(data, postId) {
                if ( data ) {
                    var target = $(".id_"+postId+" img");
                    var n = $("#favItemsTab span").text();
                    n = parseInt(n,10);
                    if ( target.attr("src") != "{{ asset('icons/heartOrangeIcon.svg') }}" ) {
                        $("#favItemsTab span").html(n+1);
                        target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                        $('#addToFavBtn p').html('{{__('ui.inFav')}}');
                        showPopUpMassage(true, "{{ __('messages.postAddedFav') }}");
                    }   else {
                        $("#favItemsTab span").html(n-1);
                        target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                        $('#addToFavBtn p').html('{{__('ui.addToFav')}}');
                        showPopUpMassage(true, "{{ __('messages.postRemovedFav') }}");
                    }
                } else {
                    showPopUpMassage(false, "{{ __('messages.postAddFavError') }}");
                }
            }

            //show modal contacts 
            $('#modalTriger').click(function(){
                var button = $(this);
                button.addClass('loading');
                $.ajax({
                    type: "GET",
                    url: "{{ route('get.contacts', $post->id) }}",
                    success: function(data) {
                        if ( data ) {
                            fillUpContacts(data);
                            $('.modalView').css("display", "block");
                        } else {
                            showPopUpMassage(false, "{{ __('messages.error') }}");
                            isSubscribed();
                        }
                        button.removeClass('loading');
                    },
                    error: function() {
                        // Print error massage
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
                
            });

            function fillUpContacts (data) {
                var contacts = JSON.parse(data);
                $('span.emailField').text(contacts['email']);
                $('li.phoneField span').text(contacts['phone']);
                if (contacts['viber']) {
                    $('li.phoneField').append("<img src='{{ asset('icons/viberIcon.svg') }}' alt='{{__('alt.keyword')}}'>");
                }
                if (contacts['telegram']) {
                    $('li.phoneField').append("<img src='{{ asset('icons/telegramIcon.svg') }}' alt='{{__('alt.keyword')}}'>");
                }
                if (contacts['whatsapp']) {
                    $('li.phoneField').append("<img src='{{ asset('icons/whatsappIcon.svg') }}' alt='{{__('alt.keyword')}}'>");
                }
            }

            // check is use subscribed to plan, if not sujjest to do so
            function isSubscribed() {
                // TO DO
            }

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
                    $('.emailField').text('');
                    $('.phoneField span').text('');
                    $('.phoneField img').remove();
                }
            }
            
        });
        
    </script>
@endsection
