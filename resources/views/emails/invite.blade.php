<!DOCTYPE html>
<html>
<head>
    <title>Event Invitation</title>
</head>
<body>
<h1>You are invited to an event!</h1>
    <p>{{ $invite->email }} has invited you to join the event.</p>
    <p><strong>Event Name:</strong> {{ $invite->event->name }}</p>
    <p><strong>Event Start Date:</strong> {{ $invite->event->start_date }}</p>
    <p><strong>Event End Date:</strong> {{ $invite->event->end_date }}</p>
</body>
</html>