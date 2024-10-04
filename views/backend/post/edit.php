<?php
require_once "../Models/Post.php";
$post = new Post();
$id = $_REQUEST['id'];
$row = $post->getRow($id);
$all_topic = $post->getTopic();

$html_topic_name = '';

foreach ($all_topic as $topic) {
    if($topic['id'] == $row['topic_id']) 
    {
        $html_topic_name .= "<option selected value='" . $topic['id'] . "'>" . $topic['name'] . "</option>";
    }
    else
    {
        $html_topic_name .= "<option  value='" . $topic['id'] . "'>" . $topic['name'] . "</option>";

    }   
}
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=post&cat=process&id=<?=$id;?>" enctype="multipart/form-data" method="post">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập Nhật bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cập Nhật bài viết</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <!-- Button trigger modal -->
                        <button type="submit" name ="UPDATE" class="btn btn-sm btn-success" >
                            <i class="fa fa-save " aria-hidden="true"></i> Cập Nhật
                        </button>
                        <a href="index.php?option=post" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về Danh Sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                 <div class="col-md-9">
                     <div class="mb-3">
                         <label for="title">Tiêu đề</label>
                         <input type="text" value="<?=$row['title'];?>" name="title" id="title" class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="content">Chi tiết</label>
                         <textarea name="content" id="content" rows="8" class="form-control"><?=$row['content'];?></textarea>
                     </div>
                     <div class="mb-3">
                         <label for="description">Mô tả</label>
                         <textarea name="description" id="description" class="form-control"><?=$row['description'];?></textarea>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="mb-3">
                         <label for="topic_id">Chủ đề</label>
                         <select name="topic_id" id="topic_id" class="form-control">
                             <option value="">Chọn chủ đề</option>
                           
                             <?= $html_topic_name; ?>
                         </select>
                     </div>
                      <div class="mb-3">
                         <label for="type">Kiểu</label>
                         <select name="type" id="type" class="form-control">
                             <option value="post" <?=($row['type']=='post')?'selected':' ';?>>Bài viết</option>
                             <option value="page"<?=($row['type']=='page')?'selected':' ';?>>Trang đơn</option>
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="image">Hình</label>
                         <input type="file" name="image" id="image" class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="status">Trạng thái</label>
                         <select name="status" id="status" class="form-control">
                             <option value="2"<?=($row['status']==2)?'selected':' ';?>>Chưa xuất bản</option>
                             <option value="1" <?=($row['status']==1)?'selected':' ';?>>Xuất bản</option>
                         </select>
                     </div>
                 </div>
             </div>
        </div>
    </section>
</div>
</form>
<?php require_once "../views/backend/footer.php";?>