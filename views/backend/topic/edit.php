
<?php
require_once "../Models/Topic.php";
$topic = new Topic();
$list = $topic->getList('index');

$id = $_REQUEST['id'];
$row = $topic->getRow($id);
$html_parentid = '';
$html_sort_order = '';
if (is_array($list) && count($list) > 0) {
    foreach ($list as $item) {     
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
<form action="index.php?option=topic&cat=process&id=<?=$id; ?>" enctype="multipart/form-data" method="post">
<div class="content-wrapper">
            <!-- CONTENT -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Quản lý chủ đề</h1>
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
                            <button type="submit" name="UPDATE" class="btn btn-sm btn-success" >
                            <i class="fa fa-save" aria-hidden="true"></i> Cập nhật
                        </button>
                        <a href="index.php?option=topic" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách 
                        </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="#" method="post">
                            <div class="mb-3">
                                <label for="name">Tên chủ đề</label>
                                <input type="text" value="<?= $row['name']; ?>" name="name" id="name" class="form-control">

                            </div>
                            <div class="mb-3">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" class="form-control"><?= $row['description']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="sort_order">Sắp xếp</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="0">None</option>
                                    <?= $html_sort_order; ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="2"<?=($row['status']==2)?'selected':' ';?>>Chưa xuất bản</option>
                                    <option value="1" <?=($row['status']==1)?'selected':' ';?>>Xuất bản</option>
                                </select>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </section>
            <!-- /.CONTENT -->
        </div>
</form>

<?php require_once "../views/backend/footer.php";?>
