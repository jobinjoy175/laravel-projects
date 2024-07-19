

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Statistics</h1>
    <h2>Average Events Per User: <?php echo e($averageEventsPerUser); ?></h2>
    <h3>Events Created by Each User</h3>
    <ul class="list-group">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item">
                <strong><?php echo e($user['name']); ?>:</strong> <?php echo e($user['average']); ?> events
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\laraveltest11\resources\views/statistics/index.blade.php ENDPATH**/ ?>