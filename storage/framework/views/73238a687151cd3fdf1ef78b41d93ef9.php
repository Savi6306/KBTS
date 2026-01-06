

<?php $__env->startSection('title','Agent Details'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Agent: <?php echo e($user->name); ?></h3>

<div class="card p-3 mb-4">
    <h5>Email: <?php echo e($user->email); ?></h5>

    
    <h6>Assigned Tickets: <?php echo e($user->assignedTickets?->count() ?? 0); ?></h6>

    <small>Registered: <?php echo e($user->created_at->format('d M Y')); ?></small>
</div>

<h4 class="fw-bold">Tickets Assigned</h4>

<?php if(($user->assignedTickets?->count() ?? 0) === 0): ?>
    <p class="text-muted">No tickets assigned to this agent.</p>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    
    <?php $__currentLoopData = $user->assignedTickets ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($ticket->id); ?></td>
            <td><?php echo e($ticket->subject); ?></td>
            <td><?php echo e($ticket->status); ?></td>
            <td>
                <a href="<?php echo e(route('admin.tickets.show',$ticket->id)); ?>"
                   class="btn btn-sm btn-primary">
                    View Ticket
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/agents/show.blade.php ENDPATH**/ ?>