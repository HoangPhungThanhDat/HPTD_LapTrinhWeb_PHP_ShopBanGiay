<?php
require_once "Models/Product.php";
$product = new Product();
$limit = 6; // Xác định số lượng sản phẩm muốn lấy
$list_product_new = $product->get_list_product_new($limit);
?>
<div data-aos="fade-up">
<div class="container">
    <h1>Sản Phẩm Mới Nhất</h1>
    <div class="row">
        <?php foreach ($list_product_new as $row_product): ?>
        <div class="product-card">
            <div class="product-image">
                <span class="discount-label">New</span>
                <a href="index.php?option=product_detail&slug=<?= $row_product['slug']; ?>">
                    <img src="public/images/product/<?= $row_product['thumbnail']; ?>" class="img-fluid product-img" alt="<?=$row_product['thumbnail'];?>">
                </a>
            </div>
            <div class="product-details">
                <div class="product-title">
                    <a href="index.php?option=product_detail&slug=<?= $row_product['slug']; ?>"><?= $row_product['name']; ?></a>
                </div>
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
<div class="row mt-2">
    <div class="col-12 text-center">
        <a href="index.php?option=product&catid=<?=$row_cat['id'];?>" class="view-all-btn">Xem thêm sản phẩm &gt;</a>
    </div>
</div>
<nav aria-label="Page navigation example" style="margin-top:20px">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
</div>

<style>
    .view-all-btn {
        display: inline-block;
        padding: 10px 20px;
        border: 1px solid #000;
        border-radius: 20px;
        font-size: 16px;
        color: #000;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .view-all-btn:hover {
        background-color: #000;
        color: #fff;
    }

    .product-card {
        border: 1px solid #000;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin: 10px;
        width: 200px;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .product-image img {
        width: 100%;
        height: auto;
    }

    .discount-label {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #000;
        color: #fff;
        padding: 5px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 3px;
    }

    .product-details {
        padding: 15px;
        text-align: left;
    }

    .product-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .product-title a {
        text-decoration: none;
        color: inherit;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #e53935;
    }

    .product-brand {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    .product-pricing {
        font-size: 14px;
        color: #333;
    }

    .new-price {
        font-weight: bold;
        color: #e53935;
    }

    .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    @media (max-width: 768px) {
        .product-card {
            width: 48%;
        }
    }

    @media (max-width: 480px) {
        .product-card {
            width: 100%;
        }
    }
</style>
