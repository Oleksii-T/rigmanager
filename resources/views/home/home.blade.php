@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/tags.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/home_posts.css')}}" />
@endsection

@section('content')

    <div class="introduction">
        <h1>{{__('ui.introduction')}}</h1>
        <ul class="intro-list">
            <li><a href="{{loc_url(route('search', ['type'=>'equipment-sell']))}}">{{__('ui.introSellEq')}}</a></li>
            <li><a href="{{loc_url(route('search', ['type'=>'equipment-buy']))}}">{{__('ui.introBuyEq')}}</a></li>
            <li><a href="{{loc_url(route('search', ['type'=>'services']))}}">{{__('ui.introSe')}}</a></li>
            <li><a class="not-allowed" href="{{loc_url(route('home'))}}">{{__('ui.introTender')}}</a></li>
        </ul>
    </div>

    <div id="searchBar">
        <form method="GET" action="{{ loc_url(route('search')) }}">
            <div id="inputWraper">
                <input id="inputSearch" name="text" placeholder="{{__('ui.search')}}" required />
            </div>
            <button type="submit"><img id="searchIcon" src="{{ asset('icons/searchIcon.svg') }}" alt="{{__('alt.keyword')}}"></button>
        </form>
    </div>

    <div class="tag-search">
        <ul class="tag-search-select">
            <li><button class="active-tag-select" id="show-eq-tags">{{__('ui.equipment')}}</button></li>
            <li><button id="show-se-tags">{{__('ui.service')}}</button></li>
        </ul>
        <div class="tag-search-eq">
            <div class="tag-search-column">
                <ul class="tag-search-list">
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-1'))}}">{{__('tags.bit')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-2'))}}">{{__('tags.dp')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-3'))}}">{{__('tags.rig')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-4'))}}">{{__('tags.pump')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-5'))}}">{{__('tags.mud')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-6'))}}">{{__('tags.boreholeSurvey')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-7'))}}">{{__('tags.miscHelpEq')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-8'))}}">{{__('tags.motor')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-9'))}}">{{__('tags.parts')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-10'))}}">{{__('tags.control')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-11'))}}">{{__('tags.stub')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-12'))}}">{{__('tags.camp')}}</a></li>
                </ul>
            </div>
            <div class="tag-search-column">
                <ul class="tag-search-list">
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-13'))}}">{{__('tags.casingCementing')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-14'))}}">{{__('tags.emergency')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-15'))}}">{{__('tags.lubricator')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-16'))}}">{{__('tags.tubingEq')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-17'))}}">{{__('tags.wellHeadEq')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-18'))}}">{{__('tags.packer')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-19'))}}">{{__('tags.airUtility')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-20'))}}">{{__('tags.boe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-21'))}}">{{__('tags.rotory')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-22'))}}">{{__('tags.power')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-23'))}}">{{__('tags.simCasing')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-24'))}}">{{__('tags.diselStorage')}}</a></li>
                </ul>
            </div>
            <div class="tag-search-column">
                <ul class="tag-search-list">
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-25'))}}">{{__('tags.specMachinery')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-26'))}}">{{__('tags.lifting')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-27'))}}">{{__('tags.pipeHandling')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-28'))}}">{{__('tags.hseEq')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-29'))}}">{{__('tags.tong')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-30'))}}">{{__('tags.chemics')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-31'))}}">{{__('tags.chemLab')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-32'))}}">{{__('tags.jar')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-0'))}}">{{__('tags.other')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="tag-search-se hidden">
            <div class="tag-search-column">
                <ul class="tag-search-list">
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-51'))}}">{{__('tags.complexService')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-52'))}}">{{__('tags.emergencySe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-53'))}}">{{__('tags.controll')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-54'))}}">{{__('tags.airWaste')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-55'))}}">{{__('tags.loggingSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-56'))}}">{{__('tags.ndt')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-57'))}}">{{__('tags.bitSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-58'))}}">{{__('tags.dhmSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-59'))}}">{{__('tags.grounding')}}</a></li>
                </ul>
            </div>
            <div class="tag-search-column">
                <ul class="tag-search-list">
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-60'))}}">{{__('tags.sideHole')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-61'))}}">{{__('tags.directionalDrilling')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-62'))}}">{{__('tags.casingSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-63'))}}">{{__('tags.guard')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-64'))}}">{{__('tags.bopSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-65'))}}">{{__('tags.training')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-66'))}}">{{__('tags.pipeShipment')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-67'))}}">{{__('tags.sellControllFuel')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-68'))}}">{{__('tags.vihacle')}}</a></li>
                </ul>
            </div>
            <div class="tag-search-column">
                <ul class="tag-search-list">
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-69'))}}">{{__('tags.builders')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-70'))}}">{{__('tags.loggingSt')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-71'))}}">{{__('tags.transport')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-72'))}}">{{__('tags.recyclingSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-73'))}}">{{__('tags.lab')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-74'))}}">{{__('tags.cementingSe')}}</a></li>
                    <li><a class="tag-search-link" href="{{loc_url(route('tag-50'))}}">{{__('tags.otherService')}}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="partners-home">
        <x-partners/>
    </div>

    <div class="items-block new-items">
        <h2 class="items-block-title">{{__('ui.newPosts')}}</h2>
        
        <section class="items">
            <x-home-items :posts="$new_posts" :translated="$translated"/>
            <div class="item more-items">
                <a href="{{loc_url(route('list'))}}">
                    <!--  <img class="more-posts-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""> -->
                    <span class="more-posts-text">{{__('ui.morePosts')}}</span>
                </a>
            </div>
        </section>
    </div>
    
    @if ($top_posts->isNotEmpty())
        <div class="items-block top-items">
            <h2 class="items-block-title">{{__('ui.topPosts')}}</h2>
            <section class="items">
                <x-home-items :posts="$top_posts" :translated="$translated"/>
            </section>
            <div class="more-items-btn">
                <a href="{{loc_url(route('list'))}}">{{__('ui.morePosts')}}</a>
            </div>
        </div>
    @endif

    <div class="epilogue">
        <img class="epilogue-logo" title="{{__('ui.home')}}" src="{{ asset('icons/rigmanagerLogoIcon.svg') }}" alt="{{__('alt.keyword')}}">
        <div class="epilogue-text">
            <p class="e-1">{{__('ui.epilogue1')}}</p>
            <p class="e-1">{{__('ui.epilogue2')}}</p>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mousewheel.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            //show servise aserch tags and hide equipment
            $('#show-se-tags').click(function(){
                $('.tag-search-se').removeClass('hidden');
                $('.tag-search-eq').addClass('hidden');
                $(this).addClass('active-tag-select');
                $('#show-eq-tags').removeClass('active-tag-select');
            });

            //show equipment aserch tags and hide service
            $('#show-eq-tags').click(function(){
                $('.tag-search-eq').removeClass('hidden');
                $('.tag-search-se').addClass('hidden');
                $(this).addClass('active-tag-select');
                $('#show-se-tags').removeClass('active-tag-select');
            });

            // disable scrolling on master page when hovering the column
            $(".tags-modal .column").bind('mousewheel', function(e, d) {
                var t = $(this);
                if (d > 0 && t.scrollTop() === 0) {
                    e.preventDefault();
                }
                else {
                    if (d < 0 && (t.scrollTop() == t.get(0).scrollHeight - t.innerHeight())) {
                        e.preventDefault();
                    }
                }
            });

            // paint in orange addToFav btn of appropriate items
            $('.active-fav-img').attr("src", "{{ asset('icons/heartOrangeIcon.svg') }}");

            //clear the search bar
            $('#search-bar-clear-btn').click(function(){
                $('#inputSearch').val("");
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

            //if user tries to add his oun item to fav list
            $(".addToFavButtonBlocked").click(function(){
                showPopUpMassage(false, "{{ __('messages.postAddFavPersonal') }}");
            });

            //if guest tries to add item to fav list
            $(".addToFavButtonAuthBlocked").click(function(){
                showPopUpMassage(false, "{{ __('messages.authError') }}");
            });

            //action when user clicks on addToFav icon
            $(".addToFavButton").click(function(){
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
            $(".addToFavImg").hover(function(){togglePostHover($(this))}, function(){togglePostHover($(this))});
            $(".globalItemButton").hover(function(){togglePostHover($(this))}, function(){togglePostHover($(this))});

            // toggle hover effect on hoverIn/Out on exat post
            function togglePostHover(element) {
                var postId = getIdFromClasses(element.attr("class"), 'id_');
                $("#"+postId+" .item-title p").toggleClass('item-title-hover');
                $("#"+postId+" .post-type").toggleClass('post-type-hover');
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