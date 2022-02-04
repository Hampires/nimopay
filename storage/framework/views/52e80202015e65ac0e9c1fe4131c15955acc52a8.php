<thead class="thead-light">
    <tr>
        <th scope="col"><?php echo e(__('ID')); ?></th>
        <?php if(auth()->check() && auth()->user()->hasRole('admin|driver')): ?>
            <th scope="col"><?php echo e(__('Restaurant')); ?></th>
        <?php endif; ?>
        <th class="table-web" scope="col"><?php echo e(__('Created')); ?></th>
        <th class="table-web" scope="col"><?php echo e(__('Method')); ?></th>

        <th class="table-web" scope="col"><?php echo e(__('Platform fee')); ?></th>
        <th class="table-web" scope="col"><?php echo e(__('Processor fee')); ?></th>
        <th class="table-web" scope="col"><?php echo e(__('Delivery')); ?></th>
        <th class="table-web" scope="col"><?php echo e(__('Net Price + VAT')); ?></th>
        <th class="table-web" scope="col"><?php echo e(__('VAT')); ?></th>
        <th class="table-web" scope="col"><?php echo e(__('Net Price')); ?></th>
        
        
        <th class="table-web" scope="col"><?php echo e(__('Total Price')); ?></th>
        
    </tr>
</thead>
<tbody>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        
        <a class="btn badge badge-success badge-pill" href="<?php echo e(route('orders.show',$order->id )); ?>">#<?php echo e($order->id); ?></a>
    </td>
    <?php if(auth()->check() && auth()->user()->hasRole('admin|driver')): ?>
    <th scope="row">
        <div class="media align-items-center">
            <a class="avatar-custom mr-3">
                <img class="rounded" alt="..." src=<?php echo e($order->restorant->icon); ?>>
            </a>
            <div class="media-body">
                <span class="mb-0 text-sm"><?php echo e($order->restorant->name); ?></span>
            </div>
        </div>
    </th>
    <?php endif; ?>

    <td class="table-web">
        <?php echo e($order->created_at->format(env('DATETIME_DISPLAY_FORMAT','d M Y H:i'))); ?>

    </td>
    <td class="table-web">
        <?php if($order->delivery_method==1): ?>
            <span class="badge badge-primary badge-pill"><?php echo e(__('Delivery')); ?> | <?php echo e(__($order->payment_method)); ?> </span>
        <?php else: ?>
            <span class="badge badge-success badge-pill"><?php echo e(__('Pickup')); ?> | <?php echo e(__($order->payment_method)); ?></span>
        <?php endif; ?>

    </td>
    
    <td class="table-web">
        <?php echo money($order->fee_value+$order->static_fee, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>
    <td class="table-web">
        <?php echo money($order->payment_processor_fee, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>
    <td class="table-web">
        <?php echo money($order->delivery_price, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>
    <td class="table-web">
        <?php echo money($order->order_price-($order->fee_value+$order->static_fee), env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>
    <td class="table-web">
        <?php echo money($order->vatvalue, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>
    <td class="table-web">
        <?php echo money($order->order_price-($order->fee_value+$order->static_fee)-$order->vatvalue, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>

    
   
    <td class="table-web">
        <?php echo money($order->order_price+$order->delivery_price, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?>
    </td>
    
    
</tr>
   

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\finances\financialdisplay.blade.php ENDPATH**/ ?>