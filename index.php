<?php
$pagetitle = "Home";
include_once "comp/head.php";
include_once "comp/header.php";
?>


<div class="content-wrapper  js-content-wrapper">



  <section data-anim-wrap class="d-none mainSlider -type-1 js-mainSlider">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div data-anim-child="fade" class="mainSlider__bg">
          <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.jpg"></div>
        </div>
      </div>
      <div class="swiper-slide">
        <div data-anim-child="fade" class="mainSlider__bg">
          <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.jpg"></div>
        </div>
      </div>
      <div class="swiper-slide">
        <div data-anim-child="fade" class="mainSlider__bg">
          <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.jpg"></div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row y-gap-50 justify-center items-center text-center">
        <div class="col-xl-6 col-lg-8">
          <div class="mainSlider__content">
            <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15">
              NEW ARRIVAL
            </div>
            <h1 data-anim-child="slide-up delay-3" class="mainSlider__title text-white">
              Ego Builder
            </h1>
            <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15 mt-10">
              Comfortability
            </div>
            <div data-anim-child="slide-up delay-4" class="masthead__button mt-20 mb-90">
              <a href="<?php echo SHOP ?>" class="button -md -white text-dark-1">Visit the shop</a>
            </div>
          </div>
        </div>
      </div>

      <button class="d-none swiper-prev button -white-20 text-white size-60 rounded-full d-flex justify-center items-center js-prev d-none">
        <i class="icon icon-arrow-left text-24"></i>
      </button>

      <button class="d-none swiper-next button -white-20 text-white size-60 rounded-full d-flex justify-center items-center js-next d-none">
        <i class="icon icon-arrow-right text-24"></i>
      </button>
  </section>

  <?php
  include_once "comp/hero-page.php";
  include_once "comp/bestselling.php";
  ?>



  <section class="layout-pt-md layout-pb-md bg-light-6">
    <div data-anim-wrap class="container">
      <div class="row justify-center">
        <div class="col text-center">
          <p class="text-lg text-dark-1">Trusted by the world’s best</p>
        </div>
      </div>

      <div class="row y-gap-30 justify-between sm:justify-start items-center pt-60 md:pt-50">

        <div data-anim-child="slide-up delay-1" class="col-lg-auto col-md-2 col-sm-3 col-6">
          <div class="d-flex justify-center items-center px-4">
            <img class="w-1/1" src="admin/assets/img/clients/1.svg" alt="clients image">
          </div>
        </div>

        <div data-anim-child="slide-up delay-1" class="col-lg-auto col-md-2 col-sm-3 col-6">
          <div class="d-flex justify-center items-center px-4">
            <img class="w-1/1" src="admin/assets/img/clients/2.svg" alt="clients image">
          </div>
        </div>

        <div data-anim-child="slide-up delay-1" class="col-lg-auto col-md-2 col-sm-3 col-6">
          <div class="d-flex justify-center items-center px-4">
            <img class="w-1/1" src="admin/assets/img/clients/3.svg" alt="clients image">
          </div>
        </div>

        <div data-anim-child="slide-up delay-1" class="col-lg-auto col-md-2 col-sm-3 col-6">
          <div class="d-flex justify-center items-center px-4">
            <img class="w-1/1" src="admin/assets/img/clients/4.svg" alt="clients image">
          </div>
        </div>

        <div data-anim-child="slide-up delay-1" class="col-lg-auto col-md-2 col-sm-3 col-6">
          <div class="d-flex justify-center items-center px-4">
            <img class="w-1/1" src="admin/assets/img/clients/5.svg" alt="clients image">
          </div>
        </div>

        <div data-anim-child="slide-up delay-1" class="col-lg-auto col-md-2 col-sm-3 col-6">
          <div class="d-flex justify-center items-center px-4">
            <img class="w-1/1" src="admin/assets/img/clients/6.svg" alt="clients image">
          </div>
        </div>

      </div>
    </div>
  </section>



  <section class="layout-pt-md layout-pb-md">
    <div class="container">

      <div class="row y-gap-30 pt-60 lg:pt-50">

        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="categoryCard -type-3" style="border: 0;">
            <div class="categoryCard__icon bg-light-3 mr-20">
              <i class="icon icon-announcement text-35"></i>
            </div>
            <div class="categoryCard__content">
              <h4 class="categoryCard__title text-17 fw-500">Free Shipping</h4>
              <div class="categoryCard__text text-13 lh-1 mt-5">
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
              <h4 class="categoryCard__title text-17 fw-500">Flexible Payment</h4>
              <div class="categoryCard__text text-13 lh-1 mt-5">
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
              <h4 class="categoryCard__title text-17 fw-500">14 Day Returns</h4>
              <div class="categoryCard__text text-13 lh-1 mt-5">
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
              <h4 class="categoryCard__title text-17 fw-500">Premium Support</h4>
              <div class="categoryCard__text text-13 lh-1 mt-5">
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