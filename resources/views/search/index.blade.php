@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components/post_posts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}" />
@endsection

@section('content')

    <div id="searchBar">
        <form method="GET" action="{{ route('search.text') }}">
            <div id="inputWraper">
                <img id="searchIcon" src="{{ asset('icons/searchIcon.svg') }}" alt="{{__('alt.keyword')}}">
                <button id="search-bar-clear-btn" type="button"><img src="{{ asset('icons/clearIcon.svg') }}" alt="{{__('alt.keyword')}}"></button>
                <input id="inputSearch" class="def-input" name="searchStrings" value="{{ Session::get('searchText') }}" placeholder="{{__('ui.search')}}..." required />
            </div>
            <button class="def-button" type="submit">{{__('ui.search')}}</button>
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
    </div>

    <!-- Search result status show -->
    <div id="search-status">
        @if ( Session::has('searchText') )
            <div id="mailer-suggestion">
                <button id="addTextToMailer" class="{{ Session::get('searchText') }}">{{__('ui.mailerSuggestText')}}</button>
                <a id="whatIsMailerHelp" href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
                <div class="algolia-logo">
                    <img src="{{asset('icons/algoliaIcon.svg')}}" alt="{{__('alt.keyword')}}">
                </div>
            </div>
        @elseif ( Session::has('searchTags') )
            <div id="searchTags">    
                @foreach (Session::get('searchTags') as $id => $tag)
                    <a class="itemTag" href="{{ route('search.tag', $id) }}">{{$tag}}</a> 
                    <span>></span>
                @endforeach
            </div>
            <div id="mailer-suggestion">
                <button id="addTagToMailer" class="{{array_key_last(Session::get('searchTags'))}}">{{__('ui.mailerSuggestTag')}}</button>
                <a id="whatIsMailerHelp" href="{{route('faq')}}#WhatIsMailer">({{__('ui.whatIsMailer')}})</a>
            </div>
        @elseif ( Session::has('searchAuthorName') )
            <div id="searchAuthor">
                <p>{{__('ui.searchByAuthor')}} <span>{{Session::get('searchAuthorName')}}</span>:</p>
            </div>
            <div id="mailer-suggestion">
                <button id="addAuthorToMailer" class="{{Session::get('searchAuthorId')}}">{{__('ui.mailerSuggestAuthor')}}</button>
                <a id="whatIsMailerHelp"href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
            </div>   
        @endif
        <h1 id="searchStatus">{{Session::get('searchStatus')}}</h1>
    </div>

    <!-- Search fileters show -->
    @if ($posts_list->total() != 0)
        <div id="filters">
            <!-- TO DO -->
        </div>
    @endif  

    <!-- Search result posts -->
    <x-items :posts="$posts_list" button='addToFav' />
    
    <!-- Pagination -->
    <div class="pagination-field">
        {{ $posts_list->appends(request()->except('page'))->links() }}
    </div>

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

            //remove last '>' symbol from searched tags
            $('#searchTags span').last().remove();

            $('#search-bar-clear-btn').click(function(){
                $('#inputSearch').val("");
            });

            // user adds text to Mailer
            $('#addTextToMailer').click(function() {
                var searchString = $(this).attr('class');
                // Add wait cursor
                var button = $(this);
                button.addClass('loading'); 
                var ajaxUrl = '{{ route("mailer.add.text", ":string") }}';
                ajaxUrl = ajaxUrl.replace(':string', searchString);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function() {
                        showPopUpMassage(true, "{{ __('messages.mailerTextAdded') }}");
                        // Remove wait cursor
                        button.removeClass('loading'); 
                    },
                    error: function() {
                        // Print error massage
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        // Remove wait cursor
                        button.removeClass('loading');
                    }
                });
            });

            // user adds tags to Mialer
            $('#addTagToMailer').click(function() {
                var tagId = $(this).attr('class');
                var button = $(this);
                button.addClass('loading');
                var ajaxUrl = '{{ route("mailer.add.tag", ":tagId") }}';
                ajaxUrl = ajaxUrl.replace(':tagId', tagId);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function(data) {
                        data 
                            ? showPopUpMassage(true, "{{ __('messages.mailerTagAdded') }}") 
                            : showPopUpMassage(false, "{{ __('messages.mailerTagExists') }}") ;
                        button.removeClass('loading'); 
                    },
                    error: function() {
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading'); 
                    }
                });
            });

            // user add author to mailer
            $('#addAuthorToMailer').click(function() {
                var author = $(this).attr('class');
                // Add wait cursor
                var button = $(this);
                button.addClass('loading');
                var ajaxUrl = '{{ route("mailer.add.author", ":author") }}';
                ajaxUrl = ajaxUrl.replace(':author', author);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function(data) {
                        data ? showPopUpMassage(true, "{{ __('messages.mailerAddedAuthor') }}") : showPopUpMassage(false, "{{ __('messages.mailerAuthorExists') }}") ;
                        // Remove wait cursor
                        button.removeClass('loading'); 
                    },
                    error: function() {
                        // Print error massage
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        // Remove wait cursor
                        button.removeClass('loading'); 
                    }
                });
            });

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
                    url: '{{ route('toFav') }}',
                    data: { post_id: postId },
                    success: function(data) {
                        //if no server errors, change digit of favItemsAmount in nav bar 
                        //and change color of AddToFav btn
                        if ( data ) {
                            var target = $("#"+postId+" img.addToFavImg");
                            var n = $("#favItemsTab span").text();
                            n = parseInt(n,10);
                            if ( target.attr("src") != "{{ asset('icons/heartOrangeIcon.svg') }}" ) {
                                //visualize adding to fav list
                                $("#favItemsTab span").html(n+1);
                                target.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                                showPopUpMassage(true, "{{ __('messages.postAddedFav') }}");
                            } else {
                                //visualize removing from fav list
                                $("#favItemsTab span").html(n-1);
                                target.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                                showPopUpMassage(true, "{{ __('messages.postRemovedFav') }}");
                            }
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