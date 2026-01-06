<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Ticket Submitted</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f3f4f6; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; border-radius: 8px; overflow: hidden;">

        <div style="background: #1E3A8A; color: white; padding: 18px;">
            <h2 style="margin: 0;">New Support Ticket</h2>
        </div>

        <div style="padding: 20px;">
            <p>Hello {{ $notifiable->name }},</p>

            <p>A new support ticket has been created:</p>

            <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
            <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
            <p><strong>Status:</strong> {{ $ticket->status }}</p>

            <a href="{{ url('/admin/tickets/'.$ticket->id) }}"
                style="display: inline-block; margin-top: 15px; padding: 10px 16px; background: #1E3A8A; color: white; text-decoration: none; border-radius: 6px;">
                View Ticket
            </a>

            <p style="margin-top: 25px;">Thank you,<br>Kintena Support Team</p>
        </div>

    </div>
</body>
</html>
