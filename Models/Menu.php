<?php
class Menu extends Database
{
    private $table = 'hptd_menu';   
    function __construct()
    {
        parent::__construct(); //database
    }

    
    

    public function getRow($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = '$id'";  
        return $this->getOne($sql); 
    }

    // Thêm
    public function insert($data)
    {
        $strf = '';
        $strv = '';
        foreach ($data as $f => $v) {
            $strf .= "$f,";
            $strv .= "'" . $v . "', ";
        }
        $strf = trim($strf, ',');
        $strv = trim($strv, ', ');

        $sql = "INSERT INTO $this->table($strf) VALUES($strv)";
        return $this->insertDB($sql);
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

    // Lấy tất cả sản phẩm
    public function getList($status)
    {
        // Lấy dữ liệu từ bảng menu
        $sql = "SELECT * FROM $this->table AS menu";
        
        // Thêm điều kiện WHERE dựa trên giá trị của $status
        switch ($status) {
            case 'index': {
                $sql .= " WHERE menu.status != '0'";
                break;
            }
            case 'trash': {
                $sql .= " WHERE menu.status = '0'";
                break;
            }
            default: {
                $sql .= " WHERE menu.status = ?";
                break;
            }
        }
    
        // Thêm điều kiện ORDER BY
        $sql .= " ORDER BY menu.created_at DESC";
        
        // Lấy danh sách menu
        $menus = $this->getAll($sql, $status !== 'index' && $status !== 'trash' ? [$status] : []);
    
        // Duyệt qua từng menu để lấy thêm dữ liệu từ các bảng khác
        foreach ($menus as &$menu) {
            $menu['category_name'] = isset($menu['category_id']) ? $this->getSingleValue("SELECT name FROM hptd_category WHERE id = ?", [$menu['category_id']]) : null;
            $menu['brand_name'] = isset($menu['brand_id']) ? $this->getSingleValue("SELECT name FROM hptd_brand WHERE id = ?", [$menu['brand_id']]) : null;
            $menu['topic_name'] = isset($menu['topic_id']) ? $this->getSingleValue("SELECT name FROM hptd_topic WHERE id = ?", [$menu['topic_id']]) : null;
            $menu['post_title'] = isset($menu['post_id']) ? $this->getSingleValue("SELECT title FROM hptd_post WHERE id = ?", [$menu['post_id']]) : null;
        }
        
    
        return $menus;
    }
    
    // Hàm hỗ trợ để lấy giá trị đơn từ truy vấn
    private function getSingleValue($sql, $params = [])
{
    $result = $this->getRow($sql, $params);
    return $result ? array_values($result)[0] : null;
}

public function list_Category() {
        $sql = "SELECT id, name FROM hptd_category";
        return $this->getAll($sql);
    }

    public function list_Brand() {
        $sql = "SELECT id, name FROM hptd_brand";
        return $this->getAll($sql);
    }
    
    public function list_Post() {
        $sql = "SELECT id, type FROM hptd_post LIMIT 2";
        return $this->getAll($sql);
    }
    
    public function list_Topic() {
        $sql = "SELECT id, name FROM hptd_topic";
        return $this->getAll($sql);
    }
    
}
?>
