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
                    @if ( $translated && $post->{$translated['title']} )
                        <h1 class="translated-title"><span class="post-type">{{$post->type_readable}}: </span>{{ $post->{$translated['title']} }}</h1>
                        <h1 class="origin-title hidden"><span class="post-type">{{$post->type_readable}}: </span>{{ $post->title }}</h1>
                        <div class="translated-alert ta-title">
                            <p class="ta-header"><img class="ta-img" src="{{ asset('icons/alertIcon.svg') }}" alt="{{__('alt.keyword')}}">{{__('ui.translationTitleAlert')}}</p>
                            <button class="ta-button title-show" title="{{__('ui.showOrigin')}}">{{__('ui.originLang')}} {{$post->origin_lang_readable}}</button>
                        </div>
                    @else
                        <h1><span class="post-type">{{$post->type_readable}}: </span>{{ $post->title }}</h1>
                    @endif
                    <div id="item-tag-section">
                        @foreach ($post->tag_map as $tagId => $tagReadable)
                            <a class="item-tag" href="{{loc_url(route('search.tag', ['category'=>$tagId]))}}">{{$tagReadable}}</a>
                            <span class="item-tag-delim">></span>
                        @endforeach
                    </div>
                    
                    @if ( $translated && $post->{$translated['description']} )
                        <p class="translated-desc">{{ $post->{$translated['description']} }}</p>
                        <p class="origin-desc hidden">{{ $post->description }}</p>
                        <div class="translated-alert ta-desc">
                            <p class="ta-header"><img class="ta-img" src="{{ asset('icons/alertIcon.svg') }}" alt="{{__('alt.keyword')}}">{{__('ui.translationDescAlert')}}</p>
                            <button class="ta-button desc-show" title="{{__('ui.showOrigin')}}">{{__('ui.originLang')}} {{$post->origin_lang_readable}}</button>
                        </div>
                    @else                    
                        <p>{{ $post->description }}</p>
                    @endif
                </section>
            </div>
        </div>
        <div id="rightContentWraper">
            <div id="rightContent">
                @auth
                    @if ($post->user_id != Auth::id())
                        <aside class="element" id="addToFavBtn">
                            @if (auth()->user()->favPosts->contains($post))
                                <p>{{__('ui.inFav')}}</p>
                                <button class="addToFavButton id_{{$post->id}}">
                                    <img src="{{ asset('icons/heartOrangeIcon.svg') }}" title="{{__('ui.removeFromFav')}}" alt="{{__('alt.keyword')}}">
                                </button> 
                            @else
                                <p>{{__('ui.addToFav')}}</p>
                                <button class="addToFavButton id_{{$post->id}}">
                                    <img src="{{ asset('icons/heartWhiteIcon.svg') }}" title="{{__('ui.addToFav')}}" alt="{{__('alt.keyword')}}">
                                </button>  
                            @endif
                        </aside>
                    @else
                        <aside class="element" id="editBtn">
                            <p>{{__('ui.yoursPost')}}</p>
                            <a class="def-button" href="{{ loc_url(route('posts.edit', ['post'=>$post->id])) }}">{{__('ui.edit')}}</a>
                        </aside>
                    @endif   
                @else
                    <aside class="element" id="addToFavBtn">
                        <p>{{__('ui.addToFav')}}</p>
                        <button class="addToFavButton id_{{$post->id}}">
                            <img src="{{ asset('icons/heartWhiteIcon.svg') }}" title="{{__('ui.addToFav')}}" alt="{{__('alt.keyword')}}">
                        </button>
                    </aside>
                @endauth

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
                    <a class="def-button" href="{{loc_url(route('search.author', ['author'=>$post->user->id]))}}">{{__('ui.otherAuthorPosts')}}</a>
                    <button class="def-button" id="modalTriger">{{__('ui.showContacts')}}</button>
                    @auth
                        @if ($post->user_id != Auth::id())
                            <button class="def-button" id="mailerAddAuthor">    
                                @if (auth()->user()->mailer && auth()->user()->mailer->authors_encoded)
                                    @if ( in_array( $post->user_id, auth()->user()->mailer->authors_encoded ) )
                                        {{__('ui.mailerRemoveAuthor')}}
                                    @else
                                        {{__('ui.mailerAddAuthor')}}
                                    @endif
                                @else
                                    {{__('ui.mailerAddAuthor')}}
                                @endif
                            </button>
                        @endif
                    @endauth
                </section>

                <aside class="element" id="role">
                    <p>{{__('ui.postRole')}}: {{ $post->role_readable }}</p>
                </aside>

                @if ($post->company)
                    <aside class="element" id="company">
                        <p>{{__('ui.company')}}: {{ $post->company }}</p>
                    </aside>
                @endif

                @if ($post->condition)
                    <aside class="element" id="status">
                        <p>{{__('ui.condition')}}: {{ $post->condition_readable }}</p>
                    </aside>
                @endif

                @if ($post->manufacturer)
                    <aside class="element" id="manufacturer">
                        <p>{{__('ui.manufacturer')}}: {{ $post->manufacturer }}</p>
                    </aside>
                @endif

                @if ($post->manufactured_date)
                    <aside class="element" id="manufacturedDate">
                        <p>{{__('ui.manufacturedDate')}}: {{ $post->manufactured_date }}</p>
                    </aside>
                @endif

                @if ($post->part_number)
                    <aside class="element" id="partNumber">
                        <p>{{__('ui.partNumber')}}: {{ $post->part_number }}</p>
                    </aside>
                @endif

                @if ($post->region_encoded)
                    <aside class="element" id="region">
                        <p>{{__('ui.location')}}: {{ $post->region_readable}}{{ $post->town ? ", ".$post->town : "" }}</p>
                    </aside>
                @endif

                @if ($post->cost)
                    <aside class="element" id="cost">
                        <div>
                            <p>{{__('ui.cost')}}: {{ $post->cost_readable }} </p>
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

            $('.title-show').click(function(){
                $('.origin-title').removeClass('hidden');
                $('.translated-title').addClass('hidden');
                $('.translated-alert.ta-title').addClass('hidden');
            });

            $('.desc-show').click(function(){
                $('.origin-desc').removeClass('hidden');
                $('.translated-desc').addClass('hidden');
                $('.translated-alert.ta-desc').addClass('hidden');
            });

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
                    url: "{{ route('mailer.toggle.author', $post->user_id) }}",
                    success: function(data) {
                        if (data == 1) {
                            // Author was added to Mailer
                            showPopUpMassage(true, "{{ __('messages.mailerAddedAuthor') }}");
                            $('#mailerAddAuthor').html("{{__('ui.mailerRemoveAuthor')}}");
                        } else if (data == 0) {
                            // Author was removed from Mailer
                            showPopUpMassage(true, "{{ __('messages.mailerRemovedAuthor') }}");
                            $('#mailerAddAuthor').html("{{__('ui.mailerAddAuthor')}}");
                        } else {
                            // Error, too many authors
                            showPopUpMassage(false, "{{ __('messages.mailerTooManyAuthors') }}");
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
                    error: function(xhr, status, error) {
                        xhr['status'] == 403
                            ? showPopUpMassage(false, "{{ __('messages.authError') }}")
                            : showPopUpMassage(false, "{{ __('messages.error') }}");
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
                        target.attr("title", "{{__('ui.removeFromFav')}}");
                        $('#addToFavBtn p').html('{{__('ui.inFav')}}');
                        showPopUpMassage(true, "{{ __('messages.postAddedFav') }}");
                    }   else {
                        $("#favItemsTab span").html(n-1);
                        target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                        target.attr("title", "{{__('ui.addToFav')}}");
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
                    error: function(xhr, status, error) {
                        xhr['status'] == 403
                            ? showPopUpMassage(false, "{{ __('messages.authError') }}")
                            : showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            });

            function fillUpContacts (data) {
                var contacts = JSON.parse(data);
                contacts['email'] 
                    ? $('span.emailField').text(contacts['email']) 
                    : $('span.emailField').text("{{__('ui.notSpecified')}}");
                contacts['phone']
                    ? $('li.phoneField span').text(contacts['phone'])
                    : $('li.phoneField span').text("{{__('ui.notSpecified')}}");
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
