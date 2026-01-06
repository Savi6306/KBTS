

<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>

<div class="admin-card">
    <h3 class="fw-bold mb-3">Edit User</h3>

    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e($user->name); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Role</label>
            <select name="role" class="form-select">
                <option value="user" <?php echo e($user->role=='user'?'selected':''); ?>>User</option>
                <option value="agent" <?php echo e($user->role=='agent'?'selected':''); ?>>Agent</option>
                <option value="admin" <?php echo e($user->role=='admin'?'selected':''); ?>>Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>