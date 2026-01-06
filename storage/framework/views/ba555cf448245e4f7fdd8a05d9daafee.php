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
        <?php if(session('status')): ?>
            <div class="alert alert-success text-center">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="<?php echo e(old('email')); ?>"
                    required 
                    autofocus
                >

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
<?php /**PATH C:\xampp\htdocs\kbts\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>