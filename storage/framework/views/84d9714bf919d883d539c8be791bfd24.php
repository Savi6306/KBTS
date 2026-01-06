

<?php $__env->startSection('title', 'Ticket #'.$ticket->id); ?>

<?php $__env->startSection('content'); ?>

<style>

    .ticket-header-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .ticket-title {
        font-size: 22px;
        font-weight: 700;
        color: #23428c;
    }

    .ticket-meta {
        font-size: 14px;
        color: #6c757d;
        margin-top: 8px;
    }

    /* Status & Priority Badges */
    .badge-status {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-open { background:#dcf4ff; color:#0077b6; }
    .status-pending { background:#fff3cd; color:#ad8e00; }
    .status-resolved { background:#d4f8d4; color:#176c2c; }
    .status-closed { background:#ffe0e0; color:#b30000; }

    .priority-low { background:#e8f5e9; color:#2e7d32; }
    .priority-medium { background:#fff3cd; color:#ad8e00; }
    .priority-high { background:#ffe0e0; color:#b30000; }
    .priority-critical { background:#ffd6d6; color:#990000; }

    /* Chat UI */
    .chat-box {
        padding: 20px;
        border-radius: 12px;
        background: #f7faff;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.04);
        margin-bottom: 20px;
    }

    .message {
        max-width: 75%;
        padding: 12px 18px;
        margin-bottom: 15px;
        border-radius: 14px;
        position: relative;
        font-size: 15px;
    }

    .message-user {
        background: #0d6efd;
        color: white;
        margin-left: auto;
        text-align: right;
    }

    .message-agent {
        background: #ffffff;
        color: #333;
        border: 1px solid #e1e1e1;
    }

    .message-time {
        font-size: 12px;
        color: #6c757d;
        margin-top: 4px;
    }

    /* Reply Box */
    .reply-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    }

    .reply-btn {
        background: #198754;
        border: none;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 8px;
    }

    .reply-btn:hover {
        background: #0f6b40;
    }

</style>



<div class="ticket-header-card">

    <div class="ticket-title">
        Ticket #<?php echo e($ticket->id); ?> — <?php echo e($ticket->subject); ?>

    </div>

    <div class="ticket-meta">
        <span class="badge-status 
            <?php if($ticket->status=='Open'): ?> status-open
            <?php elseif($ticket->status=='Pending'): ?> status-pending
            <?php elseif($ticket->status=='Resolved'): ?> status-resolved
            <?php else: ?> status-closed <?php endif; ?>">
            <?php echo e($ticket->status); ?>

        </span>

        <span class="badge-status 
            <?php if($ticket->priority=='Low'): ?> priority-low
            <?php elseif($ticket->priority=='Medium'): ?> priority-medium
            <?php elseif($ticket->priority=='High'): ?> priority-high
            <?php else: ?> priority-critical <?php endif; ?>">
            <?php echo e($ticket->priority); ?>

        </span>
 <div class="mt-2"><strong>Category:</strong> <?php echo e($ticket->category->name ?? '—'); ?></div>
        <div class="mt-2">Created: <?php echo e($ticket->created_at->format('d M, Y')); ?></div>
    </div>
</div>



<h4 class="fw-bold mb-3">Conversation</h4>

<?php $__currentLoopData = $ticket->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card p-2 mb-2">
    <strong><?php echo e($reply->user->name); ?></strong> <br>
    <?php echo e($reply->content); ?>


    
    <?php if($reply->attachments->count()): ?>
        <div class="mt-2">
            <?php $__currentLoopData = $reply->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(asset('storage/'.$att->file_path)); ?>" target="_blank">
                    📎 <?php echo e($att->original_name ?? 'Download attachment'); ?>

                </a><br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="small text-muted mt-1"><?php echo e($reply->created_at->diffForHumans()); ?></div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<form method="POST"
      action="<?php echo e(route('user.tickets.reply', $ticket->id)); ?>"
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/user/tickets/show.blade.php ENDPATH**/ ?>