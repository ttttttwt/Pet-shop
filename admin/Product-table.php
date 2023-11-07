<?php include('layouts/header.php') ?>{

<style>
    .i1 {
        /* max-width: 500px; */
        /* height: 100%; */
        /* object-fit: cover; */
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Product-table</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Product Table
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>IDhanghoa</th>
                                <th>tenhanghoa</th>
                                <th>soluong</th>
                                <th>dongia</th>
                                <th>mota</th>
                                <th>hinhanh</th>
                                <th>IDdanhmuc</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>IDhanghoa</th>
                                <th>tenhanghoa</th>
                                <th>soluong</th>
                                <th>dongia</th>
                                <th>mota</th>
                                <th>hinhanh</th>
                                <th>IDdanhmuc</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                    include_once('../backend/Product.php');
                                    $product = new Product();
                                    $product->loadDataOnTable();
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
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>