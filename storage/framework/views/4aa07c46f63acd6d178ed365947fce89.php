

<?php $__env->startSection('title','Users'); ?>

<?php $__env->startSection('content'); ?>

<h2 class="fw-bold mb-3">Users</h2>

<a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary mb-3">
    + Add User
</a>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="admin-card">
    <table class="table align-middle table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($u->id); ?></td>
                <td><?php echo e($u->name); ?></td>
                <td><?php echo e($u->email); ?></td>
                <td><?php echo e($u->created_at->format('d M Y')); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.users.edit',$u->id)); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>

                    <form action="<?php echo e(route('admin.users.destroy',$u->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($users->links()); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/users/index.blade.php ENDPATH**/ ?>