@foreach ($posts as $post)
    <div class="ad-col id_{{$post->id}}">
        <div class="ad-item">
            <div class="ad-img">
                <a href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}"><img src="{{$post->preview_image}}" alt=""></a>
                @auth
                    <a href="" class="catalog-fav add-to-fav {{$post->user_id == auth()->user()->id ? 'block' : ''}} id_{{$post->id}} {{auth()->user()->favPosts->contains($post) ? 'active' : ''}}">
                        <svg viewBox="0 0 464 424" xmlns="http://www.w3.org/2000/svg" class="">
                            <path class="cls-1" d="M340,0A123.88,123.88,0,0,0,232,63.2,123.88,123.88,0,0,0,124,0C55.52,0,0,63.52,0,132,0,304,232,424,232,424S464,304,464,132C464,63.52,408.48,0,340,0Z"/>
                        </svg>
                    </a>
                @else
                    <a href="" class="catalog-fav add-to-fav auth-block">
                        <svg viewBox="0 0 464 424" xmlns="http://www.w3.org/2000/svg">
                            <path class="cls-1" d="M340,0A123.88,123.88,0,0,0,232,63.2,123.88,123.88,0,0,0,124,0C55.52,0,0,63.52,0,132,0,304,232,424,232,424S464,304,464,132C464,63.52,408.48,0,340,0Z"/>
                        </svg>
                    </a>
                @endauth
            </div>
            <div class="ad-line">
                <div class="ad-date">{{ $post->created_at_readable }}</div>
                <a href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}" class="ad-tag">{{$post->type_readable_short}}</a>
            </div>
            <div class="ad-title"><a href="{{loc_url(route('posts.show', ['post'=>$post->url_name]))}}">{{ $post->title_localed }}</a></div>
            @if ($post->region_encoded)
                <div class="ad-region">{{$post->region_readable}}</div>
            @endif
            @if ($post->is_import)
                <div class="ad-import">
                    {{__('ui.import')}}
                </div>
            @endif
            <div class="ad-price">{{ $post->cost ? $post->cost_readable : '' }}</div>
        </div>
    </div>
@endforeach