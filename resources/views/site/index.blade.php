@extends('layouts.front')
@section('content')
<section id="page-header" class="ph-lg ph-image-on">

	<div class="page-header-image parallax-bg-3 bg-image" style="background-image: url(&quot;{{ $filterBannerImages[0]["image"] }}&quot;);">

		<div class="cover bg-transparent-5-dark"></div>

	</div>
	<!-- End page header image -->

	<!-- Begin page header inner -->
	<div class="page-header-inner tt-wrap">

		<div class="page-header-caption parallax-4 fade-out-scroll-4" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
			<h1 class="page-header-title">
				<span class="title-text-30">The image was posted by</span>
				{{ $filterBannerImages[0]["username"] }}
			</h1>
			<div class="page-header-category">
				<a href="#" class="title-tagname">{{ '@'.$filterBannerImages[0]["tagname"] }}</a>
			</div>

			<!-- Use data attributes to set text maximum characters or words (example: data-max-characters="120" or data-max-words="40") -->
			<div class="page-header-description" data-max-words="40">
				{{ $filterBannerImages[0]["description"] }}
			</div>

			<!-- Begin modal trigger -->
			<a href="#" class="ph-more-info-trigger" data-toggle="modal" data-target="#modal-67230981"><span class="ph-more-info-trigger-icon"></span>
				Join to see more from {{ $filterBannerImages[0]["username"] }}
			</a>

		</div>

	</div>

</section>
<section id="gallery-single-section">
	<div class="isotope-wrap"> <!-- add/remove class "tt-wrap" to enable/disable element boxed layout (class "tt-boxed" is required in <body> tag! ) -->

		<!-- Begin isotope
			===================
			* Use class "gutter-1", "gutter-2" or "gutter-3" to add more space between items.
			* Use class "col-1", "col-2", "col-3", "col-4", "col-5" or "col-6" for columns.
			-->
		<div class="isotope col-4 gutter-3">

			<!-- Begin isotope top content -->
			<div class="isotope-top-content gallery-share-on">

				<!-- Begin gallery share button 
					================================
					* Use class "gs-right" to align gallery share button.
					-->
				<!-- <a href="#0" class="gallery-share gs-right" data-toggle="modal" data-target="#modal-64253091" title="Share this gallery"><i class="fas fa-share-alt"></i></a> -->
				<!-- End gallery share button -->

				<!-- Begin modal 
					=================
					* Use class "modal-center" to enable modal center position (use for short content only!).
					* Use class "modal-left" to enable left sidebar modal.
					* Use class "modal-right" to enable right sidebar modal.
					-->

				<!-- End modal -->

			</div>
			<!-- End isotope top content -->

			<!-- Begin isotope items wrap 
				==============================
				* Use classes "gsi-color", "gsi-zoom" or "gsi-simple" to change gallery single item cover variations.
				-->
			<div class="tt-wrap gallery-full-width">
				<div class="row" id="post-container" data-count="{{ $count }}">

					@include('site._post')

				</div>
			</div>

			<!-- End isotope items wrap -->


			<!-- Begin isotope pagination 
				============================== -->
			<div class="isotope-pagination">
				<div class="iso-load-more">
					<a class="btn btn-dark-bordered btn-lg" href="">View More <i class="fas fa-refresh"></i></a>
				</div>
			</div>
			<!-- End isotope pagination -->

		</div>
		<!-- End isotope -->

	</div> <!-- /.isotope-wrap -->
</section>
<!-- End gallery single section -->



<section id="footer" class="footer-dark no-margin-top">
	<div class="footer-inner">
		<!-- <div class="footer-container tt-wrap">
				<div class="row">
					<div class="col-md-3">
						<div id="footer-logo">
							<a href="{{ url('/') }}" class="logo-dark"><img src="{{ asset('assets/img/logo-dark.png') }}" alt="logo"></a>
							<a href="{{ url('/') }}" class="logo-light"><img src="{{ asset('assets/img/logo-light.png') }}" alt="logo"></a>
							<a href="{{ url('/') }}" class="logo-dark-m"><img src="{{ asset('assets/img/logo-dark-m.png') }}" alt="logo"></a>
							<a href="{{ url('/') }}" class="logo-light-m"><img src="{{ asset('assets/img/logo-light-m.png') }}" alt="logo"></a>
						</div>
					</div>

					<div class="col-md-5">
						<div class="footer-text">
							<h4>- Creative Photo Studio</h4>
							Sed non auctor magna. Nunc eu ultrices orci. Donec commodo ligula in massa ultricies volutpat. Fusce vel cursus lectus. Cras commodo odio mi, eu cursus nibh iaculis ut.
						</div>
					</div>

					<div class="col-md-4">
						<div class="social-buttons">
							<ul>
								<li><a href="https://www.facebook.com/themetorium" class="btn btn-social-min btn-default btn-rounded-full" title="Follow me on Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/Themetorium" class="btn btn-social-min btn-default btn-rounded-full" title="Follow me on Twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li><a href="https://plus.google.com/+SiiliOnu" class="btn btn-social-min btn-default btn-rounded-full" title="Follow me on Google+" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
								<li><a href="https://www.pinterest.com/themetorium" class="btn btn-social-min btn-default btn-rounded-full" title="Follow me on Pinterest" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
								<li><a href="https://dribbble.com/Themetorium" class="btn btn-social-min btn-default btn-rounded-full" title="Follow me on Dribbble" target="_blank"><i class="fab fa-dribbble"></i></a></li>
								<li><a href="contact.html" class="btn btn-social-min btn-default btn-rounded-full" title="Drop me a line" target="_blank"><i class="fas fa-envelope"></i></a></li>
							</ul>
						</div>
						<form id="footer-subscribe-form" class="form-btn-inside">
							<div class="form-group">
								<input type="email" class="form-control no-bg" id="footer-subscribe" name="subscribe" placeholder="Subscribe. Enter your email address..." required="">
								<button type="submit"><i class="fas fa-paper-plane"></i></button>
							</div>
						</form>
					</div>

				</div>
			</div> -->

		<div class="footer-bottom">
			<div class="footer-container tt-wrap">
				<div class="row">
					<div class="col-md-6 col-md-push-6">
						<ul class="footer-menu">
							<li><a href="{{ url('/') }}">Home</a></li>
							<!-- 								<li><a href="about-me.html">About</a></li> -->
							<!-- 								<li><a href="albums-grid-fluid-2.html">Portfolio</a></li> -->
							<!-- 								<li><a href="blog-list-grid.html">Blog</a></li> -->
							<!-- 								<li><a href="page-faq.html">FAQ</a></li> -->
							<li><a href="{{ url('/contact') }}">Contact</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-md-pull-6">
						<div class="footer-copyright">
							<p>&copy; Laravel Base Start {{ date('Y') }} / All rights reserved</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<a href="#body" class="scrolltotop sm-scroll" title="Scroll to top" style="display: none;"><i class="fas fa-chevron-up"></i></a>

</section>
@endsection