<?php
require_once  "../Models/Topic.php";
$topic = new Topic();
$list =$topic->getList('index');
?>
<?php require_once "../views/backend/header.php";?>
  <!-- CONTENT -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>QUẢN LÝ CHỦ ĐỀ</h1>
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
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#staticTopic">
            <i class="fas fa-plus"></i>Thêm
              </button>
                <a href="index.php?option=topic&cat=trash" class="btn btn-sm btn-danger">
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
                <th>Tên Chủ Đề</th>
                <th>Slug</th>
                <th style="width: 180px" class="text-center">Chức năng</th>
                <th style="width: 30px" class="text-center">ID</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($list as $row):?>
              <tr>
                <td  class="text-center">
                  <input type="checkbox">
                </td>
                <td>
                  <img src="../public/images/topic/hinh.jpg" alt="Hinh">
                </td>
                <td><?=$row['name'];?></td>
                <td>Slug</td>
                <td  class="text-center">
                <?php if ($row['status']==1):?>
                <a href="index.php?option=topic&cat=status&id=<?=$row['id']; ?>" class="btn btn-sm btn-success">
                   <i class="fas fa-toggle-on"></i>
                </a>
                  <?php else:?>
                  <a href="index.php?option=topic&cat=status&id=<?=$row['id']; ?>" class="btn btn-sm btn-danger">
                   <i class="fas fa-toggle-off"></i>
                </a>
                <?php endif;?>
                <a href="index.php?option=topic&cat=show&id=<?=$row['id']; ?>" class="btn btn-sm btn-info">
                   <i class="fas fa-eye"></i>
              </a>
                <a href="index.php?option=topic&cat=edit&id=<?=$row['id']; ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
              </a>
                <a href="index.php?option=topic&cat=delete&id=<?=$row['id']; ?>" class="btn btn-sm btn-danger">
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
    </section>
  </div>
  <!--Modal-->
  <div class="modal fade" id="statictopic" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="statictopicLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">THÊM CHỦ ĐỀ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times"></i>Thoát

        </button>
        <button type="submit" name="CREATE" class="btn btn-success px-5">
        <i class="fas fa-save"></i>Lưu 

        </button>
      </div>
    </div>
  </div>
</div>
<?php require_once "../views/backend/topic/create.php";?>

  <!-- END CONTENT -->
  <?php require_once "../views/backend/footer.php";?>