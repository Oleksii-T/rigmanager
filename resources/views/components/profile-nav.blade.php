<a class="profile-nav-link" id="personlaInfoBtn" href="{{loc_url(route('profile'))}}">{{__('ui.profileInfo')}}</a>
<a class="profile-nav-link" id="mailerBtn" href="{{loc_url(route('mailer.index'))}}">{{__('ui.mailer')}}</a>
<a class="profile-nav-link" id="mySubscriptionBtn" href="{{loc_url(route('profile.subscription'))}}">{{__('ui.mySubscription')}}</a>
<a class="profile-nav-link" id="MyPostsBtn" href="{{loc_url(route('profile.posts'))}}">{{__('ui.myPosts')}}</a>
<a class="profile-nav-link" id="FavouritesBtn" href="{{loc_url(route('profile.favourites'))}}">{{__('ui.favourites')}}</a>
<a class="profile-nav-link" id="logOutBtn" href="#" onclick="document.getElementById('logout-form').submit();">{{__('ui.signOut')}}</a>

<form id="logout-form" class="hidden" action="{{ loc_url(route('logout')) }}" method="POST">@csrf</form>