@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components/post_posts.css') }}" />
@endsection

@section('content')

    <div id="searchBar">
        <form method="GET" action="{{ route('search.text') }}">
            <div id="inputWraper">
                <img id="searchIcon" src="{{ asset('icons/searchIcon.svg') }}" alt="{{__('alt.keyword')}}">
                <a href="{{ route('home') }}"><img id="clearIcon" src="{{ asset('icons/clearIcon.svg') }}" alt="{{__('alt.keyword')}}"></a>
                <input id="inputSearch" name="searchStrings" placeholder="{{__('ui.search')}}..." required />
            </div>
            <button class="def-button" type="submit">{{__('ui.search')}}</button>
        </form>
    </div>

    <nav id="searchBtns">
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
                        <tr>
                            <td><li><a href="#" id="1.0">{{__('tags.other')}}</a></li></td>
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
                            <td><li><a href="#" id="2.0">{{__('tags.other')}}</a></li></td>
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
                            <td><li><a href="#" id="3.0">{{__('tags.other')}}</a></li></td>
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
                        <tr>
                            <td><li><a href="#" id="4.0">{{__('tags.other')}}</a></li></td>
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
                            <td><li><a href="#" id="5.0">{{__('tags.other')}}</a></li></td>
                        </tr>
                    </table>
                </ul>
            </div>

        </div>
    </nav>

    <x-items :posts="$posts_list" button='addToFav' />

    <div class="pagination-field">
        {{ $posts_list->appends(request()->except('page'))->links() }}
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // paint in orange addToFav btn of appropriate items 
            $('.active-fav-img').attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");

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
            //search for clicked category 
            $('#dropDown a').click(function($e){
                $e.preventDefault();
                var id = $(this).attr('id');
                var url = '{{ route("search.tag", ":id") }}';
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
            
            //if user tries to add his oun item to fav list
            $(".addToFavButtonBlocked").click(function(){
                showPopUpMassage(false, "{{ __('messages.postAddFavPersonal') }}");
            });

            //action when user clicks on addToFav icon
            $(".addToFavButton").click(function(){
                var postId = getIdFromClasses($(this).attr("class"), 'id_');
                //make cursor wait
                var button = $(this);
                button.addClass('loading');
                //send Ajax reqeust to add Item to fav list of user
                $.ajax({
                    type: "GET",
                    url: '{{ route("toFav") }}',
                    data: { post_id: postId },
                    success: function(data) {
                        //if no server errors, change digit of favItemsAmount in nav bar 
                        //and change color of AddToFav btn img
                        if ( data ) {
                            var target = $("#"+postId+" img.addToFavImg");
                            var n = $("#favItemsTab span").text();
                            n = parseInt(n,10);
                            //visualize removing from fav list
                            if ( target.hasClass('active-fav-img') ) {
                                $("#favItemsTab span").html(n-1);
                                target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                                showPopUpMassage(true, "{{ __('messages.postRemovedFav') }}");
                            //visualize adding to fav list
                            } else {
                                $("#favItemsTab span").html(n+1);
                                target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                                showPopUpMassage(true, "{{ __('messages.postAddedFav') }}");
                            }
                            target.toggleClass('active-fav-img');
                        //if server errors occures, pop up error massage
                        } else {
                            showPopUpMassage(false, "{{ __('messages.postAddFavError') }}");
                        }
                        //remove cursor wait
                        button.removeClass('loading');
                    },
                    error: function() {
                        //pop up error massage and remove cursor wait
                        showPopUpMassage(false, "{{ __('messages.') }}");
                        button.removeClass('loading');
                    }
                });
            });

            //add hover effect on item when hover on addToFav btn
            $(".addToFavImg").hover(function(){togglePostHover($(this))}, function(){togglePostHover($(this))});

            // toggle hover effect on hoverIn/Out on exat post
            function togglePostHover(element) {
                var postId = getIdFromClasses(element.attr("class"), 'id_');
                $("#"+postId+" .globalItemButton").toggleClass('hover');
            }

            //add hover effect on item when hover on addToFavBlocked btn
            $(".addToFavButtonBlocked").hover(function(){
                var postId = $(this).attr("class").split('_')[1];
                $(".postId_"+postId).addClass('hover');
                }, function(){
                var postId = $(this).attr("class").split('_')[1];
                $(".postId_"+postId).removeClass('hover');
            });

        });
    </script>
@endsection