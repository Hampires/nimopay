;
<?php $__env->startSection('tbody'); ?>
    <?php $__currentLoopData = $setup['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->table?$item->table->name:""); ?></td>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e($item->email); ?></td>
            <td><?php echo e($item->phone_number); ?></td>
            <td><?php echo e($item->note); ?></td>
            <td><?php echo e($item->by=="1"?__('customers.by_restaurant'):__('customers.him_self')); ?></td>
            <td><?php echo e($item->created_at); ?></td>
            <?php echo $__env->make('partials.tableactions',$setup, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </tr> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('general.index', $setup, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\visits\index.blade.php ENDPATH**/ ?>