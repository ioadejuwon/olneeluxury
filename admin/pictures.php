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
  

      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-10">
        <div class="tabs -active-deep-green-2 js-tabs pt-0">
          <div class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls pb-8">
            <button class="tabs__button text-light-1 js-tabs-button is-active" data-tab-target=".-tab-item-0" type="button">
              Customer Images
            </button>
            <button class="tabs__button text-light-1 js-tabs-button d-non" data-tab-target=".-tab-item-1" type="button">
              Add Images
            </button>
          </div>
          <div class="tabs__content py-30 px-30 js-tabs-content">
            <div class="tabs__pane -tab-item-0 is-active">
            <div class="row y-gap-20 x-gap-20 items-center" id="image-gallery">

                <?php
                $imgsql = mysqli_query($conn, "SELECT * FROM olnee_customer_cam");
                while ($row_img = mysqli_fetch_assoc($imgsql)) {
                  $image_path =  $row_img['image_path'];
                  $image_id = $row_img['img_id'];
                ?>
                  <div id="image-box-<?php echo $image_id; ?>" class="col-md-2 col-4">
                    <div class="relative shrink-0">
                      <div class="bg-image ratio ratio-30:35 js-lazy -outline-deep-green-1 rounded-8" data-bg="<?php echo $image_path ?>"></div>

                      <div class="absolute-full-center d-flex justify-start py-10 px-10">
                        <div>
                          <div class="d-flex justify-center items-center size-30 rounded-8 bg-light-3">
                            <div class="icon-bin text-16" data-toggle="modal" data-target="#myModal-<?php echo $image_id; ?>"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal-<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <!-- <h5 class="modal-title"></h5> -->
                          <h2 class="modal-title h4">
                            Delete Image
                          </h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="assets/img/icons/close.png" alt="close" width="30%">
                          </button>
                        </div>
                        <div class="modal-body p-4 pt-0">
                          <p class="text-dark">
                            Are you sure you want to delete this image?
                            <br>
                            This process is not reversible.
                          </p>

                          <ul class="row gx-4 mt-4">

                            <li class="col-12">
                              <button type="button" class="button -md -red-1 w-100 text-white delete-customer-image-btn"  data-imgid="<?php echo $image_id ?>"
                                data-targetid="image-box-<?php echo $image_id ?>" data-dismiss="modal">
                                Delete Image
                              </button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php } ?>


              </div>
            </div>

            <div class="tabs__pane -tab-item-1 is-activ">
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
            <div class="tabs__pane -tab-item-2">

              <div>
                <form action="" method="POST" id="store-update" class="contact-form row y-gap-10">
                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone</label>
                    <input type="number" name="contact_phone" value="<?php echo $contact_phone; ?>" placeholder="Contact Phone">
                  </div>
                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email</label>
                    <input type="email" name="contact_email" value="<?php echo $contact_email; ?>" placeholder="Contact Address">
                  </div>
                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Address</label>
                    <input type="text" name="store_address" value="<?php echo $store_address; ?>" placeholder="Address">
                  </div>
                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State</label>
                    <input type="text" name="store_state" value="<?php echo $store_state; ?>" placeholder="State">
                  </div>
                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country</label>
                    <input type="text" name="store_country" value="<?php echo $store_country; ?>" placeholder="Country">
                  </div>
                  <div class="col-md-6 d-none">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Policy</label>
                    <textarea placeholder="Text..." name="delivery" value="" rows="7"><?php echo $delivery; ?></textarea>
                  </div>
                  <div class="col-md-6 d-none">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Return Policy</label>
                    <textarea placeholder="Text..." name="return" value="" rows="7"><?php echo $return; ?></textarea>
                  </div>

                  <div class="col-12">
                    <button class="button -md -deep-green-1 text-white">Update Profile</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>




<script src="api/customer--cam.js"></script>

<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>