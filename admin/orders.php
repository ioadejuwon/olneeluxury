<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>

<?php
session_start();


include_once "inc/config.php";
$pagetitle = "Orders";
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
// $user_id = $row["user_id"];  
$fname = $row['fname'];


include_once "ad_comp/adm-sidebar.php"
?>


<div class="dashboard__content bg-light-4">
  <div class="row pb- mb-10">
    <div class="col-auto">
      <h1 class="text-30 lh-12 fw-700">Orders</h1>
      <div class="breadcrumbs mt-10 pt-0 pb-0">
        <div class="breadcrumbs__content">
          <div class="breadcrumbs__item">
            Manage your Orders here
          </div>
        </div>
      </div>
    </div>
  </div>





  <div class="row y-gap-30 pt-30">
    <div class="col-xl-12 col-md-12">
      <div class="rounded-16 text-white shadow-4 h-100">
        <!-- <div class="text-18 lh-1 text-dark-1 fw-500 mb-30">Table</div> -->
        <div class="table-responsive">
          <table class="table w-100">
            <thead>
              <tr>
                
                <th>Order ID</th>
                <th>Customer Name</th>
                <!-- <th>Customer Email</th> -->
                <th>Payment Status</th>
                <th>Payment Total</th>
                <th>Order Date</th>
              </tr>
            </thead>
            <tbody id="">
              <?php
              $orders = mysqli_query($conn, "SELECT * FROM olnee_orders");
              $count_row_orders = mysqli_num_rows($orders);
              if ($count_row_orders != 0) {



                while ($row_orders = mysqli_fetch_assoc($orders)) {
                  $orders_id = $row_orders['order_id'];
                  $firstname = $row_orders['first_name'];
                  $lastname = $row_orders['last_name'];
                  $cus_name = $firstname . " " . $lastname;
                  $cus_email = $row_orders['email'];
                  $cus_phone = $row_orders['phone'];
                  $pay_status = $row_orders['status'];
                  $pay_total = $row_orders['total'];
                  // $pay_total = '&#8358;' . number_format($pay_total, 2);
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
                    
                    <td class="underline"><a href="<?php echo ORDER_DETAILS . $orders_id ?>"><?php echo $orders_id ?></a></td>
                    <td><?php echo $cus_name ?></td>
                    <!-- <td><?php echo $cus_email ?></td> -->
                    <td><?php echo $pay_status ?></td>
                    <td class="price"><?php echo $pay_total ?></td>
                    <td><?php echo date('jS F', $date) ?></td>
                    <!-- <td><?php echo $cus_phone ?></td>
                      <td><?php echo $cus_address ?></td>
                      <td><?php echo $cus_notes ?></td> -->
                  </tr>

                <?php
                }
              } else {
                // echo "No Coupon codes";
                ?>
                <tr class="col-md-12 text-center">
                  <td colspan="6" class="p-0">
                    <div class="py-30 px-30 bg-light-4 rounded-8 border-light col-md-12 move-center">
                      <img src="assets/img/store.png" style="width:20%">
                      <h3 class=" text- fw-500 mt-20">
                        No Orders yet!
                      </h3>
                      <p class="pt-10 mb-20">
                        When you have orders, they will appear here.
                      </p>
                      <div class="col-md-6 move-center">
                        <!-- <a href="" class="button -md -deep-green-1 text-white p-0">Add coupon</a> -->
                      </div>
                    </div>
                  </td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>




</div>






<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>