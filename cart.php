<?php include 'layouts/header.php'; ?>
<?php include 'backend/Cart.php'; ?>
<?php


    $cart = new Cart();
    $user = $_SESSION['id'];
    

?>
<style>
    .rounded {
        /* border-radius: true !important; */
        border-radius: 0.25rem!important;
    }

    .equalimage {
        width: 150px !important;
        /* height: 100px !important; */
    }
</style>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                <p class="mb-5 text-center">
                    <i class="text-info font-weight-bold"><?php echo($cart->getNumberOfCartByUserId($user)) ?></i> items in your cart
                </p>
                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                        <tr>
                            <th style="width:55%">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:10%">Total</th>
                            <th style="width:10%">Amount</th>
                            <th style="width:16%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $_SESSION['cart'] = $cart->getNumberOfCartByUserId($user);
                            $cart->loadDateForCartPage($user);
                        ?>
                    </tbody>
                </table>
                <div class="float-end text-end">
                    <h4>Subtotal:</h4>
                    <h1>$<?php echo($cart->getTotalPriceOfCartByUserId($user)) ?></h1>
                </div>
            </div>
        </div>
        <div class="row mt-4 d-flex align-items-center">
            <div class="col-sm-6 order-md-2 text-end">
                <a href="order.php" class="btn btn-primary mb-4 btn-lg px-5">Order</a>
            </div>
            <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-start">
                <a href="shop.php">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
            </div>
        </div>
    </div>
</section>
<?php include 'layouts/footer.php'; ?>
<!-- <script src="js/custom.js"></script> -->