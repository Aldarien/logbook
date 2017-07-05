<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="day.php?day=<?php echo e($day->getPreviousDay()); ?>"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<?php echo e($day->getDay()); ?> <?php echo e(ucwords($day->getMonth()->getMonthName())); ?> <?php echo e($day->getMonth()->getYear()->getYear()); ?>

		<?php if($day->getNextDay() != null): ?>
		<a href="day.php?day=<?php echo e($day->getNextDay()); ?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
		<?php endif; ?>
	</div>
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo e(translate('Unfinished Events')); ?></div>
			<div class="panel-body">
				<?php echo $__env->make('show_future_events', ['events' => $day->getFutureEvents()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo e(translate("Today's Finished Events")); ?></div>
			<div class="panel-body">
				<?php echo $__env->make('show_past_events', ['events' => $day->getPastEvents()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>