<!DOCTYPE html>
<html>
<head>
    <title><?php echo $__env->yieldContent('title'); ?> - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body {
            background: #f4f7fc;
            font-family: "Inter", sans-serif;
        }

        /* =======================
           SIDEBAR 
        ========================*/
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1b2533; /* NAVY */
            position: fixed;
            left: 0;
            top: 0;
            color: #fff;
            padding: 24px 18px;
            box-shadow: 2px 0 14px rgba(0,0,0,0.10);
        }

        .sidebar h4 {
            color: #e8efff;
            margin-bottom: 28px;
            font-weight: 700;
            font-size: 20px;
        }

        .sidebar .menu a {
            display: block;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
            color: #c8d4e0;
            text-decoration: none;
            font-weight: 500;
            transition: 0.25s ease;
        }

        .sidebar .menu a:hover {
            background: #2d3e55;    /* Soft Navy hover */
            color: #ffffff;
        }

        .sidebar .menu a.active {
            background: #3d5a80;    /* Slate Blue Active */
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(61, 90, 128, 0.35);
        }


        /* =======================
           TOPBAR 
        ========================*/
        .topbar {
            position: fixed;
            left: 250px;
            right: 0;
            top: 0;
            background: white;
            padding: 14px 28px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.07);
            z-index: 999;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 64px;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid #3d5a80; /* Blue border */
        }

        .avatar-status {
            position: absolute;
            right: 0; bottom: 0;
            width: 12px; height: 12px;
            border-radius: 50%;
            background: #28a745;
            border: 2px solid #fff;
        }

        .profile-name {
            font-weight: 600;
            color: #222;
            font-size: 15px;
        }

        .dropdown-menu {
            border-radius: 12px;
            padding: 10px;
        }


        /* =======================
           CONTENT AREA 
        ========================*/
        .content-area {
            margin-left: 250px;
            padding: 35px;
            margin-top: 75px;
        }

    </style>
</head>

<body>


<div class="sidebar">
    <h4>KBTS Admin</h4>

    <div class="menu">

        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
           <i class="bi bi-speedometer me-2"></i> Dashboard
        </a>

        <a href="<?php echo e(route('admin.tickets.index')); ?>"
           class="<?php echo e(request()->routeIs('admin.tickets.*') ? 'active' : ''); ?>">
           <i class="bi bi-ticket-detailed me-2"></i> Tickets
        </a>

        <a href="<?php echo e(route('admin.users.index')); ?>"
           class="<?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
           <i class="bi bi-people me-2"></i> Users
        </a>

        <a href="<?php echo e(route('admin.agents.index')); ?>"
           class="<?php echo e(request()->routeIs('admin.agents.*') ? 'active' : ''); ?>">
           <i class="bi bi-person-vcard me-2"></i> Agents
        </a>

        <a href="<?php echo e(route('admin.kb.index')); ?>"
           class="<?php echo e(request()->routeIs('admin.kb.*') ? 'active' : ''); ?>">
           <i class="bi bi-journal-text me-2"></i> Knowledge Base
        </a>

        <a href="<?php echo e(route('admin.categories.index')); ?>"
           class="<?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
           <i class="bi bi-tags me-2"></i> Categories
        </a>

    </div>
</div>



<div class="topbar">

    <div class="dropdown">

        <a class="profile-box dropdown-toggle text-decoration-none"
           href="#" data-bs-toggle="dropdown">

            <div class="position-relative">
                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::user()->name)); ?>&background=3d5a80&color=fff"
                     class="admin-avatar">
                <span class="avatar-status"></span>
            </div>

            <span class="profile-name">
                <?php echo e(Auth::user()->name); ?>

            </span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow">

            <li>
                <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">
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
    </div>
</div>



<div class="content-area">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/layout.blade.php ENDPATH**/ ?>