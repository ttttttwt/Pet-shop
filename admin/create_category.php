<?php include_once('layouts/header.php') ?>
<?php include_once('../backend/Category.php') ?>
<?php

if (isset($_POST['create'])) {
    $name = $_POST['category'];
    $category = new Category();
    $category->insertCategory($name);
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
                    <a href="Category-table.php">
                        Category table
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create Category
                </li>
            </ol>
        </nav>
            <h3 class="px-4 h3">Enter the new category:</h3> 
            </h3>
            <form method="post" class="row g-3 py-2 px-4">
                <div class="form-floating mb-3 col-md-7">
                    <input type="text" class="form-control" id="floatingInputUsername" placeholder="myusername"
                        name="category" required>
                    <label for="floatingInputUsername">Category Name</label>
                </div>

                <div class="mb-2 col-md-12">
                    <button class="btn btn-lg btn-warning btn-login fw-bold text-uppercase" type="submit"
                        name="create">Create</button>
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