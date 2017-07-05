<?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row">
	<div class="col-md-12"><?php echo e($event->getDescription()); ?> 
	<?php if($event->getState() == 'ongoing'): ?>
		<a href="finish_event.php?event=<?php echo e($event->getId()); ?>"><span class="glyphicon glyphicon-check"></span></a>
	<?php else: ?>
		<span class="glyphicon glyphicon-thumbs-up"></span>
	<?php endif; ?>
	</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>