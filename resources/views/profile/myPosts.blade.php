@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/profile_myItems.css')}}" />
    <link rel="stylesheet" href="{{asset('css/components/items.css')}}" />
    <link rel="stylesheet" href="{{asset('css/components/pagination.css')}}" />
@endsection

@section('content')
    @if (!$posts_list->isEmpty())
        <x-items :posts="$posts_list" button='deleteAndEdit' />
        <div class="pagination-field">
            {{ $posts_list->links() }}
        </div>
    @else
        <div class="emptyItems">
            <p>{{__('ui.noMyPosts')}}</p>
        </div>
    @endif


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            //add hover effect on item when hover on addToFav btn
            $(".editBtn").hover(function(){
                    var item_id = $(this).attr("id");
                    $(".item_id_"+item_id).addClass('hover');
                }, function(){
                    var item_id = $(this).attr("id");
                    $(".item_id_"+item_id).removeClass('hover');
            });

            //add hover effect on item when hover on addToFav btn
            $(".modalPostDeleteOn").hover(function(){
                    var item_id = $(this).attr("id");
                    $(".item_id_"+item_id).addClass('hover');
                }, function(){
                    var item_id = $(this).attr("id");
                    $(".item_id_"+item_id).removeClass('hover');
            });

            //open modal delete confirm when user ask to
            $('.modalPostDeleteOn').click(function() {
                $('#modalPostDelete').css("display", "block");
            });

            //close delete confirmation
            $('#modalPostDeleteOff').click(function(){
                $('#modalPostDelete').css("display", "none");
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var modal = document.getElementById("modalPostDelete");
                if (event.target == modal) {
                    $('#modalPostDelete').css("display", "none");
                }
            }

        });
    </script>
@endsection

