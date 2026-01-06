<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - User Panel</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        /* === Modern Glass Navbar === */
       .modern-navbar {
    background: linear-gradient(90deg, #1d2671, #c33764);
    padding: 12px 0;
    backdrop-filter: blur(10px);
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}


        .modern-navbar .navbar-brand {
            font-weight: 700;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .modern-navbar .nav-link {
            color: #e9f3ff !important;
            font-weight: 500;
            margin-right: 12px;
            border-radius: 6px;
            padding: 8px 14px !important;
            transition: 0.3s ease;
        }

        .modern-navbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #fff !important;
        }

        .modern-navbar .nav-link.active {
            background: rgba(255,255,255,0.35);
            color: #fff !important;
            font-weight: 600;
        }

    </style>

</head>

<body class="bg-light">

    
    <nav class="navbar navbar-expand-lg modern-navbar">
        <div class="container">

            <a class="navbar-brand text-white" href="<?php echo e(route('user.dashboard')); ?>">
                KBTS User
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>"
                            href="<?php echo e(route('user.dashboard')); ?>">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('user.tickets.*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('user.tickets.index')); ?>">
                            My Tickets
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('user.kb.*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('user.kb.index')); ?>">
                            Knowledge Base
                        </a>
                    </li>

                </ul>

                
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        id="userDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="color: #fff; font-weight: 600;">

                            
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::user()->name)); ?>&background=ffffff&color=0d6efd&size=32"
                                class="rounded-circle me-2" width="32" height="32" alt="avatar">

                            <span><?php echo e(Auth::user()->name); ?></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                            style="border-radius: 10px; min-width: 180px;">

                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>">
                                    <i class="bi bi-person-circle me-2"></i> Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item text-danger fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </li>

                </ul>

            </div>

        </div>
    </nav>
 
    <div class="container py-4">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success mb-3">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger mb-3">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        
        <?php echo $__env->yieldContent('content'); ?>

    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\kbts\resources\views/user/layout.blade.php ENDPATH**/ ?>