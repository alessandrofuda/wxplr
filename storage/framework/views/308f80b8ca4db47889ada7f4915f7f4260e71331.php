<?php $__env->startSection('content'); ?>
<div class="upper-test-container">
		<?php if(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		<?php endif; ?>
		<!--<h1></h1>-->
        <div class="box-header">
            <h3 class="box-title"><?php echo e($page_title); ?></h3>
          </div>
		<div class="content box">
            <div class="row">
                <div class="col-sm-12">
                    <table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th>Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($orders) > 0): ?>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo e($order->item_name); ?></td>
                                        <td class="sorting_1">€<?php echo e($order->item_amount); ?></td>
                                        <td class="sorting_1"><?php echo e($order->created_at); ?></td>
                                        <td class="sorting_1"><a href="<?php echo e(url("order/".$order->id.'/download/invoice')); ?>"><i class="fa fa-file-pdf-o" style="font-size:25px;"></i></a></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr role="row" class="odd">
                                  <td colspan="4">No Order created yet!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
		</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>