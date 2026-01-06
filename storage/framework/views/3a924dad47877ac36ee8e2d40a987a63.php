

<?php $__env->startSection('title','Tickets'); ?>

<?php $__env->startSection('content'); ?>

<h2 class="fw-bold mb-3">All Tickets</h2>

<div class="admin-card mb-4 p-3">

<form method="GET" class="row g-3">

    
    <div class="col-md-3">
        <input type="text" name="q" class="form-control"
               placeholder="Search subject or user..."
               value="<?php echo e(request('q')); ?>">
    </div>

    
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="New" <?php echo e(request('status')=='New'?'selected':''); ?>>New</option>
            <option value="In Progress" <?php echo e(request('status')=='In Progress'?'selected':''); ?>>In Progress</option>
            <option value="Resolved" <?php echo e(request('status')=='Resolved'?'selected':''); ?>>Resolved</option>
            <option value="Closed" <?php echo e(request('status')=='Closed'?'selected':''); ?>>Closed</option>
        </select>
    </div>

    
    <div class="col-md-2">
        <select name="priority" class="form-select">
            <option value="">Priority</option>
            <option value="High" <?php echo e(request('priority')=='High'?'selected':''); ?>>High</option>
            <option value="Medium" <?php echo e(request('priority')=='Medium'?'selected':''); ?>>Medium</option>
            <option value="Low" <?php echo e(request('priority')=='Low'?'selected':''); ?>>Low</option>
        </select>
    </div>

    
    <div class="col-md-2">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>" 
                    <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                    <?php echo e($cat->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-3">
        <select name="agent" class="form-select">
            <option value="">All Agents</option>
            <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($ag->id); ?>" 
                    <?php echo e(request('agent')==$ag->id?'selected':''); ?>>
                    <?php echo e($ag->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

    
    <div class="col-md-2">
        <a href="<?php echo e(route('admin.tickets.index')); ?>" class="btn btn-secondary w-100">
            Reset
        </a>
    </div>

</form>

</div>



<div class="admin-card p-0">
<table class="table table-hover align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>User</th>
            <th>Agent</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Category</th>
            <th>Created</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>#<?php echo e($t->id); ?></td>

            <td class="fw-semibold"><?php echo e($t->subject); ?></td>

            <td title="<?php echo e($t->user->email); ?>">
                <?php echo e($t->user->name); ?>

            </td>

            <td>
                <span class="badge bg-secondary">
                    <?php echo e($t->agent->name ?? 'Unassigned'); ?>

                </span>
            </td>

            
            <td>
                <span class="badge 
                    <?php if($t->status=='New'): ?> bg-info
                    <?php elseif($t->status=='In Progress'): ?> bg-warning text-dark
                    <?php elseif($t->status=='Resolved'): ?> bg-success
                    <?php else: ?> bg-danger <?php endif; ?>">
                    <?php echo e($t->status); ?>

                </span>
            </td>

            
            <td>
                <span class="badge 
                    <?php if($t->priority=='High'): ?> bg-danger
                    <?php elseif($t->priority=='Medium'): ?> bg-warning text-dark
                    <?php else: ?> bg-success <?php endif; ?>">
                    <?php echo e($t->priority); ?>

                </span>
            </td>

            
            <td>
                <span class="badge bg-dark">
                    <?php echo e($t->category->name ?? '—'); ?>

                </span>
            </td>

            <td><?php echo e($t->created_at->format('d M, Y')); ?></td>

            <td>
                <a href="<?php echo e(route('admin.tickets.show',$t->id)); ?>"
                   class="btn btn-sm btn-outline-primary">
                   View
                </a>
            </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="9" class="text-center text-muted py-4">
                No tickets found.
            </td>
        </tr>
    <?php endif; ?>

    </tbody>

</table>

<div class="p-3">
    <?php echo e($tickets->links()); ?>

</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>