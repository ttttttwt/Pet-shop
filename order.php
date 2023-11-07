<?php
session_start();
include_once('backend/Cart.php');

$cart = new Cart();
$cart->convertCartToOrder($_SESSION['id']);