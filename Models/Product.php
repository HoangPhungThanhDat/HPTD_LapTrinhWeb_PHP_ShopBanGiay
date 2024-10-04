<?php
class Product extends Database
{
    private $table = 'hptd_product';   
    function __construct()
    {
        parent::__construct(); //database
    }

    // Lấy tất cả sản phẩm
    public function getList($status)
    {
        // Truy vấn cơ bản với JOIN đến bảng category và brand
        $sql = "SELECT product.*, category.name as category_name, brand.name as brand_name
                FROM $this->table AS product
                JOIN hptd_category AS category ON product.category_id = category.id 
                JOIN hptd_brand AS brand ON product.brand_id = brand.id";
    
        // Thêm điều kiện WHERE dựa trên giá trị của $status
        switch ($status) {
            case 'index': {
                $sql .= " WHERE product.status != '0'";
                break;
            }
            case 'trash': {
                $sql .= " WHERE product.status = '0'";
                break;
            }
            default: {
                $sql .= " WHERE product.status = ?";
                break;
            }
        }
    
        // Thêm điều kiện ORDER BY
        $sql .= " ORDER BY product.created_at DESC";
    
        // Chuẩn bị và thực hiện truy vấn với $status nếu cần
        if ($status !== 'index' && $status !== 'trash') {
            return $this->getAll($sql, [$status]); // Sử dụng prepared statements
        } else {
            return $this->getAll($sql);
        }
    }

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
    
    public function getCategories() {
        $sql = "SELECT id, name FROM hptd_category";
        return $this->getAll($sql);
    }

    public function getBrands() {
        $sql = "SELECT id, name FROM hptd_brand";
        return $this->getAll($sql);
    }

    //frontend_sale
    public function get_list_product_sale($limit)
    {
        $sql = "SELECT * FROM $this->table WHERE pricesale>0 AND status='1' ORDER BY pricesale DESC LIMIT
        $limit";
        return $this->getAll($sql);
    }
    //frontend_new san pham moi nhat
    public function get_list_product_new($limit)
    {
        $sql = "SELECT * FROM $this->table WHERE status='1' ORDER BY created_at DESC LIMIT $limit";
        return $this->getAll($sql);
    }
    
    //lấy sản phẩm theo danh mục 
    function product_category_home($list_cat_id, $limit)
    {
        $strcatic = implode(',', $list_cat_id);
        $sql = "SELECT * FROM $this->table WHERE status='1' AND category_id IN ($strcatic) ORDER BY created_at DESC LIMIT $limit";
        return $this->getAll($sql);
    }


    // public function list_product_all($catid, $list_cat_id = [],$limit,$offset)
    // {
    //     if ($catid == null) {
    //         $sql = "SELECT * FROM $this->table WHERE status='1' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    //     } else {
    //         $strcatid = implode(',', $list_cat_id);
    //         $sql = "SELECT * FROM $this->table WHERE status='1' AND category_id IN ($strcatid) ORDER BY created_at DESC";
    //     }
    //     return $this->getAll($sql);
    // }


    // public function list_product_all_count()
    // {
    //     $sql="SELECT * FROM $this->table WHERE status='1'";
    //     return $this->getCount($sql);
    // }




    //đếm tổng số sản phẩm trong cơ sở dữ liệu, tùy thuộc vào việc có lọc theo danh mục (category_id) hay không
    public function list_product_all_count($catid, $list_cat_id)
    {
        if ($catid) {
            $cat_ids = implode(",", $list_cat_id);
            $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE category_id IN ($cat_ids) AND status='1'";
        } else {
            $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE status='1'";
        }
        return $this->getOne($sql)['total'];
    }

    //sử dụng để lấy danh sách các sản phẩm từ cơ sở dữ liệu
    public function list_product_all($catid, $list_cat_id, $limit, $offset)
    {
        if ($catid) {
            $cat_ids = implode(",", $list_cat_id);
            $sql = "SELECT * FROM $this->table WHERE category_id IN ($cat_ids) AND status='1'
                    ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        } else {
            $sql = "SELECT * FROM $this->table WHERE status='1' 
                    ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        }
        return $this->getAll($sql);
    }


    //lay san pham cung loai
    public function list_product_other($list_cat_id, $id, $limit)
    {
        $strcatid = implode(',', $list_cat_id);
        $sql = "SELECT * FROM $this->table WHERE status='1' AND category_id IN ($strcatid) AND id!= '$id' ORDER BY created_at DESC LIMIT $limit";
        return $this->getAll($sql);
    }    
}

?>
