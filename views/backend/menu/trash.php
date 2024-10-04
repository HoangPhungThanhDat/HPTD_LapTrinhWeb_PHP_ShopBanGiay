<?php
require_once "../Models/Menu.php";
$menu = new Menu();
$list_menu = $menu->getList('trash'); // Sử dụng biến $list_menu thay vì $list
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
                        
                        <a href="index.php?option=menu" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách 
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                 <!-- IN RA THÔNG BÁO  -->
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
                            <th style="width:30px" class="text-center">#</th>
                            <th>name</th>
                            <th>link</th>
                            <th>position</th>
                            <th style="width:180px"class="text-center">function</th>
                            <th style="width:30px"class="text-center">id</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php foreach ($list_menu as $row) :?>
                      <tr>
                        <td class="text-center">
                            <input type="checkbox">
                        </td>
                        <td><?=$row['name'];?></td>
                        <td> <?=$row['link'];?></td>
                        <td> <?=$row['position'];?></td>
                        <td class="text-center">
                    <!-- Các chức năng -->
                    <!-- Các chức năng -->                                   
                    <a href="index.php?option=menu&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="index.php?option=menu&cat=restore&id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                    <a href="index.php?option=menu&cat=destroy&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
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
<?php require_once "../views/backend/footer.php";?>
