<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
    <label for="name" class="col-md-4 control-label"><?php echo e('Name'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="<?php echo e(isset($plan->name) ? $plan->name : ''); ?>" required>
        <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
    <label for="desc" class="col-md-4 control-label"><?php echo e('Desc'); ?></label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="desc" type="textarea" id="desc" ><?php echo e(isset($plan->desc) ? $plan->desc : ''); ?></textarea>
        <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('amount') ? 'has-error' : ''); ?>">
    <label for="amount" class="col-md-4 control-label"><?php echo e('Amount'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text" id="amount" value="<?php echo e(isset($plan->amount) ? $plan->amount : ''); ?>" required>
        <?php echo $errors->first('amount', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <label for="status" class="col-md-4 control-label"><?php echo e('Status'); ?></label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status" >
    <?php $__currentLoopData = json_decode('{"Active": "Active", "Inactive": "Inactive", "Deleted": "Deleted"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($plan->status) && $plan->status == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('access_time_period') ? 'has-error' : ''); ?>">
    <label for="access_time_period" class="col-md-4 control-label"><?php echo e('Access Time Period'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="access_time_period" type="number" min="0" id="access_time_period" value="<?php echo e(isset($plan->access_time_period) ? $plan->access_time_period : ''); ?>" >
        <?php echo $errors->first('access_time_period', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('access_period_type') ? 'has-error' : ''); ?>">
    <label for="access_period_type" class="col-md-4 control-label"><?php echo e('Access Period Type'); ?></label>
    <div class="col-md-6">
        <select name="access_period_type" class="form-control" id="access_period_type" >
    <?php $__currentLoopData = json_decode('{"Month":"Month", "Year":"Year"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($plan->access_period_type) && $plan->access_period_type == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
        <?php echo $errors->first('access_period_type', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('no_of_book_download') ? 'has-error' : ''); ?>">
    <label for="no_of_book_download" class="col-md-4 control-label"><?php echo e('No Of Book Download'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="no_of_book_download" type="number" min="0" id="no_of_book_download" value="<?php echo e(isset($plan->no_of_book_download) ? $plan->no_of_book_download : ''); ?>" >
        <?php echo $errors->first('no_of_book_download', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('publish_submit_book') ? 'has-error' : ''); ?>">
    <label for="publish_submit_book" class="col-md-4 control-label"><?php echo e('Publish Submit Book'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="publish_submit_book" type="text" id="publish_submit_book" value="<?php echo e(isset($plan->publish_submit_book) ? $plan->publish_submit_book : ''); ?>" >
        <?php echo $errors->first('publish_submit_book', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('read_ebook_directly') ? 'has-error' : ''); ?>">
    <label for="read_ebook_directly" class="col-md-4 control-label"><?php echo e('Read Ebook Directly'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="read_ebook_directly" type="number" min="0" id="read_ebook_directly" value="<?php echo e(isset($plan->read_ebook_directly) ? $plan->read_ebook_directly : ''); ?>" >
        <?php echo $errors->first('read_ebook_directly', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('create_books') ? 'has-error' : ''); ?>">
    <label for="create_books" class="col-md-4 control-label"><?php echo e('Create Books'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="create_books" type="number" min="0" id="create_books" value="<?php echo e(isset($plan->create_books) ? $plan->create_books : ''); ?>" >
        <?php echo $errors->first('create_books', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('share_books') ? 'has-error' : ''); ?>">
    <label for="share_books" class="col-md-4 control-label"><?php echo e('Share Books'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="share_books" type="number" min="0" id="share_books" value="<?php echo e(isset($plan->share_books) ? $plan->share_books : ''); ?>" >
        <?php echo $errors->first('share_books', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('access_discount') ? 'has-error' : ''); ?>">
    <label for="access_discount" class="col-md-4 control-label"><?php echo e('Access Discount'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="access_discount" type="number" min="0" id="access_discount" value="<?php echo e(isset($plan->access_discount) ? $plan->access_discount : ''); ?>" >
        <?php echo $errors->first('access_discount', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="<?php echo e(isset($submitButtonText) ? $submitButtonText : 'Create'); ?>">
    </div>
</div>