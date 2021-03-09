@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        @if ($searchValue || $resByTag['searchedTagMap'])
            <a itemprop="item" href="{{loc_url(route('profile.posts'))}}"><span itemprop="name">{{__('ui.myPosts')}}</span></a>
        @else
            <span itemprop="item"><span itemprop="name">{{__('ui.myPosts')}}</span></span>
        @endif
        <meta itemprop="position" content="2" />
    </li>
    @if ($searchValue)
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('profile.posts', ['text'=>$searchValue]))}}"><span itemprop="name">"{{$searchValue}}"</span></a>
            <meta itemprop="position" content="2" />
        </li>
    @endif
    @if ($resByTag && $resByTag['searchedTagMap'])
        @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">    
                @if ($loop->last)
                    <span itemprop="item"><span itemprop="name">{{$tag}}</span></span>
                @else
                    <a itemprop="item" href="{{loc_url(route('profile.posts', ['tag'=>$tagUrl]))}}"><span itemprop="name">{{$tag}}</span></a>
                @endif
                <meta itemprop="position" content="{{$loop->index+3}}" />
            </li>
        @endforeach
    @endif  
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='posts'/>
        <div class="content">
            <h1>{{__('ui.myPosts')}} (<span class="orange">{{$posts_list->total()}}</span>)</h1>
            @if ($posts_list->count() == 0 && !$searchValue)
                <p>{{__('ui.noMyPosts')}}</p>
            @else
                <div class="cabinet-line">
                    <div class="cabinet-search">
                        <form  method="GET" action="{{loc_url(route('profile.posts'))}}">
                            <fieldset>
                                @if ($resByTag && $resByTag['searchedTagMap'])
                                    <input type="text" name="tag" value="{{array_key_last($resByTag['searchedTagMap'])}}" hidden>
                                @endif
                                <input type="text" class="input" placeholder="{{__('ui.search')}}" name="text" value="{{$searchValue}}">
                                <button class="search-button"></button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="select-block">
                        <select class="styled" name="sorting">
                            <option value="2" >{{__('ui.sortNew')}}</option>
                            <option value="3" {{$sort==3 ? 'selected' : ''}}>{{__('ui.sortCheap')}}</option>
                            <option value="4" {{$sort==4 ? 'selected' : ''}}>{{__('ui.sortExpensive')}}</option>
                            <option value="5" {{$sort==5 ? 'selected' : ''}}>{{__('ui.sortViews')}}</option>
                        </select>
                    </div>
                    <div class="cabinet-line-right">
                        <a href="#popup-delete-all-posts" data-fancybox class="cabinet-line-link">{{__('ui.deleteAllPosts')}}</a>
                    </div>
                </div>
                @if ($resByTag && $resByTag['map'])
                    <div class="sorting">
                        @foreach ($resByTag['map'] as $tagId => $tag)
                            <div class="sorting-col">
                                @if ($searchValue)
                                    <a href="{{loc_url(route('profile.posts', ['text'=>$searchValue,'tag'=>$tag['url']]))}}" class="sorting-item">{{$tag['name']}} <span class="sorting-num">{{$tag['amount']}}</span></a>
                                @else
                                    <a href="{{loc_url(route('profile.posts', ['tag'=>$tag['url']]))}}" class="sorting-item">{{$tag['name']}} <span class="sorting-num">{{$tag['amount']}}</span></a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($posts_list->count()==0)
                    <p>{{__('ui.noMyPostsBySearch')}}</p>
                @else
                    <div class="catalog catalog-my">
                        <x-items :posts="$posts_list" type='profile.posts'/>
                    </div>
                    <div class="pagination-field">
                        {{ $posts_list->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('modals')
    <div id="popup-delete-all-posts" class="popup">
        <div class="popup-title">{{__('ui.sure?')}}</div>
        <div class="sure-dialog">
            <form method="POST" action="{{route('posts.delete')}}">
                @csrf
                @method('DELETE')
                <button type="submit">{{__('ui.deleteAllPosts')}}</button>
            </form>
        </div>
    </div>
    <div id="popup-delete-post" class="popup">
        <div class="popup-title">{{__('ui.sure?')}}</div>
        <div class="sure-dialog">
            <a href="#" class="delete-post">{{__('ui.deletePost')}}</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //replace char in string
            String.prototype.replaceAt = function(index, replacement) {
                console.log('repalce on index {'+index+'}');
                if (index >= this.length || index<0) {
                    console.log('no index. return {'+this.valueOf()+'}');
                    return this.valueOf();
                }
                index += 5;
                return this.substring(0, index) + replacement + this.substring(index + 1);
            }

            //redirect wehen selected other sorting
            var currUrl = window.location.href;
            $('select[name=sorting]').selectmenu({
                change: function (event, ui) {
                    $('.ui-selectmenu-menu *').addClass('loading');
                    var sort = $(this).find('option:selected').val();
                    if (currUrl.includes('?')) {
                        if (currUrl.indexOf('sort=') == -1) {
                            newUrl = currUrl+'&sort='+sort;
                        } else {
                            newUrl = currUrl.replaceAt(currUrl.indexOf('sort='), sort);
                        }
                    } else {
                        newUrl = currUrl+'?sort='+sort;
                    }
                    window.location.href = newUrl;
                }
            });

            // hide or show the post
            $('.bar-view').click(function(e){
                e.preventDefault();
                id = getIdFromClasses( $(this).attr('class'), 'id_' );
                $(this).addClass('loading');
                button = $(this);
                ajaxUrl = "{{route('post.toggle', ':postId')}}";
                ajaxUrl = ajaxUrl.replace(':postId', id);
                $.ajax({
                    type: "POST",
                    url: ajaxUrl,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        try {
                            var d = JSON.parse(data);
                            // codes: Outdated(-3), Bag Plan(-2), Bad Auth(-1), Diactivated(0), Activated(1)
                            switch (d) {
                                case -3:
                                    showPopUpMassage(false, "{{ __('messages.postOutdated') }}");
                                    break;
                                case -2:
                                    showPopUpMassage(false, "{{ __('messages.requireStandart') }}");
                                    break;
                                case -1:
                                    showPopUpMassage(false, "{{ __('messages.authError') }}");
                                    break;
                                case 0:
                                    showPopUpMassage(true, "{{ __('messages.postDisactivated') }}");
                                    button.addClass('active');
                                    $('#'+id).toggleClass('inactive');
                                    break;
                                case 1:
                                    showPopUpMassage(true, "{{ __('messages.postActivated') }}");
                                    button.removeClass('active');
                                    $('#'+id).toggleClass('inactive');
                                    break;
                                default:
                                    showPopUpMassage(false, "{{ __('messages.error') }}");
                                    break;
                            }
                        } catch (error) {
                            showPopUpMassage(false, "{{ __('messages.error') }}");
                        }
                        button.removeClass('loading');
                    },
                    error: function() {
                        showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
                        button.removeClass('loading');
                    }
                });
            });

            //open modal delete confirm when user ask to
            $('.bar-delete').click(function() {
                var id = getIdFromClasses($(this).attr('class'), 'id_');
                var oldClasses = $('#popup-delete-post a').attr('class');
                $('#popup-delete-post a').attr('class', 'id_'+id+' '+oldClasses);
            });

            //delete one post
            $('.delete-post').click(function() {
                var postId = getIdFromClasses($(this).attr('class'), 'id_');
                $.fancybox.close();
                $('div.catalog-item.id_'+postId).addClass('hidden');
                $('div.content h1 span').html($('div.content h1 span').html()-1);
                var ajaxUrl = "{{route('posts.destroy.ajax', ':postId')}}";
                ajaxUrl = ajaxUrl.replace(':postId', postId);
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data) {
                            showPopUpMassage(true, "{{ __('messages.postDeleted') }}");
                        } else {
                            $('div.catalog-item.id_'+postId).removeClass('hidden');
                            showPopUpMassage(false, "{{ __('messages.postDeleteError') }}");
                        }
                    },
                    error: function() {
                        $('div.catalog-item.id_'+postId).removeClass('hidden');
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });
        });
    </script>
@endsection