@extends('layouts.front')
@section('content')

<section id="page-header" class="ph-lg ph-image-on">
	<div class="page-header-image parallax-bg-3 bg-image" style="background-image: url(&quot;{{ $filterBannerImages[0]["image"] }}&quot;);">
		<div class="cover bg-transparent-5-dark"></div>
	</div>

	<!--		<div class="page-header-caption ph-caption-lg parallax-4 fade-out-scroll-3" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
 			<h1 class="page-header-title">Contact</h1> -->
	<!-- 			<hr class="hr-short"> -->

	<!-- Use data attributes to set text maximum characters or words (example: data-max-characters="120" or data-max-words="40") -->
	<!-- 			<div class="page-header-description" data-max-words="40"> -->
	<!-- 				<p>Fusce imperdiet, arcu non tempor aliquam, justo tortor cursus est, sed facilisis eros purus et felis. Sed eros sapien, iaculis eget gravida euismod, dapibus vitae turpis. Pellentesque men egestas odio mi, vitae egestas massa elementum.</p> -->
	<!-- 			</div> -->
	<!-- 		</div> -->

	<div class="page-header-inner tt-wrap">
		<div class="page-header-caption parallax-4 fade-out-scroll-4" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
			<!-- 				<h1 class="page-header-title">Contact</h1> -->
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

<section id="contact-section">
	<div class="contact-section-inner tt-wrap">
		<div class="split-box">
			<div class="container-fluid">
				<div class="row">
					<div class="row-lg-height full-height-vh">
						<div class="col-lg-6 col-lg-height col-lg-middle no-padding">
							<div class="split-box-content">
								<form id="contact-form-" action="{{ route('submit-contact-form') }}" method="POST">
									{{ csrf_field() }}
									<div class="contact-form-inner text-left">
										<div class="contact-form-info">
											<div class="tt-heading">
												<div class="tt-heading-inner">
													<h1 class="tt-heading-title">Drop us a line</h1>
													<hr class="hr-short">
												</div>
											</div>
											<div class="margin-top-30">
												<p>If you have any questions, suggestions or just a comment, please let us know.</p>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<input type="text" class="form-control" name="name" placeholder="Your Name" required="">
												</div>
												@if($errors->has('name'))
												{{ $errors->first('name') }}
												@endif
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<input type="email" class="form-control" name="email" placeholder="Your Email" required="">
												</div>
												@if($errors->has('email'))
												{{ $errors->first('email') }}
												@endif
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<input type="text" class="form-control" name="subject" placeholder="Subject" required="">
												</div>
												@if($errors->has('subject'))
												{{ $errors->first('subject') }}
												@endif
											</div>
										</div>
										<!-- 											<div class="row"> -->
										<!-- 												<div class="col-lg-12"> -->
										<!-- 													<div class="form-group"> -->
										<!-- 														<select class="form-control" name="option" required=""> -->
										<!-- 															<option value="" disabled="" selected="">Select an option</option> -->
										<!-- 															<option value="Say Hello">Say hello</option> -->
										<!-- 															<option value="New Project">New project</option> -->
										<!-- 															<option value="Feedback">Feedback</option> -->
										<!-- 															<option value="Other">Other</option> -->
										<!-- 														</select> -->
										<!-- 													</div> -->
										<!-- 												</div> -->
										<!-- 											</div> -->
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<textarea class="form-control" name="message" rows="4" placeholder="Your Message" required=""></textarea>
												</div>
												@if($errors->has('message'))
												{{ $errors->first('message') }}
												@endif
											</div>
										</div>
										<div class="small text-gray"><em>* All fields are required!</em></div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<button type="submit" class="btn btn-primary btn-lg margin-top-40">Send Message</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section id="footer" class="footer-dark no-margin-top">
	<div class="footer-inner">
		<div class="footer-bottom">
			<div class="footer-container tt-wrap">
				<div class="row">
					<div class="col-md-6 col-md-push-6">
						<ul class="footer-menu">
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="{{ url('/contact') }}">Contact</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-md-pull-6">
						<div class="footer-copyright">
							<p style="margin-top: 13px;">&copy; Laravel Base Start {{ date('Y') }} / All rights reserved</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<a href="#body" class="scrolltotop sm-scroll" title="Scroll to top" style="display: none;"><i class="fas fa-chevron-up"></i></a>
</section>
@endsection