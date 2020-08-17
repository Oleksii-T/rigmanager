<section id="items">
    @foreach ($posts as $post)
        <article class="item id_{{ $post->id }}">
            <figure class="imgWraper">
                @if ( $post->images->isEmpty() )
                    <img src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}"></li>
                @else    
                    <img src="{{ $post->images()->where('version', 'optimized')->first()->url }}" alt="{{__('alt.keyword')}}"></li>
                @endif
            </figure>
            
            <div class="textWraper">
                <h3 class="heading4">{{ $post->title }}</h3>
                <p class="desc">{{ $post->description }}</p>
                <ul id="ulMisc">
                    @if ($post->location)
                        <li><p class="location misc">{{ $post->location }}</p></li>
                        <li><p>s &#x02022</p></li>
                    @endif
                    <li><time class="date misc" >{{ $post->created_at }}</time></li>
                    @if ($post->cost)
                        <li><p>&#x02022</p></li>
                        <li><p class="cost misc">{{ $post->cost }}</p></li>
                    @endif
                </ul>
            </div>

                     
            @if ($button == 'addToFav')
                <button class="{{ $post->user_id == Auth::id() ? 'addToFavButtonBlocked' : 'addToFavButton'}} id_{{ $post->id }}">
                    @if ( auth()->user() && $post->favOfUser->where('id', Auth::id())->isNotEmpty() )
                        <img class="addToFavImg" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    @else
                        <img class="addToFavImg" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    @endif
                    <span><i>{{__('ui.addToFav')}}</i></span>
                </button>
            @elseif ($button == 'removeFromFav')
                <button class="addToFavButton id_{{ $post->id }}">
                    <img class="addToFavImg" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    <span><i>{{__('ui.removeFromFav')}}</i></span>
                </button>
            @elseif ($button == 'deleteAndEdit')
                <button class="modalPostDeleteOn" id="{{$post->id}}">
                    <img src="{{ asset('icons/deleteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </button>

                <a class="editBtn" id="{{$post->id}}" href="{{ route('posts.edit', $post->id) }}">
                    <img title="{{__('ui.edit')}}" src="{{ asset('icons/editIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </a>
            @endif

            <a href="{{ route('posts.show', $post->id) }}"><span class="globalItemButton item_id_{{$post->id}}"></span></a>
        </article>

        @if ($button == 'deleteAndEdit')
            <div class="modalView animate" id="modalPostDelete">
                <div class="modalContent"> 
                    <p>{{__('ui.sure?')}}</p>
                    <div>
                        <button type="button" id="modalPostDeleteOff">{{__('ui.no')}}</button>
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button>{{__('ui.delete')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</section>