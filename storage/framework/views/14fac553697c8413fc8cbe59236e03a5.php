

<?php $__env->startSection('title', 'Create Ticket'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .ticket-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    }

    .ticket-title {
        font-size: 24px;
        font-weight: 700;
        color: #23428c;
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #244c9c;
    }

    .form-control, .form-select {
        border-radius: 10px;
        height: 48px;
    }

    textarea.form-control {
        height: auto;
        min-height: 130px;
    }

    .submit-btn {
        background: #0d6efd;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s;
    }

    .submit-btn:hover {
        background: #004bca;
    }
</style>


<div class="ticket-card">

    <div class="ticket-title">Create New Ticket</div>
    <p class="text-muted mb-4">Fill in the details and our support team will assist you shortly.</p>

    <form method="POST" action="<?php echo e(route('user.tickets.store')); ?>">
        <?php echo csrf_field(); ?>

        
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
 
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            <option value="">Select Category</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

        
        <div class="mb-3">
            <label class="form-label">Priority</label>
            <select name="priority" class="form-select">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                <option value="Critical">Critical</option>
            </select>
        </div>

        
        <button class="submit-btn mt-2">Submit Ticket</button>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/user/tickets/create.blade.php ENDPATH**/ ?>