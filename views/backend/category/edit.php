<?php
require_once "../Models/Category.php";
$category = new Category();
$list = $category->getList('index');

$id = $_REQUEST['id'];
$row = $category->getRow($id);
$html_parentid = '';
$html_sort_order = '';
if (is_array($list) && count($list) > 0) {
    foreach ($list as $item) {
        if($item['id']==$row['parent_id'])
        {
            $html_parentid .= "<option selected value='" . $item['id'] . "'>" . $item['name'] . "</option>";
        }
        else{
            $html_parentid .= "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
        }
      
        if($item['sort_order']==$row['sort_order']-1)
        {
            $html_sort_order .= "<option selected value='" . ($item['sort_order'] + 1) . "'>Sau: " . $item['name'] . "</option>";
        }
        else{
            $html_sort_order .= "<option value='" . ($item['sort_order'] + 1) . "'>Sau: " . $item['name'] . "</option>";
        }
        
    }
}
?>

<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=category&cat=process&id=<?=$id; ?>" enctype="multipart/form-data" method="post">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?option=home">Home</a></li>
                        <li class="breadcrumb-item active">Cập nhật danh mục</li>
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
                        <button type="submit" name="UPDATE" class="btn btn-sm btn-success" >
                            <i class="fa fa-save" aria-hidden="true"></i> Cập nhật
                        </button>
                        <a href="index.php?option=category" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách 
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Tên danh mục(*)</label>
                    <input value="<?= $row['name']; ?>" type="text" name="name" id="name" required class="form-control" placeholder="VD: Áo thun">
                </div>
                <div class="mb-3">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả"><?= $row['description']; ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="parent_id">Danh mục cha</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">None</option>
                                <?= $html_parentid; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sort_order">Sắp xếp</label>
                            <select name="sort_order" id="sort_order" class="form-control">
                                <option value="0">None</option>
                                <?= $html_sort_order; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image">Hình</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-control">
                        <option value="2"<?=($row['status']==2)?'selected':' ';?>>Chưa xuất bản</option>
                        <option value="1" <?=($row['status']==1)?'selected':' ';?>>Xuất bản</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
</div>
</form>
<!-- Modal thông báo-->

<?php require_once "../views/backend/footer.php";?>
