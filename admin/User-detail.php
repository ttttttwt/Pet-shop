<?php include('layouts/header.php') ?>
<?php
$user = new User();
$result = $user->selectUserByID($_GET['id']);
if ($result[0]['role'] == 1) {
    $role = 'Admin';
} else {
    $role = 'User';
}

// if(isset($_POST['update'])){
//     // $user->updateUser($_GET['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['role']);
//     // header("Location: User-table.php");
//     // echo("<script>window.location.href='update_user.php?id='".$_GET['id']."</script>");
// }
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="User-table.php">User-table</a></li>
                <li class="breadcrumb-item active">UserID:
                    <?php echo ($role . "-" . $result[0]['IDuser']) ?>
                </li>
            </ol>

            <div class="row">
                <div class="col-xl-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-circle-info"></i>
                            User Detail
                        </div>
                        <div class="card-body">
                            <h3 class="px-4 h3">User ID:
                                <?php echo ($role . "-" . $result[0]['IDuser']) ?>
                            </h3>

                            <!-- <form method="post" class="row g-3 py-2 px-4"> -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputUsername"
                                    placeholder="myusername" name="username"
                                    value="<?php echo ($result[0]['username']) ?>" required readonly>
                                <label for="floatingInputUsername">Username</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInputEmail"
                                    placeholder="name@example.com" name="email"
                                    value="<?php echo ($result[0]['email']) ?>" required readonly>
                                <label for="floatingInputEmail">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInputPhone"
                                    placeholder="1234567890" name="phone" value="<?php echo ($result[0]['phone']) ?>"
                                    required readonly>
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
                                    href=<?php echo ("update_user.php?id=" . $_GET['id']) ?>>Update</a>
                            </div>
                            <!-- </form> -->
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Cart
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>IDgiohang</th>
                                        <th>IDhanghoa</th>
                                        <!-- <th>IDgiohang</th> -->
                                        <th>soluong</th>
                                        <th>dongia</th>
                                        <th>tongtien</th>
                                        <!-- <th>Edit</th> -->
                                        <!-- <th>Delete</th> -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>IDgiohang</th>
                                        <th>IDhanghoa</th>
                                        <!-- <th>IDgiohang</th> -->
                                        <th>soluong</th>
                                        <th>dongia</th>
                                        <th>tongtien</th>
                                        <!-- <th>Edit</th> -->
                                        <!-- <th>Delete</th> -->
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include_once('../backend/Cart.php');
                                    $cart = new Cart();
                                    $_SESSION['cart'] = $cart->getNumberOfCartByUserID($_SESSION['id']);
                                    $cart->loadDataByUserId($_GET['id']);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Order
                </div>
                <div class="card-body">
                    <table id="datatablesSimple2">
                        <thead>
                            <tr>
                            <th>IDdonhang</th>
                                <th>IDuser</th>
                                <!-- <th>IDgiohang</th> -->
                                <th>tongtien</th>
                                <th>ngaydat</th>
                                <th>ngaynhan</th>
                                <th>trangthai</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>IDdonhang</th>
                                <th>IDuser</th>
                                <!-- <th>IDgiohang</th> -->
                                <th>tongtien</th>
                                <th>ngaydat</th>
                                <th>ngaynhan</th>
                                <th>trangthai</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include_once('../backend/Order.php');
                            $order = new Order();
                            $order->loadDateOnTableByUserID($_GET['id']);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<!-- <script src="js/datatables-simple-demo.js"></script> -->
<script src="js/custom.js"></script>
</body>

</html>