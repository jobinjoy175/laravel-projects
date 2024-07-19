

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Create Event</h1>
    <form id="create-event-form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name">Event Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>

    <div id="invite_user_section" style="display: none;">
        <h2>Invite Users</h2>
        <form id="invite_user_form">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="event_id" name="event_id">
            <div class="form-group">
                <label for="email">User Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Invite</button>
        </form>

        <h3>Invited Users</h3>
        <ul id="invited-users"></ul>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    $('#create-event-form').submit(function(event) {
        event.preventDefault();
        // Date validation
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        if (new Date(startDate) > new Date(endDate)) {
            alert('End date must be greater than or equal to the start date.');
            return;
        }
        $.ajax({
            url: "<?php echo e(route('events.store')); ?>",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                console.log(response);
                if (response.success) {
                    $('#event_id').val(response.event_id);
                    $('#invite_user_section').show(); // Show the invite user section
                    alert('Event created successfully!');
                }
            },
            error: function(xhr) {
                if (xhr.status === 419) { // Laravel's CSRF error status code
                    window.location.href = "<?php echo e(route('login')); ?>";
                }
            }
        });
    });

    $('#invite_user_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo e(route('events.invite')); ?>",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#invited-users').append('<li>' + $('#email').val() + ' <button class="remove-invite" data-id="' + response.invite_id + '">Remove</button></li>');
                    $('#email').val('');
                }
            },
            error: function(xhr) {
                if (xhr.status === 419) { // Laravel's CSRF error status code
                    window.location.href = "<?php echo e(route('login')); ?>";
                }
            }
        });
    });

    $('#invited-users').on('click', '.remove-invite', function() {
        var inviteId = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('events.removeInvite')); ?>",
            method: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                invite_id: inviteId
            },
            success: function(response) {
                if (response.success) {
                    $(this).parent().remove();
                }
            }.bind(this)
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\laraveltest11\resources\views/events/create.blade.php ENDPATH**/ ?>