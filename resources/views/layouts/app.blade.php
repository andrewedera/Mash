<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
@if (auth()->check())
	<meta name="api-token" content="{{ Auth::user()->api_token }}">
@endif
	<title>botDashboard</title>
	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function () {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!--end::Web font -->
	<link rel="stylesheet" href="{{ mix('/css/vendors.bundle.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/style.bundle.css') }}">
</head>
<!-- begin::Body -->

<body class="modal-open m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div id="app" class="m-grid m-grid--hor m-grid--root m-page">
		<!-- BEGIN: Header -->
		<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
			<div class="m-container m-container--fluid m-container--full-height">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<!-- BEGIN: Brand -->
					<div class="m-stack__item m-brand  m-brand--skin-dark ">
						<div class="m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-stack__item--middle m-brand__logo">
								<a href="../../index.html" class="m-brand__logo-wrapper">
									<img alt="" src="../../assets/demo/default/media/img/logo/logo_default_dark.png" />
								</a>
							</div>
							<div class="m-stack__item m-stack__item--middle m-brand__tools">
								<!-- BEGIN: Left Aside Minimize Toggle -->
								<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Responsive Aside Left Menu Toggler -->
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Responsive Header Menu Toggler -->
								<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Topbar Toggler -->
								<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a>
								<!-- BEGIN: Topbar Toggler -->
							</div>
						</div>
					</div>
					<!-- END: Brand -->
					<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav"></div>
				</div>
			</div>
		</header>
		<!-- END: Header -->
		<!-- begin::Body -->
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			@include('layouts.sidebar')
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<!-- BEGIN: Subheader -->
				<div class="m-subheader">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="m-subheader__title">Welcome, {{ Auth::user()->name }}!</h3>
						</div>
					</div>
				</div>
				<!-- END: Subheader -->
				<div class="m-content">
					<div class="row">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Body -->
		<!-- begin::Footer -->
		<footer class="m-grid__item		m-footer ">
			<div class="m-container m-container--fluid m-container--full-height m-page__container">
				<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
					<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
						<span class="m-footer__copyright">
							2017 &copy; Metronic theme by
							<a href="https://keenthemes.com" class="m-link">Keenthemes</a>
						</span>
					</div>
				</div>
			</div>
		</footer>
		<!-- end::Footer -->
	</div>
	<!-- end:: Page -->
	<!-- begin::Scroll Top -->
	<div id="m_scroll_top" class="m-scroll-top">
		<i class="la la-arrow-up"></i>
	</div>
	<!-- end::Scroll Top -->
	<!--begin::Base Scripts -->
	<script src="{{ mix('/js/vendors.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ mix('/js/scripts.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
	<!--end::Base Scripts -->
</body>

</html>