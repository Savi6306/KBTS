<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    
    <div class="card shadow-lg p-4" style="width: 430px; border-radius: 18px;">

        <h3 class="text-center fw-bold mb-2">Verify Your Email</h3>

        <p class="text-center text-muted mb-4">
            Thanks for signing up! Please check your email to verify your account.
            <br>If you didn’t receive the email, you can request a new one.
        </p>

        <!-- SUCCESS MESSAGE -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success text-center mb-3">
                A new verification link has been sent to your email.
            </div>
        @endif

        <!-- RESEND EMAIL FORM -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button 
                type="submit"
                class="btn btn-primary w-100 fw-semibold mb-3"
                style="padding: 10px; border-radius: 10px;">
                Resend Verification Email
            </button>
        </form>

        <!-- LOGOUT FORM -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button 
                type="submit"
                class="btn btn-outline-secondary w-100 fw-semibold"
                style="padding: 10px; border-radius: 10px;">
                Log Out
            </button>
        </form>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
