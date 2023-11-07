<?php

include_once(__DIR__ . '/Database.php');
include_once(__DIR__ . '/UploadFile.php');
include_once(__DIR__ . '/Category.php');

class Product
{
    private $db;
    private $upload;

    public function __construct()
    {
        $this->db = new Database();
        // $this->upload = new UploadFile();
    }

    public function loadDataOnTable()
    {
        $result = $this->db->selectFromProducts();
        $category = new Category();
        // print_r($result);
        // $i = 0;
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['IDhanghoa'] . "</td>";
            echo "<td><a href='../product_detail.php?id=" . $row['IDhanghoa'] . "'>" . $row['tenhanghoa'] . "</a></td>";
            echo "<td>" . $row['soluong'] . "</td>";
            echo "<td>" . $row['dongia'] . "</td>";
            echo "<td>" . $row['mota'] . "</td>";
            if (explode('/', $row['hinhanh'])[0] == 'img') {
                echo "<td><img class='img-fluid' style='min-height: 150px;' src='../" . $row['hinhanh'] . "' width='150' height='150'></td>";
            } else {
                echo "<td>" . '<img src="' . $row['hinhanh'] . '" alt="" with="150" height="150">' . "</td>";

            }
            // echo "<td>" . $row['IDdanhmuc'].'(' . "</td>";
            echo ("<td>" . $row['IDdanhmuc'] . "(" . $category->getNameById($row['IDdanhmuc']) . ")</td>");
            echo "<td><a class='btn btn-warning' href='../update_product.php?id=" . $row['IDhanghoa'] . "'>Edit <i class='fas fa-edit'></i></a></td>";
            echo "<td><a class='btn btn-danger' href='delete_product.php?id=" . $row['IDhanghoa'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    public function insertProduct($name, $amount, $price, $description, $category, $file = "")
    {
        if ($file != "") {
            // echo(2);
            $this->upload = new UploadFile($file, 'img/uploads/products/');
            $result = $this->upload->upload();

            if ($result) {
                $image = $this->upload->getFileName();
                $result2 = $this->db->insertProduct($name, $amount, $price, $description, $image, $category);
                if ($result2) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } else {
            // echo(3);
            $image = "https://dummyimage.com/400x500/dee2e6/6c757d.jpg";
            $result2 = $this->db->insertProduct($name, $amount, $price, $description, $image, $category);
            if ($result2) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function updateProduct($id, $name, $amount, $price, $description, $category, $file = "")
    {


        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $image = $file;
            $result2 = $this->db->updateProduct($id, $name, $amount, $price, $description, $image, $category);
            if ($result2) {
                return true;
            } else {
                return false;
            }

        } else {
            if (is_array($file)) {
                $this->upload = new UploadFile($file, 'img/uploads/products/');
                $result = $this->upload->upload();
                if ($result) {
                    $image = $this->upload->getFileName();
                    $result2 = $this->db->updateProduct($id, $name, $amount, $price, $description, $image, $category);
                    if ($result2) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            if (str_contains($file, 'uploads')) {
                $image = $file;
                $result2 = $this->db->updateProduct($id, $name, $amount, $price, $description, $image, $category);
                if ($result2) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $image = "https://dummyimage.com/400x500/dee2e6/6c757d.jpg";
                $result2 = $this->db->updateProduct($id, $name, $amount, $price, $description, $image, $category);
                if ($result2) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function getImageById($id)
    {
        $result = $this->db->selectProductByID($id);
        return $result[0]['hinhanh'];
    }

    public function getNameByID($id)
    {
        $result = $this->db->selectProductByID($id);
        return $result[0]['tenhanghoa'];
    }

    public function getPriceByID($id)
    {
        $result = $this->db->selectProductByID($id);
        return $result[0]['dongia'];
    }



    public function deleteProduct($id)
    {
        $result = $this->db->deleteProductByID($id);
        if ($result) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            echo "script>alert('Delete failed!')</script>";
            header("Location: " . $_SERVER["HTTP_REFERER"]);

        }
    }

    public function getProductByID($id)
    {
        $result = $this->db->selectProductByID($id);
        return $result;
    }

    public function getRamdomProduct()
    {
        $result = $this->db->selectRamdomProduct();
        return $result;
        // $i = 0;

    }

    public function getRamdomProductNotId($id)
    {
        $result = $this->db->selectRamdomProductNotId($id);
        return $result;

    }

    public function loadRamdomProductNotID($id)
    {
        $result = $this->db->selectRamdomProductNotId($id);
        // return $result;
        // $i = 0;
        // echo(1);
        foreach ($result as $row) {
            echo ('<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-90 border-0">
                <div class="card-img-top pt-2">
                    <img src="' . $row['hinhanh'] . '"
                        class="img-fluid mx-auto d-block i1" alt="Card image cap" >
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">
                        <a href="' . 'product_detail.php?id=' . $row['IDhanghoa'] . '" class=" font-weight-bold text-dark text-uppercase small">
                            ' . $row['tenhanghoa'] . '</a>
                    </h4>
                    <h5 class="card-price small text-warning">
                        <i>
                            <s>$' . (int) $row['dongia'] + 10 . '</s> $' . (int) $row['dongia'] . '</i>
                    </h5>
                </div>
            </div>
        </div>');
        }
    }

    // update product amount 
    public function updateAmount($id, $amount)
    {
        $result = $this->db->updateProductAmountById($id, $amount);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getAmountById($id)
    {
        $result = $this->db->selectProductByID($id);
        return $result[0]['soluong'];
    }


    // load data to shop1 page
    public function loadDataToShoPage1()
    {
        $result = $this->db->selectFromProducts();
        foreach ($result as $row) {
            echo ('<div class="col-6 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-100 border-0">
                <div class="card-img-top">
                    <img src="' . $row['hinhanh'] . '"
                        class="img-fluid mx-auto d-block i1" alt="Card image cap" >
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">
                        <a href="' . 'product_detail.php?id=' . $row['IDhanghoa'] . '" class=" font-weight-bold text-dark text-uppercase small">
                            ' . $row['tenhanghoa'] . '</a>
                    </h4>
                    <h5 class="card-price small text-warning">
                        <i>
                            <s>$' . (int) $row['dongia'] + 10 . '</s> $' . (int) $row['dongia'] . '</i>
                    </h5>
                </div>
            </div>
        </div>');
        }
    }

    // get the number of products
    public function getNumberOfProducts()
    {
        $result = $this->db->selectFromProducts();
        return count($result);
    }

    // load data to shop1 page with limit
    public function loadDataToShoPage1WithLimit($start = 0, $limit = 0, $category = null)
    {
        if ($category == null) {
            if ($start == 0 && $limit == 0) {
                $result = $this->db->selectFromProducts();
            } else {
                $result = $this->db->selectProductWithLimit($start, $limit);
            }

        } else {
            $result = $this->db->selectProductWithLimitAndCategory($start, $limit, $category);
        }

        // if ($start == 0 && $limit == 0) {
        //     $start = 0;
        //     $limit = $this->getNumberOfProducts();
        // }

        // $result = $this->db->selectProductWithLimit($start, $limit);
        foreach ($result as $row) {
            echo ('<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-90 border-0">
                <div class="card-img-top pt-2">
                    <img src="' . $row['hinhanh'] . '"
                        class="img-fluid mx-auto d-block i1" alt="Card image cap" >
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">
                        <a href="' . 'product_detail.php?id=' . $row['IDhanghoa'] . '" class=" font-weight-bold text-dark text-uppercase small">
                            ' . $row['tenhanghoa'] . '</a>
                    </h4>
                    <h5 class="card-price small text-warning">
                        <i>
                            <s>$' . (int) $row['dongia'] + 10 . '</s> $' . (int) $row['dongia'] . '</i>
                    </h5>
                </div>
            </div>
        </div>');
        }

    }

    // load data to shop1 page by price DESC with limit
    public function loadDataToShoPage1ByPriceDESCWithLimit($start = 0, $limit = 0)
    {
        if ($start == 0 && $limit == 0) {
            $start = 0;
            $limit = $this->getNumberOfProducts();
        }
        $result = $this->db->selectProductByPriceDESCWithLimit($start, $limit);

        foreach ($result as $row) {
            echo ('<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-90 border-0">
                <div class="card-img-top pt-2">
                    <img src="' . $row['hinhanh'] . '"
                        class="img-fluid mx-auto d-block i1" alt="Card image cap" >
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">
                        <a href="' . 'product_detail.php?id=' . $row['IDhanghoa'] . '" class=" font-weight-bold text-dark text-uppercase small">
                            ' . $row['tenhanghoa'] . '</a>
                    </h4>
                    <h5 class="card-price small text-warning">
                        <i>
                            <s>$' . (int) $row['dongia'] + 10 . '</s> $' . (int) $row['dongia'] . '</i>
                    </h5>
                </div>
            </div>
        </div>');
        }
    }

    // load data to shop1 page with multiple category
    public function loadDataToShoPage1WithMultipleCategory($category)
    {
        $result = $this->db->selectProductWithMultipleCategory($category);

        foreach ($result as $row) {
            echo ('<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-90 border-0">
                <div class="card-img-top pt-2">
                    <img src="' . $row['hinhanh'] . '"
                        class="img-fluid mx-auto d-block i1" alt="Card image cap" >
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">
                        <a href="' . 'product_detail.php?id=' . $row['IDhanghoa'] . '" class=" font-weight-bold text-dark text-uppercase small">
                            ' . $row['tenhanghoa'] . '</a>
                    </h4>
                    <h5 class="card-price small text-warning">
                        <i>
                            <s>$' . (int) $row['dongia'] + 10 . '</s> $' . (int) $row['dongia'] . '</i>
                    </h5>
                </div>
            </div>
        </div>');
        }
    }


    // load data to table with category
    public function loadDataToTableWithCategory($category)
    {
        $result = $this->db->selectProductWithCategory($category);

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['IDhanghoa'] . "</td>";
            echo "<td><a href='../product_detail.php?id=" . $row['IDhanghoa'] . "'>" . $row['tenhanghoa'] . "</a></td>";
            echo "<td>" . $row['soluong'] . "</td>";
            echo "<td>" . $row['dongia'] . "</td>";
            echo "<td>" . $row['mota'] . "</td>";
            if (explode('/', $row['hinhanh'])[0] == 'img') {
                echo "<td><img src='../" . $row['hinhanh'] . "' width='150' height='150'></td>";
            } else {
                echo "<td>" . '<img src="' . $row['hinhanh'] . '" alt="" with="150" height="150">' . "</td>";

            }
            // echo "<td>" . $row['IDdanhmuc'].'(' . "</td>";
            echo "<td><a class='btn btn-warning' href='../update_product.php?id=" . $row['IDhanghoa'] . "'>Edit <i class='fas fa-edit'></i></a></td>";
            echo "<td><a class='btn btn-danger' href='delete_product.php?id=" . $row['IDhanghoa'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    // count the product with category
    public function countProductWithCategory($category)
    {
        $result = $this->db->selectProductWithCategory($category);
        return count($result);
    }

    // sort product by price ASC with limit
    public function sortProductByPriceAsc($result)
    {
        $price = array();
        foreach ($result as $key => $row) {
            $price[$key] = $row['dongia'];
        }
        array_multisort($price, SORT_ASC, $result);
        return $result;
    }

    // sort product by price DESC
    public function sortProductByPriceDesc($result)
    {
        $price = array();
        foreach ($result as $key => $row) {
            $price[$key] = $row['dongia'];
        }
        array_multisort($price, SORT_DESC, $result);
        return $result;
    }

    // sort product by name ASC
    public function sortProductByNameAsc($result)
    {
        $name = array();
        foreach ($result as $key => $row) {
            $name[$key] = $row['tenhanghoa'];
        }
        array_multisort($name, SORT_ASC, $result);
        return $result;
    }

    // sort product by name DESC
    public function sortProductByNameDesc($result)
    {
        $name = array();
        foreach ($result as $key => $row) {
            $name[$key] = $row['tenhanghoa'];
        }
        array_multisort($name, SORT_DESC, $result);
        return $result;
    }

    // get product with limit as array
    public function getProductWithLimit($array, $start, $limit)
    {
        $result = array();
        for ($i = $start; $i < $start + $limit; $i++) {
            array_push($result, $array[$i]);
        }
        return $result;
    }

    // search product with name as new array
    public function searchProductWithName($result, $name)
    {
        $new_result = array();
        foreach ($result as $row) {
            if (str_contains($row['tenhanghoa'], $name)) {
                array_push($new_result, $row);
            }
        }
        return $new_result;
    }


    // load data to show page 1 final
    public function loadDataToShoPage1All($start = 0, $limit = 0, $category = null, $sort = null, $search = null)
    {
        // process category
        // if ($category != null) {
        //     $category = explode('c', $category);
        //     // array_shift($category);
        //     // change to string
        //     $category = implode(', ', $category);
        // }

        // get all product
        $result = $this->db->selectFromProducts();
        $number_of_products = count($result);

        // check start and limit
        if ($start == 0 && $limit == 0) {
            $start = 0;
            $limit = $number_of_products;
        }

        // check category
        if ($category != null) {
            $result = $this->db->selectProductWithMultipleCategory($category);
            $number_of_products = count($result);
        }

        // check search
        if ($search != null) {
            $search = strtolower($search);
            $result = $this->searchProductWithName($result, $search);
            $number_of_products = count($result);
        }
        // print_r($result);

        if ($number_of_products == 0) {
            echo ('<h1 class="text-center">No product find</h1>');
            return;
        }

        // check sort
        if ($sort == 'price-asc') {
            $result = $this->sortProductByPriceAsc($result);
            // echo ('<script>console.log("' . print_r($result) . '")</script>');
        } else if ($sort == 'price-desc') {
            $result = $this->sortProductByPriceDesc($result);
        } else if ($sort == 'name-asc') {
            $result = $this->sortProductByNameAsc($result);
        } else if ($sort == 'name-desc') {
            $result = $this->sortProductByNameDesc($result);
        }

        // check limit
        if ($number_of_products - $start < $limit) {
            $limit = $number_of_products - $start;
        }

        $result = $this->getProductWithLimit($result, $start, $limit);
        foreach ($result as $row) {
            echo ('<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-90 border-0">
                <div class="card-img-top pt-2">
                    <img src="' . $row['hinhanh'] . '"
                        class="img-fluid mx-auto d-block i1" alt="Card image cap" >
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">
                        <a href="' . 'product_detail.php?id=' . $row['IDhanghoa'] . '" class=" font-weight-bold text-dark text-uppercase small">
                            ' . $row['tenhanghoa'] . '</a>
                    </h4>
                    <h5 class="card-price small text-warning">
                        <i>
                            <s>$' . (int) $row['dongia'] + 10 . '</s> $' . (int) $row['dongia'] . '</i>
                    </h5>
                </div>
            </div>
        </div>');
        }
    }

    // get number of product after filter
    public function getNumberOfProductAfterFilter($category = null, $search = null)
    {

        // get all product
        $result = $this->db->selectFromProducts();

        // check category
        if ($category != null) {
            $result = $this->db->selectProductWithMultipleCategory($category);
        }

        // check search
        if ($search != null) {
            $search = strtolower($search);
            $result = $this->searchProductWithName($result, $search);
        }

        return count($result);
    }

}