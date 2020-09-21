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
                        <p class="tag first {{$submitBtnClass=='post-create' ? 'isActiveBtn' : ''}}" id="50">{{__('tags.otherService')}}</p>
                        <p class="tag first" id="51">{{__('tags.multipleService')}}</p>
                        <p class="tag first" id="52">{{__('tags.loggingS')}}</p>
                        <p class="tag first" id="53">{{__('tags.loggingW')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag first" id="54">{{__('tags.lab')}}</p>
                        <p class="tag first" id="55">{{__('tags.guard')}}</p>
                        <p class="tag first" id="56">{{__('tags.transport')}}</p>
                        <p class="tag first" id="57">{{__('tags.vihacle')}}</p>
                        <p class="tag first" id="58">{{__('tags.ndt')}}</p>
                        <p class="tag first" id="59">{{__('tags.control')}}</p>
                        <p class="tag first" id=60>{{__('tags.training')}}</p>
                        <p class="tag first" id="61">{{__('tags.airWaste')}}</p>
                        <p class="tag first" id="62">{{__('tags.recyclingDrill')}}</p>
                        <p class="tag first" id="63">{{__('tags.recyclingDomestic')}}</p>
                        <p class="tag first" id="64">{{__('tags.bitSe')}}</p>
                        <p class="tag first" id="65">{{__('tags.bopSe')}}</p>
                        <p class="tag first" id="66">{{__('tags.grounding')}}</p>
                        <p class="tag first" id="67">{{__('tags.builders')}}</p>
                        <p class="tag first" id="68">{{__('tags.emergencySe')}}</p>
                        <p class="tag first" id="69">{{__('tags.casing')}}</p>
                        <p class="tag first" id="70">{{__('tags.dhm')}}</p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags second tags_53">
                        <p class="tag second" id="53.1">{{__('tags.core')}}</p>
                        <p class="tag second" id="53.2">{{__('tags.stdWellLog')}}</p>
                    </div>
                </div>
                <div class="column">
                    <!--
                    <div class="hidden tags third tags_1.1">
                        <p class="tag third" id="1.1.1">{{__('tags.test')}}</p>
                    </div>
                    -->
                </div>
            </div>
            <div class="selected-tags service">
                @if ($submitBtnClass=='post-create')
                    <p>{{__('ui.chosenTags')}}: <span>{{__('tags.otherService')}}</span></p>
                @else
                    <p>{{__('ui.chosenTags')}}: <span>{{__('ui.empty')}}</span></p>
                @endif
            </div>
            <div class="submit-btns">
                <button class="def-button submit-button submit-tags {{$submitBtnClass}}" type="button">{{$submitBtnText}}</button>
                <button class="def-button cancel-button close-tags" type="button">{{__('ui.cancel')}}</button>
            </div>
            <input class="hidden-encoded-tag service" id="modal-hidden-tag" type="text" value="0" hidden>
        </div>
    </div>
</div>