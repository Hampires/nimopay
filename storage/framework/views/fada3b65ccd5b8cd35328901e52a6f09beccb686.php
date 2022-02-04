<?php $__env->startSection('content'); ?>
    <section class="section-profile-cover section-shaped my--1 d-none d-md-none d-lg-block d-lx-block">
        <!-- Circles background -->
        <img class="bg-image " src="<?php echo e(config('global.restorant_details_cover_image')); ?>" style="width: 100%;">
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">

        </div>
    </section>
    <section class="section bg-secondary">

      <div class="container">

          <div class="row">

            <!-- Left part -->
            <div class="col-md-7">

              <!-- List of items -->
              <?php echo $__env->make('cart.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form id="order-form" role="form" method="post" action="<?php echo e(route('order.store')); ?>" autocomplete="off" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(!env('IS_WHATSAPP_ORDERING_MODE',false) && !env('IS_FACEBOOK_ORDERING_MODE',false)): ?>

                    <?php if(config('app.isft')&&count($timeSlots)>0): ?>
                    <!-- FOOD TIGER -->
                        <!-- Delivery method -->
                        <?php if($restorant->can_pickup == 1): ?>
                            <?php if($restorant->can_deliver == 1): ?>
                            <?php echo $__env->make('cart.delivery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Delivery time slot -->
                        <?php echo $__env->make('cart.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <!-- Delivery address -->
                        <div id='addressBox'>
                            <?php echo $__env->make('cart.address', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <!-- Comment -->
                        <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php else: ?>

                        <!-- QRSAAS -->
                        <?php if(!env('WHATSAPP_ORDERING_ENABLED',false) && !env('ENABLE_FACEBOOK_ORDERING',false)): ?>

                            <!-- DINE IN OR TAKEAWAY -->
                            <?php if(env('ENABLE_PICKUP',true)): ?>
                                <?php echo $__env->make('cart.localorder.dineiintakeaway', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <!-- Takeaway time slot -->
                                <div class="takeaway_picker" style="display: none">
                                    <?php echo $__env->make('cart.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- LOCAL ORDERING -->
                            <?php echo $__env->make('cart.localorder.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                            <!-- Local Order Phone -->
                            <?php echo $__env->make('cart.localorder.phone', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <!-- Comment -->
                            <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>

                            <!--Whatsapp and facebook order enabled in QR -->

                            <?php if(count($timeSlots)>0): ?>
                            <!-- Delivery method -->
                                <?php if($restorant->can_pickup == 1): ?>
                                    <?php if($restorant->can_deliver == 1): ?>
                                    <?php echo $__env->make('cart.delivery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Delivery adress -->
                                <?php echo $__env->make('cart.newaddress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <!-- Comment -->
                                <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>
                <?php else: ?>
                    <!-- Whatsapp MODE -->

                    <?php if(count($timeSlots)>0): ?>
                        <!-- Delivery method -->
                        <?php if($restorant->can_pickup == 1): ?>
                            <?php if($restorant->can_deliver == 1): ?>
                            <?php echo $__env->make('cart.delivery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Delivery adress -->
                        <?php echo $__env->make('cart.newaddress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <!-- Comment -->
                        <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>

              <!-- Restaurant -->
              <?php echo $__env->make('cart.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>


          <!-- Right Part -->
          <div class="col-md-5">

            <?php if(count($timeSlots)>0||config('app.isqrsaas')): ?>
                <!-- Payment -->
                <?php echo $__env->make('cart.payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--
                  <br/>
                  <?php echo $__env->make('cart.coupons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                -->
            <?php else: ?>
                <!-- Closed restaurant -->
                <?php echo $__env->make('cart.closed', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>


          </div>
        </div>


    </div>
    <?php echo $__env->make('clients.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

  <script async defer src= "https://maps.googleapis.com/maps/api/js?key=<?php echo env('GOOGLE_MAPS_API_KEY',''); ?>&callback=initAddressMap"></script>
  <!-- Stripe -->
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    "use strict";
    var RESTORANT = <?php echo json_encode($restorant) ?>;
    var STRIPE_KEY="<?php echo e(env('STRIPE_KEY',"")); ?>";
    var ENABLE_STRIPE="<?php echo e(env('ENABLE_STRIPE',false)); ?>";
    var initialOrderType = 'delivery';
    if(RESTORANT.can_deliver == 1 && RESTORANT.can_pickup == 0){
        initialOrderType = 'delivery';
    }else if(RESTORANT.can_deliver == 0 && RESTORANT.can_pickup == 1){
        initialOrderType = 'pickup';
    }
  </script>
  <script src="<?php echo e(asset('custom')); ?>/js/checkout.js"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.front', ['class' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/walydqmf/menu.nimopay.xyz/resources/views/cart.blade.php ENDPATH**/ ?>