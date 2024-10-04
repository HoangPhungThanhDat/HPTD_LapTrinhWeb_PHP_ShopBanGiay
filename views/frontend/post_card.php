<?php foreach ($list_post as $post): ?>
<div class="col-md-3">
    <div class="card mb-4">
        <div class="position-relative">
            <img src="public/images/post/<?=$post['thumbnail']; ?>" class="card-img-top" alt="<?=$post['title']; ?>">
            <span class="badge bg-danger position-absolute top-0 start-0 m-2"><?= date('d/m/Y', strtotime($post['created_at'])); ?></span>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $post['title']; ?></h5>
            <a href="index.php?option=post_detail&slug=<?=$post['slug'];?>" class="btn btn-link p-0">Đọc tiếp »</a>
        </div>
    </div>
</div>
<?php endforeach; ?>