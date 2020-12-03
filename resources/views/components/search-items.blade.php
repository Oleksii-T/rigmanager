<section id="items">
    @foreach ($posts as $post)
        <article class="item {{$post->is_active ? '' : 'inactive'}}" id="{{$post->id}}">
            <figure class="post-img">
                @if ( $post->images->isEmpty() )
                    <img src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}"></li>
                @else
                    <img src="{{ $post->images()->where('version', 'optimized')->first()->url }}" alt="{{__('alt.keyword')}}"></li>
                @endif
            </figure>
            <div class="post-text">
                <div class="post-row post-row-1">
                    <div class="post-title">
                        @if ( App::getLocale() == $post->origin_lang )
                            <p>{{ $post->title }}</p>
                        @else
                            <p>{{ $post->{$translated['title']} ? $post->{$translated['title']} : $post->title }}</p>
                        @endif
                    </div>
                    @auth
                        <div class="post-fav {{$post->user_id == auth()->user()->id ? 'blocked' : ''}} id_{{$post->id}}">
                            @if (auth()->user()->favPosts->contains($post))
                                <img class="post-fav-img active-fav-img id_{{$post->id}}" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @else
                                <img class="post-fav-img id_{{$post->id}}" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                            @endif
                        </div>
                    @else
                        <div class="post-fav blocked">
                            <img class="post-fav-img" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        </div>
                    @endauth
                </div>
                <div class="post-row post-row-2">
                    <div class="left-lables">
                        <span class="post-type">{{$post->type_readable}}</span>
                        @if ($post->region_encoded)
                            <span class="post-location">{{ $post->region_readable }}{{$post->town ? ', '.$post->town : ''}}</span>
                        @endif
                    </div>
                    <div class="right-labels">
                        <span class="post-date">{{ $post->created_at }}</span>
                    </div>
                </div>
                <div class="post-row post-row-3">
                    @if ( App::getLocale() == $post->origin_lang )
                        <p class="post-description">{{ $post->description }}</p>
                    @else
                        <p class="post-description">{{ $post->{$translated['description']} ? $post->{$translated['description']} : $post->description }}</p>
                    @endif
                </div>
                @if ($post->cost)
                    <span class="post-cost">{{ $post->cost_readable }}</span>
                @endif
                <a class="post-link {{'id_'.$post->id}}" href="{{ loc_url(route('posts.show', ['post'=>$post->url_name])) }}"></a>
            </div>
        </article>
    @endforeach
</section>