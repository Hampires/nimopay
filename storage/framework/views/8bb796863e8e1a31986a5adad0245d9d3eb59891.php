<script>
    function setSelectedOrderId(id){
        $("#form-assing-driver").attr("action", "/updatestatus/assigned_to_driver/"+id);
    }
</script>
      
<!-- Accept -->
<?php if($lastStatusAlisas == "just_created"): ?>
    <a href="<?php echo e(url('updatestatus/accepted_by_admin/'.$order->id)); ?>" class="btn btn-primary"><?php echo e(__('Accept')); ?></a>
<?php endif; ?>

<!-- Reject -->
<?php if($lastStatusAlisas == "just_created"): ?>
    <a href="<?php echo e(url('updatestatus/rejected_by_admin/'.$order->id)); ?>" class="btn btn-danger"><?php echo e(__('Reject')); ?></a>
<?php endif; ?>

<!-- Assign to driver -->
<?php if($order->delivery_method.""!="2"&&$order->driver==null): ?>
    <?php if($lastStatusAlisas == "accepted_by_restaurant"|$lastStatusAlisas == "prepared"|$lastStatusAlisas == "rejected_by_driver"): ?>
        <button type="button" class="btn btn-primary" onClick=(setSelectedOrderId(<?php echo e($order->id); ?>))  data-toggle="modal" data-target="#modal-asign-driver"><?php echo e(__('Assign to driver')); ?></button>
    <?php endif; ?>
<?php endif; ?>
   <?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\orders\partials\actions\admin\buttons.blade.php ENDPATH**/ ?>