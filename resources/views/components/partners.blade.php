<div class="partners">
    @foreach ($partners as $partner)
        <div class="partner">
            <div class="partner-img-wraper">
                <a href="{{loc_url(route('search', ['author'=>$partner->user->url_name]))}}">
                    <img src="{{asset($partner->logo)}}" alt="">
                </a>
            </div>
        </div>
    @endforeach
    <div class="partner">
        <div class="partner-img-wraper">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
    </div>
    <div class="partner">
        <div class="partner-img-wraper">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
    </div>
    <div class="partner">
        <div class="partner-img-wraper">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
    </div>
    <div class="partner">
        <div class="partner-img-wraper">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
    </div>
    <div class="partner">
        <div class="partner-img-wraper">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
    </div>
    <div class="partner">
        <div class="partner-img-wraper">
            <img src="{{asset('icons/partnerIcon.svg')}}" alt="">
        </div>
    </div>
    <div class="partner partner-more">
        <a href="{{loc_url(route('home'))}}" class="not-allowed">{{__('ui.otherPartners')}}</a>
    </div>
</div>