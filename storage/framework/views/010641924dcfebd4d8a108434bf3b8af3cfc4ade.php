<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">Bestsellers</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>
        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider">
        <?php if(!$bestsellers->isEmpty()): ?>
            <?php $__currentLoopData = $bestsellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                   <?php if($book->home_books->type == 'free'): ?>
                   <div class="image"><a href="<?php echo e(url('books/ebook/'.$book->home_books->id.'/'.$book->home_books->ebooktitle)); ?>">
                      <?php if(substr($book->home_books->ebook_logo, 0, 4) == "http"): ?>
                        <img src="<?php echo e($book->home_books->ebook_logo); ?>" alt="img1" />
                      <?php else: ?>
                        <img src="/uploads/ebook_logo/<?php echo e($book->home_books->ebook_logo); ?>" alt="img1" />
                      <?php endif; ?>
                   </a></div>
                   <div class="ample-button"><button>FREE</button></div>
                   <div class="title"><?php echo e($book->home_books->ebooktitle); ?></div>
                   <div class="writer"><?php echo e($book->home_books->subtitle); ?></div>
                    <div class="star-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                   <?php endif; ?>
                   <?php if($book->home_books->type == 'paid'): ?>
                   <div class="image"><a href="<?php echo e(url('books/ebook/'.$book->home_books->id.'/'.$book->home_books->ebooktitle)); ?>">
                      <?php if(substr($book->home_books->ebook_logo, 0, 4) == "http"): ?>
                        <img src="<?php echo e($book->home_books->ebook_logo); ?>" alt="img1" />
                      <?php else: ?>
                        <img src="/uploads/ebook_logo/<?php echo e($book->home_books->ebook_logo); ?>" alt="img1" />
                      <?php endif; ?>
                   </a></div>
                   <div class="ample-button"><button style="width: auto; background-color: #868686; border: #868686;">FROM $ <?php echo e($book->home_books->retailPrice); ?></button></div>
                   <div class="title"><?php echo e($book->home_books->ebooktitle); ?></div>
                   <div class="writer"><?php echo e($book->home_books->subtitle); ?></div>
                    <div class="star-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          Data not available.    
        <?php endif; ?>
    </div>
</div>