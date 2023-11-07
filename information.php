<?php include 'layouts/header.php'; ?>
<?php

include_once('backend/User.php');
include_once('backend/Order.php');
$order = new Order();
$user = new User();
$result = $user->selectUserByID($_SESSION['id']);
if ($result[0]['role'] == 1) {
    $role = 'Admin';
} else {
    $role = 'User';
}

$numOrders = $order->countOrdersByUserId($_SESSION['id']);
$status0 = $order->countOrdersByUserIdAndStatus($_SESSION['id'], 0);
$status1 = $order->countOrdersByUserIdAndStatus($_SESSION['id'], 1);
$status2 = $order->countOrdersByUserIdAndStatus($_SESSION['id'], 2);
?>

<style>
    .s1 {
        border-left: 0.3rem solid #4e73df;
        border-radius: 10px 0px 0px 10px;
    }

    .s2 {
        border-left: 0.25rem solid #1cc88a;
        border-radius: 10px 0px 0px 10px;
    }

    .s3 {
        border-left: 0.25rem solid #e74a3b;
        border-radius: 10px 0px 0px 10px;
    }

    .s4 {
        border-left: 0.25rem solid #f6c23e;
        border-radius: 10px 0px 0px 10px;
    }

    .t1 {
        --bs-text-opacity: 1;
        color: #4e73df !important;
    }

    .t2 {
        --bs-text-opacity: 1;
        color: teal !important;
    }
</style>


<section>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-3 order-md-1 col-lg-3 mb-4">
                <h3 class="mt-0 mb-2 text-center"> <span class="t2">
                        Your orders</span> </h3>

                <div class="card s1 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media-body text-start">
                                <h3>
                                    <?php echo ($numOrders) ?>
                                </h3>
                                <span class="small">Orders</span>

                            </div>
                            <div class="align-self-center">
                                <i class=" t1 fa-solid fa-cart-shopping float-start display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card s4 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media-body text-start">
                                <h3>
                                    <?php echo ($status0) ?>
                                </h3>
                                <span class="small">Orders</span>

                            </div>
                            <div class="align-self-center">
                                <i class="fa-solid text-warning fa-circle-exclamation float-start display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card s2 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media-body text-start">
                                <h3>
                                    <?php echo ($status1) ?>
                                </h3>
                                <span class="small">Orders</span>

                            </div>
                            <div class="align-self-center">
                                <i class="text-success fa-solid fa-circle-check float-start display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card s3 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media-body text-start">
                                <h3>
                                    <?php echo ($status2) ?>
                                </h3>
                                <span class="small">Orders</span>

                            </div>
                            <div class="align-self-center">
                                <i class="fa-solid text-danger fa-circle-xmark float-start display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 order-md-2 col-lg-9 mb-4">
                <div>
                    <h3 class="px-4 h3">User ID:
                        <?php echo ($role . "-" . $result[0]['IDuser']) ?>
                    </h3>

                    <!-- <form method="post" class="row g-3 py-2 px-4"> -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputUsername" placeholder="myusername"
                            name="username" value="<?php echo ($result[0]['username']) ?>" required readonly>
                        <label for="floatingInputUsername">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com"
                            name="email" value="<?php echo ($result[0]['email']) ?>" required readonly>
                        <label for="floatingInputEmail">Email address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInputPhone" placeholder="1234567890"
                            name="phone" value="<?php echo ($result[0]['phone']) ?>" required readonly>
                        <label for="floatingInputPhone">Phone number</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password" value="<?php echo ($result[0]['password']) ?>" required readonly>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <!-- <form method="post"> -->
                    <div class="mb-2">
                        <a class="btn btn-lg btn-warning btn-login fw-bold text-uppercase float-end" type="submit"
                            href=<?php echo ("update_user.php") ?>>Update</a>
                    </div>
                    <!-- </form> -->
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</section>


<?php include 'layouts/footer.php'; ?>