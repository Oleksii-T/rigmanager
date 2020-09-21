<div class="equipment-tags tags">
    <button class="equipment-tags-show equipment tags-show def-input" type="button"><span>{{$btnText}}</span><img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></button>

    <div class="modal-view hidden" id="equipment-tags-modal">
        <div class="tags-modal">
            <h3 class="columns-header">{{__('ui.chooseTag')}}:</h3>
            @if ($modalHelp)
                <p class="modal-help"><i>{{$modalHelp}}</i></p>
            @endif
            <div class="columns">
                <div class="column">
                    <div class="tags first">
                        <p class="tag equipment first {{$submitBtnClass=='post-create' ? 'isActiveBtn' : ''}}" id="0">{{__('tags.other')}}</p>
                        <p class="tag equipment first" id="1">{{__('tags.hseEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="2">{{__('tags.bit')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="3">{{__('tags.tong')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="4">{{__('tags.pump')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="5">{{__('tags.pipe')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="6">{{__('tags.rig')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="7">{{__('tags.mud')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="8">{{__('tags.rotory')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="9">{{__('tags.wellHeadSealing')}}</p>
                        <p class="tag equipment first" id="10">{{__('tags.hydComonents')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="11">{{__('tags.hydJack')}}</p>
                        <p class="tag equipment first" id="12">{{__('tags.hydСlamp')}}</p>
                        <p class="tag equipment first" id="13">{{__('tags.crawlerTruck')}}</p>
                        <p class="tag equipment first" id="14">{{__('tags.dampe')}}</p>
                        <p class="tag equipment first" id="15">{{__('tags.pumpControll')}}</p>
                        <p class="tag equipment first" id="16">{{__('tags.motor')}}</p>
                        <p class="tag equipment first" id="17">{{__('tags.parts')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="18">{{__('tags.grinding')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="19">{{__('tags.control')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="20">{{__('tags.coringEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="21">{{__('tags.calibrator')}}</p>
                        <p class="tag equipment first" id="22">{{__('tags.drawworksLines')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="23">{{__('tags.emergency')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="24">{{__('tags.lubricator')}}</p>
                        <p class="tag equipment first" id="25">{{__('tags.slidHammer')}}</p>
                        <p class="tag equipment first" id="26">{{__('tags.collar')}}</p>
                        <p class="tag equipment first" id="27">{{__('tags.packer')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="28">{{__('tags.xOver')}}</p>
                        <p class="tag equipment first" id="29">{{__('tags.hammerD')}}</p>
                        <p class="tag equipment first" id="30">{{__('tags.boe')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="31">{{__('tags.holeOpener')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="32">{{__('tags.chemics')}}</p>
                        <p class="tag equipment first" id="33">{{__('tags.simCasing')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="34">{{__('tags.power')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="35">{{__('tags.casingEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="36">{{__('tags.pipeHandling')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="37">{{__('tags.lifting')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="38">{{__('tags.pipeLocking')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="39">{{__('tags.cementing')}}</p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags equipment second tags_1">
                        <p class="tag equipment second" id="1.1">{{__('tags.fireHazard')}}</p>
                        <p class="tag equipment second" id="1.2">{{__('tags.lifeSupport')}}</p>
                        <p class="tag equipment second" id="1.3">{{__('tags.light')}}</p>
                        <p class="tag equipment second" id="1.4">{{__('tags.miscEq')}}</p>
                        <p class="tag equipment second" id="1.5">{{__('tags.ppo')}}</p>
                        <p class="tag equipment second" id="1.6">{{__('tags.signalization')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_2">
                        <p class="tag equipment second" id="2.1">{{__('tags.cone')}}</p>
                        <p class="tag equipment second" id="2.2">{{__('tags.pdc')}}</p>
                        <p class="tag equipment second" id="2.3">{{__('tags.tsp')}}</p>
                        <p class="tag equipment second" id="2.4">{{__('tags.carbide')}}</p>
                        <p class="tag equipment second" id="2.5">{{__('tags.wing')}}</p>
                        <p class="tag equipment second" id="2.6">{{__('tags.pneumo')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_3">
                        <p class="tag equipment second" id="3.1">{{__('tags.tongHy')}}</p>
                        <p class="tag equipment second" id="3.2">{{__('tags.tongB')}}</p>
                        <p class="tag equipment second" id="3.3">{{__('tags.tongC')}}</p>
                        <p class="tag equipment second" id="3.4">{{__('tags.tongP')}}</p>
                        <p class="tag equipment second" id="3.5">{{__('tags.tongF')}}</p>
                        <p class="tag equipment second" id="3.6">{{__('tags.tongHi')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_4">
                        <p class="tag equipment second" id="4.1">{{__('tags.pumpPD')}}</p>
                        <p class="tag equipment second" id="4.2">{{__('tags.pumpCent')}}</p>
                        <p class="tag equipment second" id="4.3">{{__('tags.pumpPlunger')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_5">
                        <p class="tag equipment second" id="5.1">{{__('tags.pipeStd')}}</p>
                        <p class="tag equipment second" id="5.2">{{__('tags.pipeHW')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_6">
                        <p class="tag equipment second" id="6.1">{{__('tags.substructure')}}</p>
                        <p class="tag equipment second" id="6.2">{{__('tags.rail')}}</p>
                        <p class="tag equipment second" id="6.3">{{__('tags.mast')}}</p>
                        <p class="tag equipment second" id="6.4">{{__('tags.rigUpDown')}}</p>
                        <p class="tag equipment second" id="6.5">{{__('tags.mastTools')}}</p>
                        <p class="tag equipment second" id="6.6">{{__('tags.monkeyBoard')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_7">
                        <p class="tag equipment second" id="7.1">{{__('tags.filter')}}</p>
                        <p class="tag equipment second" id="7.2">{{__('tags.hose')}}</p>
                        <p class="tag equipment second" id="7.3">{{__('tags.compressor')}}</p>
                        <p class="tag equipment second" id="7.4">{{__('tags.store')}}</p>
                        <p class="tag equipment second" id="7.5">{{__('tags.manifold')}}</p>
                        <p class="tag equipment second" id="7.6">{{__('tags.clear')}}</p>
                        <p class="tag equipment second" id="7.7">{{__('tags.mixer')}}</p>
                        <p class="tag equipment second" id="7.8">{{__('tags.recycling')}}</p>
                        <p class="tag equipment second" id="7.9">{{__('tags.laboratory')}}</p>
                        <p class="tag equipment second" id="7.10">{{__('tags.mudCone')}}</p>
                        <p class="tag equipment second" id="7.11">{{__('tags.trashPump')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_8">
                        <p class="tag equipment second" id="8.1">{{__('tags.rotor')}}</p>
                        <p class="tag equipment second" id="8.2">{{__('tags.swivel')}}</p>
                        <p class="tag equipment second" id="8.3">{{__('tags.tdsSystem')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_10">
                        <p class="tag equipment second" id="10.1">{{__('tags.hydActuator')}}</p>
                        <p class="tag equipment second" id="10.2">{{__('tags.hydPulser')}}</p>
                        <p class="tag equipment second" id="10.3">{{__('tags.hydController')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_17">
                        <p class="tag equipment second" id="17.1">{{__('tags.undef')}}</p>
                        <p class="tag equipment second" id="17.2">{{__('tags.undef')}}</p>
                        <p class="tag equipment second" id="17.3">{{__('tags.undef')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_18">
                        <p class="tag equipment second" id="18.1">{{__('tags.grindingM')}}</p>
                        <p class="tag equipment second" id="18.2">{{__('tags.grindingC')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_19">
                        <p class="tag equipment second" id="19.1">{{__('tags.indicator')}}</p>
                        <p class="tag equipment second" id="19.2">{{__('tags.cable')}}</p>
                        <p class="tag equipment second" id="19.3">{{__('tags.registerEq')}}</p>
                        <p class="tag equipment second" id="19.4">{{__('tags.measurmentEq')}}</p>
                        <p class="tag equipment second" id="19.5">{{__('tags.camera')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_20">
                        <p class="tag equipment second" id="20.1">{{__('tags.crown')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="20.2">{{__('tags.coringBox')}}</p>
                        <p class="tag equipment second" id="20.3">{{__('tags.coringPipe')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_22">
                        <p class="tag equipment second" id="22.1">{{__('tags.drawworks')}}</p>
                        <p class="tag equipment second" id="22.2">{{__('tags.drillLine')}}</p>
                        <p class="tag equipment second" id="22.3">{{__('tags.hoisting')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_23">
                        <p class="tag equipment second" id="23.1">{{__('tags.fishingTool')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="23.2">{{__('tags.bath')}}</p>
                        <p class="tag equipment second" id="23.3">{{__('tags.scratcher')}}</p>
                        <p class="tag equipment second" id="23.4">{{__('tags.sigil')}}</p>
                        <p class="tag equipment second" id="23.5">{{__('tags.junkBasket')}}</p>
                        <p class="tag equipment second" id="23.6">{{__('tags.mill')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_27">
                        <p class="tag equipment second" id="27.1">{{__('tags.packerStd')}}</p>
                        <p class="tag equipment second" id="27.2">{{__('tags.packerPumps')}}</p>
                        <p class="tag equipment second" id="27.3">{{__('tags.packerPipes')}}</p>
                        <p class="tag equipment second" id="27.4">{{__('tags.packerHoses')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_30">
                        <p class="tag equipment second" id="30.1">{{__('tags.bop')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="30.2">{{__('tags.ram')}}</p>
                        <p class="tag equipment second" id="30.3">{{__('tags.wheels')}}</p>
                        <p class="tag equipment second" id="30.4">{{__('tags.bopValve')}}</p>
                        <p class="tag equipment second" id="30.5">{{__('tags.manifold')}}</p>
                        <p class="tag equipment second" id="30.6">{{__('tags.line')}}</p>
                        <p class="tag equipment second" id="30.7">{{__('tags.flare')}}</p>
                        <p class="tag equipment second" id="30.8">{{__('tags.controlUnit')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_31">
                        <p class="tag equipment second" id="31.1">{{__('tags.reamerE')}}</p>
                        <p class="tag equipment second" id="31.2">{{__('tags.reamerR')}}</p>
                        <p class="tag equipment second" id="31.3">{{__('tags.reamerPD')}}</p>
                        <p class="tag equipment second" id="31.4">{{__('tags.reamerP')}}</p>
                        <p class="tag equipment second" id="31.5">{{__('tags.reamerB')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_33">
                        <p class="tag equipment second" id="33.1">{{__('tags.simCasingS')}}</p>
                        <p class="tag equipment second" id="33.2">{{__('tags.simCasingB')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_34">
                        <p class="tag equipment second" id="34.1">{{__('tags.transformator')}}</p>
                        <p class="tag equipment second" id="34.2">{{__('tags.generator')}}</p>
                        <p class="tag equipment second" id="34.3">{{__('tags.distributionUnit')}}</p>
                        <p class="tag equipment second" id="34.4">{{__('tags.cabel')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_35">
                        <p class="tag equipment second" id="35.1">{{__('tags.casingPipe')}}</p>
                        <p class="tag equipment second" id="35.2">{{__('tags.casingEq')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_36">
                        <p class="tag equipment second" id="36.1">{{__('tags.elevator')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="36.2">{{__('tags.pipeClamp')}}</p>
                        <p class="tag equipment second" id="36.3">{{__('tags.bail')}}</p>
                        <p class="tag equipment second" id="36.4">{{__('tags.heavingPlug')}}</p>
                        <p class="tag equipment second" id="36.5">{{__('tags.manualClamp')}}</p>
                        <p class="tag equipment second" id="36.6">{{__('tags.casingGrip')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_37">
                        <p class="tag equipment second" id="37.1">{{__('tags.crownBlock')}}</p>
                        <p class="tag equipment second" id="37.2">{{__('tags.travelBlock')}}</p>
                        <p class="tag equipment second" id="37.3">{{__('tags.drillHook')}}</p>
                        <p class="tag equipment second" id="37.4">{{__('tags.deadAnchor')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_38">
                        <p class="tag equipment second" id="38.1">{{__('tags.spider')}}</p>
                        <p class="tag equipment second" id="38.2">{{__('tags.slip')}}</p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags equipment third tags_8.3">
                        <p class="tag equipment third" id="8.3.1">{{__('tags.suspension')}}</p>
                        <p class="tag equipment third" id="8.3.2">{{__('tags.mudPipe')}}</p>
                        <p class="tag equipment third" id="8.3.3">{{__('tags.fosv')}}</p>
                        <p class="tag equipment third" id="8.3.4">{{__('tags.tdsRail')}}</p>
                        <p class="tag equipment third" id="8.3.5">{{__('tags.electrics')}}</p>
                        <p class="tag equipment third" id="8.3.6">{{__('tags.washPipe')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.1">
                        <p class="tag equipment third" id="20.1.1">{{__('tags.crownD')}}</p>
                        <p class="tag equipment third" id="20.1.2">{{__('tags.crownI')}}</p>
                        <p class="tag equipment third" id="20.1.3">{{__('tags.crownP')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_23.1">
                        <p class="tag equipment third" id="23.1.1">{{__('tags.overShot')}}</p>
                        <p class="tag equipment third" id="23.1.2">{{__('tags.magnetic')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_30.1">
                        <p class="tag equipment third" id="30.1.1">{{__('tags.annular')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_30.8">
                        <p class="tag equipment third" id="30.8.1">{{__('tags.manual')}}</p>
                        <p class="tag equipment third" id="30.8.2">{{__('tags.remote')}}</p>
                        <p class="tag equipment third" id="30.8.3">{{__('tags.hydro')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_33.2">
                        <p class="tag equipment third" id="33.2.1">{{__('tags.simCasingBB')}}</p>
                        <p class="tag equipment third" id="33.2.2">{{__('tags.simCasingBS')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_36.1">
                        <p class="tag equipment third" id="36.1.1">{{__('tags.elevatorS')}}</p>
                        <p class="tag equipment third" id="36.1.2">{{__('tags.elevatorI')}}</p>
                    </div>
                </div>
            </div>
            <div class="selected-tags equipment">
                @if ($submitBtnClass=='post-create')
                    <p>{{__('ui.chosenTags')}}: <span>{{__('tags.other')}}</span></p>
                @else
                    <p>{{__('ui.chosenTags')}}: <span>{{__('ui.empty')}}</span></p>
                @endif
            </div>
            <div class="submit-btns">
                <button class="def-button equipment submit-button submit-tags {{$submitBtnClass}}" type="button">{{$submitBtnText}}</button>
                <button class="def-button equipment cancel-button close-tags" type="button">{{__('ui.cancel')}}</button>
            </div>
            <input class="hidden-encoded-tag equipment" id="modal-hidden-tag" type="text" value="0" hidden>
        </div>
    </div>
</div>