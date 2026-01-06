

<?php $__env->startSection('title','Create Category'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Create Category</h3>


<?php if(session('success')): ?>
<div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>


<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div><?php echo e($error); ?></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" value="<?php echo e(old('icon')); ?>">
        <small class="text-muted">Example: fa fa-user, bi bi-ticket</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4"><?php echo e(old('description')); ?></textarea>
    </div>

    
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary px-4">Save</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>