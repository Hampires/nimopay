<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('items.partials.header', ['title' => __('Edit Item')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('Item Management')); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <?php if(auth()->user()->hasRole('owner')): ?>
                                    <a href="<?php echo e(route('items.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back to items')); ?></a>
                                <?php elseif(auth()->user()->hasRole('admin')): ?>
                                    <a href="<?php echo e(route('items.admin', $restorant)); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back to items')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="col-12">
                        <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4"><?php echo e(__('Item information')); ?></h6>
                        <div class="pl-lg-4">
                            <form method="post" action="<?php echo e(route('items.update', $item)); ?>" autocomplete="off" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group<?php echo e($errors->has('item_name') ? ' has-danger' : ''); ?>">
                                            <label class="form-control-label" for="item_name"><?php echo e(__('Item Name')); ?></label>
                                            <input type="text" name="item_name" id="item_name" class="form-control form-control-alternative<?php echo e($errors->has('item_name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(old('item_name', $item->name)); ?>" required autofocus>
                                            <?php if($errors->has('item_name')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('item_name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group<?php echo e($errors->has('item_description') ? ' has-danger' : ''); ?>">
                                            <label class="form-control-label" for="item_description"><?php echo e(__('Item Description')); ?></label>
                                            <textarea id="item_description" name="item_description" class="form-control form-control-alternative<?php echo e($errors->has('item_description') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Item Description here ... ')); ?>" value="<?php echo e(old('item_description', $item->description)); ?>" required autofocus rows="3"><?php echo e(old('item_description', $item->description)); ?></textarea>
                                            <?php if($errors->has('item_description')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('item_description')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group<?php echo e($errors->has('item_price') ? ' has-danger' : ''); ?>">
                                            <label class="form-control-label" for="item_price"><?php echo e(__('Item Price')); ?></label>
                                            <input type="number" step="any" name="item_price" id="item_price" class="form-control form-control-alternative<?php echo e($errors->has('item_price') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Price')); ?>" value="<?php echo e(old('item_price', $item->price)); ?>" required autofocus>
                                            <?php if($errors->has('item_price')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('item_price')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php $image=['name'=>'item_image','label'=>__('Item Image'),'value'=> $item->logom,'style'=>'width: 290px; height:200']; ?>
                                        <?php echo $__env->make('partials.images',$image, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="form-group">
                                            <label class="form-control-label" for="item_price"><?php echo e(__('Item available')); ?></label>
                                            <label class="custom-toggle" style="float: right">
                                                <input type="checkbox" id="itemAvailable" class="itemAvailable" itemid="<?php echo e($item->id); ?>" <?php if($item->available == 1){echo "checked";}?>>
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="text-center">
                                   <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                            <div class="text-center">
                                <form action="<?php echo e(route('items.destroy', $item)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="button" class="btn btn-danger mt-4" onclick="confirm('<?php echo e(__("Are you sure you want to delete this item?")); ?>') ? this.parentElement.submit() : ''"><?php echo e(__('Delete')); ?></button>
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

<?php echo $__env->make('layouts.app', ['title' => __('Item Management')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\items\edit_x.blade.php ENDPATH**/ ?>