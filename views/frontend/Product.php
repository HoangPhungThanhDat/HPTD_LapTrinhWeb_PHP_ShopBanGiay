<?php
require_once "Models/Product.php";
require_once "Models/Category.php";
require_once "application/Pagination.php";

$product = new Product();
$category = new Category();

$catid = $_REQUEST['catid'] ?? null;
$page = $_REQUEST['page'] ?? 1;
// Phân trang
$limit = 4;
$page = Pagination::pageCurrent();
$offset = Pagination::pageOffset($page, $limit);

// Tính tổng số sản phẩm
$list_cat_id = [$catid];
$list_category1 = $category->list_category_by_parentid($catid); //lấy danh sách các danh mục 
foreach ($list_category1 as $row_cat1) {
    $list_cat_id[] = $row_cat1['id'];
    $list_category2 = $category->list_category_by_parentid($row_cat1['id']);
    foreach ($list_category2 as $row_cat2) {
        $list_cat_id[] = $row_cat2['id'];
    }
}

$total = $product->list_product_all_count($catid, $list_cat_id); //đếm tổng số sản phẩm trong cơ sở dữ liệu
$list_product = $product->list_product_all($catid, $list_cat_id, $limit, $offset); //sử dụng để lấy danh sách các sản phẩm từ cơ sở dữ liệu

?>
<?php require_once "views/frontend/header.php"; ?>
<main>
<div data-aos="fade-up">
    <div class="container py-3">
        <h1>TẤT CẢ SẢN PHẨM</h1>
        <div class="row">
            <!-- Cột bên trái, có thể để trống hoặc thêm các phần tử khác -->
            <div class="col-md-3">
                <?php
                    $list_category = $category->list_category_by_parentid(0);
                ?>
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Danh Mục Sản Phẩm</li>
                    <?php foreach ($list_category as $row_cat):?>
                    <li class="list-group-item">
                        <a href="index.php?option=product&catid=<?=$row_cat['id'];?>">
                            <?=$row_cat['name'];?>
                        </a>
                    </li>
                    <?php endforeach;?> 
                </ul>
                <div class="mt-4">
                    <?php require_once "views/frontend/mod_brand_list.php";?>
                </div>
            </div>
            <!-- Cột bên phải chứa danh sách sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <?php require_once "views/frontend/product_card.php";?>                  
                </div>
            </div>
            <div class="my-3">
                <?php echo Pagination::pageLinks($total, $page, $limit, 'index.php?option=product&catid=' . $catid); ?>
            </div>
        </div>
    </div>
</div>
</main>
<?php require_once "views/frontend/footer.php"; ?>
