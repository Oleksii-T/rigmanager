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
            <li><a href="{{loc_url(route('search', ['type'=>'tenders']))}}">{{__('ui.introTender')}}</a></li>
        </ul>
    </div>

    <div id="searchBar">
        <form method="GET" action="{{ loc_url(route('search')) }}">
            <div id="inputWraper">
                <img id="searchIcon" src="{{ asset('icons/searchIcon.svg') }}" alt="{{__('alt.keyword')}}">
                <button id="search-bar-clear-btn" title="{{__('ui.clearText')}}" type="button"><img src="{{ asset('icons/closeBlackIcon.svg') }}" alt="{{__('alt.keyword')}}"></button>
                <input id="inputSearch" class="def-input" name="text" placeholder="{{__('ui.search')}}..." required />
            </div>
            <button class="def-button" type="submit">{{__('ui.search')}}</button>
        </form>
    </div>

    <div class="tag-search">
        <div class="tag-search-column">
            <ul class="tag-search-list">
                <li><a class="tag-search-link" href="{{loc_url(route('1'))}}">{{__('tags.bit')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('2'))}}">{{__('tags.dp')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('3'))}}">{{__('tags.rig')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('4'))}}">{{__('tags.pump')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('5'))}}">{{__('tags.mud')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('6'))}}">{{__('tags.boreholeSurvey')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('7'))}}">{{__('tags.miscHelpEq')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('8'))}}">{{__('tags.motor')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('9'))}}">{{__('tags.parts')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('10'))}}">{{__('tags.control')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('11'))}}">{{__('tags.stub')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('12'))}}">{{__('tags.camp')}}</a></li>
            </ul>
        </div>
        <div class="tag-search-column">
            <ul class="tag-search-list">
                <li><a class="tag-search-link" href="{{loc_url(route('13'))}}">{{__('tags.casingCementing')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('14'))}}">{{__('tags.emergency')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('15'))}}">{{__('tags.lubricator')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('16'))}}">{{__('tags.tubingEq')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('17'))}}">{{__('tags.wellHeadEq')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('18'))}}">{{__('tags.packer')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('19'))}}">{{__('tags.airUtility')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('20'))}}">{{__('tags.boe')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('21'))}}">{{__('tags.rotory')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('22'))}}">{{__('tags.power')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('23'))}}">{{__('tags.simCasing')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('24'))}}">{{__('tags.diselStorage')}}</a></li>
            </ul>
        </div>
        <div class="tag-search-column">
            <ul class="tag-search-list">
                <li><a class="tag-search-link" href="{{loc_url(route('25'))}}">{{__('tags.specMachinery')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('26'))}}">{{__('tags.lifting')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('27'))}}">{{__('tags.pipeHandling')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('28'))}}">{{__('tags.hseEq')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('29'))}}">{{__('tags.tong')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('30'))}}">{{__('tags.pipeLocking')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('31'))}}">{{__('tags.chemics')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('32'))}}">{{__('tags.chemLab')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('33'))}}">{{__('tags.jar')}}</a></li>
                <li><a class="tag-search-link" href="{{loc_url(route('other.eq'))}}">{{__('tags.other')}}</a></li>
            </ul>
        </div>
    </div>

    <div class="partners">
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
        <div class="partner partner-more">
            <a href="#">{{__('ui.otherPartners')}}</a>
        </div>
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
        <h3 class="epilogue-logo"><span>RIG</span>MANAGER</h3>
        <div class="epilogue-text">
            <p class="e-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised.</p>
            <p class="e-2">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mousewheel.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

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