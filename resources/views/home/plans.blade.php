@extends('layouts.page')

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">{{__('ui.footerSubscription')}}</span></span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='plans'/>

		<div class="content">
			<h1>{{__('ui.footerSubscription')}}</h1>
			<div class="content-top-text">{{__('ui.plansFreeAccessTitle')}}</div>
			<div class="sub">
				<div class="sub-side">
					<div class="sub-info">
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansBrowse')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansSearch')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansFilter')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansFav')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansContacts')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansCreate1')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansMailer')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansTranslate')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansCreate2')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.tenders')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansPostImport')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-info-text">{{__('ui.plansPostTracking')}}</div>
						</div>
					</div>
				</div>
				<div class="sub-col">
					<div class="sub-top">
						<div class="sub-name">
							<b>Start</b>
							{{__('ui.account')}}
						</div>
						<div class="sub-price">{{__('ui.free')}}</div>
						<div class="sub-text">{{__('ui.plansStartAccHelp')}}</div>
					</div>
					<div class="sub-info">
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansBrowse')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansSearch')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansFilter')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansFav')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansContacts')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansCreate1')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansMailer')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansTranslate')}} </div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansCreate2')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.tenders')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansPostImport')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansPostTracking')}}</div>
						</div>
					</div>
					<a href="" class="sub-mob">{{__('ui.details')}}</a>
					<a href="" class="sub-button">{{__('ui.plansChoose')}}</a>
				</div>
				<div class="sub-col">
					<div class="sub-top">
						<div class="sub-name">
							<b>Standart</b>
							{{__('ui.account')}}
						</div>
						<div class="sub-price">??? ₴ / {{__('ui.mon')}}</div>
						<div class="sub-text">{{__('ui.plansStandartAccHelp')}}</div>
					</div>
					<div class="sub-info">
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansBrowse')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansSearch')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansFilter')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansFav')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansContacts')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansCreate1')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansMailer')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansTranslate')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansCreate2')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.tenders')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansPostImport')}}</div>
						</div>
						<div class="sub-info-item">
							<div class="sub-no"></div>
							<div class="sub-info-text">{{__('ui.plansPostTracking')}}</div>
						</div>
					</div>
					<a href="" class="sub-mob">{{__('ui.details')}}</a>
					<a href="" class="sub-button">{{__('ui.plansChoose')}}</a>
				</div>
				<div class="sub-col"> <!--sub-active-->
					<div class="sub-top">
						<div class="sub-name">
							<b>Pro</b>
							{{__('ui.account')}}
						</div>
						<div class="sub-price">??? ₴ / {{__('ui.mon')}}</div>
						<div class="sub-text">{{__('ui.plansProAccHelp')}}</div>
					</div>
					<div class="sub-info">
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansBrowse')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansSearch')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansFilter')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansFav')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansContacts')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansCreate1')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansMailer')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansTranslate')}} </div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansCreate2')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.tenders')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansPostImport')}}</div>
						</div>
						<div class="sub-info-item">
							<img src="{{asset('icons/sub-check.svg')}}" alt="">
							<div class="sub-info-text">{{__('ui.plansPostTracking')}}</div>
						</div>
					</div>
					<a href="" class="sub-mob">{{__('ui.details')}}</a>
					<a href="" class="sub-button">{{__('ui.plansChoose')}}</a>
				</div>
			</div>
		</div>
	</div>
@endsection

