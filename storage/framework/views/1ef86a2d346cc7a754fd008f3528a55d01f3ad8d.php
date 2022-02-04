<div class="card card-profile shadow tablepicker">
    <div class="px-4">
      <div class="mt-5">
        <h3><?php echo e(__(ucwords($restorant->placeholder))); ?><span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        <input type="hidden" value="<?php echo e($restorant->id); ?>" id="restaurant_id"/>
        <?php echo $__env->make('partials.select',$tables, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <br />
      <br />
    </div>
  </div>
  <br />
<?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views/cart/localorder/table.blade.php ENDPATH**/ ?>