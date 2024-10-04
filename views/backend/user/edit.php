<?php
require_once  "../Models/User.php";
$user = new User();
$id=$_REQUEST['id'];
$row=$user->getRow($id);
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=user&cat=process&id=<?=$id;?>" enctype="multipart/form-data" method="post">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập Nhật Sản Phẩm</h1>
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
                        <button type="submit" name ="UPDATE" class="btn btn-sm btn-success" >
                            <i class="fa fa-save " aria-hidden="true"></i> Cập Nhật
                        </button>
                        <a href="index.php?option=user" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về Danh Sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                   <div class="col-md-6">
                       <div class="mb-3">
                           <label for="name">Họ tên</label>
                           <input type="text" value="<?=$row['name'];?>" name="name" id="name" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="phone">Điện thoại</label>
                           <input type="text" value="<?=$row['phone'];?>" name="phone" id="phone" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="email">Email</label>
                           <input type="text" value="<?=$row['email'];?>" name="email" id="email" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="gender">Giới tính</label>
                           <select name="gender" id="gender" class="form-control">
                               <option value="1"<?=($row['gender']==1)? 'selected':''?>>Nam</option>
                        <option value="0"<?=($row['gender']==0)? 'selected':''?>>Nữ</option>
                           </select>
                       </div>
                       <div class="mb-3">
                           <label for="address">Địa chỉ</label>
                           <input type="text" value="<?=$row['address'];?>" name="address" id="address" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="mb-3">
                           <label for="username">Tên đăng nhập</label>
                           <input type="text" value="<?=$row['username'];?>" name="username" id="username" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="password">Mật khẩu</label>
                           <input type="password" value="<?=$row['password'];?>" name="password" id="password" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="password_re">Xác nhận mật khẩu</label>
                           <input type="password" value="<?=$row['password'];?>" name="password_re" id="password_re" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="roles">Quyền</label>
                           <select name="roles" id="roles" class="form-control">
                               <option value="0"<?=($row['roles']==0)? 'selected':''?>>Khách hàng</option>
                               <option value="1"<?=($row['roles']==1)? 'selected':''?>>Quản lý</option>
                           </select>
                       </div>
                       <div class="mb-3">
                        <label for="image">Hình</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                       <div class="mb-3">
                           <label for="status">Trạng thái</label>
                           <select name="status" id="status" class="form-control">
                               <option value="2"<?=($row['status']==2)? 'selected':''?>>Chưa xuất bản</option>
                               <option value="1"<?=($row['status']==1)? 'selected':''?>>Xuất bản</option>
                           </select>
                       </div>
                   </div>
               </div>
    </section>
</div>
</form>


<?php require_once "../views/backend/footer.php";?>