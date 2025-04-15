<div id="notification-container"></div>

<header data-anim="fade" data-add-bg="bg-whte" class="header -type-4 -shadow bg-white border-bottom-light js-header is-in-view d-non justify-center">
  <div class="container md:py-10">
    <div class="row justify-between items-center">

      <div class="col-auto">
        <div class="header-left d-flex items-center">
          <div class="header__logo pr-0 xl:pr-0 md:pr-0 pt-">
            <a data-barba="" href="<?php echo HOME ?>">
              <!-- <img class="no-big-screen" src="admin/assets/img/logo.png" alt="logo" width="40%"> -->
              <!-- <img class="lg:d-none" src="admin/assets/img/logo.png" alt="logo" width="30%"> -->
              <img src="admin/assets/img/logo.png" alt="logo" width="30%">
              <!-- <h2>Olnee Luxury</h2> -->
            </a>
          </div>
        </div>
      </div>


      <div class="col-auto">
        <div class="header-menu js-mobile-menu-toggle ">
          <div class="header-menu__content">
            <div class="mobile-bg js-mobile-bg"></div>
            <div class="menu js-navList">
              <ul class="menu__nav text-dark-1 -is-active pt-15">
                <li class="fw-600">
                  <a data-barba="" href="<?php echo HOME ?>">Home</a>
                </li>

                <li class="fw-600">
                  <a data-barba="" href="<?php echo SHOP ?>">Catalog</a>
                </li>

                <li class="fw-600">
                  <a data-barba="" href="<?php echo COLLECTION ?>">Collection</a>
                </li>
                <li class="fw-600">
                  <a data-barba="" href="<?php echo PICTURES ?>">Customers' Cam</a>
                </li>

                <li class="fw-600 d-none">
                  <a data-barba="" href="<?php echo '#' ?>">Blog</a>
                </li>
              </ul>
            </div>

            <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
              <div class="mobile-footer__number">
                <div class="text-17 fw-500 text-dark-1">Call us</div>
                <div class="text-17 fw-500 text-purple-1">0000</div>
              </div>

              <div class="lh-2 mt-10">
                <div>kkkkk, Lagos State.</div>
                <div>hello@olneeluxury.com</div>
              </div>

              <div class="mobile-socials mt-10">

                <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                  <i class="fa fa-facebook"></i>
                </a>

                <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                  <i class="fa fa-twitter"></i>
                </a>

                <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                  <i class="fa fa-instagram"></i>
                </a>

                <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                  <i class="fa fa-linkedin"></i>
                </a>

              </div>
            </div>
          </div>

          <div class="header-menu-close" data-el-toggle=".js-mobile-menu-toggle">
            <div class="size-40 d-flex items-center justify-center rounded-full bg-white">
              <div class="icon-close text-dark-1 text-16"></div>
            </div>
          </div>

          <div class="header-menu-bg"></div>
        </div>

      </div>


      <div class="col-auto">
        <div class="header-right d-flex items-center">
          <div class="header-right__icons text-white d-flex items-center">

            <div class="pr-20 sm:pr-15 no-icon">
              <button class="d-flex items-center text-dark-1" data-el-toggle=".js-search-toggle">
                <i class="text-20 icon icon-search"></i>
              </button>

              <div class="toggle-element js-search-toggle">
                <div class="header-search pt-90 bg-white shadow-4">
                  <div class="container">
                    <form action="<?php echo SEARCH ?>">
                      <div class="header-search__field">
                        <div class="icon icon-search text-dark-1"></div>
                        <input type="text"
                          name="s"
                          value="<?php
                                  if (isset($_GET['s'])) {
                                    echo  $_GET['s'];
                                  }
                                  ?>"
                          class="col-12 text-18 lh-12 text-dark-1 fw-500"
                          placeholder="What products are you looking for?">

                        <button class="d-flex items-center justify-center size-40 rounded-full bg-purple-3" data-el-toggle=".js-search-toggle">
                          <img src="admin/assets/img/icons/close.png" alt="icon" width="50%">
                        </button>
                      </div>
                    </form>

                    <div class="header-search__content mt-30">
                      <div class="text-17 text-dark-1 fw-500">Popular Products Now</div>
                      <?php
                      $prodheader = mysqli_query($conn, "SELECT * FROM products LIMIT 4");
                      while ($row_prod_header = mysqli_fetch_assoc($prodheader)) {
                        $product_nameheader = $row_prod_header['producttitle']; // Assuming the column name for the product name is 'product_name'
                        $product_idheader = $row_prod_header['productid'];
                      ?>
                        <div class="d-flex y-gap-5 flex-column mt-20">
                          <a href="<?php echo PRODUCT_DETAIILS . $product_idheader ?>" class="text-dark-1"><?php echo $product_nameheader ?></php></a>
                        </div>
                      <?php
                      }
                      ?>

                      <div class="mt-30 d-none">
                        <button class="uppercase underline">PRESS ENTER TO SEE ALL SEARCH RESULTS</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="header-search__bg" data-el-toggle=".js-search-toggle"></div>
              </div>
            </div>

            <div class="relative  px-20 sm:px-15 -before-border no-icon-2">
              <button class="d-flex items-center  text-dark-1" data-el-toggle=".js-cart-toggle">
                <!-- <button class="d-flex items-center text-dark-1 cart-toggle-btn"> -->
                <i class="text-20 icon icon-basket"></i>
                <span class="cart-items-number-header" style="border: 0px !important;">
                  <span class="cart-item-count-toolbar" style="font-size: 10px;">0</span>
                </span>
              </button>

              <!-- <div class="toggle-element js-cart-toggle"> -->
              <div class="toggle-element js-cart-toggle js-click-dropdown">

                <div class="header-cart bg-white -dark-bg-dark-1 rounded-8 outline-green" style="width: 500px;">


                  <section class=" section-b mt-30 tf-page-header bg-light-3 ml-10 mr-10 rounded-8" style="display: none; ">
                    <!-- <div class="section-bg__item bg-light-6"></div> -->
                    <div class="container ">
                      <div class="row y-gap-20 justify-center text-center">
                        <div class="col-12">
                          <div class="sectionTitle ">
                            <h4 class="sectionTitle__titl ">Your cart is empty</h4>
                            <p class="sectionTitle__text h6">You may check out all the available products and add some to your cart from the catalog</p>
                          </div>

                        </div>
                      </div>
                    </div>
                  </section>

                  <div class="px-30 pt-30 pb-10" id="headerCart">
                    <div class="row justify-between x-gap-40 pb-20">
                      <div class="col">
                        <div class="row x-gap-10 y-gap-10">
                          <div class="col-auto">
                            <img src="admin/assets/img/icon.png" alt="icon" width="20%">
                          </div>
                          <div class="col">
                            <div class="text-dark-1 lh-15">Product</div>
                            <div class="d-flex items-center mt-10">
                              <div class="lh-12 fw-500 line-through text-light-1 mr-10 price">₦179</div>
                              <div class="text-18 lh-12 fw-500 text-dark-1 price">$79</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <button>
                          <img src="admin/assets/img/icons/close.png" alt="icon">
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="px-30 pt-20 pb-30 border-top-light headerCartWrap">
                    <div class="d-flex justify-between">
                      <div class="text-18 lh-12 text-dark-1 fw-500">Total:</div>
                      <div class="text-18 lh-12 text-dark-1 fw-500" id="headerTotal">$659</div>
                    </div>

                    <div class="row x-gap-20 y-gap-10 pt-30">
                      <div class="col-sm-6">
                        <a href="<?php echo CART ?>" class="button py-20 -deep-green-1 text-white col-12"> View Cart</a>
                      </div>
                      <div class="col-sm-6">
                        <a href="<?php echo CHECKOUT ?>" class="button py-20 -deep-green-1 text-white col-12"> Checkout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="relative -before-border px-20 sm:px-15 no-icon-2 d-none">
              <!-- <button class="d-flex items-center text-dark-1" data-el-toggle=".js-cart-toggle"> -->
              <button class="d-flex items-center text-dark-1 cart-toggle-btn">
                <i class="text-20 icon icon-basket"></i>
                <span class="cart-items-number-header" style="border: 0px !important;">
                  <span class="cart-item-count-toolbar" style="font-size: 10px;">0</span>
                </span>
              </button>


              <!-- <div class="toggle-element js-cart-toggle"> -->
              <div class="dropdown-content cart-dropdown">
                <!-- <div class="dropdown-content cart-dropdown"> -->
                <div class="header-cart bg-white -dark-bg-dark-1 rounded-8 outline-green" style="width: 500px;">



                  <div class="px-30 pt-30 pb-10" id="headerCart">
                    <div class="row justify-between x-gap-40 pb-20">
                      <div class="col">
                        <div class="row x-gap-10 y-gap-10">
                          <div class="col-auto">
                            <img src="admin/assets/img/icon.png" alt="icon" width="20%">
                          </div>
                          <div class="col">
                            <div class="text-dark-1 lh-15">Product</div>
                            <div class="d-flex items-center mt-10">
                              <div class="lh-12 fw-500 line-through text-light-1 mr-10 price">₦179</div>
                              <div class="text-18 lh-12 fw-500 text-dark-1 price">$79</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <button>
                          <img src="admin/assets/img/icons/close.png" alt="icon">
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="px-30 pt-20 pb-30 border-top-light headerCartWrap">
                    <div class="d-flex justify-between">
                      <div class="text-18 lh-12 text-dark-1 fw-500">Total:</div>
                      <div class="text-18 lh-12 text-dark-1 fw-500" id="headerTotal">$659</div>
                    </div>

                    <div class="row x-gap-20 y-gap-10 pt-30">
                      <div class="col-sm-6">
                        <a href="<?php echo CART ?>" class="button py-20 -deep-green-1 text-white col-12"> View Cart</a>
                      </div>
                      <div class="col-sm-6">
                        <a href="<?php echo CHECKOUT ?>" class="button py-20 -deep-green-1 text-white col-12"> Checkout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="d-none xl:d-block -before-border pl-20 sm:pl-15">
              <button class="text-dark-1 items-center" data-el-toggle=".js-mobile-menu-toggle">
                <i class="text-11 icon icon-mobile-menu"></i>
              </button>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</header>

<div class="content-wrapper  js-content-wrapper">