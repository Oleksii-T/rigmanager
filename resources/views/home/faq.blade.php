@extends('layouts.page')

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">FAQ</span></span>
		<meta itemprop="position" content="2" />
	</li>
@endsection

@section('content')
	<div class="main-block">
		<x-informations-nav active='faq'/>

		<div class="content">
			<h1>FAQ</h1>
			<div class="content-top-text">{{__('faq.intro')}} <a href="{{loc_url(route('contacts'))}}">{{__('ui.footerContact')}}</a>.</div>
			<div class="faq">
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qPurpose')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aPurpose1')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qForWhat')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aForWhat1')}}
							<ol>
								<li>{{__('faq.aForWhatCM1')}}</li>
								<li>{{__('faq.aForWhatCM2')}}</li>
								<li>{{__('faq.aForWhatCM3')}}</li>
							</ol>
							{{__('faq.aForWhat2')}}
							<ol>
								<li>{{__('faq.aForWhatSD1')}}</li>
								<li>{{__('faq.aForWhatSD2')}}</li>
								<li>{{__('faq.aForWhatSD3')}}</li>
								<li>{{__('faq.aForWhatSD4')}}</li>
								<li>{{__('faq.aForWhatSD5')}}</li>
								<li>{{__('faq.aForWhatSD6')}}</li>
							</ol>
							{{__('faq.aForWhat3')}}
							<ol>
								<li>{{__('faq.aForWhatSaD1')}}</li>
								<li>{{__('faq.aForWhatSaD2')}}</li>
								<li>{{__('faq.aForWhatSaD3')}}</li>
								<li>{{__('faq.aForWhatSaD4')}}</li>
							</ol></p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qWhyWe')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aWhyWe')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qBuy')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aBuy1')}} <a class="link" href="{{ loc_url(route('catalog')) }}">{{__('ui.catalog')}}</a> {{__('faq.aBuy2')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qSell')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aSell1')}} <a class="link" href="{{ loc_url(route('posts.create')) }}">{{__('faq.aSellLink')}}</a>, {{__('faq.aSell2')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qWhatIsMailer')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aWhatIsMailer1')}} <a class="link" href="{{loc_url(route('mailer.index'))}}">{{__('faq.aWhatIsMailerLink')}}</a> {{__('faq.aWhatIsMailer2')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qWhatIsSocialAcc')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aWhatIsSocialAcc')}} <a class="link" href="{{loc_url(route('login.social', ['social'=>'google']))}}">Google</a> / <a class="link" href="{{route('login.social', ['social'=>'facebook'])}}">Facebook</a>.</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qAutoTranslator')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aAutoTranslator')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qImport')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aImport')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qRelease')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aRelease')}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection