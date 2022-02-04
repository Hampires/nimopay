<div class="text-center" id="paystack-payment-form" style="display: <?php echo e(env('DEFAULT_PAYMENT','cod')=="paystack"?"block":"none"); ?>;" >
    <button
        v-if="totalPrice"
        type="submit"
        class="btn btn-success mt-4 paymentbutton"
        onclick="this.disabled=true;this.form.submit();"
    ><?php echo e(__('Place order')); ?></button>
</div>
<?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views/cart/payments/paystack.blade.php ENDPATH**/ ?>