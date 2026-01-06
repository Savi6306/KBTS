<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>

                <div class="card-body">

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Role: User / Agent --}}
                        <div class="mb-3">
                            <label class="form-label">Login As</label>
                            <select name="login_role" class="form-select" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="user"  {{ old('login_role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="agent" {{ old('login_role') == 'agent' ? 'selected' : '' }}>Agent</option>
                            </select>

                            @error('login_role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control" required>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label class="form-check-label" for="remember_me">Remember Me</label>
                        </div>

                        {{-- Forgot Password + Login Button --}}
                        <div class="d-flex justify-content-between align-items-center">

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif

                            <button class="btn btn-primary d-flex align-items-center" id="loginBtn">
                                <span id="loginText">Log In</span>
                                <span id="loginLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.querySelector("form").addEventListener("submit", function() {

    const btn = document.getElementById("loginBtn");
    const text = document.getElementById("loginText");
    const loader = document.getElementById("loginLoader");

    btn.disabled = true;
    text.textContent = "Please wait...";
    loader.classList.remove("d-none");

});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
