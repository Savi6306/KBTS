<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card shadow-lg p-4" style="width: 430px; border-radius: 18px;">

        <h3 class="text-center fw-bold mb-2">Confirm Password</h3>

        <p class="text-center text-muted mb-4">
            This is a secure area. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input 
                    type="password"
                    name="password"
                    class="form-control"
                    required
                    autofocus
                >

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Button -->
            <button 
                type="submit"
                class="btn btn-primary w-100 fw-semibold"
                style="padding: 10px; border-radius: 10px;">
                Confirm Password
            </button>

        </form>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
