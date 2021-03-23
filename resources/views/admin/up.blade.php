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
        <span itemprop="name">Unverified Post</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='up'/>
        <div class="content">
            <h1>Unverified Post <span class="orange">[total={{$t}}]</span></h1>
            <div class="content-top-text"></div>
            <div class="u-p">
                <div>
                    <h3>General</h3>
                    <p>
                        id=<span class="orange">{{$p->id}}</span>, 
                        user_id=<span class="orange">{{$p->user_id}}</span>,
                        is_banned=<span class="orange">{{$p->is_banned}}</span>,
                        is_verified=<span class="orange">{{$p->is_verified}}</span>,
                        priority=<span class="orange">{{$p->priority}}</span>,
                        is_active=<span class="orange">{{$p->is_active}}</span>,
                        is_premium=<span class="orange">{{$p->is_premium}}</span>,
                        is_vip=<span class="orange">{{$p->is_vip}}</span>,
                        is_urgent=<span class="orange">{{$p->is_urgent}}</span>,
                        is_import=<span class="orange">{{$p->is_import}}</span>,
                        is_export=<span class="orange">{{$p->is_export}}</span>,
                        thread=<span class="orange">{{$p->thread}}</span>,
                        origin_lang=<span class="orange">{{$p->origin_lang}}</span>,
                        slag=<span class="orange">{{$p->url_name}}</span>,
                        amount=<span class="orange">{{$p->amount}}</span>,
                        company=<span class="orange">{{$p->company}}</span>,
                        type=<span class="orange">{{$p->type}}</span>,
                        role=<span class="orange">{{$p->role}}</span>,
                        condition=<span class="orange">{{$p->condition}}</span>,
                        manufacturer=<span class="orange">{{$p->manufacturer}}</span>,
                        manufactured_date=<span class="orange">{{$p->manufactured_date}}</span>,
                        part_number=<span class="orange">{{$p->part_number}}</span>,
                        cost=<span class="orange">{{$p->cost}}</span>,
                        currency=<span class="orange">{{$p->currency}}</span>,
                        region_encoded=<span class="orange">{{$p->region_encoded}}</span>,
                        town=<span class="orange">{{$p->town}}</span>,
                        user_email=<span class="orange">{{$p->user_email}}</span>,
                        user_phone_raw=<span class="orange">{{$p->user_phone_raw}}</span>,
                        doc=<span class="orange">{{$p->doc}}</span>,
                        lifetime=<span class="orange">{{$p->lifetime}}</span>,
                        active_to=<span class="orange">{{$p->active_to}}</span>,
                        views=<span class="orange">{{json_encode($p->views)}}</span>,
                        created_at=<span class="orange">{{$p->created_at}}</span>,
                        updated_at=<span class="orange">{{$p->updated_at}}</span>,
                    </p>
                </div>
                <div>
                    <h3>Title</h3>
                    <p>[<span class="orange">--</span>] {{$p->title}}</p>
                    <p>[<span class="orange">uk</span>] {{$p->title_uk}}</p>
                    <p>[<span class="orange">ru</span>] {{$p->title_ru}}</p>
                    <p>[<span class="orange">en</span>] {{$p->title_en}}</p>
                </div>
                <div>
                    <h3>Description</h3>
                    <p>[<span class="orange">--</span>] {{$p->description}}</p>
                    <p>[<span class="orange">uk</span>] {{$p->description_uk}}</p>
                    <p>[<span class="orange">ru</span>] {{$p->description_ru}}</p>
                    <p>[<span class="orange">en</span>] {{$p->description_en}}</p>
                </div>
                <div>
                    <h3>Category</h3>
                    <p>[<span class="orange">code</span>] {{$p->tag_encoded}}</p>
                    <p>[<span class="orange">readable</span>] {{$p->tag_readable}}</p>
                </div>
                <div>
                    <h3>MEDIA</h3>
                    <div style="margin-bottom: 20px">
                        @if ( $p->images->isNotEmpty() )
                            @foreach ($p->images->where('version', 'origin') as $image)
                                <div class="prod-photo-slide" style="display: inline-block">
                                    <a href="{{$image->url}}" data-fancybox="prod"><img style="max-width: 100px;max-height: 100px" src="{{$image->url}}" alt=""></a>
                                </div>
                            @endforeach
                        @else
                            <p>NO IMAGES</p>
                        @endif
                    </div>
                    <div style="margin-bottom: 20px">
                        @if ( $p->doc )
                            <p>PDF: {{$p->doc_name}} - <a href="{{route('download.post.doc', ['post'=>$p->id])}}" class="orange">DOWNLOAD</a></p>
                        @else
                            <p>NO DOC</p>
                        @endif
                    </div>
                </div>
                <div class="up-btns" style="display:flex;justify-content:space-evenly">
                    <a class="button" style="background-color:green" href="{{route('admin.verify', ['post'=>$p->id])}}">VERIFY</a>
                    <a class="button button-blue" href="{{route('admin.up')}}">SKIP</a>
                    <a class="button" style="background-color:red" href="{{route('admin.post.edit', ['post'=>$p->id, 'user'=>$p->user_id])}}">EDIT</a>
                </div>
            </div>
        </div>
    </div>
@endsection