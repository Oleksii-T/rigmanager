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
        <span itemprop="name">Mailers</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='mailers'/>
        <div class="content">
            <h1>Mailers</h1>
            <div class="content-top-text"></div>
            <div class="faq">
                @foreach ($mailers as $m)
                    <div class="faq-item active">
                        <a href="" id="our-purpose" class="faq-top active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
                                <path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
                            </svg>
                            {{$m->title}} [{{$m->id}}] <span style="font-size: 80%" class="{{$m->is_active ? 'green' : 'red'}}">{{$m->is_active ? 'Active' : 'Disactivated'}}</span>
                        </a>
                        <div class="faq-hidden" style="display: block">
                            <div style="display: flex;flex-wrap: wrap;">
                                <p>Tag: <span class="white">{{$m->tag}}</span>
                                    Author: <span class="white">{{$m->author}}</span>
                                    Keywords: <span class="white">{{$m->keyword}}</span>
                                    Cost: <span class="white">{{$m->cost_from}} - {{$m->cost_to}} {{$m->currency}}</span>
                                    Region: <span class="white">{{$m->region}}</span></p>
                                <p>Condition: <span class="white">{{json_encode($m->condition)}}</span>
                                    Type: <span class="white">{{json_encode($m->type)}}</span>
                                    Role: <span class="white">{{json_encode($m->role)}}</span>
                                    Thread: <span class="white">{{json_encode($m->thread)}}</span>
                                    Founded_posts: <span class="white">{{$m->founded_posts}}</span></p>
                            </div>
                            <p>Created/Updated at <span class="white">{{$m->created_at->diffForHumans()}} / {{$m->updated_at->diffForHumans()}}</span> by <span class="white">[{{$m->user->id}}]{{$m->user->name}}</span></p>
                        </div>
                    </div>
                @endforeach
			</div>
        </div>
    </div>
@endsection