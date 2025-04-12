<?php

session_start();



include_once "inc/config.php";
$order_id = $_GET['id'];
$pagetitle = "Order Details #" . $order_id;
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


  if ($status == 0) {
    $pay_status = "Payment Failed";
  } elseif ($status == 1) {
    $pay_status = "Payment Pending";
  } elseif ($status == 2) {
    $pay_status = "Payment Confirmed";
  } elseif ($status == 3) {
    $pay_status = "Processed";
  } elseif ($status == 4) {
    $pay_status = "Delivered";
  } else {
    $pay_status = "Could not retrieve status";
  }



  if ($paymentOption == '1') {
    $payment_mode = 'Flutterwave';
  } else if ($paymentOption == '2') {
    $payment_mode = 'Direct Transfer';
  } else if ($paymentOption == '3') {
    $payment_mode = 'Cash on Delivery';
  } else if ($paymentOption == '4') {
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
      <h2 class="text-30 lh-12 fw-700">kOrder ID: <span class="uppercase"> <?php echo "#" . $order_id ?></span> </h2>
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
            <div class="col-auto d-none" style="position: relative;">
              <div class="text-16 fw-500 text-dark-1 icon-outline py-10 d-non  order_update toggle-btn-<?php echo $order_id ?>">
                <!-- <i class="fa-solid fa-marker" style="padding:7px"></i> -->
                <i class="icon-menu-vertical" style="padding:20px;"></i>
              </div>


              <!-- <div class="toggle-element -dshb-more js-more-1-toggle-<?php echo $product_id ?>"> -->
              <div class="dropdown-main-content " id="dropdown-<?php echo $order_id ?>">
                <div class="px-25 py-25 bg-white -dark-bg-dark-2 shadow-1 border-light rounded-8">
                  <a data-toggle="modal" data-target="<?php echo '#share-' . $product_id ?>" class="d-flex items-center">
                    <div class="fa-regular fa-send"></div>
                    <div class="text-17 lh-1 fw-500 ml-12">Share</div>
                  </a>

                  <a href="<?php echo EDIT_PRODUCT . '?productid=' . $product_id ?>" class="d-flex items-center mt-20">
                    <div class="fa-regular fa-edit"></div>
                    <div class="text-17 lh-1 fw-500 ml-12">Edit</div>
                  </a>

                  <a href="<?php echo $image_path_thumbnail; ?>" class="d-none gallery__item js-gallery  d-flex items-center mt-20" data-gallery="<?php echo $product_id ?>">
                    <div class="fa-regular fa-eye"></div>
                    <div class="text-17 lh-1 fw-500 ml-12">Images</div>
                  </a>

                  <a href="#" class="toggle-availability d-flex items-center mt-20" data-product-id="<?php echo $product_id; ?>" data-status="<?php echo $availability; ?>">
                    <div class="fa-regular fa-eye"></div>
                    <div class="text-17 lh-1 fw-500 ml-12 " id="availability-text">
                      <?php echo $availability ? "Available" : "Unavailable"; ?>
                    </div>
                  </a>


                  <a data-toggle="modal" data-target="<?php echo '#delete-' . $product_id ?>" class="d-flex items-center mt-20 text-red-1">
                    <div class="fa-solid fa-trash-can"></div>
                    <div class="text-17 lh-1 fw-500 ml-12">Delete</div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-auto  dropdown">

              <button class="dropdown__button d-fle border-dark items-cente text-14 bg-white rounded-8 px-20 py- text-14" onclick="toggleDropdown()" data-order-id="<?php echo $order_id; ?>">
                <span id="dropdownTitle">Update<span class="lg:d-none">&nbsp;status</span></span>
                <i class="icon text-9 ml-40 icon-chevron-down"></i>
              </button>
              <div id="orderDropdown" class="dropdown__content py-10 px-10" style="display: none; min-width: 200px !important;">
                <a href="javascript:void(0);" onclick="updateOrderStatus('pending')" class="d-block">Payment Pending</a>
                <a href="javascript:void(0);" onclick="updateOrderStatus('paid')" class="d-block">Payment Confirmed</a>
                <a href="javascript:void(0);" onclick="updateOrderStatus('processed')" class="d-block">Order Processed</a>
                <a href="javascript:void(0);" onclick="updateOrderStatus('delivered')" class="d-block">Order Delivered</a>
                <a href="javascript:void(0);" onclick="updateOrderStatus('failed')" class="d-block">Payment Failed</a>

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
          $price = $row_orders['price'];
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

          // $price = $row['price'];

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
                      echo substr($producttitle, 0, 30) . '...';
                    } else {
                      echo $producttitle;
                    }
                    ?>
                  </div>
                  <div class="text-14 lh-11 mt-5">
                    <span class="price">
                      <?php echo $price; ?>
                    </span>
                    <span>
                      <?php echo ' (' . $yards . $numYards . ')'; ?>
                    </span>
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
      <div class="rounded-16 bg-white shadow-4 h- ">
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
                  <div class="lh-11 fw-500 text-dark-1" id="orderStatusText">
                    <?php echo $pay_status ?>
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

      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h- mt-20">
        <div class="py-20 px-30 border-bottom-light">
          <div class="row y-gap-20 justify-between">
            <div class="col-auto">
              <div class="lh-11 text-17 fw-700 text-dark-1">Order Status</div>
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

          <div id="paymentFailedStep" class="items-center" style="display: none;">
            <div class="d-flex justify-center items-center border-dark bg-red-1 rounded-full mr-10 px-2 py-2">
              <i class="size-12 text-white" data-feather="x"></i>
            </div>
            <p class="pt-15">Payment Failed</p>
          </div>


          <div class="d-flex items-center">
            <div id="step1" class="<?php if ($status > 0 && $status != 0) {
                                      echo "bg-deep-green-1 text-white ";
                                    } ?>d-flex justify-center items-center icon-outline rounded-full mr-10 px-2 py-2">
              <i class="size-12" data-feather="check"></i>
            </div>
            <p class="pt-15">Payment Pending</p>
          </div>

          <div class="d-flex items-center">
            <div id="step2" class="<?php if ($status > 1 && $status != 0) {
                                      echo "bg-deep-green-1 text-white ";
                                    } ?>d-flex justify-center items-center icon-outline rounded-full mr-10 px-2 py-2">
              <i class="size-12" data-feather="check"></i>
            </div>
            <p class="pt-15">Payment Confirmed</p>
          </div>

          <div class="d-flex items-center">
            <div id="step3" class="<?php if ($status > 2 && $status != 0) {
                                      echo "bg-deep-green-1 text-white ";
                                    } ?>d-flex justify-center items-center icon-outline rounded-full mr-10 px-2 py-2">
              <i class="size-12" data-feather="check"></i>
            </div>
            <p class="pt-15">Order Processed</p>
          </div>

          <div class="d-flex items-center">
            <div id="step4" class="<?php if ($status > 3 && $status != 0) {
                                      echo "bg-deep-green-1 text-white ";
                                    } ?>d-flex justify-center items-center icon-outline rounded-full mr-10 px-2 py-2">
              <i class="size-12" data-feather="check"></i>
            </div>
            <p class="pt-15">Order Delivered</p>
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


<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>