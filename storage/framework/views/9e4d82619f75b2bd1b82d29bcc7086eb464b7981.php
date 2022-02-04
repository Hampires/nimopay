<div class="card card-profile shadow mt--300">
    <div class="px-4">
      <div class="mt-5">
        <h3><?php echo e(__('Checkout')); ?><span class="font-weight-light"></span></h3>
      </div>
      <div  class="border-top">
        <!-- Price overview -->
        <div id="totalPrices" v-cloak>
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span v-if="totalPrice==0"><?php echo e(__('Cart is empty')); ?>!</span>

                            <span v-if="totalPrice"><strong><?php echo e(__('Subtotal')); ?>:</strong></span>
                            <span v-if="totalPrice" class="ammount"><strong>{{ totalPriceFormat }}</strong></span>
                            <?php if(config('app.isft')): ?>
                                <span v-if="totalPrice&&delivery"><br /><strong><?php echo e(__('Delivery')); ?>:</strong></span>
                                <span v-if="totalPrice&&delivery" class="ammount"><strong>{{ deliveryPriceFormated }}</strong></span><br />
                            <?php endif; ?>
                            <br />
                            <span v-if="totalPrice"><strong><?php echo e(__('TOTAL')); ?>:</strong></span>
                            <span v-if="totalPrice" class="ammount"><strong>{{ withDeliveryFormat   }}</strong></span>
                            <input v-if="totalPrice" type="hidden" id="tootalPricewithDeliveryRaw" :value="withDelivery" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End price overview -->

        <!-- Payment  Methods -->
        <div class="cards">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <!-- Errors on Stripe -->
                        <?php if(session('error')): ?>
                            <div role="alert" class="alert alert-danger"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>

                        <?php if(!env('IS_WHATSAPP_ORDERING_MODE',false) && !env('WHATSAPP_ORDERING_ENABLED',false) && !env('ENABLE_FACEBOOK_ORDERING',false) && !env('IS_FACEBOOK_ORDERING_MODE',false)): ?>
                        <!-- COD -->
                        <?php if(!env('HIDE_COD',false)): ?>
                            <div class="custom-control custom-radio mb-3">
                                <input name="paymentType" class="custom-control-input" id="cashOnDelivery" type="radio" value="cod" <?php echo e(env('DEFAULT_PAYMENT','cod')=="cod"?"checked":""); ?>>
                                <label class="custom-control-label" for="cashOnDelivery"><span class="delTime"><?php echo e(config('app.isqrsaas')?__('Cash / Card Terminal'): __('Cash on delivery')); ?></span> <span class="picTime"><?php echo e(__('Cash on pickup')); ?></span></label>
                            </div>
                        <?php endif; ?>

                        <!-- STIPE CART -->
                        <?php if(env('STRIPE_KEY',false)&&env('ENABLE_STRIPE',false)): ?>
                            <div class="custom-control custom-radio mb-3">
                                <input name="paymentType" class="custom-control-input" id="paymentStripe" type="radio" value="stripe" <?php echo e(env('DEFAULT_PAYMENT','cod')=="stripe"?"checked":""); ?>>
                                <label class="custom-control-label" for="paymentStripe"><?php echo e(__('Pay with card')); ?></label>
                            </div>
                        <?php endif; ?>

                        <!-- PayPal -->
                        <?php if(env('PAYPAL_SECRET',false)&&env('ENABLE_PAYPAL',false)): ?>
                            <div class="custom-control custom-radio mb-3">
                                <input name="paymentType" class="custom-control-input" id="paymentPayPal" type="radio" value="paypal" <?php echo e(env('DEFAULT_PAYMENT','cod')=="paypal"?"checked":""); ?>>
                                <label class="custom-control-label" for="paymentPayPal"><?php echo e(__('Pay with PayPal')); ?></label>
                            </div>
                        <?php endif; ?>

                        <!-- PAYFAST -->
                        <?php if(env('ENABLE_PAYSTACK', false)): ?>
                            <div class="custom-control custom-radio mb-3">
                                <input name="paymentType" class="custom-control-input" id="paymentPaystack" type="radio" value="paystack" <?php echo e(env('DEFAULT_PAYMENT','cod')=="paystack"?"checked":""); ?>>
                                <label class="custom-control-label" for="paymentPaystack"><?php echo e(__('Pay with Paystack')); ?></label>
                            </div>
                        <?php endif; ?>

                        <!-- Mollie -->
                        <?php if(env('ENABLE_MOLLIE', false)): ?>
                            <div class="custom-control custom-radio mb-3">
                                <input name="paymentType" class="custom-control-input" id="paymentMollie" type="radio" value="mollie" <?php echo e(env('DEFAULT_PAYMENT','cod')=="mollie"?"checked":""); ?>>
                                <label class="custom-control-label" for="paymentMollie"><?php echo e(__('Pay with Mollie')); ?></label>
                            </div>
                        <?php endif; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- END Payment -->

        <!-- Payment Actions -->
        <?php if(!env('IS_WHATSAPP_ORDERING_MODE',false) && !env('WHATSAPP_ORDERING_ENABLED',false) && !env('ENABLE_FACEBOOK_ORDERING',false) && !env('IS_FACEBOOK_ORDERING_MODE',false)): ?>

            <!-- COD -->
            <?php echo $__env->make('cart.payments.cod', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- PayPal -->
            <?php if(env('ENABLE_PAYPAL',false)): ?>
                <?php echo $__env->make('cart.payments.paypal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <!-- Paystack -->
            <?php if(env('ENABLE_PAYSTACK',false)): ?>
                <?php echo $__env->make('cart.payments.paystack', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <!-- Mollie -->
            <?php if(env('ENABLE_MOLLIE',false)): ?>
                <?php echo $__env->make('cart.payments.mollie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            </form>

            <!-- Stripe -->
            <?php echo $__env->make('cart.payments.stripe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(env('IS_WHATSAPP_ORDERING_MODE',false) || env('WHATSAPP_ORDERING_ENABLED',false)): ?>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-4 paymentbutton submit_btn"><?php echo e(__('Send Whatsapp Order')); ?></button>
            </div>
        <?php elseif(env('IS_FACEBOOK_ORDERING_MODE',false) || env('ENABLE_FACEBOOK_ORDERING',false)): ?>
            <div class="text-center">
                <button type="button" id="fborder_btn" class="btn btn-success mt-4 paymentbutton"><?php echo e(__('Send Facebook Order')); ?></button>
            </div>
        <?php endif; ?>
        <!-- END Payment Actions -->

        <br/><br/>
        <div class="text-center">
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" id="privacypolicy" type="checkbox">
                <label class="custom-control-label" for="privacypolicy"><?php echo e(__('I agree to the Terms and Conditions and Privacy Policy')); ?></label>
            </div>
        </div>

      </div>
      <br />
      <br />
    </div>
  </div>

  <?php if(env('IS_DEMO', false) && env('ENABLE_STRIPE', false)): ?>
    <?php echo $__env->make('cart.democards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php /**PATH /home/walydqmf/dashboard.paulecapital.com/resources/views/cart/payment.blade.php ENDPATH**/ ?>