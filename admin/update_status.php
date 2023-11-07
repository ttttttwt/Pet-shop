<?php 

include_once('../backend/Order.php');

$id = $_GET['id'];
$status = $_GET['status'];


$order = new Order();

if ((int)$status >= 2) {
    $result = $order->changeStatus($id, 0);
} else {
    $result = $order->changeStatus($id, (int)$status + 1);
}


if ($result) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo "<script>alert('Change status failed!')</script>";
    echo "<script>window.location.href='index.php'</script>";
}