<?php
require_once  "../Models/Banner.php";
$banner = new Banner();
$id= $_REQUEST ['id'];
$row = $banner->getRow($id);
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết Banner</h1>
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
                        <a href="index.php?option=banner&cat=edit&id=<?=$id;?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"> Sửa</i>
                                    </a>
                                    <a href="index.php?option=banner&cat=delete&id=<?=$id;?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"> Xóa</i>
                                    </a>
                        <a href="index.php?option=banner" class="btn btn-sm btn-info">
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
                            <?php if ($field === 'image'): ?>
                                <img src="../public/images/banner/<?=$row['image'];?>" alt="<?=$row['image'];?>" style="max-width: 100px; max-height: 100px;">
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
