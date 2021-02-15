<aside class="side">
    <a href="#side-block" data-fancybox class="side-mob">{{__('ui.cabinet')}}</a>
    <div class="side-block" id="side-block">
        <div class="side-title">{{__('ui.cabinet')}}</div>
        <ul class="side-list">
            <li><a href="{{loc_url(route('profile'))}}" class="{{$active=="profile" ? 'active' : ''}}">{{__('ui.profileInfo')}}</a></li>
            <li><a href="{{loc_url(route('mailer.index'))}}" class="not-ready {{$active=="mailer" ? 'active' : ''}}">{{__('ui.mailer')}}</a></li>
            <li><a href="{{loc_url(route('profile.subscription'))}}" class="{{$active=="subscription" ? 'active' : ''}}">{{__('ui.mySubscription')}}</a></li>
            <li><a href="{{loc_url(route('profile.posts'))}}" class="{{$active=="posts" ? 'active' : ''}}">{{__('ui.myPosts')}}</a></li>
            <li><a href="{{loc_url(route('profile.favourites'))}}" class="{{$active=="fav" ? 'active' : ''}}">{{__('ui.favourites')}}</a></li>
            <li><a href="#" onclick="document.getElementById('logout-form').submit();">{{__('ui.signOut')}}</a></li>
            <form id="logout-form" action="{{ loc_url(route('logout')) }}" method="POST" hidden>@csrf</form>
        </ul>
    </div>
</aside>