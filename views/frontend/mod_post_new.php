<?php
require_once "Models/Post.php";
$postModel = new Post();
$list_post = $postModel->getLatestPosts(4);   // Lấy bài viết mới nhất và số lượng bài viết
?>
<div data-aos="fade-up">
    <div class="container my-5">
        <h2 class="text-center mb-4">Bài viết mới nhất</h2>
        <div class="row">
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
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 text-center">
            
            <a href="index.php?option=post" class="view-all-btn">Xem thêm bài viết &gt;</a>
        </div>
    </div>
</div>