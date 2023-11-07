<?php

include_once('../backend/Cart.php');

$cart = new Cart();
$cart->deleteCartFromAdmin($_GET['id']);
// $_SESSION['cart'] = $cart->getNumberOfCartByUserId($_SESSION['id']);
