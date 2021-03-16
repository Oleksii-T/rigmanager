@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.post.favs')}}</title>
	<meta name="description" content="{{__('meta.description.user.post.favs')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{__('ui.favourites')}}</span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='fav'/>
        <div class="content">
            <h1>{{__('ui.favourites')}} (<span class="orange">{{$posts_list->total()}}</span>)</h1>
            @if ($posts_list->count() == 0)
                <p>{{__('ui.noFavPosts')}}</p>
            @else
                <div class="cabinet-line">
                    <div class="cabinet-search">
                        <form method="GET" action="{{loc_url(route('profile.favourites'))}}">
                            <fieldset>
                                <input type="text" name="text" class="input" value="{{$searchValue}}" placeholder="{{__('ui.search')}}">
                                <button class="search-button"></button>
                            </fieldset>
                        </form>
                    </div>
                    <!--
                    <div class="cabinet-line-right">
                        <a href="" class="cabinet-line-link">{{__('ui.deleteAllPosts')}}</a>
                    </div>
                    -->
                </div>
                <div class="ad-list">
                    <x-items :posts="$posts_list" type='list'/>
                </div>
                <div class="pagination-field">
                    {{ $posts_list->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // hide removed post (called from master function)
        function removeFromFav(postId) {
            $('div.ad-col.id_'+postId).addClass('hidden');
            $('div.content h1 span').html($('div.content h1 span').html()-1);
        }
        $(document).ready(function(){
        });
    </script>
@endsection