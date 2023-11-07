<?php

include_once('backend/Cart.php');
// get the amount value 
$amount = $_GET['amount'];
// get the product id
$id = $_GET['id'];
// create a new cart object
$cart = new Cart();
// update the amount
$result = $cart->updateAmountCart($id, $amount);
if ($result) {
    // if success, redirect to the previous page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
} else {
    echo ('<script>alert("Update amount failed");</script>');
    // if failed, redirect to the previous page
    // header("Location: " . $_SERVER["HTTP_REFERER"]);
}

