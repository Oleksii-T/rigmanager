@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.user.admin')}}</title>
	<meta name="description" content="{{__('meta.description.user.admin')}}">
    <meta name="robots" content="noindex, nofollow">
    <style>
        .edit-row-icon {
            width:18px;
            height:18px;
            display:inline-block;
            vertical-align:middle;
            cursor: pointer;
        }
        .edit-row-icon:hover path{
            fill: #ff8d11
        }
    </style>
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('profile'))}}"><span itemprop="name">{{__('ui.profile')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Post verification</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='up'/>
        <div class="content">
            <h1>Post verification</h1>
            <div class="content-top-text">Unverified posts left - <span class="orange">{{$t}}</span>.
                @if (Request::has('skip'))
                    <span class="orange">{{Request::get('skip')}} posts skipped!</span> <a href="{{url()->current()}}">Remove skip variable</a>
                @endif
            </div>
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
                    <p>[<span class="orange">--</span>] {{$p->title}} <svg href="#title-edit" data-fancybox class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                    <p>[<span class="orange">uk</span>] {{$p->title_uk}} <svg href="#title_uk-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                    <p>[<span class="orange">ru</span>] {{$p->title_ru}} <svg href="#title_ru-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                    <p>[<span class="orange">en</span>] {{$p->title_en}} <svg href="#title_en-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                </div>
                <div>
                    <h3>Description</h3>
                    <p style="white-space:pre-line">[<span class="orange">--</span>] {{$p->description}} <svg href="#description-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                    <p style="white-space:pre-line">[<span class="orange">uk</span>] {{$p->description_uk}} <svg href="#description_uk-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                    <p style="white-space:pre-line">[<span class="orange">ru</span>] {{$p->description_ru}} <svg href="#description_ru-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                    <p style="white-space:pre-line">[<span class="orange">en</span>] {{$p->description_en}} <svg href="#description_en-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
                </div>
                <div>
                    <h3>Category</h3>
                    <p>[<span class="orange">code</span>] {{$p->tag_encoded}}  <svg href="#tag_encoded-edit" data-fancybox  class="edit-row-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 325 325.37515" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0" fill="#ffffff" data-original="#000000" style=""/></g></svg></p>
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
                    <a class="button" id="verify-btn" style="background-color:green" href="{{route('admin.verify', ['post'=>$p->id])}}">VERIFY</a>
                    <a class="button button-blue" id="skip-btn" href="{{url()->current()}}?skip=1">SKIP</a>
                    <a class="button" style="background-color:red" href="{{route('admin.post.edit', ['post'=>$p->id, 'user'=>$p->user_id])}}">U_EDIT</a>
                </div>
                <div class="up-btns" style="display:flex;justify-content:space-evenly;margin-top:50px">
                    <a class="button" href="{{loc_url(route('posts.show', ['post'=>$p->url_name]))}}">VIEW POST</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <x-admin-post-row-edit-popup :id='$p->id' row='title' :value='$p->title' />
    <x-admin-post-row-edit-popup :id='$p->id' row='title_uk' :value='$p->title_uk' />
    <x-admin-post-row-edit-popup :id='$p->id' row='title_ru' :value='$p->title_ru' />
    <x-admin-post-row-edit-popup :id='$p->id' row='title_en' :value='$p->title_en' />
    <x-admin-post-row-edit-popup :id='$p->id' row='description' :value='$p->description' />
    <x-admin-post-row-edit-popup :id='$p->id' row='description_uk' :value='$p->description_uk' />
    <x-admin-post-row-edit-popup :id='$p->id' row='description_ru' :value='$p->description_ru' />
    <x-admin-post-row-edit-popup :id='$p->id' row='description_en' :value='$p->description_en' />
    <x-admin-post-row-edit-popup :id='$p->id' row='tag_encoded' :value='$p->tag_encoded' />
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if ("{{Request::has('skip')}}") {
                var skip = "{{Request::get('skip')}}";
                var url = "{{url()->current()}}";
                skip = parseInt(skip)+1;
                url = url + '?skip=' + skip;
                console.log(url);
                $('#skip-btn').attr('href', url);
                $('#verify-btn').attr('href', $('#verify-btn').attr('href') + '?skip=' + skip);
            }
        });
    </script>
@endsection