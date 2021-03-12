@extends('layouts.app')

@section('page-content')
		<x-header/>
        
		<section class="main">
			<div class="holder">
                <ol class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="{{loc_url(route('home'))}}"><span itemprop="name">{{__('ui.home')}}</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    @yield('bc')
                </ol>
            
                @yield('content')
            </div>
        </section>
@endsection