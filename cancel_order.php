<?php 

include('backend/Order.php');

$order = new Order();
$result = $order->changeStatus($_GET['id'], 2);

if ($result) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo "<script>alert('Change status failed!')</script>";
    echo "<script>window.location.href='index.php'</script>";
}