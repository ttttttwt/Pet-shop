<?php include 'layouts/header.php'; ?>

<?php

// send email
if (isset($_POST['send'])) {
    // echo ('send');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'quocla.21it@vku.udn.vn';
    $headers = "From: " . 'quocla.21it@vku.udn.vn' . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    // $txt = "You have received an email from $name.\n\n$message";
    $subject = "You have received an email from Email:$email With name: $name .\n\n.'-'.$subject";
    $result = mail($to, $subject, $message, $headers);
    if ($result) {
        echo '<script>alert("Email sent successfully")</script>';
        // header('location: contact.php');
        echo('<script>location.href = "contact.php";</script>');
    } else {
        echo '<script>alert("Email sent failed")</script>';
        // header('refresh: 0');
        echo ('<script>location.href = "contact.php";</script>');
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
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>

<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Contact Us</h6>
            <h1 class="display-5 text-uppercase mb-0">Please Feel Free To Contact Us</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-7">
                <form method="post">
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="text" class="form-control bg-light border-0 px-4" placeholder="Your Name"
                                name="name" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control bg-light border-0 px-4" placeholder="Your Email"
                                name="email" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control bg-light border-0 px-4" placeholder="Subject"
                                name="subject" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <textarea id="area1" class="form-control bg-light border-0 px-4 py-3" rows="8"
                                name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="send">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="bg-light mb-5 p-5">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase mb-1">Our Office</h6>
                            <span>470 tran dai nghia, ngu hanh son da nang</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase mb-1">Email Us</h6>
                            <span>quocla.21it@vku.udn.vn</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase mb-1">Call Us</h6>
                            <span>+012 345 6789</span>
                        </div>
                    </div>
                    <div>
                        <iframe class="position-relative w-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="height: 205px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<?php include 'layouts/footer.php'; ?>
<!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
        bkLib.onDomLoaded(function() {
             new nicEditor().panelInstance('area1');
        }); // Thay thế text area có id là area1 trở thành WYSIWYG editor sử dụng nicEditor
</script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#area1'))
        .catch(error => {
            console.error(error);
        });
</script>