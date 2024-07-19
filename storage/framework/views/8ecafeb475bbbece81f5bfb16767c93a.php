

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Events</h1>
    <form id="search-form" method="GET" action="<?php echo e(route('events.index')); ?>">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="search" placeholder="Search events name">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="start_date">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="end_date">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <ul class="list-group">
        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item">
                <h5><?php echo e($event->name); ?></h5>
                <p><strong>Start Date:</strong> <?php echo e($event->start_date); ?></p>
                <p><strong>End Date:</strong> <?php echo e($event->end_date); ?></p>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <div class="mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
                <?php if($events->onFirstPage()): ?>
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($events->previousPageUrl()); ?>" aria-label="Previous">Previous</a>
                    </li>
                <?php endif; ?>

                <?php if($events->hasMorePages()): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($events->nextPageUrl()); ?>" aria-label="Next">Next</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\laraveltest11\resources\views/events/index.blade.php ENDPATH**/ ?>