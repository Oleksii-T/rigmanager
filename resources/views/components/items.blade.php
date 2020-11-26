<section id="items">
    @foreach ($posts as $post)
        <article class="item {{$post->is_active ? '' : 'inactive'}}" id="{{$post->id}}">
            <figure class="imgWraper">
                @if ( $post->images->isEmpty() )
                    <img src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}"></li>
                @else
                    <img src="{{ $post->images()->where('version', 'optimized')->first()->url }}" alt="{{__('alt.keyword')}}"></li>
                @endif
            </figure>

            <div class="textWraper">
                @if ( App::getLocale() == $post->origin_lang )
                    <h3 class="heading4"><span class="post-type">{{$post->type==5 ? '' : $post->type_readable.': '}} </span> {{ $post->title }}</h3>
                    <p class="desc">{{ $post->description }}</p>
                @else
                    <h3 class="heading4"><span class="post-type">{{$post->type==5 ? '' : $post->type_readable.': '}} </span> {{ $post->{$translated['title']} ? $post->{$translated['title']} : $post->title }}</h3>
                    <p class="desc">{{ $post->{$translated['description']} ? $post->{$translated['description']} : $post->description }}</p>
                @endif
                <ul id="ulMisc">
                    @if ($post->region_encoded)
                        <li><p class="province misc">{{ $post->region_readable }}</p></li>
                        <li><p>&#x02022</p></li>
                    @endif
                    <li><time class="date misc" >{{ $post->created_at }}</time></li>
                    @if ($post->cost)
                        <li><p>&#x02022</p></li>
                        <li><p class="cost misc">{{ $post->cost_readable }}</p></li>
                    @endif
                </ul>
            </div>

            @if ($button == 'addToFav')
                @auth
                    <button class="{{ $post->user_id == auth()->user()->id ? 'addToFavButtonBlocked' : 'addToFavButton'}} id_{{$post->id}}">
                        <img class="{{ auth()->user()->favPosts->contains($post) ? 'active-fav-img' : '' }} addToFavImg id_{{$post->id}} img-hover-scale" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        <span><i>{{__('ui.addToFav')}}</i></span>
                    </button>
                @else
                    <button class="addToFavButtonAuthBlocked">
                        <img class="addToFavImg img-hover-scale" title="{{__('ui.addToFav')}}" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        <span><i>{{__('ui.addToFav')}}</i></span>
                    </button>
                @endauth
            @elseif ($button == 'removeFromFav')
                <button class="addToFavButton id_{{$post->id}}">
                    <img class="addToFavImg img-hover-scale" title="{{__('ui.removeFromFav')}}" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    <span><i>{{__('ui.removeFromFav')}}</i></span>
                </button>
            @elseif ($button == 'deleteAndEdit')
                <div class="item-btns id_{{$post->id}}">
                    <button class="item-btn modalPostDeleteOn id_{{$post->id}}">
                        <img class="img-hover-scale" title="{{__('ui.delete')}}" src="{{ asset('icons/deleteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    </button>

                    <a class="item-btn editBtn id_{{$post->id}}" href="{{ loc_url(route('posts.edit', ['post'=>$post->url_name])) }}">
                        <img class="img-hover-scale" title="{{__('ui.edit')}}" src="{{ asset('icons/editIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    </a>

                    <button class="item-btn item-hide-btn id_{{$post->id}}">
                        @if ($post->is_active)
                            <img class="img-hover-scale" title="{{__('ui.hide')}}" src="{{ asset('icons/hideDocIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        @else
                            <img class="img-hover-scale" title="{{__('ui.hide')}}" src="{{ asset('icons/showDocIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        @endif
                    </button>
                </div>
            @endif
            <a href="{{ loc_url(route('posts.show', ['post'=>$post->url_name])) }}"><span class="globalItemButton"></span></a>
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