<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<?php

session_start();


include_once "inc/config.php";
$pagetitle = "All Products";
include_once "inc/drc.php";

if (!isset($_SESSION['user_id'])) {
  header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
  exit; // Make sure to exit after sending the redirection header
} else {
  $user_id = $_SESSION['user_id'];
}

include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";



$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
$row = mysqli_fetch_assoc($sql);
$fname = $row['fname'];

// $categories = mysqli_query($conn, "SELECT * FROM olnee_categories");

// $product_id = $_GET['productid'];


?>

<?php include_once "ad_comp/adm-sidebar.php" ?>

<div class="dashboard__content bg-light-4">

  <div class="row mb-10 justify-between">
    <div class="col-auto">
      <h2 class="text-30 lh-12 fw-700">My Products</h2>
      <div class="mt-5">You can find the products you have added here.</div>
    </div>
    <div class="col-auto md:mt-10 md:mb-10 mt-5">
      <a href="<?php echo ADD_PRODUCT ?>" class="button -icon -deep-green-1 text-white">Add Products</a>
    </div>
  </div>


  <div class="row y-gap-30">
    <div class="col-12">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
        <div class="tabs -active-purple-2 js-tabs">
          <div class="tabs__controls d-flex items-center py-20 px-30 border-bottom-light js-tabs-controls">
            <button class="text-light-1 lh-12 tabs__button js-tabs-button is-active text-deep-green-1 h3 fw-600" data-tab-target=".-tab-item-1" type="button">
              All Products
            </button>
            <button class="text-light-1 lh-12 tabs__button js-tabs-button ml-30" data-tab-target=".-tab-item-2" type="button">
              <!-- Finished -->
            </button>
            <button class="text-light-1 lh-12 tabs__button js-tabs-button ml-30" data-tab-target=".-tab-item-3" type="button">
              <!-- Not enrolled -->
            </button>
          </div>

          <div class="tabs__content py-30 px-30 js-tabs-content">
            <div class="tabs__pane -tab-item-1 is-active">
              <div class="row y-gap-10 justify-between d-none">
                <div class="col-auto">
                  <form class="search-field border-light rounded-8 h-50" action="">
                    <input class="bg-white -dark-bg-dark-2 pr-50" type="text" placeholder="Search products">
                    <button class="" type="submit">
                      <i class="icon-search text-light-1 text-20"></i>
                    </button>
                  </form>
                </div>

                <div class="col-auto">
                  <div class="d-flex flex-wrap y-gap-10 x-gap-20">
                    <div>

                      <div class="dropdown js-dropdown js-category-active">
                        <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-2 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                          <span class="js-dropdown-title">Categories</span>
                          <i class="icon text-9 ml-40 icon-chevron-down"></i>
                        </div>

                        <div class="toggle-element -dropdown -dark-bg-dark-2 -dark-border-white-10 js-click-dropdown js-category-toggle">
                          <div class="text-14 y-gap-15 js-dropdown-list">
                            <div><a href="#" class="d-block js-dropdown-link">Animation</a></div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="row y-gap-30 pt-">

                <?php
                $prodsql = mysqli_query($conn, "SELECT * FROM products");
                $count_row_prod = mysqli_num_rows($prodsql);

                if ($count_row_prod != 0) {

                  while ($row_prod = mysqli_fetch_assoc($prodsql)) {
                    $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
                    $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
                    $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
                    $original_price = '&#8358;' . number_format($price);
                    $discounted_price = '&#8358;' . number_format($dis_price);
                    $product_id = $row_prod['productid'];
                    $availability = $row_prod['availability'];

                    // Get the thumbnail image
                    $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
                    $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
                    // $image_path_thumbnail =  $row_prod_img_thumbnail['image_path'];
                    if(!empty($row_prod_img_thumbnail['image_path'])){
                      $image_path_thumbnail =  $row_prod_img_thumbnail['image_path'];
                    }else{
                      $image_path_thumbnail = DEFAULT_IMG;
                    }

                    // Get the non-thumbnail images
                    $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
                    $other_images = [];
                    while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                      $other_images[] =  $row_prod_img['image_path'];
                    }
                ?>


                    <div class="w-1/5 xl:w-1/3 lg:w-1/2 sm:w-1/2" id="product-<?php echo $product_id; ?>">
                      <div class="productCard -type-1 text-center">
                        <div class="productCard__image">
                          <div class="ratio ratio-63:57">
                            <img class="absolute-full-center rounded-8" src="<?php echo $image_path_thumbnail; ?>" alt="<?php echo $product_name ?>">

                          </div>

                          <button class=" toggle_button toggle-btn-<?php echo $product_id ?>">
                            <span class="d-flex items-center justify-center size-35 bg-white shadow-1 rounded-8">
                              <i class="icon-menu-vertical"></i>
                            </span>
                          </button>

                          <!-- <div class="toggle-element -dshb-more js-more-1-toggle-<?php echo $product_id ?>"> -->
                          <div class="dropdown-main-content " id="dropdown-<?php echo $product_id ?>">
                            <div class="px-25 py-25 bg-white -dark-bg-dark-2 shadow-1 border-light rounded-8">
                              <a data-toggle="modal" data-target="<?php echo '#share-' . $product_id ?>" class="d-flex items-center">
                                <div class="fa-regular fa-send"></div>
                                <div class="text-17 lh-1 fw-500 ml-12">Share</div>
                              </a>

                              <a href="<?php echo EDIT_PRODUCT . '?productid=' . $product_id ?>" class="d-flex items-center mt-20">
                                <div class="fa-regular fa-edit"></div>
                                <div class="text-17 lh-1 fw-500 ml-12">Edit</div>
                              </a>

                              <a href="<?php echo $image_path_thumbnail; ?>" class="d-none gallery__item js-gallery  d-flex items-center mt-20" data-gallery="<?php echo $product_id ?>">
                                <div class="fa-regular fa-eye"></div>
                                <div class="text-17 lh-1 fw-500 ml-12">Images</div>
                              </a>

                              <a href="#" class="toggle-availability d-flex items-center mt-20" data-product-id="<?php echo $product_id; ?>" data-status="<?php echo $availability; ?>">
                                <div class="fa-regular fa-eye"></div>
                                <div class="text-17 lh-1 fw-500 ml-12 " id="availability-text">
                                  <?php echo $availability ? "Available" : "Unavailable"; ?>
                                </div>
                              </a>


                              <a data-toggle="modal" data-target="<?php echo '#delete-' . $product_id ?>" class="d-flex items-center mt-20 text-red-1">
                                <div class="fa-solid fa-trash-can"></div>
                                <div class="text-17 lh-1 fw-500 ml-12">Delete</div>
                              </a>
                            </div>
                          </div>

                          <?php foreach ($other_images as $image_path): ?>
                            <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery " data-gallery="<?php echo $product_id ?>"></a>
                          <?php endforeach; ?>

                          <div class="productCard__controls z-3 d-none">
                            <a data-toggle="modal" data-target="<?php echo '#share-' . $product_id ?>" class="productCard__icon">
                              <i class="fa-regular fa-send"></i>
                            </a>
                            <!-- <a data-barba href="<?php echo $image_path_thumbnail; ?>" class="d-none gallery__item js-gallery productCard__icon" data-gallery="<?php echo $product_id ?>">
                              <i class="fa-regular fa-eye"></i>
                            </a> -->
                            <a href="<?php echo EDIT_PRODUCT . '?productid=' . $product_id ?>" class=" productCard__icon">
                              <i class="fa-regular fa-edit"></i>
                            </a>
                            <a data-toggle="modal" data-target="<?php echo '#delete-' . $product_id ?>" class=" productCard__icon">
                              <i class="fa-solid fa-trash-can"></i>
                            </a>
                          </div>
                        </div>
                        <div class="productCard__content mt-15">
                          <h4 class="text-17 fw-600 mt- text-line-clamp-1 mb-1"><?php echo $product_name; ?></h4>
                          <div class="text-17 fw-500 text-deep-green-1 mt- price">
                            <?php echo $price; ?>
                          </div>
                        </div>
                      </div>


                    </div>

                    <div class="modal fade" id="share-<?php echo $product_id; ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-dark">
                            <h4 class="modal-title">Share Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <img src="assets/img/icons/close.png" alt="" width="20%">
                            </button>
                          </div>
                          <div class="modal-body p-4">
                            <p class="text-dark">
                              Share a link to the product "<span class="fw-600"><?php echo $product_name ?></span>" using any of the links below.
                            </p>

                            <div class="row mb-5 pt-15 justify-center items-center border-top-dark">
                              <div class="col-auto icon-outline p-2 mr-30">
                                <a href="<?php echo WASHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                                  <!-- <i class="icon-instagram"></i> -->
                                  <img src="assets/img/icons/wa.png" alt="">
                                </a>
                              </div>
                              <div class="col-auto icon-outline p-2 mr-30 d-none">
                                <a href="<?php echo IGSHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                                  <img src="assets/img/icons/ig.png" alt="">
                                </a>
                              </div>
                              <div class="col-auto icon-outline p-2 mr-30 d-none">
                                <a href="<?php echo FBSHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                                  <img src="assets/img/icons/fb.png" alt="">
                                </a>
                              </div>
                              <div class="col-auto icon-outline p-2 mr-30">
                                <a href="<?php echo XSHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                                  <img src="assets/img/icons/x.png" alt="">
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="delete-<?php echo $product_id; ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-dark">
                            <h4 class="modal-title">Delete Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <img src="assets/img/icons/close.png" alt="" width="20%">
                            </button>
                          </div>
                          <div class="modal-body p-4">
                            <p class="text-dark">Are you sure you want to delete the product "<span class="fw-600"><?php echo $product_name ?></span>". This process is irreversible.</p>
                            <p class="text-dark">Users who have added "<span class="fw-600"><?php echo $product_name ?></span>" to cart will still be able to process the order.</p>
                           
                            <ul class="row gx-4 mt-4">
                              <li class="col-6 d-none">
                                <button class="button -outline-dark-3 -md w-100" data-bs-dismiss="modal">Close</button>
                                <!-- <button class="button -md -deep-green-1 text-white" type="submit" id="submit">nn</button> -->
                              </li>
                              <li class="col-12">
                                <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-product-btn" data-productid="<?php echo $product_id; ?>">Delete Product</a>
                                <!-- <a href="#" class="button -sm -icon -red-1 text-white fw-500 delete-product-btn" data-productid="<?php echo $product_id; ?>">Delete</a> -->
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>


                  <?php
                  }
                } else {

                  ?>
                  <tr class="layout-pt-lg layout-pb-lg section-bg mt-30 empty ">
                    <div class="section-bg__item bg-light-6"></div>
                    <td colspan="6" class="container desction">
                      <div class="row y-gap-20 justify-center text-center">
                        <div class="col-auto">
                          <img src="assets/img/store.png" style="width:20%">
                          <div class="sectionTitle ">
                            <h2 class="sectionTitle__title ">No delivery rates set!</h2>
                            <p class="sectionTitle__text h4 pt-15">
                              Click the buttons below to add delviery prices
                            </p>
                          </div>
                          <div class="row justify-center pt-30">
                            <div class="col-auto">
                              <a data-toggle="modal" data-target="#modal-delivery-rate" class="button -icon  -deep-green-1 text-white">
                                Add Delivery Rate <i class="icon-arrow-top-right text-13 ml-10"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </div>
            </div>

            <div class="tabs__pane -tab-item-2"></div>
            <div class="tabs__pane -tab-item-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



<script src="api/product.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>