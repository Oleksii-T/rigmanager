@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/subscription_required.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components/special_inputs.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components/search_posts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}" />
@endsection

@section('content')

    <div class="bc-nav">
        <ul>
            <li><a class="bc-item" href="{{loc_url(route('home'))}}">{{__('ui.home')}}</a></li>
            <li><p class="bc-item bc-delim">&#x02192;</p></li>
            <li><a class="bc-item" href="{{loc_url(route('list'))}}">{{__('ui.catalog')}}</a></li>
            @if ( $search['type'] == 'tags' )
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

    @if ($posts_list->isNotEmpty())
    <div class="search-wraper">
        <div class="filters">
            @if (!$search['isEmpty'])
                <div class="column-title">
                    <h2>{{__('ui.filters')}}</h2>
                </div>
                <div class="filters">
                    <div class="filter filter-cost">
                        <h5 class="filter-name">{{__('ui.cost')}},</h5>
                        <div class="filter-currency">
                            <span class="currency-lable active-currency" id="currency-uah-lable">UAH</span>

                            <label class="switch currency-switch" for="currency-usd">
                                <input id="currency-usd" name="currency-usd" type="checkbox" value="1">
                                <span class="slider"></span>
                            </label>

                            <span class="currency-lable" id="currency-usd-lable">USD</span>
                        </div>
                        <div class="filter-cost-input">
                            <input class="input-cost cost-from-input" name="costFrom" type="text" placeholder="{{__('ui.from')}}">
                            <span class="cost-delimeter">-</span>
                            <input class="input-cost cost-to-input" name="costTo" type="text" placeholder="{{__('ui.to')}}">
                        </div>
                    </div>

                    @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                    @else
                        <div class="filter region-filter">
                            <h5 class="filter-name">{{__('ui.region')}}</h5>
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
                            <h5 class="filter-name">{{__('ui.condition')}}</h5>
                            <div class="filter-input radio" id="condition">
                                <label class="cb-container filter-checked" for="condition-new">{{__('ui.conditionNew')}}
                                    <input id="condition-new" type="checkbox" name="conditions[]" value="2" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <label class="cb-container filter-checked" for="condition-sh">{{__('ui.conditionSH')}}
                                    <input id="condition-sh" type="checkbox" name="conditions[]" value="3" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <label class="cb-container filter-checked" for="condition-parts">{{__('ui.conditionForParts')}}
                                    <input id="condition-parts" type="checkbox" name="conditions[]" value="4" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                            </div>
                        </div>
                    @endif

                    @if ( $search['type'] != 'type' )
                        <div class="filter filter-type">
                            <h5 class="filter-name">{{__('ui.postType')}}</h5>
                            <div class="filter-input radio" id="type">
                                @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                                    <label class="cb-container filter-checked" for="type-give-se">{{__('ui.postTypeGiveS')}}
                                        <input id="type-give-se" type="checkbox" name="types[]" value="5" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-get-se">{{__('ui.postTypeGetS')}}
                                        <input id="type-get-se" type="checkbox" name="types[]" value="6" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                @elseif ( $search['type'] == 'tags' && $search['tag_type'] == 'eq' )
                                    <label class="cb-container filter-checked" for="type-sell">{{__('ui.postTypeSell')}}
                                        <input id="type-sell" type="checkbox" name="types[]" value="1" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-buy">{{__('ui.postTypeBuy')}}
                                        <input id="type-buy" type="checkbox" name="types[]" value="2" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-rent">{{__('ui.postTypeRent')}}
                                        <input id="type-rent" type="checkbox" name="types[]" value="3" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-leas">{{__('ui.postTypeLeas')}}
                                        <input id="type-leas" type="checkbox" name="types[]" value="4" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                @else
                                    <label class="cb-container filter-checked" for="type-sell">{{__('ui.postTypeSell')}}
                                        <input id="type-sell" type="checkbox" name="types[]" value="1" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-buy">{{__('ui.postTypeBuy')}}
                                        <input id="type-buy" type="checkbox" name="types[]" value="2" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-rent">{{__('ui.postTypeRent')}}
                                        <input id="type-rent" type="checkbox" name="types[]" value="3" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-leas">{{__('ui.postTypeLeas')}}
                                        <input id="type-leas" type="checkbox" name="types[]" value="4" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-give-se">{{__('ui.postTypeGiveS')}}
                                        <input id="type-give-se" type="checkbox" name="conditions[]" value="5" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                    <label class="cb-container filter-checked" for="type-get-se">{{__('ui.postTypeGetS')}}
                                        <input id="type-get-se" type="checkbox" name="conditions[]" value="6" checked="checked">
                                        <span class="cb-checkmark"></span>
                                    </label>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                    @else
                        <div class="filter filter-role">
                            <h5 class="filter-name">{{__('ui.postRole')}}</h5>
                            <div class="filter-input radio" id="role">
                                <label class="cb-container filter-checked" for="role-private">{{__('ui.postRolePrivate')}}
                                    <input id="role-private" type="checkbox" name="roles[]" value="1" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <label class="cb-container filter-checked" for="role-business">{{__('ui.postRoleBusiness')}}
                                    <input id="role-business" type="checkbox" name="roles[]" value="2" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                            </div>
                        </div>
                    @endif

                    @if ( $search['type'] != 'tags' && $search['type'] != 'type' )
                        <div class="filter filter-thread">
                            <h5 class="filter-name">{{__('ui.thread')}}</h5>
                            <div class="filter-input radio" id="thread">
                                <label class="cb-container filter-checked" for="thread-eq">{{__('ui.equipment')}}
                                    <input id="thread-eq" type="checkbox" name="threads[]" value="1" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <label class="cb-container filter-checked" for="thread-se">{{__('ui.service')}}
                                    <input id="thread-se" type="checkbox" name="threads[]" value="2" checked="checked">
                                    <span class="cb-checkmark"></span>
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="filter filter-sorting">
                        <h5 class="filter-name">{{__('ui.sort')}}</h5>
                        <div class="filter-input checkbox">
                            <label class="radio-container sort-select" for="sorting-new">{{__('ui.sortNew')}}
                                <input id="sorting-new" type="radio" name="type" value="2" checked="checked">
                                <span class="radio-checkmark"></span>
                            </label>
                            <label class="radio-container sort-select" for="sorting-cheap">{{__('ui.sortCheap')}}
                                <input id="sorting-cheap" type="radio" name="type" value="3">
                                <span class="radio-checkmark"></span>
                            </label>
                            <label class="radio-container sort-select" for="sorting-expensive">{{__('ui.sortExpensive')}}
                                <input id="sorting-expensive" type="radio" name="type" value="4">
                                <span class="radio-checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mailer-suggestion">
                    <p>{{__('ui.mailerSuggestText')}}</p>
                    <img src="{{asset('icons/addToMailerIcon.svg')}}" alt="">
                    <button class="not-allowed">{{__('ui.add')}}</button>
                </div>
            @endif
        </div>
        <div class="search-result">
            <div class="column-title">
                @if ( $search['type'] == 'none' )
                    <h2>{{__('ui.catalog')}}</h2>
                @elseif ( $search['type'] == 'author' )
                    <h2>{{$search['value']['name']}}</h2>
                @elseif ( $search['type'] != 'tags' )
                    <h2>{{$search['value']}}</h2>
                @else 
                    <h2>{{end($search['value'])}}</h2>
                @endif
            </div>
            @if (isset($resByTag) && $resByTag['map'])
                <div class="result-by-tag">
                    @foreach ($resByTag['map'] as $tagId => $tag)
                        @if ($search['type']=='text')
                            <a href="{{loc_url(route('search', [$search['type']=>$search['value'], 'tag'=>$tag['url']]))}}">
                                <span class="rbt-name">{{$tag['name']}}</span>
                                <span class="rbt-amount">{{$tag['amount']}}</span>
                            </a>
                        @elseif ($search['type']=='author')
                            <a href="{{loc_url(route('search', [$search['type']=>$search['value']['url'], 'tag'=>$tag['url']]))}}">
                                <span class="rbt-name">{{$tag['name']}}</span>
                                <span class="rbt-amount">{{$tag['amount']}}</span>
                            </a>
                        @elseif ($search['type']=='type')
                            <a href="{{loc_url(route('search', ['type'=>$search['url'], 'tag'=>$tag['url']]))}}">
                                <span class="rbt-name">{{$tag['name']}} </span>
                                <span class="rbt-amount">{{$tag['amount']}}</span></a>
                        @elseif ($search['type']=='tags' || $search['type']=='none')
                            <a href="{{loc_url(route('tag-'.$tagId))}}">
                                <span class="rbt-name">{{$tag['name']}}</span>
                                <span class="rbt-amount">{{$tag['amount']}}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
            <div id="searched-items">
                <div class="posts-amount">
                    <p>{{__('ui.searchAmount')}}: <span>{{$posts_list->total()}}</span></p>
                </div>
                <div class="loading-gif hidden">
                    <img src="{{asset('icons/loadingIcon.svg')}}" alt="">
                </div>
                <div class="empty-search-wraper hidden">
                    <img class="empty-search-icon fail-icon" src="{{asset('icons/failIcon.svg')}}" alt="{{__('alt.keyword')}}">
                    <p class="empty-search-text">{{__('ui.searchFail')}}. {{__('ui.tryOtherFilters')}}</p>
                </div>
                <div class="filtered-items">
                    <x-search-items :p="$posts_list" :t="$translated"/>
        
                    <!-- Pagination -->
                    <div class="pagination-field">
                        {{ $posts_list->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="empty-search-wraper">
            <img class="empty-search-icon fail-icon" src="{{asset('icons/failIcon.svg')}}" alt="{{__('alt.keyword')}}">
            <p class="empty-search-text">{{__('ui.searchFail')}}.
                <a href="{{ url()->previous() }}">{{__('ui.serverErrorGoBack')}}</a>
            </p>
        </div>
    @endif

    <x-subscription-required role='1'/>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/subscription_required.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/addPostToFav.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            // add psot to fav list
            $('.post-fav').click(function(){
                if ( $(this).hasClass('blocked') ) {
                    showPopUpMassage(false, "{{ __('messages.postAddFavPersonal') }}");
                } else {
                    var blade = new Object();
                    blade['url'] = "{{route('toFav')}}";
                    blade['whiteHeart'] = "{{ asset('icons/heartWhiteIcon.svg') }}";
                    blade['orangeHeart'] = "{{ asset('icons/heartOrangeIcon.svg') }}";
                    blade['removedMes'] = "{{ __('messages.postRemovedFav') }}";
                    blade['addedMes'] = "{{ __('messages.postAddedFav') }}";
                    blade['addErrorMes'] = "{{ __('messages.postAddFavError') }}";
                    blade['errorMes'] = "{{ __('messages.error') }}";
                    addPostToFav($(this), getIdFromClasses($(this).attr("class"), 'id_'), blade);
                }
            });

            //add hover effect on item when hover on addToFav btn
            $(".post-fav").hover(function(){togglePostHover($(this))}, function(){togglePostHover($(this))});
            $(".post-link").hover(function(){togglePostHover($(this))}, function(){togglePostHover($(this))});

            // toggle hover effect on hoverIn/Out on exat post
            function togglePostHover(element) {
                var postId = getIdFromClasses(element.attr("class"), 'id_');
                $("#"+postId+" .post-title p").toggleClass('post-title-hover');
                $("#"+postId+" .post-description").toggleClass('post-description-hover');
                $("#"+postId+" .post-type").toggleClass('post-type-hover');
            }

            // add visual affect to chosen currency
            $('.currency-switch').click(function(){
                var id = $(this).attr('for');
                var label = $('#'+id).prop('checked');
                if ( label ) {
                    $('#currency-usd-lable').addClass('active-currency');
                    $('#currency-uah-lable').removeClass('active-currency');
                } else {
                    $('#currency-usd-lable').removeClass('active-currency');
                    $('#currency-uah-lable').addClass('active-currency');
                }
            });

            // add visual affect to chosen filters
            $('.cb-container.filter-checked').click(function(){
                var id = $(this).attr('for');
                var label = $('#'+id).prop('checked');
                if ( label ) {
                    $(this).addClass('filter-checked');
                } else {
                    $(this).removeClass('filter-checked');
                }
            });

            var filters = new Object();
            filters.currency = "UAH";
            filters.costFrom = null;
            filters.costTo = null;
            filters.region = "0";
            filters.condition = ["2","3","4"];
            filters.role = ['1','2'];
            filters.type = ["1","2","3","4","5","6"];
            filters.thread = ["1","2"];
            filters.sorting = "2";

            //handle manual ajax pagination
            $('body').on('click', 'div.filter-pagination a', function(e){
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                window.location.href = "#filter-beacon";
                fetch_data(page);
            });

            //fetch the filtered items
            function fetch_data(page) {
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

            //make filter
            function filter() {
                toggleFilters();
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
                        toggleFilters();
                    },
                    error: function() {
                        //print error massage and remove wait cursor
                        $('div.loading-gif').addClass('hidden'); // hide loading gif
                        $('div.filtered-items').removeClass('hidden'); // show old items
                        showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
                        toggleFilters();
                    }
                });
            }

            // user uses costFrom filter
            $('.cost-from-input').focusout(function(){
                var newVal = $(this).val(); //get the user`s value
                if (newVal){
                    filters.costFrom = CurrencyToNumber(newVal); //save value parsed to pure number to filters
                    newVal = NumberToCurrency( filters.currency, $(this).val() ); //make the readable variant of user`s value
                    $(this).val(newVal); //display readable variant to user istead of his entered value
                } else {
                    filters.costFrom = null; //if no value is entered set the filter to null
                }
                filter();
            });

            // user uses costTo filter
            $('.cost-to-input').focusout(function(){
                var newVal = $(this).val();
                if (newVal){
                    filters.costTo = CurrencyToNumber(newVal);
                    newVal = NumberToCurrency( filters.currency, $(this).val() );
                    $(this).val(newVal);
                } else {
                    filters.costTo = null;
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

            // user uses currency filter
            $('.currency-switch').change(function(){
                if ( $(this).find('input').prop('checked') ) {
                    var currency = 'USD';
                } else {
                    var currency = 'UAH';
                }
                filters.currency = currency; // edit filters array
                //change currencu sign
                oldFromCost = $(".cost-from-input").val(); //get the cost from
                oldToCost = $(".cost-to-input").val(); //get the cost to
                currency = currency=='UAH' ? '₴' : '$'; //replace currency with sign
                if (oldFromCost) {
                    $(".cost-from-input").val( oldFromCost.replace(oldFromCost[0], currency) ); //replace sign of costFrom to new sign
                }
                if (oldToCost) {
                    $(".cost-to-input").val( oldToCost.replace(oldToCost[0], currency) ); //replace sign of costTo to new sign
                }
                filter();
            });

            // user uses region filter
            $('.region-select').change(function(){
                var region = $(this).children('option:selected').val();
                // edit filters array
                region==0 ? filters.region=0 : filters.region=region;
                filter();
            });

            // transform filter-checkboxes to filter object and make filtration
            $('.cb-container').change(function(){
                parent = $(this).parent();
                filterName = parent.attr('id');
                var checked = parent.children().find('input:checked').map(function() {
                    return $(this).attr('value');
                }).get();
                //console.log(Object.values(checked));
                filters[filterName] = checked;
                filter();
            });

            // user uses sorting filter
            $('.sort-select').change(function(){
                var sorting = $('.sort-select').find('input:checked').attr('value');
                filters.sorting = sorting;
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

            // transform string to pure number
            function CurrencyToNumber(str){
                return str.replace(/[^0-9.]+/g,"");
            }

            // transform pure number to readable currency
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

            function toggleFilters() {
                $('.filters *').toggleClass('loading');
                $('.filters input[type=text]').toggleClass('block-click'); //block cost-from and const-to
                $('.currency-switch').toggleClass('block-click'); // block currency switcher
                $('.region-select').toggleClass('block-click'); //block region select
                $('.cb-container').toggleClass('block-click'); // block checkbox filters
                $('.sort-select').toggleClass('block-click'); // block sorting select
            }

        });
    </script>
@endsection