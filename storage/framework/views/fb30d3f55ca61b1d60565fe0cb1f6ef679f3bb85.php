<?php $__env->startSection('content'); ?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <?php if(isset($coupon)): ?>
                                <h3 class="mb-0"><?php echo e(__('Edit banner')); ?></h3>
                            <?php else: ?>
                                <h3 class="mb-0"><?php echo e(__('New banner')); ?></h3>
                            <?php endif; ?>
                        </div>
                        <div class="col-4 text-right">
                            <a href="<?php echo e(route('admin.restaurant.banners.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back')); ?></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4"><?php echo e(__('Banner information')); ?></h6>
                    <?php if(session('status')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('status')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <div class="pl-lg-4">
                        <?php if(isset($banner)): ?>
                            <form method="post" action="<?php echo e(route('admin.restaurant.banners.update', $banner->id)); ?>" autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                        <?php else: ?>
                            <form method="post" action="<?php echo e(route('admin.restaurant.banners.store')); ?>" autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                        <?php endif; ?>
                            <?php echo $__env->make('banners.form', ['restaurants' => $restaurants], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div>
                                <?php if(isset($banner)): ?>
                                    <button type="submit" class="btn btn-primary mt-4"><?php echo e(__('Update')); ?></button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        "use strict";

        var banner = <?php if(isset($banner)) { echo json_encode($banner); } else { echo json_encode(null); } ?>;
        if(banner != null){
            var banner_type = banner.type;
            if(banner_type == 0){
                $('#form-group-vendor_id').show();

                $("#vendor_id").attr("required",true);
                $("#page_id").attr("required",false);
            }else{
                $('#form-group-page_id').show();

                $("#page_id").attr("required",true);
                $("#vendor_id").attr("required",false);
            }
        }

        $('#type').on('change', function() {
            if(this.value == 0){
                $("#page_id").attr("required",false);
                $('#form-group-page_id').hide();

                $('#form-group-vendor_id').show();
                $("#vendor_id").attr("required",true);

            }else{
                $('#form-group-vendor_id').hide();
                $("#vendor_id").attr("required",false);

                $('#form-group-page_id').show();
                $("#page_id").attr("required",true);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => __('Banner')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\banners\create.blade.php ENDPATH**/ ?>