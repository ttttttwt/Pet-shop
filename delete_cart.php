<?php
session_start();
include_once('backend/Cart.php');

$cart = new Cart();
$result = $cart->deleteCartFromUser($_GET['id']);
// echo($result);
$_SESSION['cart'] = $cart->getNumberOfCartByUserId($_SESSION['id']);
if ($result) {
    // header('Location: cart.php');
    // echo("<script>window.location.reload();</script>");
    echo("<script>window.location.href = 'cart.php';</script>");
} else {
    // echo "Erro";
    echo("<script>alert('Delete failed');</script>");
    echo("<script>window.location.href = 'cart.php';</script>");
}
