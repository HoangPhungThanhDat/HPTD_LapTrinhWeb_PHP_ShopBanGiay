<?php
require_once  "../Models/Product.php";
$product = new Product();
$id= $_REQUEST ['id'];
// echo $id;
$row = $product->getRow($id);

if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=product");
}
else{

    if(file_exists('../public/images/product/' .$row['thumbnail']))
    {
        unlink('../public/images/product/' .$row['thumbnail']);
    }
    
    $product->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=product&cat=trash");
} 

