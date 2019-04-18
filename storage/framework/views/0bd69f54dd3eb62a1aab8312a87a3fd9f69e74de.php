<?php $__env->startSection('content'); ?>

	<div class="body">
		[-- wexplore Admin notification --]<br/><br/>
		Hello Admins,<br/>
		<br/>
		a new user has completed the <b>Global Orientation Test</b><br/>
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