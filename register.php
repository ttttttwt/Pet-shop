<?php include_once 'backend/User.php'; ?>
<?php
    $auth = new User();
    if (isset($_POST['register'])) {
        // echo $_POST['Login'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        $auth->register($username, $password, $email, $phone, $adress);
    }
?>

<?php include 'layouts/header.php'; ?>

    <style>
        /* body {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        } */

        .card-img-left {
            width: 45%;
            /* Link to your background image using in the property below! */
            background: scroll center url('img/register1.jpg');
            background-size: cover;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }

        .btn-google {
            color: white !important;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white !important;
            background-color: #3b5998;
        }
    </style>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto">
                    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                        <div class="card-img-left d-none d-md-flex">
                            <!-- Background image for card set in CSS! -->
                        </div>
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>
                            <form method="POST">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInputUsername"
                                        placeholder="myusername" name="username" required >
                                    <label for="floatingInputUsername">Username</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInputEmail"
                                        placeholder="name@example.com" name="email">
                                    <label for="floatingInputEmail">Email address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInputAdress"
                                        placeholder="myadress" name="adress" required >
                                    <label for="floatingInputAdress">Adress</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInputPhone"
                                        placeholder="1234567890" name="phone" required >
                                    <label for="floatingInputPhone">Phone number</label>
                                </div>

                                <hr>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword"
                                        placeholder="Password" name="password">
                                    <label for="floatingPassword">Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPasswordConfirm"
                                        placeholder="Confirm Password">
                                    <label for="floatingPasswordConfirm">Confirm Password</label>
                                </div>

                                <div class="d-grid mb-2">
                                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase"
                                        type="submit" name="register">Register</button>
                                </div>

                                <a class="d-block text-center mt-2 small" href="login.php">Have an account? Sign In</a>

                                <hr class="my-4">

                                <div class="d-grid mb-2">
                                    <button class="btn btn-lg btn-google btn-login fw-bold text-uppercase" type="submit">
                                        <i class="fab fa-google me-2"></i> Sign up with Google
                                    </button>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-lg btn-facebook btn-login fw-bold text-uppercase" type="submit">
                                        <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<?php include 'layouts/footer.php'; ?>