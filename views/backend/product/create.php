<?php
require_once "../Models/Product.php";
$product = new Product();

$all_categories = $product->getCategories();
$all_brands = $product->getBrands();

$html_category_name = '';
$html_brand_name = '';

foreach ($all_categories as $category) {
    $html_category_name .= "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
}

foreach ($all_brands as $brand) {
    $html_brand_name .= "<option value='" . $brand['id'] . "'>" . $brand['name'] . "</option>";
}


?>

<?php require_once "../views/backend/header.php"; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="card-body">
            <form action="index.php?option=product&cat=process" method="post" enctype="multipart/form-data">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Thêm sản phẩm</h1>
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
                                    <button type="submit" name="CREATE" class="btn btn-sm btn-success">
                                        <i class="fa fa-save"></i> Lưu
                                    </button>
                                    <a class="btn btn-sm btn-info" href="index.php?option=product">
                                        <i class="fa fa-arrow-left"></i> Về danh sách
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="name">Tên Sản Phẩm</label>
                                        <input type="text" value="" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="content">Chi tiết</label>
                                    <textarea name="content" id="content" rows="8" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
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
                                        <input type="number" value="" name="pricebuy" id="pricebuy" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="pricesale">Giá khuyến mãi</label>
                                        <input type="number" value="" name="pricesale" id="pricesale" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="qty">Số lượng</label>
                                        <input type="number" value="" name="qty" id="qty" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image">Hình</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status">Trạng thái</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="2">Chưa xuất bản</option>
                                            <option value="1">Xuất bản</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </section>
</div>

<?php require_once "../views/backend/footer.php"; ?>