<?php include 'layouts/header.php'; ?>
<?php

include_once('backend/User.php');
$user = new User();
$result = $user->selectUserByID($_SESSION['id']);
if ($result[0]['role'] == 1) {
    $role = 'Admin';
} else {
    $role = 'User';
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];
    $user->updateUser2($_SESSION['id'], $username, $password, $email, $phone, $adress);
}



// print_r($result);
?>

<section>
    <div class="container pt-5 pb-5">
        <div class="mb-5">
            <h3 class="h3">User ID:
                <?php echo ($role . "-" . $result[0]['IDuser']) ?>
            </h3>

            <form method="post">
                <div class="form-floating mb-3 ">
                    <input type="text" class="form-control" id="floatingInputUsername" placeholder="myusername"
                        name="username" value="<?php echo ($result[0]['username']) ?>" required>
                    <label for="floatingInputUsername">Username</label>
                </div>

                <div class="form-floating mb-3 ">
                    <input type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com"
                        name="email" value="<?php echo ($result[0]['email']) ?>" required>
                    <label for="floatingInputEmail">Email address</label>
                </div>

                <div class="form-floating mb-3 ">
                    <input type="number" class="form-control" id="floatingInputPhone" placeholder="1234567890"
                        name="phone" value="<?php echo ($result[0]['phone']) ?>" required>
                    <label for="floatingInputPhone">Phone number</label>
                </div>

                <div class="form-floating mb-3 ">
                    <input type="text" class="form-control" id="floatingInputAdress" placeholder="myadress"
                        name="adress" value="<?php echo ($result[0]['adress']) ?>" required>
                    <label for="floatingInputAdress">Adress</label>
                </div>

                <div class="form-floating mb-3 ">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                        value="<?php echo ($result[0]['password']) ?>" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <!-- <form method="post"> -->
                <div class="mb-2">
                    <button class="btn btn-lg btn-warning btn-login fw-bold text-uppercase float-end" type="submit"
                        name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>