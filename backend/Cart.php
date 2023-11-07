<?php

include_once(__DIR__ . '/Database.php');
include_once(__DIR__ . '/Product.php');
include_once(__DIR__ . '/Order.php');

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCartItems()
    {
        $result = $this->db->selectAllCart();
        return $result;
    }

    public function getCartByUserId($userId)
    {
        $result = $this->db->selectCartByUserId($userId);
        return $result;
    }

    public function loadDataByUserId($userId)
    {
        $result = $this->db->selectCartByUserId($userId);
        // print_r($result);
        $product = new Product();

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['IDgiohang'] . "</td>";
            // echo "<td>" . $row['IDhanghoa'] . "</td>";
            echo "<td><a href='../product_detail.php?id=" . $row['IDhanghoa'] . "'>" . $row['IDhanghoa'] . "(" . $product->getNameByID($row['IDhanghoa']) . ")" . "</a></td>";
            echo "<td>" . $row['soluong'] . "</td>";
            echo "<td>" . $product->getPriceByID($row['IDhanghoa']) . "</td>";
            echo "<td>" . (int) $product->getPriceByID($row['IDhanghoa']) * (int) $row['soluong'] . "</td>";
            echo "<td><a class='btn btn-danger' href='delete_cart.php?id=" . $row['IDgiohang'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    // load data for cart page
    public function loadDateForCartPage($userId)
    {
        $result = $this->db->selectCartByUserId($userId);
        // print_r($result);
        $product = new Product();

        foreach ($result as $row) {
            echo ('<tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-md-3 text-start">
                        <img src="' . $product->getImageById($row['IDhanghoa']) . '" alt=""
                            class="img-fluid equalimage d-none d-md-block rounded mb-2 shadow ">
                    </div>
                    <div class="col-md-9 text-start mt-sm-2">
                        <h4><a href="product_detail.php?id=' . $row['IDhanghoa'] . '">' . $product->getNameByID($row['IDhanghoa']) . '</a></h4>
                        <h4 class="id" style="display: none;">'.$row['IDgiohang'].'</h4>

                        <p class="font-weight-light">My pet shop</p>
                    </div>
                </div>
            </td>
            <td data-th="Price" class = "price">' . (int) $product->getPriceByID($row['IDhanghoa']). '</td>
            <td data-th="Total" class = "total">' . (int) $product->getPriceByID($row['IDhanghoa']) * (int) $row['soluong'] . '</td>
            <td data-th="Amount">
                <input type="number" onkeyup="getAmountInRange(0, '.(int) $product->getAmountById($row['IDhanghoa']).')"  min="0" max="'.(int) $product->getAmountById($row['IDhanghoa']).'" class="form-control form-control-lg text-center amount" value="' . (int) $row['soluong'] . '">
            </td>
            <td class="actions" data-th="">
                <div class="text-end">
                    <a href="delete_cart.php?id=' . $row['IDgiohang'] . '" class="btn btn-white border-secondary bg-white btn-md mb-2">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>');
        }
    }

    public function deleteCartFromAdmin($id)
    {
        $result = $this->db->deleteCartById($id);
        // return $result;
        if ($result) {
            echo "<script>alert('Delete success');</script>";
            // echo ("<script>window.location.reload();';</script>");
            header("Location: " . $_SERVER['HTTP_REFERER']);


        } else {
            echo '<script>alert("Delete failed");</script>';
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    //insert cart
    public function insertCart($userId, $productId, $amount)
    {
        $result = $this->db->insertCart($userId, $productId, $amount);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // delete cart by id product and id user
    public function deleteCartByIDproductAndIDuser($productId, $userId)
    {
        $result = $this->db->deleteCartByProductIdAndUserId($productId, $userId);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //change to order
    public function changeToOrder($userId, $array_product, $total)
    {
        $order = new Order();
        try {
            $result = $order->insertOrderAndGetID($total, '0', date("Y/m/d"), "NULL", $userId);
            $prodcut = new Product();
            foreach ($array_product as $key => $value) {
                $order->insertOrderDetail($key, $value, $result);
                $prodcut->updateAmount($key, (int) $prodcut->getAmountByID($key) - $value);
                $this->deleteCartByIDproductAndIDuser($key, $userId);
            }
            return true;
        } catch (Exception $e) {
            return false;
            // echo $e->getMessage();
        }
    }

    // get number of cart by user id
    public function getNumberOfCartByUserId($userId)
    {
        $result = $this->db->selectCartByUserId($userId);
        return count($result);
    }

    // add to cart
    public function addToCart($userId, $productId, $amount)
    {
        $result = $this->db->selectCartByProductIdAndUserId($productId, $userId);
        // echo((var_dump(count($result))));
        if (is_array($result)) {
            // var_dump($result);
            // echo(1);
            $result1 = $this->db->updateAmountCart($result['IDgiohang'], (int) $result['soluong'] + (int) $amount);
        } else {
            // var_dump($result);
            // echo(2);
            $result1 = $this->db->insertCart($productId, $amount, $userId);
        }

        if ($result1) {
            echo ("<script>alert('Add to cart success');</script>");
            $_SESSION['cart'] = $this->getNumberOfCartByUserId($userId);
            // echo ("<script>window.location.reload();';</script>");
            echo ("<script>window.location.href = 'product_detail.php?id=" . $productId . "';</script>");
        } else {
            // return false;
            echo ("<script>alert('Add to cart failed');</script>");
            // header("Location: " . $_SERVER['HTTP_REFERER']);
            // echo ("<script>window.location.reload();';</script>");
            echo ("<script>window.location.href = 'product_detail.php?id=" . $productId . "';</script>");
        }
    }

    // get total price of cart by user id
    public function getTotalPriceOfCartByUserId($userId)
    {
        $result = $this->db->selectCartByUserId($userId);
        $product = new Product();
        $total = 0;
        foreach ($result as $row) {
            $total += (int) $product->getPriceByID($row['IDhanghoa']) * (int) $row['soluong'];
        }
        return $total;
    }

    // Delete cart from user
    public function deleteCartFromUser($id)
    {
        $result = $this->db->deleteCartById($id);
        // return $result;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // update amount cart
    public function updateAmountCart($id, $amount)
    {
        $result = $this->db->updateAmountCart($id, $amount);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // covert cart to order
    public function convertCartToOrder($userId)
    {
        $result = $this->db->selectCartByUserId($userId);
        $product = new Product();
        $total = 0;
        $array_product = array();
        foreach ($result as $row) {
            $array_product[$row['IDhanghoa']] = $row['soluong'];
            $total += (int) $product->getPriceByID($row['IDhanghoa']) * (int) $row['soluong'];
        }
        $result = $this->changeToOrder($userId, $array_product, $total);
        if ($result) {
            echo ("<script>alert('Convert to order success');</script>");
            // echo ("<script>window.location.reload();';</script>");
            echo ("<script>window.location.href = 'order_detail.php';</script>");
        } else {
            echo ("<script>alert('Convert to order failed');</script>");
            // echo ("<script>window.location.reload();';</script>");
            echo ("<script>window.location.href = 'cart.php';</script>");
        }
    }
    
}