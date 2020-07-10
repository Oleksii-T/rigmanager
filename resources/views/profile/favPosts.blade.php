@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/items.css')}}" />
    <link rel="stylesheet" href="{{asset('css/profile_favItems.css')}}" />
    <link rel="stylesheet" href="{{asset('css/pagination.css')}}" />
@endsection

@section('content')
    @if (!$posts_list->isEmpty())
        <div id="items">
            @foreach ($posts_list as $post)
                <div class="item id_{{ $post->id }}">
                    <div class="imgWraper">
                        @if ( $post->images->isEmpty() )
                            <img src="{{ asset('icons/noImageIcon.svg') }}" alt="Оборудывание нефть и газ."></li>
                        @else    
                            <img src="{{ $post->images->first()->url }}" alt="Оборудывание нефть и газ."></li>
                        @endif
                    </div>
                    <button class="addToFavButton id_{{ $post->id }}">
                        <img class="addToFavImg" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                        <span><i>{{__('ui.removeFromFav')}}</i></span>
                    </button>
                    <div class="textWraper">
                        <h3 class="heading4">{{ $post->title }}</h3>
                        <p class="desc">{{ $post->description }}</p>
                        <ul id="ulMisc">
                            @if ($post->location)
                                <li><p class="location misc">{{ $post->location }}</p></li>
                                <li><p>&#x02022</p></li>
                            @endif
                            <li><p class="date misc" >{{ $post->created_at }}</p></li>
                            @if ($post->cost)
                                <li><p>&#x02022</p></li>
                                <li><p class="cost misc">{{ $post->cost }}</p></li>
                            @endif
                        </ul>
                    </div>

                    <a href="{{ route('posts.show', $post->id) }}"><span class="globalItemButton item_id_{{$post->id}}"></span></a>
                </div>
            @endforeach
        </div>
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

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            //static generator of unique ids for popUp massages
            function Generator() {};
            Generator.prototype.rand =  0;
            Generator.prototype.getId = function() {return this.rand++;};
            var idGen =new Generator();
            $("#favView").addClass('active');

            //make pop up massage from text
            function popUpMassage (text) {
                var uniqueId = "num" + idGen.getId();
                $('#container').append('<div class="popUp" id="'+uniqueId+'"><p>'+text+'</p></div>');
                $('#'+uniqueId).addClass('popUpShow');
                $('#'+uniqueId).click(function(){ $(this).removeClass('popUpShow') });
                setTimeout(function(){
                    $('#'+uniqueId).removeClass('popUpShow');
                }, 3000);
            }

            //delete item from fav
            $(".addToFavButton").click(function(){
                var item_id = $(this).attr("class").split('_')[1];
                //make cursor wait
                $("button.id_"+item_id).addClass('loading');
                $("span.item_id_"+item_id).addClass('loading');
                //send Ajax reqeust to add Item to fav list of user
                $.ajax({
                    type: "GET",
                    url: '{{ route('toFav') }}',
                    data: { post_id: item_id },
                    success: function(data) {
                        //if no server errors, decrement digit of favItemsAmount in nav bar 
                        //and hide post from page
                        if ( data ) {
                            var n = $("#favItemsTab span").text();
                            n = parseInt(n,10);
                            $("#favItemsTab span").html(n-1);
                            $(".id_"+item_id).addClass('deletedItem');
                            popUpMassage("{{ __('messages.postRemovedFav') }}");
                        //if server errors occures, pop up error massage
                        } else {
                            popUpMassage("{{ __('messages.postRemoveFavError') }}");
                        }
                        //remove cursor wait
                        $("button.id_"+item_id).removeClass('loading');
                        $("span.item_id_"+item_id).removeClass('loading');
                    },
                    error: function() {
                        //pop up error massage and remove cursor wait
                        popUpMassage("{{ __('messages.error') }}");
                        $("button.id_"+item_id).removeClass('loading');
                        $("span.item_id_"+item_id).removeClass('loading');
                    }
                });
            });
            
            //add hover effect on item when hover on addToFav btn
            $(".addToFavButton").hover(function(){
                var item_id = $(this).attr("class").split('_')[1];
                $(".item_id_"+item_id).addClass('hover');
                }, function(){
                var item_id = $(this).attr("class").split('_')[1];
                $(".item_id_"+item_id).removeClass('hover');
            });
        });
    </script>
@endsection
