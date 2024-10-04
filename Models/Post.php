<?php
class Post extends Database
{
    private $table = 'hptd_post';   
    function __construct()
    {
        parent::__construct(); //database
    }
 
//GET LIST
    public function getList($status)
    {
        // Điều chỉnh truy vấn để sử dụng LEFT JOIN cho bảng topic
        $sql = "SELECT post.*, topic.name AS topic_name
                FROM $this->table AS post
                LEFT JOIN hptd_topic AS topic ON post.topic_id = topic.id";  // Sử dụng LEFT JOIN để lấy tên chủ đề
        
        // Thêm điều kiện WHERE dựa trên giá trị của $status
        switch ($status) {
            case 'index': {
                $sql .= " WHERE post.status != '0'";
                break;
            }
            case 'trash': {
                $sql .= " WHERE post.status = '0'";
                break;
            }
            default: {
                $sql .= " WHERE post.status = :status";
                break;
            }
        }
    // Thêm điều kiện ORDER BY
        $sql .= " ORDER BY post.created_at DESC";       
        // Chuẩn bị và thực hiện truy vấn với $status nếu cần
        if ($status !== 'index' && $status !== 'trash') {
            return $this->getAll($sql, ['status' => $status]); // Sử dụng prepared statements với bind parameter
        } else {
            return $this->getAll($sql);
        }
    }

   
//  lấy bảng topic và post
    public function getTopic() {
        $sql = "SELECT id, name FROM hptd_topic";
        return $this->getAll($sql);
    }

// GET ROW
    public function getRow($id)
    {
        if(is_numeric($id))
        {
            $sql = "SELECT * FROM $this->table WHERE id = '$id'";
        } 
        else{
            $sql = "SELECT * FROM $this->table WHERE slug = '$id' AND status= '1'";
        }
        return $this->getOne($sql); 
    }
     // Thêm 
     public function insert($data)
     {
         $strf = implode(",", array_keys($data));
         $strv = ":" . implode(", :", array_keys($data));
 
         $sql = "INSERT INTO $this->table($strf) VALUES($strv)";
         return $this->insertDB($sql, $data);
     }

    // Cập nhật
    public function update($data, $id)
    {
        $strset = '';
        foreach ($data as $f => $v) {
            $strset .= $f . "='" . $v . "', ";
        }
        $strset = trim($strset, ', ');

        $sql = "UPDATE $this->table SET $strset WHERE id='$id'";
        return $this->updateDB($sql);
    }

    // Xóa
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        return $this->deleteDB($sql, ['id' => $id]);
    }
    
    // Lấy bài viết mới nhất
    public function getLatestPosts($limit = 4)
    {
        $sql = "SELECT * FROM hptd_post WHERE status = 1 ORDER BY created_at DESC LIMIT $limit";
        return $this->getAll($sql);
    }
    // Lấy tất cả bài viết với phân trang
    
    public function list_post_all($catid, $list_cat_id = [], $limit, $offset)
    {
        // Xử lý câu lệnh SQL khi không có danh mục
        if ($catid == null) {
            $sql = "SELECT * FROM $this->table WHERE status='1' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        } else {
            // Nếu danh sách danh mục không rỗng
            if (!empty($list_cat_id)) {
                $placeholders = implode(',', array_fill(0, count($list_cat_id), '?'));
                $sql = "SELECT * FROM $this->table WHERE status='1' AND topic_id IN ($placeholders) ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
            } else {
                // Nếu danh sách danh mục rỗng, xử lý theo cách mong muốn (ví dụ: không có điều kiện)
                $sql = "SELECT * FROM $this->table WHERE status='1' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
            }
        }
    
        // Truyền tham số vào phương thức getAll
        return $this->getAll($sql, $list_cat_id);
    }

    // Lấy tổng số bài viết
    public function list_post_all_count()
    {
        $sql="SELECT * FROM $this->table WHERE status='1'";
        return $this->getCount($sql);
    }


    public function list_post_other($list_cat_id,$id,$limit)
    {
        $strcatid=implode(',',$list_cat_id);
            $sql = "SELECT * FROM $this->table WHERE status='1' AND id!='$id' AND topic_id IN ($strcatid) ORDER BY created_at DESC LIMIT $limit";
    
        return $this->getAll($sql);
    }



    public function list_post_topic_count($list_cat_id)
    {
        $strcatid=implode(',',$list_cat_id);
        $sql="SELECT * FROM $this->table WHERE status='1' AND topic_id IN ($strcatid)";
        return $this->getCount($sql);
    }


    public function list_post_topic($list_cat_id,$limit,$offset)
    {
        $strcatid=implode(',',$list_cat_id);
            $sql = "SELECT * FROM $this->table WHERE status='1'  AND topic_id IN ($strcatid) ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    
        return $this->getAll($sql);
    }

}
?>
