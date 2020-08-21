<section id="items">
    @foreach ($posts as $post)
        <article class="item" id="{{$post->id}}">
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
                <button class="{{ $post->user_id == auth()->user()->id ? 'addToFavButtonBlocked' : 'addToFavButton'}} id_{{$post->id}}">
                    <img class="{{ auth()->user()->favPosts->contains($post) ? 'active-fav-img' : '' }} addToFavImg id_{{$post->id}} img-hover-scale" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    <span><i>{{__('ui.addToFav')}}</i></span>
                </button>
            @elseif ($button == 'removeFromFav')
                <button class="addToFavButton id_{{$post->id}}">
                    <img class="addToFavImg img-hover-scale" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    <span><i>{{__('ui.removeFromFav')}}</i></span>
                </button>
            @elseif ($button == 'deleteAndEdit')
                <button class="modalPostDeleteOn id_{{$post->id}}">
                    <img class="img-hover-scale" src="{{ asset('icons/deleteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </button>

                <a class="editBtn id_{{$post->id}}" href="{{ route('posts.edit', $post->id) }}">
                    <img class="img-hover-scale" title="{{__('ui.edit')}}" src="{{ asset('icons/editIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </a>
            @endif

            <a href="{{ route('posts.show', $post->id) }}"><span class="globalItemButton"></span></a>
        </article>
    @endforeach

    @if ($button == 'deleteAndEdit')
        <div class="modalView animate" id="modalPostDelete">
            <div class="modalContent"> 
                <p>{{__('ui.sure?')}}</p>
                <div>
                    <button class="def-button submit-button" type="button" id="modalPostDeleteOff">{{__('ui.no')}}</button>
                    <button class="def-button cancel-button modalSubmitButton">{{__('ui.delete')}}</button>
                </div>
            </div>
        </div>
    @endif
</section>