<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	<!-- Title -->
	<title>Laravel Base Start</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Responsive Photography HTML5 Website Template">
	<meta name="keywords" content="HTML5, CSS3, Bootsrtrap, Responsive, Photography, Portfolio, Template, Theme, Website, Themetorium" />
	<meta name="author" content="themetorium.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon (http://www.favicon-generator.org/) -->
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

	<!-- Google fonts (https://www.google.com/fonts) -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> <!-- Global font -->

	<!-- Bootstrap CSS (http://getbootstrap.com) -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}"> <!-- bootstrap CSS (http://getbootstrap.com) -->

	<!-- Libs and Plugins CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/animsition/css/animsition.min.css') }}"> <!-- Animsition CSS (http://git.blivesta.com/animsition/) -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/fontawesome-all.min.css') }}"> <!-- Font Icons CSS (https://fontawesome.com) Free version! -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/lightgallery/css/lightgallery.min.css') }}"> <!-- lightGallery CSS (http://sachinchoolur.github.io/lightGallery) -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.min.css') }}"> <!-- Owl Carousel CSS (https://owlcarousel2.github.io/OwlCarousel2/) -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.theme.default.min.css') }}"> <!-- Owl Carousel CSS (https://owlcarousel2.github.io/OwlCarousel2/) -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/ytplayer/css/jquery.mb.YTPlayer.min.css') }}"> <!-- YTPlayer CSS (more info: https://github.com/pupunzi/jquery.mb.YTPlayer) -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/animate.min.css') }}"> <!-- Animate libs CSS (http://daneden.me/animate) -->

	<!-- Template master CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/helper.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

</head>


<body id="body" class="animsition tt-boxed">
	@include('layouts.frontheader')
	<!-- *************************************
		*********** Begin body content *********** 
        ************************************** -->
	<div id="body-content">
		@yield('content')
	</div>
	<!-- End body content -->

	<!-- Core JS -->
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script> <!-- jquery JS (https://jquery.com) -->
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- bootstrap JS (http://getbootstrap.com) -->

	<!-- Libs and Plugins JS -->
	<script src="{{ asset('assets/vendor/animsition/js/animsition.min.js') }}"></script> <!-- Animsition JS (http://git.blivesta.com/animsition/) -->
	<script src="{{ asset('assets/vendor/jquery.easing.min.js') }}"></script> <!-- Easing JS (http://gsgd.co.uk/sandbox/jquery/easing/) -->
	<script src="{{ asset('assets/vendor/isotope.pkgd.min.js') }}"></script> <!-- Isotope JS (http://isotope.metafizzy.co) -->
	<script src="{{ asset('assets/vendor/imagesloaded.pkgd.min.js') }}"></script> <!-- ImagesLoaded JS (https://github.com/desandro/imagesloaded) -->
	<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script> <!-- Owl Carousel JS (https://owlcarousel2.github.io/OwlCarousel2/) -->
	<script src="{{ asset('assets/vendor/jquery.mousewheel.min.js') }}"></script> <!-- A jQuery plugin that adds cross browser mouse wheel support (https://github.com/jquery/jquery-mousewheel) -->
	<script src="{{ asset('assets/vendor/ytplayer/js/jquery.mb.YTPlayer.min.js') }}"></script> <!-- YTPlayer JS (more info: https://github.com/pupunzi/jquery.mb.YTPlayer) -->

	<script src="{{ asset('assets/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script> <!-- lightGallery Plugins JS (http://sachinchoolur.github.io/lightGallery) -->

	<!-- Theme master JS -->
	<script src="{{ asset('assets/js/theme.js') }}"></script>

	<!-- Custom Js -->
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>