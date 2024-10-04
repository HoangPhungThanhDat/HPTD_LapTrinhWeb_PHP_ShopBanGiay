<?php
require_once "Models/Product.php";
$product = new Product();

// Xử lý category
$list_cat_id = array();
array_push($list_cat_id, $row_cat['id']);
$list_category1 = $category->list_category_by_parentid($row_cat['id']);
if (count($list_category1) > 0) {
    foreach ($list_category1 as $row_cat1) {
        array_push($list_cat_id, $row_cat1['id']);
        $list_category2 = $category->list_category_by_parentid($row_cat1['id']);
        if (count($list_category2) > 0) {
            foreach ($list_category2 as $row_cat2) {
                array_push($list_cat_id, $row_cat2['id']);
            }
        }
    }
}

// Lấy danh sách sản phẩm theo danh mục
$list_product_category = $product->product_category_home($list_cat_id, 6);
?>

<div data-aos="fade-up">
    <div class="row">
        <?php foreach ($list_product_category as $row_product): ?>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-label">Danh mục</span>
                    <!-- Liên kết tới trang chi tiết sản phẩm -->
                    <a href="index.php?option=product_detail&slug=<?= $row_product['slug']; ?>">
                        <img src="public/images/product/<?= $row_product['thumbnail']; ?>" class="img-fluid product-img" alt="<?= $row_product['thumbnail']; ?>">
                    </a>
                </div>
                <div class="product-details">
                    <div class="product-title">
                    <a href="index.php?option=product_detail&slug=<?= $row_product['slug']; ?>"><?= $row_product['name']; ?></a></div>
                    <div class="product-brand">BALENCIAGA</div>
                    <div class="product-pricing">
                        <span class="old-price"><?= number_format($row_product['pricebuy']); ?>đ</span>
                        <?php if ($row_product['pricesale'] > 0): ?>
                            <span class="new-price"><?= number_format($row_product['pricesale']); ?>đ</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
