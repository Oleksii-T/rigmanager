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
                    <label class="label">Slug <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="slug" placeholder="Slug">

                    <div style="width:100%;height:2px;background-color:white;margin:25px 0px 15px 0px"></div>
                    
                    <div class="white" style="font-size:120%;margin-bottom:15px">Author</div>

                    <div style="display: flex;flex-wrap:wrap;justify-content:space-evenly">
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Ukrainian <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="author[uk]" placeholder="Автор" value="{{old('author[uk]')}}">
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Russina <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="author[ru]" placeholder="Автор" value="{{old('author[ru]')}}">
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">English <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="author[en]" placeholder="Author" value="{{old('author[en]')}}">
                        </div>
                    </div>

                    <div style="width:100%;height:2px;background-color:white;margin:25px 0px 15px 0px"></div>

                    <div class="white" style="font-size:120%;margin-bottom:15px">Title</div>

                    <div style="display: flex;flex-wrap:wrap;justify-content:space-evenly">
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Ukrainian <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="title[uk]" placeholder="Заголовок" value="{{old('title[uk]')}}">
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Russina <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="title[ru]" placeholder="Заголовок" value="{{old('title[ru]')}}">
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">English <span class="orange">*</span></label>
                            <input type="text" class="input input-long" name="title[en]" placeholder="Title" value="{{old('title[en]')}}">
                        </div>
                    </div>
                    
                    <div style="width:100%;height:2px;background-color:white;margin:25px 0px 15px 0px"></div>

                    <div class="white" style="font-size:120%;margin-bottom:15px">Intro</div>

                    <div style="display: flex;flex-wrap:wrap;justify-content:space-evenly">
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Ukrainian <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="intro[uk]" form="blog-create">{{old('intro[uk]') ?? 'Вступ'}}</textarea>
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Russina <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="intro[ru]" form="blog-create">{{old('intro[ru]') ?? 'Вступление'}}</textarea>
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">English <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="intro[en]" form="blog-create">{{old('intro[en]') ?? 'Intro'}}</textarea>
                        </div>
                    </div>

                    <div style="width:100%;height:2px;background-color:white;margin:25px 0px 15px 0px"></div>

                    <div class="white" style="font-size:120%;margin-bottom:15px">Body</div>

                    <div style="display: flex;flex-wrap:wrap;justify-content:space-evenly">
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Ukrainian <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="body[uk]" form="blog-create">{{old('body[uk]') ?? 'Головна частина'}}</textarea>
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Russina <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="body[ru]" form="blog-create">{{old('body[ru]') ?? 'Главная часть'}}</textarea>
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">English <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="body[en]" form="blog-create">{{old('body[en]') ?? 'Body'}}</textarea>
                        </div>
                    </div>

                    <div style="width:100%;height:2px;background-color:white;margin:25px 0px 15px 0px"></div>

                    <div class="white" style="font-size:120%;margin-bottom:15px">Outro</div>

                    <div style="display: flex;flex-wrap:wrap;justify-content:space-evenly">
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Ukrainian <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="outro[uk]" form="blog-create">{{old('outro[uk]') ?? 'Висновок'}}</textarea>
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">Russina <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="outro[ru]" form="blog-create">{{old('outro[ru]') ?? 'Заключение'}}</textarea>
                        </div>
                        <div style="margin-right:10px;flex-grow:2">
                            <label class="label">English <span class="orange">*</span></label>
                            <textarea rows="10" maxlength="9000" class="textarea" name="outro[en]" form="blog-create">{{old('outro[en]') ?? 'Outro'}}</textarea>
                        </div>
                    </div>
                    
                    <div style="width:100%;height:2px;background-color:white;margin:25px 0px 15px 0px"></div>

                    <label class="label">Thumbnail <span class="orange">*</span></label>
                    <input type="text" class="input input-long" name="thumbnail" placeholder="Thumbnail" value="{{old('thumbnail')}}">
                    <div class="form-note">Path to img. Exmp: folder/th.png</div>

                    <label class="label">Images</label>
                    <input type="text" class="input input-long" name="imgs" placeholder="Images" value="{{old('imgs')}}">
                    <div class="form-note">JSON formant. Exmp: ["1/img_1.png","1/img_2.png"]</div>

                    <label class="label">Documents</label>
                    <input type="text" class="input input-long" name="docs" placeholder="Documents" value="{{old('docs')}}">
                    <div class="form-note">JSON format. Exmp: ["doc_1.pdf","doc_2.pdf"]</div>

                    <label class="label">Links</label>
                    <input type="text" class="input input-long" name="links" placeholder="Links" value="{{old('links')}}">
                    <div class="form-note">JSON format. Exmp: [{"name":{"uk":"імя","ru":"имя","en":"name"},"link":"https:\/\/domain\/url"},{"name":{"uk":"імя","ru":"имя","en":"name"},"link":"https:\/\/domain\/url"}]</div>

                    <label class="label">Created</label>
                    <input type="text" class="input input-long" name="created_at" placeholder="Created at" value="{{old('created_at')}}">
                    <div class="form-note">Data time format. Exmp: 2021-02-20</div>

                    <button class="button" style="background-color:green" href="">CREATE</button>
                </fieldset>
            </form>
        </div>
    </div>
@endsection