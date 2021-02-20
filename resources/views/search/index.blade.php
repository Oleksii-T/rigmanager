@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('catalog'))}}"><span itemprop="name">{{__('ui.catalog')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    @if ( $search['type'] == 'tags' )
        @foreach ($search['value'] as $key => $name)
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                @if ($loop->last)
                    <span itemprop="item"><span itemprop="name">{{$name}}</span></span>
                @else
                    <a itemprop="item" href="{{loc_url(route('tag-'.$key))}}"><span itemprop="name">{{$name}}</span></a>
                @endif
                <meta itemprop="position" content="{{$loop->index+3}}" />
            </li>
        @endforeach
    @elseif ( $search['type'] == 'text' )
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">    
            @if (isset($resByTag) && $resByTag['searchedTagMap'])
                <a itemprop="item" href="{{loc_url(route('search', ['text'=>$search['value']]))}}"><span itemprop="name">"{{$search['value']}}"</span></a>
            @else
                <span itemprop="item"><span itemprop="name">"{{$search['value']}}"</span></span>
            @endif
            <meta itemprop="position" content="3" />
        </li>
        @if (isset($resByTag) && $resByTag['searchedTagMap'])
            @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">            
                    @if ($loop->last)
                        <span itemprop="item"><span itemprop="name">{{$tag}}</span></span>
                    @else
                        <a itemprop="item" href="{{loc_url(route('search', ['text'=>$search['value'], 'tag'=>$tagUrl]))}}"><span itemprop="name">{{$tag}}</span></a>
                    @endif
                    <meta itemprop="position" content="{{$loop->index+4}}" />
                </li>
            @endforeach
        @endif  
    @elseif ( $search['type'] == 'type' )
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            @if (isset($resByTag) && $resByTag['searchedTagMap'])
                <a itemprop="item" href="{{loc_url(route('search', ['type'=>$search['url']]))}}"><span itemprop="name">{{$search['value']}}</span></a>
            @else
                <span itemprop="item"><span itemprop="name">{{$search['value']}}</span></span>
            @endif
            <meta itemprop="position" content="3" />
        </li>
        @if (isset($resByTag) && $resByTag['searchedTagMap'])
            @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">    
                    @if ($loop->last)
                        <span itemprop="item"><span itemprop="name">{{$tag}}</span></span>
                    @else
                        <a itemprop="item" href="{{loc_url(route('search', ['type'=>$search['url'], 'tag'=>$tagUrl]))}}"><span itemprop="name">{{$tag}}</span></a>
                    @endif
                    <meta itemprop="position" content="{{$loop->index+4}}" />
                </li>
            @endforeach
        @endif  
    @elseif ( $search['type'] == 'author' )
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            @if (isset($resByTag) && $resByTag['searchedTagMap'])
                <a itemprop="item" href="{{loc_url(route('search', ['author'=>$search['value']['url']]))}}"><span itemprop="name">{{$search['value']['name']}}</span></a>
            @else
                <span itemprop="item"><span itemprop="name">{{$search['value']['name']}}</span></span>
            @endif
            <meta itemprop="position" content="3" />
        </li>
        @if (isset($resByTag) && $resByTag['searchedTagMap'])
            @foreach ($resByTag['searchedTagMap'] as $tagUrl => $tag)
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">    
                    @if ($loop->last)
                        <span itemprop="item"><span itemprop="name">{{$tag}}</span></span>
                    @else
                        <a itemprop="item" href="{{loc_url(route('search', ['author'=>$search['value']['url'], 'tag'=>$tagUrl]))}}"><span itemprop="name">{{$tag}}</span></a>
                    @endif
                    <meta itemprop="position" content="{{$loop->index+4}}" />
                </li>
            @endforeach
        @endif   
    @endif
@endsection

