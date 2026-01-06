

<?php $__env->startSection('title','Ticket #'.$ticket->id); ?>

<?php $__env->startSection('content'); ?>

<style>
    body {
        background: #f3f4f7;
    }

    .ticket-wrapper {
        max-width: 1050px;
        margin: 0 auto;
    }

    /* Top Ticket Info Card */
    .ticket-box {
        background: #ffffff;
        padding: 20px 24px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
    }

    .ticket-meta small {
        color: #6b7280;
    }

    /* Chat Area */
    .chat-container {
        background: #e5ddd5;            /* WhatsApp-like bg tone */
        border-radius: 16px;
        margin-top: 22px;
        padding: 16px;
        height: 430px;
        overflow-y: auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        border: 1px solid #dadada;
    }

    .chat-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .chat-msg {
        max-width: 70%;
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.4;
        position: relative;
    }

    /* User (Customer) bubble – left */
    .from-user {
        align-self: flex-start;
        background: #ffffff;
        border-radius: 12px 12px 12px 0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }

    /* Agent bubble – right */
    .from-agent {
        align-self: flex-end;
        background: #dcf8c6;
        border-radius: 12px 12px 0 12px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }

    .chat-name {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
        color: #374151;
    }

    .chat-time {
        font-size: 11px;
        color: #6b7280;
        margin-top: 4px;
        text-align: right;
    }

    /* Reply Box (bottom form) */
    .reply-box {
        background: #ffffff;
        border-radius: 16px;
        padding: 14px 16px;
        margin-top: 14px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

</style>

<div class="ticket-wrapper">

    
    <h3 class="fw-bold mb-3">Ticket #<?php echo e($ticket->id); ?></h3>

    
    <div class="ticket-box mb-3">

        <h5 class="fw-bold mb-1"><?php echo e($ticket->subject); ?></h5>
        <p class="mb-2"><?php echo e($ticket->description); ?></p>

        <div class="ticket-meta d-flex flex-wrap justify-content-between">
            <small>
                <strong>User:</strong> <?php echo e($ticket->user->name); ?> <br>
                <strong>Priority:</strong> <?php echo e($ticket->priority); ?>

            </small>

            <small>
                <strong>Status:</strong> <?php echo e($ticket->status); ?> <br>
                <strong>Created:</strong> <?php echo e($ticket->created_at->format('d M Y, H:i')); ?>

            </small>
        </div>

        
        <form method="POST" action="<?php echo e(route('agent.tickets.status',$ticket->id)); ?>"
              class="mt-3 d-flex gap-2">
            <?php echo csrf_field(); ?>

            <select name="status" class="form-select w-auto">
                <option <?php echo e($ticket->status=="New"?'selected':''); ?>>New</option>
                <option <?php echo e($ticket->status=="In Progress"?'selected':''); ?>>In Progress</option>
                <option <?php echo e($ticket->status=="Resolved"?'selected':''); ?>>Resolved</option>
                <option <?php echo e($ticket->status=="Closed"?'selected':''); ?>>Closed</option>
            </select>

            <button class="btn btn-primary btn-sm px-3">Update Status</button>
        </form>

    </div>


    
    <h5 class="fw-bold mb-2">Conversation</h5>

    <div class="chat-container" id="chatContainer">
        <div class="chat-list">

            
            <div class="chat-msg from-user">
                <div class="chat-name"><?php echo e($ticket->user->name); ?> (Ticket Created)</div>
                <div><?php echo e($ticket->description); ?></div>
                <div class="chat-time"><?php echo e($ticket->created_at->diffForHumans()); ?></div>
            </div>

            
            <?php $__currentLoopData = $ticket->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="chat-msg <?php echo e($reply->user->role=='agent' ? 'from-agent' : 'from-user'); ?>">
                    <div class="chat-name">
                        <?php echo e($reply->user->name); ?>

                        <?php if($reply->user->role=='agent'): ?>
                            <span class="text-muted" style="font-size:11px;">(Agent)</span>
                        <?php endif; ?>
                    </div>

                    <div><?php echo e($reply->content); ?></div>

                    <div class="chat-time">
                        <?php echo e($reply->created_at->diffForHumans()); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>


    
    <h5 class="fw-bold mt-4">Reply</h5>

    <div class="reply-box">
        <form method="POST" action="<?php echo e(route('agent.tickets.reply',$ticket->id)); ?>">
            <?php echo csrf_field(); ?>
            <textarea name="content" rows="2" class="form-control mb-2"
                      placeholder="Type your reply..." required></textarea>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success px-4">
                    Send Reply
                </button>
            </div>
        </form>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Auto-scroll chat to bottom on load
    const chatContainer = document.getElementById('chatContainer');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('agent.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/agent/tickets/show.blade.php ENDPATH**/ ?>