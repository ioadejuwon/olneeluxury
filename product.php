<?php

include_once "admin/inc/config.php";
include_once "admin/inc/drc.php";
$product_id = $_GET['item'];

$product_details = mysqli_query($conn, "SELECT * FROM products WHERE productid = '$product_id'");
$count_row_product = mysqli_num_rows($product_details);

if ($product_id == '' || $count_row_product < 1) {
  // header("location: " . SHOP); // redirect to login page if not signed in
}

$row_prod = mysqli_fetch_assoc($product_details);
$product_name = $row_prod['producttitle'];
// $product_des = $row_prod['productdescription'];
// $short_des = $row_prod['shortdescription'];
$short_des = nl2br($row_prod['shortdescription']);
$product_des = nl2br($row_prod['productdescription']);

$product_cat_id = $row_prod['productcategory'];

$price = $row_prod['price'];
$dis_price = $row_prod['discount_price'];
$availability = $row_prod['availability'];

$pagetitle = $product_name;

include_once "comp/head.php";
include_once "comp/header.php";


// $original_price = '&#8358;' . number_format($price);
// $discounted_price = '&#8358;' . number_format($dis_price);

$product_category = mysqli_query($conn, "SELECT * FROM olnee_categories WHERE categoryid = '$product_cat_id'");
$row_prod_cat = mysqli_fetch_assoc($product_category);
$category_name = $row_prod_cat['categoryName'];

// Get the thumbnail image
$prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
$row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);

// $image_path_thumbnail = 'admin/' . $row_prod_img_thumbnail['image_path'];
// $product_img = $image_path_thumbnail;

$image_path_thumbnail = $row_prod_img_thumbnail['image_path'];
if (empty($image_path_thumbnail)) {
  $image_path_thumbnail2 = "product-img/product.png";
} else {
  $image_path_thumbnail2 = $row_prod_img_thumbnail['image_path'];
}
$image_path_thumbnail = 'admin/' . $image_path_thumbnail2;
$product_img = $image_path_thumbnail;


$prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' ORDER BY thumbnail DESC");
$count_images = mysqli_num_rows($prodsql_img);
if ($count_images > 0) {
  $other_images = [];
  while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
    $image_path = $row_prod_img['image_path'];
    $other_images[] = 'admin/' . $image_path;
  }
} else {
  $image_path = "product-img/product.png";
  $other_images[] = 'admin/' . $image_path;
}

$store_policy = mysqli_query($conn, "SELECT * FROM olnee_storedata");
$row_store = mysqli_fetch_assoc($store_policy);

$delivery = nl2br($row_store['deliveryPolicy']);
$return = nl2br($row_store['returnPolicy']);


?>

<section class="layout-pt-lg layout-pb-md mt-60 ">
  <div class="container">
    <!-- <div class=""> -->
    <div id="productForm" class="productCard -type-1 text-cener row y-gap-60 justify-between items-centr" data-product-id="<?php echo $product_id; ?>" data-price="<?php echo $price; ?>"
      data-image="<?php echo $product_img; ?>" data-name="<?php echo $product_name; ?>"
      data-discounted-price="<?php echo $dis_price; ?>">
      <div class="col-lg-6">

        <div class="js-shop-slider">
          <div class="shopSingle-preview__image js-slider-slider">
            <div class="swiper-wrapper">

              <?php foreach ($other_images as $image_path): ?>
                <div class="swiper-slide">
                  <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery"
                    data-gallery="<?php echo $product_id ?>">
                    <div class="ratio ratio-63:57">
                      <img class="absolute-full-center rounded-8" src="<?php echo $image_path; ?>"
                        alt="project image">
                    </div>

                    <div class="gallery__button -bottom-right">
                      <i class="icon" data-feather="plus"></i>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>

            </div>
          </div>

          <div class="row y-gap-10 x-gap-10 pt-10 js-slider-pagination">

            <?php foreach ($other_images as $image_path): ?>
              <div data-cursor class="col-auto gallery__item">
                <img class="size-90 object-cover rounded-8" src="<?php echo $image_path; ?>"
                  alt="<?php echo $product_name ?>">
              </div>
            <?php endforeach; ?>


          </div>
        </div>
      </div>

      <div class="col-lg-5 d-non">
        <div class="pb-90 md:pb-0">
          <h2 class="text-30 fw-700 mt-4 text-line-clamp-1"><?php echo $product_name ?></h2>
          <div class="text-20 text-dark-1 mt-15 ">
            <span class="price  fw-500"><?php echo $price ?></span>
            <?php
            if ($dis_price != 0.00) {
            ?>
              <span class="price line-through text-light-1"><?php echo $dis_price; ?></span>
            <?php
            }
            ?>

          </div>

          <div class="mt-10">
            <p class="text-light-1">
              <?php echo $short_des ?>
            </p>
          </div>


          <div class="shopSingle-info__action row x-gap-20 y-gap-20 pt0">
            <div class="col-auto">
              <div class="input-counter js-input-counter">
                <input class='input-counter__counter' name="yards" type="number" placeholder="value..." value='1' />

                <div class="input-counter__controls">
                  <button class='input-counter__up js-down'>
                    <i class='icon' data-feather="minus"></i>
                  </button>

                  <button class='input-counter__down js-up'>
                    <i class='icon' data-feather="plus"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <?php

              if ($availability == 1) {
              ?>
                <button class="button h-50 px-45 -deep-green-1 text-white add-to-cart-btn" data-product-id="<?php echo $product_id; ?>">Add to cart</button>
              <?php
              } elseif ($availability == 0) {
              ?>
                <button class="button h-50 px-45 -yellow-3 text-white" disabled>Out of Stock</button>
              <?php
              }
              ?>
            </div>
          </div>

          <div class="pt-30">
            <button class="d-flex items-center text-light-1">
              <i class="icon size-20 mr-8" data-feather="heart"></i>
              Add to wishlist
            </button>
          </div>

          <div class="pt-30">
            <p>Category: <?php echo $category_name ?></p>
            <p>Tags: Men, Sports, Women</p>
          </div>
        </div>
      </div>


    </div>
    <!-- </div> -->
  </div>
