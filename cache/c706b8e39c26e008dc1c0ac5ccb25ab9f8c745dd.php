<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Logbook</title>
	<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<header class="container">
<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</header>

<section class="container">
<?php echo $__env->yieldContent('content'); ?>
</section>

<footer>
<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</footer>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>