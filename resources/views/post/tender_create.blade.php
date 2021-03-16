@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.post.create.te')}}</title>
	<meta name="description" content="{{__('meta.description.post.create.te')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{__('ui.postCreate')}}. {{__('ui.tender')}}</span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-post-create-nav active='tender'/>
        <div class="content">
            <h1>{{__('ui.postCreate') . '. ' . __('ui.tender')}}</h1>
            <div class="content-top-text">{{__('ui.workInProgress')}}</div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>
@endsection