</section>



<section class="layout-pt-md layout-pb-md">
  <div class="tabs -active-purple-1 js-tabs">
    <div class="row pt-30 border-top-dark">
      <div class="col-12">
        <div class="tabs__controls d-flex justify-center js-tabs-controls">
          <button class="tabs__button js-tabs-button is-active" data-tab-target=".-tab-item-1" type="button">
            Description
          </button>
          <button class="tabs__button js-tabs-button ml-30 d-none" data-tab-target=".-tab-item-2" type="button">
            Reviews (2)
          </button>
          <button class="tabs__button js-tabs-button ml-30 d-non" data-tab-target=".-tab-item-3" type="button">
            Shipping
          </button>
          <button class="tabs__button js-tabs-button ml-30 d-non" data-tab-target=".-tab-item-4" type="button">
            Return Policy
          </button>
        </div>
      </div>

      <div class="container pt-60">
        <div class="row justify-center">
          <div class="py-20 px-20 col-xl-8 col-lg-10 justify-center">
            <div class="tabs__content js-tabs-content">
              <div class="tabs__pane -tab-item-1 is-active">
                <h4 class="text-18 fw-500">Description</h4>
                <p class="mt-10 text-light-1"><?php echo $product_des ?></p>

              </div>

              <div class="tabs__pane -tab-item-2">
                <div class="blogPost -comments">
                  <div class="blogPost__content">
                    <h2 class="text-20 fw-500">
                      Reviews
                    </h2>

                    <ul class="comments__list mt-30">
                      <li class="comments__item">
                        <div class="comments__item-inner md:direction-column">
                          <div class="comments__img mr-20">
                            <!-- <div class="bg-image rounded-full js-lazy" data-bg="assets/img/avatars/1.png"></div> -->
                          </div>

                          <div class="comments__body md:mt-15">
                            <div class="comments__header">
                              <h4 class="text-17 fw-500 lh-15">
                                Ali Tufan
                                <span class="text-13 text-light-1 fw-400">3 Days
                                  ago</span>
                              </h4>

                              <div class="stars"></div>
                            </div>

                            <h5 class="text-15 fw-500 mt-15">The best LMS Design</h5>
                            <div class="comments__text mt-10">
                              <p>This course is a very applicable. Professor Ng explains
                                precisely each algorithm and even tries to give an
                                intuition for mathematical and statistic concepts behind
                                each algorithm. Thank you very much.</p>
                            </div>

                            <div class="comments__helpful mt-20">
                              <span class="text-13 text-purple-1">Was this review
                                helpful?</span>
                              <button
                                class="button text-13 -sm -purple-1 text-white">Yes</button>
                              <button
                                class="button text-13 -sm -light-7 text-purple-1">No</button>
                            </div>
                          </div>
                        </div>
                      </li>

                      <li class="comments__item">
                        <div class="comments__item-inner md:direction-column">
                          <div class="comments__img mr-20">
                            <!-- <div class="bg-image rounded-full js-lazy"data-bg="assets/img/avatars/1.png"></div> -->
                          </div>

                          <div class="comments__body md:mt-15">
                            <div class="comments__header">
                              <h4 class="text-17 fw-500 lh-15">
                                Ali Tufan
                                <span class="text-13 text-light-1 fw-400">3 Days
                                  ago</span>
                              </h4>

                              <div class="stars"></div>
                            </div>

                            <h5 class="text-15 fw-500 mt-15">The best LMS Design</h5>
                            <div class="comments__text mt-10">
                              <p>This course is a very applicable. Professor Ng explains
                                precisely each algorithm and even tries to give an
                                intuition for mathematical and statistic concepts behind
                                each algorithm. Thank you very much.</p>
                            </div>

                            <div class="comments__helpful mt-20">
                              <span class="text-13 text-purple-1">Was this review
                                helpful?</span>
                              <button
                                class="button text-13 -sm -purple-1 text-white">Yes</button>
                              <button
                                class="button text-13 -sm -light-7 text-purple-1">No</button>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="respondForm pt-30">
                  <h3 class="text-20 fw-500">
                    Write a Review
                  </h3>

                  <div class="mt-30">
                    <h4 class="text-16 fw-500">What is it like to Course?</h4>
                    <div class="d-flex x-gap-10 pt-10">
                      <div class="icon-star text-14 text-yellow-1"></div>
                      <div class="icon-star text-14 text-yellow-1"></div>
                      <div class="icon-star text-14 text-yellow-1"></div>
                      <div class="icon-star text-14 text-yellow-1"></div>
                      <div class="icon-star text-14 text-yellow-1"></div>
                    </div>
                  </div>

                  <form class="contact-form respondForm__form row y-gap-30 pt-30" action="#">
                    <div class="col-12">
                      <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Review Title</label>
                      <input type="text" name="title" placeholder="Great Courses">
                    </div>
                    <div class="col-12">
                      <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Review Content</label>
                      <textarea name="comment" placeholder="Message" rows="8"></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" name="submit" id="submit"
                        class="button -md -purple-1 text-white">
                        Submit Review
                      </button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="tabs__pane -tab-item-3 is-">
                <!-- <h4 class="text-18 fw-500">Delivery Policy</h4>
                <p class="mt-10 text-light-1"><?php echo $delivery ?></p> -->

                <h4 class="text-18 fw-500">Order Processing</h4>
                <p class="mt-10 text-light-1">
                  All orders are processed within 1–2 business days (excluding weekends and holidays) after receiving your order confirmation email. You will receive another notification when your order has shipped.
                </p>
                <h4 class="text-18 fw-500">
                  Shipping Rates & Delivery Estimates
                </h4>
                <p class="mt-10 text-light-1">
                  Shipping charges for your order will be calculated and displayed at checkout. We offer both local and nationwide shipping through trusted courier services.
                </p>
                Location Estimated Delivery Time
                Lagos 1–3 business days
                Other Nigerian Cities 3–7 business days
                International 7–15 business days (if applicable)
                <h4 class="text-18 fw-500">
                  Shipping Confirmation & Order Tracking
                </h4>
                <p class="mt-10 text-light-1">
                  Once your order has shipped, you will receive a tracking number via email or SMS to monitor your delivery status.
                </p>

                <h4 class="text-18 fw-500">
                  Shipping Delays
                </h4>
                <p class="mt-10 text-light-1">
                  Please note that delivery delays can occasionally occur due to unforeseen circumstances. If your order is significantly delayed, we will contact you via email or phone.
                </p>

              </div>

              <div class="tabs__pane -tab-item-4 is-">
                <!-- <h4 class="text-18 fw-500">Return Policy</h4>
                <p class="mt-10 text-light-1"><?php echo $return ?></p> -->

                <h4 class="text-18 fw-500">
                  Eligibility for Returns
                </h4>
                <p class="mt-10 text-light-1">
                  We accept returns within 7 days of delivery for items that are unused, in original packaging, and in the same condition that you received them.
                </p>

                <h4 class="text-18 fw-500">
                  Items Not Eligible for Return
                </h4>
                <div class="row x-gap-100 justfiy-between">
                  <div class="col-md-6">
                    <div class="y-gap-20">

                      <div class="d-flex items-center">
                        <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                          <i class="icon-check text-6"></i>
                        </div>
                        <p>
                          Custom-made or personalized items
                        </p>
                      </div>
                      <div class="d-flex items-center">
                        <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                          <i class="icon-check text-6"></i>
                        </div>
                        <p>
                          Final sale/clearance items
                        </p>
                      </div>


                    </div>
                  </div>


                </div>
                <h4 class="text-18 fw-500">
                  How to Initiate a Return
                </h4>
                <p class="mt-10 text-light-1">
                  To start a return, please contact our support team at <a href="mailto:<?php echo MAIL ?>">hello@olneeluxury.com</a> or call us at <a href="tel:<?php echo PHONE ?>"></a> with your order number and reason for return. If your return is accepted, we’ll send you return instructions and a return shipping address.
                </p>

                <h4 class="text-18 fw-500">
                  Return Shipping Fees
                </h4>
                <p class="mt-10 text-light-1">
                  Customers are responsible for return shipping costs unless the return is due to a defective or incorrect item.
                </p>

                <h4 class="text-18 fw-500">
                  Refunds
                </h4>
                <p class="mt-10 text-light-1">
                  Once we receive and inspect your return, we will notify you of the approval or rejection of your refund. Approved refunds will be processed to your original payment method within 5–10 business days.
                </p>

                <h4 class="text-18 fw-500">
                  Exchanges
                </h4>
                <p class="mt-10 text-light-1">
                  We only replace items if they are defective or damaged. If you need to exchange an item, contact us with your order details.
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- <script src="api/productcart.js"></script> -->
<?php
include_once "comp/related.php";
include_once "comp/cart.php";
include_once "comp/footer.php";
include_once "comp/tail.php";
?>