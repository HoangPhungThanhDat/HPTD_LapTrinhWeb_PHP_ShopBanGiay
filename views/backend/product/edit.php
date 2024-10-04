<?php
require_once  "../Models/Product.php";
$product = new Product();
$id=$_REQUEST['id'];
$row=$product->getRow($id);

$all_categories = $product->getCategories();
$all_brands = $product->getBrands();

$html_category_name = '';
$html_brand_name = '';

foreach ($all_categories as $category) {

    if($category['id'] == $row['category_id']) 
    {
        $html_category_name .= "<option selected value='" . $category['id'] . "'>" . $category['name'] . "</option>";
    }
    else
    {
        $html_category_name .= "<option  value='" . $category['id'] . "'>" . $category['name'] . "</option>";

    }
   
}

foreach ($all_brands as $brand) {
    if ($brand['id'] == $row['brand_id']) {
        $html_brand_name .= "<option  selected value='" . $brand['id'] . "'>" . $brand['name'] . "</option>";
      
    } else {
        $html_brand_name .= "<option  value='" . $brand['id'] . "'>" . $brand['name'] . "</option>";
    }
    
   
}
?>
<?php require_once "../views/backend/header.php";?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=product&cat=process&id=<?=$id;?>" enctype="multipart/form-data" method="post">
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
                        <a href="index.php?option=product" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Về Danh Sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="name">Tên Sản Phẩm</label>
                        <input type="text" value="<?=$row['name'];?>" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="content">Chi tiết</label>
                        <textarea name="content" id="content" rows="8" class="form-control"><?=$row['content'];?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" id="description" class="form-control"><?=$row['description'];?></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="category_id">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Chọn danh mục</option>
                            <?= $html_category_name; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand_id">Thương hiệu</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">Chọn thương hiệu</option>
                            <?= $html_brand_name; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pricebuy">Giá</label>
                        <input type="number" value="<?=$row['pricebuy'];?>" name="pricebuy" id="pricebuy" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pricesale">Giá khuyến mãi</label>
                        <input type="number" value="<?=$row['pricesale'];?>" name="pricesale" id="pricesale" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="qty">Số lượng</label>
                        <input type="number" value="<?=$row['qty'];?>" name="qty" id="qty" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image">Hình</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="2" <?=($row['status']==2)? 'selected':''?>>Chưa xuất bản</option>
                            <option value="1 " <?=($row['status']==1)? 'selected':''?>>Xuất bản</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</form>


<?php require_once "../views/backend/footer.php";?>