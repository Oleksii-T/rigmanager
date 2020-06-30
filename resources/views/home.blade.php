@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/items.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
@endsection

@section('content')
    <div id="searchBar">
        <form action="/items/search">
            <div id="inputWraper">
                <img src="{{ asset('icons/search.svg') }}" alt="{{__('alt.keyword')}}">
                <input id="inputSearch" name="search" placeholder="{{__('ui.search')}}..." />
            </div>
            <button type="submit">{{__('ui.search')}}</button>
        </form>
    </div>

    <div id="searchBtns">

        <div id="navTags">
            <button class="tagsTrigger drillingEq">{{__('ui.drillingEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger repairEq">{{__('ui.repairEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger productionEq">{{__('ui.productionEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger loggingEq">{{__('ui.loggingEq')}}<span class="arrow arrowDown"></span></button>
        </div>

        <div id="dropDown">

            <div class="typeOfEq" id="drillingEq">
                <ul id="mainMenu">
                    <table>
                        <tr>
                            <td> <x-tags.drilling.substructure/> </td>
                            <td> <x-tags.drilling.mast/> </td>
                            <td> <x-tags.drilling.logging/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.drilling.bop/> </td>
                            <td> <x-tags.drilling.emergency/> </td>
                            <td> <x-tags.drilling.hse/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.drilling.power/> </td>
                            <td> <x-tags.drilling.lifting/> </td>
                            <td> <x-tags.drilling.rotory/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.drilling.drill-string/> </td>
                            <td> <x-tags.drilling.bha/> </td>
                            <td> <x-tags.drilling.grouning/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.drilling.mud/> </td>
                            <td> <li><a href="#">{{__('ui.other')}}</a></li> </td>
                        </tr>
                    </table>
                </ul>
            </div>

            <div class="typeOfEq" id="repairEq">
                <ul id="mainMenu">
                    <table>
                        <tr>
                            <td> <x-tags.repair.substructure/> </td>
                            <td>  </td>
                            <td> <x-tags.repair.logging/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.repair.bop/> </td>
                            <td> <x-tags.repair.emergency/> </td>
                            <td> <x-tags.repair.well-head/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.repair.power/> </td>
                            <td> <x-tags.repair.lifting/> </td>
                            <td> <x-tags.repair.rotory/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.repair.drill-string/> </td>
                            <td> <x-tags.repair.fhf/> </td>
                            <td> <x-tags.repair.coll-tubing/> </td>
                        </tr>
                        <tr>
                            <td> <li><a href="#">{{__('ui.other')}}</a></li> </td>
                        </tr>
                    </table>
                </ul>
            </div>
            
            <div class="typeOfEq" id="productionEq">
                <ul id="mainMenu">
                    <table>
                        <tr>
                            <td> <x-tags.production.tubing/> </td>
                            <td> <x-tags.production.well-head/> </td>
                            <td> <x-tags.production.x-mass-tree/> </td>
                        </tr>
                    </table>
                </ul>
            </div>

            <div class="typeOfEq" id="loggingEq">
                <ul id="mainMenu">
                    <table>
                        <tr>
                            <td> <x-tags.logging.sensors/> </td>
                            <td> <x-tags.logging.eq/> </td>
                        </tr>
                    </table>
                </ul>
            </div>

        </div>
    </div>

    <div id="items">
        @foreach ($posts_list as $item)
            <div class="item">
                <div class="imgWraper">
                    @if ( $item->images->count() == 0 )
                        <img src="{{ asset('icons/noImageIcon.svg') }}" alt="{{__('alt.keyword')}}"></li>
                    @else    
                        <img src="{{ $item->images->first()->url }}" alt="{{__('alt.keyword')}}"></li>
                    @endif
                </div>

                @if ($item->user_id == Auth::id())
                    <button class="addToFavButtonBlocked id_{{ $item->id }}">
                @else
                    <button class="addToFavButton id_{{ $item->id }}">
                @endif
                @if ( auth()->user() && !$item->favOfUser->where('id', auth()->user()->id)->isEmpty() )
                    <img class="addToFavImg" src="{{ asset('icons/heartOrangeIcon.svg') }}" alt="{{__('alt.keyword')}}">
                @else
                    <img class="addToFavImg" src="{{ asset('icons/heartWhiteIcon.svg') }}" alt="{{__('alt.keyword')}}">
                @endif
                    <span><i>Добавить в избраноe</i></span>
                    </button>

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

            //main Equipment types buttons click action
            $('.tagsTrigger').click(function(){
                var type = $(this).attr('class').split(' ')[1];
                var display = $("#"+type).css('display');
                $('.typeOfEq').css('display', 'none');
                $('.tagsTrigger').removeClass('isActiveBtn');
                if (display == 'none')
                {
                    $("#"+type).css('display', 'block');
                    $(this).addClass('isActiveBtn');
                }
                else
                {
                    $("#"+type).css('display', 'none');
                    $(this).removeClass('isActiveBtn');
                }
            });

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

            //if user tries to add his oun item to fav list
            $(".addToFavButtonBlocked").click(function(){
                popUpMassage("{{ __('messages.postAddFavPersonal') }}");
            });

            //action when user clicks on addToFav icon
            $(".addToFavButton").click(function(){
                $(".id_"+item_id).attr('disabled', true); //disable button until feedback
                $(document.body).css('cursor', 'wait');
                var item_id = $(this).attr("class").split(' ')[1].split('_')[1];
                $.ajax({
                    type: "GET",
                    url: '{{ route('toFav') }}',
                    data: { post_id: item_id },
                    success: function(data) {
                        confirmation(data, item_id);
                    }
                });
            });

            //paint addToFav btn into red and incr/decr number of  favItems if succes
            function confirmation(data, item_id) {
                if ( data ) {
                    var target = $(".id_"+item_id+" img");
                    var n = $("#favItemsTab span").text();
                    n = parseInt(n,10);
                    if ( target.attr("src") != "{{ asset('icons/heartOrangeIcon.svg') }}" ) {
                        $("#favItemsTab span").html(n+1);
                        target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                        popUpMassage("{{ __('messages.postAddedFav') }}");
                    }   else {
                        $("#favItemsTab span").html(n-1);
                        target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                        popUpMassage("{{ __('messages.postRemovedFav') }}");
                    }
                } else {
                    popUpMassage("{{ __('messages.postAddFavError') }}");
                }
                $(document.body).css('cursor', 'default');
                $(".id_"+item_id).attr('disabled', false);
            }

            //add hover effect on item when hover on addToFav btn
            $(".addToFavButton").hover(function(){
                var item_id = $(this).attr("class").split('_')[1];
                $(".item_id_"+item_id).addClass('hover');
                }, function(){
                var item_id = $(this).attr("class").split('_')[1];
                $(".item_id_"+item_id).removeClass('hover');
            });

            //add hover effect on item when hover on addToFavBlocked btn
            $(".addToFavButtonBlocked").hover(function(){
                var item_id = $(this).attr("class").split('_')[1];
                $(".item_id_"+item_id).addClass('hover');
                }, function(){
                var item_id = $(this).attr("class").split('_')[1];
                $(".item_id_"+item_id).removeClass('hover');
            });

        });
    </script>
@endsection