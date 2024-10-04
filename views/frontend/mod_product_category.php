<?php
require_once "Models/Category.php";
$category = new Category();
$list_category = $category->list_category_by_parentid(0);
?>
<!-- Danh mục sản phẩm  -->
<?php foreach ($list_category as $row_cat): ?>
<div data-aos="fade-up">
<div class="container">
    <h1 ><?=$row_cat['name'];?></h1>                 
    <?php require "views/frontend/mod_product_category_list.php";?>                                                             
        </div>    
            <div class="row mt-2">
                <div class="col-12 text-center">                   
                    <a href="index.php?option=product&catid=<?=$row_cat['id'];?>" class="view-all-btn">Xem thêm sản phẩm &gt;</a>
                </div>
            </div>
            <nav aria-laber="Page navigation example" style="margin-top:20px">
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
</div>
</div>
</nav>
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
    </style>

    