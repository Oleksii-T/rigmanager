@extends('layouts.page')

@section('meta')
	<title>{{__('meta.title.info.faq')}}</title>
    <meta name="description" content="{{__('meta.description.info.faq')}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<span itemprop="name">FAQ</span>
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
					<a href="" id="our-purpose" class="faq-top">
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
						<p>{{__('faq.aForWhat1')}}</p>
						<ol>
							<li>{{__('faq.aForWhatCM1')}}</li>
							<li>{{__('faq.aForWhatCM2')}}</li>
							<li>{{__('faq.aForWhatCM3')}}</li>
						</ol>
						<p>{{__('faq.aForWhat2')}}</p>
						<ol>
							<li>{{__('faq.aForWhatSD1')}}</li>
							<li>{{__('faq.aForWhatSD2')}}</li>
							<li>{{__('faq.aForWhatSD3')}}</li>
							<li>{{__('faq.aForWhatSD4')}}</li>
							<li>{{__('faq.aForWhatSD5')}}</li>
							<li>{{__('faq.aForWhatSD6')}}</li>
						</ol>
						<p>{{__('faq.aForWhat3')}}</p>
						<ol>
							<li>{{__('faq.aForWhatSaD1')}}</li>
							<li>{{__('faq.aForWhatSaD2')}}</li>
							<li>{{__('faq.aForWhatSaD3')}}</li>
							<li>{{__('faq.aForWhatSaD4')}}</li>
						</ol>
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
						<p></p>
						<ol>
							<li>{{__('faq.aWhyWe1')}}</li>
							<li>{{__('faq.aWhyWe2')}}</li>
							<li>{{__('faq.aWhyWe3')}}</li>
							<li>{{__('faq.aWhyWe4')}}</li>
							<li>{{__('faq.aWhyWe5')}}</li>
							<li>{{__('faq.aWhyWe6')}}</li>
							<li>{{__('faq.aWhyWe7')}}</li>
							<li>{{__('faq.aWhyWe8')}}</li>
							<li>{{__('faq.aWhyWe9')}}</li>
							<li>{{__('faq.aWhyWe10')}}</li>
							<li>{{__('faq.aWhyWe11')}}</li>
						</ol>
					</div>
				</div>
				<div class="faq-item">
					<a href="" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qServices')}}
					</a>
					<div class="faq-hidden">
						<p></p>
						<ol>
							<li>{{__('faq.aServices1')}}</li>
							<li>{{__('faq.aServices2')}}</li>
							<li>{{__('faq.aServices3')}}</li>
							<li>{{__('faq.aServices4')}}</li>
							<li>{{__('faq.aServices5')}}</li>
							<li>{{__('faq.aServices6')}}</li>
							<li>{{__('faq.aServices7')}}</li>
							<li>{{__('faq.aServices8')}}</li>
							<li>{{__('faq.aServices9')}}</li>
							<li>{{__('faq.aServices10')}}</li>
							<li>{{__('faq.aServices11')}}</li>
							<li>{{__('faq.aServices12')}}</li>
							<li>{{__('faq.aServices13')}}</li>
							<li>{{__('faq.aServices14')}}</li>
							<li>{{__('faq.aServices15')}}</li>
							<li>{{__('faq.aServices16')}}</li>
							<li>{{__('faq.aServices17')}}</li>
							<li>{{__('faq.aServices18')}}</li>
							<li>{{__('faq.aServices19')}}</li>
							<li>{{__('faq.aServices20')}}</li>
						</ol>
					</div>
				</div>
				<div class="faq-item">
					<a href="" id="cost" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qCost')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aCost1')}} <a href="{{loc_url(route('plans'))}}">{{__('ui.here')}}</a>. 
							{{__('faq.aCost2')}}</p>
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
						<p>{{__('faq.aBuy1')}} <a class="link" href="{{loc_url(route('catalog'))}}">{{__('ui.catalog')}}</a> {{__('faq.aBuy2')}}</p>
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
						<p>{{__('faq.aSell1')}} <a class="link" href="{{loc_url(route('posts.create'))}}">{{__('faq.aSellLink')}}</a>, {{__('faq.aSell2')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" id="WhatIsMailer" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qWhatIsMailer')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aWhatIsMailer')}}</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" id="HowToCreateMailer" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qHowToCreateMailer')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aHowToCreateMailer1')}} <a class="link" href="{{loc_url(route('search', ['type'=>'equipment-sell']))}}">{{__('ui.introSellEq')}}</a> {{__('ui.or')}} <a class="link" href="{{loc_url(route('tag-2'))}}">{{__('tags.dp')}}</a>) {{__('faq.aHowToCreateMailer2')}} <a href="{{loc_url(route('mailer.index'))}}" class="link">{{__('ui.mailer')}}</a></p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" id="WhatIsSocialAcc" class="faq-top">
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
					<a href="" id="WhatIsAutoTranslator" class="faq-top">
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
					<a href="" id="WhyNotAllImported" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qWhyNotAllImported')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aWhyNotAllImported')}}</p>
						<ol>
							<li>{{__('faq.aWhyNotAllImportedL1')}}</li>
							<li>{{__('faq.aWhyNotAllImportedL2')}}</li>
						</ol>
						<p>{{__('faq.aWhyNotAllImported2')}} <a href="{{loc_url(route('contacts'))}}">{{__('ui.here')}}</a>.</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" id="WhatIsImport" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qImport')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aImport')}}
						<a href="{{loc_url(route('post.import'))}}">{{__('ui.postImport')}}</a>
						<a href="{{loc_url(route('import.rules'))}}">{{__('postImportRules.title')}}</a>
						
						{{__('faq.aImportExtra')}} <a href="{{loc_url(route('contacts'))}}">{{__('ui.here')}}</a>.</p>
					</div>
				</div>
				<div class="faq-item">
					<a href="" id="WhatIsPartner" class="faq-top">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.99 511.99">
							<path d="M253,248.62,18.37,3.29A10.67,10.67,0,1,0,3,18L230.56,256,3,494A10.67,10.67,0,0,0,18.37,508.7L253,263.37A10.7,10.7,0,0,0,253,248.62Z"/>
						</svg>
						{{__('faq.qPartner')}}
					</a>
					<div class="faq-hidden">
						<p>{{__('faq.aPartner')}}</p>
						<ol>
							<li>{{__('faq.aPartnerL1')}}</li>
							<li>{{__('faq.aPartnerL2')}}</li>
							<li>{{__('faq.aPartnerL3')}}</li>
							<li>{{__('faq.aPartnerL4')}}</li>
							<li>{{__('faq.aPartnerL5')}}</li>
							<li>{{__('faq.aPartnerL6')}}</li>
							<li>{{__('faq.aPartnerL7')}}</li>
							<li>{{__('faq.aPartnerL8')}}</li>
						</ol>
						<p>{{__('faq.aPartner2')}} <a href="{{loc_url(route('contacts'))}}">{{__('ui.here')}}</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
			//open the faq hidden text when lining the exact faq article
			currLoc = $(location).attr('href'); 
			if ( currLoc.includes('our-purpose') ) {
				toggleFaqText( $('#our-purpose') );
			}else if ( currLoc.includes('WhatIsMailer') ) {
				toggleFaqText( $('#WhatIsMailer') );
			} else if ( currLoc.includes('WhatIsSocialAcc') ) {
				toggleFaqText( $('#WhatIsSocialAcc') );
			} else if ( currLoc.includes('WhatIsAutoTranslator') ) {
				toggleFaqText( $('#WhatIsAutoTranslator') );
			} else if ( currLoc.includes('WhatIsImport') ) {
				toggleFaqText( $('#WhatIsImport') );
			} else if ( currLoc.includes('HowToCreateMailer') ) {
				toggleFaqText( $('#HowToCreateMailer') );
			} else if ( currLoc.includes('#WhatIsPartner') ) {
				toggleFaqText( $('#WhatIsPartner') );
			} else if ( currLoc.includes('#WhyNotAllImported') ) {
				toggleFaqText( $('#WhyNotAllImported') );
			} else if ( currLoc.includes('#cost') ) {
				toggleFaqText( $('#cost') );
			}
        });
    </script>
@endsection