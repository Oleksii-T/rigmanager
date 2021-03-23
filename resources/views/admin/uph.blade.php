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
                                <td>{{$p->user_id}}</td>
                                <td style="max-width:200px">{{$p->title}}</td>
                                <td>{{$p->verified_at}}</td>
                                <td><a class="orange" href="{{route('admin.post.edit', ['post'=>$p->id, 'user'=>$p->user_id])}}">EDIT</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection