<?php
require_once "Models/Brand.php";
$brand = new Brand();
$list_brand = $brand->list_brand_by_parentid(0); // Giả sử bạn có một phương thức để lấy tất cả thương hiệu
?>
<ul class="list-group">
    <li class="list-group-item active" aria-current="true">Thương Hiệu</li>
    <?php foreach ($list_brand as $row_brand):?>
    <li class="list-group-item">
    <a href="index.php?option=product&catid=<?=$row_brand['id'];?>">
            <?=$row_brand['name'];?>
        </a>
    </li>
    <?php endforeach;?>
</ul>
