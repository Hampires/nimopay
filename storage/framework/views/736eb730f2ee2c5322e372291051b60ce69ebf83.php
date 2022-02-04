<?php if(strlen(env('RECAPTCHA_SITE_KEY',""))>2): ?>
    <?php $__env->startSection('head'); ?>
    <?php echo htmlScriptTagJsApi([]); ?>

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('users.partials.header', [
        'title' => __(''),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="container-fluid mt--7">
        <div class="row">

            </div>
            <div class="col-xl-8 offset-xl-2">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0"><?php echo e(__('Register your business')); ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form  id="registerform" method="post" action="<?php echo e(route('newbusiness.store')); ?>" autocomplete="off">
                            <?php echo csrf_field(); ?>

                            <h6 class="heading-small text-muted mb-4"><?php echo e(__('Business information')); ?></h6>

                            <?php if(session('status')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('status')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="pl-lg-4">
                                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="name"><?php echo e(__('Business Name')); ?></label>
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Business Name here')); ?> ..." value="<?php echo e(isset($_GET["name"])?$_GET['name']:""); ?>" required autofocus>
                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('placeholder') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="placeholder"><?php echo e(__('Business Placeholder')); ?></label>
                                    <input type="text" name="placeholder" id="placeholder" class="form-control form-control-alternative<?php echo e($errors->has('placeholder') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Service offered by Table, Seat, Room etc...')); ?> ..." value="<?php echo e(isset($_GET["placeholder"])?$_GET['placeholder']:""); ?>" required autofocus>
                                    <?php if($errors->has('placeholder')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('placeholder')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('enterprise') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="enterprise"><?php echo e(__('Business Category')); ?></label>
                                    <br />
                                    <select class="w-100 form-control form-control-alternative   <?php if(isset($classselect)): ?> <?php echo e($classselect); ?> <?php endif; ?>"  name="enterprise" id="enterprise">
                                        <option disabled selected value> <?php echo e(__('Select')." ".__('Business Category')); ?> </option>
                                        <?php $__currentLoopData = $enterprises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enterprise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($enterprise->id); ?>"><?php echo e(__(ucwords($enterprise->name))); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <style>
                                        .select2-container {
                                            width: 100% !important;
                                        }
                                    </style>
                                </div>
                                
                            </div>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-4"><?php echo e(__('Owner information')); ?></h6>
                            <div class="pl-lg-4">
                                <div class="form-group<?php echo e($errors->has('name_owner') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="name_owner"><?php echo e(__('Owner Name')); ?></label>
                                    <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative<?php echo e($errors->has('name_owner') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Owner Name here')); ?> ..." value="<?php echo e(isset($_GET["name"])?$_GET['name']:""); ?>" required autofocus>

                                    <?php if($errors->has('name_owner')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name_owner')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('email_owner') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="email_owner"><?php echo e(__('Owner Email')); ?></label>
                                    <input type="email" name="email_owner" id="email_owner" class="form-control form-control-alternative<?php echo e($errors->has('email_owner') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Owner Email here')); ?> ..." value="<?php echo e(isset($_GET["email"])?$_GET['email']:""); ?>" required autofocus>

                                    <?php if($errors->has('email_owner')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email_owner')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('phone_owner') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="phone_owner"><?php echo e(__('Owner Phone')); ?></label>
                                    <input type="text" name="phone_owner" id="phone_owner" class="form-control form-control-alternative<?php echo e($errors->has('phone_owner') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Owner Phone here')); ?> ..." value="<?php echo e(isset($_GET["phone"])?$_GET['phone']:""); ?>" required autofocus>

                                    <?php if($errors->has('phone_owner')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('phone_owner')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="text-center">
                                    <?php if(strlen(env('RECAPTCHA_SITE_KEY',""))>2): ?>
                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                        </span>
                                        <?php endif; ?>

                                        <?php echo htmlFormButton(__('Save'), ['id'=>'thesubmitbtn','class' => 'btn btn-success mt-4']); ?>

                                    <?php else: ?>
                                        <button type="submit" id="thesubmitbtn" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php if(isset($_GET['name'])&&$errors->isEmpty()): ?>
<script>
    "use strict";
    document.getElementById("thesubmitbtn").click();
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', ['title' => __('User Profile')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views/restorants/register.blade.php ENDPATH**/ ?>