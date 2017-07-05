<div class="panel panel-default">
	<div class="panel-heading"><?php echo e(ucwords($month->getMonthName())); ?></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('monday')), 0, 1))); ?></div>
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('tuesday')), 0, 1))); ?></div>
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('wendesday')), 0, 1))); ?></div>
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('thursday')), 0, 1))); ?></div>
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('friday')), 0, 1))); ?></div>
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('saturday')), 0, 1))); ?></div>
			<div class="col-md-1 bold"><?php echo e(ucwords(substr(strftime('%a', strtotime('sunday')), 0, 1))); ?></div>
		</div>
	<?php $__currentLoopData = $month->getWeeks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="row">
		<?php $__currentLoopData = $week->getDays(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($day): ?>
			<div class="col-md-1
			<?php if($day->getMonth()->getMonth() != $month->getMonth()): ?>
				faded 
			<?php endif; ?>"><a href="day.php?day=<?php echo e($day->getTimestamp()); ?>"><?php echo e($day->getDay()); ?></a></div>
			<?php else: ?>
				<div class="col-md-1"></div>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>