<?php
require_once  "../Models/Topic.php";
$topic = new Topic();
$id=$_REQUEST['id'];
$row = $topic->getRow($id);
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi Tiết Danh Mục</h1>
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
                        <a href="index.php?option=topic&cat=edit&id=<?=$id;?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Sửa 
                                </a>
                                <a href="index.php?option=topic&cat=delete&id=<?=$id;?>"
                                    class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Xoá
                                </a>
                        <a href="index.php?option=topic" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về Danh Sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <?php if(isset($_SESSION['message'])):?>
         <?php 
         $arr_msg=get_flash('message');   
         ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <?=$arr_msg['msg'];?>
  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
         <?php endif;?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:30%;" class="text-center">Tên Trường</th>
                            <th style="width:70%;">Giá Trị</th>
                            
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($row as $field=>$value): ?>
    <tr>
        <td class="text-center"><?=$field;?></td>
        <td>
            <?php if ($field === 'thumbnail'): ?>
<img src="../public/images/topic/<?=$row['thumbnail'];?>" alt="<?=$row['thumbnail'];?>" style="max-width: 100px; max-height: 100px;">
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
<?php require_once "../views/backend/footer.php";?>