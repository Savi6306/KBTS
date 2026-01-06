<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Status Updated</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f3f4f6; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 8px; overflow: hidden;">

        <!-- Header -->
        <div style="background: #7C3AED; color: white; padding: 18px;">
            <h2 style="margin: 0;">Ticket Status Updated</h2>
        </div>

        <!-- Body -->
        <div style="padding: 20px;">
            <p>Hello {{ $notifiable->name }},</p>

            <p>{{ $message }}</p>

            <h3 style="margin-top: 20px;">Ticket Details:</h3>

            <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
            <p><strong>Current Status:</strong> {{ $ticket->status }}</p>

            @if ($ticket->close_reason)
                <p>
                    <strong>Close Reason:</strong><br>
                    <span style="background: #fce7f3; padding: 8px; border-radius: 6px; display: inline-block;">
                        {{ $ticket->close_reason }}
                    </span>
                </p>
            @endif

            <a href="{{ url('/user/tickets/'.$ticket->id) }}"
               style="display: inline-block; margin-top: 15px; padding: 10px 16px; background: #7C3AED; color: white; text-decoration: none; border-radius: 6px;">
                View Ticket
            </a>

            <p style="margin-top: 25px;">Thanks,<br>Kintena Support Team</p>
        </div>

    </div>
</body>
</html>
