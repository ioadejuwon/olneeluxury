<?php
$pagetitle = "Home";
include_once "comp/head.php";
include_once "comp/header.php";
?>



<div class="content-wrapper  js-content-wrapper">



  <!-- Hero Section Begin -->
  <div class="d-non" style="padding-top: 2%;;">
    <section data-anim-wrap class="masthead -type-2">
      <div class="masthead__bg">
        <div class="bg-image js-lazy" data-bg="assets/images/slider/5.jpg"></div>
      </div>

      <div class="container">
        <div class="row y-gap-50 justify-center items-center">
          <div class="col-xl-10 col-lg-11">
            <div class="masthead__content text-center">
              <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15">
                NEW ARRIVAL
              </div>
              <h1 data-anim-child="slide-up delay-1" class="masthead__title text-white mt-10">
                Effortless Elegance
              </h1>
              <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15 mt-10">
                Embrace the sun-kissed season with our collection of breezy
              </div>
              <div data-anim-child="slide-up delay-4" class="masthead__button mt-20">
                <a href="<?php echo SHOP ?>" class="button -md -white text-dark-1">Check the shop</a>
              </div>
            </div>
          </div>


        </div>
      </div>

    </section>
  </div>
  <!-- Hero Section End -->

  <section class="layout-pt-md layout-pb-lg pt-">
    <div class="container">
      <div class="row x-gap-60">
        <div class="col-lg-12">
          <div class="row y-gap-30">
            <?php
            $prodsql = mysqli_query($conn, "SELECT * FROM products LIMIT 5");
            while ($row_prod = mysqli_fetch_assoc($prodsql)) {
              $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
              $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
              $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
              $original_price = '&#8358;' . number_format($price);
              $discounted_price = '&#8358;' . number_format($dis_price);
              $product_id = $row_prod['productid'];

              // Get the thumbnail image
              $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
              $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
              $image_path_thumbnail = $row_prod_img_thumbnail['image_path'];
              $product_img = $image_path_thumbnail;

              // Get the non-thumbnail images
              $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
              $other_images = [];
              while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                $other_images[] = $row_prod_img['image_path'];
              }
            include 'comp/products.php';
            }
            ?>
          </div>
          <div class="container mt-20">
            <div class="row justify-center text-center">


              <div class="col-auto">
                <!-- <a href="courses-list-3.html" class="button -md  -deep-green-1 text-white mt-45 md:mt-20">Get Started Now</a> -->
                <a href="<?php echo SHOP ?>" class="button -md  -deep-green-1 text-white mt-45 md:mt-20">Check the shop</a>
              </div>
            </div>
          </div>


          <div class="row y-gap-30 d-none">
            <div class="col-lg-3 col-sm-6">
              <div class="productCard -type-1 text-center">

                <div class="productCard__image">

                  <div class="ratio ratio-63:57">
                    <img class="absolute-full-center rounded-8" src="admin/assets/img/shop/single/1.png" alt="project image">
                  </div>
                  <div class="productCard__controls z-3">
                    <a href="#" class="productCard__icon">
                      <i class="fa-regular fa-send"></i>
                    </a>

                    <a data-barba href="admin/assets/img/shop/single/3.png" class="gallery__item js-gallery productCard__icon" data-gallery="gallery1">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <a data-barba href="admin/assets/img/shop/single/3.png" class="gallery__item js-gallery " data-gallery="gallery2"></a>
                  </div>



                </div>
                <div class="productCard__content mt-20">

                  <h4 class="text-17 fw-500 mt-15">Wall Clock Brown</h4>
                  <div class="text-17 fw-500 text-deep-green-1 mt-15"> <span class="line-through opac-50 text-14">$55.00</span> $55.00</div>

                  <div class="productCard__button d-inline-block">
                    <a href="#" class="button -md -outline-deep-green-1 text-dark-1 mt-15">Add To Cart</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="layout-pt-l layout-pb-l pt-50 pb-50 d-none">
    <div class="container">

      <div class="row y-gap-3">


        <div class="col-lg-3 col-md-6">
          <div class="row y-gap-3">
            <div class="col-12">
              <div class="categoryCard -type-1">
                <div class="categoryCard__image">
                  <div class="bg-image ratio ratio-30:35 js-lazy" data-bg="admin/assets/img/home-2/categories/5.png"></div>
                </div>
                <div class="categoryCard__content text-center">
                  <h4 class="categoryCard__title text-17 lh-15 fw-500 text-white">Personal Development</h4>
                  <div class="categoryCard__subtitle text-13 text-white lh-1 mt-5">573+ Courses </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="row y-gap-">
            <div class="col-12">
              <div class="categoryCard -type-1">
                <div class="categoryCard__image">
                  <div class="bg-image ratio ratio-30:35 js-lazy" data-bg="admin/assets/img/home-2/categories/5.png"></div>
                </div>
                <div class="categoryCard__content text-center">
                  <h4 class="categoryCard__title text-17 lh-15 fw-500 text-white">Personal Development</h4>
                  <div class="categoryCard__subtitle text-13 text-white lh-1 mt-5">573+ Courses </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </section>


  <!-- Newsletter Section Begin -->
  <section class="layout-pt-l layout-pb-lg mb-90 section-bg d-none">
    <div class="section-bg__item">
      <img class="img-full rounded-16" src="admin/assets/img/home-3/cta/bg.png" alt="image">
    </div>

    <div class="container">
      <div class="row justify-center text-center">
        <div class="col-xl-5 col-lg-6 col-md-11">

          <div class="sectionTitle -light">

            <h2 class="sectionTitle__title ">Subscribe our Newsletter &</h2>

            <p class="sectionTitle__text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

          </div>

        </div>
      </div>

      <div class="row mt-30 justify-center">
        <div class="col-lg-6">
          <form class="form-single-field -help" action="https://creativelayers.net/themes/educrat-html/post">
            <input type="text" placeholder="Your Email...">
            <button class="button -purple-1 text-white" type="submit">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- Newsletter Section End -->



  <?php
  include_once "comp/cart.php";
  include_once "comp/footer.php";
  include_once "comp/tail.php";
  ?>