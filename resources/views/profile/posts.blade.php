@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_posts.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/post_posts.css')}}" />
@endsection

@section('content')
    @if ($posts_list->isEmpty() && !$searchValue)
        <div class="emptyItems">
            <p>{{__('ui.noMyPosts')}}</p>
        </div>
    @else
        <button id="modalAllPostDeleteOn">{{__('ui.deleteAllPosts')}}</button>
        <p>Total posts: {{$posts_list->total()}}</p>
        <form class="search-items" method="GET" action="{{loc_url(route('profile.posts'))}}">
            <input type="text" name="text" value="{{$searchValue}}">
            <button type="submit">{{__('ui.search')}}</button>
            @if ($searchValue)
                <a href="{{loc_url(route('profile.posts'))}}">{{__('ui.reset')}}</a>
            @endif
        </form>
        @if ($posts_list->isEmpty())
            <div class="emptyItems">
                <p>{{__('ui.noMyPostsBySearch')}}</p>
            </div>
        @endif
        <x-items :posts="$posts_list" button='deleteAndEdit' :translated="$translated"/>
        <div class="pagination-field">
            {{ $posts_list->links() }}
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // delete all user`s posts
            $('.delete-all-posts').click(function(){
                $('#modalAllPostDelete').addClass('hidden');
                $('#items').addClass('hidden');
                $('.pagination-field').addClass('hidden');
                $('#modalAllPostDeleteOn').after('<div class="emptyItems"><p>{{__("ui.noMyPosts")}}</p></div>');
                $('#modalAllPostDeleteOn').addClass('hidden');
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

            // show submit form for delete ALL posts
            $('#modalAllPostDeleteOn').click(function(){
                $('#modalAllPostDelete').removeClass('hidden');
            });

            //hide the modal delet all posts 
            $('#modalAllPostDeleteOff').click(function(){
                $('#modalAllPostDelete').addClass('hidden');
            });

            // hide or show the post
            $('button.item-hide-btn').click(function(){
                id = getIdFromClasses( $(this).attr('class'), 'id_' );
                button = $(this);
                button.addClass('loading');
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
                                button.children().attr('src', "{{asset('icons/showDocIcon.svg')}}");
                                $('#'+id).toggleClass('inactive');
                                break;
                            case 1:
                                showPopUpMassage(true, "{{ __('messages.postActivated') }}");
                                button.children().attr('src', "{{asset('icons/hideDocIcon.svg')}}");
                                $('#'+id).toggleClass('inactive');
                                break;
                            default:
                                break;
                        }
                        button.removeClass('loading');
                    },
                    error: function() {
                        button.removeClass('loading');
                        showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
                    }
                });
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

            //add hover effect on item when hover on addToFav btn
            $("div.item-btns").hover(function(){
                var postId = getIdFromClasses($(this).attr("class"), 'id_');
                $("#"+postId+" .globalItemButton").addClass('hover');
            }, function(){
                var postId = getIdFromClasses($(this).attr("class"), 'id_');
                $("#"+postId+" .globalItemButton").removeClass('hover');
            });

            //open modal delete confirm when user ask to
            $('.modalPostDeleteOn').click(function() {
                var id = getIdFromClasses($(this).attr('class'), 'id_');
                var oldClasses = $('#modalPostDelete .modalSubmitButton').attr('class');
                $('#modalPostDelete .modalSubmitButton').attr('class', 'id_'+id+' '+oldClasses);
                $('#modalPostDelete').removeClass('hidden');
            });

            //close delete confirmation
            $('#modalPostDeleteOff').click(function(){
                $('#modalPostDelete').addClass('hidden');
            });

            $('.modalSubmitButton').click(function() {
                var postId = getIdFromClasses($(this).attr('class'), 'id_');
                $('#modalPostDelete').css("display", "none");
                var ajaxUrl = "{{route('posts.destroy.ajax', ':postId')}}";
                ajaxUrl = ajaxUrl.replace(':postId', postId);
                $('#'+postId+' .globalItemButton').addClass('loading');
                $('#'+postId+' img').addClass('loading');
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
                        $('#'+postId+' .globalItemButton').removeClass('loading');
                        $('#'+postId+' img').removeClass('loading');
                    },
                    error: function() {
                        $('#'+postId+' .globalItemButton').removeClass('loading');
                        $('#'+postId+' .img').removeClass('loading');
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var delPost = document.getElementById("modalPostDelete");
                var delAllPost = document.getElementById("modalAllPostDelete");
                if (event.target == delPost) {
                    $('#modalPostDelete').addClass('hidden');
                } else if (event.target == delAllPost) {
                    $('#modalAllPostDelete').addClass('hidden');
                }
            }

        });
    </script>
@endsection

