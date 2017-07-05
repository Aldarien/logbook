<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo e(translate('Add ' . ucwords($type) . ' Event')); ?></div>
	<div class="panel-body">
		<form action="add.php" method="post">
		<input type="hidden" name="type" value="<?php echo e($type); ?>" />
		<div class="row form-group">
			<div class="col-md-2"><label for="category" class="form-label"><?php echo e(translate('Category')); ?></label></div>
			<div class="col-md-4">
				<select name="category" class="form-control">
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($category->getId()); ?>"><?php echo e(translate($category->getDescription())); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"><label for="description" class="form-label"><?php echo e(translate('Description')); ?></label></div>
			<div class="col-md-8"><input type="text" name="description" class="form-control" /></div>
		</div>
		<div class="row form-group">
			<div class="col-md-offset-2 col-md-4"><input type="submit" value="<?php echo e(translate('Add')); ?>" class="form-control" /></div>
		</div>
		</form>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>