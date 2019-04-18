 

<?php $__env->startSection('content'); ?>

	<!--/header-->
	</div>
	<div id="Content">
		<?php if($machine_name == 'about-us'): ?>
		    <?php echo $__env->make('front.about-us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'contact-us'): ?>
			<?php echo $__env->make('front.contact-us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'terms-service'): ?>
			<?php echo $__env->make('front.terms-service', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'privacy-policy'): ?>
			<?php echo $__env->make('front.privacy-policy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'cookies-policy'): ?>
			<?php echo $__env->make('front.cookies-policy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'code-ethics'): ?>
			<?php echo $__env->make('front.code-ethics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'global-orientation-test'): ?>
			<?php echo $__env->make('front.global-orientation-test', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'professional-kit'): ?>
			<?php echo $__env->make('front.professional-kit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'global-toolbox'): ?>
			<?php echo $__env->make('front.global-toolbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'skills-development'): ?>
			<?php echo $__env->make('front.skills-development', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'aiesec'): ?>
			<?php echo $__env->make('front.aiesec', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($machine_name == 'faq'): ?>
			<?php echo $__env->make('front.faq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
	</div>

	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.new_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>