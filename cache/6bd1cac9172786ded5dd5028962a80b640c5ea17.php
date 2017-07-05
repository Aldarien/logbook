<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li><a href="."><img src="images/logbook.png" class="menu-logo" />ogbook</a></li>
		<li><a href="add.php?type=future"><span class="glyphicon glyphicon-plus"></span> <?php echo e(translate('Add Future Event')); ?></a></li>
		<li><a href="add.php?type=past"><span class="glyphicon glyphicon-plus"></span> <?php echo e(translate('Add Past Event')); ?></a></li>
		<li role="presentation" class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<?php echo e(translate('View')); ?> <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="."><?php echo e(translate('Today')); ?></a></li>
				<li><a href="year.php?year=<?php echo e(today()->year); ?>"><?php echo e(translate('Year')); ?></a></li>
				<li><a href="month.php?year=<?php echo e(today()->year); ?>&month=<?php echo e(today()->month); ?>"><?php echo e(translate('Month')); ?></a>
			</ul>
		</li>
	</ul>
</nav>