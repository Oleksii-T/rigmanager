@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/items.css')}}" />
    <link rel="stylesheet" href="{{asset('css/profile_myItems.css')}}" />
    <link rel="stylesheet" href="{{asset('css/pagination.css')}}" />
@endsection

@section('content')
    @if (!$posts_list->isEmpty())
        <div id="items">
            @foreach ($posts_list as $item)
                <div class="item">
                    <div class="imgWraper">
                        @if ( $item->images->isEmpty() )
                            <img src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}"></li>
                        @else    
                            <img src="{{ $item->images->first()->url }}" alt="{{__('alt.keyword')}}"></li>
                        @endif
                    </div>

                    <button class="modalPostDeleteOn" id="{{$item->id}}">
                        <img src="{{ asset('icons/deleteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    </button>

                    <a class="editBtn" id="{{$item->id}}" href="{{ route('posts.edit', $item->id) }}">
                        <img title="{{__('ui.edit')}}" src="{{ asset('icons/editIcon.svg') }}" alt="{{__('alt.keyword')}}">
                    </a>

                    <div class="textWraper">
                        <h3 class="heading4">{{ $item->title }}</h3>
                        <p class="desc">{{ $item->description }}</p>
                        <ul id="ulMisc">
                            @if ($item->location)
                                <li><p class="location misc">{{ $item->location }}</p></li>
                                <li><p>&#x02022</p></li>
                            @endif
                            <li><p class="date misc" >{{ $item->created_at }}</p></li>
                            @if ($item->cost)
                                <li><p>&#x02022</p></li>
                                <li><p class="cost misc">{{ $item->cost }}</p></li>
                            @endif
                        </ul>
                    </div>
                    <a href="{{ route('posts.show', $item->id) }}"><span class="globalItemButton item_id_{{ $item->id }}"></span></a>

                </div>

                <div class="modalView animate" id="modalPostDelete">
                    <div class="modalContent"> 
                        <p>{{__('ui.sure?')}}</p>
                        <div>
                            <button type="button" id="modalPostDeleteOff">{{__('ui.no')}}</button>
                            <form method="POST" action="{{ route('posts.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button>{{__('ui.delete')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
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

