<?php echo Form::open(['route' => 'search-users', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_users']); ?>

    <?php echo csrf_field(); ?>

    <div class="search-section">
        <div class="search-icon" id="search_trigger">
            <i class="fas fa-search"></i>
        </div>
        <?php echo Form::text('user_search_box', NULL, ['id' => 'user_search_box', 'class' => 'form-control', 'placeholder' => trans('usersmanagement.search.search-users-ph'), 'aria-label' => trans('usersmanagement.search.search-users-ph'), 'required' => false]); ?>

        <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="<?php echo app('translator')->getFromJson('lusersmanagement.tooltips.clear-search'); ?>" style="display:none;">
            <i class="fa fa-times" aria-hidden="true"></i>
            <span class="sr-only">
                <?php echo app('translator')->getFromJson('lusersmanagement.tooltips.clear-search'); ?>
            </span>
        </a>
    </div>
<?php echo Form::close(); ?>    

