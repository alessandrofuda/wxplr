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
                            <th>Consultant Name</th>
                            <th>Date</th>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($documents) > 0): ?>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?php echo $document['title']; ?></td>
                                    <td class="sorting_1"><?php echo e($document['consultant_name']); ?></td>
                                    <td class="sorting_1"><?php echo e($document['date']->setTimezone( session('timezone') ? session('timezone') : 'UTC' )); ?></td>
                                    <td class="sorting_1"><a href="<?php echo e($document['url']); ?>"><i class="fa fa-cloud-download"></i> Download</a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr role="row" class="odd">
                                <td colspan="4">No Documents found!</td>
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