<?php
require_once  "../Models/Banner.php";
$banner = new Banner();
$id= $_REQUEST ['id'];
// echo $id;
$row = $banner->getRow($id);



if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=banner");
}
else{

    if(file_exists('../public/images/banner/' .$row['thumbnail']))
    {
        unlink('../public/images/banner/' .$row['thumbnail']);
    }
    
    $banner->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=banner&cat=trash");
} 

