@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.admin')}}</title>
	<meta name="description" content="{{__('meta.description.user.admin')}}">
    <meta name="robots" content="noindex, nofollow">
    <style>
        .hover-content {
            position: relative;
            cursor: pointer;
        }
        .hover-content span {
            background-color: #282828;
            padding: 2px 5px;
            border-radius: 5px;
            display: none;
            position: absolute;
            z-index: 100;
            top: 100%;
            left: 0px;
            white-space: pre;
        }
        .hover-content:hover span{
            display: block;
        }
    </style>
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('profile'))}}"><span itemprop="name">{{__('ui.profile')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Verified Posts History</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='uph'/>
        <div class="content">
            <div class="history">
                <div class="history-top">
                    <div class="history-title">Verified Posts History</div>
                </div>
                <div class="history-table">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>UID</th>
                            <th>TITLE</th>
                            <th>VERIFIED</th>
                            <th>BTN</th>
                        </tr>
                        @foreach ($posts as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td class="hover-content">{{$p->user_id}} <span>{{$p->user->name}}</span></td>
                                <td class="hover-content" style="max-width:180px"><a class="orange" href="{{loc_url(route('posts.show', ['post'=>$p->url_name]))}}">{{$p->title}}</a><span>{{$p->description}}</span></td>
                                <td class="hover-content" >{{$p->verified_at}}<span>Created at {{$p->created_at}}</span></td>
                                <td><a class="orange" href="{{route('admin.post.edit', ['post'=>$p->id, 'user'=>$p->user_id])}}">U_EDIT</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection