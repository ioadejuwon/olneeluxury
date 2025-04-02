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
$order_id = $_GET['id'];

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
  $date = $order_row["crrated_at"];
}



include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";



$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$user_id}'");
$row = mysqli_fetch_assoc($sql);
// $user_id = $row["user_id"];




$products_sql = mysqli_query($conn, "SELECT * FROM products ");
$count_row_product = mysqli_num_rows($products_sql);

$categories_sql = mysqli_query($conn, "SELECT * FROM olnee_categories");
$count_row_categories = mysqli_num_rows($categories_sql);


// $total_amount = 0;

// while ($row_orders = mysqli_fetch_assoc($orders_sql)) {

//   $order_amount = $row_orders['total'];
//   // Add the value to the total amount
//   $total_amount += $order_amount;

// }
// $total_amount = '&#8358;'.number_format($total_amount,2);




include_once "ad_comp/adm-sidebar.php"
?>


<div class="dashboard__content bg-light-4">
  <div class="row pb- mb-10">
    <div class="col-auto">

      <h1 class="text-30 lh-12 fw-700">Order ID: <span class="uppercase"> <?php echo "#" . $order_id ?></span> </h1>
      <div class="mt-10">You can manage this order here.</div>

    </div>
  </div>


  <div class="row y-gap-30">
    <div class="col-xl-4">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
        <div class="d-flex items-center py-20 px-30 border-bottom-light">
          <h2 class="text-17 lh-1 fw-700">Customer Information</h2>
        </div>

        <div class="py-30 px-30">
          <div class="y-gap-30">

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-10">
                  <div class="text-14 lh-11 mb-5">Customer Name</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $customer ?>
                  </div>

                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-10">
                  <div class="text-14 lh-11 mb-5">Phone</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $phone ?>
                  </div>

                </div>
              </div>
            </div>

            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-10">
                  <div class="text-14 lh-11 mb-5">Email Address</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $email ?>
                  </div>

                </div>
              </div>
            </div>


            <div class="d-flex justify-between">
              <div class="d-flex items-center">
                <div class="ml-10">
                  <div class="text-14 lh-11 mb-5">Delivery Address</div>
                  <div class="lh-11 fw-500 text-dark-1">
                    <?php echo $cus_address ?>
                  </div>

                </div>
              </div>
            </div>

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
              <div class="py-1 fw-600 text-dark-1 price">-<?php echo $discount ?></div>
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

    <div class="col-xl-8">
      <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
        <div class="d-flex items-center justify-between py-20 px-30 border-bottom-light">
          <div class="d-flex items-center">

            <div class="d-flex items-center ">
              <h2 class="text-17 lh-1 fw-700">Order Items Information</h2>
            </div>
          </div>

          <a href="#" class="text-14 lh-11 fw-500 text-orange-1 underline">Delete Conversation</a>
        </div>


        <?php
        // $totalPrice = 0;
        // $products_orders = mysqli_query($conn, "SELECT * FROM olnee_order_items WHERE order_id = '$order_id'");
        // while ($row_orders = mysqli_fetch_assoc($products_orders)) {
        //   // Get the thumbnail image
        //   $product_id = $row_orders['product_id'];
        //   $yards = $row_orders['yards'];

        //   $productquery = "SELECT * FROM products WHERE productid = ?";
        //   $stmt = mysqli_prepare($conn, $productquery);
        //   mysqli_stmt_bind_param($stmt, "s",  $product_id); // Bind the parameter
        //   mysqli_stmt_execute($stmt); // Execute the prepared statement
        //   $result = mysqli_stmt_get_result($stmt); // Get the result
        //   $count_row_products = $result->num_rows;
        //   $row = $result->fetch_assoc();
        //   $producttitle = $row['producttitle'];


        //   $prod_id = $row['prod_id'];
        //   $imgalt = $row['prod_id'];
        //   $tag = $row['ptag'];
        //   $quantity = $row_orders['pqty'];
        //   $pdes = $row['pdes'];
        //   $ppricedis = $row['ppricedis'];
        //   $price = $row['price'];
        //   $categoryid = $row['category'];
        //   $original_price = '&#8358;' . number_format($pprice);
        //   $discounted_price = '&#8358;' . number_format($ppricedis);
        //   $totalPrice += $pprice;
        //   $total_price = '&#8358;' . number_format($totalPrice, 2);

        //   $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE productid = '$product_id' AND thumbnail = 1");
        //   $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
        //   // $image_path_thumbnail = IMAGE_URL . $row_prod_img_thumbnail['img'];
        // ?>

        //   <div class="d-flex justify-between">
        //     <div class="d-flex items-center">
        //       <div class="size-50 rounded-16 brand-pic-display" style="background-image: url('<?php echo $image_path_thumbnail ?>'); "></div>
        //       <div class="ml-10">
        //         <div class="lh-11 fw-500 text-dark-1">
        //           <?php
        //           // echo $product_name; 
        //           if (strlen($ptitle) > 20) {
        //             echo substr($producttitle, 0, 20) . '...' . ' (' . $yards . ' yards)';
        //           } else {
        //             echo $producttitle . ' (' . $yards . ' yards)';
        //           }
        //           ?>
        //         </div>
        //         <div class="text-14 lh-11 mt-5">
        //           <?php echo $price; ?>
        //         </div>
        //       </div>
        //     </div>
        //     <!-- <div class="d-flex items-end flex-column pt-8">
				// 											<div class="text-13 lh-1">35 mins</div>
				// 											<div class="d-flex justify-center items-center size-20 bg-blue-3 rounded-full mt-8">
				// 												<span class="text-11 lh-1 text-white fw-500">5</span>
				// 											</div>
				// 										</div> -->
        //   </div>

        // <?php
        // }
        ?>

        <div class="py-25 px-40 border-top-light">
          <div class="row y-gap-10 justify-between">
            <div class="col-lg-7">
              <input class="-dark-bg-dark-1 py-20 w-1/1" type="text" placeholder="Type a Message">
            </div>
            <div class="col-auto">
              <button class="button -md -purple-1 text-white shrink-0">Send Message</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row y-gap-30">
    <div class="col-12">
      <div class="rounded-16 h-100">
        <div class="row y-gap-30 x-gap-20 pt-">
          <div class="col-xl-4 col-12">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h0">
              <div class="py-20 px-30 border-bottom-light">
                <div class="row y-gap-20 justify-between">
                  <div class="col-auto">
                    <div class="lh-11 text-17 fw-500 text-dark-1">Order Information</div>
                    <div class="text-14 lh-11 mt-5 uppercase">#<?php echo $order_id ?></div>
                  </div>
                  <div class="col-auto ">
                    <div class="text-16 fw-500 text-dark-1 img-outline" data-toggle="modal" data-target="#editorder">
                      <i class="fa-solid fa-marker" style="padding:7px"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="py-30 px-30">
                <div class="y-gap-30">
                  <?php
                  $totalPrice = 0;
                  while ($row_orders = mysqli_fetch_assoc($products_orders)) {
                    // Get the thumbnail image
                    $prod_id = $row_orders['prod_id'];
                    $productquery = "SELECT * FROM prodcatalogue JOIN merchants ON prodcatalogue.unique_id = merchants.unique_id WHERE prodcatalogue.unique_id = ? AND prodcatalogue.prod_id = ? ORDER BY prodcatalogue.created_at DESC";
                    $stmt = mysqli_prepare($conn, $productquery);
                    mysqli_stmt_bind_param($stmt, "ss", $unique_id, $prod_id); // Bind the parameter
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    $result = mysqli_stmt_get_result($stmt); // Get the result
                    $count_row_products = $result->num_rows;
                    $row = $result->fetch_assoc();
                    $ptitle = $row['ptitle'];
                    $email = $row['email'];

                    $prod_id = $row['prod_id'];
                    $imgalt = $row['prod_id'];
                    $tag = $row['ptag'];
                    $quantity = $row_orders['pqty'];
                    $pdes = $row['pdes'];
                    $ppricedis = $row['ppricedis'];
                    $pprice = $row['pprice'];
                    $categoryid = $row['category'];
                    $original_price = '&#8358;' . number_format($pprice);
                    $discounted_price = '&#8358;' . number_format($ppricedis);
                    $totalPrice += $pprice;
                    $total_price = '&#8358;' . number_format($totalPrice, 2);
                    $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM productimages WHERE prod_id = '$prod_id' AND thumbnail = 1");
                    $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
                    // $image_path_thumbnail = IMAGE_URL . $row_prod_img_thumbnail['img'];
                  ?>
                    <div class="d-flex justify-between">
                      <div class="d-flex items-center">
                        <div class="size-50 rounded-16 brand-pic-display" style="background-image: url('<?php echo $image_path_thumbnail ?>'); "></div>
                        <div class="ml-10">
                          <div class="lh-11 fw-500 text-dark-1">
                            <?php
                            // echo $product_name; 
                            if (strlen($ptitle) > 20) {
                              echo substr($ptitle, 0, 20) . '...' . ' (x' . $quantity . ')';
                            } else {
                              echo $ptitle . ' (x' . $quantity . ')';
                            }
                            ?>
                          </div>
                          <div class="text-14 lh-11 mt-5">
                            <?php echo $original_price; ?>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="d-flex items-end flex-column pt-8">
															<div class="text-13 lh-1">35 mins</div>
															<div class="d-flex justify-center items-center size-20 bg-blue-3 rounded-full mt-8">
																<span class="text-11 lh-1 text-white fw-500">5</span>
															</div>
														</div> -->
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
                  <?php
                  }
                  ?>
                  <div class="border-top-light pt-20 mt-20">
                    <div class="row y-gap-20 justify-between">
                      <div class="col-auto">
                        <p class="text-14 lh-13 mt-5 uppercase">Total Price</p>
                      </div>
                      <div class="col-auto">
                        <div class="text-16 fw-500 text-dark-1">
                          <?php echo $total_price; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 col-12">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex items-center justify-between py-20 px-30 border-bottom-light d-none">
                <?php
                $customersql = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$order_id}'");
                $customerrow = mysqli_fetch_assoc($customersql);
                $customername = $customerrow['fullname']; //Get the Full Name
                $mode = $customerrow['mode']; //Get the Full Name
                $status = $customerrow['status']; //Get the Full Name
                $address = $customerrow['deliveryaddress']; //Get the Full Name
                $phonenumber = $customerrow['phonedetails']; //Get the Full Name
                if ($mode == 1) {
                  $mode = "Flutterwave";
                } elseif ($mode == 0) {
                  $mode = "WhatsApp";
                }
                if ($status == 1) {
                  $status = "Payment Pending";
                } elseif ($status == 2) {
                  $status = "Paid";
                } elseif ($status == 3) {
                  $status = "Processed";
                } elseif ($status == 4) {
                  $status = "Delivered";
                } elseif ($status == 5) {
                  $status = "Payment Failed";
                } else {
                  $status = "Another Status";
                }
                ?>
                <div class="col-auto">
                  <div class="lh-11 text-17 fw-500 text-dark-1">Delivery Information</div>
                  <div class="text-14 lh-11 mt-5 uppercase">#<?php echo $order_id ?></div>
                </div>
                <div class="col-auto ">
                  <div class="text-16 fw-500 text-dark-1 img-outline" data-toggle="modal" data-target="#editorder">
                    <i class="fa-solid fa-marker" style="padding:7px"></i>
                  </div>
                </div>
                <!-- <a href="#" class="text-14 lh-11 fw-500 text-orange-1 underline">Delete Conversation</a> -->
              </div>
              <div class="mt-30 mb-30 px-30">
                <div class="row y-gap-20 justify-between">
                  <div class="d-flex x-gap-10 y-gap-20 items-center flex-wrap">
                    <div>
                      <div class=" bg-deep-green-1 small-icon">
                        <i class="fa-solid fa-user"></i>
                      </div>
                    </div>
                    <div class="">
                      <p class="mt-">Customer's Name</p>
                      <h5 class="text-17 lh-14 fw-500"><?php echo $customername ?></h5>
                    </div>
                  </div>
                  <div class="d-flex x-gap-10 y-gap-20 items-center flex-wrap">
                    <div>
                      <div class=" bg-deep-green-1 small-icon">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                    </div>
                    <div class="">
                      <p class="mt-">Phone Number</p>
                      <h5 class="text-17 lh-14 fw-500"><?php echo $phonenumber ?></h5>
                    </div>
                  </div>
                  <div class="d-flex x-gap-10 y-gap-20 items-center flex-wrap">
                    <div>
                      <div class=" bg-deep-green-1 small-icon">
                        <i class="fa-solid fa-credit-card"></i>
                      </div>
                    </div>
                    <div class="">
                      <p class="mt-">Mode of Payment</p>
                      <h5 class="text-17 lh-14 fw-500"><?php echo $mode ?></h5>
                    </div>
                  </div>
                  <div class="d-flex x-gap-10 y-gap-20 items-center flex-wrap">
                    <div>
                      <div class=" bg-deep-green-1 small-icon">
                        <i class="fa-solid fa-credit-card"></i>
                      </div>
                    </div>
                    <div class="">
                      <p class="mt-">Status</p>
                      <h5 class="text-17 lh-14 fw-500"><?php echo $status ?></h5>
                    </div>
                  </div>
                  <?php
                  if ($address != '') {
                  ?>
                    <div class="d-flex x-gap-10 y-gap-20  flex-wrap">
                      <div>
                        <div class=" bg-deep-green-1 small-icon">
                          <i class="fa-solid fa-location-dot"></i>
                        </div>
                      </div>
                      <div class="" style="max-width: 80%;">
                        <p class="mt-">Delivery address</p>
                        <h5 class="text-17 lh-14 fw-500"><?php echo $address ?></h5>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
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