        <?php $__env->startSection('content'); ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header"><?php echo e(__('Verify your profile')); ?></div>
                        <div class="card-body">
                            <p><?php echo e(__('Thanks for registering with our platform. We will sent you message on your phone number. Provide the code below.')); ?></p>

                            <div class="d-flex justify-content-center">
                                <div class="col-8">
                                    <form method="post" action="<?php echo e(route('phoneverification.verify')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="code"><?php echo e(__('Verification Code')); ?></label>
                                            <input id="code" class="form-control<?php echo e($errors->has('code') ? ' is-invalid' : ''); ?>" name="code" type="text" placeholder="<?php echo e(__('Enter your verification code')); ?>" required autofocus>
                                            <?php if($errors->has('code')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('code')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary"><?php echo e(__('Verify profile')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\auth\verify_sms.blade.php ENDPATH**/ ?>