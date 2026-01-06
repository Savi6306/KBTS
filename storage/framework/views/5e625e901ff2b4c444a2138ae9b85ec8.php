

<?php $__env->startSection('title','Categories'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Categories</h3>

<a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary mb-3">+ Add Category</a>

<?php if(session('success')): ?>
<div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Icon</th>
            <th>Description</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($cat->id); ?></td>
            <td><?php echo e($cat->name); ?></td>
            <td><?php echo e($cat->icon); ?></td>
            <td><?php echo e($cat->description); ?></td>
            <td>
                <span class="badge bg-<?php echo e($cat->status == 'Active' ? 'success' : 'secondary'); ?>">
                    <?php echo e($cat->status); ?>

                </span>
            </td>
            <td>
                <a href="<?php echo e(route('admin.categories.edit', $cat->id)); ?>"
                   class="btn btn-sm btn-info">Edit</a>

                <form action="<?php echo e(route('admin.categories.destroy', $cat->id)); ?>"
                      method="POST"
                      class="d-inline">
                    <?php echo csrf_field(); ?> 
                    <?php echo method_field('DELETE'); ?>
                    
                    <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo e($categories->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>