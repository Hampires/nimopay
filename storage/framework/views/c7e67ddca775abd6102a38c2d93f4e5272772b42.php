<div class="container">
    <div class="row blog">
        <div class="col-md-12">
            <div id="blogCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <?php if(count($banners) <= 3): ?>
                                <?php for($i = 0; $i < count($banners); $i++): ?>
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="card mb-4 mb-xl-0 bg-secondary">
                                            <img src="<?php echo e($banners[$i]->imgm); ?>"  alt="..."/>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php else: ?>
                                <?php for($i = 0; $i < 3; $i++): ?>
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="card mb-4 mb-xl-0 bg-secondary">
                                            <img src="<?php echo e($banners[$i]->imgm); ?>" width="401px" height="170px" alt="..."/>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(count($banners) <= 3): ?>
                        <div class="carousel-item">
                            <div class="row">
                                <?php for($i = 0; $i < count($banners); $i++): ?>
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="card mb-4 mb-xl-0 bg-secondary">
                                            <img src="<?php echo e($banners[$i]->imgm); ?>" width="401px" height="170px" alt="..."/>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php elseif(count($banners) > 3 && count($banners) <= 6): ?>
                        <div class="carousel-item">
                            <div class="row">
                                <?php for($i = 3; $i < count($banners); $i++): ?>
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="card mb-4 mb-xl-0 bg-secondary">
                                            <img src="<?php echo e($banners[$i]->imgm); ?>" width="401px" height="170px" alt="..."/>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php elseif(count($banners) > 6): ?>
                        <?php for($i = 3; $i < count($banners); $i++): ?>
                            <?php if($i % 3 == 0): ?>
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php if(count($banners) - $i >= 3): ?>
                                            <?php for($j = $i; $j <= $i + 2 ; $j++): ?>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="card mb-4 mb-xl-0 bg-secondary">
                                                        <img src="<?php echo e($banners[$j]->imgm); ?>" width="401px" height="170px" alt="..."/>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            <?php for($j = $i; $j < $i + count($banners) - $i ; $j++): ?>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="card mb-4 mb-xl-0 bg-secondary">
                                                        <img src="<?php echo e($banners[$j]->imgm); ?>" width="401px" height="170px" alt="..."/>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
                <a class="carousel-control-prev" href="#blogCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only bg-primary">Previous</span>
                </a>
                <a class="carousel-control-next" href="#blogCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\Users\pc\Documents\Laravel[WORKSPACE]\nimopay\resources\views\restorants\partials\banners.blade.php ENDPATH**/ ?>