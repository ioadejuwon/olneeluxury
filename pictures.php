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
    <div data-anim-wrap class="container ">
        <div class="gallery-container">
            <?php
            $customer_sql = "SELECT * FROM olnee_customer_cam";
            $customer_result = mysqli_query($conn, $customer_sql);

            // Create an empty array to store image paths
            $images = [];

            // Collect all image paths in the array
            while ($row = mysqli_fetch_array($customer_result)) {
                $image_path = 'admin/' . $row['image_path'];  // Prefix the path as needed
                $images[] = $image_path;  // Add to the images array
            }
            ?>

            <!-- Display all images in the gallery -->
            <div class="gallery" data-images='<?php echo json_encode($images); ?>'>
                <?php foreach ($images as $image_path): ?>
                    <img src="<?php echo $image_path ?>" alt="Customer Image" class="popup-trigger">
                <?php endforeach; ?>
            </div>




            <!-- The popup HTML -->
            <div class="image-popup" id="imagePopup">
                <span class="close-btn" id="closePopup">&times;</span>
                <button class="nav-btn prev-btn" id="prevBtn">&lt;</button> <!-- Previous Button -->
                <img src="" alt="Full Image" id="popupImage">
                <button class="nav-btn next-btn" id="nextBtn">&gt;</button> <!-- Next Button -->
            </div>


        </div>
</section>

<script src="admin/assets/js/masonry.js"></script>
<?php
include_once "comp/footer.php";
include_once "comp/tail.php";
?>