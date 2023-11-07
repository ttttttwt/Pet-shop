<?php include 'layouts/header.php'; ?>
<?php include_once('backend/Product.php') ?>
<?php include_once('backend/Category.php') ?>
<!-- <?php include_once('backend/Cart.php') ?> -->
<?php
// echo($_SESSION['id']);

$canaddcart = '';
$product = new Product();
$result = $product->getProductByID($_GET['id']);
foreach ($result as $value) {
    $currentID = $value['IDhanghoa'] ?? '';
    $currentName = $value['tenhanghoa'] ?? '';
    $currentAmount = $value['soluong'] ?? '';
    if ($currentAmount == 0) {
        $currentAmount = 'Out of stock';
        $canaddcart = 'disabled';
    }
    $currentPrice = $value['dongia'] ?? '';
    $currentDescription = $value['mota'] ?? '';
    $currentCategory = $value['IDdanhmuc'] ?? '';
    $currentImage = $value['hinhanh'] ?? '';
}

if (isset($_POST['add'])) {
    $cart = new Cart();
    $cart->addToCart($_SESSION['id'], $_POST['id'], 1);

    // echo($_POST['id']);
}
?>
<style>
    .breadcrumb {
        flex-wrap: wrap !important;
        padding: 0.75rem 1rem !important;
        list-style: none !important;
        background-color: #e9ecef !important;
        border-radius: 0.25rem !important;
    }

    .i1 {
        width: fit-content;
        height: 325px;
        object-fit: cover;
        /* object-fit: ; */
    }

    .i2 {
        max-width: 325px;
        /* width: fit-content; */
    }

    /* a {
            text-decoration: none;
            background-color: transparent;
        } */
</style>
<!-- Product section-->
<section class="bg-light">

    <section class="py-5 bg-white">
        <div class="container px-4 px-lg-5 my-5">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo ($currentName) ?>
                    </li>
                </ol>
            </nav>

        </div>
        <div>
            <div class="container pt-5">
                <div class="row container">
                    <div class="col-md-4 col-sm-5 col-12">
                        <div class="mb-4">
                            <img class="card-img-top img-fluid i2" src="<?php echo ($currentImage) ?>" alt="..." />
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-7 col-12">
                        <div class="lead small mb-1">
                            <?php echo ('ID: ' . $currentCategory . '-' . $currentID) ?>
                        </div>
                        <p class="h1 fw-bolder">
                            <?php echo ($currentName) ?>
                        </p>
                        <div>
                            <p class="fs-5">
                                <mark>
                                    <span class="text-decoration-line-through">
                                        $
                                        <?php echo ((int) $currentPrice + 10) ?>
                                    </span>
                                    <span class="ms-1"> -> </span>
                                    <span class="text-danger h5">
                                        <?php echo ($currentPrice) ?>
                                    </span>
                                </mark>
                            </p>
                        </div>
                        <div class="mb-4">
                            <span class="h3 mb-4">Amount:
                                <?php echo ($currentAmount) ?>
                            </span>
                        </div>
                        <div class="fs-5 mb-4">
                            <form method="post">
                                <input type="text" name="id" value="<?php echo ($currentID) ?>" hidden>
                                <button <?php echo ($canaddcart) ?> type="submit" name="add" class="btn btn-outline-dark
                                    flex-shrink-0" type="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    <?php echo ($canaddcart == 'disabled' ? 'Out of stock' : 'Add to cart') ?>
                                </button>
                            </form>
                        </div>
                        <div>
                            <span class="fs-5 mb-4"> Mô Tả:</span><br>
                            <?php echo ($currentDescription) ?>
                        </div>
                    </div>
                </div>
    </section>
    <!-- Related items section-->
    <section>
        <!-- <hr style="height: 2px;"> -->
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                <?php
                $product->loadRamdomProductNotID($_GET['id']);
                ?>
            </div>
        </div>
    </section>
</section>

<?php include 'layouts/footer.php'; ?>