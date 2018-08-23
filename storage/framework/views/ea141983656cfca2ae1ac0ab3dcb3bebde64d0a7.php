<?php $__env->startSection('template_title'); ?>
  Showing Transactions
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- <?php echo e($transactions); ?> -->
<div class="listing">
            <div class="listing-1">Transaction ID</div>
                <div class="listing-2">Username</div>
                <div class="listing-3">Membership</div>
                <div class="listing-4">Total Amount</div>
            </div>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="listing">
                        <div class="listing-1"><?php echo e($transaction['transactionId']); ?></div>
                        <div class="listing-2"><?php echo e($transaction['user_record']['name']); ?></div>
                        <div class="listing-3"><?php echo e($transaction['plan_transaction']['name']); ?></div>
                        <div class="listing-4">$<?php echo e($transaction['plan_transaction']['amount']); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>