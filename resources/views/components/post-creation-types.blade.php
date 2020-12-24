<nav class="creation-type">
    <ul>
        <li><a id="equipment-create" href="{{loc_url(route('posts.create'))}}">{{__('ui.equipment')}}</a></li>
        <li><a id="service-create" href="{{loc_url(route('service.create'))}}">{{__('ui.service')}}</a></li>
        <li><a id="tender-create" class="not-allowed" href="#">{{__('ui.tender')}}</a></li>
        <li><a id="post-import" href="{{loc_url(route('post.import'))}}">{{__('ui.postImport')}}</a></li>
    </ul>
</nav>