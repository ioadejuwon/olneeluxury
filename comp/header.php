<div id="notification-container"></div>



<header data-anim="fade" data-add-bg="bg-whte" class="header -type-4 -shadow bg-white border-bottom-light js-header is-in-view d-non justify-center">
  <div class="container py-10">
    <div class="row justify-between items-center">

      <div class="col-auto">
        <div class="header-left d-flex items-center">
          <div class="header__logo pr-30 xl:pr-20 md:pr-0">
            <a data-barba="" href="<?php echo HOME ?>">
              <!-- <img src="admin/assets/img/logo.png" alt="logo" width="50px"> -->
              <h2>Olnee Luxury</h2>
            </a>
          </div>
        </div>
      </div>


      <div class="col-auto">
        <div class="header-menu js-mobile-menu-toggle ">
          <div class="header-menu__content">
            <div class="mobile-bg js-mobile-bg"></div>
            <div class="menu js-navList">
              <ul class="menu__nav text-dark-1 -is-active">
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
                  <a data-barba="" href="<?php echo '#' ?>">Blog</a>
                </li>
              </ul>
            </div>

            <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
              <div class="mobile-footer__number">
                <div class="text-17 fw-500 text-dark-1">Call us</div>
                <div class="text-17 fw-500 text-purple-1">08108806808</div>
              </div>

              <div class="lh-2 mt-10">
                <div>Ajebamidele,<br> Ibadan Rd, Osun State.</div>
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
                        <input type="text" name="s" value="<?php if (isset($_GET['s'])) {
                                                              echo  $_GET['s'];
                                                            } ?>" class="col-12 text-18 lh-12 text-dark-1 fw-500" placeholder="What products are you looking for?">

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


            <div class="relative -before-border px-20 sm:px-15 no-icon-2">
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
                            <!-- <img src="admin/assets/img/menus/cart/1.png" alt="image"> -->
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

      <div class="col-auto d-none">
        <div class="header-right d-flex items-center">
          <div class="header-right__icons text-white d-flex items-center">



            <div class="relative ml-30 xl:ml-20">
              <button class="d-flex items-center text-dark-1" data-el-toggle=".js-cart-toggle">
                <i class="text-20 icon icon-basket"></i>
              </button>

              <div class="toggle-element js-cart-toggle">
                <div class="header-cart bg-white -dark-bg-dark-1 rounded-8">
                  <div class="px-30 pt-30 pb-10">

                    <div class="row justify-between x-gap-40 pb-20">
                      <div class="col">
                        <div class="row x-gap-10 y-gap-10">
                          <div class="col-auto">
                            <img src="img/menus/cart/1.png" alt="image">
                          </div>

                          <div class="col">
                            <div class="text-dark-1 lh-15">The Ultimate Drawing Course Beginner to Advanced...</div>

                            <div class="d-flex items-center mt-10">
                              <div class="lh-12 fw-500 line-through text-light-1 mr-10">$179</div>
                              <div class="text-18 lh-12 fw-500 text-dark-1">$79</div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-auto">
                        <button><img src="img/menus/close.svg" alt="icon"></button>
                      </div>
                    </div>

                    <div class="row justify-between x-gap-40 pb-20">
                      <div class="col">
                        <div class="row x-gap-10 y-gap-10">
                          <div class="col-auto">
                            <img src="img/menus/cart/2.png" alt="image">
                          </div>

                          <div class="col">
                            <div class="text-dark-1 lh-15">User Experience Design Essentials - Adobe XD UI UX...</div>

                            <div class="d-flex items-center mt-10">
                              <div class="lh-12 fw-500 line-through text-light-1 mr-10">$179</div>
                              <div class="text-18 lh-12 fw-500 text-dark-1">$79</div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-auto">
                        <button><img src="img/menus/close.svg" alt="icon"></button>
                      </div>
                    </div>

                  </div>

                  <div class="px-30 pt-20 pb-30 border-top-light">
                    <div class="d-flex justify-between">
                      <div class="text-18 lh-12 text-dark-1 fw-500">Total:</div>
                      <div class="text-18 lh-12 text-dark-1 fw-500">$659</div>
                    </div>

                    <div class="row x-gap-20 y-gap-10 pt-30">
                      <div class="col-sm-6">
                        <button class="button py-20 -dark-1 text-white -dark-button-white col-12">View Cart</button>
                      </div>
                      <div class="col-sm-6">
                        <button class="button py-20 -purple-1 text-white col-12">Checkout</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="d-none xl:d-block ml-20">
              <button class="text-white items-center" data-el-toggle=".js-mobile-menu-toggle">
                <i class="text-11 icon icon-mobile-menu"></i>
              </button>
            </div>

          </div>

          <div class="header-right__buttons d-flex items-center ml-30 md:d-none">
            <a href="login.html" class="button -underline text-white">Log in</a>
            <a href="signup.html" class="button -sm -white text-dark-1 ml-30">Sign up</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<header data-anim="fade" data-add-bg="bg-whte" class="header -type-4  -shadow bg-white border-bottom-light js-header is-in-view d-none">


  <div class="header__container">
    <div class="row justify-between items-center">

      <div class="col-auto">
        <div class="header-left d-flex items-center">
          <div class="header__logo pr-30 xl:pr-20 md:pr-0">
            <a data-barba="" href="<?php echo HOME ?>">
              <!-- <img src="admin/assets/img/logo.png" alt="logo" width="50px"> -->
              <h2>Olnee Luxury</h2>
            </a>
          </div>
        </div>
      </div>


      <div class="header-menu js-mobile-menu-toggle ">
        <div class="header-menu__content">
          <div class="mobile-bg js-mobile-bg"></div>

          <div class="d-none xl:d-flex items-center px-20 py-20 border-bottom-light">
            <a href="login.html" class="text-dark-1">Log in</a>
            <a href="signup.html" class="text-dark-1 ml-30">Sign Up</a>
          </div>

          <div class="menu js-navList">
            <ul class="menu__nav text-white -is-active">
              <li class="menu-item-has-children">
                <a data-barba href="#">
                  Home <i class="icon-chevron-right text-13 ml-10"></i>
                </a>

                <ul class="subnav">
                  <li class="menu__backButton js-nav-list-back">
                    <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Home</a>
                  </li>

                  <li><a href="index-2.html">Home 1</a></li>

                  <li><a href="home-2.html">Home 2</a></li>

                  <li><a href="home-3.html">Home 3</a></li>

                  <li><a href="home-4.html">Home 4</a></li>

                  <li><a href="home-5.html">Home 5</a></li>

                  <li><a href="home-6.html">Home 6</a></li>

                  <li><a href="home-7.html">Home 7</a></li>

                  <li><a href="home-8.html">Home 8</a></li>

                  <li><a href="home-9.html">Home 9</a></li>

                  <li><a href="home-10.html">Home 10</a></li>

                </ul>
              </li>

              <li class="menu-item-has-children -has-mega-menu">
                <a data-barba href="#">Courses <i class="icon-chevron-right text-13 ml-10"></i></a>


                <div class="mega xl:d-none">
                  <div class="mega__menu">
                    <div class="row x-gap-40">
                      <div class="col">
                        <h4 class="text-17 fw-500 mb-20">Course List Layouts</h4>

                        <ul class="mega__list">

                          <li><a data-barba href="courses-list-1.html">Course List v1</a></li>

                          <li><a data-barba href="courses-list-2.html">Course List v2</a></li>

                          <li><a data-barba href="courses-list-3.html">Course List v3</a></li>

                          <li><a data-barba href="courses-list-4.html">Course List v4</a></li>

                          <li><a data-barba href="courses-list-5.html">Course List v5</a></li>

                          <li><a data-barba href="courses-list-6.html">Course List v6</a></li>

                          <li><a data-barba href="courses-list-7.html">Course List v7</a></li>

                          <li><a data-barba href="courses-list-8.html">Course List v8</a></li>

                          <li><a data-barba href="courses-list-9.html">Course List v9</a></li>

                        </ul>

                      </div>

                      <div class="col">
                        <h4 class="text-17 fw-500 mb-20">Course Single Layouts</h4>

                        <ul class="mega__list">

                          <li><a data-barba href="courses-single-1.html">Course Single v1</a></li>

                          <li><a data-barba href="courses-single-2.html">Course Single v2</a></li>

                          <li><a data-barba href="courses-single-3.html">Course Single v3</a></li>

                          <li><a data-barba href="courses-single-4.html">Course Single v4</a></li>

                          <li><a data-barba href="courses-single-5.html">Course Single v5</a></li>

                          <li><a data-barba href="courses-single-6.html">Course Single v6</a></li>

                        </ul>

                      </div>

                      <div class="col">
                        <h4 class="text-17 fw-500 mb-20">About Courses</h4>

                        <ul class="mega__list">

                          <li><a data-barba href="lesson-single-1.html">Lesson Page v1</a></li>

                          <li><a data-barba href="lesson-single-2.html">Lesson Page v2</a></li>

                          <li><a data-barba href="instructors-list-1.html">Instructors List v1</a></li>

                          <li><a data-barba href="instructors-list-2.html">Instructors List v2</a></li>

                          <li><a data-barba href="instructors-single.html">Instructors Single</a></li>

                          <li><a data-barba href="instructors-become.html">Become an Instructor</a></li>

                        </ul>

                      </div>

                      <div class="col">
                        <h4 class="text-17 fw-500 mb-20">Dashboard Pages</h4>

                        <ul class="mega__list">

                          <li><a data-barba href="dashboard.html">Dashboard</a></li>

                          <li><a data-barba href="dshb-courses.html">My Courses</a></li>

                          <li><a data-barba href="dshb-bookmarks.html">Bookmarks</a></li>

                          <li><a data-barba href="dshb-listing.html">Add Listing</a></li>

                          <li><a data-barba href="dshb-reviews.html">Reviews</a></li>

                          <li><a data-barba href="dshb-settings.html">Settings</a></li>

                          <li><a data-barba href="dshb-administration.html">Administration</a></li>

                          <li><a data-barba href="dshb-assignment.html">Assignment</a></li>

                          <li><a data-barba href="dshb-calendar.html">Calendar</a></li>

                          <li><a data-barba href="dshb-dashboard.html">Single Dashboard</a></li>

                          <li><a data-barba href="dshb-dictionary.html">Dictionary</a></li>

                          <li><a data-barba href="dshb-forums.html">Forums</a></li>

                          <li><a data-barba href="dshb-grades.html">Grades</a></li>

                          <li><a data-barba href="dshb-messages.html">Messages</a></li>

                          <li><a data-barba href="dshb-participants.html">Participants</a></li>

                          <li><a data-barba href="dshb-quiz.html">Quiz</a></li>

                          <li><a data-barba href="dshb-survey.html">Survey</a></li>

                        </ul>

                      </div>

                      <div class="col">
                        <h4 class="text-17 fw-500 mb-20">Popular Courses</h4>

                        <ul class="mega__list">

                          <li><a data-barba href="#">Web Developer</a></li>

                          <li><a data-barba href="#">Mobile Developer</a></li>

                          <li><a data-barba href="#">Digital Marketing</a></li>

                          <li><a data-barba href="#">Development</a></li>

                          <li><a data-barba href="#">Finance &amp; Accounting</a></li>

                          <li><a data-barba href="#">Design</a></li>

                          <li><a data-barba href="#">View All Courses</a></li>

                        </ul>

                      </div>
                    </div>

                    <div class="mega-banner bg-purple-1 ml-40">
                      <div class="text-24 lh-15 text-white fw-700">
                        Join more than<br>
                        <span class="text-green-1">8 million learners</span>
                        worldwide
                      </div>
                      <a href="#" class="button -md -green-1 text-dark-1 fw-500 col-12">Start Learning For Free</a>
                    </div>
                  </div>
                </div>


                <ul class="subnav d-none xl:d-block">
                  <li class="menu__backButton js-nav-list-back">
                    <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Courses</a>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">Course List Layouts<div class="icon-chevron-right text-11"></div></a>

                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Course List Layouts</a>
                      </li>

                      <li>
                        <a href="courses-list-1.html">Course List v1</a>
                      </li>

                      <li>
                        <a href="courses-list-2.html">Course List v2</a>
                      </li>

                      <li>
                        <a href="courses-list-3.html">Course List v3</a>
                      </li>

                      <li>
                        <a href="courses-list-4.html">Course List v4</a>
                      </li>

                      <li>
                        <a href="courses-list-5.html">Course List v5</a>
                      </li>

                      <li>
                        <a href="courses-list-6.html">Course List v6</a>
                      </li>

                      <li>
                        <a href="courses-list-7.html">Course List v7</a>
                      </li>

                      <li>
                        <a href="courses-list-8.html">Course List v8</a>
                      </li>

                      <li>
                        <a href="courses-list-all.html">Course List All</a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">Course Single Layouts<div class="icon-chevron-right text-11"></div></a>

                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Course Single Layouts</a>
                      </li>

                      <li>
                        <a href="courses-single-1.html">Course Single v1</a>
                      </li>

                      <li>
                        <a href="courses-single-2.html">Course Single v2</a>
                      </li>

                      <li>
                        <a href="courses-single-3.html">Course Single v3</a>
                      </li>

                      <li>
                        <a href="courses-single-4.html">Course Single v4</a>
                      </li>

                      <li>
                        <a href="courses-single-5.html">Course Single v5</a>
                      </li>

                      <li>
                        <a href="courses-single-6.html">Course Single v6</a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">About Courses<div class="icon-chevron-right text-11"></div></a>

                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> About Courses</a>
                      </li>

                      <li>
                        <a href="lesson-single-1.html">Lesson Page v1</a>
                      </li>

                      <li>
                        <a href="lesson-single-2.html">Lesson Page v2</a>
                      </li>

                      <li>
                        <a href="instructors-list-1.html">Instructors List v1</a>
                      </li>

                      <li>
                        <a href="instructors-list-2.html">Instructors List v2</a>
                      </li>

                      <li>
                        <a href="instructors-single.html">Instructors Single</a>
                      </li>

                      <li>
                        <a href="instructors-become.html">Become an Instructor</a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">Dashboard Pages<div class="icon-chevron-right text-11"></div></a>

                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Dashboard Pages</a>
                      </li>

                      <li>
                        <a href="dashboard.html">Dashboard</a>
                      </li>

                      <li>
                        <a href="dshb-courses.html">My Courses</a>
                      </li>

                      <li>
                        <a href="dshb-bookmarks.html">Bookmarks</a>
                      </li>

                      <li>
                        <a href="dshb-listing.html">Add Listing</a>
                      </li>

                      <li>
                        <a href="dshb-reviews.html">Reviews</a>
                      </li>

                      <li>
                        <a href="dshb-settings.html">Settings</a>
                      </li>

                      <li>
                        <a href="dshb-administration.html">Administration</a>
                      </li>

                      <li>
                        <a href="dshb-assignment.html">Assignment</a>
                      </li>

                      <li>
                        <a href="dshb-calendar.html">Calendar</a>
                      </li>

                      <li>
                        <a href="dshb-dashboard.html">Single Dashboard</a>
                      </li>

                      <li>
                        <a href="dshb-dictionary.html">Dictionary</a>
                      </li>

                      <li>
                        <a href="dshb-forums.html">Forums</a>
                      </li>

                      <li>
                        <a href="dshb-grades.html">Grades</a>
                      </li>

                      <li>
                        <a href="dshb-messages.html">Messages</a>
                      </li>

                      <li>
                        <a href="dshb-participants.html">Participants</a>
                      </li>

                      <li>
                        <a href="dshb-quiz.html">Quiz</a>
                      </li>

                      <li>
                        <a href="dshb-survey.html">Survey</a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">Popular Courses<div class="icon-chevron-right text-11"></div></a>

                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Popular Courses</a>
                      </li>

                      <li>
                        <a href="#">Web Developer</a>
                      </li>

                      <li>
                        <a href="#">Mobile Developer</a>
                      </li>

                      <li>
                        <a href="#">Digital Marketing</a>
                      </li>

                      <li>
                        <a href="#">Development</a>
                      </li>

                      <li>
                        <a href="#">Finance &amp; Accounting</a>
                      </li>

                      <li>
                        <a href="#">Design</a>
                      </li>

                      <li>
                        <a href="#">View All Courses</a>
                      </li>

                    </ul>
                  </li>
                </ul>
              </li>

              <li class="menu-item-has-children">
                <a data-barba href="#">Events <i class="icon-chevron-right text-13 ml-10"></i></a>
                <ul class="subnav">
                  <li class="menu__backButton js-nav-list-back">
                    <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Events</a>
                  </li>

                  <li><a href="event-list-1.html">Event List 1</a></li>

                  <li><a href="event-list-2.html">Event List 2</a></li>

                  <li><a href="event-single.html">Event Single</a></li>

                </ul>
              </li>

              <li class="menu-item-has-children">
                <a data-barba href="#">Blog <i class="icon-chevron-right text-13 ml-10"></i></a>
                <ul class="subnav">
                  <li class="menu__backButton js-nav-list-back">
                    <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Blog</a>
                  </li>

                  <li><a href="blog-list-1.html">Blog List 1</a></li>

                  <li><a href="blog-list-2.html">Blog List 2</a></li>

                  <li><a href="blog-list-3.html">Blog List 3</a></li>

                  <li><a href="blog-single.html">Blog Single</a></li>

                </ul>
              </li>

              <li class="menu-item-has-children">
                <a data-barba href="#">
                  Pages <i class="icon-chevron-right text-13 ml-10"></i>
                </a>

                <ul class="subnav">
                  <li class="menu__backButton js-nav-list-back">
                    <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Pages</a>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">About Us<div class="icon-chevron-right text-11"></div></a>

                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> About Us</a>
                      </li>

                      <li>
                        <a href="about-1.html">About 1</a>
                      </li>

                      <li>
                        <a href="about-2.html">About 2</a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">Contact<div class="icon-chevron-right text-11"></div></a>
                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Contact</a>
                      </li>

                      <li>
                        <a href="contact-1.html">Contact 1</a>
                      </li>

                      <li>
                        <a href="contact-2.html">Contact 2</a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item-has-children">
                    <a href="#">Shop<div class="icon-chevron-right text-11"></div></a>
                    <ul class="subnav">
                      <li class="menu__backButton js-nav-list-back">
                        <a href="#"><i class="icon-chevron-left text-13 mr-10"></i> Shop</a>
                      </li>

                      <li>
                        <a href="shop-cart.html">Shop Cart</a>
                      </li>

                      <li>
                        <a href="shop-checkout.html">Shop Checkout</a>
                      </li>

                      <li>
                        <a href="shop-list.html">Shop List</a>
                      </li>

                      <li>
                        <a href="shop-order.html">Shop Order</a>
                      </li>

                      <li>
                        <a href="shop-single.html">Shop Single</a>
                      </li>

                    </ul>
                  </li>


                  <li>
                    <a href="pricing.html">Membership plans</a>
                  </li>

                  <li>
                    <a href="404.html">404 Page</a>
                  </li>

                  <li>
                    <a href="terms.html">FAQs</a>
                  </li>

                  <li>
                    <a href="help-center.html">Help Center</a>
                  </li>

                  <li>
                    <a href="login.html">Login</a>
                  </li>

                  <li>
                    <a href="signup.html">Register</a>
                  </li>

                  <li>
                    <a href="ui-elements.html">UI Elements</a>
                  </li>

                </ul>
              </li>

              <li>
                <a data-barba href="contact-1.html">Contact</a>
              </li>
            </ul>
          </div>

          <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
            <div class="mobile-footer__number">
              <div class="text-17 fw-500 text-dark-1">Call us</div>
              <div class="text-17 fw-500 text-purple-1">800 388 80 90</div>
            </div>

            <div class="lh-2 mt-10">
              <div>329 Queensberry Street,<br> North Melbourne VIC 3051, Australia.</div>
              <div>hi@educrat.com</div>
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


      <div class="col-auto">
        <div class="header-right d-flex items-center">
          <div class="header-right__icons text-white d-flex items-center">

            <div class="">
              <button class="d-flex items-center text-white" data-el-toggle=".js-search-toggle">
                <i class="text-20 icon icon-search"></i>
              </button>

              <div class="toggle-element js-search-toggle">
                <div class="header-search pt-90 bg-white shadow-4">
                  <div class="container">
                    <div class="header-search__field">
                      <div class="icon icon-search text-dark-1"></div>
                      <input type="text" class="col-12 text-18 lh-12 text-dark-1 fw-500" placeholder="What do you want to learn?">

                      <button class="d-flex items-center justify-center size-40 rounded-full bg-purple-3" data-el-toggle=".js-search-toggle">
                        <img src="img/menus/close.svg" alt="icon">
                      </button>
                    </div>

                    <div class="header-search__content mt-30">
                      <div class="text-17 text-dark-1 fw-500">Popular Right Now</div>

                      <div class="d-flex y-gap-5 flex-column mt-20">
                        <a href="courses-single-1.html" class="text-dark-1">The Ultimate Drawing Course - Beginner to Advanced</a>
                        <a href="courses-single-2.html" class="text-dark-1">Character Art School: Complete Character Drawing Course</a>
                        <a href="courses-single-3.html" class="text-dark-1">Complete Blender Creator: Learn 3D Modelling for Beginners</a>
                        <a href="courses-single-4.html" class="text-dark-1">User Experience Design Essentials - Adobe XD UI UX Design</a>
                        <a href="courses-single-5.html" class="text-dark-1">Graphic Design Masterclass - Learn GREAT Design</a>
                        <a href="courses-single-6.html" class="text-dark-1">Adobe Photoshop CC – Essentials Training Course</a>
                      </div>

                      <div class="mt-30">
                        <button class="uppercase underline">PRESS ENTER TO SEE ALL SEARCH RESULTS</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="header-search__bg" data-el-toggle=".js-search-toggle"></div>
              </div>
            </div>


            <div class="relative ml-30 xl:ml-20">
              <button class="d-flex items-center text-dark-1" data-el-toggle=".js-cart-toggle">
                <i class="text-20 icon icon-basket"></i>
              </button>

              <div class="toggle-element js-cart-toggle">
                <div class="header-cart bg-white -dark-bg-dark-1 rounded-8">
                  <div class="px-30 pt-30 pb-10">

                    <div class="row justify-between x-gap-40 pb-20">
                      <div class="col">
                        <div class="row x-gap-10 y-gap-10">
                          <div class="col-auto">
                            <img src="img/menus/cart/1.png" alt="image">
                          </div>

                          <div class="col">
                            <div class="text-dark-1 lh-15">The Ultimate Drawing Course Beginner to Advanced...</div>

                            <div class="d-flex items-center mt-10">
                              <div class="lh-12 fw-500 line-through text-light-1 mr-10">$179</div>
                              <div class="text-18 lh-12 fw-500 text-dark-1">$79</div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-auto">
                        <button><img src="img/menus/close.svg" alt="icon"></button>
                      </div>
                    </div>

                    <div class="row justify-between x-gap-40 pb-20">
                      <div class="col">
                        <div class="row x-gap-10 y-gap-10">
                          <div class="col-auto">
                            <img src="img/menus/cart/2.png" alt="image">
                          </div>

                          <div class="col">
                            <div class="text-dark-1 lh-15">User Experience Design Essentials - Adobe XD UI UX...</div>

                            <div class="d-flex items-center mt-10">
                              <div class="lh-12 fw-500 line-through text-light-1 mr-10">$179</div>
                              <div class="text-18 lh-12 fw-500 text-dark-1">$79</div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-auto">
                        <button><img src="img/menus/close.svg" alt="icon"></button>
                      </div>
                    </div>

                  </div>

                  <div class="px-30 pt-20 pb-30 border-top-light">
                    <div class="d-flex justify-between">
                      <div class="text-18 lh-12 text-dark-1 fw-500">Total:</div>
                      <div class="text-18 lh-12 text-dark-1 fw-500">$659</div>
                    </div>

                    <div class="row x-gap-20 y-gap-10 pt-30">
                      <div class="col-sm-6">
                        <button class="button py-20 -dark-1 text-white -dark-button-white col-12">View Cart</button>
                      </div>
                      <div class="col-sm-6">
                        <button class="button py-20 -purple-1 text-white col-12">Checkout</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="d-none xl:d-block ml-20">
              <button class="text-white items-center" data-el-toggle=".js-mobile-menu-toggle">
                <i class="text-11 icon icon-mobile-menu"></i>
              </button>
            </div>

          </div>

          <div class="header-right__buttons d-flex items-center ml-30 md:d-none">
            <a href="login.html" class="button -underline text-white">Log in</a>
            <a href="signup.html" class="button -sm -white text-dark-1 ml-30">Sign up</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>

<div class="content-wrapper  js-content-wrapper">