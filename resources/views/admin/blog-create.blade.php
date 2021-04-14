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
        <span itemprop="name">Blogs</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-admin-nav active='blog'/>
        <div class="content">
            <h1>Blog create</h1>
            <div class="content-top-text"></div>
            <form id="blog-create" method="POST" action="{{route('admin.blog.store')}}">
                @csrf
                <fieldset>
                    <div class="content-top-text"></div>
                    <label class="label">Slug <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="slug" placeholder="Slug">
                    <div class="form-note"></div>
                    
                    <label class="label">Author <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="author" placeholder="Author">

                    <label class="label">Title <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="title" placeholder="Title">
                    
                    <label class="label">Intro <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="intro" placeholder="Intro">
                    
                    <label class="label">Body <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="body" placeholder="Body">
                    
                    <label class="label">Outro <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="outro" placeholder="Outro">

                    <label class="label">Thumbnail <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="thumbnail" placeholder="Thumbnail">

                    <label class="label">Images</label>
                    <input type="text" class="input input-long" name="imgs" placeholder="Images">

                    <label class="label">Documents</label>
                    <input type="text" class="input input-long" name="docs" placeholder="Documents">

                    <label class="label">Links</label>
                    <input type="text" class="input input-long" name="links" placeholder="Links">

                    <label class="label">Created</label>
                    <input type="text" class="input input-long" name="created_at" placeholder="Created at">

                    <button class="button" style="background-color:green" href="">CREATE</button>
                </fieldset>
            </form>
        </div>
    </div>
@endsection