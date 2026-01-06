

<?php $__env->startSection('title','Agents'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Agents</h3>

<a href="<?php echo e(route('admin.agents.create')); ?>" class="btn btn-primary mb-3">
    + Add Agent
</a>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Assigned Tickets</th>
            <th>Joined</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($agent->id); ?></td>
            <td><?php echo e($agent->name); ?></td>
            <td><?php echo e($agent->email); ?></td>

            
            <td><?php echo e($agent->assignedTickets?->count() ?? 0); ?></td>

            <td><?php echo e($agent->created_at->format('d M Y')); ?></td>

            <td>
                <a href="<?php echo e(route('admin.agents.show', $agent->id)); ?>"
                   class="btn btn-sm btn-info">
                    View
                </a>

                <form action="<?php echo e(route('admin.agents.destroy',$agent->id)); ?>"
                      method="POST" class="d-inline">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button class="btn btn-sm btn-danger"
                              onclick="return confirm('Delete agent?')">
                        Delete
                      </button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo e($agents->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/agents/index.blade.php ENDPATH**/ ?>