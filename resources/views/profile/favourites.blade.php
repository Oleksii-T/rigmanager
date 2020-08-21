@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_favourites.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/post_posts.css')}}" />
@endsection

@section('content')
    @if ($posts_list->isNotEmpty())
        <x-items :posts="$posts_list" button='removeFromFav' />
        <div class="pagination-field">
            {{ $posts_list->links() }}
        </div>
    @else
        <div class="emptyItems">
            <p>{{__('ui.noFavPosts')}}</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

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

            //delete item from fav
            $(".addToFavButton").click(function(){
                var item_id = getIdFromClasses($(this).attr("class"), 'id_');
                //make cursor wait
                var button = $(this);
                button.addClass('loading');
                //send Ajax reqeust to add Item to fav list of user
                $.ajax({
                    type: "GET",
                    url: "{{ route('toFav') }}",
                    data: { post_id: item_id },
                    success: function(data) {
                        //if no server errors, decrement digit of favItemsAmount in nav bar 
                        //and hide post from page
                        if ( data ) {
                            var n = $("#favItemsTab span").text();
                            n = parseInt(n,10);
                            $("#favItemsTab span").html(n-1);
                            $("#"+item_id).remove();
                            showPopUpMassage(true, "{{ __('messages.postRemovedFav') }}");
                        //if server errors occures, pop up error massage
                        } else {
                            showPopUpMassage(false, "{{ __('messages.postRemoveFavError') }}");
                        }
                        //remove cursor wait
                        button.removeClass('loading');
                    },
                    error: function() {
                        //pop up error massage and remove cursor wait
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            });

            //add hover effect on item when hover on addToFav btn
            $(".addToFavButton").hover(function(){togglePostHover($(this))}, function(){togglePostHover($(this))});

            // toggle hover effect on hoverIn/Out on exat post
            function togglePostHover(element) {
                var postId = getIdFromClasses(element.attr("class"), 'id_');
                $("#"+postId+" .globalItemButton").toggleClass('hover');
            }
        });
    </script>
@endsection