@section('content')
    <div class="main-block">
        <aside class="side">
            <a href="#filter-block" data-fancybox class="side-mob">{{__('ui.filters')}}</a>
            <div class="filter-block" id="filter-block">
                <div class="filter-title">{{__('ui.filters')}}</div>
                
                <label class="label">
                    {{__('ui.cost')}}, 
                    <div class="tumbler-inline">
                        <div class="tumbler">
                            <a href="" class="tumbler-left currency-switch uah active">UAH</a>
                            <span class="tumbler-block"></span>
                            <a href="" class="tumbler-right currency-switch usd">USD</a>
                        </div>
                    </div>
                </label>
                <div class="price-input">
                    <input type="text" class="input cost-from" placeholder="{{__('ui.from')}}">
                    <span class="price-input-divider">-</span>
                    <input type="text" class="input cost-to" placeholder="{{__('ui.to')}}">
                </div>

                @if ( !($search['type'] == 'tags' && $search['tag_type'] == 'se') )
                    <label class="label">{{__('ui.region')}}</label>
                    <div class="select-block">
                        <x-region-select locale='{{app()->getLocale()}}'/>
                    </div>
                @endif

                @if ( !($search['type'] == 'tags' && $search['tag_type'] == 'se') )
                    <label class="label">{{__('ui.condition')}}</label>
                    <div id="condition" class="check-block">
                        <div class="check-item">
                            <input type="checkbox" class="check-input" value="2" id="ch1" checked>
                            <label for="ch1" class="check-label">{{__('ui.conditionNew')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" value="3" id="ch2" checked>
                            <label for="ch2" class="check-label">{{__('ui.conditionSH')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" value="4" id="ch3" checked>
                            <label for="ch3" class="check-label">{{__('ui.conditionForParts')}}</label>
                        </div>
                    </div>
                @endif

                <label class="label">{{__('ui.postType')}}</label>
                <div id="type" class="check-block">
                    @if ( $search['type'] == 'tags' && $search['tag_type'] == 'se' )
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch8" value="5" checked>
                            <label for="ch8" class="check-label">{{__('ui.postTypeGiveS')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch9" value="6" checked>
                            <label for="ch9" class="check-label">{{__('ui.postTypeGetS')}}</label>
                        </div>
                    @elseif ( $search['type'] == 'tags' && $search['tag_type'] == 'eq' )
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch4" value="1" checked>
                            <label for="ch4" class="check-label">{{__('ui.postTypeSell')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch5" value="2" checked>
                            <label for="ch5" class="check-label">{{__('ui.postTypeBuy')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch6" value="3" checked>
                            <label for="ch6" class="check-label">{{__('ui.postTypeRent')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch7" value="4" checked>
                            <label for="ch7" class="check-label">{{__('ui.postTypeLeas')}}</label>
                        </div>
                    @elseif ( $search['type'] == 'type' && $search['url'] == 'equipment-sell' )
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch4" value="1" checked>
                            <label for="ch4" class="check-label">{{__('ui.postTypeSell')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch6" value="3" checked>
                            <label for="ch6" class="check-label">{{__('ui.postTypeRent')}}</label>
                        </div>
                    @elseif ( $search['type'] == 'type' && $search['url'] == 'equipment-buy' )
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch5" value="2" checked>
                            <label for="ch5" class="check-label">{{__('ui.postTypeBuy')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch7" value="4" checked>
                            <label for="ch7" class="check-label">{{__('ui.postTypeLeas')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch8" value="5" checked>
                            <label for="ch8" class="check-label">{{__('ui.postTypeGiveS')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch9" value="6" checked>
                            <label for="ch9" class="check-label">{{__('ui.postTypeGetS')}}</label>
                        </div>
                    @elseif ( $search['type'] == 'type' && $search['url'] == 'tenders' )
                        <!--empty-->
                    @else
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch4" value="1" checked>
                            <label for="ch4" class="check-label">{{__('ui.postTypeSell')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch5" value="2" checked>
                            <label for="ch5" class="check-label">{{__('ui.postTypeBuy')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch6" value="3" checked>
                            <label for="ch6" class="check-label">{{__('ui.postTypeRent')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch7" value="4" checked>
                            <label for="ch7" class="check-label">{{__('ui.postTypeLeas')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch8" value="5" checked>
                            <label for="ch8" class="check-label">{{__('ui.postTypeGiveS')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch9" value="6" checked>
                            <label for="ch9" class="check-label">{{__('ui.postTypeGetS')}}</label>
                        </div>
                    @endif
                </div>
                
                @if ( !($search['type'] == 'tags' && $search['tag_type'] == 'se') )
                    <label class="label">{{__('ui.postRole')}}</label>
                    <div id="role" class="check-block">
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch10" value="1" checked>
                            <label for="ch10" class="check-label">{{__('ui.postRolePrivate')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch11" value="2" checked>
                            <label for="ch11" class="check-label">{{__('ui.postRoleBusiness')}}</label>
                        </div>
                    </div>
                @endif

                @if ( $search['type'] != 'tags' && $search['type'] != 'type' )
                    <label class="label">{{__('ui.thread')}}</label>
                    <div id="thread" class="check-block">
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch12" value="1" checked>
                            <label for="ch12" class="check-label">{{__('ui.equipment')}}</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" class="check-input" id="ch13" value="2" checked>
                            <label for="ch13" class="check-label">{{__('ui.service')}}</label>
                        </div>
                    </div>  
                @endif

                <label class="label">{{__('ui.sort')}}</label>
                <div class="radio-block filter-sorting">
                    <div class="radio-item">
                        <input type="radio" name="sorting" class="radio-input" id="r1" value="2" checked>
                        <label for="r1" class="radio-label">{{__('ui.sortNew')}}</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="sorting" class="radio-input" id="r2" value="3">
                        <label for="r2" class="radio-label">{{__('ui.sortCheap')}}</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="sorting" class="radio-input" id="r3" value="4">
                        <label for="r3" class="radio-label">{{__('ui.sortExpensive')}}</label>
                    </div>
                </div>
            </div>
            <div class="side-add">
                <div class="side-add-text">{{__('ui.mailerSuggestText')}}</div>
                <div class="side-add-icon"><img src="{{asset('icons/add-icon.svg')}}" alt=""></div>
                <a href="" class="button add-request-to-mailer">{{__('ui.add')}}</a>
            </div>
        </aside>
        <div class="content">
            @if ( $search['type'] == 'none' )
                <h1>{{__('ui.catalog')}} (<span class="orange searched-amount">{{$posts_list->total()}}</span>)</h1>
            @elseif ( $search['type'] == 'author' )
                <h1>{{$search['value']['name']}} (<span class="orange searched-amount">{{$posts_list->total()}}</span>)</h1>
            @elseif ( $search['type'] != 'tags' )
                <h1>{{$search['value']}} (<span class="orange searched-amount">{{$posts_list->total()}}</span>)</h1>
            @else 
                <h1>{{end($search['value'])}} (<span class="orange searched-amount">{{$posts_list->total()}}</span>)</h1>
            @endif
            @if ($search['isEmpty'])
                <div class="searched-empty">
                    <p>{{__('ui.searchFail')}}. <a href="{{ url()->previous() }}">{{__('ui.serverErrorGoBack')}}</a></p>
                </div>
            @else
                @if (isset($resByTag) && $resByTag['map'])
                    <div class="sorting">
                        @foreach ($resByTag['map'] as $tagId => $tag)
                            @if ($search['type']=='text')
                                <div class="sorting-col">
                                    <a href="{{loc_url(route('search', [$search['type']=>$search['value'], 'tag'=>$tag['url']]))}}" class="sorting-item">{{$tag['name']}} <span class="sorting-num">{{$tag['amount']}}</span></a>
                                </div>
                            @elseif ($search['type']=='author')
                                <div class="sorting-col">
                                    <a href="{{loc_url(route('search', [$search['type']=>$search['value']['url'], 'tag'=>$tag['url']]))}}" class="sorting-item">{{$tag['name']}} <span class="sorting-num">{{$tag['amount']}}</span></a>
                                </div>
                            @elseif ($search['type']=='type')
                                <div class="sorting-col">
                                    <a href="{{loc_url(route('search', ['type'=>$search['url'], 'tag'=>$tag['url']]))}}" class="sorting-item">{{$tag['name']}} <span class="sorting-num">{{$tag['amount']}}</span></a>
                                </div>
                            @elseif ($search['type']=='tags' || $search['type']=='none')
                                <div class="sorting-col">
                                    <a href="{{loc_url(route('tag-'.$tagId))}}" class="sorting-item">{{$tag['name']}} <span class="sorting-num">{{$tag['amount']}}</span></a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                <div class="searched-content">
                    <div class="catalog">
                        <x-items :posts="$posts_list" type='list'/>
                    </div>
                    <div class="pagination-field">
                        {{ $posts_list->links() }}
                    </div>
                </div>
            @endif
            <div class="searched-loading hidden">
                <img src="{{asset('icons/loading.svg')}}" alt="">
            </div>
            <div class="searched-empty hidden">
                <p>{{__('ui.searchFail')}}. <a href="{{ url()->previous() }}">{{__('ui.serverErrorGoBack')}}</a></p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

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

            // add search request to mailer
            $('.add-request-to-mailer').click(function(e){
                e.preventDefault();
                var search = '{!! json_encode($search) !!}';
                var resByTag = JSON.stringify(null);
                if ("{{isset($resByTag)}}") {
                    var resByTag = '{!! json_encode($resByTag) !!}';
                }
                var filtersJson = JSON.stringify(filters);
                var ajaxUrl = "{!! route('mailer.create.by.search', ['search'=>'search-r', 'resByTag'=>'resByTag-r', 'filters'=>'filters-r']) !!}";
                ajaxUrl = ajaxUrl.replace('search-r', search);
                ajaxUrl = ajaxUrl.replace('resByTag-r', resByTag);
                ajaxUrl = ajaxUrl.replace('filters-r', filtersJson);
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if ( data.code == 500 ) {
                            showPopUpMassage(true, data.message);
                        } else {
                            showPopUpMassage(false, data.message);
                        }
                    },
                    error: function() {
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                    }
                });
            });

            //handle manual ajax pagination
            $('body').on('click', 'div.filter-pagination a', function(e){
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                window.scrollTo(0, 0);
                fetch_data(page);
            });

            //fetch the filtered items
            function fetch_data(page) {
                displayResultHelper('prepare');
                $.ajax({
                    type: "POST",
                    url: "{{route('post.filter')}}?page="+page,
                    data: {
                        _token: "{{ csrf_token() }}",
                        filters: JSON.stringify(filters),
                        postsIds: "{{$postsIds}}"
                    },
                    success: function(data) {
                        displayResultHelper('success',data);
                    },
                    error: function() {
                        displayResultHelper('error');
                    }
                });
            }

            //make filter
            function filter() {
                toggleFilters();
                displayResultHelper('prepare');
                $('div.searched-empty').addClass('hidden'); //hide empty-items block
                $.ajax({
                    type: "POST",
                    url: "{{loc_url(route('post.filter'))}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        filters: JSON.stringify(filters),
                        postsIds: "{{$postsIds}}"
                    },
                    success: function(data) {
                        displayResultHelper('success',data);
                        toggleFilters();
                    },
                    error: function() {
                        displayResultHelper('error');
                        toggleFilters();
                    }
                });
            }

            // hide old and display new items when doing filtration
            function displayResultHelper(mode, data=0) {
                if (mode=='prepare') {
                    $('div.searched-content').addClass('hidden'); //hide old items
                    $('div.searched-loading').removeClass('hidden'); //show loading gif
                } else if (mode=='success') {
                    $('div.searched-content').empty(); // remove old items
                    $('div.searched-loading').addClass('hidden'); //hide loading gif
                    if (data) {
                        $('div.searched-content').removeClass('hidden').append(data); //append+show new items
                        $('span.searched-amount').html( $('span.filtered-amount').html() ); //update items amount
                        $('.searched-empty').addClass('hidden'); //hide empty items preview (messy)
                    } else {
                        $('span.searched-amount').html('0'); // update items amount
                        $('.searched-empty').removeClass('hidden'); // add empty items preview
                    }
                } else if (mode=='error') {
                    $('div.searched-loading').addClass('hidden'); // hide loading gif
                    $('div.searched-content').removeClass('hidden'); // show old items
                    showPopUpMassage(false, "{{ __('messages.error') }}"); // pop up error message
                }
            }

            // user uses costFrom filter
            $('.cost-from').focusout(function(){
                var newVal = CurrencyToNumber($(this).val());
                if (newVal){
                    filters.costFrom = newVal; //save value parsed to pure number to filters
                    newVal = NumberToCurrency( filters.currency, $(this).val() ); //make the readable variant of user`s value
                    $(this).val(newVal); //display readable variant to user istead of his entered value
                } else {
                    filters.costFrom = null; //if no value is entered set the filter to null
                    $(this).val('');
                }
                filter();
            });

            // user uses costTo filter
            $('.cost-to').focusout(function(){
                var newVal = CurrencyToNumber($(this).val());
                if (newVal){
                    filters.costTo = CurrencyToNumber(newVal);
                    newVal = NumberToCurrency( filters.currency, $(this).val() );
                    $(this).val(newVal);
                } else {
                    filters.costTo = null;
                    $(this).val('');
                }
                filter();
            });

            // remove currency format when user clicks on input
            $('.cost-from, .cost-to').focusin(function(){
                newVal = $(this).val()
                    ? CurrencyToNumber($(this).val())
                    : '';
                $(this).val(newVal);
            });

            // user uses currency filter
            $('.currency-switch').click(function(){
                var currency = $(this).hasClass('usd')
                    ? 'USD'
                    : 'UAH';
                filters.currency = currency; // edit filters array
                //change currencu sign
                oldFromCost = $(".cost-from").val(); //get the cost from
                oldToCost = $(".cost-to").val(); //get the cost to
                currency = currency=='UAH' ? '₴' : '$'; //replace currency with sign
                if (oldFromCost) {
                    $(".cost-from").val( oldFromCost.replace(oldFromCost[0], currency) ); //replace sign of costFrom to new sign
                }
                if (oldToCost) {
                    $(".cost-to").val( oldToCost.replace(oldToCost[0], currency) ); //replace sign of costTo to new sign
                }
                filter();
            });

            $('select[name=region_encoded]').selectmenu({
                change: function (event, ui) {
                    var region = $(this).find('option:selected').val();
                    // edit filters array
                    region==0 ? filters.region=0 : filters.region=region;
                    filter();
                }
            });

            // transform filter-checkboxes to filter object and make filtration
            $('.check-item input').change(function(){
                parent = $(this).parent().parent();
                filterName = parent.attr('id');
                if (!filterName) {
                    return;
                }
                var checked = parent.children().find('input:checked').map(function() {
                    return $(this).attr('value');
                }).get();
                filters[filterName] = checked;
                filter();
            });

            // user uses sorting filter
            $('div.filter-sorting input').change(function(){
                var sorting = $('div.filter-sorting').find('input:checked').attr('value');
                filters.sorting = sorting;
                filter();
            });

            function toggleFilters() {
                //disable filters white previuls filter reqeust is processed
                $('div.filter-block').toggleClass('loading');
                $('div.filter-block input, div.filter-block label').toggleClass('block-click');
                $('.ui-selectmenu-menu').toggleClass('hidden');
            }
        });
    </script>
@endsection