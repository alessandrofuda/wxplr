<?php $__env->startSection('top_section'); ?>
	<h1>Dashboard<small>Services</small></h1>
	<!--ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row">
			<div class="heading">
				<h3><?php echo e($page_title); ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p>Your basic package to kick-start your international career.</p>
				<p>Map your professional journey from the application to the recruitment phase, and get faster to your final destination, by avoiding slowdowns and pitfalls.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php if(count($notifications) > 0): ?>
					<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="box">
						<div class="box-header">
							<h3 class="box-title"><?php echo e($notification['heading']); ?></h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<table class="table table-condensed">
								<?php $__currentLoopData = $notification['notifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($key+1); ?>.</td>
										<td><strong><?php echo e($notification['heading']); ?></strong></td>
										<td>
											<?php echo $notification['noti_msg']; ?>

										</td>
										
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
					
				<?php if(count($user_services)>0): ?>
				<div class="box">
					<div class="box-title">
						<h3 style="padding: 0px 10px;">Your services:</h3>
					</div>
					<div class="box-body">
						<?php $__currentLoopData = $user_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_id=>$service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-6">
								<div class="box-style">
									<div class="top-stripe bckg-custom-orange"></div>
									<span class="imgblock"><img src="<?php echo e(asset($service["user_dashboard_image"])); ?>" alt="Professional Kit"></span>											
									<div class="tile-title">
										<h3><?php echo e($service['name']); ?></h3>
									</div>
									<div class="hover_column">
										<?php echo substr($service['user_dashboard_desc'], 0, 300); ?>

									</div>
									<div class="button-block text-center">
										<div class="hr-right"></div>
										<?php if($service['price'] == 0): ?>
											<a href="<?php echo e($service['url']); ?>"  class="applynow service_btn" >Start</a>
										<?php elseif($service['purchased']=='no'): ?>
											<form action="<?php echo e(url('service/payment/'.$service_id)); ?>" method="get">
												<input type="hidden"name="service_id" value="<?php echo e($service_id); ?>">
												<?php echo e(csrf_field()); ?>

												<button type="submit" class="applynow service_btn" >Start</button>
											</form>
										<?php else: ?>
											<a href="<?php echo e($service['url']); ?>" class="service_btn" type="button"><?php echo e($service['label']); ?></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<?php endif; ?>	
			</div>
			  
			<div class="clearfix"></div>
			<!-- <?php if(count($user_unpaid_services)>0): ?>
				<div class="col-md-12">
				<div class="box">
				<div class="box-title">
				<h3 style="padding: 0px 10px;">You might be interested in following services:</h3>
				</div>
					<div class="box-body">
				<?php $__currentLoopData = $user_unpaid_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_id=>$service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-4">
						<div class="box-style">
							<div class="top-stripe bckg-custom-orange"></div>
							<span class="imgblock"><img src="<?php echo e(asset($service["user_dashboard_image"])); ?>" alt="Professional Kit"></span>
							<div class="tile-title">
								<h3><?php echo e($service['name']); ?></h3>
								<h5><?php if($service['price']==0): ?>Free <?php else: ?> Price: <span class="service_price">&euro;<?php echo e($service['price']); ?></span><?php endif; ?></h5>
							</div>
							<div class="hover_column">
								<?php echo substr($service['user_dashboard_desc'], 0, 300); ?>

							</div>
							<div class="button-block text-center">
								<div class="hr-right"></div>
								<?php if($service['price'] == 0): ?>
									<a href="<?php echo e($service['url']); ?>"  class="applynow service_btn" >Start</a>
								<?php elseif($service['purchased']=='no'): ?>
									<form action="<?php echo e(url('service/payment/'.$service_id)); ?>" method="get">
										<input type="hidden"name="service_id" value="<?php echo e($service_id); ?>">
										<?php echo e(csrf_field()); ?>

										<button type="submit" class="applynow service_btn" >Start</button>
									</form>
								<?php else: ?>
									<?php if($service_id == 1 && $service['price']==0): ?>
										<?php echo e($btn_url=url('global_orientation_test')); ?>

										<?php echo e($btn_label='Start test'); ?>

									<?php elseif($service_id == 2 && $service['price']!=0): ?>
										<?php echo e($btn_url=url('user/professional_kit')); ?>

										<?php echo e($btn_label='Start'); ?>

									<?php elseif($service_id == 3 && $service['price']!=0): ?>
										<?php echo e($btn_url=url('skill_development/videos')); ?>

										<?php echo e($btn_label='Start'); ?>

									<?php elseif($service_id == 4 ): ?>
										<?php echo e($btn_url=url('/global_toolbox')); ?>

										<?php echo e($btn_label='Start'); ?>

									<?php else: ?>
										<?php echo e($btn_url=url('user/dashboard')); ?>

										<?php echo e($btn_label='Start'); ?>

									<?php endif; ?>
									<a href="<?php echo e($btn_url); ?>" class="service_btn" type="button"><?php echo e($btn_label); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
				</div>
					</div>
			<?php endif; ?> -->
		</div>
	</div>
	<!--/div-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>