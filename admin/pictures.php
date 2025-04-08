<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<style>
  .dropzone {
    border: 1px dashed #21565e;
    border-radius: 8px;
    /* padding: 20px; */
    text-align: center;
  }
</style>
<?php

session_start();



include_once "inc/config.php";
$pagetitle = "Add Images";
include_once "inc/drc.php";



$product_id = $_GET['productid'];

$products_num = mysqli_query($conn, "SELECT * FROM products WHERE productid = '$product_id'");
$count_row_product = mysqli_num_rows($products_num);


$products_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id'");
// $prod_categories = mysqli_fetch_assoc($products_cat);
$count_row_images = mysqli_num_rows($products_img);

if (!isset($_SESSION['user_id'])) {
  header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
  exit; // Make sure to exit after sending the redirection header
} else {
  $user_id = $_SESSION['user_id'];
}



include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";


// include_once "../inc/add-course.php"; 


$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
$row = mysqli_fetch_assoc($sql);
$user_id = $row["user_id"];

$fname = $row['fname'];

$categories = mysqli_query($conn, "SELECT * FROM olnee_categories");

?>



<?php include_once "ad_comp/adm-sidebar.php" ?>

<div class="dashboard__content bg-light-4">
  <div class="row pb- mb-10">
    <div class="col-auto">
      <h2 class="text-30 lh-12 fw-700">Add New Images </h2>
      <div class="mt-5">Add New Images to the customer's cam.</div>
    </div>
  </div>


  <div class="row y-gap-30">
    <div class="col-12">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">

        <div class="tabs -active-deep-green-2 js-tabs pt-0">
          <div class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls">
           
            <a class="tabs__button text-light-1 js-tabs-button is-active" href="<?php echo EDIT_IMAGES . '?productid=' . $product_id ?>" type="button">
              Edit Images
            </a>
            <a class="tabs__button text-light-1 js-tabs-button" href="<?php echo EDIT_PRODUCT . '?productid=' . $product_id ?>" type="button">
              Add Product
            </a>
          </div>

          <div class="tabs__content py-30 px-30 js-tabs-content">

            <div class="tabs__pane is-active">


              <div class=" pt-30 ">
                <form action="inc/customers_cam.php" class="dropzone" id="customers-cam-dropzone">
                  <!-- <input type="hidden" name="productid" id="product_id" value="<?php echo $_GET['productid']; ?>"> -->
                </form>
                <!-- <button type="button" id="upload-button">Upload Images</button> -->

                <div class="row justify-end">

                  <div id="error-message"></div>
                  <div id="success-message" class="col-12 text-deep-green-1"></div>
                  <div class="col-auto">
                    <button class="button -md -deep-green-1 text-white" type="submit" id="upload-button">
                      Upload Image
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>




<script src="api/customers-cam1.js"></script>

<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>