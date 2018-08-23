<?php $__env->startSection('template_title'); ?>
  Showing Subscription Plans
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form method="GET" action="<?php echo e(url('/admin/plans')); ?>" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
    <div class="search-section">
        <div class="search-icon">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo e(request('search')); ?>">
    </div>
    </form>
    <div class="sorting-section">
        <div class="sorting-left">
            <!-- <select id="userSorting">
                <option>A-Z</option>
                <option>B-Z</option>
                <option>C-Z</option>
                <option>D-Z</option>
                <option>E-Z</option>
                <option>F-Z</option>
            </select> -->
        </div>
        <!-- <div class="sorting-right">
            <a href="<?php echo e(url('/admin/plans/create')); ?>">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <label>Add Plan</label>
            </a>
        </div> -->
    </div>
        <div class="listing">
            <div class="listing-1">Name</div>
            <div class="listing-2">Amount</div>
            <div class="listing-2">Status</div>
            <div class="listing-4">
                <div class="edit">Action</div>
            </div>
        </div>
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="listing">
                        <div class="listing-1"><?php echo e($item->name); ?></div>
                        <div class="listing-2"><?php echo e($item->amount); ?></div>
                        <div class="listing-2"><?php echo e($item->status); ?></div>
                        <div class="listing-4">
                            <div class="edit">
                                <a href="<?php echo e(url('/admin/plans/' . $item->id . '/edit')); ?>" title="Edit Category">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            <form method="POST" action="<?php echo e(url('/admin/plans' . '/' . $item->id)); ?>" accept-charset="UTF-8" style="display:inline">
                                <?php echo e(method_field('DELETE')); ?>

                                <?php echo e(csrf_field()); ?>

                                <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Plan' data-message = 'Are you sure you want to delete this Plan ?'><i class="far fa-trash-alt"></i></div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <span id="user_count"></span>
        <span id="user_pagination">
            <?php echo $plans->appends(['search' => Request::get('search')])->render(); ?>

        </span>
    </div>
    <?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('scripts.delete-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('scripts.save-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>