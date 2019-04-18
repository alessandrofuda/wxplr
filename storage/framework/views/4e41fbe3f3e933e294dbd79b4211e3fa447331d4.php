<?php $__env->startSection('content'); ?>
	<div class="fancy_heading fancy_heading_icon">
		<h2 style="color:#54b141; background: url(/frontend/immagini/linea-titolo-verde.png) no-repeat bottom center; padding-bottom: 25px;">LOGIN</h2>
	</div>
	<div class="user_login_form">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-none">

			<?php if($errors->any()): ?>
			    <div class="alert alert-danger">
			        <ul>
			            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <li><?php echo e($error); ?></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </ul>
			    </div>
			<?php endif; ?>
			
			<form method="POST" action="<?php echo e(url('/auth/login')); ?>">
				  <?php echo csrf_field(); ?>

				  <div class="form-group has-feedback">
						<label for="email">Email : </label>
					<input type="email" class="form-control" required placeholder="Email" name="email" value="<?php echo e(old('email')); ?>">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
						<label for="password">Password : </label>
					<input type="password" name="password" required id="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				  <div class="row">
					<div class="col-xs-8">
					  <div class="checkbox icheck">
						<label>
						  <input type="checkbox" name="remember"> Remember Me
						</label>
					  </div>
					</div>
					<!-- /.col -->
					<div class="col-xs-4">
					  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				  </div>
			</form>
			<a href="<?php echo e(URL::to('/password/email')); ?>">I forgot my password</a><br>
			<a href="<?php echo e(URL::to('register?type=basic')); ?>" class="text-center">Register a new membership</a><br>
		  <?php /*<a href="{{ URL::route('consultant_register', ['type' => 'basic']) }}" class="text-center">Register as Consultant </a> */?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.new_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>