<?php
include_once('../Backend/Order.php');

$order = new Order();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $order->deleteOrder($id);
}