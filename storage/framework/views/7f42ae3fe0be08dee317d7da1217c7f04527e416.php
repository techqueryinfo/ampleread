<?php $__env->startSection('content'); ?>
<div class="ample-slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php if(!empty($banner_images)): ?>
            <?php $__currentLoopData = $banner_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($banner_image->image_name !=''): ?>
                <?php
                    $active = ($key == 0)  ? 'active' : '';
                ?>
                <div class="item <?php echo e($active); ?>">
                    <div class="ample-banner">
                        <img src="/uploads/ebook_logo/<?php echo e($banner_image->image_name); ?>"/>
                    </div>
                </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="item active">
                <div class="ample-banner">
                    <div class="ample-banner-left">
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image1.jpg"></div>
                            <div class="unit-one-two"><img src="images/image2.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image3.jpg"></div>
                            <div class="unit-one-two"><img src="images/image4.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image5.jpg"></div>
                            <div class="unit-one-two"><img src="images/image6.png"></div>
                        </div>
                    </div>
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">10 inspiring books<br>
                            for the autumn begining</div>
                        <div class="ample-banner-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            donec et quam id nunc finibus efficitur molestie</div>
                        <div class="ample-banner-button">
                            <button>Learn More</button>
                        </div>
                    </div>
                    <div class="ample-banner-mobile">
                        <div class="unit-1">
                            <img src="images/image7.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image8.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image9.jpg" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ample-banner">
                    <div class="ample-banner-left">
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image7.jpg"></div>
                            <div class="unit-one-two"><img src="images/image8.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image9.jpg"></div>
                            <div class="unit-one-two"><img src="images/image2.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image4.jpg"></div>
                            <div class="unit-one-two"><img src="images/image5.jpg"></div>
                        </div>
                    </div>
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">10 inspiring books<br>
                            for the autumn begining</div>
                        <div class="ample-banner-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            donec et quam id nunc finibus efficitur molestie</div>
                        <div class="ample-banner-button">
                            <button>Learn More</button>
                        </div>
                    </div>
                    <div class="ample-banner-mobile">
                        <div class="unit-1">
                            <img src="images/image4.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image5.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image6.png" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ample-banner">
                    <div class="ample-banner-left">
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image9.jpg"></div>
                            <div class="unit-one-two"><img src="images/image8.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image7.jpg"></div>
                            <div class="unit-one-two"><img src="images/image5.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image4.jpg"></div>
                            <div class="unit-one-two"><img src="images/image3.jpg"></div>
                        </div>

                    </div>
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">10 inspiring books<br>
                            for the autumn begining</div>
                        <div class="ample-banner-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            donec et quam id nunc finibus efficitur molestie</div>
                        <div class="ample-banner-button">
                            <button>Learn More</button>
                        </div>
                    </div>
                    <div class="ample-banner-mobile">
                        <div class="unit-1">
                            <img src="images/image1.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image2.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image1.jpg" />
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <!--<span class="glyphicon glyphicon-chevron-left"></span>-->
            <i class="fas fa-chevron-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <!--<span class="glyphicon glyphicon-chevron-right"></span>-->
            <i class="fas fa-chevron-right"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="ample-book-slot-1">
    <?php if(!$special_features->isEmpty()): ?>
        <?php $__currentLoopData = $special_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key <= 2): ?>
                <div class="slot-1">
                    <div class="e-book1">
                        <img src="<?php echo e((substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo'.$val->home_books->ebook_logo); ?>" alt="image">
                        <img src="<?php echo e((substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo'.$val->home_books->ebook_logo); ?>" alt="image">
                        <img src="<?php echo e((substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo'.$val->home_books->ebook_logo); ?>" alt="image">
                    </div>
                    <div class="heading"><?php echo e($val->home_books->ebooktitle); ?></div>
                    <div class="sub-text"><?php echo e($val->home_books->subtitle); ?></div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        Data not available !
    <?php endif; ?>
</div>
<div class="ample-book-slot-2">
    <?php if(!$special_features->isEmpty()): ?>
        <?php $__currentLoopData = $special_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key >= 3): ?>
                <div class="slot-1">
                    <div class="heading"><?php echo e($val->home_books->ebooktitle); ?></div>
                    <div class="sub-text"><?php echo e($val->home_books->subtitle); ?></div>
                    <div class="ebook">
                        <img src="<?php echo e((substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo'.$val->home_books->ebook_logo); ?>" alt=""><img src="<?php echo e((substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo'.$val->home_books->ebook_logo); ?>" alt="">
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        Data not available !
    <?php endif; ?>
</div>
<?php echo $__env->make('partials.new-release', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.best-seller', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.classic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>