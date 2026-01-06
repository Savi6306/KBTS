

<?php $__env->startSection('title','Profile'); ?>

<?php $__env->startSection('content'); ?>

<style>
.profile-card {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

.avatar-box {
    text-align: center;
    margin-bottom: 25px;
}

.avatar-box img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    object-fit: cover;
}

.label-text {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 13px;
    color: #0d6efd;
}

.save-btn {
    background:#0d6efd;
    color: white;
    padding: 8px 30px;
    border-radius: 8px;
    font-weight: 600;
}
.save-btn:hover {
    opacity: .9;
}
</style>

<div class="d-flex justify-content-end mb-3">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-primary"
       style="background:#0d6efd; border:none; padding:10px 20px; border-radius:8px; font-weight:600;">
        ← Back to Dashboard
    </a>
</div>

<div class="profile-card">

    <h3 class="fw-bold mb-3">Admin Profile</h3>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div class="avatar-box">
        <img src="<?php echo e($admin->avatar ? asset('uploads/admin/'.$admin->avatar) :
            'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=0b0f19&color=fff'); ?>">
        
        <div class="mt-2 text-muted">Profile Image</div>
    </div>

    <form method="POST" action="<?php echo e(route('admin.profile.update')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="row g-4">

            
            <div class="col-md-6">
                <label class="label-text">Full Name</label>
                <input type="text" name="name" class="form-control"
                       value="<?php echo e($admin->name); ?>" required>
            </div>

            
            <div class="col-md-6">
                <label class="label-text">Email Address</label>
                <input type="email" name="email" class="form-control"
                       value="<?php echo e($admin->email); ?>" required>
            </div>

            
            <div class="col-md-6">
                <label class="label-text">New Password (optional)</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Leave blank to keep old password">
            </div>

        </div>

        <button class="save-btn mt-4">Save Changes</button>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/profile.blade.php ENDPATH**/ ?>