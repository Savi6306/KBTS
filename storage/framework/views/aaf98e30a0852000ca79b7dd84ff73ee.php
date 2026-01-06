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

                    
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        
                        <div class="mb-3">
                            <label class="form-label">Login As</label>
                            <select name="login_role" class="form-select" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="user"  <?php echo e(old('login_role') == 'user' ? 'selected' : ''); ?>>User</option>
                                <option value="agent" <?php echo e(old('login_role') == 'agent' ? 'selected' : ''); ?>>Agent</option>
                            </select>

                            <?php $__errorArgs = ['login_role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   value="<?php echo e(old('email')); ?>" required autofocus>

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control" required>

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label class="form-check-label" for="remember_me">Remember Me</label>
                        </div>

                        
                        <div class="d-flex justify-content-between align-items-center">

                            <?php if(Route::has('password.request')): ?>
                                <a href="<?php echo e(route('password.request')); ?>">
                                    Forgot Password?
                                </a>
                            <?php endif; ?>

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
<?php /**PATH C:\xampp\htdocs\kbts\resources\views/auth/login.blade.php ENDPATH**/ ?>