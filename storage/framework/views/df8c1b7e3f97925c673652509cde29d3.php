

<?php $__env->startSection('title','Create Article'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Create Article</h3>

<form method="POST" action="<?php echo e(route('admin.kb.store')); ?>">
    <?php echo csrf_field(); ?>

    <label>Title</label>
    <input type="text" name="title" class="form-control mb-3" required>

    <label>Category</label>
    <select name="category_id" class="form-select mb-3">
        <option value="">None</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label>Content</label>
    <textarea name="content" rows="6" class="form-control mb-3" required></textarea>

    <label>
        <input type="checkbox" name="is_published" checked>
        Publish
    </label>

    <button class="btn btn-primary px-4 mt-3">Save</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/kb/create.blade.php ENDPATH**/ ?>