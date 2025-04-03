<?php
session_start();


include_once "inc/config.php";
$order_id = $_GET['id'];
$pagetitle = "Order Details #".$order_id;
include_once "inc/drc.php";



if (!isset($_SESSION['user_id'])) {
  header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
  exit; // Make sure to exit after sending the redirection header
} else {
  $user_id = $_SESSION['user_id'];
}


$orders_sql = mysqli_query($conn, "SELECT * FROM olnee_orders WHERE order_id = '$order_id'");
$count_row_orders = mysqli_num_rows($orders_sql);
if ($count_row_orders < 1) {
  header("location: " . ORDERS);
} else {
  $order_row = mysqli_fetch_assoc($orders_sql);

  $firstname = $order_row["first_name"];
  $lastname = $order_row["last_name"];
  $customer = $firstname . " " . $lastname;
  $email = $order_row["email"];

  $phone = $order_row["phone"];

  $street = $order_row["street"];
  $city = $order_row["city"];
  $state = $order_row["state"];
  $notes = $order_row["notes"];
  $country = $order_row["country"];

  $cus_address = $street . ", " . $city . ", " . $state . ", " . $country;

  $subtotal = $order_row["subtotal"];
  $discount = $order_row["discount"];
  $shipping = $order_row["shipping"];
  $total = $order_row["total"];
  $paymentOption  =  $order_row["paymentOption"];
  $status = $order_row["status"];
  $ord_date = $order_row["created_at"];
  $date = strtotime($ord_date);

  $order_date =  date('D, jS F, Y', $date);


  if ($paymentOption == '1') {
    $payment_mode = 'Flutterwave';
  }else if ($paymentOption == '2') {
    $payment_mode = 'Direct Transfer';
  }else if ($paymentOption == '3') {
    $payment_mode = 'Cash on Delivery';
  }else if ($paymentOption == '4') {
    $payment_mode = 'WhatsApp Order';
  }

}



include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";



$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$user_id}'");
$row = mysqli_fetch_assoc($sql);
// $user_id = $row["user_id"];




include_once "ad_comp/adm-sidebar.php"
?>


