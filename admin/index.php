<?php
session_start();
include_once "inc/config.php";
$pagetitle = "Dashboard";
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
$products_sql = mysqli_query($conn, "SELECT * FROM products ");
$count_row_product = mysqli_num_rows($products_sql);
$categories_sql = mysqli_query($conn, "SELECT * FROM olnee_categories");
$count_row_categories = mysqli_num_rows($categories_sql);

$orders_sql = mysqli_query($conn, "SELECT * FROM olnee_orders");
$count_row_orders = mysqli_num_rows($orders_sql);

$total_amount = 0;
$orders_sql_success = mysqli_query($conn, "SELECT * FROM olnee_orders WHERE status = 'Successful'");
while ($row_orders = mysqli_fetch_assoc($orders_sql_success)) {
  $order_amount = $row_orders['total'];
  // Add the value to the total amount
  $total_amount += $order_amount;
}
// $total_amount = '&#8358;' . number_format($total_amount, 2);
?>
<?php include_once "ad_comp/adm-sidebar.php" ?>
<div class="dashboard__content bg-light-4">
  <div class="row pb-30 mb-10">
    <div class="col-auto">
      <h2 class="text-30 lh-12 fw-700">Dashboard</h2>
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
  <div class="row y-gap-5" style="--bs-gutter-x:5px !important;">
    <div class="col-6 col-xl-3">
      <div class="d-flex justify-between items-center py-35 px-35 lg:py-20 lg:px-20 rounded-8 bg-white -dark-bg-dark-1 shadow-4">
        <div>
          <div class="text-24 lh-1 fw-700 text-dark-1 price"><?php echo $total_amount; ?></div>
          <div class="lh-1 mt-10 ">
            <span class="lg:d-none">Total </span>Sales
          </div>
        </div>
        <img src="assets/img/icons/wallet.png" alt="" width="20%">
      </div>
    </div>
    <div class="col-6 col-xl-3">
      <div class="d-flex justify-between items-center py-35 px-35 lg:py-20 lg:px-20 rounded-8 bg-white -dark-bg-dark-1 shadow-4">
        <div>
          <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $count_row_product ?></div>
          <div class="lh-1 mt-10 ">
            <span class="lg:d-none">Total </span>Products
          </div>
        </div>
        <img src="assets/img/icons/inventory.png" alt="" width="20%">
      </div>
    </div>
    <div class="col-6 col-xl-3">
      <div class="d-flex justify-between items-center py-35 px-35 lg:py-20 lg:px-20 rounded-8 bg-white -dark-bg-dark-1 shadow-4">
        <div>
          <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $count_row_orders ?></div>
          <div class="lh-1 mt-10 ">
            <span class="lg:d-none">Total </span>Orders
          </div>
        </div>
        <img src="assets/img/icons/orders.png" alt="" width="20%">
      </div>
    </div>
    <!-- <div class="col-xl-3 col-md-6"> -->
    <div class="col-6 col-xl-3">
      <div class="d-flex justify-between items-center py-35 px-35 lg:py-20 lg:px-20 rounded-8 bg-white -dark-bg-dark-1 shadow-4">
        <div>
          <div class="text-24 lh-1 fw-700 text-dark-1"><?php echo $count_row_categories ?></div>
          <div class="lh-1 mt-10 ">
            <span class="lg:d-none">Total </span>Categories
          </div>
        </div>
        <img src="assets/img/icons/category.png" alt="" width="20%">
      </div>
    </div>
  </div>
  <div class="row y-gap-15 pt-5" style="--bs-gutter-x:5px !important;">
    <div class="col-xl-12 col-md-12">
      <div class="rounded-8 bg-white -dark-bg-dark-1 shadow-4 h-100">
        <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
          <h2 class="text-24 lh-1 fw-600">Orders</h2>
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
        <div class="py-10 px-30 table-responsive">
          <table class="table w-100">
            <thead>
              <tr>
                <!-- <th>Order Date</th> -->
                <th>Order ID</th>
                <th>Customer Name</th>

                <th>Payment Status</th>
                <th>Payment Total</th>
              </tr>
            </thead>
            <tbody id="">
              <?php
              $orders = mysqli_query($conn, "SELECT * FROM olnee_orders");
              $count_row_orders = mysqli_num_rows($orders);
              if ($count_row_coupon != 0) {



                while ($row_orders = mysqli_fetch_assoc($orders)) {
                  $orders_id = $row_orders['order_id'];
                  $firstname = $row_orders['first_name'];
                  $lastname = $row_orders['last_name'];
                  $cus_name = $firstname . " " . $lastname;
                  $cus_email = $row_orders['email'];
                  $cus_phone = $row_orders['phone'];
                  $pay_status = $row_orders['status'];
                  $pay_total = $row_orders['total'];
                  $pay_total = '&#8358;' . number_format($pay_total, 2);
                  $pay_shipping = $row_orders['shipping'];
                  $cus_country = $row_orders['country'];
                  $cus_state = $row_orders['state'];
                  $cus_city = $row_orders['city'];
                  $cus_street = $row_orders['street'];

                  $cus_address = $cus_street . ", " . $cus_city . ", " . $cus_state . ", " . $cus_country;

                  $cus_date = $row_orders['created_at'];
                  $date = strtotime($cus_date);

                  $cus_notes = $row_orders['notes'];

                  if ($cus_notes == "") {
                    $cus_notes = "No notes added!";
                  } else {
                    $cus_notes;
                  }


              ?>
                  <tr>
                    <!-- <td><?php echo date(' jS F, Y', $date) ?></td> -->
                    <td class="underline"><a href="<?php echo ORDER_DETAILS . $orders_id ?>"><?php echo $orders_id ?></a></td>
                    <td><?php echo $cus_name ?></td>
                    <td><?php echo $pay_status ?></td>
                    <td><?php echo $pay_total ?></td>
                    <!-- <td><?php echo $cus_phone ?></td>
                      <td><?php echo $cus_address ?></td>
                      <td><?php echo $cus_notes ?></td> -->
                  </tr>

                <?php
                }
              } else {
                // echo "No Coupon codes";
                ?>
                <tr class="layout-pt-lg layout-pb-lg section-bg mt-30 empty">
                  <div class="section-bg__item bg-light-6"></div>
                  <td colspan="6" class="container desction">
                    <div class="row py-30 px-30 bg-light-4 rounded-8 border-light  justify-center text-center">
                      <!-- <div class="row y-gap-20 justify-center text-center"> -->
                      <!-- <div class="col-auto mt-10 justify-center"> -->
                      <img class="mb-20" src="assets/img/store.png" style="width:15%">
                      <div class="sectionTitle ">
                        <h2 class="sectionTitle__title ">
                          No Orders yet!
                        </h2>
                        <p class="sectionTitle__text h4 pt-5">
                          When you have orders, they will appear here.
                        </p>
                      </div>
                      <!-- </div> -->
                    </div>
                  </td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
          <!-- <canvas id="lineChart"></canvas> -->
        </div>
      </div>
    </div>

  </div>

</div>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>