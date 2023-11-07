<?php
include_once('../Backend/Product.php');

$product = new Product();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product->deleteProduct($id);
}