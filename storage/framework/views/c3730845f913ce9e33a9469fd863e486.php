

<?php $__env->startSection('title','Tickets'); ?>

<?php $__env->startSection('content'); ?>

<style>
    body {
        background: #f4f6f9;
    }

    .ticket-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }

    thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }

    tbody tr:hover {
        background: #f8f9fc;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-new { background:#e8f0fe; color:#1a73e8; }
    .status-progress { background:#fff6db; color:#b7791f; }
    .status-resolved { background:#e6f6e9; color:#1b8f3a; }
    .status-closed { background:#fde7e9; color:#d93025; }

    .priority-high { color:#d93025; font-weight:700; }
    .priority-medium { color:#ef6c00; font-weight:700; }
    .priority-low { color:#1b8f3a; font-weight:700; }

    .btn-view {
        background: #4f46e5;
        border: none;
        color: white;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
    }
    .btn-view:hover {
        background: #4338ca;
    }

    .badge-admin {
        background: #1d4ed8;
        color: #fff;
        padding: 3px 10px;
        border-radius: 30px;
        font-size: 11px;
    }
</style>

<h3 class="fw-bold mb-3">Assigned Tickets</h3>


<div class="ticket-card mb-3">

<form method="GET" class="row g-3">

    
    <div class="col-md-3">
        <input type="text" name="search" class="form-control"
               placeholder="Search subject..."
               value="<?php echo e(request('search')); ?>">
    </div>

    
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($st); ?>" <?php echo e(request('status')==$st?'selected':''); ?>>
                    <?php echo e($st); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-2">
        <select name="priority" class="form-select">
            <option value="">All Priority</option>
            <option value="High" <?php echo e(request('priority')=='High'?'selected':''); ?>>High</option>
            <option value="Medium" <?php echo e(request('priority')=='Medium'?'selected':''); ?>>Medium</option>
            <option value="Low" <?php echo e(request('priority')=='Low'?'selected':''); ?>>Low</option>
        </select>
    </div>

    
    <div class="col-md-2">
        <input type="date" name="from" class="form-control"
               value="<?php echo e(request('from')); ?>">
    </div>

    
    <div class="col-md-2">
        <input type="date" name="to" class="form-control"
               value="<?php echo e(request('to')); ?>">
    </div>

    <div class="col-md-1">
        <button class="btn btn-primary w-100">Go</button>
    </div>

</form>

</div>


<div class="ticket-card">

    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned By</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>

        <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>

                <td>#<?php echo e($t->id); ?></td>

                <td class="fw-semibold">
                    <?php echo e($t->subject); ?>

                </td>

                
                <td>
                    <span data-bs-toggle="tooltip" title="<?php echo e($t->user->email); ?>">
                        <?php echo e($t->user->name); ?>

                    </span>
                </td>

                
                <td>
                    <?php echo e($t->category->name ?? '—'); ?>

                </td>

                
                <td>
                    <span class="status-badge
                        <?php echo e($t->status=='New'?'status-new':''); ?>

                        <?php echo e($t->status=='In Progress'?'status-progress':''); ?>

                        <?php echo e($t->status=='Resolved'?'status-resolved':''); ?>

                        <?php echo e($t->status=='Closed'?'status-closed':''); ?>">
                        <?php echo e($t->status); ?>

                    </span>
                </td>

                
                <td>
                    <span class="
                        <?php echo e($t->priority=='High'?'priority-high':''); ?>

                        <?php echo e($t->priority=='Medium'?'priority-medium':''); ?>

                        <?php echo e($t->priority=='Low'?'priority-low':''); ?>">
                        <?php echo e($t->priority); ?>

                    </span>
                </td>

                
                <td>
    <span class="badge-admin">
        <?php echo e($t->agent_id ? 'Admin' : 'Admin'); ?>

    </span>
</td>

                <td class="text-end">
                    <a href="<?php echo e(route('agent.tickets.show',$t->id)); ?>" class="btn-view btn-sm">
                        View
                    </a>
                </td>

            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    No tickets found.
                </td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="mt-3">
        <?php echo e($tickets->links()); ?>

    </div>

</div>


<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('agent.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/agent/tickets/index.blade.php ENDPATH**/ ?>