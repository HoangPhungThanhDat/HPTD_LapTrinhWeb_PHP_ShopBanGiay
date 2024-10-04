<?php
require_once  "../Models/Contact.php";
$contact = new Contact();
$list_contact =$contact->getList('index');
?>
<?php require_once "../views/backend/header.php";?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý liên hệ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Quản lý liên hệ</li>
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
            <a href="index.php?option=contact&cat=trash" class="btn btn-sm btn-danger"> 
              <i class="fa fa-trash" aria-hidden="true"></i> Thùng Rác
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
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="width:30px;" class="text-center">#</th>
              <th>Họ Tên</th>
              <th>Điện Thoại</th>
              <th>Email</th>
              <th>Tiêu đề</th>
              <th style="width:180px;" class="text-center">Chức Năng</th>
              <th style="width:30px;" class="text-center">ID</th>
            </tr>
          </thead>
          <tbody> 
          <?php foreach($list_contact as $row):?>     
            <tr>
              <td  class="text-center">
                <input type="checkbox"></td>
                
              </td>
              <td><?=$row['name'];?></td>
              <td><?=$row['phone'];?></td>
              <td><?=$row['email'];?></td>
              <td><?=$row['title'];?></td>             
              <td  class="text-center">
          <!-- CAC CHUC NANG -->
          <?php if($row['status'] == 1): ?>
                <a href="index.php?option=contact&cat=status&id=<?=$row['id'];?>" class="btn btn-sm btn-success">
                    <i class="fas fa-toggle-on"></i>
                </a>
            <?php else: ?>
                <a href="index.php?option=contact&cat=status&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                    <i class="fas fa-toggle-off"></i>
                </a>
            <?php endif; ?>
            
            <a href="index.php?option=contact&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                <i class="fas fa-eye"></i>
            </a>
            
            <a href="index.php?option=contact&cat=delete&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
            </a>
            <td><?=$row['id'];?></td>             
             
            </tr>
            <?php endforeach;?>
          </tbody>        
        </table>
      </div>
    </div>
  </section>
  </div>
<?php require_once "../views/backend/footer.php";?>