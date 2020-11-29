@foreach ($posts as $post)
    <article class="item {{$post->is_active ? '' : 'inactive'}}" id="{{$post->id}}">
        <figure class="item-img">
            @auth
                <button class="{{ $post->user_id == auth()->user()->id ? 'addToFavButtonBlocked' : 'addToFavButton'}} id_{{$post->id}}">
                    <img class="{{ auth()->user()->favPosts->contains($post) ? 'active-fav-img' : '' }} addToFavImg id_{{$post->id}} img-hover-scale" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </button>
            @else
                <button class="addToFavButtonAuthBlocked">
                    <img class="addToFavImg img-hover-scale" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                </button>
            @endauth
            @if ( $post->images->isEmpty() )
                <img src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}"></li>
            @else
                <img src="{{ $post->images()->where('version', 'optimized')->first()->url }}" alt="{{__('alt.keyword')}}"></li>
            @endif
        </figure>
        <div class="item-text">
            <div class="item-lables">
                <p class="created-at">{{ $post->created_at }}</p>
                <p class="post-type">{{$post->type_readable_short}}</p>
            </div>
            <div class="item-title">
                @if ( App::getLocale() == $post->origin_lang )
                    <p>{{ $post->title }}</p>
                @else
                    <p>{{ $post->{$translated['title']} ? $post->{$translated['title']} : $post->title }}</p>
                @endif
            </div>
            <div class="item-misc">
                <p class="post-manuf-loc">{{ $post->manufacturer ? $post->manufacturer.', ' : '' }}{{ $post->region_encoded ? $post->region_readable : '' }}</p>
                <p class="post-cost">{{ $post->cost ? $post->cost_readable : '' }}</p>
            </div>
        </div>
        <a href="{{ loc_url(route('posts.show', ['post'=>$post->url_name])) }}"><span class="globalItemButton id_{{$post->id}}"></span></a>
    </article>
@endforeach