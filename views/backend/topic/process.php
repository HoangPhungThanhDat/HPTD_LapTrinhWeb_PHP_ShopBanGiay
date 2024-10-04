<?php
require_once "../Models/Topic.php";
$topic = new Topic();

if (isset($_POST['CREATE'])) {
    // Xử lý dữ liệu từ form
        $data = [
            'name' => $_POST['name'],
            'slug' => str_slug($_POST['name']),
            'sort_order' => $_POST['sort_order'],         
            'description' => $_POST['description'],
            'status' => $_POST['status'],
                    
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $_SESSION['user_id'] ?? 1,
           
        ];
        
    // Xử lý tệp hình ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../public/images/topic/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($fileType, ['jpg', 'jpeg', 'webp', 'gif', 'png'])) {
            $filename = $data['slug'] . "." . $fileType;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $filename)) {
                $data['thumbnail'] = $filename; // Lưu tên tệp vào mảng dữ liệu
            } else {
                echo "Lỗi tải lên hình ảnh.";
                exit;
            }
        } else {
            echo "Định dạng tệp không hợp lệ.";
            exit;
        }
    }

    // Thực hiện chèn dữ liệu vào cơ sở dữ liệu
    $topic->insert($data);
    set_flash('message',['type'=>'success','msg'=>'Thêm Thành Công']);
    header("Location: index.php?option=topic");
}





if (isset($_POST['UPDATE'])) {
    $id=$_REQUEST['id'];
    // Xử lý dữ liệu từ form
    $data = [
        'name' => $_POST['name'],
        'slug' => str_slug($_POST['name']),
        'sort_order' => $_POST['sort_order'],         
        'description' => $_POST['description'],
        'status' => $_POST['status'],
                
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $_SESSION['user_id'] ?? 1,
        
    ];

    // Xử lý tệp hình ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
$target_dir = "../public/images/topic/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($fileType, ['jpg', 'jpeg', 'webp', 'gif', 'png'])) {
            $filename = $data['slug'] . "." . $fileType;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $filename)) {
                $data['thumbnail'] = $filename; // Lưu tên tệp vào mảng dữ liệu
            } else {
                echo "Lỗi tải lên hình ảnh.";
                exit;
            }
        } else {
            echo "Định dạng tệp không hợp lệ.";
            exit;
        }
    }

    // Thực hiện chèn dữ liệu vào cơ sở dữ liệu
    $topic->update($data,$id);
    set_flash('message',['type'=>'success','msg'=>'Cập Nhật Thành Công']);
    header("Location: index.php?option=topic");
}