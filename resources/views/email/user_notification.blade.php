<!DOCTYPE html>
<html>
<head>
    <title>Ticket Notification</title>
</head>
<body>
    <h3>Your Ticket is Closed</h3>
    <p>Ticket No. {{ $data['ticketNo'] }}</p>
    <p>Your problem is resolved now, Agent closed the ticket. Click the below link to view more:</p>
    <a href="{{ $data['ticketLink'] }}">View Ticket</a>
</body>
</html>