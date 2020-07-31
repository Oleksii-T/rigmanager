@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/item_items.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/item_pagination.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search.css') }}" />
@endsection

@section('content')

    <div id="searchBar">
        <form method="GET" action="{{ route('search.text') }}">
            <div id="inputWraper">
                <img id="searchIcon" src="{{ asset('icons/searchIcon.svg') }}" alt="{{__('alt.keyword')}}">
                <a href="{{ route('home') }}"><img id="clearIcon" src="{{ asset('icons/clearIcon.svg') }}" alt="{{__('alt.keyword')}}"></a>
                <input id="inputSearch" name="searchStrings" value="{{ Session::get('searchText') }}" placeholder="{{__('ui.search')}}..." required />
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
                <a  id="whatIsMailerHelp"href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
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

            //static generator of unique ids for popUp massages
            function Generator() {};
            Generator.prototype.rand =  0;
            Generator.prototype.getId = function() {return this.rand++;};
            var idGen = new Generator();

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

            //remove last '>' symbol from searched tags
            $('#searchTags span').last().remove();

            //fade out flash massages
            $("div.flash").delay(3000).fadeOut(350);

            // user adds text to Mailer
            $('#addTextToMailer').click(function() {
                var searchString = $(this).attr('class');
                // Add wait cursor
                $(document.body).css('cursor', 'default');
                $(this).addClass('loading'); 
                var ajaxUrl = '{{ route("mailer.add.text", ":string") }}';
                ajaxUrl = ajaxUrl.replace(':string', searchString);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function(data) {
                        popUpMassage(data);
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#addTextToMailer').removeClass('loading'); 
                    },
                    error: function() {
                        // Print error massage
                        popUpMassage("{{ __('messages.error') }}");
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#addTextToMailer').removeClass('loading'); 
                    }
                });
            });

            // user adds tags to Mialer
            $('#addTagToMailer').click(function() {
                var tagId = $(this).attr('class');
                // Add wait cursor
                $(document.body).css('cursor', 'default');
                $(this).addClass('loading'); 
                var ajaxUrl = '{{ route("mailer.add.tag", ":tagId") }}';
                ajaxUrl = ajaxUrl.replace(':tagId', tagId);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function(data) {
                        popUpMassage(data);
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#addTagToMailer').removeClass('loading'); 
                    },
                    error: function() {
                        // Print error massage
                        popUpMassage("{{ __('messages.error') }}");
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#addTagToMailer').removeClass('loading'); 
                    }
                });
            });

            // user add author to mailer
            $('#addAuthorToMailer').click(function() {
                var author = $(this).attr('class');
                // Add wait cursor
                $(document.body).css('cursor', 'default');
                $(this).addClass('loading'); 
                var ajaxUrl = '{{ route("mailer.add.author", ":author") }}';
                ajaxUrl = ajaxUrl.replace(':author', author);
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    success: function(data) {
                        popUpMassage(data);
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#addAuthorToMailer').removeClass('loading'); 
                    },
                    error: function() {
                        // Print error massage
                        popUpMassage("{{ __('messages.error') }}");
                        // Remove wait cursor
                        $(document.body).css('cursor', 'default');
                        $('#addAuthorToMailer').removeClass('loading'); 
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
                            var target = $(".id_"+item_id+" img.addToFavImg");
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