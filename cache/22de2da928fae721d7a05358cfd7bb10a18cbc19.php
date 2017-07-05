<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo e($year->getYear()); ?></div>
	<div class="panel-body">
<?php $__currentLoopData = $year->getMonths(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 	<?php if($i > 0 and $i % 3 == 0): ?>
 		</div>
		<div class="row">
	<?php elseif($i == 0): ?>
		<div class="row">
	<?php endif; ?>
			<div class="col-md-4">
				<?php echo $__env->make('show_month', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>