<?php

namespace App\Http\Controllers\Traits;

trait Tags
{

    protected $tagsMap = [];

    //not a  __constructor because those methods is not effacted by app locale
    public function constructTagsMap() 
    {
        $this->tagsMap = [
            '1' => __('tags.hseEq'),
                '1.1' => __('tags.fireHazard'),
                '1.2' => __('tags.lifeSupport'),
                '1.3' => __('tags.light'),
                '1.4' => __('tags.miscEq'),
                '1.5' => __('tags.ppo'),
                '1.6' => __('tags.signalization'),
            '2' => __('tags.bit'),
                '2.1' => __('tags.cone'),
                '2.2' => __('tags.pdc'),
                '2.3' => __('tags.tsp'),
                '2.4' => __('tags.carbide'),
                '2.5' => __('tags.wing'),
                '2.6' => __('tags.pneumo'),
            '3' => __('tags.tong'),
                '3.1' => __('tags.tongHy'),
                '3.2' => __('tags.tongB'),
                '3.3' => __('tags.tongC'),
                '3.4' => __('tags.tongP'),
                '3.5' => __('tags.tongF'),
                '3.6' => __('tags.tongHi'),
            '4' => __('tags.pump'),
                '4.1' => __('tags.pumpPD'),
                '4.2' => __('tags.pumpCent'),
                '4.3' => __('tags.pumpPlunger'),
            '5' => __('tags.pipe'),
                '5.1' => __('tags.pipeStd'),
                '5.2' => __('tags.pipeHW'),
            '6' => __('tags.rig'),
                '6.1' => __('tags.substructure'),
                '6.2' => __('tags.rail'),
                '6.3' => __('tags.mast'),
                '6.4' => __('tags.rigUpDown'),
                '6.5' => __('tags.mastTools'),
                '6.6' => __('tags.monkeyBoard'),
            '7' => __('tags.mud'),
                '7.1' => __('tags.filter'),
                '7.2' => __('tags.hose'),
                '7.3' => __('tags.compressor'),
                '7.4' => __('tags.store'),
                '7.5' => __('tags.manifold'),
                '7.6' => __('tags.clear'),
                '7.7' => __('tags.mixer'),
                '7.8' => __('tags.recycling'),
                '7.9' => __('tags.laboratory'),
                '7.10' => __('tags.mudCone'),
                '7.11' => __('tags.trashPump'),
            '8' => __('tags.rotory'),
                '8.1' => __('tags.rotor'),
                '8.2' => __('tags.swivel'),
                '8.3' => __('tags.tdsSystem'),
                    '8.3.1' => __('tags.suspension'),
                    '8.3.2' => __('tags.mudPipe'),
                    '8.3.3' => __('tags.fosv'),
                    '8.3.4' => __('tags.tdsRail'),
                    '8.3.5' => __('tags.electrics'),
                    '8.3.6' => __('tags.washPipe'),
            '9' => __('tags.wellHeadSealing'),
            '10' => __('tags.hydComonents'),
                '10.1' => __('tags.hydActuator'),
                '10.2' => __('tags.hydPulser'),
                '10.3' => __('tags.hydController'),
            '11' => __('tags.hydJack'),
            '12' => __('tags.hydСlamp'),
            '13' => __('tags.crawlerTruck'),
            '14' => __('tags.dampe'),
            '15' => __('tags.pumpControll'),
            '16' => __('tags.motor'),
            '17' => __('tags.parts'),
                '17.1' => __('tags.'),
            '18' => __('tags.grinding'),
                '18.1' => __('tags.grindingM'),
                '18.2' => __('tags.grindingC'),
            '19' => __('tags.control'),
                '19.1' => __('tags.indicator'),
                '19.2' => __('tags.cable'),
                '19.3' => __('tags.registerEq'),
                '19.4' => __('tags.measurmentEq'),
                '19.5' => __('tags.camera'),
            '20' => __('tags.coringEq'),
                '20.1' => __('tags.crown'),
                    '20.1.1' => __('tags.crownD'),
                    '20.1.2' => __('tags.crownI'),
                    '20.1.3' => __('tags.crownP'),
                '20.2' => __('tags.coringBox'),
                '20.3' => __('tags.coringPipe'),
            '21' => __('tags.calibrator'),
            '22' => __('tags.drawworksLines'),
                '22.1' => __('tags.drawworks'),
                '22.2' => __('tags.drillLine'),
                '22.3' => __('tags.hoisting'),
            '23' => __('tags.emergency'),
                '23.1' => __('tags.fishingTool'),
                    '23.1.1' => __('tags.overShot'),
                    '23.1.2' => __('tags.magnetic'),
                '23.2' => __('tags.bath'),
                '23.3' => __('tags.scratcher'),
                '23.4' => __('tags.sigil'),
                '23.5' => __('tags.junkBasket'),
                '23.6' => __('tags.mill'),
            '24' => __('tags.lubricator'),
            '25' => __('tags.slidHammer'),
            '26' => __('tags.collar'),
            '27' => __('tags.packer'),
                '27.1' => __('tags.packerStd'),
                '27.2' => __('tags.packerPumps'),
                '27.3' => __('tags.packerPipes'),
                '27.4' => __('tags.packerHoses'),
            '28' => __('tags.xOver'),
            '29' => __('tags.hammerD'),
            '30' => __('tags.boe'),
                '30.1' => __('tags.bop'),
                    '30.1.1' => __('tags.annular'),
                '30.2' => __('tags.ram'),
                '30.3' => __('tags.wheels'),
                '30.4' => __('tags.bopValve'),
                '30.5' => __('tags.manifold'),
                '30.6' => __('tags.line'),
                '30.7' => __('tags.flare'),
                '30.8' => __('tags.controlUnit'),
                    '30.8.1' => __('tags.manual'),
                    '30.8.2' => __('tags.remote'),
                    '30.8.3' => __('tags.hydro'),
            '31' => __('tags.holeOpener'),
                '31.1' => __('tags.reamerE'),
                '31.2' => __('tags.reamerR'),
                '31.3' => __('tags.reamerPD'),
                '31.4' => __('tags.reamerP'),
                '31.5' => __('tags.reamerB'),
            '32' => __('tags.chemics'),
            '33' => __('tags.simCasing'),
                '33.1' => __('tags.simCasingS'),
                '33.2' => __('tags.simCasingB'),
                    '33.2.1' => __('tags.simCasingBB'),
                    '33.2.2' => __('tags.simCasingBS'),
            '34' => __('tags.power'),
                '34.1' => __('tags.transformator'),
                '34.2' => __('tags.generator'),
                '34.3' => __('tags.distributionUnit'),
                '34.4' => __('tags.cabel'),
            '35' => __('tags.casingEq'),
                '35.1' => __('tags.casingPipe'),
                '35.2' => __('tags.casingEq'),
            '36' => __('tags.pipeHandling'),
                '36.1' => __('tags.elevator'),
                    '36.1.1' => __('tags.elevatorS'),
                    '36.1.2' => __('tags.elevatorI'),
                '36.2' => __('tags.pipeClamp'),
                '36.3' => __('tags.bail'),
                '36.4' => __('tags.heavingPlug'),
                '36.5' => __('tags.manualClamp'),
                '36.6' => __('tags.casingGrip'),
            '37' => __('tags.lifting'),
                '37.1' => __('tags.crownBlock'),
                '37.2' => __('tags.travelBlock'),
                '37.3' => __('tags.drillHook'),
                '37.4' => __('tags.deadAnchor'),
            '38' => __('tags.pipeLocking'),
                '38.1' => __('tags.spider'),
                '38.2' => __('tags.slip'),
            '39' => __('tags.cementing'),

            '50' => __('tags.otherService'),
            '51' => __('tags.multipleService'),
            '52' => __('tags.loggingS'),
            '53' => __('tags.loggingW'),
                '53.1' => __('tags.core'),
                '53.2' => __('tags.stdWellLog'),
            '54' => __('tags.lab'),
            '55' => __('tags.guard'),
            '56' => __('tags.transport'),
            '57' => __('tags.vihacle'),
            '58' => __('tags.ndt'),
            '59' => __('tags.control'),
            '60' => __('tags.training'),
            '61' => __('tags.airWaste'),
            '62' => __('tags.recyclingDrill'),
            '63' => __('tags.recyclingDomestic'),
            '64' => __('tags.bitSe'),
            '65' => __('tags.bopSe'),
            '66' => __('tags.grounding'),
            '67' => __('tags.builders'),
            '68' => __('tags.emergencySe'),
            '69' => __('tags.casing'),
            '70' => __('tags.dhm')

        ];
    }

