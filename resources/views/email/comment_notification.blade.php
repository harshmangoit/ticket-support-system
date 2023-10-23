<!DOCTYPE html>
<html>
<head>
    <title>Ticket Notification</title>
</head>
<body>
    <h3>New comment on the ticket</h3>
    <p>Ticket No: {{ $data['ticketNo'] }}</p>
    <p>Click the below link to view comments:</p>
    <a href="{{ $data['ticketLink'] }}">View Ticket</a>
</body>
</html>