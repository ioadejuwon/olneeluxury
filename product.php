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
$product_des = $row_prod['productdescription'];
$short_des = $row_prod['shortdescription'];

$product_cat_id = $row_prod['productcategory'];

$price = $row_prod['price'];
$dis_price = $row_prod['discount_price'];

$pagetitle = $product_name;

include_once "comp/head.php";
include_once "comp/header.php";


// $original_price = '&#8358;' . number_format($price);
// $discounted_price = '&#8358;' . number_format($dis_price);




$product_category = mysqli_query($conn, "SELECT * FROM olnee_categories WHERE categoryid = '$product_cat_id'");
$row_prod_cat = mysqli_fetch_assoc($product_category);
$category_name = $row_prod_cat['categoryName'];


$prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' ORDER BY thumbnail DESC");
$other_images = [];
while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
  $image_path = $row_prod_img['image_path'];
  if(empty($image_path)){
    $image_path = "product-img/product.png";
  }
  $other_images[] = 'admin/' . $image_path;
}

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
          <div class="text-20 text-purple-1 mt-15 ">
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
            <p>
              <?php echo $short_des ?>
            </p>
          </div>


          <div class="shopSingle-info__action row x-gap-20 y-gap-20 pt-30">
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
              <button class="button h-50 px-45 -deep-green-1 text-white add-to-cart-btn" data-product-id="<?php echo $product_id; ?>">Add to cart</button>
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
        </div>
      </div>

      <div class="container pt-60">
        <div class="row justify-center">
          <div class="col-xl-8 col-lg-10 justify-center">
            <div class="tabs__content js-tabs-content">
              <div class="tabs__pane -tab-item-1 is-active">
                <h4 class="text-18 fw-500">Description</h4>
                <p class="mt-30"><?php echo $product_des ?></p>
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-18 fw-500">Item Details</h4>

                  </div>
                </div>
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
                            <div class="bg-image rounded-full js-lazy"
                              data-bg="assets/img/avatars/1.png"></div>
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
                            <div class="bg-image rounded-full js-lazy"
                              data-bg="assets/img/avatars/1.png"></div>
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