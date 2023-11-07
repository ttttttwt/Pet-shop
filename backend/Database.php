<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'pet_shop';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Get the database connection
    public function __construct()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Connected to database';
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        // return $this->conn;
    }

    // Disconnect from database
    public function disconnect()
    {
        $this->conn = null;
    }


    //User
    // Get all users
    public function slectFromUSers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get user by username
    public function slectUser($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get user by id
    public function slectUserById($id)
    {
        $sql = "SELECT * FROM users WHERE IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Check if user exists
    public function checkUser($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $result;
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Check admin
    public function checkAdmin($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password AND role = '1'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $result;
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Insert user
    public function insertUser($username, $password, $email, $phone, $adress)
    {
        $sql = "INSERT INTO users VALUES ('',:username, :password, :email, :phone,:adress, :role)";
        $stmt = $this->conn->prepare($sql);
        // $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'phone' => $phone, 'role' => '0']);
        try {
            $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'phone' => $phone, 'adress'=>$adress, 'role' => '0']);
            return true;
        } catch (PDOException $e) {
            return false;
        }


    }

    // Update user
    public function updateUser($id, $username, $password, $email, $phone, $adress)
    {
        $sql = "UPDATE users SET username = :username, password = :password, email = :email, phone = :phone, adress = :adress WHERE IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id, 'username' => $username, 'password' => $password, 'email' => $email, 'phone' => $phone, 'adress' => $adress]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete user by id
    public function deleteUserByID($id)
    {
        $sql = "DELETE FROM users WHERE IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete user by username
    public function deleteUserByUsername($username)
    {
        $sql = "DELETE FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['username' => $username]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    // Category
    // Get all categories
    public function slectFromCategories()
    {
        $sql = "SELECT * FROM danhmuc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get category by id
    public function slectFromCategoriesByID($id)
    {
        $sql = "SELECT * FROM danhmuc WHERE IDdanhmuc = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get category by name
    public function slectFromCategoriesByName($name)
    {
        $sql = "SELECT * FROM danhmuc WHERE tendanhmuc = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Insert category
    public function insertCategory($name)
    {
        $sql = "INSERT INTO danhmuc VALUES ('',:name)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['name' => $name]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update category by id
    public function updateCategoryByID($id, $name)
    {
        $sql = "UPDATE danhmuc SET tendanhmuc = :name WHERE IDdanhmuc = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['name' => $name, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update category by name
    public function updateCategoryByName($name, $newname)
    {
        $sql = "UPDATE danhmuc SET tendanhmuc = :newname WHERE tendanhmuc = :name";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['newname' => $newname, 'name' => $name]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete category by id
    public function deleteCategoryByID($id)
    {
        $sql = "DELETE FROM danhmuc WHERE IDdanhmuc = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete category by name
    public function deleteCategoryByName($name)
    {
        $sql = "DELETE FROM danhmuc WHERE tendanhmuc = :name";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['name' => $name]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    // Product
    // Get all products
    public function selectFromProducts()
    {
        $sql = "SELECT * FROM hanghoa";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product by id
    public function selectProductById($id)
    {
        $sql = "SELECT * FROM hanghoa WHERE IDhanghoa = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product by fitler name
    public function selectProductByFilterName($name)
    {
        $sql = "SELECT * FROM hanghoa WHERE tenhanghoa LIKE %:name%";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Insert product
    public function insertProduct($name, $amout, $price, $description, $image, $IDcategory)
    {
        $sql = "INSERT INTO hanghoa VALUES ('',:name, :amout, :price, :description, :image, :IDcategory)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['name' => $name,
                            'amout' => $amout, 
                            'price' => $price, 
                            'description' => $description, 
                            'image' => $image, 
                            'IDcategory' => $IDcategory]);
                            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update product amount by id
    public function updateProductAmountById($id, $amout)
    {
        $sql = "UPDATE hanghoa SET soluong = :amout WHERE IDhanghoa = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['amout' => $amout, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update product
    public function updateProduct($id, $name, $amout, $price, $description, $image, $IDcategory)
    {
        $sql = "UPDATE hanghoa SET tenhanghoa = :name, soluong = :amout, dongia = :price, mota = :description, hinhanh = :image, IDdanhmuc = :IDcategory WHERE IDhanghoa = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['name' => $name,
                            'amout' => $amout, 
                            'price' => $price, 
                            'description' => $description, 
                            'image' => $image, 
                            'IDcategory' => $IDcategory,
                            'id' => $id]);
                            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete product by id
    public function deleteProductById($id)
    {
        $sql = "DELETE FROM hanghoa WHERE IDhanghoa = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Get ramdom product
    public function selectRamdomProduct()
    {
        $sql = "SELECT * FROM hanghoa ORDER BY RAND() LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get ramdom product not id
    public function selectRamdomProductNotId($id)
    {
        $sql = "SELECT * FROM hanghoa WHERE IDhanghoa != :id ORDER BY RAND() LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product with limit
    public function selectProductWithLimit($start, $limit)
    {
        $sql = "SELECT * FROM hanghoa LIMIT :start, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product with limit and category
    public function selectProductWithLimitAndCategory($start, $limit, $IDcategory)
    {
        $sql = "SELECT * FROM hanghoa WHERE IDdanhmuc = :IDcategory LIMIT :start, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':IDcategory', $IDcategory);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product with category
    public function selectProductWithCategory($IDcategory)
    {
        $sql = "SELECT * FROM hanghoa WHERE IDdanhmuc = :IDcategory";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':IDcategory', $IDcategory);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product by price DESC
    public function selectProductByPriceDESC()
    {
        $sql = "SELECT * FROM hanghoa ORDER BY dongia DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product by price DESC with limit
    public function selectProductByPriceDESCWithLimit($start, $limit)
    {
        $sql = "SELECT * FROM hanghoa ORDER BY dongia DESC LIMIT :start, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product by price ASC
    public function selectProductByPriceASC()
    {
        $sql = "SELECT * FROM hanghoa ORDER BY dongia ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get product by price ASC with limit
    public function selectProductByPriceASCWithLimit($start, $limit)
    {
        $sql = "SELECT * FROM hanghoa ORDER BY dongia ASC LIMIT :start, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // get product with multiple category
    public function selectProductWithMultipleCategory($IDcategory)
    {
        $sql = "SELECT * FROM hanghoa WHERE IDdanhmuc IN ($IDcategory)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectProductWithMultipleCategoryAndLimit($IDcategory, $start, $limit)
    {
        $sql = "SELECT * FROM hanghoa WHERE IDdanhmuc IN ($IDcategory) LIMIT :start, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get category id by product id
    public function selectCategoryIdByProductId($id)
    {
        $sql = "SELECT IDdanhmuc FROM hanghoa WHERE IDhanghoa = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   

    //order
    // Get all orders
    public function selectFromOrders()
    {
        $sql = "SELECT * FROM donhang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get order by id
    public function selectOrderById($id)
    {
        $sql = "SELECT * FROM donhang WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Insert order
    public function insertOrder($total, $status, $orderdate, $receiveddate, $IDuser)
    {
        $sql = "INSERT INTO donhang VALUES ('',:total, :status, :orderdate, :receiveddate, :IDuser)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['total' => $total,
                            'status' => $status, 
                            'orderdate' => $orderdate, 
                            'receiveddate' => $receiveddate, 
                            'IDuser' => $IDuser]);
                            
            return true;
        } catch (PDOException $e) {
            return false;
        }
        
    }

    // change status of order
    public function changeStatus($id, $status)
    {
        $sql = "UPDATE donhang SET trangthai = :status WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['status' => $status, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete order by id
    public function deleteOrderById($id)
    {
        $sql = "DELETE FROM donhang WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // update order
    public function updateOrder($id, $name, $total, $status, $orderdate, $receiveddate, $IDuser, $IDcart)
    {
        $sql = "UPDATE donhang SET tenkhachhang = :name, tongtien = :total, trangthai = :status, ngaydat = :orderdate, ngaynhan = :receiveddate, IDuser
            = :IDuser, IDcart = :IDcart WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([
                'name' => $name,
                'total' => $total,
                'status' => $status,
                'orderdate' => $orderdate,
                'receiveddate' => $receiveddate,
                'IDuser' => $IDuser,
                'IDcart' => $IDcart,
                'id' => $id
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // upadate received date
    public function updateReceivedDate($id, $receiveddate)
    {
        $sql = "UPDATE donhang SET ngaynhan = :receiveddate WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['receiveddate' => $receiveddate, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // select order by user id
    public function selectOrdersByUserId($id)
    {
        $sql = "SELECT * FROM donhang WHERE IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    // Order detail
    // Get all order detail by oder id
    public function selectOrderDetailByOrderId($id)
    {
        $sql = "SELECT * FROM chitietdonhang WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Insert order detail
    public function insertOrderDetail($idproduct, $amount, $idorder)
    {
        $sql = "INSERT INTO chitietdonhang VALUES ('',:idproduct, :amount, :idorder)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['idproduct' => $idproduct, 'amount' => $amount, 'idorder' => $idorder]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete order detail by id
    public function deleteOrderDetailById($id)
    {
        $sql = "DELETE FROM chitietdonhang WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete order detail by order id
    public function deleteOrderDetailByOrderId($id)
    {
        $sql = "DELETE FROM chitietdonhang WHERE IDdonhang = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // update order detail
    public function updateOrderDetail($id, $idproduct, $amout, $idorder)
    {
        $sql = "UPDATE chitietdonhang SET IDhanghoa = :idproduct, soluong = :amount, IDdonhang = :idorder WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['idproduct' => $idproduct, 'amount' => $amout, 'idorder' => $idorder, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // insert order and get id of order
    public function insertOrderAndGetId($total, $status, $orderdate, $receiveddate, $IDuser)
    {
        $sql = "INSERT INTO donhang VALUES ('',:total, :status, :orderdate, :receiveddate, :IDuser)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['total' => $total,
                            'status' => $status, 
                            'orderdate' => $orderdate, 
                            'receiveddate' => $receiveddate, 
                            'IDuser' => $IDuser]);
            $id = $this->conn->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            return false;
        }
    }

    // select order by status
    public function selectOrderByStatus($status)
    {
        $sql = "SELECT * FROM donhang WHERE trangthai = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // select order by status and user id
    public function selectOrderByStatusAndUserId($status, $id)
    {
        $sql = "SELECT * FROM donhang WHERE trangthai = :status AND IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // get all product id  in order detail
    public function selectAllProductIdInOrderDetail()
    {
        $sql = "SELECT DISTINCT IDhanghoa FROM chitietdonhang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // get all category id by product id in order detail
    public function selectAllCategoryIdByProductIdInOrderDetail()
    {
        $sql = "SELECT DISTINCT IDdanhmuc FROM hanghoa WHERE IDhanghoa IN (SELECT DISTINCT IDhanghoa FROM chitietdonhang)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // count the amount product of each category in order detail
    public function countAmountProductOfEachCategoryInOrderDetail()
    {
        // inner join hanghoa and chitietdonhang
        $sql = "SELECT IDdanhmuc, COUNT(chitietdonhang.IDhanghoa) AS amount FROM hanghoa INNER JOIN chitietdonhang ON hanghoa.IDhanghoa = chitietdonhang.IDhanghoa GROUP BY IDdanhmuc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // count the number product in one day of month
    public function countAmountProductInOneDayOfMonth()
    {
        $sql = "SELECT DAY(ngaydat) AS day, COUNT(IDdonhang) AS amount FROM donhang GROUP BY DAY(ngaydat)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // count the number product in one day by month
    public function countAmountProductInOneDayByMonth($month)
    {
        $sql = "SELECT DAY(ngaydat) AS day, COUNT(IDdonhang) AS amount FROM donhang WHERE MONTH(ngaydat) = :month GROUP BY DAY(ngaydat)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

   // get amount product in order detail
    public function getAmountProductInOrderDetail()
    {
        $sql = "SELECT IDhanghoa, soluong FROM chitietdonhang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    // get the total in order of one day
    public function getTotalInOrderOfOneDay($month)
    {
        $sql = "SELECT DAY(ngaydat) AS day, SUM(tongtien) AS total FROM donhang WHERE MONTH(ngaydat) = :month GROUP BY DAY(ngaydat)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    
    
    // Cart
    // Get all cart
    public function selectAllCart()
    {
        $sql = "SELECT * FROM giohang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get cart by id
    public function selectCartById($id)
    {
        $sql = "SELECT * FROM giohang WHERE IDgiohang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // get cart by id user
    public function selectCartByUserId($id)
    {
        $sql = "SELECT * FROM giohang WHERE IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Insert cart
    public function insertCart($idproduct, $amout, $iduser)
    {
        $sql = "INSERT INTO giohang VALUES ('',:idproduct, :amount, :iduser)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['idproduct' => $idproduct, 'amount' => $amout, 'iduser' => $iduser]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete cart by id
    public function deleteCartById($id)
    {
        $sql = "DELETE FROM giohang WHERE IDgiohang = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete cart by user id
    public function deleteCartByUserId($id)
    {
        $sql = "DELETE FROM giohang WHERE IDuser = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // select cart by product id and user id
    public function selectCartByProductIdAndUserId($idproduct, $iduser)
    {
        $sql = "SELECT * FROM giohang WHERE IDhanghoa = :idproduct AND IDuser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idproduct' => $idproduct, 'iduser' => $iduser]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }


    // delete cart by product id and user id
    public function deleteCartByProductIdAndUserId($idproduct, $iduser)
    {
        $sql = "DELETE FROM giohang WHERE IDhanghoa = :idproduct AND IDuser = :iduser";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['idproduct' => $idproduct, 'iduser' => $iduser]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // update cart
    public function updateCart($id, $idproduct, $amout, $iduser)
    {
        $sql = "UPDATE giohang SET IDhanghoa = :idproduct, soluong = :amount, IDuser = :iduser WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['idproduct' => $idproduct, 'amount' => $amout, 'iduser' => $iduser, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
        
    }

     // update amount cart
        public function updateAmountCart($id, $amout)
        {
            $sql = "UPDATE giohang SET soluong = :amount WHERE IDgiohang = :id";
            $stmt = $this->conn->prepare($sql);
            try {
                $stmt->execute(['amount' => $amout, 'id' => $id]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
            
        }
    
    
}

// $db = new Database();

// $result = $database->slectFromUSers();
// $check = $database->checkUser('hello1', '1234');
// $check = $database->checkAdmin('hello1', '1234');
// var_dump($check);
// $insert = $db->updateUser('1','hello1', '1234', '1234', '1234');
// var_dump($insert);
// echo var_dump($check);
// echo print_r($result);

// foreach($result as $row){
//     echo $row['username'];
//     echo $row['password'];
// }
