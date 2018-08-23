<?php $__env->startSection('content'); ?>
<!-- book category page-->
<div class="admin-book-category">
    <div class="first-row">
        <div class="user-sections">
            <div class="unit active" data-attr="user-general">
                <a href="#">Created books</a>
            </div>
            <div class="unit" data-attr="user-password">
                <a href="#">submitted books</a>
            </div>
        </div>
    </div>
    <div class="second-row">
        <div class="created-book">
        	<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class=" row item">
                <div class="edit-delete">
                    <div class="edit"><i class="fas fa-eye"></i></div>
                </div>
                <div class="image">
                	<?php if(substr($val->ebook_logo, 0, 4) == "http"): ?>
                        <img src="<?php echo e($val->ebook_logo); ?>" alt="img1" />
                    <?php else: ?>
                        <img src="/uploads/ebook_logo/<?php echo e($val->ebook_logo); ?>" alt="img1" />
                    <?php endif; ?>
                </div>
                <div class="title"><?php echo e($val->ebooktitle); ?>: <?php echo e($val->subtitle); ?></div>
                <div class="writer"><?php if(isset($val->publisher)): ?><?php echo e($val->publisher); ?><?php else: ?> Publisher <?php endif; ?></div>
                <input type="button" value="APPROVE"/>
                <label>DECLINE</label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="submitted-book">
        </div>
    </div>
</div>
<!-- end admin listing page-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<script type="text/javascript">
	$(".user-sections .unit").click(function(){
		$(".plan-listing").hide();
		$(".user-sections .unit").removeClass("active");
		$(this).addClass("active");
        var dataAttr=$(this).attr("data-attr");
		$(".user-general,.user-password,.user-subscription").removeClass("active");
		$("."+dataAttr).addClass("active");
		$("."+dataAttr).removeAttr("style");
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>