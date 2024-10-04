<?php
require_once "../Models/Post.php";
$post = new Post();
$list_post=$post->getList('index');
?>
<?php require_once "../views/backend/header.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Quản lý bài viết</h1>
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
                  <a class="btn btn-sm btn-success" href="index.php?option=post&cat=create">
                      <i class="fas fa-plus"></i> Thêm
                  </a>
                  <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=trash">
                      <i class="fas fa-trash"></i> Thùng rác
                  </a>
              </div>
          </div>
      </div>
      <div class="card-body">
        <!-- IN RA THÔNG BÁO -->
        <?php if(isset($_SESSION['message'])):?>
                <?php 
                    $arr_msg = get_flash('message');
                    $alert_type = $arr_msg['type'];  // Lấy mã loại thông báo (success, danger, warning, v.v.)
                    $alert_message = $arr_msg['msg']; // Lấy thông điệp thực tế để hiển thị
                ?>
                <div class="alert alert-<?=$alert_type;?> alert-dismissible fade show" role="alert">
                    <?= $alert_message; ?>  <!-- Hiển thị thông điệp -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
          <table class="table table-bordered table-striped table-hover">
              <thead>
                  <tr>
                      <th class="text-center" style="width:30px;">#</th>
                      <th class="text-center" style="width:90px;">Hình</th>
                      <th>Tiêu đề bài viết</th>
                      <th>Chủ đề</th>
                      <th>Kiểu</th>
                      <th class="text-center" style="width:200px;">Chức năng</th>
                      <th class="text-center" style="width:30px;">ID</th>
                  </tr>
              </thead>
              <tbody> 
                <?php foreach ($list_post as $row) :?>
             
                <tr>
                  <td  class="text-center">
                    <input type="checkbox" name="checkId[]" id="checkId" value="1"></td>
                  <td  class="text-center">
                  <img src="../public/images/post/<?=$row['thumbnail'];?>" class="img-fluid"
                  alt="<?=$row['thumbnail'];?>">
                  </td>
                  <td><?=$row['title'];?></td>
                  <td><?=$row['topic_name'];?></td>
                  <td><?=$row['type'];?></td>
                  
            
                  <td  class="text-center">
                 
                  <?php if ($row['status']==1):?>
                                <a href="index.php?option=post&cat=status&id=<?=$row['id']; ?>"
                                    class="btn btn-sm btn-success">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                <?php else:?>
                                <a href="index.php?option=post&cat=status&id=<?=$row['id']; ?>"
                                    class="btn btn-sm btn-danger">
                                    <i class="fas fa-toggle-off"></i>
                                </a>
                                <?php endif;?>
  
               
                   
                    <a href="index.php?option=post&cat=show&id=<?=$row['id']; ?>" class="btn btn-sm btn-info"> 
                      <i class="fa fa-eye " aria-hidden="true"></i>
                    </a>
                    <a href="index.php?option=post&cat=edit&id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=post&cat=delete&id=<?= $row['id'];?>" 
                    class="btn btn-sm btn-danger"> 
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td  class="text-center">
                    <?=$row['id'];?>
                  </td>
                  

                </tr>
                    
                <?php endforeach; ?>
                
              </tbody>
          </table>
      </div>
  </div>
</section>
 
    
 
  </div>

<?php require_once "../views/backend/footer.php";?>