<?php foreach ($list_product as $row_product): ?>
 

    <div class="product-card">
            <a href="index.php?option=product_detail&slug=<?= $row_product['slug']; ?>" class="sale-card">
                <div class="product-image">
                    <img src="public/images/product/<?= $row_product['thumbnail']; ?>" class="img-fluid product-img" alt="<?=$row_product['thumbnail'];?>">
                </div>
                <div class="product-details">
                    <div class="product-title"><?= $row_product['name']; ?></div>
                    <div class="product-brand">BALENCIAGA</div>
                    <div class="product-pricing">
                        <span class="old-price"><?= number_format($row_product['pricebuy']); ?>đ</span>
                        <?php if ($row_product['pricesale'] > 0): ?>
                            <span class="new-price"><?= number_format($row_product['pricesale']); ?>đ</span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
<?php endforeach; ?>
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