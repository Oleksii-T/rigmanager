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
                    <div class="tags first service tags_0">
                        <p class="tag service first {{$submitBtnClass=='post-create' ? 'isActiveBtn' : ''}}" id="50">{{__('tags.otherService')}}</p>
                        <p class="tag service first" id="51">{{__('tags.multipleService')}}</p>
                        <p class="tag service first" id="52">{{__('tags.emergencySe')}}</p>
                        <p class="tag service first" id="53">{{__('tags.controll')}}</p>
                        <p class="tag service first" id="54">{{__('tags.airWaste')}}</p>
                        <p class="tag service first" id="55">{{__('tags.loggingSe')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag service first" id="56">{{__('tags.ndt')}}</p>
                        <p class="tag service first" id="57">{{__('tags.bitSe')}}</p>
                        <p class="tag service first" id="58">{{__('tags.dhmSe')}}</p>
                        <p class="tag service first" id="59">{{__('tags.grounding')}}</p>
                        <p class="tag service first" id="60">{{__('tags.sideHole')}}</p>
                        <p class="tag service first" id="61">{{__('tags.directionalDrilling')}}</p>
                        <p class="tag service first" id="62">{{__('tags.casingSe')}}</p>
                        <p class="tag service first" id="63">{{__('tags.guard')}}</p>
                        <p class="tag service first" id="64">{{__('tags.bopSe')}}</p>
                        <p class="tag service first" id="65">{{__('tags.training')}}</p>
                        <p class="tag service first" id="66">{{__('tags.pipeShipment')}}</p>
                        <p class="tag service first" id="67">{{__('tags.sellControllFuel')}}</p>
                        <p class="tag service first" id="68">{{__('tags.vihacle')}}</p>
                        <p class="tag service first" id="69">{{__('tags.builders')}}</p>
                        <p class="tag service first" id="70">{{__('tags.loggingSt')}}</p>
                        <p class="tag service first" id="71">{{__('tags.transport')}}</p>
                        <p class="tag service first" id="72">{{__('tags.recyclingSe')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag service first" id="73">{{__('tags.lab')}}</p>
                        <p class="tag service first" id="74">{{__('tags.cementingSe')}}</p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags service second tags_55">
                        <p class="tag service second" id="53.1">{{__('tags.coringSe')}}</p>
                        <p class="tag service second" id="53.2">{{__('tags.stdWellLog')}}</p>
                    </div>
                    <div class="hidden tags service second tags_72">
                        <p class="tag service second" id="72.1">{{__('tags.recyclingDrill')}}</p>
                        <p class="tag service second" id="72.2">{{__('tags.recyclingDomestic')}}</p>
                    </div>
                </div>
                <div class="column">
                    <!--
                    <div class="hidden tags service third tags_1.1">
                        <p class="tag service third" id="1.1.1">test</p>
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
                <button class="def-button service submit-button submit-tags {{$submitBtnClass}}" type="button">{{$submitBtnText}}</button>
                <button class="def-button service cancel-button close-tags" type="button">{{__('ui.cancel')}}</button>
            </div>
            <input class="hidden-encoded-tag service" id="modal-hidden-tag" type="text" value="0" hidden>
        </div>
    </div>
</div>