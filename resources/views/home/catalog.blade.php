@extends('layouts.page')

@section('meta')
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">{{__('ui.catalog')}}</span></span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
<div class="main-block">
	<aside class="side">
		<a href="#side-block" data-fancybox class="side-mob">{{__('ui.catalogNav')}}</a>
		<div class="side-block" id="side-block">
			<div class="side-title">{{__('ui.catalogNav')}}</div>
			<ul class="side-list">
				<li><a href="{{loc_url(route('tag-0'))}}">{{__('tags.other')}}</a></li>
				<li><a href="{{loc_url(route('tag-1'))}}">{{__('tags.bit')}}</a></li>
				<li><a href="{{loc_url(route('tag-2'))}}">{{__('tags.dp')}}</a></li>
				<li><a href="{{loc_url(route('tag-3'))}}">{{__('tags.rig')}}</a></li>
				<li><a href="{{loc_url(route('tag-4'))}}">{{__('tags.pump')}}</a></li>
				<li><a href="{{loc_url(route('tag-5'))}}">{{__('tags.mud')}}</a></li>
				<li><a href="{{loc_url(route('tag-6'))}}">{{__('tags.boreholeSurvey')}}</a></li>
				<li><a href="{{loc_url(route('tag-7'))}}">{{__('tags.miscHelpEq')}}</a></li>
				<li><a href="{{loc_url(route('tag-8'))}}">{{__('tags.motor')}}</a></li>
				<li><a href="{{loc_url(route('tag-9'))}}">{{__('tags.parts')}}</a></li>
				<li><a href="{{loc_url(route('tag-10'))}}">{{__('tags.control')}}</a></li>
				<li><a href="{{loc_url(route('tag-11'))}}">{{__('tags.stub')}}</a></li>
				<li><a href="{{loc_url(route('tag-12'))}}">{{__('tags.camp')}}</a></li>
				<li><a href="{{loc_url(route('tag-13'))}}">{{__('tags.casingCementing')}}</a></li>
				<li><a href="{{loc_url(route('tag-14'))}}">{{__('tags.emergency')}}</a></li>
				<li><a href="{{loc_url(route('tag-15'))}}">{{__('tags.lubricator')}}</a></li>
				<li><a href="{{loc_url(route('tag-16'))}}">{{__('tags.tubingEq')}}</a></li>
				<li><a href="{{loc_url(route('tag-17'))}}">{{__('tags.wellHeadEq')}}</a></li>
				<li><a href="{{loc_url(route('tag-18'))}}">{{__('tags.packer')}}</a></li>
				<li><a href="{{loc_url(route('tag-19'))}}">{{__('tags.airUtility')}}</a></li>
				<li><a href="{{loc_url(route('tag-20'))}}">{{__('tags.boe')}}</a></li>
				<li><a href="{{loc_url(route('tag-21'))}}">{{__('tags.rotory')}}</a></li>
				<li><a href="{{loc_url(route('tag-22'))}}">{{__('tags.power')}}</a></li>
				<li><a href="{{loc_url(route('tag-23'))}}">{{__('tags.simCasing')}}</a></li>
				<li><a href="{{loc_url(route('tag-24'))}}">{{__('tags.diselStorage')}}</a></li>
				<li><a href="{{loc_url(route('tag-25'))}}">{{__('tags.specMachinery')}}</a></li>
				<li><a href="{{loc_url(route('tag-26'))}}">{{__('tags.lifting')}}</a></li>
				<li><a href="{{loc_url(route('tag-27'))}}">{{__('tags.pipeHandling')}}</a></li>
				<li><a href="{{loc_url(route('tag-28'))}}">{{__('tags.hseEq')}}</a></li>
				<li><a href="{{loc_url(route('tag-29'))}}">{{__('tags.tong')}}</a></li>
				<li><a href="{{loc_url(route('tag-30'))}}">{{__('tags.chemics')}}</a></li>
				<li><a href="{{loc_url(route('tag-31'))}}">{{__('tags.chemLab')}}</a></li>
				<li><a href="{{loc_url(route('tag-32'))}}">{{__('tags.jar')}}</a></li>
			</ul>
		</div>
	</aside>
	<div class="content">
		<h1>{{__('ui.catalog')}}</h1>
		<div class="content-top-text catalog-help">{{__('ui.catalogHelp')}}
		<a href="#se-tags-flag">{{__('ui.gotToSeTags')}}</a></div>
		<div class="category">
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-0'))}}"><img src="{{asset('icons/noImage.svg')}}" alt=""></a></div>
					<div class="category-name"><a href="{{loc_url(route('tag-0'))}}">{{__('tags.other')}}</a> (<span class="orange">{{array_key_exists(0, $posts_amount) ? $posts_amount[0] : '0'}}</span>)</div>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-1'))}}"><img src="{{asset('icons/tags/1.png')}}" alt=""></a></div>
					<div class="category-name"><a href="{{loc_url(route('tag-1'))}}">{{__('tags.bit')}}</a> (<span class="orange">{{array_key_exists(1, $posts_amount) ? $posts_amount[1] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-1.1'))}}">{{__('tags.bicentric')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.2'))}}">{{__('tags.bitBreaker')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.3'))}}">{{__('tags.bitDevice')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.4'))}}">{{__('tags.wing')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.5'))}}">{{__('tags.bitNozzle')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.6'))}}">{{__('tags.pneumo')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.7'))}}">{{__('tags.cone')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.8'))}}">{{__('tags.carbide')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.9'))}}">{{__('tags.pdc')}}</a></li>
						<li><a href="{{loc_url(route('tag-1.10'))}}">{{__('tags.tsp')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-2'))}}"><img src="{{asset('icons/tags/2.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-2" href="{{loc_url(route('tag-2'))}}">{{__('tags.dp')}}</a> (<span class="orange">{{array_key_exists(2, $posts_amount) ? $posts_amount[2] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-2.1'))}}">{{__('tags.slipJoint')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.2'))}}">{{__('tags.ldp')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.3'))}}">{{__('tags.floatCollar')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.4'))}}">{{__('tags.joint')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.5'))}}">{{__('tags.xOver')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-2.5.1'))}}">{{__('tags.xOverDump')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-2.6'))}}">{{__('tags.packerRubber')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.7'))}}">{{__('tags.stabilizersOnPipe')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.8'))}}">{{__('tags.pipeStd')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.9'))}}">{{__('tags.hwdp')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.10'))}}">{{__('tags.dc')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-2.10.1'))}}">{{__('tags.dcSlick')}}</a></li>
								<li><a href="{{loc_url(route('tag-2.10.2'))}}">{{__('tags.dcSpiral')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-2.11'))}}">{{__('tags.filters')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.12'))}}">{{__('tags.centralizers')}}</a></li>
						<li><a href="{{loc_url(route('tag-2.13'))}}">{{__('tags.drift')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-3'))}}"><img src="{{asset('icons/tags/3.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-3" href="{{loc_url(route('tag-3'))}}">{{__('tags.rig')}}</a> (<span class="orange">{{array_key_exists(3, $posts_amount) ? $posts_amount[3] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-3.1'))}}">{{__('tags.mastTools')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.2'))}}">{{__('tags.drillerHouse')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.3'))}}">{{__('tags.mast')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.4'))}}">{{__('tags.mdu')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.5'))}}">{{__('tags.catWalks')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.6'))}}">{{__('tags.substructure')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.7'))}}">{{__('tags.monkeyBoard')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.8'))}}">{{__('tags.dogHouse')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.9'))}}">{{__('tags.rail')}}</a></li>
						<li><a href="{{loc_url(route('tag-3.10'))}}">{{ __('tags.rigUpDown')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-4'))}}"><img src="{{asset('icons/tags/4.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-4" href="{{loc_url(route('tag-4'))}}">{{__('tags.pump')}}</a> (<span class="orange">{{array_key_exists(4, $posts_amount) ? $posts_amount[4] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-4.1'))}}">{{__('tags.pumpiI')}}</a></li>
						<li><a href="{{loc_url(route('tag-4.2'))}}">{{__('tags.hydComponents')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-4.2.1'))}}">{{__('tags.hydActuator')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.2.2'))}}">{{__('tags.hydPulser')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.2.3'))}}">{{__('tags.hydController')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-4.3'))}}">{{__('tags.mudPumps')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-4.3.1'))}}">{{__('tags.engine')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.2'))}}">{{__('tags.floatCollar')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.3'))}}">{{__('tags.pumpController')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.4'))}}">{{__('tags.pumpSupercharger')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.5'))}}">{{__('tags.pneumaticCompensator')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.6'))}}">{{__('tags.suctionFiler')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.7'))}}">{{__('tags.pressureFiler')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.8'))}}">{{__('tags.safeValve')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.9'))}}">{{__('tags.cooling')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.3.10'))}}">{{__('tags.component')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-4.4'))}}">{{__('tags.pumpPD')}}</a></li>
						<li><a href="{{loc_url(route('tag-4.5'))}}">{{__('tags.pumpCent')}}</a></li>
						<li><a href="{{loc_url(route('tag-4.6'))}}">{{__('tags.pumpPlunger')}}</a></li>
						<li><a href="{{loc_url(route('tag-4.7'))}}">{{__('tags.pumpSinking')}}</a></li>
						<li><a href="{{loc_url(route('tag-4.8'))}}">{{__('tags.component')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-4.8.1'))}}">{{__('tags.compensator')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.8.2'))}}">{{__('tags.floatCollar')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.8.3'))}}">{{__('tags.filters')}}</a></li>
								<li><a href="{{loc_url(route('tag-4.8.4'))}}">{{__('tags.barrel')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-5'))}}"><img src="{{asset('icons/tags/5.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-5" href="{{loc_url(route('tag-5'))}}">{{__('tags.mud')}}</a> (<span class="orange">{{array_key_exists(5, $posts_amount) ? $posts_amount[5] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-5.1'))}}">{{__('tags.buffer')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.2'))}}">{{__('tags.mudDmpr')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.3'))}}">{{__('tags.compressor')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.4'))}}">{{__('tags.linesHP')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.5'))}}">{{__('tags.manifold')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.6'))}}">{{__('tags.clear')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-5.6.1'))}}">{{__('tags.shaker')}}</a></li>
								<li><a href="{{loc_url(route('tag-5.6.2'))}}">{{__('tags.degasser')}}</a></li>
								<li><a href="{{loc_url(route('tag-5.6.3'))}}">{{__('tags.desilter')}}</a></li>
								<li><a href="{{loc_url(route('tag-5.6.4'))}}">{{__('tags.desender')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-5.7'))}}">{{__('tags.recycling')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.8'))}}">{{__('tags.prepare')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-5.8.1'))}}">{{__('tags.mixer')}}</a></li>
								<li><a href="{{loc_url(route('tag-5.8.2'))}}">{{__('tags.mudCone')}}</a></li>
								<li><a href="{{loc_url(route('tag-5.8.3'))}}">{{__('tags.mixingUnit')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-5.9'))}}">{{__('tags.store')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-5.9.1'))}}">{{__('tags.mudTanks')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-5.10'))}}">{{__('tags.standPipe')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.11'))}}">{{__('tags.filters')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.12'))}}">{{__('tags.trashPump')}}</a></li>
						<li><a href="{{loc_url(route('tag-5.13'))}}">{{__('tags.hose')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-6'))}}"><img src="{{asset('icons/tags/6.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-6" href="{{loc_url(route('tag-6'))}}">{{__('tags.boreholeSurvey')}}</a> (<span class="orange">{{array_key_exists(6, $posts_amount) ? $posts_amount[6] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-6.1'))}}">{{__('tags.coring')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-6.1.1'))}}">{{__('tags.coringBox')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.1.2'))}}">{{__('tags.coreBBL')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.1.3'))}}">{{__('tags.coringReciever')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.1.4'))}}">{{__('tags.coringPipe')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.1.5'))}}">{{__('tags.coringBit')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-6.2'))}}">{{__('tags.wellLoginng')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-6.2.1'))}}">{{__('tags.loggingVideo')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.2'))}}">{{__('tags.misc')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.3'))}}">{{__('tags.loggingDirectional')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.4'))}}">{{__('tags.caliperLog')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.5'))}}">{{__('tags.loggingUnit')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.6'))}}">{{__('tags.coil')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.7'))}}">{{__('tags.winch')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.8'))}}">{{__('tags.loggingMagnetic')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.9'))}}">{{__('tags.waterFlow')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.10'))}}">{{__('tags.radiometrics')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.11'))}}">{{__('tags.flowSurvey')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.12'))}}">{{__('tags.recordingSystem')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.13'))}}">{{__('tags.seismicMeasurements')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.14'))}}">{{__('tags.photometryNephelometry')}}</a></li>
								<li><a href="{{loc_url(route('tag-6.2.15'))}}">{{__('tags.geoelectricSurvey')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-7'))}}"><img src="{{asset('icons/tags/7.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-7" href="{{loc_url(route('tag-7'))}}">{{__('tags.miscHelpEq')}}</a> (<span class="orange">{{array_key_exists(7, $posts_amount) ? $posts_amount[7] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-7.1'))}}">{{__('tags.grinding')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-7.1.1'))}}">{{__('tags.grindingM')}}</a></li>
								<li><a href="{{loc_url(route('tag-7.1.1'))}}">{{__('tags.grindingC')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-7.2'))}}">{{__('tags.washingMachine')}}</a></li>
						<li><a href="{{loc_url(route('tag-7.3'))}}">{{__('tags.wrench')}}</a></li>
						<li><a href="{{loc_url(route('tag-7.4'))}}">{{__('tags.lineMount')}}</a></li>
						<li><a href="{{loc_url(route('tag-7.5'))}}">{{__('tags.cutter')}}</a></li>
						<li><a href="{{loc_url(route('tag-7.6'))}}">{{__('tags.welding')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-7.6.1'))}}">{{__('tags.gasWeld')}}</a></li>
								<li><a href="{{loc_url(route('tag-7.6.2'))}}">{{__('tags.electroWeld')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-8'))}}"><img src="{{asset('icons/tags/8.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-8" href="{{loc_url(route('tag-8'))}}">{{__('tags.motor')}}</a> (<span class="orange">{{array_key_exists(8, $posts_amount) ? $posts_amount[8] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-8.1'))}}">{{__('tags.rotational')}}</a></li>
						<li><a href="{{loc_url(route('tag-8.2'))}}">{{__('tags.percussion')}}</a></li>
						<li><a href="{{loc_url(route('tag-8.3'))}}">{{__('tags.pneumatic')}}</a></li>
						<li><a href="{{loc_url(route('tag-8.4'))}}">{{__('tags.pdm')}}</a></li>
						<li><a href="{{loc_url(route('tag-8.5'))}}">{{__('tags.electrical')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-9'))}}"><img src="{{asset('icons/tags/9.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-9" href="{{loc_url(route('tag-9'))}}">{{__('tags.parts')}}</a> (<span class="orange">{{array_key_exists(9, $posts_amount) ? $posts_amount[9] : '0'}}</span>)</div>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-10'))}}"><img src="{{asset('icons/tags/10.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-10" href="{{loc_url(route('tag-10'))}}">{{__('tags.control')}}</a> (<span class="orange">{{array_key_exists(10, $posts_amount) ? $posts_amount[10] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-10.1'))}}">{{__('tags.indicator')}}</a></li>
						<li><a href="{{loc_url(route('tag-10.2'))}}">{{__('tags.measurmentEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-10.3'))}}">{{__('tags.cable')}}</a></li>
						<li><a href="{{loc_url(route('tag-10.4'))}}">{{__('tags.camera')}}</a></li>
						<li><a href="{{loc_url(route('tag-10.5'))}}">{{__('tags.registerEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-10.6'))}}">{{__('tags.loggingGage')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-11'))}}"><img src="{{asset('icons/tags/11.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-11" href="{{loc_url(route('tag-11'))}}">{{__('tags.stub')}}</a> (<span class="orange">{{array_key_exists(11, $posts_amount) ? $posts_amount[11] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-11.1'))}}">{{__('tags.stubB')}}</a></li>
						<li><a href="{{loc_url(route('tag-11.2'))}}">{{__('tags.stubP')}}</a></li>
						<li><a href="{{loc_url(route('tag-11.3'))}}">{{__('tags.stubE')}}</a></li>
						<li><a href="{{loc_url(route('tag-11.4'))}}">{{__('tags.stubR')}}</a></li>
						<li><a href="{{loc_url(route('tag-11.5'))}}">{{__('tags.stubCone')}}</a></li>
						<li><a href="{{loc_url(route('tag-11.6'))}}">{{__('tags.stubPD')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-12'))}}"><img src="{{asset('icons/tags/12.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-12" href="{{loc_url(route('tag-12'))}}">{{__('tags.camp')}}</a> (<span class="orange">{{array_key_exists(12, $posts_amount) ? $posts_amount[12] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-12.1'))}}">{{__('tags.shower')}}</a></li>
						<li><a href="{{loc_url(route('tag-12.2'))}}">{{__('tags.house')}}</a></li>
						<li><a href="{{loc_url(route('tag-12.3'))}}">{{__('tags.kitchen')}}</a></li>
						<li><a href="{{loc_url(route('tag-12.4'))}}">{{__('tags.med')}}</a></li>
						<li><a href="{{loc_url(route('tag-12.5'))}}">{{__('tags.wc')}}</a></li>
						<li><a href="{{loc_url(route('tag-12.6'))}}">{{__('tags.electrics')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-13'))}}"><img src="{{asset('icons/tags/13.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-13" href="{{loc_url(route('tag-13'))}}">{{__('tags.casingCementing')}}</a> (<span class="orange">{{array_key_exists(13, $posts_amount) ? $posts_amount[13] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-13.1'))}}">{{__('tags.shoe')}}</a></li>
						<li><a href="{{loc_url(route('tag-13.2'))}}">{{__('tags.casingPipe')}}</a></li>
						<li><a href="{{loc_url(route('tag-13.3'))}}">{{__('tags.casingEq')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-13.3.1'))}}">{{__('tags.box')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.3.2'))}}">{{__('tags.floatCollar')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.3.3'))}}">{{__('tags.guidePlug')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.3.4'))}}">{{__('tags.centraliserTurbulizer')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-13.4'))}}">{{__('tags.joint')}}</a></li>
						<li><a href="{{loc_url(route('tag-13.5'))}}">{{__('tags.xOver')}}</a></li>
						<li><a href="{{loc_url(route('tag-13.6'))}}">{{__('tags.scratcher')}}</a></li>
						<li><a href="{{loc_url(route('tag-13.7'))}}">{{__('tags.cementing')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-13.7.1'))}}">{{__('tags.cementingBasket')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.2'))}}">{{__('tags.DVCollar')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.3'))}}">{{__('tags.stingerCementing')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.4'))}}">{{__('tags.cementBridge')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.5'))}}">{{__('tags.floatCollar')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.6'))}}">{{__('tags.packer')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.7'))}}">{{__('tags.cementPlugs')}}</a></li>
								<li><a href="{{loc_url(route('tag-13.7.8'))}}">{{__('tags.cementBaffleCollar')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-14'))}}"><img src="{{asset('icons/tags/14.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-14" href="{{loc_url(route('tag-14'))}}">{{__('tags.emergency')}}</a> (<span class="orange">{{array_key_exists(14, $posts_amount) ? $posts_amount[14] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-14.1'))}}">{{__('tags.emergencyValve')}}</a></li>
						<li><a href="{{loc_url(route('tag-14.2'))}}">{{__('tags.bath')}}</a></li>
						<li><a href="{{loc_url(route('tag-14.3'))}}">{{__('tags.fishingTool')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-14.3.1'))}}">{{__('tags.overShot')}}</a></li>
								<li><a href="{{loc_url(route('tag-14.3.2'))}}">{{__('tags.magnetic')}}</a></li>
								<li><a href="{{loc_url(route('tag-14.3.3'))}}">{{__('tags.taperTap')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-14.4'))}}">{{__('tags.sigil')}}</a></li>
						<li><a href="{{loc_url(route('tag-14.5'))}}">{{__('tags.mill')}}</a></li>
						<li><a href="{{loc_url(route('tag-14.6'))}}">{{__('tags.junkBasket')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-15'))}}"><img src="{{asset('icons/tags/15.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-15" href="{{loc_url(route('tag-15'))}}">{{__('tags.lubricator')}}</a> (<span class="orange">{{array_key_exists(15, $posts_amount) ? $posts_amount[15] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-15.1'))}}">{{__('tags.lubricatorDP')}}</a></li>
						<li><a href="{{loc_url(route('tag-15.2'))}}">{{__('tags.lubricatorTong')}}</a></li>
						<li><a href="{{loc_url(route('tag-15.3'))}}">{{__('tags.lubricatorPump')}}</a></li>
						<li><a href="{{loc_url(route('tag-15.4'))}}">{{__('tags.lubricatorTubing')}}</a></li>
						<li><a href="{{loc_url(route('tag-15.5'))}}">{{__('tags.lubricatorCasing')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-16'))}}"><img src="{{asset('icons/tags/16.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-16" href="{{loc_url(route('tag-16'))}}">{{__('tags.tubingEq')}}</a> (<span class="orange">{{array_key_exists(16, $posts_amount) ? $posts_amount[16] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-16.1'))}}">{{__('tags.knockOffValve')}}</a></li>
						<li><a href="{{loc_url(route('tag-16.2'))}}">{{__('tags.collTubing')}}</a></li>
						<li><a href="{{loc_url(route('tag-16.3'))}}">{{__('tags.tubing')}}</a></li>
						<li><a href="{{loc_url(route('tag-16.4'))}}">{{__('tags.joint')}}</a></li>
						<li><a href="{{loc_url(route('tag-16.5'))}}">{{__('tags.xOver')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-17'))}}"><img src="{{asset('icons/tags/17.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-17" href="{{loc_url(route('tag-17'))}}">{{__('tags.wellHeadEq')}}</a> (<span class="orange">{{array_key_exists(17, $posts_amount) ? $posts_amount[17] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-17.1'))}}">{{__('tags.casingSpool')}}</a></li>
						<li><a href="{{loc_url(route('tag-17.2'))}}">{{__('tags.xMassTree')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-18'))}}"><img src="{{asset('icons/tags/18.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-18" href="{{loc_url(route('tag-18'))}}">{{__('tags.packer')}}</a> (<span class="orange">{{array_key_exists(18, $posts_amount) ? $posts_amount[18] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-18.1'))}}">{{__('tags.packerPumps')}}</a></li>
						<li><a href="{{loc_url(route('tag-18.2'))}}">{{__('tags.floatCollar')}}</a></li>
						<li><a href="{{loc_url(route('tag-18.3'))}}">{{__('tags.packerStd')}}</a></li>
						<li><a href="{{loc_url(route('tag-18.4'))}}">{{__('tags.packerPipes')}}</a></li>
						<li><a href="{{loc_url(route('tag-18.5'))}}">{{__('tags.packerHoses')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-19'))}}"><img src="{{asset('icons/tags/19.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-19" href="{{loc_url(route('tag-19'))}}">{{__('tags.airUtility')}}</a> (<span class="orange">{{array_key_exists(19, $posts_amount) ? $posts_amount[19] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-19.1'))}}">{{__('tags.airLine')}}</a></li>
						<li><a href="{{loc_url(route('tag-19.2'))}}">{{__('tags.airTank')}}</a></li>
						<li><a href="{{loc_url(route('tag-19.3'))}}">{{__('tags.compensator')}}</a></li>
						<li><a href="{{loc_url(route('tag-19.4'))}}">{{__('tags.airDrier')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-20'))}}"><img src="{{asset('icons/tags/20.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-20" href="{{loc_url(route('tag-20'))}}">{{__('tags.boe')}}</a> (<span class="orange">{{array_key_exists(20, $posts_amount) ? $posts_amount[20] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-20.1'))}}">{{__('tags.controlUnit')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-20.1.1'))}}">{{__('tags.hydro')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.1.2'))}}">{{__('tags.manual')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.1.3'))}}">{{__('tags.remote')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-20.2'))}}">{{__('tags.degasser')}}</a></li>
						<li><a href="{{loc_url(route('tag-20.3'))}}">{{__('tags.bopValveWheel')}}</a></li>
						<li><a href="{{loc_url(route('tag-20.4'))}}">{{__('tags.line')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-20.4.1'))}}">{{__('tags.kill')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.4.2'))}}">{{__('tags.chock')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-20.5'))}}">{{__('tags.manifold')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-20.5.1'))}}">{{__('tags.kill')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.5.2'))}}">{{__('tags.chock')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-20.6'))}}">{{__('tags.ram')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-20.6.1'))}}">{{__('tags.blind')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.6.2'))}}">{{__('tags.cut')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.6.3'))}}">{{__('tags.pipe')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-20.7'))}}">{{__('tags.bop')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-20.7.1'))}}">{{__('tags.singleBop')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.7.2'))}}">{{__('tags.doubleBop')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.7.3'))}}">{{__('tags.annular')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.7.4'))}}">{{__('tags.drillingSpool')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-20.8'))}}">{{__('tags.flare')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-20.8.1'))}}">{{__('tags.flareBody')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.8.2'))}}">{{__('tags.flareControl')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.8.3'))}}">{{__('tags.flareActivator')}}</a></li>
								<li><a href="{{loc_url(route('tag-20.8.4'))}}">{{__('tags.flareLines')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-21'))}}"><img src="{{asset('icons/tags/21.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-20" href="{{loc_url(route('tag-21'))}}">{{__('tags.rotory')}}</a> (<span class="orange">{{array_key_exists(21, $posts_amount) ? $posts_amount[21] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-21.1'))}}">{{__('tags.kelly')}}</a></li>
						<li><a href="{{loc_url(route('tag-21.2'))}}">{{__('tags.swivel')}}</a></li>
						<li><a href="{{loc_url(route('tag-21.3'))}}">{{__('tags.tdsSystem')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-21.3.1'))}}">{{__('tags.emergencySys')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.2'))}}">{{__('tags.shaft')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.3'))}}">{{__('tags.hydraulicSys')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.4'))}}">{{__('tags.mudPipe')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.5'))}}">{{__('tags.sensor')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.6'))}}">{{__('tags.controllStantion')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.7'))}}">{{__('tags.component')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.8'))}}">{{__('tags.ballValve')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.9'))}}">{{__('tags.tdsRail')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.10'))}}">{{__('tags.floatCollar')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.11'))}}">{{__('tags.washPipe')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.12'))}}">{{__('tags.ControllUnit')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.13'))}}">{{__('tags.bail')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.3.14'))}}">{{__('tags.electroEngines')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-21.4'))}}">{{__('tags.rotor')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-21.4.1'))}}">{{__('tags.kellyBush')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.4.2'))}}">{{__('tags.component')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.4.3'))}}">{{__('tags.rotorDrive')}}</a></li>
								<li><a href="{{loc_url(route('tag-21.4.4'))}}">{{__('tags.brakes')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-22'))}}"><img src="{{asset('icons/tags/22.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-22" href="{{loc_url(route('tag-22'))}}">{{__('tags.power')}}</a> (<span class="orange">{{array_key_exists(22, $posts_amount) ? $posts_amount[22] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-22.1'))}}">{{__('tags.distributionUnit')}}</a></li>
						<li><a href="{{loc_url(route('tag-22.2'))}}">{{__('tags.generator')}}</a></li>
						<li><a href="{{loc_url(route('tag-22.3'))}}">{{__('tags.cabel')}}</a></li>
						<li><a href="{{loc_url(route('tag-22.4'))}}">{{__('tags.transformator')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-23'))}}"><img src="{{asset('icons/tags/23.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-23" href="{{loc_url(route('tag-23'))}}">{{__('tags.simCasing')}}</a> (<span class="orange">{{array_key_exists(23, $posts_amount) ? $posts_amount[23] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-23.1'))}}">{{__('tags.simCasingS')}}</a></li>
						<li><a href="{{loc_url(route('tag-23.2'))}}">{{__('tags.simCasingB')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-23.2.1'))}}">{{__('tags.simCasingBS')}}</a></li>
								<li><a href="{{loc_url(route('tag-23.2.2'))}}">{{__('tags.simCasingBB')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-24'))}}"><img src="{{asset('icons/tags/24.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-24" href="{{loc_url(route('tag-24'))}}">{{__('tags.diselStorage')}}</a> (<span class="orange">{{array_key_exists(24, $posts_amount) ? $posts_amount[24] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-24.1'))}}">{{__('tags.bomb')}}</a></li>
						<li><a href="{{loc_url(route('tag-24.2'))}}">{{__('tags.fillingStation')}}</a></li>
						<li><a href="{{loc_url(route('tag-24.3'))}}">{{__('tags.tanks')}}</a></li>
						<li><a href="{{loc_url(route('tag-24.4'))}}">{{__('tags.measuringEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-24.5'))}}">{{__('tags.fuel')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-25'))}}"><img src="{{asset('icons/tags/25.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-25" href="{{loc_url(route('tag-25'))}}">{{__('tags.specMachinery')}}</a> (<span class="orange">{{array_key_exists(25, $posts_amount) ? $posts_amount[25] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-25.1'))}}">{{__('tags.crane')}}</a></li>
						<li><a href="{{loc_url(route('tag-25.2'))}}">{{__('tags.forklifter')}}</a></li>
						<li><a href="{{loc_url(route('tag-25.3'))}}">{{__('tags.truck')}}</a></li>
						<li><a href="{{loc_url(route('tag-25.4'))}}">{{__('tags.cementingTruck')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-26'))}}"><img src="{{asset('icons/tags/26.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-26" href="{{loc_url(route('tag-26'))}}">{{__('tags.lifting')}}</a> (<span class="orange">{{array_key_exists(26, $posts_amount) ? $posts_amount[26] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-26.1'))}}">{{__('tags.emergencyDrive')}}</a></li>
						<li><a href="{{loc_url(route('tag-26.2'))}}">{{__('tags.drillHook')}}</a></li>
						<li><a href="{{loc_url(route('tag-26.3'))}}">{{__('tags.drillLineSys')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-26.3.1'))}}">{{__('tags.reel')}}</a></li>
								<li><a href="{{loc_url(route('tag-26.3.2'))}}">{{__('tags.drive')}}</a></li>
								<li><a href="{{loc_url(route('tag-26.3.3'))}}">{{__('tags.cooling')}}</a></li>
								<li><a href="{{loc_url(route('tag-26.3.4'))}}">{{__('tags.brakes')}}</a></li>
								<li><a href="{{loc_url(route('tag-26.3.5'))}}">{{__('tags.drillLine')}}</a></li>
								<li><a href="{{loc_url(route('tag-26.3.6'))}}">{{__('tags.electroEngines')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-26.4'))}}">{{__('tags.handlingWinch')}}</a></li>
						<li><a href="{{loc_url(route('tag-26.5'))}}">{{__('tags.deadAnchor')}}</a></li>
						<li><a href="{{loc_url(route('tag-26.6'))}}">{{__('tags.crownBlock')}}</a></li>
						<li><a href="{{loc_url(route('tag-26.7'))}}">{{__('tags.travelBlock')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-27'))}}"><img src="{{asset('icons/tags/27.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-27" href="{{loc_url(route('tag-27'))}}">{{__('tags.pipeHandling')}}</a> (<span class="orange">{{array_key_exists(27, $posts_amount) ? $posts_amount[27] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-27.1'))}}">{{__('tags.slip')}}</a></li>
						<li><a href="{{loc_url(route('tag-27.2'))}}">{{__('tags.heavingPlug')}}</a></li>
						<li><a href="{{loc_url(route('tag-27.3'))}}">{{__('tags.manualClamp')}}</a></li>
						<li><a href="{{loc_url(route('tag-27.4'))}}">{{__('tags.spider')}}</a></li>
						<li><a href="{{loc_url(route('tag-27.5'))}}">{{__('tags.pipeClamp')}}</a></li>
						<li><a href="{{loc_url(route('tag-27.6'))}}">{{__('tags.casingGrip')}}</a></li>
						<li><a href="{{loc_url(route('tag-27.7'))}}">{{__('tags.elevator')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-27.7.1'))}}">{{__('tags.elevatorS')}}</a></li>
								<li><a href="{{loc_url(route('tag-27.7.2'))}}">{{__('tags.elevatorI')}}</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-28'))}}"><img src="{{asset('icons/tags/28.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-28" href="{{loc_url(route('tag-28'))}}">{{__('tags.hseEq')}}</a> (<span class="orange">{{array_key_exists(28, $posts_amount) ? $posts_amount[28] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-28.1'))}}">{{__('tags.fireHazard')}}</a></li>
						<li><a href="{{loc_url(route('tag-28.2'))}}">{{__('tags.signalization')}}</a></li>
						<li><a href="{{loc_url(route('tag-28.3'))}}">{{__('tags.lifeSupport')}}</a></li>
						<li><a href="{{loc_url(route('tag-28.4'))}}">{{__('tags.light')}}</a></li>
						<li><a href="{{loc_url(route('tag-28.5'))}}">{{__('tags.ppo')}}</a></li>
						<li><a href="{{loc_url(route('tag-28.6'))}}">{{__('tags.misc')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-29'))}}"><img src="{{asset('icons/tags/29.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-29" href="{{loc_url(route('tag-29'))}}">{{__('tags.tong')}}</a> (<span class="orange">{{array_key_exists(29, $posts_amount) ? $posts_amount[29] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-29.1'))}}">{{__('tags.component')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.2'))}}">{{__('tags.tongHy')}}</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-29.2.1'))}}">{{__('tags.tongHyControll')}}</a></li>
							</ul>
						</li>
						<li><a href="{{loc_url(route('tag-29.3'))}}">{{__('tags.tongTubing')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.4'))}}">{{__('tags.tongCasing')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.5'))}}">{{__('tags.tongManual')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.6'))}}">{{__('tags.tongF')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.7'))}}">{{__('tags.tongP')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.8'))}}">{{__('tags.tongC')}}</a></li>
						<li><a href="{{loc_url(route('tag-29.9'))}}">{{__('tags.tongHi')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-30'))}}"><img src="{{asset('icons/tags/30.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-30" href="{{loc_url(route('tag-30'))}}">{{__('tags.chemics')}}</a> (<span class="orange">{{array_key_exists(30, $posts_amount) ? $posts_amount[30] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-30.1'))}}">{{__('tags.sequesteringAgentFiltrationControl')}}</a></li>
						<li><a href="{{loc_url(route('tag-30.2'))}}">{{__('tags.mudHeaver')}}</a></li>
						<li><a href="{{loc_url(route('tag-30.3'))}}">{{__('tags.LCM')}}</a></li>
						<li><a href="{{loc_url(route('tag-30.4'))}}">{{__('tags.bentoniteAlternate')}}</a></li>
						<li><a href="{{loc_url(route('tag-30.5'))}}">{{__('tags.nonOrganic')}}</a></li>
						<li><a href="{{loc_url(route('tag-30.6'))}}">{{__('tags.lubticants')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-31'))}}"><img src="{{asset('icons/tags/31.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-31" href="{{loc_url(route('tag-31'))}}">{{__('tags.chemLab')}}</a> (<span class="orange">{{array_key_exists(31, $posts_amount) ? $posts_amount[31] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-31.1'))}}">{{__('tags.densityEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-31.2'))}}">{{__('tags.asgEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-31.3'))}}">{{__('tags.viscosityEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-31.4'))}}">{{__('tags.sssEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-31.5'))}}">{{__('tags.pHEq')}}</a></li>
						<li><a href="{{loc_url(route('tag-31.6'))}}">{{__('tags.waterLossEq')}}</a></li>
					</ul>
				</div>
			</div>
			<div class="category-col">
				<div class="category-item">
					<div class="category-img"><a href="{{loc_url(route('tag-32'))}}"><img src="{{asset('icons/tags/32.png')}}" alt=""></a></div>
					<div class="category-name"><a id="tag-32" href="{{loc_url(route('tag-32'))}}">{{__('tags.jar')}}</a> (<span class="orange">{{array_key_exists(32, $posts_amount) ? $posts_amount[32] : '0'}}</span>)</div>
					<ul class="category-list">
						<li><a href="{{loc_url(route('tag-32.1'))}}">{{__('tags.hyrdoMeck')}}</a></li>
						<li><a href="{{loc_url(route('tag-32.2'))}}">{{__('tags.hydraulic')}}</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="se-tags-flag" class="category-serv">
			<h2>{{__('ui.service')}}</h2>
			<div class="category-serv-block">
				<div class="category-serv-col">
					<ul class="category-serv-list">
						<li><a href="{{loc_url(route('tag-50'))}}">{{__('tags.otherService')}}</a> (<span class="orange">{{array_key_exists(50, $posts_amount) ? $posts_amount[50] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-51'))}}">{{__('tags.multipleService')}}</a> (<span class="orange">{{array_key_exists(51, $posts_amount) ? $posts_amount[51] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-52'))}}">{{__('tags.emergencySe')}}</a> (<span class="orange">{{array_key_exists(52, $posts_amount) ? $posts_amount[52] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-53'))}}">{{__('tags.controll')}}</a> (<span class="orange">{{array_key_exists(53, $posts_amount) ? $posts_amount[53] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-75'))}}">{{__('tags.drillingCntr')}}</a> (<span class="orange">{{array_key_exists(75, $posts_amount) ? $posts_amount[75] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-54'))}}">{{__('tags.airWaste')}}</a> (<span class="orange">{{array_key_exists(54, $posts_amount) ? $posts_amount[54] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-55'))}}">{{__('tags.loggingSe')}}</a> (<span class="orange">{{array_key_exists(55, $posts_amount) ? $posts_amount[55] : '0'}}</span>)
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-55.1'))}}">{{__('tags.coringSe')}}</a></li>
								<li><a href="{{loc_url(route('tag-55.2'))}}">{{__('tags.stdWellLog')}}</a></li>
							</ul></li>
						<li><a href="{{loc_url(route('tag-56'))}}">{{__('tags.ndt')}}</a> (<span class="orange">{{array_key_exists(56, $posts_amount) ? $posts_amount[56] : '0'}}</span>)</li>
					</ul>
				</div>
				<div class="category-serv-col">
					<ul class="category-serv-list">
						<li><a href="{{loc_url(route('tag-57'))}}">{{__('tags.bitSe')}}</a> (<span class="orange">{{array_key_exists(57, $posts_amount) ? $posts_amount[57] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-58'))}}">{{__('tags.dhmSe')}}</a> (<span class="orange">{{array_key_exists(58, $posts_amount) ? $posts_amount[58] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-59'))}}">{{__('tags.grounding')}}</a> (<span class="orange">{{array_key_exists(59, $posts_amount) ? $posts_amount[59] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-61'))}}">{{__('tags.directionalDrilling')}}</a> (<span class="orange">{{array_key_exists(61, $posts_amount) ? $posts_amount[61] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-62'))}}">{{__('tags.casingSe')}}</a> (<span class="orange">{{array_key_exists(62, $posts_amount) ? $posts_amount[62] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-63'))}}">{{__('tags.guard')}}</a> (<span class="orange">{{array_key_exists(63, $posts_amount) ? $posts_amount[63] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-64'))}}">{{__('tags.bopSe')}}</a> (<span class="orange">{{array_key_exists(64, $posts_amount) ? $posts_amount[64] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-65'))}}">{{__('tags.training')}}</a> (<span class="orange">{{array_key_exists(65, $posts_amount) ? $posts_amount[65] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-66'))}}">{{__('tags.pipeShipment')}}</a> (<span class="orange">{{array_key_exists(66, $posts_amount) ? $posts_amount[66] : '0'}}</span>)</li>
					</ul>
				</div>
				<div class="category-serv-col">
					<ul class="category-serv-list">
						<li><a href="{{loc_url(route('tag-67'))}}">{{__('tags.sellControllFuel')}}</a> (<span class="orange">{{array_key_exists(67, $posts_amount) ? $posts_amount[67] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-68'))}}">{{__('tags.vihacle')}}</a> (<span class="orange">{{array_key_exists(68, $posts_amount) ? $posts_amount[68] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-69'))}}">{{__('tags.builders')}}</a> (<span class="orange">{{array_key_exists(69, $posts_amount) ? $posts_amount[69] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-70'))}}">{{__('tags.loggingSt')}}</a> (<span class="orange">{{array_key_exists(70, $posts_amount) ? $posts_amount[70] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-71'))}}">{{__('tags.transport')}}</a> (<span class="orange">{{array_key_exists(71, $posts_amount) ? $posts_amount[71] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-72'))}}">{{__('tags.recyclingSe')}} (<span class="orange">{{array_key_exists(72, $posts_amount) ? $posts_amount[72] : '0'}}</span>)</a>
							<ul class="category-sublist">
								<li><a href="{{loc_url(route('tag-72.1'))}}">{{__('tags.recyclingDrill')}}</a></li>
								<li><a href="{{loc_url(route('tag-72.2'))}}">{{__('tags.recyclingDomestic')}}</a></li>
							</ul></li>
						<li><a href="{{loc_url(route('tag-73'))}}">{{__('tags.lab')}}</a> (<span class="orange">{{array_key_exists(73, $posts_amount) ? $posts_amount[73] : '0'}}</span>)</li>
						<li><a href="{{loc_url(route('tag-74'))}}">{{__('tags.cementingSe')}}</a> (<span class="orange">{{array_key_exists(74, $posts_amount) ? $posts_amount[74] : '0'}}</span>)</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection