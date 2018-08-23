<?php $__env->startSection('template_title'); ?>
  Showing Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
        <div class="sorting-right">
            <a href="<?php echo e(url('/users/create')); ?>">
                <div class="circle">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
                <label>Add user</label>
            </a>
        </div>
    </div>
    <?php echo $__env->make('partials.search-users-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="listing">
            <div class="listing-1">
                <div class="image"></div>
                <div class="name">Name</div>
                <div class="sub-name">@email</div>
            </div>
            <div class="listing-2">Membership</div>
            <div class="listing-3">
                <div class="map"></div>
                <div class="name">Country</div>
            </div>
            <div class="listing-4">
                <div class="edit">Action</div>
            </div>
        </div>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="listing">
                        <div class="listing-1">
                            <div class="image"><img src="<?php echo e(($user->profile && $user->profile->avatar) ? '/uploads/avatar/'.$user->profile->avatar : '../images/image1.jpg'); ?>"></div>
                            <div class="name"><?php echo e($user->name); ?></div>
                            <div class="sub-name"><?php echo e($user->email); ?></div>
                        </div>
                        <div class="listing-2">Free Member</div>
                        <div class="listing-3">
                            <?php if($user->country): ?>
                            <div class="map"><img src="./flags/<?php echo e(strtolower($user->country->code)); ?>.png"/></div>
                            <div class="name"><?php echo e($user->country->countryname); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="listing-4">
                            <div class="edit">
                                <a href="<?php echo e(URL::to('users/' . $user->id . '/edit')); ?>" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            <?php if(!$user->isAdmin()): ?>
                                <?php echo Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>

                                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                                    <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete User' data-message = 'Are you sure you want to delete this user ?'><i class="far fa-trash-alt"></i></div>
                                <?php echo Form::close(); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <span id="user_count"></span>
        <span id="user_pagination">
            <?php echo e($users->links()); ?>

        </span>
    </div>

    <?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

    <?php echo $__env->make('scripts.delete-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    

    
        <?php echo $__env->make('scripts.search-users', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>