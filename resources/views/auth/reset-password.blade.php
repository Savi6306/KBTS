<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card shadow-lg p-4" style="width: 420px; border-radius: 15px;">

        <h3 class="text-center fw-bold mb-3">Reset Password</h3>
        <p class="text-center text-muted mb-4">Enter your new password below.</p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="{{ old('email', request()->email) }}"
                    required 
                    autofocus
                >
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control"
                    required
                >
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="form-control"
                    required
                >
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button with Loader -->
            <button 
                id="resetBtn"
                type="submit"
                class="btn btn-primary w-100 d-flex justify-content-center align-items-center fw-semibold"
                style="padding: 10px; border-radius: 8px;">
                
                <span id="resetText">Reset Password</span>
                
                <span id="resetLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>

            </button>

        </form>

    </div>

</div>

<script>
document.querySelector("form").addEventListener("submit", function () {
    const btn = document.getElementById("resetBtn");
    const text = document.getElementById("resetText");
    const loader = document.getElementById("resetLoader");

    btn.disabled = true;
    text.textContent = "Please wait...";
    loader.classList.remove("d-none");
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
