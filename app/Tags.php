<?php

namespace App;

trait Tags
{

    protected $tagsMap = [];

    //not a  __constructor because those methods is not effacted by app locale
    public function constructTagsMap() 
    {
        $this->tagsMap = [
            '0' => __('tags.other'), //if user did not specify tag when creating post
            '1' => __('tags.hseEq'),
                '1.0' => __('tags.other'),
                '1.1' => __('tags.fireHazard'),
                '1.2' => __('tags.lifeSupport'),
                '1.3' => __('tags.light'),
                '1.4' => __('tags.miscEq'),
                '1.5' => __('tags.ppo'),
                '1.6' => __('tags.signalization'),
            '2' => __('tags.drillingEq'),
                '2.0' => __('tags.other'),
                '2.1' => __('tags.bha'),
                    '2.1.1' => __('tags.upGround'),
                        '2.1.1.1' => __('tags.tong'),
                        '2.1.1.2' => __('tags.elevator'),
                        '2.1.1.3' => __('tags.spider'),
                        '2.1.1.4' => __('tags.slip'),
                        '2.1.1.5' => __('tags.drift'),
                    '2.1.2' => __('tags.underGround'),
                        '2.1.2.1' => __('tags.hwdp'),
                        '2.1.2.2' => __('tags.dc'),
                            '2.1.2.2.1' => __('tags.dcStrait'),
                            '2.1.2.2.2' => __('tags.dcSpiral'),
                        '2.1.2.3' => __('tags.xOver'),
                        '2.1.2.4' => __('tags.jar'),
                        '2.1.2.5' => __('tags.motor'),
                        '2.1.2.6' => __('tags.digger'),
                            '2.1.2.6.1' => __('tags.bit'),
                                '2.1.2.6.1.1' => __('tags.pdc'),
                                '2.1.2.6.1.2' => __('tags.cone'),
                                '2.1.2.6.1.3' => __('tags.tsp'),
                        '2.1.2.7' => __('tags.stab'),
                            '2.1.2.7.1' => __('tags.stabStrait'),
                            '2.1.2.7.2' => __('tags.stabSpiral'),
                '2.2' => __('tags.boe'),
                    '2.2.1' => __('tags.upGround'),
                        '2.2.1.1' => __('tags.bop'),
                            '2.2.1.1.1' => __('tags.annular'),
                            '2.2.1.1.2' => __('tags.ram'),
                            '2.2.1.1.3' => __('tags.wheels'),
                            '2.2.1.1.4' => __('tags.bopValve'),
                        '2.2.1.2' => __('tags.manifold'),
                        '2.2.1.3' => __('tags.line'),
                        '2.2.1.4' => __('tags.flare'),
                        '2.2.1.5' => __('tags.controlUnit'),
                            '2.2.1.5.1' => __('tags.manual'),
                            '2.2.1.5.2' => __('tags.remote'),
                            '2.2.1.5.3' => __('tags.hydro'),
                        '2.2.1.6' => __('tags.emergencyValve'),
                    '2.2.2' => __('tags.underGround'),
                '2.3' => __('tags.drillString'),
                    '2.3.1' => __('tags.upGround'),
                        '2.3.1.1' => __('tags.tong'),
                        '2.3.1.2' => __('tags.elevator'),
                        '2.3.1.3' => __('tags.spider'),
                        '2.3.1.4' => __('tags.slip'),
                        '2.3.1.5' => __('tags.drift'),
                    '2.3.2' => __('tags.underGround'),
                        '2.3.2.1' => __('tags.pipe'),
                        '2.3.2.2' => __('tags.cally'),
                        '2.3.2.3' => __('tags.xOver'),
                        '2.3.2.4' => __('tags.valve'),
                        '2.3.2.5' => __('tags.filter'),
                '2.4' => __('tags.emergency'),
                    '2.4.1' => __('tags.bath'),
                    '2.4.2' => __('tags.fishingTool'),
                        '2.4.2.1' => __('tags.overShot'),
                        '2.4.2.2' => __('tags.junkBasket'),
                        '2.4.2.3' => __('tags.magnetic'),
                    '2.4.3' => __('tags.scratcher'),
                    '2.4.4' => __('tags.sigil'),
                    '2.4.5' => __('tags.mill'),
                '2.5' => __('tags.grouning'),
                    '2.5.1' => __('tags.casingEq'),
                        '2.5.1.1' => __('tags.casingPipe'),
                        '2.5.1.2' => __('tags.casingEq'),
                        '2.5.1.3' => __('tags.casingRunningEq'),
                            '2.5.1.3.1' => __('tags.tong'),
                            '2.5.1.3.2' => __('tags.elevator'),
                            '2.5.1.3.3' => __('tags.spider'),
                            '2.5.1.3.4' => __('tags.slip'),
                            '2.5.1.3.5' => __('tags.drift'),
                    '2.5.2' => __('tags.cementing'),
                    '2.5.3' => __('tags.test'),
                    '2.5.4' => __('tags.preparation'),
                '2.7' => __('tags.lifting'),
                    '2.7.1' => __('tags.crownBlock'),
                    '2.7.2' => __('tags.travelBlock'),
                    '2.7.3' => __('tags.drillHook'),
                    '2.7.4' => __('tags.deadAnchor'),
                    '2.7.5' => __('tags.winch'),
                    '2.7.6' => __('tags.drillLine'),
                    '2.7.7' => __('tags.bail'),
                '2.8' => __('tags.control'),
                    '2.8.1' => __('tags.indicator'),
                    '2.8.2' => __('tags.cable'),
                    '2.8.3' => __('tags.registerEq'),
                    '2.8.4' => __('tags.measurmentEq'),
                '2.9' => __('tags.mast'),
                    '2.9.1' => __('tags.rigUpDown'),
                    '2.9.2' => __('tags.mastTools'),
                    '2.9.3' => __('tags.monkeyBoard'),
                    '2.9.4' => __('tags.height1'),
                    '2.9.5' => __('tags.height2'),
                    '2.9.6' => __('tags.height3'),
                '2.10' => __('tags.mud'),
                    '2.10.1' => __('tags.circulation'),
                        '2.10.1.1' => __('tags.pump'),
                        '2.10.1.2' => __('tags.hose'),
                        '2.10.1.3' => __('tags.filter'),
                        '2.10.1.4' => __('tags.compressor'),
                        '2.10.1.5' => __('tags.manifold'),
                    '2.10.2' => __('tags.store'),
                    '2.10.3' => __('tags.clear'),
                    '2.10.4' => __('tags.mixing'),
                    '2.10.5' => __('tags.recycling'),
                    '2.10.6' => __('tags.laboratory'),
                '2.11' => __('tags.power'),
                    '2.11.1' => __('tags.transformator'),
                    '2.11.2' => __('tags.generator'),
                    '2.11.3' => __('tags.distributionUnit'),
                    '2.11.4' => __('tags.cabel'),
                '2.12' => __('tags.rotory'),
                    '2.12.1' => __('tags.rotor'),
                    '2.12.2' => __('tags.tdsSystem'),
                        '2.12.2.1' => __('tags.suspension'),
                        '2.12.2.2' => __('tags.mudPipe'),
                        '2.12.2.3' => __('tags.fosv'),
                        '2.12.2.4' => __('tags.tdsRail'),
                        '2.12.2.5' => __('tags.electrics'),
                        '2.12.2.6' => __('tags.washPipe'),
                    '2.12.3' => __('tags.swivel'),
                '2.13' => __('tags.substructure'),
                    '2.13.1' => __('tags.rail'),
                    '2.13.2' => __('tags.weight1'),
                    '2.13.3' => __('tags.weight2'),
                    '2.13.4' => __('tags.weight3'),
                '2.14' => __('tags.other'),
            '3' => __('tags.repairEq'),
                '3.0' => __('tags.other'),
                '3.1' => __('tags.boe'),
                '3.2' => __('tags.coilTubing'),
                '3.3' => __('tags.drillString'),
                '3.4' => __('tags.emergency'),
                '3.5' => __('tags.frac'),
                '3.6' => __('tags.lifting'),
                '3.7' => __('tags.control'),
                '3.8' => __('tags.mast'),
                '3.9' => __('tags.mdu'),
                '3.10' => __('tags.power'),
                '3.11' => __('tags.rotory'),
                '3.12' => __('tags.substructure'),
                '3.13' => __('tags.tubing'),
                '3.14' => __('tags.wellHeadEq'),
            '4' => __('tags.productionEq'),
                '4.0' => __('tags.other'),
                '4.1' => __('tags.tubing'),
                '4.2' => __('tags.wellHead'),
                '4.3' => __('tags.xMassTree'),
            '5' => __('tags.loggingEq'), 
                '5.0' => __('tags.other'), 
                '5.1' => __('tags.loggingTool'), 
                '5.2' => __('tags.miscEq'), 
        ];
    }

