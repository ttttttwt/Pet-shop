<?php include('layouts/header.php') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders-table</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    User Table
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
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
                            $order->loadDataOnTable();
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