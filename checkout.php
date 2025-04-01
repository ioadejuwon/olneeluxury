<?php
$pagetitle = "Checkout";
include_once "comp/head.php";
include_once "comp/header.php";

$deliveries = mysqli_query($conn, "SELECT * FROM olnee_delivery");
?>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<section data-anim="fade" class="breadcrumbs d-none">
  <div class="container">
    <div class="row">
      <div class="col-auto">
        <div class="breadcrumbs__content">

          <div class="breadcrumbs__item ">
            <a href="#">Home</a>
          </div>

          <div class="breadcrumbs__item ">
            <a href="#">All courses</a>
          </div>

          <div class="breadcrumbs__item ">
            <a href="#">User Experience Design</a>
          </div>

          <div class="breadcrumbs__item ">
            <a href="#">User Interface</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>


<section class="page-header -type-1 mt-60 text-white">
  <div class="overlay"></div>
  <div class="container">
    <div class="page-header__content">
      <div class="row justify-centr text-left">
        <div class="col-auto">
          <div data-anim="slide-up delay-1">
            <h1 class="page-header__title text-white">Shop Checkout</h1>
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
    <form class="contact-form respondForm__form  y-gap-20 "  id="checkoutForm" method="POST" action="#">
      <div class="row y-gap-50">

        <div class="col-lg-8">
          <div class="shopCheckout-form row">

            <div class="col-12 mb-20">
              <h5 class="text-20">Delivery details</h5>
            </div>

            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">First Name <span class="text-red-1">*</span></label>
              <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Last Name <span class="text-red-1">*</span></label>
              <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email Address <span class="text-red-1">*</span></label>
              <input type="text" name="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone <span class="text-red-1">*</span></label>
              <input type="text" name="phone" class="form-control" placeholder="Phone" required>
            </div>

            <div class="col-sm-6 ">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Shipping Address <span class="text-red-1">*</span></label>
              <select class="selectize wide js-selectize" class="form-select" name="deliverycost" required>
                <option value="">Please choose nearest location</option>
                <option value="0" data-cost="0">Pick Up - <?php echo NAIRA .'0.00' ?></php></option>
                <?php
                while ($row_deliveries = mysqli_fetch_assoc($deliveries)) {
                  $deliveryname = $row_deliveries['deliveryName'];
                  $deliverycost = $row_deliveries['deliveryCost'];
                  $format_deliverycost = NAIRA . number_format($deliverycost, 2);
                  $delivery_id = $row_deliveries["deliveryid"];
                ?>
                  <option value="<?php echo $deliverycost ?>" data-cost="<?php echo $deliverycost; ?>">
                    <?php echo $deliveryname . ' - ' . $format_deliverycost ?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>

            
            
            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Address <span class="text-red-1">*</span></label>
              <input type="text" name="street" class="form-control" placeholder="Street Address" required>
            </div>

            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Town/City <span class="text-red-1">*</span></label>
              <input type="text" name="city" class="form-control" placeholder="Town / City *" required>
            </div>

            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State <span class="text-red-1">*</span></label>
              <input type="text" class="form-control" name="state" placeholder="State *" required>
            </div>

            <div class="col-sm-6">
              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country <span class="text-red-1"></span></label>
              <select class="selectize wide js-selectize" class="form-select" name="country">
                <option value="NG">Nigeria</option>
                <option value="GH">Ghana</option>
              </select>
            </div>

            <div class="col-12">
              <h5 class="text-20 fw-500 pt-20">Additional information</h5>
            </div>
            <div class="col-12">
              <label class="text-16 lh-1 fw-500 text-dark-1 pb-20 pt-20">Order notes (optional)</label>
              <textarea name="notes" id="form_notes" class="form-control" rows="8" placeholder="Order notes (optional)"></textarea>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="">
            <!-- <div class="pt-30 pb-15 bg-white border-light rounded-8 bg-light-4">
              <h5 class="px-30 text-20 fw-500">Your order</h5>
              <div id="totalCartItemsContainer"></div>
              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500">Subtotal</div>
                <div class="py-15 fw-500" >₦0.00</div>
              </div>
              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500 text-dark-1">Shipping</div>
                <div class="py-15 fw-500 text-dark-1" >₦0.00</div>
              </div>
              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500 text-dark-1">Total</div>
                <div class="py-15 fw-500 text-dark-1" >₦0.00</div>
              </div>
            </div> -->

            <div class="pt-30 pb-15 bg-white border-light rounded-8 bg-light-4">
              <h5 class="px-30 text-20 fw-500">
                Your order
              </h5>

              <div class="d-flex justify-between px-30 mt-25">
                <div class="py-15 fw-500 text-dark-1">Product</div>
                <div class="py-15 fw-500 text-dark-1">Subtotal</div>
              </div>

              <div class="totalCartItemsContainer border-top-dark">

              
              </div>

              <div class="emptyCheckoutCart py-10 ml-20 mr-20 rounded-8 bg-light-2">
                <div class="px-30" >
                  <div class="py-text-grey text-center ">Your Cart is empty.</div>
                  <div class=" text-grey text-center ">Add items to cart.</div>

                </div>

              
              </div>

              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500">Subtotal</div>
                <div class="py-15 fw-500" id="subtotal">₦0.00</div>
              </div>
              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500">Discount</div>
                <div class="py-15 fw-500" id="discount">₦0.00</div>
              </div>

              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500 text-dark-1">Shipping</div>
                <div class="py-15 fw-500 text-dark-1" id="shipping">₦0.00</div>
              </div>

              <div class="d-flex justify-between border-top-dark px-30">
                <div class="py-15 fw-500 text-dark-1">Total</div>
                <div class="py-15 fw-500 text-dark-1" id="checkout-total">₦0.00</div>
              </div>
            </div>

            <div class="py-30 px-30 bg-white mt-30 border-light rounded-8 bg-light-4">
              <h5 class="text-20 fw-500">
                Payment Method
              </h5>

              <div class="mt-30">
                <div class="form-radio d-flex items-center">
                  <div class="radio">
                  <input type="radio" name="radio" value="1">
                    <div class="radio__mark">
                      <div class="radio__icon"></div>
                    </div>
                  </div>
                  <h5 class="ml-15 text-15 lh-1 fw-500 text-dark-1">Pay Now</h5>
                </div>
                <p class="ml-25 pl-5 mt-2">
                  Make your payment directly online.
                </p>
              </div>

              <div class="mt-30">
                <div class="form-radio d-flex items-center">
                  <div class="radio">
                  <input type="radio" name="radio" value="2">
                    <div class="radio__mark">
                      <div class="radio__icon"></div>
                    </div>
                  </div>
                  <h5 class="ml-15 text-15 lh-1 fw-500 text-dark-1">Direct bank transfer</h5>
                </div>
                <p class="ml-25 pl-5 mt-2">
                  Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                </p>
              </div>



              <div class="mt-30 d-noe">
                <div class="form-radio d-flex items-center">
                  <div class="radio">
                    <input type="radio" name="radio" value="3">
                    <div class="radio__mark">
                      <div class="radio__icon"></div>
                    </div>
                  </div>
                  <h5 class="ml-15 text-15 lh-1 text-dark-1">Cash on delivery</h5>
                </div>
                <p class="ml-25 pl-5 mt-2">
                  You can make payment for your ordeer when it is delivered.
                </p>
              </div>

              <div class="mt-30">
                <div class="form-radio d-flex items-center">
                  <div class="radio">
                    <input type="radio" name="radio" value="4">
                    <div class="radio__mark">
                      <div class="radio__icon"></div>
                    </div>
                  </div>
                  <h5 class="ml-15 text-15 lh-1 text-dark-1">Send order on WhatsApp</h5>
                </div>
                <p class="ml-25 pl-5 mt-2">
                  You need to ask questions? Send your order to one of our reps.
                </p>
              </div>
              <!-- </div>

            <div class="py-30 px-30 bg-white mt-30 border-light rounded-8 bg-light-4">
              <h5 class="text-20 fw-500">Shipping Method</h5> -->
              <div class="mt-30">
                <button type="submit" id="payNowButton" class="button -md -deep-green-1 text-white col-12 mt-30">Pay Now</button>
                <!-- <a href="<?php echo ORDER ?>" class="button -md -deep-green-1 text-white col-12 mt-30">Pay Now</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>


<script src="admin/api/payment.js"></script>
<?php
include_once "comp/footer.php";
include_once "comp/tail.php";
?>