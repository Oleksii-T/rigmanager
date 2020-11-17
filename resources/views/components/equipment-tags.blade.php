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
                        <p class="tag equipment first" id="1">{{__('tags.bit')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="2">{{__('tags.dp')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="3">{{__('tags.rig')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="4">{{__('tags.pump')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="5">{{__('tags.mud')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="6">{{__('tags.boreholeSurvey')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="7">{{__('tags.miscHelpEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="8">{{__('tags.motor')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="9">{{__('tags.parts')}}</p>
                        <p class="tag equipment first" id="10">{{__('tags.control')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="11">{{__('tags.stub')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="12">{{__('tags.camp')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="13">{{__('tags.casingCementing')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="14">{{__('tags.emergency')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="15">{{__('tags.lubricator')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="16">{{__('tags.tubingEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="17">{{__('tags.wellHeadEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="18">{{__('tags.packer')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="19">{{__('tags.airUtility')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="20">{{__('tags.boe')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="21">{{__('tags.rotory')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="22">{{__('tags.power')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="23">{{__('tags.simCasing')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="24">{{__('tags.diselStorage')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="25">{{__('tags.specMachinery')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="26">{{__('tags.lifting')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="27">{{__('tags.pipeHandling')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="28">{{__('tags.hseEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="29">{{__('tags.tong')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="30">{{__('tags.pipeLocking')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="31">{{__('tags.chemics')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="32">{{__('tags.chemLab')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment first" id="33">{{__('tags.jar')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags equipment second tags_1">
                        <p class="tag equipment second" id="1.1">{{__('tags.bicentric')}}</p>
                        <p class="tag equipment second" id="1.2">{{__('tags.bitBreaker')}}</p>
                        <p class="tag equipment second" id="1.3">{{__('tags.bitDevice')}}</p>
                        <p class="tag equipment second" id="1.4">{{__('tags.wing')}}</p>
                        <p class="tag equipment second" id="1.5">{{__('tags.bitNozzle')}}</p>
                        <p class="tag equipment second" id="1.6">{{__('tags.pneumo')}}</p>
                        <p class="tag equipment second" id="1.7">{{__('tags.cone')}}</p>
                        <p class="tag equipment second" id="1.8">{{__('tags.carbide')}}</p>
                        <p class="tag equipment second" id="1.9">{{__('tags.pdc')}}</p>
                        <p class="tag equipment second" id="1.10">{{__('tags.tsp')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_2">
                        <p class="tag equipment second" id="2.1">{{__('tags.slipJoint')}}</p>
                        <p class="tag equipment second" id="2.2">{{__('tags.ldp')}}</p>
                        <p class="tag equipment second" id="2.3">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment second" id="2.4">{{__('tags.joint')}}</p>
                        <p class="tag equipment second" id="2.5">{{__('tags.xOver')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="2.6">{{__('tags.packerRubber')}}</p>
                        <p class="tag equipment second" id="2.7">{{__('tags.stabilizersOnPipe')}}</p>
                        <p class="tag equipment second" id="2.8">{{__('tags.pipeStd')}}</p>
                        <p class="tag equipment second" id="2.9">{{__('tags.hwdp')}}</p>
                        <p class="tag equipment second" id="2.10">{{__('tags.dc')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="2.11">{{__('tags.filters')}}</p>
                        <p class="tag equipment second" id="2.12">{{__('tags.centralizers')}}</p>
                        <p class="tag equipment second" id="2.13">{{__('tags.drift')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_3">
                        <p class="tag equipment second" id="3.1">{{__('tags.mastTools')}}</p>
                        <p class="tag equipment second" id="3.2">{{__('tags.drillerHouse')}}</p>
                        <p class="tag equipment second" id="3.3">{{__('tags.mast')}}</p>
                        <p class="tag equipment second" id="3.4">{{__('tags.mdu')}}</p>
                        <p class="tag equipment second" id="3.5">{{__('tags.catWalks')}}</p>
                        <p class="tag equipment second" id="3.6">{{__('tags.substructure')}}</p>
                        <p class="tag equipment second" id="3.7">{{__('tags.monkeyBoard')}}</p>
                        <p class="tag equipment second" id="3.8">{{__('tags.dogHouse')}}</p>
                        <p class="tag equipment second" id="3.9">{{__('tags.rail')}}</p>
                        <p class="tag equipment second" id="3.10">{{__('tags.rigUpDown')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_4">
                        <p class="tag equipment second" id="4.1">{{__('tags.pumpiI')}}</p>
                        <p class="tag equipment second" id="4.2">{{__('tags.hydComonents')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="4.3">{{__('tags.mudPumps')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="4.4">{{__('tags.pumpPD')}}</p>
                        <p class="tag equipment second" id="4.5">{{__('tags.pumpCent')}}</p>
                        <p class="tag equipment second" id="4.6">{{__('tags.pumpPlunger')}}</p>
                        <p class="tag equipment second" id="4.7">{{__('tags.pumpSinking')}}</p>
                        <p class="tag equipment second" id="4.8">{{__('tags.component')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_5">
                        <p class="tag equipment second" id="5.1">{{__('tags.filter')}}</p>
                        <p class="tag equipment second" id="5.2">{{__('tags.hose')}}</p>
                        <p class="tag equipment second" id="5.3">{{__('tags.compressor')}}</p>
                        <p class="tag equipment second" id="5.4">{{__('tags.linesHP')}}</p>
                        <p class="tag equipment second" id="5.5">{{__('tags.manifold')}}</p>
                        <p class="tag equipment second" id="5.6">{{__('tags.buffer')}}</p>
                        <p class="tag equipment second" id="5.7">{{__('tags.clear')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="5.8">{{__('tags.prepare')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="5.9">{{__('tags.store')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="5.10">{{__('tags.recycling')}}</p>
                        <p class="tag equipment second" id="5.11">{{__('tags.standPipe')}}</p>
                        <p class="tag equipment second" id="5.12">{{__('tags.trashPump')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_6">
                        <p class="tag equipment second" id="6.1">{{__('tags.coring')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="6.2">{{__('tags.wellLoginng')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_7">
                        <p class="tag equipment second" id="7.1">{{__('tags.grinding')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="7.2">{{__('tags.washingMachine')}}</p>
                        <p class="tag equipment second" id="7.3">{{__('tags.wrench')}}</p>
                        <p class="tag equipment second" id="7.4">{{__('tags.lineMount')}}</p>
                        <p class="tag equipment second" id="7.5">{{__('tags.cutter')}}</p>
                        <p class="tag equipment second" id="7.6">{{__('tags.welding')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_8">
                        <p class="tag equipment second" id="8.1">{{__('tags.rotational')}}</p>
                        <p class="tag equipment second" id="8.2">{{__('tags.percussion')}}</p>
                        <p class="tag equipment second" id="8.3">{{__('tags.pneumatic')}}</p>
                        <p class="tag equipment second" id="8.4">{{__('tags.pdm')}}</p>
                        <p class="tag equipment second" id="8.5">{{__('tags.electrical')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_10">
                        <p class="tag equipment second" id="10.1">{{__('tags.indicator')}}</p>
                        <p class="tag equipment second" id="10.2">{{__('tags.measurmentEq')}}</p>
                        <p class="tag equipment second" id="10.3">{{__('tags.cable')}}</p>
                        <p class="tag equipment second" id="10.4">{{__('tags.camera')}}</p>
                        <p class="tag equipment second" id="10.5">{{__('tags.registerEq')}}</p>
                        <p class="tag equipment second" id="10.6">{{__('tags.loggingGage')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_11">
                        <p class="tag equipment second" id="11.1">{{__('tags.stubB')}}</p>
                        <p class="tag equipment second" id="11.2">{{__('tags.stubP')}}</p>
                        <p class="tag equipment second" id="11.3">{{__('tags.stubE')}}</p>
                        <p class="tag equipment second" id="11.4">{{__('tags.stubR')}}</p>
                        <p class="tag equipment second" id="11.5">{{__('tags.stubCone')}}</p>
                        <p class="tag equipment second" id="11.6">{{__('tags.stubPD')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_12">
                        <p class="tag equipment second" id="12.1">{{__('tags.shower')}}</p>
                        <p class="tag equipment second" id="12.2">{{__('tags.house')}}</p>
                        <p class="tag equipment second" id="12.3">{{__('tags.kitchen')}}</p>
                        <p class="tag equipment second" id="12.4">{{__('tags.med')}}</p>
                        <p class="tag equipment second" id="12.5">{{__('tags.wc')}}</p>
                        <p class="tag equipment second" id="12.6">{{__('tags.electrics')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_13">
                        <p class="tag equipment second" id="13.1">{{__('tags.shoe')}}</p>
                        <p class="tag equipment second" id="13.2">{{__('tags.casingPipe')}}</p>
                        <p class="tag equipment second" id="13.3">{{__('tags.casingEq')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="13.4">{{__('tags.joint')}}</p>
                        <p class="tag equipment second" id="13.5">{{__('tags.xOver')}}</p>
                        <p class="tag equipment second" id="13.6">{{__('tags.scratcher')}}</p>
                        <p class="tag equipment second" id="13.7">{{__('tags.cementing')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_14">
                        <p class="tag equipment second" id="14.1">{{__('tags.emergencyValve')}}</p>
                        <p class="tag equipment second" id="14.2">{{__('tags.bath')}}</p>
                        <p class="tag equipment second" id="14.3">{{__('tags.fishingTool')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="14.4">{{__('tags.sigil')}}</p>
                        <p class="tag equipment second" id="14.5">{{__('tags.mill')}}</p>
                        <p class="tag equipment second" id="14.6">{{__('tags.junkBasket')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_15">
                        <p class="tag equipment second" id="15.1">{{__('tags.lubricatorDP')}}</p>
                        <p class="tag equipment second" id="15.2">{{__('tags.lubricatorTong')}}</p>
                        <p class="tag equipment second" id="15.3">{{__('tags.lubricatorPump')}}</p>
                        <p class="tag equipment second" id="15.4">{{__('tags.lubricatorTubing')}}</p>
                        <p class="tag equipment second" id="15.5">{{__('tags.lubricatorCasing')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_16">
                        <p class="tag equipment second" id="16.1">{{__('tags.knockOffValve')}}</p>
                        <p class="tag equipment second" id="16.2">{{__('tags.collTubing')}}</p>
                        <p class="tag equipment second" id="16.3">{{__('tags.tubing')}}</p>
                        <p class="tag equipment second" id="16.4">{{__('tags.joint')}}</p>
                        <p class="tag equipment second" id="16.5">{{__('tags.xOver')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_17">
                        <p class="tag equipment second" id="17.1">{{__('tags.casingSpool')}}</p>
                        <p class="tag equipment second" id="17.2">{{__('tags.xMassTree')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_18">
                        <p class="tag equipment second" id="18.1">{{__('tags.packerPumps')}}</p>
                        <p class="tag equipment second" id="18.2">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment second" id="18.3">{{__('tags.packerStd')}}</p>
                        <p class="tag equipment second" id="18.4">{{__('tags.packerPipes')}}</p>
                        <p class="tag equipment second" id="18.5">{{__('tags.packerHoses')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_19">
                        <p class="tag equipment second" id="19.1">{{__('tags.airLine')}}</p>
                        <p class="tag equipment second" id="19.2">{{__('tags.airTank')}}</p>
                        <p class="tag equipment second" id="19.3">{{__('tags.compensator')}}</p>
                        <p class="tag equipment second" id="19.4">{{__('tags.airDrier')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_20">
                        <p class="tag equipment second" id="20.1">{{__('tags.crown')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="20.2">{{__('tags.degasser')}}</p>
                        <p class="tag equipment second" id="20.3">{{__('tags.bopValveWheel')}}</p>
                        <p class="tag equipment second" id="20.4">{{__('tags.line')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="20.5">{{__('tags.manifold')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="20.6">{{__('tags.ram')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="20.7">{{__('tags.bop')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="20.8">{{__('tags.flare')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_21">
                        <p class="tag equipment second" id="21.1">{{__('tags.kelly')}}</p>
                        <p class="tag equipment second" id="21.2">{{__('tags.swivel')}}</p>
                        <p class="tag equipment second" id="21.3">{{__('tags.tdsSystem')}}</p>
                        <p class="tag equipment second" id="21.4">{{__('tags.rotor')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_22">
                        <p class="tag equipment second" id="22.1">{{__('tags.distributionUnit')}}</p>
                        <p class="tag equipment second" id="22.2">{{__('tags.generator')}}</p>
                        <p class="tag equipment second" id="22.3">{{__('tags.cabel')}}</p>
                        <p class="tag equipment second" id="22.4">{{__('tags.transformator')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_23">
                        <p class="tag equipment second" id="23.1">{{__('tags.simCasingS')}}</p>
                        <p class="tag equipment second" id="23.2">{{__('tags.simCasingB')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_24">
                        <p class="tag equipment second" id="24.1">{{__('tags.bomb')}}</p>
                        <p class="tag equipment second" id="24.2">{{__('tags.fillingStation')}}</p>
                        <p class="tag equipment second" id="24.3">{{__('tags.tanks')}}</p>
                        <p class="tag equipment second" id="24.4">{{__('tags.measuringEq')}}</p>
                        <p class="tag equipment second" id="24.5">{{__('tags.fuel')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_25">
                        <p class="tag equipment second" id="25.1">{{__('tags.crane')}}</p>
                        <p class="tag equipment second" id="25.2">{{__('tags.forklifter')}}</p>
                        <p class="tag equipment second" id="25.3">{{__('tags.truck')}}</p>
                        <p class="tag equipment second" id="25.4">{{__('tags.cementingTruck')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_26">
                        <p class="tag equipment second" id="26.1">{{__('tags.emergencyDrive')}}</p>
                        <p class="tag equipment second" id="26.2">{{__('tags.drillHook')}}</p>
                        <p class="tag equipment second" id="26.3">{{__('tags.drillLineSys')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="26.4">{{__('tags.handlingWinch')}}</p>
                        <p class="tag equipment second" id="26.5">{{__('tags.deadAnchor')}}</p>
                        <p class="tag equipment second" id="26.6">{{__('tags.crownBlock')}}</p>
                        <p class="tag equipment second" id="26.7">{{__('tags.travelBlock')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_27">
                        <p class="tag equipment second" id="27.1">{{__('tags.heavingPlug')}}</p>
                        <p class="tag equipment second" id="27.2">{{__('tags.manualClamp')}}</p>
                        <p class="tag equipment second" id="27.3">{{__('tags.pipeClamp')}}</p>
                        <p class="tag equipment second" id="27.4">{{__('tags.casingGrip')}}</p>
                        <p class="tag equipment second" id="27.5">{{__('tags.elevator')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                    </div>
                    <div class="hidden tags equipment second tags_28">
                        <p class="tag equipment second" id="28.1">{{__('tags.fireHazard')}}</p>
                        <p class="tag equipment second" id="28.2">{{__('tags.signalization')}}</p>
                        <p class="tag equipment second" id="28.3">{{__('tags.lifeSupport')}}</p>
                        <p class="tag equipment second" id="28.4">{{__('tags.light')}}</p>
                        <p class="tag equipment second" id="28.5">{{__('tags.ppo')}}</p>
                        <p class="tag equipment second" id="28.6">{{__('tags.misc')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_29">
                        <p class="tag equipment second" id="29.1">{{__('tags.component')}}</p>
                        <p class="tag equipment second" id="29.2">{{__('tags.tongHy')}}<img class="arrow-img" src="{{asset('icons/rightArrowIcon.svg')}}" alt=""></p>
                        <p class="tag equipment second" id="29.3">{{__('tags.tongTubing')}}</p>
                        <p class="tag equipment second" id="29.4">{{__('tags.tongCasing')}}</p>
                        <p class="tag equipment second" id="29.5">{{__('tags.tongManual')}}</p>
                        <p class="tag equipment second" id="29.6">{{__('tags.tongF')}}</p>
                        <p class="tag equipment second" id="29.7">{{__('tags.tongP')}}</p>
                        <p class="tag equipment second" id="29.8">{{__('tags.tongC')}}</p>
                        <p class="tag equipment second" id="29.9">{{__('tags.tongHi')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_30">
                        <p class="tag equipment second" id="30.1">{{__('tags.slip')}}</p>
                        <p class="tag equipment second" id="30.2">{{__('tags.spider')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_31">
                        <p class="tag equipment second" id="31.1">{{__('tags.sequesteringAgentFiltrationControl')}}</p>
                        <p class="tag equipment second" id="31.2">{{__('tags.mudHeaver')}}</p>
                        <p class="tag equipment second" id="31.3">{{__('tags.LCM')}}</p>
                        <p class="tag equipment second" id="31.4">{{__('tags.bentoniteAlternate')}}</p>
                        <p class="tag equipment second" id="31.5">{{__('tags.nonOrganic')}}</p>
                        <p class="tag equipment second" id="31.6">{{__('tags.lubticants')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_32">
                        <p class="tag equipment second" id="32.1">{{__('tags.densityEq')}}</p>
                        <p class="tag equipment second" id="32.2">{{__('tags.asgEq')}}</p>
                        <p class="tag equipment second" id="32.3">{{__('tags.viscosityEq')}}</p>
                        <p class="tag equipment second" id="32.4">{{__('tags.sssEq')}}</p>
                        <p class="tag equipment second" id="32.5">{{__('tags.pHEq')}}</p>
                        <p class="tag equipment second" id="32.6">{{__('tags.waterLossEq')}}</p>
                    </div>
                    <div class="hidden tags equipment second tags_33">
                        <p class="tag equipment second" id="33.1">{{__('tags.hyrdoMeck')}}</p>
                        <p class="tag equipment second" id="33.2">{{__('tags.hydraulic')}}</p>
                    </div>
                </div>
                <div class="column">
                    <div class="hidden tags equipment third tags_2.5">
                        <p class="tag equipment third" id="2.5.1">{{__('tags.xOverDump')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_2.10">
                        <p class="tag equipment third" id="2.10.1">{{__('tags.dcSlick')}}</p>
                        <p class="tag equipment third" id="2.10.2">{{__('tags.dcSpiral')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_4.2">
                        <p class="tag equipment third" id="4.2.1">{{__('tags.hydActuator')}}</p>
                        <p class="tag equipment third" id="4.2.1">{{__('tags.hydPulser')}}</p>
                        <p class="tag equipment third" id="4.2.1">{{__('tags.hydController')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_4.3">
                        <p class="tag equipment third" id="4.2.1">{{__('tags.engine')}}</p>
                        <p class="tag equipment third" id="4.2.2">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment third" id="4.2.3">{{__('tags.pumpController')}}</p>
                        <p class="tag equipment third" id="4.2.4">{{__('tags.pumpSupercharger')}}</p>
                        <p class="tag equipment third" id="4.2.5">{{__('tags.pneumaticCompensator')}}</p>
                        <p class="tag equipment third" id="4.2.6">{{__('tags.suctionFiler')}}</p>
                        <p class="tag equipment third" id="4.2.7">{{__('tags.pressureFiler')}}</p>
                        <p class="tag equipment third" id="4.2.8">{{__('tags.safeValve')}}</p>
                        <p class="tag equipment third" id="4.2.9">{{__('tags.cooling')}}</p>
                        <p class="tag equipment third" id="4.2.10">{{__('tags.component')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_4.8">
                        <p class="tag equipment third" id="4.7.1">{{__('tags.compensator')}}</p>
                        <p class="tag equipment third" id="4.7.2">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment third" id="4.7.3">{{__('tags.filters')}}</p>
                        <p class="tag equipment third" id="4.7.4">{{__('tags.barrel')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_5.7">
                        <p class="tag equipment third" id="5.7.1">{{__('tags.shaker')}}</p>
                        <p class="tag equipment third" id="5.7.2">{{__('tags.degasser')}}</p>
                        <p class="tag equipment third" id="5.7.3">{{__('tags.desilter')}}</p>
                        <p class="tag equipment third" id="5.7.4">{{__('tags.desender')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_5.8">
                        <p class="tag equipment third" id="5.8.1">{{__('tags.mixer')}}</p>
                        <p class="tag equipment third" id="5.8.2">{{__('tags.mudCone')}}</p>
                        <p class="tag equipment third" id="5.8.3">{{__('tags.mixingUnit')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_5.9">
                        <p class="tag equipment third" id="5.9.1">{{__('tags.mudTanks')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_6.1">
                        <p class="tag equipment third" id="6.1.1">{{__('tags.coringBox')}}</p>
                        <p class="tag equipment third" id="6.1.2">{{__('tags.coreBBL')}}</p>
                        <p class="tag equipment third" id="6.1.3">{{__('tags.coringReciever')}}</p>
                        <p class="tag equipment third" id="6.1.4">{{__('tags.coringPipe')}}</p>
                        <p class="tag equipment third" id="6.1.5">{{__('tags.coringBit')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_6.2">
                        <p class="tag equipment third" id="6.2.1">{{__('tags.loggingVideo')}}</p>
                        <p class="tag equipment third" id="6.2.2">{{__('tags.misc')}}</p>
                        <p class="tag equipment third" id="6.2.3">{{__('tags.loggingDirectional')}}</p>
                        <p class="tag equipment third" id="6.2.4">{{__('tags.caliperLog')}}</p>
                        <p class="tag equipment third" id="6.2.5">{{__('tags.loggingUnit')}}</p>
                        <p class="tag equipment third" id="6.2.6">{{__('tags.coil')}}</p>
                        <p class="tag equipment third" id="6.2.7">{{__('tags.winch')}}</p>
                        <p class="tag equipment third" id="6.2.8">{{__('tags.loggingMagnetic')}}</p>
                        <p class="tag equipment third" id="6.2.9">{{__('tags.waterFlow')}}</p>
                        <p class="tag equipment third" id="6.2.10">{{__('tags.radiometrics')}}</p>
                        <p class="tag equipment third" id="6.2.11">{{__('tags.flowSurvey')}}</p>
                        <p class="tag equipment third" id="6.2.12">{{__('tags.recordingSystem')}}</p>
                        <p class="tag equipment third" id="6.2.13">{{__('tags.seismicMeasurements')}}</p>
                        <p class="tag equipment third" id="6.2.14">{{__('tags.photometryNephelometry')}}</p>
                        <p class="tag equipment third" id="6.2.15">{{__('tags.geoelectricSurvey')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_7.1">
                        <p class="tag equipment third" id="7.1.1">{{__('tags.grindingM')}}</p>
                        <p class="tag equipment third" id="7.1.2">{{__('tags.grindingC')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_7.6">
                        <p class="tag equipment third" id="7.6.1">{{__('tags.gasWeld')}}</p>
                        <p class="tag equipment third" id="7.6.2">{{__('tags.electroWeld')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_13.3">
                        <p class="tag equipment third" id="13.3.1">{{__('tags.box')}}</p>
                        <p class="tag equipment third" id="13.3.2">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment third" id="13.3.3">{{__('tags.guidePlug')}}</p>
                        <p class="tag equipment third" id="13.3.4">{{__('tags.centraliserTurbulizer')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_13.7">
                        <p class="tag equipment third" id="13.7.1">{{__('tags.cementingBasket')}}</p>
                        <p class="tag equipment third" id="13.7.2">{{__('tags.DVCollar')}}</p>
                        <p class="tag equipment third" id="13.7.3">{{__('tags.stingerCementing')}}</p>
                        <p class="tag equipment third" id="13.7.4">{{__('tags.cementBridge')}}</p>
                        <p class="tag equipment third" id="13.7.5">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment third" id="13.7.6">{{__('tags.packer')}}</p>
                        <p class="tag equipment third" id="13.7.7">{{__('tags.cementPlugs')}}</p>
                        <p class="tag equipment third" id="13.7.8">{{__('tags.cementBaffleCollar')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_14.3">
                        <p class="tag equipment third" id="14.3.1">{{__('tags.overShot')}}</p>
                        <p class="tag equipment third" id="14.3.2">{{__('tags.magnetic')}}</p>
                        <p class="tag equipment third" id="14.3.3">{{__('tags.taperTap')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.1">
                        <p class="tag equipment third" id="20.1.1">{{__('tags.hydro')}}</p>
                        <p class="tag equipment third" id="20.1.2">{{__('tags.manual')}}</p>
                        <p class="tag equipment third" id="20.1.3">{{__('tags.remote')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.4">
                        <p class="tag equipment third" id="20.4.1">{{__('tags.kill')}}</p>
                        <p class="tag equipment third" id="20.4.2">{{__('tags.chock')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.5">
                        <p class="tag equipment third" id="20.5.1">{{__('tags.kill')}}</p>
                        <p class="tag equipment third" id="20.5.2">{{__('tags.chock')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.6">
                        <p class="tag equipment third" id="20.6.1">{{__('tags.blind')}}</p>
                        <p class="tag equipment third" id="20.6.2">{{__('tags.cut')}}</p>
                        <p class="tag equipment third" id="20.6.3">{{__('tags.pipe')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.7">
                        <p class="tag equipment third" id="20.7.1">{{__('tags.singleBop')}}</p>
                        <p class="tag equipment third" id="20.7.2">{{__('tags.doubleBop')}}</p>
                        <p class="tag equipment third" id="20.7.3">{{__('tags.annular')}}</p>
                        <p class="tag equipment third" id="20.7.4">{{__('tags.drillingSpool')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_20.8">
                        <p class="tag equipment third" id="20.8.1">{{__('tags.flareBody')}}</p>
                        <p class="tag equipment third" id="20.8.2">{{__('tags.flareControl')}}</p>
                        <p class="tag equipment third" id="20.8.3">{{__('tags.flareActivator')}}</p>
                        <p class="tag equipment third" id="20.8.4">{{__('tags.flareLines')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_21.3">
                        <p class="tag equipment third" id="21.3.1">{{__('tags.emergencySys')}}</p>
                        <p class="tag equipment third" id="21.3.2">{{__('tags.shaft')}}</p>
                        <p class="tag equipment third" id="21.3.3">{{__('tags.hydraulicSys')}}</p>
                        <p class="tag equipment third" id="21.3.4">{{__('tags.mudPipe')}}</p>
                        <p class="tag equipment third" id="21.3.5">{{__('tags.sensor')}}</p>
                        <p class="tag equipment third" id="21.3.6">{{__('tags.controllStantion')}}</p>
                        <p class="tag equipment third" id="21.3.7">{{__('tags.component')}}</p>
                        <p class="tag equipment third" id="21.3.8">{{__('tags.ballValve')}}</p>
                        <p class="tag equipment third" id="21.3.9">{{__('tags.tdsRail')}}</p>
                        <p class="tag equipment third" id="21.3.10">{{__('tags.floatCollar')}}</p>
                        <p class="tag equipment third" id="21.3.11">{{__('tags.washPipe')}}</p>
                        <p class="tag equipment third" id="21.3.12">{{__('tags.ControllUnit')}}</p>
                        <p class="tag equipment third" id="21.3.13">{{__('tags.bail')}}</p>
                        <p class="tag equipment third" id="21.3.14">{{__('tags.electroEngines')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_21.4">
                        <p class="tag equipment third" id="21.4.1">{{__('tags.kellyBush')}}</p>
                        <p class="tag equipment third" id="21.4.2">{{__('tags.component')}}</p>
                        <p class="tag equipment third" id="21.4.3">{{__('tags.rotorDrive')}}</p>
                        <p class="tag equipment third" id="21.4.4">{{__('tags.brakes')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_23.2">
                        <p class="tag equipment third" id="23.2.1">{{__('tags.simCasingBS')}}</p>
                        <p class="tag equipment third" id="23.2.2">{{__('tags.simCasingBB')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_26.3">
                        <p class="tag equipment third" id="26.3.1">{{__('tags.reel')}}</p>
                        <p class="tag equipment third" id="26.3.2">{{__('tags.drive')}}</p>
                        <p class="tag equipment third" id="26.3.3">{{__('tags.cooling')}}</p>
                        <p class="tag equipment third" id="26.3.4">{{__('tags.brakes')}}</p>
                        <p class="tag equipment third" id="26.3.5">{{__('tags.drillLine')}}</p>
                        <p class="tag equipment third" id="26.3.6">{{__('tags.electroEngines')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_27.5">
                        <p class="tag equipment third" id="27.5.1">{{__('tags.elevatorS')}}</p>
                        <p class="tag equipment third" id="27.5.2">{{__('tags.elevatorI')}}</p>
                    </div>
                    <div class="hidden tags equipment third tags_29.2">
                        <p class="tag equipment third" id="29.2.1">{{__('tags.tongHyControll')}}</p>
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