<?php include('layouts/header.php'); ?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
<?php
include_once('backend/Product.php');
include_once('backend/Category.php');

// create variable
$LoadMore = '';
$NotWayBack = '';
$checked = '';

// get GET variable
$jsget_category = $_GET['category'] ?? 'null';
$jsget_sort = $_GET['sortby'] ?? 'null';
$jsget_search = $_GET['search'] ?? 'null';

$get_category = $_GET['category'] ?? null;
$get_sort = $_GET['sortby'] ?? null;
$get_search = $_GET['search'] ?? null;


// create object
$category = new Category();
$product = new Product();



// get start and limit
if (isset($_GET['start']) && isset($_GET['limit'])) {
    $start = $_GET['start'];
    $limit = $_GET['limit'];
} else {
    $start = 0;
    $limit = 9;
}

$fillter = "Relevance";
// check the filter
if ($get_sort != 'null') {
    if ($get_sort == 'price-asc') {
        $fillter = 'Price Ascending';
    } else if ($get_sort == 'price-desc') {
        $fillter = 'Price Descending';
    } else if ($get_sort == 'name-asc') {
        $fillter = 'name ASC';
    } else if ($get_sort == 'name-desc') {
        $fillter = 'name DESC';
    }
}


// get number of products
$numberItem = $product->getNumberOfProductAfterFilter($get_category, $get_search);

// check can load more or not
if ($numberItem - $limit <= $start) {
    $LoadMore = 'disabled';
}

// check can go back or not
if ($start == 0) {
    $NotWayBack = 'disabled';
}

// process search
if ($jsget_search != 'null') {
    $jsget_search = "'" . $jsget_search . "'";
}


?>
<style>
    body {
        background: #f8f9fa;
    }

    .i1 {
        /* width: fit-content; */
        height: 325px;
        /* object-fit: cover; */
        object-fit: contain;
    }

    .ms-n5 {
        margin-left: -40px;
    }
</style>

<div class="container pt-5">
    <div class="row">
        <div class="col-md-3 order-md-1 col-lg-3 sidebar-filter">
            <h3 class="mt-0 mb-5">Showing <span class="text-primary">
                    <?php echo ($numberItem) ?>
                </span> Products</h3>
            <h6 class="text-uppercase font-weight-bold mb-3">Categories</h6>
            <?php
            $category->loadDataToShopPage($start, $limit, $jsget_category, $jsget_sort, $jsget_search);
            ?>
            <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
            <div class="d-grid gap-2 mt-5 mb-5">
                <a href="shop.php" class="btn btn-lg btn-block btn-primary ">Reset All Fillter</a>
            </div>

        </div>
        <?php
        $stLeft = $start - $limit;
        $stRight = $start + $limit;
        ?>
        <div class="col-md-9 order-md-2 col-lg-9">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="dropdown text-md-start text-center float-md-start mb-3 mt-3 mt-md-0 mb-md-0">
                            <label class="mr-2">Sort by:</label>
                            <a class="btn btn-lg btn-light dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <?php echo ($fillter) ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" x-placement="bottom-start"
                                style="position: absolute; transform: translate3d(71px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <li><a class="dropdown-item"
                                        onclick="toPage(<?php echo ($start) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>,  '', <?php echo ($jsget_search) ?>)">Relevance</a>
                                </li>
                                <li><a class="dropdown-item"
                                        onclick="toPage(<?php echo ($start) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>,  'price-desc', <?php echo ($jsget_search) ?>)">Price
                                        Descending</a></li>
                                <li><a class="dropdown-item"
                                        onclick="toPage(<?php echo ($start) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>,  'price-asc', <?php echo ($jsget_search) ?>)">Price
                                        Ascending</a></li>
                                <li><a class="dropdown-item" href="#">Best Selling</a></li>
                            </ul>
                        </div>
                        <div class="btn-group float-md-end ml-3">
                            <?php

                            if ($limit == 0) {
                                $LoadMore = 'disabled';
                            }

                            ?>
                            <?php
                            if ($jsget_sort == 'null')
                                $jsget_sort1 = 'null';
                            else {
                                $jsget_sort1 = "'" . $jsget_sort . "'";
                            }
                            ?>
                            <button type="button"
                                onclick="toNext(<?php echo ($stLeft) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort1) ?>, <?php echo ($jsget_search) ?>)"
                                class="btn btn-lg btn-light" <?php echo ($NotWayBack) ?>> <span
                                    class="fas fa-arrow-left"></span>
                            </button>
                            <button type="button"
                                onclick="toPrev(<?php echo ($stRight) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort1) ?>, <?php echo ($jsget_search) ?>)"
                                class="btn btn-lg btn-light" <?php echo ($LoadMore) ?>> <span
                                    class="fas fa-arrow-right"></span>
                            </button>
                        </div>
                        <div class="dropdown float-end">
                            <label class="mr-2">View:</label>
                            <a class="btn btn-lg btn-light dropdown-toggle view" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <?php
                                if ($limit == 0)
                                    echo "All";
                                else
                                    echo ($limit);
                                ?>
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                x-placement="bottom-end" id="listview"
                                style="will-change: transform; position: absolute; transform: translate3d(120px, 48px, 0px); top: 0px; left: 0px;">
                                <a class="dropdown-item"
                                    onclick="toPage(0,9, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)">9</a>
                                <a class="dropdown-item"
                                    onclick="toPage(0,12, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)">12</a>
                                <a class="dropdown-item"
                                    onclick="toPage(0,24, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)">24</a>
                                <a class="dropdown-item"
                                    onclick="toPage(0,36, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)">36</a>
                                <a class="dropdown-item"
                                    onclick="toPage(0,0, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)">All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-group">
                            <input onchange="search(this,<?php echo ($jsget_sort) ?>)" value="<?php echo ($get_search) ?>"
                                class="form-control border-end-0 border" type="search" placeholder="Search"
                                id="example-search-input">
                            <span class="input-group-append">
                                <button
                                    class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5"
                                    type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    // if (isset($_GET['start']) && isset($_GET['limit'])) {
                    //     $product->loadDataToShoPage1All($start, $limit, $get_category, $get_sort);
                    // } else {
                    //     $product->loadDataToShoPage1WithLimit(0, 9);
                    // }
                    $product->loadDataToShoPage1All($start, $limit, $get_category, $get_sort, $get_search);

                    ?>
                </div>
                <div class="row sorting mb-5 mt-5">
                    <div class="col-12">
                        <a onclick="document.documentElement.scrollTop = 0;" class="btn btn-light">
                            <i class="fas fa-arrow-up mr-2"></i> Back to top</a>
                        <div class="btn-group float-md-end ml-3">
                            <button type="button"
                                onclick="toNext(<?php echo ($stLeft) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)"
                                class="btn btn-lg btn-light" <?php echo ($NotWayBack) ?>> <span
                                    class="fas fa-arrow-left"></span>
                            </button>
                            <button type="button"
                                onclick="toPrev(<?php echo ($stRight) ?>,<?php echo ($limit) ?>, <?php echo ($jsget_category) ?>, <?php echo ($jsget_sort) ?>, <?php echo ($jsget_search) ?>)"
                                class="btn btn-lg btn-light" <?php echo ($LoadMore) ?>> <span
                                    class="fas fa-arrow-right"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'layouts/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>