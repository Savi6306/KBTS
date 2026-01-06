<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Ticket Reply</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f3f4f6; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; border-radius: 8px; overflow: hidden;">

        <div style="background: #2563EB; color: white; padding: 18px;">
            <h2 style="margin: 0;">New Reply on Your Ticket</h2>
        </div>

        <div style="padding: 20px;">
            <p>Hello {{ $notifiable->name }},</p>

            <p>Your support ticket has received a new reply:</p>

            <div style="background: #eef2ff; padding: 15px; border-left: 4px solid #2563EB;">
                {{ $reply->content }}
            </div>

            <p><strong>Ticket Subject:</strong> {{ $ticket->subject }}</p>

            <a href="{{ url('/user/tickets/'.$ticket->id) }}"
                style="display: inline-block; margin-top: 15px; padding: 10px 16px; background: #2563EB; color: white; text-decoration: none; border-radius: 6px;">
                View Ticket
            </a>

            <p style="margin-top: 25px;">Thank you,<br>Kintena Support Team</p>
        </div>

    </div>
</body>
</html>
