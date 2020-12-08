@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/mailer_show.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/profile_layout.css')}}" />
@endsection

@section('content')
    <div class="master-wraper">
        <div id="profileContent">
            <nav class="profileNavBar">
                <x-profile-nav/>
            </nav> 
            <div class="mailerContent">
                @if ($mailers)
                    <div class="mailerBody">
                        <div class="mailers">
                            @foreach ($mailers as $mailer)
                                <div class="mailer">
                                    <h2 class="title">{{$mailer->title}} 
                                        @if ($mailer->is_active)
                                            <span class="not-allowed" style="color: #888888">{{__('ui.active')}}</span>
                                        @else
                                            <span class="not-allowed" style="color: #888888">{{__('ui.notActive')}}</span>
                                        @endif
                                        <span class="not-allowed" style="color: #888888">{{__('ui.deleteMailer')}}</span>
                                    </h2>

                                    <div class="mailer-detailes">
                                        @if ($mailer->keyword)
                                            <p class="keyword">{{__('ui.text')}}: {{$mailer->keyword}}</p>
                                        @endif
                                        
                                        @if ($mailer->author)
                                            <p class="author">{{__('ui.author')}}: {{$mailer->author_name}}</p>
                                        @endif
                                        
                                        @if ($mailer->tag)
                                            <p class="tag">{{__('ui.tag')}}:
                                                @foreach ($mailer->tags_map as $tag)
                                                    <span>{{$tag}} -> </span>
                                                @endforeach
                                            </p>
                                        @endif
                                        
                                        @if ($mailer->cost_from || $mailer->cost_to)
                                            <p class="cost">
                                                <span>{{$mailer->currency}}</span>
                                                @if ($mailer->cost_from)
                                                    <span>{{$mailer->cost_from}}</span>
                                                @endif
                                                -
                                                @if ($mailer->cost_to)
                                                    <span>{{$mailer->cost_to}}</span>
                                                @endif
                                            </p>
                                        @endif

                                        <p class="region">{{__('ui.region')}}: {{$mailer->region_name}}</p>

                                        <p class="condition">{{__('ui.condition')}}:
                                            @foreach ($mailer->conditions_map as $condition)
                                                <span>{{$condition}}, </span>
                                            @endforeach
                                        </p>

                                        <p class="condition">{{__('ui.type')}}:
                                            @foreach ($mailer->types_map as $type)
                                                <span>{{$type}}, </span>
                                            @endforeach
                                        </p>

                                        <p class="condition">{{__('ui.role')}}:
                                            @foreach ($mailer->roles_map as $role)
                                                <span>{{$role}}, </span>
                                            @endforeach
                                        </p>

                                        <p class="condition">{{__('ui.thread')}}:
                                            @foreach ($mailer->threads_map as $thread)
                                                <span>{{$thread}}, </span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mailer">
                                <h2 class="not-allowed">{{__('ui.addNewMailer')}}</h2>
                            </div>
                        </div>
                        <div class="mailer-buttons">
                            <button class="def-button not-allowed">{{__('ui.editMailers')}}</button>
                            <button class="def-button not-allowed">{{__('ui.deleteMailers')}}</button>
                        </div>
                    </div>
                @else
                    <div class="mailerBody">
                        <p>{{__('ui.noMailer')}}</p>
                    </div>

                    <div class="mailerBtns">
                        <a class="def-button" id="editBtn" href="{{ loc_url(route('mailer.create')) }}">{{__('ui.setUpMailer')}}</a>
                        <a id="helpBtn" href="{{loc_url(route('faq'))}}#WhatIsMailer">{{__('ui.whatIsMailer')}}?</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            
        });

    </script>
@endsection
