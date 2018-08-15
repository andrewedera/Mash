<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
<!-- begin:: Page -->
<div id="app" class="m-grid m-grid--hor m-grid--root m-page">
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ url('/assets/img/bg-3.jpg') }});">
		<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
			<div class="m-login__container">
				<div class="m-login__logo">
					<a href="#">
						<img src="{{ url('/assets/img/logo-2.png') }}">
					</a>
				</div>
				    <user-component/>
			</div>
		</div>
	</div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="{{ mix('/js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ mix('/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ mix('/js/login.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
</body>

</html>