    public function getTagPathAsString($id) {
        $this->constructTagsMap();
        $tagsArray = $this->getTagNameByIdWithPath($id);
        $tagsInString = '';
        foreach($tagsArray as $tag) {
            if ($tagsInString == '') {
                $tagsInString = $tag;
            } else {
                $tagsInString = $tagsInString . ", " . $tag;
            }
        }
        return $tagsInString;
    }

    public function getTagNameByIdWithPath($id) {
        $this->constructTagsMap();
        $idPath = [];
        $this->makeIdPath($id, $idPath);
        return $idPath;
    }

    private function getTagNameById($id) {
        return $this->tagsMap[$id];
    }

    private function makeIdPath($id, &$idPath) { 
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
            $this->makeIdPath($id, $idPath);
        } else {
            return;
        }
    }
    
    /*
    public function getTags() {
        $resultPath = $this->recursive_array_search(15, $this->tags);
        var_dump( $resultPath );
        //user clickes on some node
        if ( !$resultPath ) {

        }
        dd( $this->recursiveFind($this->tags, 7) );
        dd( array_keys($this->tags) );
        dd( $this->tags );
    }

    public function recursiveFind(array $array, $needle) {
        $iterator  = new RecursiveArrayIterator($array);
        $recursive = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
        $aHitList = array();
        foreach ($recursive as $key => $value) {
            if ($key === $needle) {
                array_push($aHitList, $value);
            }
        }
        return $aHitList;
    }  

    private function recursive_array_search($needle, $haystack, $currentKey = '') {
        foreach($haystack as $key=>$value) {
            if (is_array($value)) {
                $nextKey = $this->recursive_array_search($needle,$value, $currentKey . '[' . $key . ']');
                if ($nextKey) {
                    return $nextKey;
                }
            }
            else if($value==$needle) {
                return is_numeric($key) ? $currentKey . '[' .$key . ']' : $currentKey . '["' .$key . '"]';
            }
        }
        return false;
    }

    
    public function getTags() {
        $arr = [
            'Blue' => [
                'circle',
                'square' => [
                    'book',
                    'pencil',
                    'pen'
                ],
                'triangle'
            ],
            'Red' =>[
                'text',
                'word',
                'letter' => [
                    'rock',
                    'wood' => [
                        'arm',
                        'leg',
                        'neck',
                        'head'
                    ],
                    'plastic'
                ],
                'sentence'
            ],
            'White' =>[
                'time'
            ],
            'Orange' =>[
                'time'
            ],
        ];
        $this->array_map_recursive(function($item){
            var_dump($item);
        }, $this->tags);
        dd($arr);
    }
            
    private function array_map_recursive($callback, $array) {
        $func = function ($item) use (&$func, &$callback) {
            return is_array($item) ? array_map($func, $item) : call_user_func($callback, $item);
        };

        return array_map($func, $array);
    }

    public function getTags() {
        foreach ($this->tags as $key => $value) {
            $this->tags[$this->getTagName($key)] = $value;
            unset($this->tags[$key]);

            if (is_array($value)) {
                foreach($value as $key2 => $value2) {
                    $this->tags[$this->getTagName($key)][$this->getTagName($key2)] = $value2;
                    unset($this->tags[$this->getTagName($key)][$key2]);
                
                    if (is_array($value2)) {
                        foreach($value2 as $key3 => $value3) {
                            dd($value2);
                            $this->tags[$this->getTagName($key)][$this->getTagName($key2)][$this->gettagName($key3)] = $value3;
                            unset($this->tags[$this->getTagName($key)][$this->getTagName($key2)][$key3]);
                        }
                    }
                }
            }
        }
        dd($this->tags);
    }
    */

}
