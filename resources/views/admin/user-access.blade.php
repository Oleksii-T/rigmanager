@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.admin')}}</title>
	<meta name="description" content="{{__('meta.description.user.admin')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('profile'))}}"><span itemprop="name">{{__('ui.profile')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">User Accesss</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='user-access'/>
        <div class="content">
            <h1>User Accesss</h1>
            <div class="content-top-text">Overall users: {{\App\User::all()->count()}}.
                Banned - <img src="{{asset('icons/warning.svg')}}" style="width:15px;heigth:15px;margin:0 0 6px 5px" alt="">, Google users - <img src="{{asset('icons/google.svg')}}" style="width:15px;heigth:15px;margin:0 0 6px 5px" alt="">, Facebook users -   <img src="{{asset('icons/fb.svg')}}" style="width:10px;heigth:15px;margin:0 0 6px 5px" alt=""></div>
            <div class="faq">
                @foreach (\App\User::all() as $u)
                    <div class="faq-item active">
                        <a href="" id="our-purpose" class="faq-top active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99"><path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/></svg>
                            {{$u->name}} [{{$u->id}}]
                            @if ($u->google_id!=null)
                                <img src="{{asset('icons/google.svg')}}" style="width:15px;heigth:15px;margin:0 0 6px 5px" alt="">
                            @endif
                            @if ($u->facebook_id!=null)
                                <img src="{{asset('icons/fb.svg')}}" style="width:10px;heigth:15px;margin:0 0 6px 5px" alt="">
                            @endif
                            @if ($u->is_banned!=null)
                                <img src="{{asset('icons/warning.svg')}}" style="width:15px;heigth:15px;margin:0 0 6px 5px" alt="">
                            @endif
                        </a>
                        <div class="faq-hidden" style="display: block">
                            <p>Posts overall(hidden): {{$u->posts->count()}}({{$u->posts()->where('is_active', '0')->count()}})</p>
                            <p>Email: {{$u->email}} (<a href="{{loc_url(route('admin.login.as', ['user'=>$u->id]))}}">Log in</a>)</p>
                            <p>Registered/Verified at: {{$u->created_at}}/{{$u->email_verified_at}}</p>
                        </div>
                    </div>
                @endforeach
			</div>
        </div>
    </div>
@endsection