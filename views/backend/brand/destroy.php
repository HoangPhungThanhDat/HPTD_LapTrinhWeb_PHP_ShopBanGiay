<?php
require_once  "../Models/Brand.php";
$brand = new Brand();
$id= $_REQUEST ['id'];
// echo $id;
$row = $brand->getRow($id);



if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=brand");
}
else{

    if(file_exists('../public/images/brand/' .$row['thumbnail']))
    {
        unlink('../public/images/brand/' .$row['thumbnail']);
    }
    
    $brand->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=brand&cat=trash");
} 

