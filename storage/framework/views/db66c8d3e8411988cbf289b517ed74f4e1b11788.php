<div class="admin-edit">
    <div class="edit-two">
        <div class="unit-1">
            <div class="form-unit <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <div class="heading">Name</div>
                <div class="content">
                   <input class="form-control" name="name" type="text" id="name" value="<?php echo e(isset($category->name) ? $category->name : ''); ?>" required>
                   <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

               </div>
           </div>
       </div>
       <div class="unit-2">
        <div class="form-unit <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
            <div class="heading">Category</div>
            <div class="content">
                <select name="status" class="form-control" id="status" >
                    <?php $__currentLoopData = json_decode('{"Active": "Active", "Inactive": "Inactive", "Deleted": "Deleted"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($category->status) && $category->status == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

            </div>
        </div>
    </div>
</div>
</div>
<div class="save-cancel-btn">
    <div class="save">
        <input type="submit" value="Save" />
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>