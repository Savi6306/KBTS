

<?php $__env->startSection('title','Knowledge Base'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Knowledge Base</h3>

<a href="<?php echo e(route('admin.kb.create')); ?>" class="btn btn-primary mb-3">+ Add Article</a>

<form method="GET" class="mb-3">
    <select name="category" class="form-select w-25">
        <option value="">All Categories</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>" <?php echo e($category_id==$cat->id?'selected':''); ?>>
                <?php echo e($cat->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</form>

<?php if(session('success')): ?>
<div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Published</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($a->id); ?></td>
            <td><?php echo e($a->title); ?></td>
            <td><?php echo e($a->category->name ?? '--'); ?></td>
            <td><?php echo e($a->is_published ? 'Yes' : 'No'); ?></td>
            <td>
                <a href="<?php echo e(route('admin.kb.edit', $a->id)); ?>" class="btn btn-sm btn-info">Edit</a>

                <form action="<?php echo e(route('admin.kb.destroy', $a->id)); ?>"
                      method="POST"
                      class="d-inline">
                      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
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

<?php echo e($articles->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/kb/index.blade.php ENDPATH**/ ?>