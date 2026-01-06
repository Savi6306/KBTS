

<?php $__env->startSection('title', $article->title); ?>

<?php $__env->startSection('content'); ?>

<style>
    .kb-article-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    }

    .kb-article-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #23428c;
    }

    .related-box {
        margin-top: 30px;
        padding: 20px;
        border-radius: 10px;
        background: #f1f4ff;
    }
</style>

<?php echo $__env->make('chatbot.widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="d-flex justify-content-end mb-3">
    <a href="<?php echo e(route('user.kb.index')); ?>" 
       class="btn btn-primary px-4 fw-bold">
        ← Back to Knowledge Base
    </a>
</div>
<div class="kb-article-card">

    <div class="kb-article-title"><?php echo e($article->title); ?></div>

    <div class="text-muted mb-3">
        Updated: <?php echo e($article->updated_at->format('d M, Y')); ?>

    </div>

    <div class="content"><?php echo $article->content; ?></div>


    <hr>

    
    <p class="fw-bold mb-1">Was this article helpful?</p>

    <button class="btn btn-success btn-sm me-2" onclick="rateArticle(<?php echo e($article->id); ?>, 'like')">
        👍 Yes
    </button>

    <button class="btn btn-danger btn-sm" onclick="rateArticle(<?php echo e($article->id); ?>, 'dislike')">
        👎 No
    </button>

    <p class="text-muted mt-2" id="ratingMessage"></p>


    
    <div class="related-box mt-4">
        <h5 class="fw-bold mb-2">Related Articles</h5>

        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="d-block mb-1" href="<?php echo e(route('user.kb.show', $rel->slug)); ?>">
                → <?php echo e($rel->title); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<script>
    function rateArticle(id, type) {
        fetch("<?php echo e(url('/user/kb/rate')); ?>/" + id, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({ type: type })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('ratingMessage').innerHTML =
                `Thanks for your feedback! 👍 (${data.likes} likes, ${data.dislikes} dislikes)`;
        });
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kbts\resources\views/user/kb/show.blade.php ENDPATH**/ ?>