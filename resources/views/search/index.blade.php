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
                <input id="inputSearch" class="def-input" name="searchStrings" value="{{$search['type']=='text' ? $search['value'] : ''}}" placeholder="{{__('ui.search')}}..." required />
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
        @if ( $search['type'] == 'text' )
            <div class="mailer-suggestion">
                <p class="user-text-request" hidden>{{$search['value']}}</p>
                <button id="addTextToMailer">{{__('ui.mailerSuggestText')}}</button>
                <a id="whatIsMailerHelp" href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
                <div class="algolia-logo">
                    <img src="{{asset('icons/algoliaIcon.svg')}}" alt="{{__('alt.keyword')}}">
                </div>
            </div>
        @elseif ( $search['type'] == 'tags' )
            <div id="searchTags">
                @foreach ($search['value'] as $id => $tag)
                    <a class="itemTag" href="{{ route('search.tag', $id) }}">{{$tag}}</a> 
                    <span>></span>
                @endforeach
            </div>
            <div class="mailer-suggestion mailer-tag-suggestion">
                <button id="addTagToMailer" class="{{array_key_last($search['value'])}}">{{__('ui.mailerSuggestTag')}}</button>
                <a id="whatIsMailerHelp" href="{{route('faq')}}#WhatIsMailer">({{__('ui.whatIsMailer')}})</a>
            </div>
        @elseif ( $search['type'] == 'author' )
            <div id="searchAuthor">
                <p>{{__('ui.searchByAuthor')}} <span>{{$search['value']['name']}}</span>:</p>
            </div>
            <div class="mailer-suggestion">
                <button id="addAuthorToMailer" class="{{$search['value']['id']}}">{{__('ui.mailerSuggestAuthor')}}</button>
                <a id="whatIsMailerHelp"href="{{route('faq')}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
            </div>   
        @endif
        @if ($search['isEmpty'])
            <div class="empty-search-wraper">
                <img class="empty-search-icon fail-icon" src="{{asset('icons/failIcon.svg')}}" alt="{{__('alt.keyword')}}">
                <p class="empty-search-text">{{__('ui.searchFail')}}</p>
            </div>
        @else
            <div class="filters">
                <h2 class="filters-heading">{{__('ui.filters')}}:</h2>

                <div class="filter filter-cost">
                    <span class="filter-name">{{__('ui.cost')}}:</span>
                    <div class="filter-input">
                        <input class="def-input input-cost cost-from-input" name="costFrom" type="number" placeholder="{{__('ui.from')}}">
                        <span class="cost-delimeter">-</span>
                        <input class="def-input input-cost cost-to-input" name="costTo" type="number" placeholder="{{__('ui.to')}}">
                        <div class="def-select-wraper">
                            <select class="def-select currency-select" id="inputCurrency" name="currency">
                                <option value="UAH">{{__('ui.grivna')}}</option>
                                <option value="USD">{{__('ui.dollar')}}</option>
                            </select>
                            <span class="arrow arrowDown"></span>
                        </div>
                    </div>
                    <span class="filters-delimeter">,</span>
                </div>

                <div class="filter filter-condition">
                    <span class="filter-name">{{__('ui.condition')}}:</span>
                    <div class="filter-input">
                        <div class="def-select-wraper">
                            <select class="def-select condition-select" name="condition">
                                <option value="1">{{__('ui.notSpecified')}}</option>
                                <option value="2">{{__('ui.conditionNew')}}</option>
                                <option value="3">{{__('ui.conditionSH')}}</option>
                                <option value="4">{{__('ui.conditionForParts')}}</option>
                            </select>
                            <span class="arrow arrowDown"></span>
                        </div>
                    </div>
                    <span class="filters-delimeter">,</span>
                </div>

                <div class="filter filter-authorRole">
                    <span class="filter-name">{{__('ui.authorRole')}}:</span>
                    <div class="filter-input">
                        <div class="def-select-wraper">
                            <select class="def-select author-role-select" name="authorRole">
                                <option value="1">{{__('ui.notSpecified')}}</option>
                                <option value="2">{{__('ui.private')}}</option>
                                <option value="3">{{__('ui.business')}}</option>
                            </select>
                            <span class="arrow arrowDown"></span>
                        </div>
                    </div>
                    <span class="filters-delimeter">,</span>
                </div>

                <div class="filter region-filter">
                    <span class="filter-name">{{__('ui.region')}}:</span>
                    <div class="filter-input">
                        <div class="def-select-wraper">
                            <x-region-select locale='{{app()->getLocale()}}'/>
                            <span class="arrow arrowDown"></span>
                        </div>
                    </div>
                    <span class="filters-delimeter">,</span>
                </div>

                <div class="filter filter-sorting">
                    <span class="filter-name">{{__('ui.sort')}}:</span>
                    <div class="filter-input">
                        <div class="def-select-wraper">
                            <select class="def-select sort-select" name="sort">
                                <option value="1">{{__('ui.notSpecified')}}</option>
                                <option value="2">{{__('ui.sortNew')}}</option>
                                <option value="3">{{__('ui.sortCheap')}}</option>
                                <option value="4">{{__('ui.sortExpensive')}}</option>
                            </select>
                            <span class="arrow arrowDown"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-settings"></div>
        @endif
    </div>

    <!-- DELETE -->
    <form method="POST" action="{{route('post.filter')}}" hidden>
        @csrf
        <input class="def-input" style="width: 30%" type="text" name="filters" value='{"currency":"USD","costFrom":"140000","sort":"2","condition":"1"}'>
        <input class="def-input" style="width: 30%" type="text" name="postsIds" value="{{$postsIds}}">
        <button class="def-button">example</button>
    </form >

    <!-- Search result posts -->
    <div id="searched-items">
        <div class="posts-amount">
            <p class="posts-amount-text">{{__('ui.searchAmount')}}: <span class="posts-amount-text">{{$postsAmount}}</span></p>
        </div>
        <div class="loading-gif hidden">
            <img src="{{asset('icons/loadingIcon.svg')}}" alt="">
        </div>
        <div class="empty-search-wraper hidden">
            <img class="empty-search-icon fail-icon" src="{{asset('icons/failIcon.svg')}}" alt="{{__('alt.keyword')}}">
            <p class="empty-search-text">{{__('ui.searchFail')}}</p>
        </div>
        <x-items :posts="$posts_list" button='addToFav' />
    </div>
    
    <!-- Pagination -->
    <div class="pagination-field">
        {{ $posts_list->appends(request()->except('page'))->links() }}
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            var filters = new Object();
            filters.currency = 'UAH';

            function filter(f) {
                $('.pagination-field').empty();
                // make loading gif
                filterLable(f);
                $('#items').addClass('hidden');
                $('div.loading-gif').removeClass('hidden');
                $('.empty-search-wraper').addClass('hidden');
                $.ajax({
                    type: "POST",
                    url: "{{route('post.filter')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        filters: JSON.stringify(f),
                        postsIds: "{{$postsIds}}"
                    },
                    success: function(data) {
                        if (data) {
                            $('#items').remove();
                            $('#searched-items').append(data);
                            $('div.posts-amount span').text( $('.item').length );
                        } else {
                            $('#items').remove();
                            $('.empty-search-wraper').removeClass('hidden');
                        }
                        $('div.loading-gif').addClass('hidden');
                    },
                    error: function() {
                        //print error massage and remove wait cursor
                        $('div.loading-gif').addClass('hidden');
                        $('#items').removeClass('hidden');
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            }

            $('.user-settings').on("mouseenter", "button.remove-setting", function(){
                $(this).parent().addClass('hover-lable');
            });

            $('.user-settings').on("mouseleave", "button.remove-setting", function(){
                $(this).parent().removeClass('hover-lable');
            });

            $('.user-settings').on("click", "button.remove-setting", function(){
                filterName = $(this).attr('class').split(' ')[0];
                if (filterName=='currency') {
                    return;
                }
                // rechoose def value of select
                else if (filterName=='costFrom' || filterName=='costTo') {
                    $('input[name='+filterName+']').val('');
                }else if (filterName=='condition' || filterName=='authorRole' || filterName=='sort') {
                    $('select[name='+filterName+']').val('1');
                }else if (filterName=='region') {
                    $('select.region-select').val('0');
                }
                delete filters[filterName];
                filter(filters);
                $(this).remove();
            });

            function filterLable(filters) {
                $('.user-settings').empty();
                var label = '';
                for (filterName in filters) {   
                    if ( filterName=='currency' ) {
                        if (!filters.costFrom && !filters.costTo) {
                            continue;
                        } else {
                            label = filters[filterName];
                        }
                    } else if (filterName=='costFrom') {
                        label = '> ' + filters[filterName];
                    } else if (filterName=='costTo') {
                        label = '< ' + filters[filterName];
                    } else if (filterName=='condition') {
                        if (filters[filterName]==1) {
                            continue;
                        }
                        label = conditionReadable(filters[filterName]);
                    } else if (filterName=='authorRole') {
                        if (filters[filterName]==1) {
                            continue;
                        }
                        label = typeReadable(filters[filterName]);
                    } else if (filterName=='region') {
                        if (filters[filterName]==0) {
                            continue;
                        }
                        label = regionReadable(filters[filterName]);
                    } else if (filterName=='sort') {
                        if (filters[filterName]==1) {
                            continue;
                        }
                        label = sortReadable(filters[filterName]);
                    }
                    $('.user-settings').append('<div class="user-setting"><span class="setting-name">'+label+'</span><button class="'+filterName+' remove-setting" title="{{__("ui.delete")}}"><img src="{{asset("icons/closeWhiteIcon.svg")}}" alt="{{__("alt.keyword")}}"></button></div>');
                }
            }

            function conditionReadable(value) {
                switch (value) {
                    case '2':
                        return "{{__('ui.conditionNew')}}";
                    case '3':
                        return "{{__('ui.conditionSH')}}";
                    case '4':
                        return "{{__('ui.conditionForParts')}}";
                    default:
                        break;
                }
            }

            function typeReadable(value) {
                switch (value) {
                    case '2':
                        return "{{__('ui.private')}}";
                    case '3':
                        return "{{__('ui.business')}}";
                    default:
                        break;
                }
            }

            function sortReadable(value) {
                switch (value) {
                    case '2':
                        return "{{__('ui.sortNew')}}";
                    case '3':
                        return "{{__('ui.sortCheap')}}";
                    case '4':
                        return "{{__('ui.sortExpensive')}}";
                    default:
                        break;
                }
            }

            function regionReadable(value) {
                switch (value) {
                    case '1':
                        return "{{__('ui.regionCrimea')}}";
                    case '2':
                        return "{{__('ui.regionVinnytsia')}}";
                    case '3':
                        return "{{__('ui.regionVolyn')}}";
                    case '4':
                        return "{{__('ui.regionDnipropetrovsk')}}";
                    case '5':
                        return "{{__('ui.regionDonetsk')}}";
                    case '6':
                        return "{{__('ui.regionZhytomyr')}}";
                    case '7':
                        return "{{__('ui.regionCarpathian')}}";
                    case '8':
                        return "{{__('ui.regionZaporozhye')}}";
                    case '9':
                        return "{{__('ui.regionIvano-Frankivsk')}}";
                    case '10':
                        return "{{__('ui.regionKiev')}}";
                    case '11':
                        return "{{__('ui.regionKirovograd')}}";
                    case '12':
                        return "{{__('ui.regionLuhansk')}}";
                    case '13':
                        return "{{__('ui.regionLviv')}}";
                    case '14':
                        return "{{__('ui.regionMykolaiv')}}";
                    case '15':
                        return "{{__('ui.regionOdessa')}}";
                    case '16':
                        return "{{__('ui.regionPoltava')}}";
                    case '17':
                        return "{{__('ui.regionRivne')}}";
                    case '18':
                        return "{{__('ui.regionSumy')}}";
                    case '19':
                        return "{{__('ui.regionTernopil')}}";
                    case '20':
                        return "{{__('ui.regionKharkiv')}}";
                    case '21':
                        return "{{__('ui.regionKherson')}}";
                    case '22':
                        return "{{__('ui.regionKhmelnytsky')}}";
                    case '23':
                        return "{{__('ui.regionCherkasy')}}";
                    case '24':
                        return "{{__('ui.regionChernivtsi')}}";
                    case '25':
                        return "{{__('ui.regionChernihiv')}}";
                    default:
                        break;
                }
            }

            // user uses costFrom filter
            $('.cost-from-input').focusout(function(){
                var newVal = $(this).val();
                // edit filters array
                newVal=="" ? delete filters.costFrom : filters.costFrom=newVal;
                filter(filters);
            });

            // user uses costTo filter
            $('.cost-to-input').focusout(function(){
                var newVal = $(this).val();
                // edit filters array
                newVal=="" ? delete filters.costTo : filters.costTo=newVal;
                filter(filters);
            });

            // user uses currency filter
            $('.currency-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                filters.currency = newVal;
                filter(filters);
            });

            // user uses condition filter
            $('.condition-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==1 ? delete filters.condition : filters.condition=newVal;
                filter(filters);
            });

            // user uses author role filter
            $('.author-role-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==1 ? delete filters.authorRole : filters.authorRole=newVal;
                filter(filters);
            });

            // user uses region filter
            $('.region-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==0 ? delete filters.region : filters.region=newVal;
                filter(filters);
            });

            // user uses sorting filter
            $('.sort-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==1 ? delete filters.sort : filters.sort=newVal;
                filter(filters);
            });

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
                var searchString = $('p.user-text-request').text();
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