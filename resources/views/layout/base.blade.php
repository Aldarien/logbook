<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Logbook</title>
	<link rel="stylesheet" type="text/css" href="css/app.css" />
	<link rel="icon" type="image/png" href="images/logbook-favicon.png" />
	<script type="text/javascript" src="js/app.js"></script>
	@stack('styles')
</head>
<body>
<header class="container">
@include('layout.header')
</header>

<section class="container">
@yield('content')
</section>

<footer>
@include('layout.footer')
</footer>

@stack('scripts')
</body>
</html>