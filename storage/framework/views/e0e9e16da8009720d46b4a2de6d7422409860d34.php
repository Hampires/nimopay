<!-- STRIPE -->
<?php if(env('STRIPE_KEY',false)&&env('ENABLE_STRIPE',false)): ?>
<form action="/charge" method="post" id="stripe-payment-form" style="display: <?php echo e(env('DEFAULT_PAYMENT','cod')=="stripe"?"block":"none"); ?>;"   >

    <div style="width: 100%;" class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
        <input name="name" id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__( 'Name on card' )); ?>" value="<?php echo e(auth()->user()?auth()->user()->name:""); ?>" required>
        <?php if($errors->has('name')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('name')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="form">
        <div style="width: 100%;" #stripecardelement  id="card-element" class="form-control">

        <!-- A Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display form errors. -->
      <br />
      <div class="" id="card-errors" role="alert">

      </div>
  </div>
  <div class="text-center" id="totalSubmitStripe">
    <button
        v-if="totalPrice"
        type="submit"
        class="btn btn-success mt-4 paymentbutton"
        ><?php echo e(__('Place an order')); ?></button>
  </div>

  </form>
<?php endif; ?>
<?php /**PATH /home/walydqmf/menu.nimopay.xyz/resources/views/cart/payments/stripe.blade.php ENDPATH**/ ?>