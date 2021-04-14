<aside class="side">
    <a href="#side-block" data-fancybox class="side-mob">{{__('ui.info')}}</a>
    <div class="side-block" id="side-block">
        <div class="side-title">{{__('ui.info')}}</div>
        <ul class="side-list">
            <li><a href="{{loc_url(route('about.us'))}}" class="{{$active=="about" ? 'active' : ''}}">{{__('ui.footerAbout')}}</a></li>
            <li><a href="{{loc_url(route('blog'))}}" class="{{$active=="blog" ? 'active' : ''}}">{{__('ui.footerBlog')}}</a></li>
            <li><a href="{{loc_url(route('terms'))}}" {{$active=="terms" ? 'class=active' : ''}}>{{__('ui.footerTerms')}}</a></li>
            <li><a href="{{loc_url(route('privacy'))}}" {{$active=="pp" ? 'class=active' : ''}}>{{__('ui.footerPrivacy')}}</a></li>
            <li><a href="{{loc_url(route('site.map'))}}" {{$active=="sitemap" ? 'class=active' : ''}}>{{__('ui.footerSiteMap')}}</a></li>
            <li><a href="{{loc_url(route('plans'))}}" {{$active=="plans" ? 'class=active' : ''}}>{{__('ui.footerSubscription')}}</a></li>
            <li><a href="{{loc_url(route('contacts'))}}" {{$active=="contact" ? 'class=active' : ''}}>{{__('ui.footerContact')}}</a></li>
            <li><a href="{{loc_url(route('import.rules'))}}" {{$active=="xlsx-info" ? 'class=active' : ''}}>{{__('postImportRules.title')}}</a></li>
            <li><a href="{{loc_url(route('faq'))}}" {{$active=="faq" ? 'class=active' : ''}}>FAQ</a></li>
        </ul>
    </div>
</aside>