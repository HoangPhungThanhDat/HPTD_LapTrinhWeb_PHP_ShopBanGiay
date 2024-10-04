<?php
require_once  "../Models/Topic.php";
$topic = new Topic();
$id= $_REQUEST ['id'];
// echo $id;
$row = $topic->getRow($id);

if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=topic");
}
else{

    if(file_exists('../public/images/topic/' .$row['thumbnail']))
    {
        unlink('../public/images/topic/' .$row['thumbnail']);
    }
    
    $topic->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=topic&cat=trash");
} 

