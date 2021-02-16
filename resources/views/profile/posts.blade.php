@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.myPosts')}}</span></span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-profile-nav active='posts'/>
        <div class="content">
            <h1>{{__('ui.myPosts')}} (<span class="orange">{{$posts_list->total()}}</span>)</h1>
            @if ($posts_list->count() == 0)
                <p>{{__('ui.noMyPosts')}}</p>
            @else
                <div class="cabinet-line">
                    <div class="cabinet-search">
                        <form  method="GET" action="{{loc_url(route('profile.posts'))}}">
                            <fieldset>
                                <input type="text" class="input" placeholder="{{__('ui.search')}}" name="text" value="{{$searchValue}}">
                                <button class="search-button"></button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="cabinet-line-right">
                        <a href="#popup-delete-all-posts" data-fancybox class="cabinet-line-link">{{__('ui.deleteAllPosts')}}</a>
                        <!--
                        <div class="cabinet-line-check">
                            <div class="check-item">
                                <input type="checkbox" class="check-input" id="ch11">
                                <label for="ch11" class="check-label">Все</label>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
                <div class="catalog catalog-my">
                    <x-items :posts="$posts_list" type='profile.posts'/>
                </div>
                <div class="pagination-field">
                    {{ $posts_list->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('modals')
    <div id="popup-delete-all-posts" class="popup">
        <div class="popup-title">{{__('ui.sure?')}}</div>
        <div class="sure-dialog">
            <a href="#" class="delete-all-posts">{{__('ui.deleteAllPosts')}}</a>
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

            // delete all user`s posts
            $('.delete-all-posts').click(function(e){
                e.preventDefault();
                $.fancybox.close();
                $('div.cabinet-line').addClass('hidden');
                $('div.catalog-my').addClass('hidden');
                $('div.pagination-field').addClass('hidden');
                $('div.content h1').after('<p>{{__("ui.noMyPosts")}}</p>');
                $('div.content h1 span').html('0');
                $.ajax({
                    type: "POST",
                    url: "{{route('posts.delete')}}",
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        showPopUpMassage(true, "{{ __('messages.allPostsDeleted') }}");
                    },
                    error: function() {
                        $('#items').removeClass('hidden');
                        $('.pagination-field').removeClass('hidden');
                        $('.emptyItems').addClass('hidden');
                        $('#modalAllPostDeleteOn').removeClass('hidden');
                        showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
                    }
                });
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
                        switch (JSON.parse(data)) {
                            case -1:
                                showPopUpMassage(false, "{{ __('messages.postOutdated') }}");
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
                                break;
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
                            $('#'+postId).remove();
                            showPopUpMassage(true, "{{ __('messages.postDeleted') }}");
                        } else {
                            showPopUpMassage(false, "{{ __('messages.postDeleteError') }}");
                        }
                    },
                    error: function() {
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });
        });
    </script>
@endsection