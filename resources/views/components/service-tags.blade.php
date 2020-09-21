<div class="service-tags tags">
    <button class="service-tags-show tags-show def-input" type="button"><span>{{$btnText}}</span><img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></button>

    <div class="modal-view hidden" id="service-tags-modal">
        <div class="tags-modal">
            <h3 class="columns-header">{{__('ui.chooseTag')}}:</h3>
            @if ($modalHelp)
                <p class="modal-help"><i>{{$modalHelp}}</i></p>
            @endif
            <div class="columns">
                <div class="column">
                    <div class="tags first tags_0">
                        <p class="tag first isActiveBtn" id="0">{{__('tags.other')}}</p>
                        <p class="tag first" id="1">{{__('tags.test')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags second tags_1">
                        <p class="tag second" id="1.1">{{__('tags.test')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags third tags_1.1">
                        <p class="tag third" id="1.1.1">{{__('tags.test')}}</p>
                    </div>
                </div>
            </div>
            <div class="selected-tags service">
                <p>{{__('chosenTags')}}: <span>{{__('tags.other')}}</span></p>
            </div>
            <div class="submit-btns">
                <button class="def-button submit-button submit-tags {{$submitBtnClass}}" type="button">{{$submitBtnText}}</button>
                <button class="def-button cancel-button close-tags" type="button">{{__('ui.cancel')}}</button>
            </div>
            <input class="hidden-encoded-tag service" id="modal-hidden-tag" type="text" value="0" hidden>
        </div>
    </div>
</div>