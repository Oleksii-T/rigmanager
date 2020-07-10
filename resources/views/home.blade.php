@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/items.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
@endsection

@section('content')
    <div id="searchBar">
        <form method="GET" action="{{ route('search') }}">
            <div id="inputWraper">
                <img src="{{ asset('icons/search.svg') }}" alt="{{__('alt.keyword')}}">
                <input id="inputSearch" name="searchStrings" value="{{ Session::get('oldSearch') }}" placeholder="{{__('ui.search')}}..."  />
            </div>
            <button type="submit">{{__('ui.search')}}</button>
        </form>
    </div>

    <div id="searchBtns">

        <div id="navTags">
            <button class="tagsTrigger hseEq">{{__('tags.hseEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger drillingEq">{{__('tags.drillingEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger repairEq">{{__('tags.repairEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger productionEq">{{__('tags.productionEq')}}<span class="arrow arrowDown"></span></button>
            <button class="tagsTrigger loggingEq">{{__('tags.loggingEq')}}<span class="arrow arrowDown"></span></button>
        </div>

        <div id="dropDown">

            <div class="typeOfEq" id="hseEq">
                <ul id="mainMenu">
                    <table>
                        <tr>
                            <td> <x-tags.hse.fire-hazard/> </td>
                            <td> <x-tags.hse.life-support/> </td>
                            <td> <x-tags.hse.light/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.hse.misc-eq/> </td>
                            <td> <x-tags.hse.ppo/> </td>
                            <td> <x-tags.hse.signalization/> </td>
                        </tr>
                    </table>
                </ul>
            </div>

            <div class="typeOfEq" id="drillingEq">
                <ul id="mainMenu">
                    <table>
                        <tr>
                            <td> <x-tags.drilling.substructure/> </td>
                            <td> <x-tags.drilling.mast/> </td>
                            <td> <x-tags.drilling.logging/> </td>
                        </tr>
                        <tr>
                            <td> <x-tags.drilling.boe/> </td>
                            <td> <x-tags.drilling.emergency/> </td>
                            <td>  </td>
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
                            <td> <x-tags.repair.boe/> </td>
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
                            <td> <x-tags.repair.frac/> </td>
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

    @if ( Session::has('search') )
        <div id="searchTitle">
            <h1>{{Session::get('search')}}</h1>
        </div>
    @endif

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
                    <span><i>{{__('ui.addToFav')}}</i></span>
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

            //search for clicked category 
            $('#dropDown a').click(function(){
                var id = $(this).attr('id');
                var url = '{{ route("searchTag", ":id") }}';
                url = url.replace(':id', id);
                window.location.href=url;
            });

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
                var item_id = $(this).attr("class").split(' ')[1].split('_')[1];
                //make cursor wait
                $("button.id_"+item_id).addClass('loading');
                $("span.item_id_"+item_id).addClass('loading');
                //send Ajax reqeust to add Item to fav list of user
                $.ajax({
                    type: "GET",
                    url: '{{ route('toFav') }}',
                    data: { post_id: item_id },
                    success: function(data) {
                        //if no server errors, change digit of favItemsAmount in nav bar 
                        //and change color of AddToFav btn
                        if ( data ) {
                            var target = $(".id_"+item_id+" img");
                            var n = $("#favItemsTab span").text();
                            n = parseInt(n,10);
                            if ( target.attr("src") != "{{ asset('icons/heartOrangeIcon.svg') }}" ) {
                                //visualize adding to fav list
                                $("#favItemsTab span").html(n+1);
                                target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                                popUpMassage("{{ __('messages.postAddedFav') }}");
                            } else {
                                //visualize removing from fav list
                                $("#favItemsTab span").html(n-1);
                                target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                                popUpMassage("{{ __('messages.postRemovedFav') }}");
                            }
                        //if server errors occures, pop up error massage
                        } else {
                            popUpMassage("{{ __('messages.postAddFavError') }}");
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