<?php
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'hoangphungthanhdat_ltwed';
    private $conn = null;  

    function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // Trả về kết nối đã kết nối đến CSDL
    public function getConnection()
    {
        return $this->conn;
    }
    // Tất cả mẫu tin 
    function getAll($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    // Một mẫu tin 
    
    function getOne($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    // Số lượng mẫu tin 
    function getCount($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    } 

    // Thêm dữ liệu
    function insertDB($sql, $data)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    } 

    // Cập nhật dữ liệu
    function updateDB($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt->execute($params)) {
            print_r($stmt->errorInfo()); // In lỗi chi tiết
        }
    }

    // Xóa dữ liệu
    public function deleteDB($sql, $data)
        {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
        }
}

