<?php
require_once "../Models/Category.php";
$category = new Category();
$list = $category->getList('trash');
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
                        
                        <a href="index.php?option=category" class="btn btn-sm btn-info">
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
                            <th style="width:30px;" class="text-center">#</th>
                            <th style="width:90px;" class="text-center">Hình</th>
                            <th>Tên danh mục</th>
                            <th>Slug</th>
                            <th style="width:180px;" class="text-center">Chức Năng</th>
                            <th style="width:30px;" class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $row): ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox">
                                </td>
                                <td class="text-center">
                                    <img src="../public/images/category/<?=$row['thumbnail'];?>" class="img-fluid" alt="<?=$row['thumbnail'];?>">
                                </td>
                                <td><?=$row['name'];?></td>
                                <td><?=$row['slug'];?></td>
                                <td class="text-center">
                                    <!-- Các chức năng -->
                                    
                                    
                                    <a href="index.php?option=category&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="index.php?option=category&cat=restore&id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                    <a href="index.php?option=category&cat=destroy&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
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
<?php require_once "../views/backend/category/create.php";?>
<?php require_once "../views/backend/footer.php";?>
