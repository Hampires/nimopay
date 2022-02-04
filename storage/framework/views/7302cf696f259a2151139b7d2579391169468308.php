<?php $__env->startSection('content'); ?>
<div class="section section-hero section-shaped">
      
    <div class="section features-1">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <form>
                    <div class="form-group">
                        <div class="input-group mb-4 border border-danger">
                        <input class="form-control" name="location" id="txtlocation" value="<?php echo e(request()->get('location')); ?>" type="text">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <div class="col-md-9">
            <h6 class="info-title text-uppercase text-warning">Recommended for you</h6>
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $restorants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restorant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php $link=route('vendor',['alias'=>$restorant->alias]); ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="strip">
                            <figure>
                            <a href="<?php echo e($link); ?>"><img src="<?php echo e($restorant->logom); ?>" data-src="<?php echo e(config('global.restorant_details_image')); ?>" class="img-fluid lazy" alt=""></a>
                            </figure>
                            <span class="res_title"><b><a href="<?php echo e($link); ?>"><?php echo e($restorant->name); ?></a></b></span><br />
                            <span class="res_description"><?php echo e($restorant->description); ?></span><br />
                            <span class="res_mimimum"><?php echo e(__('Minimum order')); ?>: <?php echo money($restorant->minimum, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?></span>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-md-12">
                    <p class="text-muted mb-0"><?php echo e(__('Hmmm... Nothing found!')); ?></p>
                    </div>

                    <?php endif; ?>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', ['title' => __('Restaurants')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\restorants\location.blade.php ENDPATH**/ ?>