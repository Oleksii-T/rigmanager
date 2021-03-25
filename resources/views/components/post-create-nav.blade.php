<aside class="side">
    <a href="#side-block" data-fancybox class="side-mob">{{__('ui.postCreate')}}</a>
    <div class="side-block" id="side-block">
        <div class="side-title">{{__('ui.postCreate')}}</div>
        <ul class="side-list">
            <li><a href="{{loc_url(route('posts.create'))}}" class="{{$active=="eq" ? 'active' : ''}}">{{__('ui.equipment')}}</a></li>
            <li><a href="{{loc_url(route('service.create'))}}" class="{{$active=="se" ? 'active' : ''}}">{{__('ui.service')}}</a></li>
            <li class="hidden"><a href="{{loc_url(route('tender.create'))}}" class="not-ready {{$active=="tender" ? 'active' : ''}}">{{__('ui.tender')}}</a></li>
            <li><a href="{{loc_url(route('post.import'))}}" class="{{$active=="import" ? 'active' : ''}}">{{__('ui.postImport')}}</a></li>
        </ul>
    </div>
</aside>