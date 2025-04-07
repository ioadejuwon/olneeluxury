<?php
$pagetitle = "Order";
require_once "admin/inc/config.php";
include_once "admin/inc/drc.php";

$order_id = $_GET['id'];

$orderquery = "SELECT * FROM olnee_orders WHERE order_id = ?";
$stmt = mysqli_prepare($conn, $orderquery);
mysqli_stmt_bind_param($stmt, "s", $order_id); // Bind the parameter
mysqli_stmt_execute($stmt); // Execute the prepared statement
$result = mysqli_stmt_get_result($stmt); // Get the result
$count_row_orders = $result->num_rows;

if ($count_row_orders < 1) {
    header("location: " . SHOP);
}
include_once "comp/head.php";
include_once "comp/header.php";
?>


<section class="page-header -type-1 mt-60 text-white">
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header__content">
            <div class="row justify-center text-center">
                <div class="col-auto">
                    <div data-anim="slide-up delay-1">
                        <h1 class="page-header__title text-white">Shop Order</h1>
                    </div>
                    <div data-anim="slide-up delay-2">
                        <p class="page-header__text">We’re on a mission to deliver Comfortable Clothing at a reasonable price.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="layout-pt-md layout-pb-lg">
    <div class="container">
        <?php


        $row = $result->fetch_assoc();
        $firstname = $row["first_name"];
        $lastname = $row["last_name"];
        $customer = $firstname . " " . $lastname;
        $email = $row["email"];
        $phone = $row["phone"];

        $street = $row["street"];
        $city = $row["city"];
        $state = $row["state"];
        $notes = $row["notes"];
        $country = $row["country"];

        $cus_address = $street . ",<br>" . $city . ", " . $state . ", " . $country;

        $paymentOption = $row['paymentOption'];
        $total = $row['total'];
        $status = $row['status'];
        $subtotal = $row['subtotal'];
        $shipping = $row['shipping'];
        $discount = $row['discount'];
        $created_at = $row['created_at'];
        $date = strtotime($created_at);
        // $dateformat = date('D., jS M.', $date);
        // $dateformat = date('j/m/y', $date);

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


        $dateformat =  date('D, jS F, Y', $date);

        if ($paymentOption == '1') {
            $paymentMethod = 'Online Payment';
        } elseif ($paymentOption == '2') {
            $paymentMethod = 'Direct Bank Transfer';
        } elseif ($paymentOption == '3') {
            $paymentMethod = 'Cash on Delivery';
        } elseif ($paymentOption == '4') {
            $paymentMethod = 'Completed on WhatsApp';
        }

        $orderdetails = "SELECT * FROM olnee_order_items WHERE order_id = ?";
        $orders_details_stmt = mysqli_prepare($conn, $orderdetails);
        mysqli_stmt_bind_param($orders_details_stmt, "s", $order_id); // Bind the parameter
        mysqli_stmt_execute($orders_details_stmt); // Execute the prepared statement
        $order_details_result = mysqli_stmt_get_result($orders_details_stmt); // Get the result
        $count_row_orders_details = $order_details_result->num_rows;




        ?>
        <div class="row no-gutters justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-11">
                <div class="shopCompleted-header">
                    <div class="icon">
                        <i data-feather="check"></i>
                    </div>
                    <h2 class="title">
                        Your order is completed!
                    </h2>
                    <div class="subtitle">
                        Thank you. Your order has been received.
                    </div>
                </div>


                <div class="shopCompleted-info">
                    <div class="row no-gutters y-gap-32">
                        <div class="col-md-3 col-sm-6">
                            <div class="shopCompleted-info__item">
                                <div class="subtitle">Order Number</div>
                                <div class="title text-purple-1 mt-5 uppercase"><?php echo $order_id ?></div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="shopCompleted-info__item">
                                <div class="subtitle">Date</div>
                                <div class="title text-purple-1 mt-5"><?php echo $dateformat ?></div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 d-none">
                            <div class="shopCompleted-info__item">
                                <div class="subtitle">Total</div>
                                <div class="title text-purple-1 mt-5 price"><?php echo $total ?></div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="shopCompleted-info__item">
                                <div class="subtitle">Payment Method</div>
                                <div class="title text-purple-1 mt-5"><?php echo $paymentMethod ?></div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="shopCompleted-info__item">
                                <div class="subtitle">Status</div>
                                <div class="title text-purple-1 mt-5"><?php echo $status ?></div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="shopCompleted-footer bg-light-4 border-light rounded-8">
                    <div class="shopCompleted-footer__wrap">
                        <h5 class="title">
                            Order details
                        </h5>

                        <div class="item">
                            <span class="fw-500">Product</span>
                            <span class="fw-500">Price</span>
                        </div>
                        <?php
                        while ($row_details = $order_details_result->fetch_assoc()) {
                            $product_name = $row_details['product_name'];
                            $product_price = $row_details['price'];
                            $product_quantity = $row_details['quantity'];


                        ?>
                            <div class="item -border-none">
                                <span class=""><?php echo $product_name . ' x' . $product_quantity ?></span>
                                <span class="price"><?php echo $product_price ?></span>
                            </div>
                        <?php } ?>

                        <div class="item -border-noe">
                            <span class="fw-500">Subtotal</span>
                            <span class="price"><?php echo $subtotal ?></span>
                        </div>

                        <div class="item -border-none">
                            <span class="fw-500">Discount</span>
                            <span class="price"><?php echo '-' . $discount ?></span>
                        </div>

                        <div class="item  -border-none">
                            <span class="fw-500">Shipping</span>
                            <span class="price"><?php echo $shipping ?></span>
                        </div>

                        <div class="item">
                            <span class="fw-500">Total</span>
                            <span class="price"><?php echo $total ?></span>
                        </div>
                    </div>
                </div>

                <div class="shopCompleted-footer bg-light-4 border-light rounded-8">
                    <div class="shopCompleted-footer__wrap">
                        <h5 class="title">
                            Customer details
                        </h5>

                        <div class="item">
                            <span class="text-14">Customer name</span>
                            <span class="lh-11 fw-600 text-dark-1"><?php echo $customer ?></span>
                        </div>
                        <div class="item -border-none">
                            <span class="text-14">Phone</span>
                            <span class="lh-11 fw-600 text-dark-1"><?php echo $phone ?></span>
                        </div>
                        <div class="item -border-none">
                            <span class="text-14">Email Address</span>
                            <span class="lh-11 fw-600 text-dark-1"><?php echo $email ?></span>
                        </div>

                        <div class="item -border-none">
                            <span class="text-14">Delivery Address</span>
                            <span class="lh-12 fw-600 text-dark-1"><?php echo $cus_address ?></span>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</section>


<?php
include_once "comp/footer.php";
include_once "comp/tail.php";
?>