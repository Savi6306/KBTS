

<?php $__env->startSection('title', 'Ticket Details'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="fw-bold mb-3">Ticket #<?php echo e($ticket->id); ?></h3>


<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div><?php echo e($e); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>


<div class="card p-3 mb-4">

    <h4><?php echo e($ticket->subject); ?></h4>

    <p><?php echo e($ticket->description); ?></p>

    <p class="mb-0">
        <strong>User:</strong> <?php echo e($ticket->user->name); ?> <br>
        <strong>Email:</strong> <?php echo e($ticket->user->email); ?> <br>
        <strong>Status:</strong> <?php echo e($ticket->status); ?> <br>
        <strong>Priority:</strong> <?php echo e($ticket->priority); ?> <br>
         <strong>Category:</strong> <?php echo e($ticket->category->name ?? '—'); ?> <br>
        <strong>Created:</strong> <?php echo e($ticket->created_at->format('d M Y, H:i')); ?> <br>
        <?php if($ticket->close_reason): ?>
            <strong>Close Reason:</strong> <?php echo e($ticket->close_reason); ?>

        <?php endif; ?>
    </p>

</div>


<div class="card p-3 mb-3">
    <h5 class="fw-bold mb-2">Update Status</h5>

    <form method="POST" action="<?php echo e(route('admin.tickets.status',$ticket->id)); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-2">
            <select name="status" class="form-select w-auto">
                <option value="New" <?php echo e($ticket->status=="New"?'selected':''); ?>>New</option>
                <option value="In Progress" <?php echo e($ticket->status=="In Progress"?'selected':''); ?>>In Progress</option>
                <option value="Resolved" <?php echo e($ticket->status=="Resolved"?'selected':''); ?>>Resolved</option>
                <option value="Closed" <?php echo e($ticket->status=="Closed"?'selected':''); ?>>Closed</option>
            </select>
        </div>

        
        <?php if($ticket->status != 'Closed'): ?>
            <div class="mb-2">
                <input type="text"
                       name="close_reason"
                       class="form-control"
                       placeholder="Reason for closing (optional)">
            </div>
        <?php endif; ?>

        <button class="btn btn-primary">Update</button>
    </form>
</div>


<div class="card p-3 mb-4">
    <h5 class="fw-bold mb-2">Assign Ticket to Agent</h5>

    <form method="POST" action="<?php echo e(route('admin.tickets.assign', $ticket->id)); ?>">
        <?php echo csrf_field(); ?>

        <select name="agent_id" class="form-select w-auto mb-2">
            <option value="">-- Unassigned --</option>

            <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($ag->id); ?>"
                    <?php echo e($ticket->agent_id == $ag->id ? 'selected' : ''); ?>>
                    <?php echo e($ag->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button class="btn btn-primary">Assign</button>
    </form>
</div>


<h4 class="fw-bold mt-4 mb-2">Conversation</h4>

<?php $__empty_1 = true; $__currentLoopData = $ticket->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card p-2 mb-2">
        <strong><?php echo e($reply->user->name); ?></strong> <br>
        <div><?php echo e($reply->content); ?></div>

        
        <?php if($reply->attachments->count()): ?>
            <div class="mt-2">
                <?php $__currentLoopData = $reply->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(asset('storage/'.$att->file_path)); ?>" target="_blank">
                        📎 <?php echo e($att->original_name ?? 'Download attachment'); ?>

                    </a><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <div class="small text-muted mt-1">
            <?php echo e($reply->created_at->diffForHumans()); ?>

        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-muted">No conversation yet.</p>
<?php endif; ?>


<div class="card mt-3 p-3">
    <h5 class="fw-bold mb-2">Add Reply</h5>

    <form method="POST"
          action="<?php echo e(route('admin.tickets.reply',$ticket->id)); ?>"
          enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <textarea name="content" class="form-control mb-2"
                  placeholder="Type your reply..." required></textarea>

        <div class="mb-2">
            <label class="form-label">Attachment (optional)</label>
            <input type="file" name="attachment" class="form-control">
        </div>

        <button class="btn btn-primary">Send Reply</button>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/tickets/show.blade.php ENDPATH**/ ?>