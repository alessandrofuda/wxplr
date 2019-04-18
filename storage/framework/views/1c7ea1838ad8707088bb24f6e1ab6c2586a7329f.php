<?php $__env->startSection('content'); ?>

	<div class="registered_user">
		[-- wexplore Admin notification --]<br/><br/>
		Hello Admins,<br/>
		<br/>
		a new account at Wexplore has been activated.<br/>
		<br/>
		<br/>
		<br/>
		Name: <?php echo e($user->name); ?><br/>
		Surname: <?php echo e($user->surname); ?><br/>
		E-mail: <?php echo e($user->email); ?><br/>
		<br/>
		<br/>
		<a href="<?php echo e(url('login')); ?>">Wexplore</a>
		<br/>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.templates.layout1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>