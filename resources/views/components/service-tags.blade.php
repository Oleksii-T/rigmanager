<div id="popup-select-se-tag" class="popup">
    <div class="popup-title">{{__('ui.tags')}}</div>
    <div class="popup-text">{{__('ui.chooseTag')}}</div>
    <form action="">
        <fieldset>
            <div class="select-block tag-lvl-1">
                <select class="styled">
                    <option value="50">{{__('tags.otherService')}}</option>
                    <option value="51">{{__('tags.multipleService')}}</option>
                    <option value="52">{{__('tags.emergencySe')}}</option>
                    <option value="53">{{__('tags.controll')}}</option>
                    <option value="75">{{__('tags.drillingCntr')}}</option>
                    <option value="54">{{__('tags.airWaste')}}</option>
                    <option value="55">{{__('tags.loggingSe')}}</option>
                    <option value="56">{{__('tags.ndt')}}</option>
                    <option value="57">{{__('tags.bitSe')}}</option>
                    <option value="58">{{__('tags.dhmSe')}}</option>
                    <option value="59">{{__('tags.grounding')}}</option>
                    <option value="61">{{__('tags.directionalDrilling')}}</option>
                    <option value="62">{{__('tags.casingSe')}}</option>
                    <option value="63">{{__('tags.guard')}}</option>
                    <option value="64">{{__('tags.bopSe')}}</option>
                    <option value="65">{{__('tags.training')}}</option>
                    <option value="66">{{__('tags.pipeShipment')}}</option>
                    <option value="67">{{__('tags.sellControllFuel')}}</option>
                    <option value="68">{{__('tags.vihacle')}}</option>
                    <option value="69">{{__('tags.builders')}}</option>
                    <option value="70">{{__('tags.loggingSt')}}</option>
                    <option value="71">{{__('tags.transport')}}</option>
                    <option value="72">{{__('tags.recyclingSe')}}</option>
                    <option value="73">{{__('tags.lab')}}</option>
                    <option value="74">{{__('tags.cementingSe')}}</option>
                </select>
            </div>
            <div class="select-block tag-lvl-2">
                <select class="styled hidden tags_55">
                    <option value="55.0">{{__('tags.notSelected')}}</option>
                    <option value="55.1">{{__('tags.coringSe')}}</option>
                    <option value="55.2">{{__('tags.stdWellLog')}}</option>
                </select>
                <select class="styled hidden tags_72">
                    <option value="72.0">{{__('tags.notSelected')}}</option>
                    <option value="72.1">{{__('tags.recyclingDrill')}}</option>
                    <option value="72.2">{{__('tags.recyclingDomestic')}}</option>
                </select>
            </div>
            <div class="select-block tag-lvl-3">
                <select class="styled hidden">
                    <option value=""></option>
                </select>
            </div>
            <input type="text" name="tag-hidden" hidden>
            <button class="button select-tag-btn" type="button">{{__('ui.choose')}}</button>
        </fieldset>
    </form>
</div>