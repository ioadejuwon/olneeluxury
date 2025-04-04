<?php
$pagetitle = "Home";
include_once "comp/head.php";
include_once "comp/header.php";
?>


<div class="content-wrapper  js-content-wrapper">

  <?php
  include_once "comp/hero-page.php";
  include_once "comp/bestselling.php";
  ?>






  <section class="layout-pt-md layout-pb-md">
    <div class="container">

      <div class="row y-gap-30 pt-60 lg:pt-50">

        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="categoryCard -type-3" style="border: 0;">
            <div class="categoryCard__icon bg-light-3 mr-20">
              <i class="icon icon-announcement text-35"></i>
            </div>
            <div class="categoryCard__content">
              <h4 class="categoryCard__title text-17">Free Shipping</h4>
              <div class="categoryCard__text text-13 mt-5">
                Free Shipping for order above <?php echo NAIRA ?>120,000
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="categoryCard -type-3" style="border: 0;">
            <div class="categoryCard__icon bg-light-3 mr-20">
              <i class="icon icon-announcement text-35"></i>
            </div>
            <div class="categoryCard__content">
              <h4 class="categoryCard__title text-17">Flexible Payment</h4>
              <div class="categoryCard__text text-13 mt-5">
                Pay with Multiple Credit Cards
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="categoryCard -type-3" style="border: 0;">
            <div class="categoryCard__icon bg-light-3 mr-20">
              <i class="icon icon-announcement text-35"></i>
            </div>
            <div class="categoryCard__content">
              <h4 class="categoryCard__title text-17">14 Day Returns</h4>
              <div class="categoryCard__text text-13 mt-5">
                Within 30 days for an exchange
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="categoryCard -type-3" style="border: 0;">
            <div class="categoryCard__icon bg-light-3 mr-20">
              <i class="icon icon-announcement text-35"></i>
            </div>
            <div class="categoryCard__content">
              <h4 class="categoryCard__title text-17">Premium Support</h4>
              <div class="categoryCard__text text-13 mt-5">
                Outstanding premium support
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </section>


  <?php
  include_once "comp/cart.php";
  include_once "comp/footer.php";
  include_once "comp/tail.php";
  ?>