<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Status Updated</title>
</head>
<body>

    <p>Hello {{ $ticket->user->name }},</p>

    <p>The status of your support ticket has changed.</p>

    <p>
        <strong>Ticket:</strong> {{ $ticket->title }}<br>
        <strong>Previous status:</strong> {{ $oldStatus }}<br>
        <strong>Current status:</strong> {{ $ticket->status }}
    </p>

    <p>Regards,<br>
    IT Support Team</p>

</body>
</html>
