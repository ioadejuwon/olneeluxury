<?php
$pagetitle = "Customers' Cam";
include_once "comp/head.php";
include_once "comp/header.php"
?>

<!-- <script src="admin/assets/js/masonry.js"></script> -->

<section class="page-header -type-1 mt-60 text-white">
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header__content">
            <div class="row justify-center text-center">
                <div class="col-auto">
                    <div data-anim="slide-up delay-1">
                        <h1 class="page-header__title text-white">
                            Customers' Cam
                        </h1>
                    </div>
                    <div data-anim="slide-up delay-2">
                        <p class="page-header__text">
                            Some Pictures from our customers wearing our products.
                            <br> We are happy to see you in our products.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="layout-pt-md layout-pb-lg border-top-light">
    <div data-anim-wrap class="container">
        <div class="gallery">
            <?php
            $customer_sql = "SELECT * FROM olnee_customer_cam";
            $customer_result = mysqli_query($conn, $customer_sql);
            while ($row = mysqli_fetch_array($customer_result)) {
                $img_id = $row['img_id'];
                $image_path = $row['image_path'];
                $image_path = 'admin/' . $image_path;
            ?>
                <img src="<?php echo $image_path ?>" alt="ss">

            <?php

            }
   
            ?>
        </div>
    </div>
</section>


<?php
include_once "comp/footer.php";
include_once "comp/tail.php";
?>