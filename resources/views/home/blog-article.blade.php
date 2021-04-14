@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.info.blog')}}</title>
	<meta name="description" content="{{__('meta.description.info.blog')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('blog'))}}"><span itemprop="name">{{__('ui.footerBlog')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">{{$blog->title_localed}}</span>
		<meta itemprop="position" content="3" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='blog'/>
        <div class="content">
            <article class="article">

                <!--title+author+date-->
                <h1>{{$blog->title_localed}}</h1> 
                <p class="blog-misc-info">{{__('ui.by')}} <span>{{$blog->author_localed}}</span>, {{__('ui.posted')}} <span>{{$blog->created_at_readable}}</span>.</p>
                
                <!--thumbnail-->
                <a href="{{$blog->thumbnail}}" data-fancybox="blog-photos" class="article-img"><img src="{{$blog->thumbnail}}" alt=""></a>

                <!--intro+body+outro-->
                <p class="blog-paragraph">{{$blog->description}}</p>

                <!--imgs-->
                @if ($blog->imgs)
                    <p class="blog-sub-header">{{__('ui.attachedImgs')}}</p>
                    <div class="blog-slideshow">
                        <a href="" class="prod-arrow prod-prev"></a>
                        <div class="blog-slider">
                            @foreach ($blog->imgs_arr as $img)
                                <div class="blog-slider-slide">
                                    <a href="{{$img}}" data-fancybox="blog-photos" class="article-img"><img src="{{$img}}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                        <a href="" class="prod-arrow prod-next"></a>
                    </div>
                @endif

                <!--docs-->
                @if ($blog->docs)
                    <p class="blog-sub-header">{{__('ui.attachedDocs')}}</p>
                    <div class="blog-docs">
                        <ul>
                            @foreach ($blog->docs_arr as $doc)
                                <li><span>{{$doc['name']}}</span> <a href="{{route('download.blog.doc', ['blog'=>$blog->id, 'doc'=>$doc['index']])}}" class="blog-doc">{{__('ui.download')}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!--links-->
                @if ($blog->links)
                    <p class="blog-sub-header">{{__('ui.attachedLinks')}}</p>
                    <div class="blog-docs">
                        <ul>
                            @foreach ($blog->links_arr as $l)
                            <li><a href="{{$l['link']}}">{{$l['name']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!--slg-->
                <p class="blog-paragraph">{{__('ui.blogSlg', ['name'=>$blog->author_localed])}}</p>
            </article>
        </div>
	</div>
@endsection