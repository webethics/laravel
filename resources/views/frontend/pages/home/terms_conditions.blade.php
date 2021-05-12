@extends('frontend.layouts.landing')
@section('pageTitle','Terms & Conditions')
@section('content')
@section('extraJsCss')

@stop

<main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
			<div class="col-md-6 col-6 innerbanner_img wow fadeInUp">
				<?php 
					if(Session::get('language') == 'en'){
						$title = $term_content->title;
						$content = $term_content->content;
					}elseif(Session::get('language') == 'ar'){
						$title = $term_content->arabic_title;
						$content = $term_content->arabic_content;
					}else{
						$title = $term_content->title;
						$content = $term_content->content;
					}
				
				?>
					<h2>{{ $title }}</h2>
				</div>
				<div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
					<img src="{{asset('frontend/images/Group 279.png')}}" />
				</div>
		   </div>
		</div>
	 </section>

	 <section class="aboutsection innerpages_sec innerpage_content wow fadeInUp" data-wow-duration="1500ms">
		<div class="container"><div class="row">
			
			<div class="tms">
			{!! $content !!}
		   <!--<p>Welcome to Mawjuud, operated by Mawjuud, Inc. Mawjuud, Inc. is a part of Mawjuud, Inc By using Mawjuud’s Web sites (defined to include all properties (mobile, Web or otherwise) owned and operated by Mawjuud), related data, and/or related services (collectively, “Services”), you agree to be bound by the following terms of use, as updated from time to time (“Terms of Use”).</p>
		   <h3>General</h3>
		   <p>Any dispute or claim arising out of or in connection with this website shall be governed and construed in accordance with the laws of UAE. United Arab of Emirates is our country of domicile. Minors under the age of 18 shall are prohibited to register as a User of this website and are not allowed to transact or use the website. If you make a payment for our products or services on our website, the details you are asked to submit will be provided directly to our payment provider via a secured connection. The cardholder must retain a copy of transaction records and Merchant policies and rules</p>
			<h3>Permissible Use</h3>
		   <p>Unless you are a real estate or lending professional acting in your professional capacity, you agree to use the Services for your personal use, and your commercial use is limited to transactions done on your own behalf. The commercial use of real estate and lending professionals is limited to providing information to consumers via the Services or, where authorized, taking actions on behalf of a consumer client (e.g., post a home for sale). Without limitation, lending professionals and institutions are prohibited from using information provided by Mawjuud through the Services in making any loan-related decisions. The Services may be used only for transactions in residential real estate and may not be used for transactions in commercial real estate, which includes, without limitation, commercially zoned properties, timeshares, and vacation rentals. Subject to the restrictions set forth in the following paragraphs, you may copy information from the Services only as necessary for your personal use to view, save, print, fax and/or e-mail such information. You agree otherwise not to reproduce, modify, distribute, display or otherwise provide access to, create derivative works from, decompile, disassemble or reverse engineer any portion of the Services. In addition, you agree not to provide/post/authorize a link to any of the Services (including but not limited to your agent profile page) from a third party website that is not a real estate related website owned or operated by a real estate or lending professional or institution. Notwithstanding the foregoing, the aggregate level data provided on the Mawjuud Local-Info Pages, and available at http://www.Mawjuud.com, (the “Aggregate Data”) may be used for non-personal uses, e.g., real estate market analysis. You may display and distribute derivative works of the Aggregate Data (e.g., within a graph), so long as Mawjuud is cited as a source.</p>
			<h3>Restrictions and Additional Terms.</h3>
		   <p>You agree not to remove or modify any copyright or other intellectual property notices that appear in the Services. You will not use the Services for resale, service bureau, time-sharing or other similar purposes. Further: Acceptable Use. You agree not to use the Services in any way that is unlawful, or harms Mawjuud, its service providers, suppliers or any other user. You agree not to use the Services in any way that breaches the Mawjuud Rentals Terms or any other policy or notice on the Services. You agree not to distribute or post spam, chain letters, pyramid schemes, or similar communications through the Services. You agree not to impersonate another person or misrepresent your affiliation with another person or entity. Except as expressly stated herein, these Terms of Use do not provide you a license to use, reproduce, distribute, display or provide access to any portion of the Services on third-party Web sites or otherwise. Except as expressly stated herein and without limitation, you agree that you will not, nor will you permit or encourage any third party to, reproduce, publicly display, or otherwise make accessible on or through any other Web site, application, or service any reviews, ratings, and/or profile information about real estate, lending, or other professionals, underlying images of or information about real estate listings, or other data or content available through the Services. Automated Queries. Automated queries (including screen and database scraping, spiders, robots, crawlers and any other automated activity with the purpose of obtaining information from the Services) are strictly prohibited on the Services, unless you have received express written permission from Mawjuud. As a limited exception, publicly available search engines and similar Internet navigation tools (“Search Engines”) may query the Services and provide an index with links to the Services’ Web pages, only to the extent such unlicensed “fair use” is allowed by applicable copyright law. Search Engines are not permitted to query or search information protected by a security verification system (“captcha”) which limits access to human users. Windows Live Virtual Earth. Windows Live Virtual Earth imagery is supplied by Microsoft Corporation, and use is subject to the Microsoft MapPoint Terms of Use, located at http://www.microsoft.com/maps/assets/docs/terms.aspx. Google Maps. Some of the Services implement the Google Maps web mapping service. Your use of Google Maps is subject to Google’s terms of use, located at http://www.google.com/intl/en_us/help/terms_maps.html Calls. If you, as a consumer, choose to contact a real estate agent or a Lender (as defined below) through the Services by filling out a contact or other request form on the Services, you authorize Mawjuud to provide your name and contact information and other identifying information you provide to the applicable real estate agent or Lender. You acknowledge that, by submitting your contact request or other request form on the Services or by electing to request pre-approval, you may receive telemarketing calls from or on behalf of the real estate agent or Lender at the telephone number(s) you provide. The Services may provide phone numbers that can connect you with Mawjuud, its service providers, or other third parties, such as real estate agents and Lenders. Some of the numbers listed may be routed through a third party service (“Calling Service”). Calls through the Calling Service may be recorded or monitored for quality assurance and customer service purposes. In the event that you make a call to Mawjuud or through a Calling Service, you consent to such recording and monitoring. Mawjuud will treat recorded calls in accordance with its Privacy Policy.</p>-->
		  </div> </div>
		 </div>
			
			</section>

  </main>
@endsection