<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Create Account</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Full Name --}}
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" 
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Role Dropdown (User / Agent) --}}
                        <div class="mb-3">
                            <label class="form-label">Register As</label>
                            <select name="role" class="form-select" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agent</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        {{-- Submit Button --}}
                        <button class="btn btn-primary w-100 d-flex justify-content-center align-items-center" id="registerBtn">
                            <span id="registerText">Register</span>
                            <span id="registerLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>
                        </button>

                        <p class="text-center mt-3">
                            Already registered? 
                            <a href="{{ route('login') }}">Login</a>
                        </p>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<script>
document.querySelector("form").addEventListener("submit", function() {

    const btn = document.getElementById("registerBtn");
    const text = document.getElementById("registerText");
    const loader = document.getElementById("registerLoader");

    btn.disabled = true;
    text.textContent = "Please wait...";
    loader.classList.remove("d-none");
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
