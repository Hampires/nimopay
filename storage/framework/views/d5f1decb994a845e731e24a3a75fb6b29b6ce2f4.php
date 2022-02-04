<div class="row">
    <div class="col-md-3">
        <?php if(isset($banner)): ?>
            <?php echo $__env->make('partials.input',['class'=>"col-12", 'ftype'=>'input','name'=>"Name",'id'=>"name",'placeholder'=>"Enter banner name",'required'=>true, 'value'=>$banner->name], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('partials.input',['class'=>"col-12", 'ftype'=>'input','name'=>"Name",'id'=>"name",'placeholder'=>"Enter banner name",'required'=>true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <?php if(isset($banner)): ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Type",'id'=>"type",'placeholder'=>"Select type",'data'=>['Vendor', 'Blog'],'required'=>true, 'value'=>$banner->type], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Type",'id'=>"type",'placeholder'=>"Select type",'data'=>['Vendor', 'Blog'],'required'=>true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <?php if(isset($banner) && $banner->type == 0): ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Vendor",'id'=>"vendor_id",'placeholder'=>"Select restaurant",'data'=>$restaurants,'required'=>false, 'value'=>$banner->vendor_id ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Page",'id'=>"page_id",'placeholder'=>"Select page",'data'=>$pages,'required'=>false, 'value'=>$banner->page_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(isset($banner) && $banner->type == 1): ?>
        <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Vendor",'id'=>"vendor_id",'placeholder'=>"Select restaurant",'data'=>$restaurants,'required'=>false, 'value'=>$banner->vendor_id ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Page",'id'=>"page_id",'placeholder'=>"Select page",'data'=>$pages,'required'=>false, 'value'=>$banner->page_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Vendor",'id'=>"vendor_id",'placeholder'=>"Select restaurant",'data'=>$restaurants,'required'=>false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('partials.select', ['class'=>"col-12",'name'=>"Page",'id'=>"page_id",'placeholder'=>"Select page",'data'=>$pages,'required'=>false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="input-daterange datepicker row align-items-center" style="margin-left: 15px;">
           <div class="form-group">
                <label class="form-control-label"><?php echo e(__('Active from')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <?php if(isset($banner)): ?>
                        <input name="active_from" class="form-control" placeholder="<?php echo e(__('Active from')); ?>" value="<?php echo e(old('active_from', $banner->active_from)); ?>" type="text">
                    <?php else: ?>
                        <input name="active_from" class="form-control" placeholder="<?php echo e(__('Active from')); ?>" type="text">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-daterange datepicker row align-items-center" style="margin-left: 15px;">
           <div class="form-group">
                <label class="form-control-label"><?php echo e(__('Active to')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <?php if(isset($banner)): ?>
                        <input name="active_to" class="form-control" placeholder="<?php echo e(__('Active to')); ?>" value="<?php echo e(old('active_to', $banner->active_to)); ?>" type="text">
                    <?php else: ?>
                        <input name="active_to" class="form-control" placeholder="<?php echo e(__('Active to')); ?>" type="text">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php if(isset($banner)): ?>
            <?php echo $__env->make('partials.images',['image'=>['name'=>'banner_image','label'=>__('Image'),'value'=>$banner->imgm,'style'=>'width: 200px; height: 100px;']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('partials.images',['image'=>['name'=>'banner_image','label'=>__('Image'),'value'=>'https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg','style'=>'width: 200px; height: 200px;']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\banners\form.blade.php ENDPATH**/ ?>