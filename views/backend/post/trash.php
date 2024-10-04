<?php
require_once "../Models/Post.php";
$post = new Post();
$list = $post->getList('trash');
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thùng rác danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
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
                        
                        <a href="index.php?option=post" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách 
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                 <!-- IN RA THÔNGG BÁO  -->
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
                <table class="table table-bordered table-hover">
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
                        <?php foreach($list as $row): ?>
                            <tr>
                            <td class="text-center">
                                        <input type="checkbox" id="checkId" value="<?= htmlspecialchars($row['id']); ?>" name="checkId[]">
                                    </td>
                                    <td class="text-center">
                                        <img src="../public/images/category/<?=$row['thumbnail'];?>" class="img-fluid" alt="<?=$row['thumbnail'];?>">
                                    </td>
                                    <td><?=$row['title'];?></td>
                                    <td></td>
                                    <td><?=$row['type'];?></td>
                                    <td class="text-center">
                                    <!-- Các chức năng -->
                                    
                                    
                                    <a href="index.php?option=post&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="index.php?option=post&cat=restore&id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                    <a href="index.php?option=post&cat=destroy&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <td class="text-center"><?=$row['id'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal thông báo-->
<?php require_once "../views/backend/post/create.php";?>
<?php require_once "../views/backend/footer.php";?>
