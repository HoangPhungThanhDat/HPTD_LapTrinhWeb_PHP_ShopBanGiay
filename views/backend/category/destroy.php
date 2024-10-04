<?php
require_once  "../Models/Category.php";
$category = new Category();
$id= $_REQUEST ['id'];
// echo $id;
$row = $category->getRow($id);



if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=category");
}
else{

    if(file_exists('../public/images/category/' .$row['thumbnail']))
    {
        unlink('../public/images/category/' .$row['thumbnail']);
    }
    
    $category->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=category&cat=trash");
} 

