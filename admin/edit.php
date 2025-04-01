<style>
  .thumbnail-selected {
    background-color: #21565e !important;
    /* Green background color */
    color: white;
    /* White checkmark color */
  }

  .thumbnail-selected .fa-check {
    color: white;
    /* Ensure the checkmark icon is white */
  }
</style>

<?php
session_start();


include_once "../inc/config.php";
$pagetitle = "Edit Product";
include_once "../inc/drc.php";



$product_id = $_GET['productid'];

$products_det = mysqli_query($conn, "SELECT * FROM products WHERE productid = '$product_id'");
$count_row_product = mysqli_num_rows($products_det);
$prod_details = mysqli_fetch_assoc($products_det);

$producttitle = $prod_details['producttitle'];
$yards = $prod_details['yards'];
$price = $prod_details['price'];
$discount_price = $prod_details['discount_price'];
$shortdescription = $prod_details['shortdescription'];
$productdescription = $prod_details['productdescription'];
$productcategory = $prod_details['productcategory'];




$products_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id'");
// $prod_categories = mysqli_fetch_assoc($products_cat);
$count_row_images = mysqli_num_rows($products_img);

if (!isset($_SESSION['user_id'])) {
  header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
  exit; // Make sure to exit after sending the redirection header
} elseif ($product_id == '' || $count_row_product < 1) {
  header("location: " . PRODUCTS); // redirect to login page if not signed in
} elseif ($count_row_images < 1) {
  header("location: " . ADD_IMAGE . "?productid=" . $product_id); // redirect to login page if not signed in
} else {
  $user_id = $_SESSION['user_id'];
}



include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";


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
      <h1 class="text-30 lh-12 fw-700">Edit Product</h1>
      <div class="mt-10">You can edit your product.</div>
    </div>
  </div>


  <div class="row y-gap-30">
    <div class="col-12">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">

        <div class="tabs -active-deep-green-2 js-tabs pt-0">
          <div class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls">

            <a class="tabs__button text-light-1 js-tabs-button is-active" href="<?php echo EDIT_PRODUCT . '?productid=' . $product_id ?>" type="button">
              Edit Product
            </a>

            <a class="tabs__button text-light-1 js-tabs-button " href="<?php echo EDIT_IMAGES . '?productid=' . $product_id ?>" type="button">
              Edit Images
            </a>

            <a class="tabs__button text-light-1 js-tabs-button d-none" href="<?php echo EDIT_THUMBNAIL . '?productid=' . $product_id ?>" type="button">
              Edit Thumbnail
            </a>

          </div>

          <div class="tabs__content py-30 px-30 js-tabs-content">


            <div class="tabs__pane -tab-item-1 is-active">
              <h2 class="text-17 lh-1 fw-500">Edit Product Thumbnail</h2>
              <div class="row y-gap-20 x-gap-20 items-center">
                <?php
                $prodsql = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id'");
                while ($row_prod = mysqli_fetch_assoc($prodsql)) {
                  $image_path = '../' . $row_prod['image_path'];
                  $image_id = $row_prod['img_id'];
                  $is_thumbnail = $row_prod['thumbnail'] == 1 ? 'thumbnail-selected' : '';
                ?>
                  <div class="col-md-2 col-4">
                    <div class="relative shrink-0">
                      <div class="bg-image ratio ratio-30:35 js-lazy -outline-deep-green-1 rounded-8" data-bg="<?php echo $image_path ?>"></div>

                      <div class="absolute-full-center justify-between d-flex justify-end py-10 px-10">
                        <div>
                          <div class="d-flex justify-center items-center size-30 rounded-8 bg-light-3">
                            <div class="icon-bin text-16" data-toggle="modal" data-target="#myModal-<?php echo $image_id; ?>"></div>
                          </div>

                        </div>
                        <div>
                          <div class="d-flex justify-center items-center z-3">
                            <!-- <div class="icon-bin text-16"></div> -->
                            <form id="thumbnail-form-<?php echo $image_id; ?>" class="thumbnail-form">
                              <input type="hidden" name="image_id" value="<?php echo $image_id; ?>">
                              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                              <button type="submit" class="d-flex justify-center items-center text-deep-green bg-light-3 -outline-deep-green-1 size-30 rounded-8 shadow-1 <?php echo $is_thumbnail; ?>">
                                <i class="fa fa-check text-16"></i>
                              </button>
                            </form>

                          </div>
                        </div>

                      </div>
                    </div>




                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal-<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            Delete Image
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure you want to delete this image?
                          <br>
                          This process is not reversible.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="button -sm -deep-green-1 text-white" data-dismiss="modal">Close</button>
                          <a type="button" href="../api/delete_img.php?productid=<?php echo $product_id . '&img_id=' . $image_id ?>" class="button -sm -red-1 text-white">Delete Image</a>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php } ?>


              </div>

              <?php

              ?>

              <div class="border-top-light pt-30 mt-30">
                <h2 class="text-17 lh-1 fw-500">Edit Product Details</h2>
                <form id="product-details-update" class="contact-form row y-gap-30">
                  <div class="col-12">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Name<span class="text-red-1">*</span></label>
                    <input type="text" name="producttitle" value="<?php echo $producttitle ?>" placeholder="Enter the name of the product" required>
                    <input type="hidden" name="productid" value="<?php echo $product_id ?>" placeholder="">
                  </div>

                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Available Quantity <span class="text-red-1">*</span></label>
                    <input type="number" name="yards" value="<?php echo $yards ?>" placeholder="Enter Available yards." required>
                  </div>

                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product category <span class="text-red-1">*</span></label>
                    <select class="selectize wide js-selectize" name="productcategory" value="<?php echo $category_id ?>" required>
                      <?php
                      $categories2 = mysqli_query($conn, "SELECT * FROM olnee_categories where categoryid = '$productcategory'");
                      $product_cat = mysqli_fetch_assoc($categories2);
                      $categoryname1 = $product_cat['categoryName'];

                      ?>
                      <option value="" selected>Select Category</option>
                      <option value="<?php echo $productcategory ?>" selected><?php echo $categoryname1 ?></option>
                      <?php
                      while ($row_categories = mysqli_fetch_assoc($categories)) {
                        $categoryname = $row_categories['categoryName'];
                        $category_id = $row_categories["categoryid"];
                      ?>
                        <option value="<?php echo $category_id ?>"><?php echo $categoryname ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Price <span class="text-red-1">*</span></label>
                    <input type="number" name="price" value="<?php echo $price ?>" placeholder="Amount the customer pays" required>
                  </div>

                  <div class="col-md-6">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Discount Price <span class="text-red-1">*</span></label>
                    <input type="number" name="discount_price" value="<?php echo $discount_price ?>" placeholder="Usually the higher amount">
                  </div>

                  <div class="col-12">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Short Description <span class="text-red-1">*</span></label>
                    <textarea placeholder="Short Description" rows="4" name="shortdescription" value="<?php echo $shortdescription ?>" required><?php echo $shortdescription ?></textarea>
                  </div>

                  <div class="col-12">
                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Description <span class="text-red-1">*</span></label>
                    <textarea placeholder="You can make this one longer" rows="7" name="productdescription" value="<?php echo $productdescription ?>" required><?php echo $productdescription ?></textarea>
                  </div>

                  <div class="row pt-15">

                    <div id="error-message" class="col-12 text-red-1"></div>
                    <div id="success-message" class="col-12 text-deep-green-1"></div>



                    <div class="col-auto">
                      <button class="button -md -deep-green-1 text-white" type="submit" id="productFormUpdate">
                        Update Product
                      </button>
                    </div>
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



<script src="../api/product.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>