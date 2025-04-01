<?php 
    session_start();
    include_once "../inc/config.php";
    $pagetitle = "Dashboard";
    include_once "../inc/drc.php"; 
    if(!isset($_SESSION['user_id'])){
        header("location: ".ADMIN_LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
        exit; // Make sure to exit after sending the redirection header
    }else{
      $user_id = $_SESSION['user_id'];
    }
    include_once "ad_comp/adm-head.php"; 
    include_once "ad_comp/adm-header.php"; 
    // include_once "../inc/drc.php"; 
    $sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
    $row = mysqli_fetch_assoc($sql);
    // $user_id = $row["user_id"];
    $instructor = $row["instructor"];
    $admin = $row["admin"];
    $products_sql = mysqli_query($conn, "SELECT * FROM products ");
    $count_row_product = mysqli_num_rows($products_sql);
    $categories_sql = mysqli_query($conn, "SELECT * FROM olnee_categories");
    $count_row_categories = mysqli_num_rows($categories_sql);
    $total_amount = 0;
    $orders_sql = mysqli_query($conn, "SELECT * FROM olnee_orders");
    $count_row_orders = mysqli_num_rows($orders_sql);
    while ($row_orders = mysqli_fetch_assoc($orders_sql)) {
      $order_amount = $row_orders['total'];
      // Add the value to the total amount
      $total_amount += $order_amount;
    }
    $total_amount = '&#8358;'.number_format($total_amount,2);
?>
    <?php include_once "ad_comp/adm-sidebar.php" ?>
      <div class="dashboard__content bg-light-4">
        <div class="row pb-30 mb-10">
          <div class="col-auto">
            <h1 class="text-30 lh-12 fw-700">Dashboard</h1>
            <div class="breadcrumbs mt-10 pt-0 pb-0">
              <div class="breadcrumbs__content">
                <div class="breadcrumbs__item">
                  <a href="index.html">Home</a>
                </div>
                <div class="breadcrumbs__item">
                  <a href="<?php DASHBOARD ?>">Dashboard</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row y-gap-5" style="--bs-gutter-x:15px !important;">
          <div class="col-xl-3 col-md-6">
            <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
              <div>
              <!-- <div class="text-24 lh-1 fw-700 text-dark-1">$10,800</div> -->
              <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $total_amount; ?></div>
              <div class="lh-1 fw-500 mt-10">Total Sales</div>
                <!-- <div class="lh-1 mt-25"><span class="text-deep-green-1">$50</span> New Sales</div> -->
              </div>
              <!-- <i class="text-40 fa fa-box text-deep-green-1"></i> -->
              <span class="material-symbols-outlined text-30 text-deep-green-1">account_balance_wallet</span>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
              <div>
              <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $count_row_product ?></div>
                <div class="lh-1 fw-500 mt-10">Total Products</div>
                <!-- <div class="lh-1 mt-25"><span class="text-deep-green-1">40+</span> New Courses</div> -->
              </div>
              <i class="text-40 fa fa-box text-deep-green-1"></i>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
              <div>
              <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $count_row_orders ?></div>
                <div class="lh-1 fw-500 mt-10">Total Orders</div>
                <!-- <div class="lh-1 mt-25"><span class="text-deep-green-1">90+</span> New Students</div> -->
              </div>
              <i class="text-40 fa fa-box text-deep-green-1"></i>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
              <div>
              <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $count_row_categories ?></div>
                <!-- <div class="lh-1 mt-25"><span class="text-deep-green-1">290+</span> Instructors</div> -->
                <div class="lh-1 fw-500 mt-10">Total Categories</div>
              </div>
              <i class="text-40 fa fa-box text-deep-green-1"></i>
            </div>
          </div>
        </div>
        <div class="row y-gap-15 pt-10" style="--bs-gutter-x:15px !important;">
          <div class="col-xl-8 col-md-6">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Orders</h2>
                <div class="">
                  <div class="dropdown js-dropdown js-category-active">
                    <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-1 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                      <span class="js-dropdown-title">This Week</span>
                      <i class="icon text-9 ml-40 icon-chevron-down"></i>
                    </div>
                    <div class="toggle-element -dropdown -dark-bg-dark-2 -dark-border-white-10 js-click-dropdown js-category-toggle">
                      <div class="text-14 y-gap-15 js-dropdown-list">
                        <div><a href="#" class="d-block js-dropdown-link">Animation</a></div>
                        <div><a href="#" class="d-block js-dropdown-link">Design</a></div>
                        <div><a href="#" class="d-block js-dropdown-link">Illustration</a></div>
                        <div><a href="#" class="d-block js-dropdown-link">Business</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="py-40 px-30">
                <!-- <canvas id="lineChart"></canvas> -->
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Traffic</h2>
                <div class="">
                  <div class="dropdown js-dropdown js-category-active">
                    <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-1 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                      <span class="js-dropdown-title">This Week</span>
                      <i class="icon text-9 ml-40 icon-chevron-down"></i>
                    </div>
                    <div class="toggle-element -dropdown -dark-bg-dark-2 -dark-border-white-10 js-click-dropdown js-category-toggle">
                      <div class="text-14 y-gap-15 js-dropdown-list">
                        <div><a href="#" class="d-block js-dropdown-link">Animation</a></div>
                        <div><a href="#" class="d-block js-dropdown-link">Design</a></div>
                        <div><a href="#" class="d-block js-dropdown-link">Illustration</a></div>
                        <div><a href="#" class="d-block js-dropdown-link">Business</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="py-40 px-30">
                <!-- <canvas id="pieChart"></canvas> -->
              </div>
            </div>
          </div>
        </div>
        <div class="row y-gap-15 pt-10" style="--bs-gutter-x:15px !important;">
          <div class="col-xl-6 col-md-6">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 fw-500">Popular Products</h2>
                <a href="instructors-list-2.html" class="text-14 text-deep-green-1 underline">View All</a>
              </div>
              <div class="py-30 px-30">
                <div class="y-gap-40">
                  <div class="d-flex border-top-light">
                    <img class="size-40" src="assets/img/dashboard/avatars/2.png" alt="avatar">
                    <div class="ml-10 w-1/1">
                      <h4 class="text-15 lh-1 fw-500">Albert Flores</h4>
                      <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                        <div class="d-flex items-center">
                          <i class="icon-message text-15 mr-10"></i>
                          <div class="text-13 lh-1">23,987 Reviews</div>
                        </div>
                        <div class="d-flex items-center">
                          <i class="icon-online-learning text-15 mr-10"></i>
                          <div class="text-13 lh-1">692 Students</div>
                        </div>
                        <div class="d-flex items-center">
                          <i class="icon-play text-15 mr-10"></i>
                          <div class="text-13 lh-1">15 Course</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-6 d-non">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Notifications</h2>
              </div>
              <div class="py-30 px-30">
                <div class="y-gap-40">
                  <div class="d-flex items-center border-top-light">
                    <div class="shrink-0">
                      <img src="assets/img/dashboard/actions/2.png" alt="image">
                    </div>
                    <div class="ml-12">
                      <h4 class="text-15 lh-1 fw-500">You changed password</h4>
                      <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php 
    include_once "ad_comp/adm-footer.php"; 
    include_once "ad_comp/adm-tail.php"; 
?>