@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/items.css')}}" />
    <link rel="stylesheet" href="{{asset('css/profile_myItems.css')}}" />
    <link rel="stylesheet" href="{{asset('css/pagination.css')}}" />
@endsection

@section('content')
    @if ($posts_list)
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

                    <a class="editBtn id_{{$item->id}}" href="{{ route('posts.edit', $item->id) }}">
                        <img title="{{__('ui.edit')}}" src="{{ asset('icons/editIcon.svg') }}" alt="">
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
            @endforeach

        </div>
        <div class="pagination-field">
            {{ $posts_list->links() }}
        </div>
    @else
        <div id="emptyItems">
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
                    var item_id = $(this).attr("class").split('_')[1];
                    $(".item_id_"+item_id).addClass('hover');
                }, function(){
                    var item_id = $(this).attr("class").split('_')[1];
                    $(".item_id_"+item_id).removeClass('hover');
            });

        });
    </script>
@endsection

