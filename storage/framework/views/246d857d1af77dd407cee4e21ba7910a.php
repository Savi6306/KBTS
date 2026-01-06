

<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* ======== ADMIN DASHBOARD PREMIUM STYLES ======== */

    .admin-header {
        background:#1b2533;
        padding: 25px;
        border-radius: 14px;
        color: white;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        margin-bottom: 25px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: 0.3s;
        border: 1px solid #eef2ff;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .stat-icon {
        font-size: 40px;
        opacity: .1;
        position: absolute;
        right: 18px;
        top: 12px;
    }

    .stat-title {
        font-size: 14px;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 800;
        margin-top: 5px;
    }

    .admin-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        border: 1px solid #e8eaff;
    }
</style>



<div class="admin-header">
    <h2 class="fw-bold mb-1">Welcome, Admin 👋</h2>
    <p class="m-0">Here is your system overview and analytics.</p>
</div>



<div class="row row-cols-1 row-cols-md-5 g-4">

    <div class="col">
        <div class="stat-card position-relative h-100">
            <i class="bi bi-ticket stat-icon"></i>
            <div class="stat-title">Total Tickets</div>
            <div class="stat-number text-primary"><?php echo e($totalTickets); ?></div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card position-relative h-100">
            <i class="bi bi-hourglass-split stat-icon"></i>
            <div class="stat-title">Open Tickets</div>
            <div class="stat-number text-warning"><?php echo e($openTickets); ?></div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card position-relative h-100">
            <i class="bi bi-check2-circle stat-icon"></i>
            <div class="stat-title">Resolved Tickets</div>
            <div class="stat-number text-success"><?php echo e($resolvedTickets); ?></div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card position-relative h-100">
            <i class="bi bi-exclamation-triangle stat-icon"></i>
            <div class="stat-title">High Priority (Open)</div>
            <div class="stat-number text-danger"><?php echo e($highPriorityOpen ?? 0); ?></div>

            <small class="text-muted">Auto-escalated after 7 days</small>
        </div>
    </div>

    <div class="col">
        <div class="stat-card position-relative h-100">
            <i class="bi bi-people stat-icon"></i>
            <div class="stat-title">Registered Users</div>
            <div class="stat-number text-danger"><?php echo e($users); ?></div>
        </div>
    </div>

</div>


<div class="row mt-4 g-4">

    
    <div class="col-md-8">
        <div class="admin-card">
            <h5 class="fw-bold mb-3">📊 Monthly Tickets Overview</h5>
            <canvas id="ticketChart" height="120"></canvas>
        </div>
    </div>

    
    <div class="col-md-4">
        <div class="admin-card">
            <h5 class="fw-bold mb-3">🔥 Priority Breakdown</h5>
            <canvas id="priorityChart" height="180"></canvas>
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // MONTHLY CHART
    new Chart(document.getElementById('ticketChart'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months, 15, 512) ?>,
            datasets: [{
                label: 'Tickets',
                data: <?php echo json_encode($ticketCounts, 15, 512) ?>,
                borderWidth: 3,
                borderColor: '#0061f2',
                backgroundColor: 'rgba(0,97,242,0.15)',
                tension: 0.4
            }]
        }
    });

    // PRIORITY PIE
    new Chart(document.getElementById('priorityChart'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($priorityLabels, 15, 512) ?>,
            datasets: [{
                data: <?php echo json_encode($priorityData, 15, 512) ?>,
                backgroundColor: ['#ff7675','#fdcb6e','#00b894'],
            }]
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>