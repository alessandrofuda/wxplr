<?php $__env->startSection('top_section'); ?>
	<h1>Dashboard<small>Appointments</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	
	<div class="container">
		<div class="row">
			<div class="heading">
				<h3><?php echo e($page_title); ?></h3>
			</div>
		</div>
		<div class="row">
			<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
				<thead>
				<tr role="row">
					<th>Consultant </th>
					<th>Start Date</th>
					<th>Type</th>
					<th>Status</th>
					<th>Operation</th>
				</tr>
				</thead>
				<tbody>
					<?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<?php if(isset($appointment->availablity->consultant->name )): ?>
						<tr>
							<td class="sorting_1"><?php echo e($appointment->availablity->consultant->name); ?></td>
							<td class="sorting_1"><?php echo e($appointment->availablity->getDate()); ?> -
								<?php echo e($appointment->availablity->getDate(\App\ConsultantAvailablity::START_TIME)); ?> to <?php echo e($appointment->availablity->getDate(\App\ConsultantAvailablity::END_TIME)); ?></td>
							<td class="sorting_1"><?php echo e($appointment->getTypeOptions($appointment->type_id, $appointment->query_id)); ?></td>
							<td class="sorting_1"><?php echo $appointment->getMeetingStatus(); ?></td>
							<td class="sorting_1">

									<?php if($appointment->status == \App\ConsultantBooking::STATE_PENDING && $appointment->checkDate()): ?>
										<a href='<?php echo e(url("user/booking/".$appointment->id."/cancel")); ?>' class="btn btn-warning">Cancel Appointment </a>
									<?php else: ?>
										Not Allowed
									<?php endif; ?>
							</td>
						</tr>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						<tr>
							<td colspan="5" align="center">
								No Appointment set yet!!</a>
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

        <?php if(count($appointments) > 0): ?>
            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        <script>
					jQuery(document).ready(function($){
	  					$('#join_<?php echo e($appointment->id); ?>').click(function() {

	  						// 1 - change btn style
	    					$(this).removeClass('btn-success').addClass('btn-warning');
	    					$(this).text('Reconnect to Meeting');

	    					// 2 - important! Update Orders.step_id tab	
	    					$.ajax({

	    						//headers: {
                        		//	'X-CSRF-TOKEN':
                    			//},

                    			type:'POST',
							    url:'<?php echo e(url('user/order/step_update')); ?>',  
							    data:{
							        app_id:<?php echo e($appointment->id); ?>,
							    },     
							    async: false, // ??    
							    cache: false,							    
							    success: function(result) {  
							    	console.log('ok');
							        console.log(result); // from controller							         
							    },
							    error: function(exception) {
							    	alert('Exception:'+exception);
							    },
							    // contentType: false,
                    			// processData: false,
                    			// complete:function() {
                        			 //
                    			// }
							});
	  					});
	  				});
		        </script>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>

	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>