    // transform '2.3.1.4' to 'drillingEq, drillString, upGround, slip'
    public function getTagReadable($id) {
        $this->constructTagsMap();
        $tagsMap = $this->getTagMap($id);
        $tagsInString = '';
        foreach($tagsMap as $tag) {
            $tagsInString = $tagsInString == '' ? $tag : $tagsInString.", ".$tag;
        }
        return $tagsInString;
    }

    // transform '2.3.1.4' to [2=>'drillingEq', 3=>'drillString', 1=>'upGround', 4=>'slip']
    public function getTagMap($id) {
        $this->constructTagsMap();
        $idPath = [];
        $this->getTagMapHelper($id, $idPath);
        return array_reverse($idPath, true);
    }

    // transform '2.3' to 'drillString'
    private function getTagNameById($id) {
        return $this->tagsMap[$id];
    }

    // recursive helper for getTagMap()
    private function getTagMapHelper($id, &$idPath) { 
        $idPath[$id] = $this->getTagNameById($id);
        if ( strpos($id, '.') !== false ) {
            for ( $i=strlen($id)-1; $i>0 ; $i--) {
                if ($id[$i] == '.') {
                    $id = substr_replace($id ,"",-1);
                    break;
                } else {
                    $id = substr_replace($id ,"",-1);
                }
            }
            $this->getTagMapHelper($id, $idPath);
        } else {
            return;
        }
    }
    
}
