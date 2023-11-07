<?php include_once 'backend/Product.php'; ?>
<?php include 'layouts/header.php'; ?>

<?php

$currentName = $currentAmount = $currentPrice = $currentDescription = $currentCategory = $currentImage = "";
$reader = 'readonly';
$disabled = 'disabled';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $product1 = new Product();
    $result1 = $product1->getProductByID($id);

    foreach ($result1 as $value) {
        $currentID = $value['IDhanghoa'];
        $currentName = $value['tenhanghoa'];
        $currentAmount = $value['soluong'];
        $currentPrice = $value['dongia'];
        $currentDescription = $value['mota'];
        $currentCategory = $value['IDdanhmuc'];
        $currentImage = $value['hinhanh'];
    }
}

// echo($currentImage1);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $currentImage ='hello';
    $id = $_GET['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    if (!empty($_FILES['upload']['name'])) {
        $file = $_FILES['upload'];
        // print_r($file);
    } else {
        $product = new Product();
        $result3 = $product->getImageById($id);
        $file = $result3;
        // echo($file);
    }

    $product2 = new Product();
    $result2 = $product2->updateProduct($id, $name, $amount, $price, $description, $category, $file);

    if ($result2) {
        echo ("<script>alert('Update successfully!')</script>");
        // header('refresh:0');
        // header("Location: " . $_SERVER["HTTP_REFERER"]);
        echo ("<script>window.location.href = 'admin/Product-table.php';</script>");
    } else {
        echo ("<script>alert('Update failed!')</script>");
        header('refresh:0');
    }
}



?>

<style>
    /* #container {
        width: 1000px;
        margin: 20px auto;
    } */

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 150px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>

<section>
    <!-- <div class="container px-4 px-lg-5 my-5"> -->
    <div class="container px-4 px-lg-5 my-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin/index.php">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="admin/Product-table.php">
                        Product table
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create Product
                </li>
            </ol>
        </nav>

        <form method="POST" enctype="multipart/form-data">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-4">
                    <img class="card-img-top img-fluid mb-5 mb-md-0" id="blah" src="<?php echo $currentImage ?>" alt="..." />
                </div>
                <div class="col-md-8">
                    <!-- <h1 class="display-5 fw-bolder">Shop item template</h1> -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputProductName" placeholder="name"
                            name="name" value="<?php echo $currentName ?>" required>
                        <label for="floatingInputProductName">Product Name</label>
                    </div>
                    <!-- <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through">$45.00</span>
                        <span>$40.00</span>
                    </div> -->
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInputProductName"
                            pattern="[+][0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="amount" name="amount"
                            value="<?php echo $currentAmount ?>" required>
                        <label class="form-label" for="floatingInputProductName">Amount</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInputPrice"
                            pattern="[+][0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="price" name="price"
                            value="<?php echo $currentPrice ?>" required>
                        <label class="form-label" for="floatingInputPrice">Price</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="category"
                            aria-label="Floating label select example">
                            <option selected>Open this select menu</option>
                            <?php
                            // include_once 'backend/Datebase.php';
                            $db = new Database();
                            $result = $db->slectFromCategories();
                            foreach ($result as $row) {
                                if ($row['IDdanhmuc'] == $currentCategory) {
                                    echo '<option value="' . $row['IDdanhmuc'] . '" selected>' . $row['tendanhmuc'] . '</option>';
                                } else {
                                    echo '<option value="' . $row['IDdanhmuc'] . '">' . $row['tendanhmuc'] . '</option>';
                                }
                                // echo $row['IDdanhmuc'] . $row['tendanhmuc'];
                            }
                            ?>
                            <!-- <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> -->
                        </select>
                        <label for="floatingSelect">Selects the Categories</label>
                    </div>

                    <!-- <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p> -->
                    <div class="mb-3">
                        <textarea type="text" class="form-control" id="floatingInputText" placeholder="description"
                            name="description" required><?php echo $currentDescription ?></textarea>
                        <!-- <label for="floatingInputText">Description</label> -->
                    </div>


                    <div class="input-group mb-3">
                        <input type="file" class="form-control" onchange="readURL(this);" id="inputGroupFile02"
                            name="upload" style="background-color: #fff">
                        <label class="input-group-text" for="inputGroupFile02">To Upload</label>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit"
                            name="update">Update</button>
                    </div>

                </div>
            </div>
        </form>

    </div>


</section>



<?php include 'layouts/footer.php'; ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#floatingInputText'))
        .catch(error => {
            console.error(error);
        });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.navbar').addClass('sticky-top');
        } else {
            $('.navbar').removeClass('sticky-top');
        }
    });
</script>