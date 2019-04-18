<?php $__env->startSection('content'); ?>
<div class='row'>
    <div class="col-md-12">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo e($page_title); ?></h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                      <form role="form" method="post" action="<?php if(isset($question)): ?><?php echo e(url('admin/question/'.$question->id.'/edit')); ?><?php else: ?> <?php echo e(url('admin/question/create')); ?><?php endif; ?>">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Question</label>
                          <textarea name="question" required class="form-control" placeholder="Enter question here..." ><?php if(isset($question)): ?><?php echo e($question->question); ?><?php endif; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Choice 1</label>
                          <input type="text" name="choice1" class="form-control" placeholder="Enter choice here..." value="<?php if(isset($question)): ?><?php echo e($question->questionChoices[0]->choice); ?><?php endif; ?>">
                        </div>
						<div class="form-group">
                          <label>Choice 2</label>
                          <input type="text" name="choice2" class="form-control" placeholder="Enter choice here..." value="<?php if(isset($question)): ?><?php echo e($question->questionChoices[1]->choice); ?><?php endif; ?>">
                        </div>
                        <div class="form-group">
                            <label>Parent Choice</label>
                            <select name="parent_choice" class="form-control">
                                <option  value="_none" <?php if(!isset($question) || empty($question->parent_choice)): ?> selected <?php endif; ?>>-- None --</option>
                                
								
								
								<?php if(isset($choices) && count($choices) > 0): ?>
                                    <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(empty($ques)): ?>
											<optgroup value="0" label="Question: <?php echo e($choice->globalTest->question); ?>">
										<?php elseif(!empty($ques) && $ques != $choice->globalTest->id): ?>
											</optgroup>
											<optgroup value="0" label="Question: <?php echo e($choice->globalTest->question); ?>">
										<?php endif; ?>
                                        <option <?php if(isset($question) && $question->parent_choice == $choice->id ): ?> selected <?php endif; ?> value="<?php echo e($choice->id); ?>">Choice: <?php echo e($choice->choice); ?></option>
										<?php if($choices_count==$i): ?>{
											</optgroup>
										<?php endif; ?>
										
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <input type="hidden" name="question_id" value="<?php if(isset($question)): ?> <?php echo e($question->id); ?> <?php endif; ?>">
                        <input type="hidden" name="form_type" value="<?php if(isset($question)): ?> edit <?php else: ?> create <?php endif; ?>">
                        <?php echo e(csrf_field()); ?>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?php echo e(url('admin/global_test_list')); ?>" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>