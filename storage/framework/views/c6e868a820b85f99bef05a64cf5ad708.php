<!DOCTYPE html>
<html>
<head>
    <title>Event Invitation</title>
</head>
<body>
<h1>You are invited to an event!</h1>
    <p><?php echo e($invite->email); ?> has invited you to join the event.</p>
    <p><strong>Event Name:</strong> <?php echo e($invite->event->name); ?></p>
    <p><strong>Event Start Date:</strong> <?php echo e($invite->event->start_date); ?></p>
    <p><strong>Event End Date:</strong> <?php echo e($invite->event->end_date); ?></p>
</body>
</html><?php /**PATH D:\laravel\laraveltest11\resources\views/emails/invite.blade.php ENDPATH**/ ?>