<?php
require_once  "../Models/Product.php";
$product = new Product();
$list_product =$product->getList('index');
?>
<?php require_once "../views/backend/header.php";?>
  <!-- CONTENT -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>QUẢN LÝ SẢN PHẨM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">QUẢN LÝ SẢN PHẨM</li>
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
                <a href="index.php?option=product&cat=create" class="btn btn-sm btn-success">
                <i class="fas fa-plus"></i>Thêm
                </a>
                <a href="index.php?option=product&cat=trash" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>Thùng Rác
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
                <th style="width: 30px" class="text-center">#</th>
                <th style="width: 90px" class="text-center">Hình</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th style="width: 180px" class="text-center">Chức năng</th>
                <th style="width: 30px" class="text-center">ID</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($list_product as $row):?>
              <tr>
                <td  class="text-center">
                  <input type="checkbox">
                </td>
                <td class="text-center">
                    <img src="../public/images/product/<?=$row['thumbnail'];?>" class="img-fluid" alt="<?=$row['thumbnail'];?>">
                </td>
                <td><?=$row['name'];?></td>
                <td><?=$row['category_name'];?></td>
                <td><?=$row['brand_name'];?> </td>
                <td  class="text-center">
                <!-- CAC CHUC NANG -->
                <?php if($row['status'] == 1): ?>
                  <a href="index.php?option=product&cat=status&id=<?=$row['id'];?>" class="btn btn-sm btn-success">
                            <i class="fas fa-toggle-on"></i>
                        </a>
                    <?php else: ?>
                        <a href="index.php?option=product&cat=status&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                            <i class="fas fa-toggle-off"></i>
                        </a>
                    <?php endif; ?>
                    
                    <a href="index.php?option=product&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="index.php?option=product&cat=edit&id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=product&cat=delete&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                <td class="text-center"><?=$row['id'];?></td>
            </tr>
              <?php endforeach;?>
            </tbody>
         </table>
        </div>
      </div>
    </section>
   
  </div>
  <?php require_once "../views/backend/footer.php";?>