<!-- Fee Info -->
<div class="col-6">
    <div class="card  bg-secondary shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0"><?php echo e(__('Bank connect')); ?></h3>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <form  id="bankform" method="post" action="<?php echo e(route('bank.connect')); ?>" autocomplete="off">
                    <div>
                        <?php echo csrf_field(); ?>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('status')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php elseif(session('warning')): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo e(session('warning')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div class="form-group<?php echo e($errors->has('bvn') ? ' has-danger' : ''); ?>">
                                <label class="form-control-label" for="bvn"><?php echo e(__('BVN')); ?></label>
                                <input type="text" name="bvn" id="bvn" class="form-control form-control-alternative<?php echo e($errors->has('bvn') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Bank Verification Number')); ?>" value="<?php echo e(old('bvn', auth()->user()->bank_detail->bvn)); ?>" required autofocus>
                                <?php if($errors->has('bvn')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('bvn')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('account_number') ? ' has-danger' : ''); ?>">
                                <label class="form-control-label" for="account_number"><?php echo e(__('Account Number')); ?></label>
                                <input type="text" name="account_number" id="account_number" class="form-control form-control-alternative<?php echo e($errors->has('account_number') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('0123456789')); ?>" value="<?php echo e(old('account_number', auth()->user()->bank_detail->account_number)); ?>" required autofocus>
                                <?php if($errors->has('account_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('account_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('account_name') ? ' has-danger' : ''); ?>">
                                <label class="form-control-label" for="account_name"><?php echo e(__('Bank Account Name')); ?></label>
                                <input type="text" name="account_name" id="account_name" class="form-control form-control-alternative<?php echo e($errors->has('account_name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Account Name')); ?>" value="<?php echo e(old('account_name', auth()->user()->bank_detail->account_name)); ?>" required autofocus>
                                <?php if($errors->has('account_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('account_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if($errors->has('bank')): ?>
                                <h1><strong><?php echo e($errors->first('bank')); ?></strong></h1>
                            <?php endif; ?>
                            <div class="form-group<?php echo e($errors->has('bank') ? ' has-danger' : ''); ?>">
                                <label class="form-control-label" for="bank"><?php echo e(__('Bank')); ?></label>
                                <br />
                                <select class="form-control form-control-alternative   <?php if(isset($classselect)): ?> <?php echo e($classselect); ?> <?php endif; ?>"  name="bank" id="bank">
                                    <option disabled selected value> <?php echo e(__('Select bank')); ?> </option>
                                    <?php for($i = 0; $i < count($banks); $i++): ?>
                                        <?php if(old('bank', auth()->user()->bank_detail->bank_id) == $banks[$i]->id): ?>
                                            <option  selected value="<?php echo e($banks[$i]->alias); ?>"><?php echo e(__($banks[$i]->name)); ?></option>
                                        <?php elseif(old('bank') == $banks[$i]->alias): ?>
                                            <option  selected value="<?php echo e($banks[$i]->alias); ?>"><?php echo e(__($banks[$i]->name)); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($banks[$i]->alias); ?>"><?php echo e(__($banks[$i]->name)); ?></option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>      
                    </div>
                    <hr />
                    <?php if(!auth()->user()->hasBankAccount()): ?>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Connect with Bank Connect')); ?></button>
                    <?php elseif(auth()->user()->hasBankAccount() && !auth()->user()->hasKYC()): ?>
                        <button type="submit" class="btn btn-warning"><?php echo e(__('Update Bank connection')); ?></button>
                    <?php elseif(auth()->user()->hasBankAccount() && auth()->user()->hasKYC()): ?>
                        <button type="button" class="btn btn-warning" disabled><?php echo e(__('Update Bank connection')); ?></button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views/finances/stripe.blade.php ENDPATH**/ ?>