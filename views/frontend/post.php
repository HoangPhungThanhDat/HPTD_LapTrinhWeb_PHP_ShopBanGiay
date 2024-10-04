<?php
require_once "Models/Post.php";
require_once "Models/Topic.php";
require_once "application/Pagination.php";

$post = new Post();
$topic = new Topic();

// Kiểm tra catid
$catid = isset($_REQUEST['catid']) ? $_REQUEST['catid'] : null;

$list_cat_id = array();
if ($catid !== null) {
    array_push($list_cat_id, $catid);
}
// Phân trang
$limit = 4;
$page = Pagination::pageCurrent();
$offset = Pagination::pageOffset($page, $limit);

// Nếu không có chủ đề nào được chọn (catid bằng null), hiển thị tất cả bài viết
if ($catid === null) {
    $total = $post->list_post_all_count(); // Lấy tổng số bài viết
    $list_post = $post->list_post_all($catid, $list_cat_id, $limit, $offset); // Lấy tất cả bài viết với phân trang
} else {
    $total = count($list_cat_id) > 0 ? $post->list_post_topic_count($list_cat_id) : 0;
    $list_post = count($list_cat_id) > 0 ? $post->list_post_topic($list_cat_id, $limit, $offset) : [];
}

?>
<?php require_once "views/frontend/header.php"; ?>
<main>
<div data-aos="fade-up">
    <div class="container py-3">
        <h1>TẤT CẢ BÀI VIẾT</h1>
        <div class="row">
            <!-- Cột bên trái chứa danh sách chủ đề -->
            <div class="col-md-3">
                <?php
                    $list_topic = $topic->list_topic_by_name(); //lấy cdbv
                ?>
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Chủ Đề Bài Viết</li>
                    <?php foreach ($list_topic as $row_cat): ?>
                    <li class="list-group-item">
                        <a href="index.php?option=post&catid=<?=$row_cat['id'];?>">
                            <?=$row_cat['name'];?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Cột bên phải chứa danh sách bài viết -->
            <div class="col-md-9">
                <div class="row">
                    <?php require_once "views/frontend/post_card.php"; ?>
                </div>
            </div>
            <div class="my-3">
                <?php 
                $pageLink = 'index.php?option=post';
                if ($catid !== null) {
                    $pageLink .= '&catid=' . $catid;
                }
                echo Pagination::pageLinks($total, $page, $limit, $pageLink); 
                ?>
            </div>
        </div>
    </div>
</div>
<?php require_once "views/frontend/footer.php"; ?>
</main>
