<?php include('layouts/header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<?php
include_once("backend/Order.php");
$order = new Order();
$numoder = $order->countOrdersByUserId($_SESSION['id']);

?>
<style>
    .breadcrumb {
        flex-wrap: wrap !important;
        padding: 0.75rem 1rem !important;
        list-style: none !important;
        background-color: #e9ecef !important;
        border-radius: 0.25rem !important;
    }

    .r1 {
        font-weight: bold;
        color: #212121;
    }

    .s1 {
        /* color: inherit; */
        background: #228B22;
        color: white;
        border: #212121;
    }

    .s0 {
        /* color: inherit; */
        background:#FFC125;
        color: black;
        border: #212121;

    }

    .s2 {
        /* color: inherit; */
        background: #dc3545;
        color: white;
        border: #212121;

    }

    /* a {
            text-decoration: none;
            background-color: transparent;
        } */
</style>

<main class="py-4">
    <div class="container-fluid px-5 pb-5">
        <h1 class="mt-4">Order table</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Your Order</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-cart-shopping me-1"></i>
                Your Has <?php echo $numoder; ?> Order
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <?php
                    
                    $order->loadDataForUser($_SESSION['id']);
                    ?>
                </div>


            </div>
        </div>
    </div>
</main>


<?php include('layouts/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>