<!DOCTYPE html>
<html>
<head>
    <title>Ticket Notification</title>
</head>
<body>
    <h3>New Ticket is Created</h3>
    <p>Ticket No. {{ $data['ticketNo'] }}</p>
    <p>Click the following link to view & assign the ticket:</p>
    <a href="{{ $data['ticketLink'] }}">View Ticket</a>
</body>
</html>
