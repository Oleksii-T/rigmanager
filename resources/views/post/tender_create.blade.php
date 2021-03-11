@extends('layouts.page')

@section('meta')
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.postCreate')}}. {{__('ui.tender')}}</span></span>
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