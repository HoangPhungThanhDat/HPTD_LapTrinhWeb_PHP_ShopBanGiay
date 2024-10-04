<?php
require_once  "../Models/Brand.php";
$brand = new Brand();
$list=$brand->getList('index');
?>
<?php require_once "../views/backend/header.php";?>
<<div class="content-wrapper">
            <!-- CONTENT -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Quản lý thương hiệu</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Quản lý thương hiệu</li>
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
                                <a class="btn btn-sm btn-danger" href="index.php?option=brand&cat=trash">
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
                        <div class="row">
                            <div class="col-md-3">
                                
                                <?php require_once "../views/backend/brand/create.php";?>
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:30px;">#</th>
                                            <th class="text-center" style="width:90px;">Hình</th>
                                            <th>Tên thương hiêu</th>
                                            <th>Slug</th>
                                            <th class="text-center" style="width:200px;">Chức năng</th>
                                            <th class="text-center" style="width:30px;">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($list as $row):?>      
                                      <tr>
                                        <td  class="text-center">
                                          <input type="checkbox"></td>
                                          <td class="text-center">
                                            <img src="../public/images/brand/<?=$row['thumbnail'];?>" class="img-fluid" alt="<?=$row['thumbnail'];?>">
                                          </td>
                                        </td>
                                        <td><?=$row['name'];?></td>
                                        <td> <?=$row['slug'];?></td>          
                                        <td  class="text-center">
                                    <!-- CAC CHUC NANG -->
                                          <?php if($row['status']==1):?>
                                            <a href="index.php?option=brand&cat=status&id=<?=$row['id']; ?>" class="btn btn-sm btn-success">
                                              <i class="fas fa-toggle-on"></i>
                                            </a>
                                          <?php else:?>
                                            <a href="index.php?option=brand&cat=status&id=<?=$row['id']; ?>" class="btn btn-sm btn-danger">
                                              <i class="fas fa-toggle-off"></i>
                                            </a>
                                          <?php endif;?>
                                          <a href="index.php?option=brand&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?option=brand&cat=edit&id=<?=$row['id']; ?>" class="btn btn-sm btn-primary"> 
                                            <i class="fa fa-edit " aria-hidden="true"></i>
                                            </a>
                                          <a href="index.php?option=brand&cat=delete&id=<?=$row['id']; ?>" class="btn btn-sm btn-danger">
                                          <i class="fas fa-trash"></i>
                                        </a>
                                        </td>
                                        <td  class="text-center">
                                        <?=$row['id'];?>
                                        </td>
                                      </tr>
                                      <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.CONTENT -->
        </div>
<?php require_once "../views/backend/footer.php";?>