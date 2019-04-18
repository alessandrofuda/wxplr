<?php $__env->startSection('content'); ?>

	<div class="alerts">
		[-- wexplore Admin notification --]<br/><br/>
		<p>Hello Admins,<br/>
		A user has auto-deleted his account from Wexplore service.</p>
		<br/>
		<p>Here below user's informations:<br/>

			Id: <?php echo e($user->id); ?><br/>
			Name: <?php echo e($user->name); ?><br/>
			Surname: <?php echo e($user->surname); ?><br/>
			Email: <?php echo e($user->email); ?><br/>
			Cancellation date: <?php echo e($user->deleted_at); ?><br/>

		</p>
		<br/>
		<a href="<?php echo e(url('login')); ?>">Wexplore</a>
		<br/>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.templates.layout1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>