@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components/post_posts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/tags.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/subscription_required.css')}}" />
@endsection

@section('content')

    <div class="bc-nav">
        <ul>
            <li><a class="bc-item" href="{{loc_url(route('home'))}}">{{__('ui.home')}}</a></li>
            @if ( $search['type'] == 'tags' )
                <li><p class="bc-item bc-delim">&#x02192;</p></li>
                <li><a class="bc-item not-allowed" href="{{loc_url(route('home'))}}">{{__('ui.catalog')}}</a></li>
                @foreach ($search['value'] as $key => $name)
                    <li><p class="bc-item bc-delim">&#x02192;</p></li>
                    <li><a class="bc-item" href="{{loc_url(route('tag-'.$key))}}">{{$name}}</a></li>
                @endforeach
            @elseif ( $search['type'] == 'text' )
                <li><p class="bc-item bc-delim">&#x02192;</p></li>
                <li><a class="bc-item" href="{{loc_url(route('search', ['text'=>$search['value']]))}}">"{{$search['value']}}"</a></li>
                @if (isset($resByTag) && $resByTag['searchedTagMap'])
                    @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
                        <li><p class="bc-item bc-delim">&#x02192;</p></li>    
                        <li><a class="bc-item" href="{{loc_url(route('search', ['text'=>$search['value'], 'tag'=>$tagUrl]))}}">{{$tag}}</a></li>
                    @endforeach
                @endif  
            @elseif ( $search['type'] == 'type' )
                <li><p class="bc-item bc-delim">&#x02192;</p></li>
                <li><a class="bc-item" href="{{loc_url(route('search', ['type'=>$search['url']]))}}">{{$search['value']}}</a></li>
                @if (isset($resByTag) && $resByTag['searchedTagMap'])
                    @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
                        <li><p class="bc-item bc-delim">&#x02192;</p></li>    
                        <li><a class="bc-item" href="{{loc_url(route('search', ['type'=>$search['url'], 'tag'=>$tagUrl]))}}">{{$tag}}</a></li>
                    @endforeach
                @endif  
            @elseif ( $search['type'] == 'author' )
                <li><p class="bc-item bc-delim">&#x02192;</p></li>
                <li><a class="bc-item" href="{{loc_url(route('search', ['author'=>$search['value']['url']]))}}">{{$search['value']['name']}}</a></li>
                @if (isset($resByTag) && $resByTag['searchedTagMap'])
                    @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
                        <li><p class="bc-item bc-delim">&#x02192;</p></li>    
                        <li><a class="bc-item" href="{{loc_url(route('search', ['author'=>$search['value']['url'], 'tag'=>$tagUrl]))}}">{{$tag}}</a></li>
                    @endforeach
                @endif    
            @endif
        </ul>
    </div>

    <a id="filter-beacon"></a>

    <!-- Search result status show -->
    <div id="search-status">
        @if ( $search['type'] == 'text' )
            <div id="searchText">
                <p class="search-status-text">{{__('ui.searchByText')}}: <span class="search-status-value" >{{$search['value']}}</span></p>
                @if (isset($resByTag) && $resByTag['searchedTag'])
                    <p class="search-status-text status-choosed-tags">{{__('ui.choosedFromTags')}}: <a title="{{__('ui.delete')}}" class="search-status-value status-delete" href="{{loc_url(route('search', ['text'=>$search['value']]))}}">{{$resByTag['searchedTag']}}</a>
                @endif
            </div>
            <div class="mailer-suggestion">
                <p class="user-text-request" hidden>{{$search['value']}}</p>
                <button id="addTextToMailer">{{__('ui.mailerSuggestText')}}</button>
                <a id="whatIsMailerHelp" href="{{loc_url(route('faq'))}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
                <div class="algolia-logo">
                    <img src="{{asset('icons/algoliaIcon.svg')}}" alt="{{__('alt.keyword')}}">
                </div>
            </div>
        @elseif ( $search['type'] == 'tags' )
            <div id="searchTags">
                @foreach ($search['value'] as $id => $tag)
                    <a class="itemTag" href="{{ loc_url(route('tag-'.$id)) }}">{{$tag}}</a>
                    <span class="item-tag-delim">></span>
                @endforeach
            </div>
            <div class="mailer-suggestion mailer-tag-suggestion">
                <button id="addTagToMailer" class="{{array_key_last($search['value'])}}">{{__('ui.mailerSuggestTag')}}</button>
                <a id="whatIsMailerHelp" href="{{loc_url(route('faq'))}}#WhatIsMailer">({{__('ui.whatIsMailer')}})</a>
            </div>
        @elseif ( $search['type'] == 'author' )
            <div id="searchAuthor">
                <p class="search-status-text">{{__('ui.searchByAuthor')}}: <a class="search-status-value" href="{{loc_url(route('search', ['author'=>$search['value']['url']]))}}">{{$search['value']['name']}}</a></p>
            </div>
            <div class="mailer-suggestion">
                <button id="addAuthorToMailer" class="{{$search['value']['id']}}">{{__('ui.mailerSuggestAuthor')}}</button>
                <a id="whatIsMailerHelp"href="{{loc_url(route('faq'))}}#WhatIsMailer">{{__('ui.whatIsMailer')}}</a>
            </div>
        @elseif ( $search['type'] == 'type' )
            <div id="searchType">
                <p class="search-status-text">{{__('ui.searchByType')}}: <span class="search-status-value">{{$search['value']}}</span></p>
                @if (isset($resByTag) && $resByTag['searchedTag'])
                    <p class="search-status-text status-choosed-tags">{{__('ui.choosedFromTags')}}: <a title="{{__('ui.delete')}}" class="search-status-value status-delete" href="{{loc_url(route('search', ['type'=>$search['url']]))}}">{{$resByTag['searchedTag']}}</a>
                @endif
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
                        <input class="def-input input-cost cost-from-input" name="costFrom" type="text" placeholder="{{__('ui.from')}}">
                        <span class="cost-delimeter">-</span>
                        <input class="def-input input-cost cost-to-input" name="costTo" type="text" placeholder="{{__('ui.to')}}">
                        <div class="def-select-wraper">
                            <select class="def-select currency-select" id="inputCurrency" name="currency">
                                <option value="UAH">{{__('ui.grivna')}}</option>
                                <option value="USD">{{__('ui.dollar')}}</option>
                            </select>
                            <span class="arrow arrowDown"></span>
                        </div>
                    </div>
                </div>

                @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                @else
                    <div class="filter region-filter">
                        <span class="filter-name">{{__('ui.region')}}:</span>
                        <div class="filter-input">
                            <div class="def-select-wraper">
                                <x-region-select locale='{{app()->getLocale()}}'/>
                                <span class="arrow arrowDown"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                @else
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
                    </div>
                @endif

                @if ( $search['type'] != 'type' )
                    <div class="filter filter-type">
                        <span class="filter-name">{{__('ui.postType')}}:</span>
                        <div class="filter-input">
                            <div class="def-select-wraper">
                                <select class="def-select type-select" name="role">
                                    <option value="0">{{__('ui.notSpecified')}}</option>
                                    @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                                        <option value="5">{{__('ui.postTypeGiveS')}}</option>
                                        <option value="6">{{__('ui.postTypeGetS')}}</option>
                                    @elseif ( $search['type'] == 'tags' && $search['tag_type'] == 'eq' )
                                        <option value="1">{{__('ui.postTypeSell')}}</option>
                                        <option value="2">{{__('ui.postTypeBuy')}}</option>
                                        <option value="3">{{__('ui.postTypeRent')}}</option>
                                        <option value="4">{{__('ui.postTypeLeas')}}</option>
                                    @else
                                        <option value="1">{{__('ui.postTypeSell')}}</option>
                                        <option value="2">{{__('ui.postTypeBuy')}}</option>
                                        <option value="3">{{__('ui.postTypeRent')}}</option>
                                        <option value="4">{{__('ui.postTypeLeas')}}</option>
                                        <option value="5">{{__('ui.postTypeGiveS')}}</option>
                                        <option value="6">{{__('ui.postTypeGetS')}}</option>
                                    @endif
                                </select>
                                <span class="arrow arrowDown"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                @else
                    <div class="filter filter-role">
                        <span class="filter-name">{{__('ui.postRole')}}:</span>
                        <div class="filter-input">
                            <div class="def-select-wraper">
                                <select class="def-select role-select" name="role">
                                    <option value="0">{{__('ui.notSpecified')}}</option>
                                    <option value="1">{{__('ui.postRolePrivate')}}</option>
                                    <option value="2">{{__('ui.postRoleBusiness')}}</option>
                                </select>
                                <span class="arrow arrowDown"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ( $search['type'] != 'tags' )
                    <div class="filter filter-thread">
                        <span class="filter-name">{{__('ui.thread')}}:</span>
                        <div class="filter-input">
                            <div class="def-select-wraper">
                                <select class="def-select thread-select" name="thread">
                                    <option value="0">{{__('ui.notSpecified')}}</option>
                                    <option value="1">{{__('ui.equipment')}}</option>
                                    <option value="2">{{__('ui.service')}}</option>
                                </select>
                                <span class="arrow arrowDown"></span>
                            </div>
                        </div>
                    </div>
                @endif

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

            @if (isset($resByTag) && $resByTag['map'])
                <div class="result-by-tag">
                    @foreach ($resByTag['map'] as $tagId => $tag)
                        @if ($search['type']=='text')
                            <a href="{{loc_url(route('search', [$search['type']=>$search['value'], 'tag'=>$tag['url']]))}}">{{$tag['name']}} <span>{{$tag['amount']}}</span></a>
                        @elseif ($search['type']=='author')
                            <a href="{{loc_url(route('search', [$search['type']=>$search['value']['url'], 'tag'=>$tag['url']]))}}">{{$tag['name']}} <span>{{$tag['amount']}}</span></a>
                        @elseif ($search['type']=='type')
                            <a href="{{loc_url(route('search', ['type'=>$search['url'], 'tag'=>$tag['url']]))}}">{{$tag['name']}} <span>{{$tag['amount']}}</span></a>
                        @elseif ($search['type']=='tags' || $search['type']=='none')
                            <a href="{{loc_url(route('tag-'.$tagId))}}">{{$tag['name']}} <span>{{$tag['amount']}}</span></a>
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="user-settings"></div>
        @endif
    </div>

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
        <div class="filtered-items">
            <x-items :posts="$posts_list" button='addToFav' :translated="$translated"/>

            <!-- Pagination -->
            <div class="pagination-field">
                {{ $posts_list->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>

    <x-subscription-required role='1'/>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/subscription_required.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var filters = new Object();
            filters.currency = 'UAH';

            //remove last '>' symbol from searched tags
            $('#searchTags span.item-tag-delim').last().remove();
            $('#searchText span.item-tag-delim').last().remove();

            //handle manual ajax pagination
            $('body').on('click', 'div.filter-pagination a', function(e){
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                window.location.href = "#filter-beacon";
                fetch_data(page);
            });

            function fetch_data(page)
            {
                $('div.filtered-items').addClass('hidden'); //hide old items
                $('div.loading-gif').removeClass('hidden'); //show loading gif
                $.ajax({
                    type: "POST",
                    url: "{{route('post.filter')}}?page="+page,
                    data: {
                        _token: "{{ csrf_token() }}",
                        filters: JSON.stringify(filters),
                        postsIds: "{{$postsIds}}"
                    },
                    success: function(data) {
                        $('div.filtered-items').empty(); // remove old items
                        $('div.loading-gif').addClass('hidden'); //hide loading gif
                        if (data) {
                            $('div.filtered-items').removeClass('hidden').append(data); //append+show new items
                            $('div.posts-amount span').text( $('p.filtered-items-no').text() ); //update items amount
                            $('.empty-search-wraper').addClass('hidden'); //hide empty items preview (messy)
                        } else {
                            $('div.posts-amount span').text( 0 ); // update items amount
                            $('.empty-search-wraper').removeClass('hidden'); // add empty items preview
                        }
                        window.location.hash = "filter-beacon";
                    },
                    error: function() {
                        //print error massage and remove wait cursor
                        $('div.loading-gif').addClass('hidden'); // hide loading gif
                        $('div.filtered-items').removeClass('hidden'); // show old items
                        showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
                    }
                });
            }

            function filter() {
                filterLable();
                // show initial pagination if there is no filters, else show only ajax pagination
                $('div.filtered-items').addClass('hidden'); //hide old items
                $('div.loading-gif').removeClass('hidden'); //show loading gif
                $.ajax({
                    type: "POST",
                    url: "{{loc_url(route('post.filter'))}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        filters: JSON.stringify(filters),
                        postsIds: "{{$postsIds}}"
                    },
                    success: function(data) {
                        $('div.filtered-items').empty(); // remove old items
                        $('div.loading-gif').addClass('hidden'); //hide loading gif
                        if (data) {
                            $('div.filtered-items').removeClass('hidden').append(data); //append+show new items
                            $('div.posts-amount span').text( $('p.filtered-items-no').text() ); //update items amount
                            $('.empty-search-wraper').addClass('hidden'); //hide empty items preview (messy)
                        } else {
                            $('div.posts-amount span').text( 0 ); // update items amount
                            $('.empty-search-wraper').removeClass('hidden'); // add empty items preview
                        }
                    },
                    error: function() {
                        //print error massage and remove wait cursor
                        $('div.loading-gif').addClass('hidden'); // hide loading gif
                        $('div.filtered-items').removeClass('hidden'); // show old items
                        showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
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
                filter();
                $(this).remove();
            });

            function filterLable() {
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
                        var currency = $('#inputCurrency').children('option:selected').val();
                        label = "{{__('ui.from')}}" + ' ' + NumberToCurrency( currency, filters[filterName] );
                    } else if (filterName=='costTo') {
                        var currency = $('#inputCurrency').children('option:selected').val();
                        label = "{{__('ui.to')}}" + ' ' + NumberToCurrency( currency, filters[filterName] );
                    } else if (filterName=='condition') {
                        if (filters[filterName]==1) {
                            continue;
                        }
                        label = $('.condition-select').children('option:selected').html();
                    } else if (filterName=='role') {
                        if (filters[filterName]==0) {
                            continue;
                        }
                        label = $('.role-select').children('option:selected').html();
                    } else if (filterName=='type') {
                        if (filters[filterName]==0) {
                            continue;
                        }
                        label = $('.type-select').children('option:selected').html();
                    } else if (filterName=='region') {
                        if (filters[filterName]==0) {
                            continue;
                        }
                        label = $('.region-select').children('option:selected').html();
                    } else if (filterName=='sort') {
                        if (filters[filterName]==1) {
                            continue;
                        }
                        label = $('.sort-select').children('option:selected').html();
                    } else if (filterName=='thread') {
                        if (filters[filterName]==0) {
                            continue;
                        }
                        label = $('.thread-select').children('option:selected').html();
                    }
                    $('.user-settings').append('<div class="user-setting"><span class="setting-name">'+label+'</span><button class="'+filterName+' remove-setting" title="{{__("ui.delete")}}"><img src="{{asset("icons/closeWhiteIcon.svg")}}" alt="{{__("alt.keyword")}}"></button></div>');
                }
            }

            // user uses costFrom filter
            $('.cost-from-input').focusout(function(){
                var newVal = $(this).val();
                // edit filters array
                if (newVal){
                    filters.costFrom = CurrencyToNumber(newVal);
                    var currency = $('#inputCurrency').children('option:selected').val();
                    newVal = NumberToCurrency( currency, $(this).val() );
                    $(this).val(newVal);
                } else {
                    delete filters.costFrom;
                }
                filter();
            });

            // user uses costTo filter
            $('.cost-to-input').focusout(function(){
                var newVal = $(this).val();
                // edit filters array
                if (newVal){
                    filters.costTo = CurrencyToNumber(newVal);
                    var currency = $('#inputCurrency').children('option:selected').val();
                    newVal = NumberToCurrency( currency, $(this).val() );
                    $(this).val(newVal);
                } else {
                    delete filters.costFrom;
                }
                filter();
            });

            // remove currency format when user clicks on input
            $('.cost-from-input, .cost-to-input').focusin(function(){
                newVal = $(this).val()
                    ? CurrencyToNumber($(this).val())
                    : '';
                $(this).val(newVal);
            });

            function CurrencyToNumber(str){
                return str.replace(/[^0-9.]+/g,"");
            }

            function NumberToCurrency(currency, string) {
                res = CurrencyToNumber(string);
                if ( res.includes('.') ) {
                    var firstDot = res.indexOf('.');
                    var dots = (res.match(/\./g) || []).length;
                    if ( dots != 1 ) {
                        res = res.replace(/\./g,"");
                        res = res.slice(0, firstDot) + '.' + res.slice(firstDot);
                    }
                    var coins = res.substring(firstDot);
                    if ( coins.length > 3 ) {
                        toCrop = coins.length - 3;
                        res = res.substring(0, res.length-toCrop);
                    } else if ( coins.length < 3 ) {
                        // add coins
                        toAdd = 3-coins.length;
                        res = res+'0';
                        if (toAdd == 2) {
                            res = res+'0';
                        }
                    }
                } else {
                    res = res + ".00";
                }
                for (let i=res.length-4, step=1; i >= 0; i--,step++) {
                    if (step == 4) {
                        res = res.slice(0, i+1) + ',' + res.slice(i+1);
                        step = 1;
                    }

                }
                currency=='UAH' ? res='₴'+res : res='$'+res;
                return res;
            }

            // user uses currency filter
            $('.currency-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                filters.currency = newVal;
                //change currencu sign
                oldFromCost = $(".cost-from-input").val();
                oldToCost = $(".cost-to-input").val();
                newCurrency = $(this).children('option:selected').val();
                newCurrency = newCurrency=='UAH' ? '₴' : '$';
                if (oldFromCost) {
                    $(".cost-from-input").val( oldFromCost.replace(oldFromCost[0], newCurrency) );
                }
                if (oldToCost) {
                    $(".cost-to-input").val( oldToCost.replace(oldToCost[0], newCurrency) );
                }
                filter();
            });

            // user uses condition filter
            $('.condition-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==1 ? delete filters.condition : filters.condition=newVal;
                filter();
            });

            // user uses legal type filter
            $('.role-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==0 ? delete filters.role : filters.role=newVal;
                filter();
            });

            // user uses psot type filter
            $('.type-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==0 ? delete filters.type : filters.type=newVal;
                filter();
            });

            // user uses region filter
            $('.region-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==0 ? delete filters.region : filters.region=newVal;
                filter();
            });

            // user uses thread filter
            $('.thread-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==0 ? delete filters.thread : filters.thread=newVal;
                filter();
            });

            // user uses sorting filter
            $('.sort-select').change(function(){
                var newVal = $(this).children('option:selected').val();
                // edit filters array
                newVal==1 ? delete filters.sort : filters.sort=newVal;
                filter();
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
                    success: function(data) {
                        if (data) {
                            showPopUpMassage(true, "{{ __('messages.mailerTextAdded') }}")
                        } else {
                            showPopUpMassage(false, "{{ __('messages.requirePremium') }}");
                            showSubscriptionAlert();
                        }
                        // Remove wait cursor
                        button.removeClass('loading');
                    },
                    error: function(xhr, status, error) {
                        xhr['status'] == 403
                            ? showPopUpMassage(false, "{{ __('messages.authError') }}")
                            : showPopUpMassage(false, "{{ __('messages.error') }}");
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
                        if (data == 1) {
                            showPopUpMassage(true, "{{ __('messages.mailerTagAdded') }}");
                        } else if ( data == -1) {
                            showPopUpMassage(false, "{{ __('messages.mailerTagExists') }}");
                        } else if (data == -2) {
                            // Error, no premium
                            showPopUpMassage(false, "{{ __('messages.requirePremium') }}");
                            showSubscriptionAlert();
                        }
                        button.removeClass('loading');
                    },
                    error: function(xhr, status, error) {
                        xhr['status'] == 403
                            ? showPopUpMassage(false, "{{ __('messages.authError') }}")
                            : showPopUpMassage(false, "{{ __('messages.error') }}");
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
                        if (data == 1) {
                            // Author was added to Mailer
                            showPopUpMassage(true, "{{ __('messages.mailerAddedAuthor') }}");
                        } else if (data == 0) {
                            // Author exist in mailer Mailer
                            showPopUpMassage(false, "{{ __('messages.mailerAuthorExists') }}");
                        } else if (data == -1) {
                            // Error, too many authors
                            showPopUpMassage(false, "{{ __('messages.mailerTooManyAuthors') }}");
                        } else if (data == -2) {
                            // Error, no premium
                            showPopUpMassage(false, "{{ __('messages.requirePremium') }}");
                            showSubscriptionAlert();
                        }
                        // Remove wait cursor
                        button.removeClass('loading');
                    },
                    error: function(xhr, status, error) {
                        xhr['status'] == 403
                            ? showPopUpMassage(false, "{{ __('messages.authError') }}")
                            : showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            });

            //if user tries to add his oun item to fav list
            $('body').on("click", ".addToFavButtonBlocked", function(){
                showPopUpMassage(false, "{{ __('messages.postAddFavPersonal') }}");
            });

            //action when user clicks on addToFav icon
            $('body').on("click", ".addToFavButton", function(){
                var postId = getIdFromClasses($(this).attr("class"), 'id_');
                //make cursor wait
                var button = $(this);
                var img = button.children('img');
                button.addClass('loading');
                //send Ajax reqeust to add Item to fav list of user
                $.ajax({
                    type: "GET",
                    url: '{{route("toFav")}}',
                    data: { post_id: postId },
                    success: function(data) {
                        //if no server errors, change digit of favItemsAmount in nav bar
                        //and change color of AddToFav btn img
                        if ( data ) {
                            var n = $("#favItemsTab span").text();
                            n = parseInt(n,10);
                            //visualize removing from fav list
                            if ( img.hasClass('active-fav-img') ) {
                                $("#favItemsTab span").html(n-1);
                                img.attr("src", "{{ asset('icons/heartWhiteIcon.svg') }}");
                                showPopUpMassage(true, "{{ __('messages.postRemovedFav') }}");
                            //visualize adding to fav list
                            } else {
                                $("#favItemsTab span").html(n+1);
                                img.attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");
                                showPopUpMassage(true, "{{ __('messages.postAddedFav') }}");
                            }
                            img.toggleClass('active-fav-img');
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