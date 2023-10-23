<!DOCTYPE html>
<html>
<head>
    <title>Ticket Notification</title>
</head>
<body>
    <h3>New Ticket is Assigned</h3>
    <p>Ticket No. {{ $data['ticketNo'] }}</p>
    <p>Click the following link to view & comment the ticket:</p>
    <a href="{{ $data['ticketLink'] }}">View Ticket</a>
</body>
</html>