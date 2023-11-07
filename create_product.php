<?php include_once 'backend/Product.php'; ?>
<?php

if (isset($_POST['create_product'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    // $image = $_FILES['image']['name'];
    if (!isset($_FILES['upload'])) {
        $file = $_FILES['upload'];
    } else {
        $file = "";
    }
    // echo($name .", ". $amount .", ". $price .", ". $description .", ". $category .", ". $file);
    // $file = $_FILES['upload'] ;
    // print_r($file);

    $product = new Product();
    $result = $product->insertProduct($name, $amount, $price, $description, $category, $file);

    if ($result) {
        echo '<script>alert("Product created successfully")</script>';
        header('location: admin/Product-table.php');
    } else {
        // echo 'Create product failed';
        echo '<script>alert("Create product failed")</script>';
        // header('refresh: 0');
    }
}

?>
<?php include 'layouts/header.php'; ?>

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

    .i1 {
        max-width: 500px;
        /* height: 100%; */
        /* object-fit: cover; */
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
                    <img class="card-img-top mb-5 img-fluid mb-md-0" id="blah"
                        src="https://dummyimage.com/400x500/dee2e6/6c757d.jpg" alt="..." />
                </div>
                <div class="col-md-8">
                    <!-- <h1 class="display-5 fw-bolder">Shop item template</h1> -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputProductName" placeholder="name"
                            name="name" required>
                        <label for="floatingInputProductName">Product Name</label>
                    </div>
                    <!-- <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through">$45.00</span>
                        <span>$40.00</span>
                    </div> -->
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInputProductName"
                            pattern="[+][0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="amount" name="amount" required>
                        <label class="form-label" for="floatingInputProductName">Amount</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInputPrice"
                            pattern="[+][0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="price" name="price" required>
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
                                echo '<option value="' . $row['IDdanhmuc'] . '">' . $row['tendanhmuc'] . '</option>';
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
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control" id="floatingInputText" placeholder="description"
                            name="description"></textarea>
                        <!-- <label for="floatingInputText">Description</label> -->
                    </div>


                    <div class="input-group mb-3">
                        <input type="file" class="form-control" onchange="readURL(this);" id="inputGroupFile02"
                            name="upload" style="background-color: #fff">
                        <label class="input-group-text" for="inputGroupFile02" style="background-color: #fff">To
                            Upload</label>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit"
                            name="create_product">Create</button>
                    </div>
                </div>
            </div>

    </div>
    </form>

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

<!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
        bkLib.onDomLoaded(function() {
             new nicEditor().panelInstance('floatingInputText');
        }); // Thay thế text area có id là area1 trở thành WYSIWYG editor sử dụng nicEditor
</script> -->