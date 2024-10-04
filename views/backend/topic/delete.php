<?php
require_once  "../Models/Topic.php";
$topic = new Topic();
$id= $_REQUEST ['id'];
// echo $id;
$row = $topic->getRow($id);
if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ !']);
    header("Location: index.php?option=topic");
}
else{
    $data=[
        'status'=>$row['status'] == 0,
        'updated_at'=>date('y-m-d H:i:s'),
        'updated_by'=>1,
    ];
    $topic->update($data,$id);
    set_flash('message', ['type' => 'success', 'msg' => 'Xóa vào thùng rác thành công']);
    header("Location: index.php?option=topic");
}

