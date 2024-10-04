<?php
require_once "../Models/Post.php";
$post = new Post();

$all_topic = $post->getTopic();

$html_topic_name = '';

foreach ($all_topic as $topic) {
    $html_topic_name .= "<option value='" . $topic['id'] . "'>" . $topic['name'] . "</option>";
}

?>

<?php require_once "../views/backend/header.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <div class="card-body">

      <form action="index.php?option=post&cat=process" method="post" enctype="multipart/form-data">
 
 <section class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1>Thêm Bài Viết</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Blank Page</li>
                 </ol>
             </div>
         </div>
     </div>
 </section>
 <section class="content">
     <div class="card">
         <div class="card-header">
             <div class="row">
                 <div class="col-12 text-right">
                     <button type="submit" name="CREATE" class="btn btn-sm btn-success">
                         <i class="fa fa-save"></i> Lưu
                     </button>
                     <a class="btn btn-sm btn-info" href="index.php?option=post">
                         <i class="fa fa-arrow-left"></i> Về danh sách
                     </a>
                 </div>
             </div>
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-md-9">
                     <div class="mb-3">
                         <label for="title">Tiêu đề</label>
                         <input type="text" value="" name="title" id="title" class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="content">Chi tiết</label>
                         <textarea name="content" id="content" rows="8" class="form-control"></textarea>
                     </div>
                     <div class="mb-3">
                         <label for="description">Mô tả</label>
                         <textarea name="description" id="description" class="form-control"></textarea>
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
                             <option value="post">Bài viết</option>
                             <option value="page">Trang đơn</option>
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="image">Hình</label>
                         <input type="file" name="image" id="image" class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="status">Trạng thái</label>
                         <select name="status" id="status" class="form-control">
                             <option value="2">Chưa xuất bản</option>
                             <option value="1">Xuất bản</option>
                         </select>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
</form>
       
    </div>
  </section>
    
 
  </div>

<?php require_once "../views/backend/footer.php";?>