<div class="dashboard__content bg-light-4">
  <div class="row pb- mb-10">
    <div class="col-auto">
      <h2 class="text-30 lh-12 fw-700">Order ID: <span class="uppercase"> <?php echo "#" . $order_id ?></span> </h2>
      <div class="mt-5">You can manage this order here.</div>
    </div>
  </div>



  <div class="row y-gap-30">
    <div class="col-xl-7">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100 parent">
        <div class="py-20 px-30 border-bottom-light child">
          <div class="row y-gap-20 justify-between">
            <div class="col-auto">
              <div class="text-17 lh-1 fw-700 text-dark-1">Order Items</div>
              <div class="text-11 lh-1 mt-5 uppercase text-dark-1">#<?php echo $order_id ?></div>
            </div>
            <div class="col-auto d-none">
              <div class="text-16 fw-500 text-dark-1 img-outline" data-toggle="modal" data-target="#editorder">
                <i class="fa-solid fa-marker" style="padding:7px"></i>
              </div>
            </div>
          </div>
        </div>


        <?php
        $totalPrice = 0;
        $products_orders = mysqli_query($conn, "SELECT * FROM olnee_order_items WHERE order_id = '$order_id'");
        while ($row_orders = mysqli_fetch_assoc($products_orders)) {
          // Get the thumbnail image
          $product_id = $row_orders['product_id'];
          $yards = $row_orders['yards'];
          if ($yards > 1) {
            $numYards = ' yards';
          } else {
            $numYards = ' yard';
          }

          $productquery = "SELECT * FROM products WHERE productid = ?";
          $stmt = mysqli_prepare($conn, $productquery);
          mysqli_stmt_bind_param($stmt, "s",  $product_id); // Bind the parameter
          mysqli_stmt_execute($stmt); // Execute the prepared statement
          $result = mysqli_stmt_get_result($stmt); // Get the result
          $count_row_products = $result->num_rows;
          $row = $result->fetch_assoc();
          $producttitle = $row['producttitle'];

          $price = $row['price'];

          $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
          $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
          // $image_path_thumbnail =  $row_prod_img_thumbnail['image_path'];
          $image_path_thumbnail =  $row_prod_img_thumbnail['image_path'];
        ?>
          <div class="py-30 px-30 child">
            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="size-50 rounded-8 brand-pic-display" style="background-image: url('<?php echo $image_path_thumbnail ?>'); "></div>
                <div class="ml-10">
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php
                    // echo $product_name; 
                    if (strlen($producttitle) > 30) {
                      echo substr($producttitle, 0, 30) . '...' . ' (' . $yards . $numYards . ')';
                    } else {
                      echo $producttitle . ' (' . $yards . $numYards . ')';
                    }
                    ?>
                  </div>
                  <div class="text-14 lh-11 mt-5 price">
                    <?php echo $price; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <div class="border-top-light child">
          <div class="py-30 px-30 ">
            <div class=" ">
              <div class="d-flex justify-between">
                <div class="d-flex items-center">
                  <div class="ml-">
                    <div class="text-16 fw-700 lh-11 mb-5 text-dark-1">Order Summary</div>
                  </div>
                </div>
              </div>
              <div class="row y-gap-20 justify-between">
                <div class="col-6">
                  <p class="text-14 lh-13 mt-5 uppercase mb-0">Subtotal</p>
                  <div class="text-16 fw-500 text-dark-1 price">
                    <?php echo $subtotal; ?>
                  </div>
                </div>
                <div class="col-6">
                  <p class="text-14 lh-13 mt-5 uppercase mb-0">Discount</p>
                  <div class="text-16 fw-500 text-dark-1 price">
                    <?php echo $discount; ?>
                  </div>
                </div>
                <div class="col-6">
                  <p class="text-14 lh-13 mt-5 uppercase mb-0">Shipping</p>
                  <div class="text-16 fw-500 text-dark-1 price">
                    <?php echo $shipping; ?>
                  </div>
                </div>
                <div class="col-6">
                  <p class="text-14 lh-13 mt-5 uppercase mb-0">Total Paid</p>
                  <div class="text-16 fw-500 text-dark-1 price">
                    <?php echo $total; ?>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xl-5">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
        <div class="py-20 px-30 border-bottom-light">
          <div class="row y-gap-20 justify-between">
            <div class="col-auto">
              <div class="lh-11 text-17 fw-700 text-dark-1">Customer Information</div>
              <div class="text-11 lh-11 mt-5 uppercase">#<?php echo $order_id ?></div>
            </div>
            <div class="col-auto d-none">
              <div class="text-16 fw-500 text-dark-1 img-outline" data-toggle="modal" data-target="#editorder">
                <i class="fa-solid fa-marker" style="padding:7px"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="py-30 px-30">
          <div class="y-gap-20">
            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Customer Name</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $customer ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Phone</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $phone ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Email Address</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $email ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Delivery Address</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $cus_address ?>
                  </div>

                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Payment Mode</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $payment_mode ?>
                  </div>

                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Payment Status</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $status ?>
                  </div>

                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-">
                  <div class="text-14 lh-11 mb-5">Order Date</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $order_date ?>
                  </div>

                </div>
              </div>
            </div>

            <div class="d-none">
              <div class="d-flex justify-between border-top-dark mt-15">
                <div class="d-flex items-center">
                  <div class="ml-10">
                    <div class="text-16 fw-700 lh-11 mb-5 text-dark-1">Order Summary</div>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-between border-top-dark px-10">
                <div class="py-1 fw-500">Subtotal</div>
                <div class="py-1 fw-600 text-dark-1 price"><?php echo $subtotal ?></div>
              </div>
              <div class="d-flex justify-between border-top-dark px-10">
                <div class="py-1 fw-500">Discount</div>
                <div class="py-1 fw-600 text-dark-1 price"><?php echo $discount ?></div>
              </div>
              <div class="d-flex justify-between border-top-dark px-10">
                <div class="py-1 fw-500 text-dark-1">Shipping</div>
                <div class="py-1 fw-600 text-dark-1 price"><?php echo $shipping ?></div>
              </div>
              <div class="d-flex justify-between border-top-dark px-10">
                <div class="py-1 fw-500 text-dark-1">Total</div>
                <div class="py-1 fw-600 text-dark-1 price"><?php echo $total ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal_title" id="exampleModalLabel">
              Edit Order
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa-regular fa-circle-xmark text-20"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="d-flex x-gap-20 y-gap-20 items-center flex-wrap">
              <div>
                <div class=" bg-deep-green-1 cart-btn">
                  <i class="fa-solid fa-location-dot"></i>
                </div>
              </div>
              <div class="">
                <p class="mt-5">Business Location</p>
                <h5 class="text-17 lh-14 fw-500"><?php echo $location . ", <br>" . $country ?></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editocrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal_title" id="exampleModalLabel">
              Order Timeline
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa-regular fa-circle-xmark text-20"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="row x-gap-100 justfiy-between">
              <div class="col-md-12">
                <div class="y-gap-20">
                  <div class="d-flex items-center">
                    <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check size-12">
                        <polyline points="20 6 9 17 4 12"></polyline>
                      </svg>
                    </div>
                    <p>Create quick wireframes.</p>
                  </div>
                  <div class="d-flex items-center">
                    <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check size-12">
                        <polyline points="20 6 9 17 4 12"></polyline>
                      </svg>
                    </div>
                    <p>Downloadable exercise files</p>
                  </div>
                  <div class="d-flex items-center">
                    <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check size-12">
                        <polyline points="20 6 9 17 4 12"></polyline>
                      </svg>
                    </div>
                    <p>Build a UX project from beginning to end.</p>
                  </div>
                  <div class="d-flex items-center">
                    <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check size-12">
                        <polyline points="20 6 9 17 4 12"></polyline>
                      </svg>
                    </div>
                    <p>Learn to design websites &amp; mobile phone apps.</p>
                  </div>
                  <div class="d-flex items-center">
                    <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check size-12">
                        <polyline points="20 6 9 17 4 12"></polyline>
                      </svg>
                    </div>
                    <p>All the techniques used by UX professionals</p>
                  </div>
                  <div class="d-flex items-center">
                    <div class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check size-12">
                        <polyline points="20 6 9 17 4 12"></polyline>
                      </svg>
                    </div>
                    <p>You will be able to talk correctly with other UX design.</p>
                  </div>
                </div>
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