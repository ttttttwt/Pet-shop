<?php

include_once(__DIR__ . '/Database.php');
include_once(__DIR__ . '/Product.php');
include_once(__DIR__ . '/Category.php');



class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // insert order
    public function insertOrder($total, $status, $orderdate, $receiveddate, $IDuser)
    {
        $result = $this->db->insertOrder($total, $status, $orderdate, $receiveddate, $IDuser);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertOrderAndGetID($total, $status, $orderdate, $receiveddate, $IDuser)
    {
        $result = $this->db->insertOrderAndGetId($total, $status, $orderdate, $receiveddate, $IDuser);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function loadDataOnTable()
    {
        $result = $this->db->selectFromOrders();
        foreach ($result as $row) {
            echo "<tr>";
            // echo "<td>".$row['IDdonhang']."</td>";
            echo "<td><a href='Order-detail.php?id=" . $row['IDdonhang'] . "'>" . $row['IDdonhang'] . "</a></td>";
            echo "<td>" . $row['IDuser'] . "</td>";
            // echo "<td>".$row['IDgiohang']."</td>";
            echo "<td>" . $row['tongtien'] . "</td>";
            echo "<td>" . $row['ngaydat'] . "</td>";
            if ($row['ngaynhan'] == null) {
                echo "<td>Chưa giao</td>";
            } else {
                echo "<td>" . $row['ngaynhan'] . "</td>";
            }
            // echo "<td>".$row['ngaynhan']."</td>";
            if ($row['trangthai'] == 0) {
                echo '<td><a class="btn btn-warning" href="update_status.php?id=' . $row['IDdonhang'] . '&status=' . $row['trangthai'] . '">Chưa xác nhận <i class="fas fa-edit"></i></a></td>';
            } elseif ($row['trangthai'] == 1) {
                echo '<td><a class="btn btn-success" href="update_status.php?id=' . $row['IDdonhang'] . '&status=' . $row['trangthai'] . '">Đã xác nhận <i class="fas fa-edit"></i></a></td>';
            } else {
                echo '<td><a class="btn btn-danger" href="update_status.php?id=' . $row['IDdonhang'] . '&status=' . $row['trangthai'] . '">Đã hủy <i class="fas fa-edit"></i></a></td>';
            }

            // echo "<td>".$row['trangthai']."</td>";
            // echo "<td><a class='btn btn-warning' href='update_order.php?id=".$row['IDdonhang']."'>Edit <i class='fas fa-edit'></i></a></td>";
            echo "<td><a class='btn btn-danger' href='delete_order.php?id=" . $row['IDdonhang'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    public function getOrders()
    {
        $result = $this->db->selectFromOrders();
        return $result;
    }

    public function getOrdersByUserId($userId)
    {
        $result = $this->db->selectOrdersByUserId($userId);
        return $result;
    }


    public function deleteOrder($id)
    {
        $result = $this->db->deleteOrderById($id);
        if ($result) {
            // header("Location: order.php");
            echo "<script>alert('Delete order successfully!')</script>";
            echo "<script>window.location.href = 'Order-table.php'</script>";
        } else {
            // header("Location: order.php");
            echo "<script>alert('Delete order failed!')</script>";
            echo "<script>window.location.href = 'Order-table.php'</script>";
        }
    }

    public function changeStatus($id, $status)
    {   
        if ($status == 1) {
            $this->sendMailToCustomer($id);
        }

        if ($status == 2) {
            $this->changeBackAmountOfProduct($id);
        }

        if ($status == 0) {
            $this->changeAmountOfProduct($id);
        }


        $result = $this->db->changeStatus($id, $status);
        if ($result) {
            // header("Location: order.php");
            return true;
        } else {
            // header("Location: order.php");
            return false;
        }
    }

    // order detail
    public function loadDataOnTableOrderDetail($id)
    {
        $result = $this->db->selectOrderDetailByOrderId($id);
        $product = new Product();

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><a href='../product_detail.php?id=" . $row['IDhanghoa'] . "'>" . $row['IDhanghoa'] . "(" . $product->getNameByID($row['IDhanghoa']) . ")" . "</a></td>";
            // echo "<td>".$row['IDhanghoa']."(".$product->getNameByID($row['IDhanghoa']).")"."</td>";
            echo "<td>" . $product->getPriceByID($row['IDhanghoa']) . "</td>";
            echo "<td>" . $row['soluong'] . "</td>";
            echo "<td>" . (int) $product->getPriceByID($row['IDhanghoa']) * (int) $row['soluong'] . "</td>";
            // echo "<td><a class='btn btn-danger' href='delete_order.php?id=".$row['IDdonhang']."'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    // order detail for user
    public function loadDataOnTableOrderDetailForUser($id)
    {
        $result = $this->db->selectOrderDetailByOrderId($id);
        $product = new Product();

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><a href='../product_detail.php?id=" . $row['IDhanghoa'] . "'>" . $row['IDhanghoa'] . "(" . $product->getNameByID($row['IDhanghoa']) . ")" . "</a></td>";
            // echo "<td>".$row['IDhanghoa']."(".$product->getNameByID($row['IDhanghoa']).")"."</td>";
            echo "<td>" . $product->getPriceByID($row['IDhanghoa']) . "</td>";
            echo "<td>" . $row['soluong'] . "</td>";
            echo "<td>" . (int) $product->getPriceByID($row['IDhanghoa']) * (int) $row['soluong'] . "</td>";
            // echo "<td><a class='btn btn-danger' href='delete_order.php?id=".$row['IDdonhang']."'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    public function getOrdersDetailByOrderId($orderId)
    {
        $result = $this->db->selectOrderDetailByOrderId($orderId);
        return $result;
    }

    public function loadDateOnTableByUserID($id)
    {
        $result = $this->db->selectOrdersByUserId($id);
        foreach ($result as $row) {
            echo "<tr>";
            // echo "<td>".$row['IDdonhang']."</td>";
            echo "<td><a href='Order-detail.php?id=" . $row['IDdonhang'] . "'>" . $row['IDdonhang'] . "</a></td>";
            echo "<td>" . $row['IDuser'] . "</td>";
            // echo "<td>".$row['IDgiohang']."</td>";
            echo "<td>" . $row['tongtien'] . "</td>";
            echo "<td>" . $row['ngaydat'] . "</td>";
            if ($row['ngaynhan'] == null) {
                echo "<td>Chưa giao</td>";
            } else {
                echo "<td>" . $row['ngaynhan'] . "</td>";
            }
            // echo "<td>".$row['ngaynhan']."</td>";
            if ($row['trangthai'] == 0) {
                echo "<td>Chưa xac nhan</td>";
            } elseif ($row['trangthai'] == 1) {
                echo "<td>Da xac nhan</td>";
            } else {
                echo "<td>Đã hủy</td>";
            }

            // echo "<td>".$row['trangthai']."</td>";
            // echo "<td><a class='btn btn-warning' href='update_order.php?id=".$row['IDdonhang']."'>Edit <i class='fas fa-edit'></i></a></td>";
            echo "<td><a class='btn btn-danger' href='delete_order.php?id=" . $row['IDdonhang'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    // insert order detail
    public function insertOrderDetail($idProduct, $amount, $idorder)
    {
        $this->db->insertOrderDetail($idProduct, $amount, $idorder);

    }

    // load data for user
    public function loadDataForUser($id)
    {
        $product = new Product();

        $result = $this->db->selectOrdersByUserId($id);
        $i = 0;
        foreach ($result as $row) {
            $cancel = '';
            $status = '';
            $j = 1;
            if ($row['trangthai'] == 0) {
                $row['trangthai'] = 'Chưa xác nhận';
                $status = 's0';
                $cancel = '<a class="btn  float-end btn-danger" href="cancel_order.php?id=' . $row['IDdonhang'] . '">Cancel <i class="fas fa-trash"></i></a>';
            } elseif ($row['trangthai'] == 1) {
                $row['trangthai'] = 'Đã xác nhận';
                $status = 's1';
            } else {
                $row['trangthai'] = 'Đã hủy';
                $status = 's2';
            }



            $result1 = $this->getOrdersDetailByOrderId($row['IDdonhang']);
            echo ('<div class="accordion-item">
            <h2 class="accordion-header" id="heading' . $i . '">
                <button class="accordion-button collapsed ' . $status . '" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse' . $i . '" aria-expanded="true" aria-controls="collapse' . $i . '">
                    Order ID: ' . $row['IDdonhang'] . ' - Date: ' . $row['ngaydat'] . ' - Total: ' . $row['tongtien'] . ' - Status: ' . $row['trangthai'] . '
                </button>
            </h2>
            <div id="collapse' . $i . '" class="accordion-collapse collapse" aria-labelledby="heading' . $i . '"
                data-bs-parent="#accordionExample">
                <div class="accordion-body overflow-auto">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">HangHoa</th>
                                <th scope="col">So luong</th>
                                <th scope="col">Dongia</th>
                                <th scope="col">Tong tien</th>
                            </tr>
                        </thead>
                        <tbody>');
            foreach ($result1 as $row1) {
                echo ('<tr>
                    <td class="r1" >' . $j . '</td>
                    <td>' . '<div class="row"><div class="col-md-3 text-start">
                    <img src="' . $product->getImageById($row1['IDhanghoa']) . '" alt="" height="100px" 
                        class="img-fluid equalimage d-none d-md-block rounded mb-2 shadow ">
                </div>
                <div class="col-md-9 text-start mt-sm-2">
                    <h4><a href="product_detail.php?id=' . $row1['IDhanghoa'] . '">' . $product->getNameByID($row1['IDhanghoa']) . '</a></h4>

                    <p class="font-weight-light">My pet shop</p>
                </div></div>' . '</td>
                    <td>' . $row1['soluong'] . '</td>
                    <td>' . $product->getAmountById($row1['IDhanghoa']) . '</td>
                    <td class="r1" >' . $row1['soluong'] * $product->getAmountById($row1['IDhanghoa']) . '</td>
                </tr>');
                $j++;
            }
            echo ('</tbody>
            </table>
                ' . $cancel . '
                    </div>
                </div>
            </div>');
            $i++;
        }
    }

    // count the number of orders
    public function countOrders()
    {
        $result = $this->db->selectFromOrders();
        return count($result);
    }

    // count the number of orders by user id
    public function countOrdersByUserId($id)
    {
        $result = $this->db->selectOrdersByUserId($id);
        return count($result);
    }

    // count the number of orders by user id and status
    public function countOrdersByUserIdAndStatus($id, $status)
    {
        $result = $this->db->selectOrderByStatusAndUserId($id, $status);
        return count($result);
    }

    // count the number of orders by status
    public function countOrdersByStatus($status)
    {
        $result = $this->db->selectOrderByStatus($status);
        return count($result);
    }

    // get category id in order detail
    public function getCategoryIdInOrderDetail()
    {
        $category1 = new Category();
        $result = $this->db->countAmountProductOfEachCategoryInOrderDetail();
        // return $result;
        // split the result into 2 arrays
        $category = array();
        $amount = array();
        foreach ($result as $row) {
            array_push($category, $row['IDdanhmuc']);
            array_push($amount, $row['amount']);
        }

        // get the name of category
        $categoryName = array();
        foreach ($category as $row) {
            array_push($categoryName, $category1->getNameCategoryById($row));
        }
        $data = array(
            'category' => $categoryName,
            'amount' => $amount
        );
        return $data;

    }


    //get the number of one day by month
    public function getNumberOfOneDayByMonth($month)
    {
        $result = $this->db->countAmountProductInOneDayByMonth($month);
        // split the result into 2 arrays
        $day = array();
        $amount = array();
        foreach ($result as $row) {
            array_push($day, $row['day']);
            array_push($amount, $row['amount']);
        }

        $numOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
        // create an array with $numOfMonth elements
        $dayOfMounth = array_fill(1, $numOfMonth, 0);
        foreach ($dayOfMounth as $key => $value) {
            if (in_array($key, $day)) {
                $dayOfMounth[$key] = $amount[array_search($key, $day)];
            } else {
                $dayOfMounth[$key] = 0;
            }
        }

        // print_r($dayOfMounth);
        return $dayOfMounth;
    }

    // get the lagest amount of product one day by month
    public function getLagestAmountOfProductOneDayByMonth($month)
    {
        $result = $this->getNumberOfOneDayByMonth($month);

        // print_r($dayOfMounth);
        return max($result);
    }

    // get the amount of each product in order detail
    public function getAmountOfEachProductInOrderDetail()
    {
        $product1 = new Product();
        $result = $this->db->getAmountProductInOrderDetail();
        // split the result into 2 arrays
        $product = array();
        $amount = array();
        foreach ($result as $row) {
            array_push($product, $row['IDhanghoa']);
        }

        // sort the array
        // delete the duplicate elements
        $product = array_unique($product);

        // create an new array with name of product
        $name = array();
        foreach ($product as $value) {
            array_push($name, $product1->getNameByID($value));
        }

        foreach ($product as $value) {
            // print_r($value);
            // echo ('<br>');
            foreach ($result as $row) {
                if ($value == $row['IDhanghoa']) {
                    // sum the amount of each product
                    // $amount[$value] = $row['soluong'];
                    if (isset($amount[$value])) {
                        $amount[$value] += $row['soluong'];
                    } else {
                        $amount[$value] = $row['soluong'];
                    }
                }
            }

        }

        // create a new array with name and amount
        $data = array(
            'name' => $name,
            'amount' => $amount
        );

        // print_r($name);
        return $data;
    }

    // get the total amount in order of one day
    public function getTotalAmountInOrderOfOneDay($month)
    {
        $result = $this->db->getTotalInOrderOfOneDay($month);
        // print_r($result);
        // split the result into 2 arrays
        $day = array();
        $total = array();
        foreach ($result as $row) {
            array_push($day, $row['day']);
            array_push($total, $row['total']);
        }

        $numOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
        // create an array with $numOfMonth elements
        $dayOfMounth = array_fill(1, $numOfMonth, 0);
        foreach ($dayOfMounth as $key => $value) {
            if (in_array($key, $day)) {
                $dayOfMounth[$key] = $total[array_search($key, $day)];
            } else {
                $dayOfMounth[$key] = 0;
            }
        }

        // print_r($dayOfMounth);
        return $dayOfMounth;
    }

    // change back amount of product when cancel order
    public function changeBackAmountOfProduct($id)
    {
        $result = $this->getOrdersDetailByOrderId($id);
        $product = new Product();
        foreach ($result as $row) {
            $product->updateAmount($row['IDhanghoa'], $product->getAmountById($row['IDhanghoa']) + $row['soluong']);
        }
    }

    public function changeAmountOfProduct($id)
    {
        $result = $this->getOrdersDetailByOrderId($id);
        $product = new Product();
        foreach ($result as $row) {
            $product->updateAmount($row['IDhanghoa'], $product->getAmountById($row['IDhanghoa']) - $row['soluong']);
        }
    }

    // get orders by id
    public function getOrdersByID($id)
    {
        $result = $this->db->selectOrderById($id);
        return $result;
    }
    // send mail to customer
    public function sendMailToCustomer($id)
    {
        include_once(__DIR__ . '/User.php');
        $product = new Product();
        $informatiomOfoder = $this->getOrdersByID($id);
        $result = $this->getOrdersDetailByOrderId($id);
        $customer = new User();
        $informatiom = $customer->selectUserByID($informatiomOfoder[0]['IDuser']);
        $name = $informatiom[0]['username'];
        $email = $informatiom[0]['email'];
        $phone = $informatiom[0]['phone'];
        $address = $informatiom[0]['adress'];

        $content = 'Chào bạn ' . $name . ',<br>';
        $content .= 'Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi.<br>';
        $content .= 'Đơn hàng của bạn đã được xác nhận và đang được xử lý.<br>';
        $content .= 'Thông tin đơn hàng của bạn:<br>';
        $content .= 'Mã đơn hàng: ' . $id . '<br>';
        $content .= 'Tên khách hàng: ' . $name . '<br>';
        $content .= 'Số điện thoại: ' . $phone . '<br>';
        $content .= 'Địa chỉ: ' . $address . '<br>';
        $content .= 'Danh sách sản phẩm:<br>';
        $content .= '<table border="1" style="border-collapse: collapse;">';
        $content .= '<tr>';
        $content .= '<th>Tên sản phẩm</th>';
        $content .= '<th>Số lượng</th>';
        $content .= '<th>Đơn giá</th>';
        $content .= '<th>Thành tiền</th>';
        $content .= '</tr>';
        $total = 0;
        foreach ($result as $row) {
            $content .= '<tr>';
            $content .= '<td>' . $product->getNameByID($row['IDhanghoa']) . '</td>';
            $content .= '<td>' . $row['soluong'] . '</td>';
            $content .= '<td>' . number_format($product->getPriceByID($row['IDhanghoa'])) . ' VNĐ</td>';
            $content .= '<td>' . number_format($row['soluong'] * $product->getPriceByID($row['IDhanghoa'])) . ' VNĐ</td>';
            $content .= '</tr>';
            $total += $row['soluong'] * $product->getPriceByID($row['IDhanghoa']);
        }
        $content .= '<tr>';
        $content .= '<td colspan="3">Tổng tiền</td>';
        $content .= '<td>' . number_format($total) . ' VNĐ</td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= 'Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.<br>';
        $content .= 'Trân trọng cảm ơn!<br>';
        $content .= 'Cửa hàng chúng tôi';

        $to = $email;
        $subject = 'Thông tin đơn hàng';
        $headers = "From: " . 'quocla.21it@vku.udn.vn' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to, $subject, $content, $headers);


    }


}