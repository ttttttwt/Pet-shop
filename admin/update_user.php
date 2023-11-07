<?php include_once('layouts/header.php') ?>
<?php
$user = new User();
$result = $user->selectUserByID($_GET['id']);
if ($result[0]['role'] == 1) {
    $role = 'Admin';
} else {
    $role = 'User';
}
// print_r($result);
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];
    $user->updateUser($_GET['id'], $username, $password, $email, $phone, $adress);
}
?>
<div id="layoutSidenav_content">
    <main>
        <!-- <h1>this is update user from</h1> -->
        <div class="container-fluid py-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="User-table.php">
                        User-table
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    update-user
                </li>
            </ol>
        </nav>
            <h3 class="px-4 h3">User ID:
                <?php echo ($role . "-" . $result[0]['IDuser']) ?>
            </h3>

            <form method="post" class="row g-3 py-2 px-4">
                <div class="form-floating mb-3 col-md-7">
                    <input type="text" class="form-control" id="floatingInputUsername" placeholder="myusername"
                        name="username" value="<?php echo ($result[0]['username']) ?>" required>
                    <label for="floatingInputUsername">Username</label>
                </div>

                <div class="form-floating mb-3 col-md-7">
                    <input type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com"
                        name="email" value="<?php echo ($result[0]['email']) ?>" required>
                    <label for="floatingInputEmail">Email address</label>
                </div>

                <div class="form-floating mb-3 col-md-7">
                    <input type="number" class="form-control" id="floatingInputPhone" placeholder="1234567890"
                        name="phone" value="<?php echo ($result[0]['phone']) ?>" required>
                    <label for="floatingInputPhone">Phone number</label>
                </div>

                <div class="form-floating mb-3 col-md-7">
                    <input type="text" class="form-control" id="floatingInputAdress" placeholder="myadress"
                        name="adress" value="<?php echo($result[0]['adress']) ?>" required>
                    <label for="floatingInputAdress">Adress</label>
                </div>

                <div class="form-floating mb-3 col-md-7">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                        value="<?php echo ($result[0]['password']) ?>" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="mb-2 col-md-12">
                    <button class="btn btn-lg btn-warning btn-login fw-bold text-uppercase" type="submit"
                        name="update">Update</button>
                </div>
            </form>
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
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>