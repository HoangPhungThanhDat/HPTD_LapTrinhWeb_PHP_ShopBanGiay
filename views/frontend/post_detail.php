<?php
require_once "Models/Post.php";
$post=new Post();
require_once "Models/Topic.php";
$topic=new Topic();
$slug=$_REQUEST['slug'];
$row=$post->getRow($slug);
$catid=$row['topic_id'];


$list_cat_id = array();
array_push($list_cat_id, $catid);
$list_topic1 = $topic->list_topic_by_parentid($catid);
$limit=4;
$list_post = $post->list_post_other($list_cat_id,$row['id'], $limit);
?>
<?php require_once "views/frontend/header.php"; ?>
<main>
    <div class="container py-3">
        <div class="row">
            <!-- Hiển thị hình ảnh bài viết -->
            <div class="col-md-6">
                <img class="img-fluid" src="public/images/post/<?=$row['thumbnail'];?>" alt="<?=$row['title'];?>">
                <h2>CHI TIẾT BÀI VIẾT</h2>
                <h3><?=$row['title'];?></h3>
            </div>
            <!-- Hiển thị chi tiết bài viết -->          
            <div class="col-md-6">
                <h1><?=$row['title'];?></h1>
                <p><?=date("d/m/Y", strtotime($row['created_at']));?></p>
                <div>
                    <?=$row['content'];?>
                </div>
            </div>
        </div>
        <!-- Tabs cho các phần khác của trang chi tiết bài viết -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Bài Viết Liên Quan</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Bình Luận</button>
            </div>
            <div data-aos="fade-up">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                    <div class="posts" id="posts">
                        <div class="posts-container">                       
                            <?php require "views/frontend/post_card.php"; ?>                      
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0"></div>
            </div>
        </nav>
        <!-- Phần bình luận có thể thêm vào sau nếu cần -->
    </div>
</main>
<?php require_once "views/frontend/footer.php"; ?>

<style>
    .posts-container {
    display: flex;
    flex-wrap: wrap; /* muốn các phần tử chuyển sang hàng mới khi không còn đủ chỗ */
}

.post-card {
    flex: 1 1 calc(33.333% - 1rem); /* Hoặc tỷ lệ phần trăm khác để phù hợp với bố cục */
    margin: 0.5rem; /* Khoảng cách giữa các phần tử */
}

</style>





