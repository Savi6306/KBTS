<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    
    <div class="card shadow-lg p-4" style="width: 420px; border-radius: 15px;">
        
        <h3 class="text-center fw-bold mb-2">Forgot Password</h3>
        
        <p class="text-center text-muted mb-4">
            Enter your email and we will send a password reset link.
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="{{ old('email') }}"
                    required 
                    autofocus
                >

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                id="resetBtn"
                type="submit"
                class="btn btn-primary w-100 d-flex justify-content-center align-items-center fw-semibold"
                style="padding: 10px; border-radius: 8px;">
            
                <span id="resetText">Send Reset Link</span>
                
                <span id="resetLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>

            </button>

        </form>

    </div>

</div>

<!-- Loader Script -->
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
