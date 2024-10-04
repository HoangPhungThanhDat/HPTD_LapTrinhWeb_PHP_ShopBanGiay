<?php
require_once  "../Models/Banner.php";
$banner = new Banner();
$list =$banner->getList('index');

$id=$_REQUEST['id'];
$row=$banner->getRow($id);
$html_sort_order = '';
if (is_array($list) && count($list) > 0) {
    foreach ($list as $item) {

        if ($item['sort_order'] == $row['sort_order']-1) {
            $html_sort_order .= "<option selected value='" . ($item['sort_order'] + 1) . "'>Sau: " . $item['name'] . "</option>";
          
        } else {
            $html_sort_order .= "<option value='" . ($item['sort_order'] + 1) . "'>Sau: " . $item['name'] . "</option>";
        }
       
    }
}

?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=banner&cat=process&id=<?=$id;?>" enctype="multipart/form-data" method="post">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập Nhật Banner</h1>
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
                        <a href="index.php?option=banner" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về Danh Sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Tên Banner(*)</label>
                        <input type="text" name="name" value="<?=$row['name'];?>" id="name" required class="form-control"
                            placeholder="VD: Áo thun">
                    </div>

                    <div class="mb-3">
                          <label for="link">Liên kết</label>
                          <input type="text" value="<?=$row['link'];?>" name="link" id="link" class="form-control">

                      </div>
                    <div class="mb-3">
                        <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control"><?=$row['description'];?></textarea>
                    </div>
                    <div class="mb-3">
                          <label for="position">Vị trí</label>
                          <select name="position" id="position" class="form-control">
                              <option value="slideshow"<?=($row['link']=='slideshow')? 'selected':''?>>Slider Show</option>
                              <option value="mainshow"<?=($row['link']=='mainshow')? 'selected':''?>>Main Show</option>
                             
                          </select>
                      </div>
                      <div class="mb-3">
                        <label for="sort_order">Sắp xếp</label>
                        <select name="sort_order" id="sort_order" class="form-control">
                            <option value="0">None</option>
                            <?= $html_sort_order; ?>
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
    </section>
</div>
</form>


<?php require_once "../views/backend/footer.php";?>