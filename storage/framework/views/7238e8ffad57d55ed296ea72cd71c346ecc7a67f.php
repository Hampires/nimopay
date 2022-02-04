;
<?php $__env->startSection('tbody'); ?>
    <?php $__currentLoopData = $setup['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e($item->code); ?></td>
            <td><?php echo e($item->type == 0 ? $item->price." ".env('CASHIER_CURRENCY','usd') : $item->price." %"); ?></td>
            <td><?php echo e($item->active_from); ?></td>
            <td><?php echo e($item->active_to); ?></td>
            <td><?php echo e($item->limit_to_num_uses); ?></td>
            <td><?php echo e($item->used_count); ?></td>
            <?php echo $__env->make('partials.tableactions',$setup, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('general.index', $setup, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\coupons\index.blade.php ENDPATH**/ ?>