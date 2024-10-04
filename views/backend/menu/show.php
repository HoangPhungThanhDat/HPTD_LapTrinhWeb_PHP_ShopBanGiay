<?php
require_once  "../Models/Menu.php";
$menu = new Menu();
$id= $_REQUEST ['id'];
$row = $menu->getRow($id);
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Chi tiết Menu</li>
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
                        <a href="index.php?option=menu&cat=edit&id=<?=$id;?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"> Sửa</i>
                                    </a>
                                    <a href="index.php?option=menu&cat=delete&id=<?=$id;?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"> Xóa</i>
                                    </a>
                        <a href="index.php?option=menu" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách 
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:30%;" class="text-center">Tên trường</th>
                            <th style="width: 70%;">Giá trị</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($row as $field=>$value): ?>
                    <tr>
                        <td class="text-center"><?=$field;?></td>
                        <td>
                            <?php if ($field === 'thumbnail'): ?>
                                <img src="../public/images/menu/<?=$row['thumbnail'];?>" alt="<?=$row['thumbnail'];?>" style="max-width: 100px; max-height: 100px;">
                            <?php else: ?>
                                <?=$value;?>
                            <?php endif; ?>
                        </td>
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
