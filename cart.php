<?php
$pagetitle = "Cart";
include_once "comp/head.php";
include_once "comp/header.php";
// echo '<script>';
// echo 'var shop = "' . SHOP . '";';
// echo '</script>';

?>


<section class="page-header -type-1 mt-60 bg-deep-green-1 text-white">
  <div class="overlay"></div>
  <div class="container">
    <div class="page-header__content">
      <div class="row justify-cente text-left">
        <div class="col-auto">
          <div data-anim="slide-up delay-1">
            <h1 class="page-header__title text-white"><?php echo $couponPercent ?>Shop Cart</h1>
          </div>

          <div data-anim="slide-up delay-2">
            <p class="page-header__text">We’re on a mission to deliver Comfortable Clothing at a reasonable price.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="layout-pt-lg layout-pb-lg section-bg mt-30 tf-page-cart " style="display: none;">
  <div class="section-bg__item bg-light-6"></div>
  <div class="container">
    <div class="row y-gap-20 justify-center text-center">
      <div class="col-auto">
        <div class="sectionTitle ">
          <h2 class="sectionTitle__title ">Your cart is empty</h2>
          <p class="sectionTitle__text h4 pt-15">You may check out all the available products and add some to your cart from the catalog</p>
        </div>
        <div class="row justify-center pt-60 lg:pt-40">
          <div class="col-auto">
            <a href="<?php echo SHOP ?>" class="button -icon  -deep-green-1 text-white">
              Return to Catalog <i class="icon-arrow-top-right text-13 ml-10"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="layout-pt-md layout-pb-lg tf-page-cart-wrap">
  <div class="">
    <div class="container">
      <div class="table-responsive">
        <table class="table w-1/1 d-non align-middle" id="cart-items-container" data-anim="slide-up delay-3">
          <thead>
            <tr>
              <th style="width: 1% !important">Image</th>
              <th style="width: 15% !important">Product</th>
              <th>Price</th>
              <th>Yards</th>
              <th>Subtotal</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody id="cartItems" class="tf-cart-item-container ">
            <tr class="tf-cart-item file-delete">
              <td colspan="6">
                <h5 class="mt-25 mb-25 text-center">Loading your Cart ...</h5>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="shopCart-footer px-16 mt-30" data-anim="slide-up delay-3">
        <div class="row justify-end y-gap-30">
          <div class="col-xl-7">
            <div class="d-flex justify-end border-dark">
              <input style="border: solid 1px grey !important; width: 300px;" class="mr-4 rounded-8 px-25 py-10 form-control" id="couponCode" type="text" name="code" value="<?php echo $couponcode ?>" placeholder="Enter Coupon Code">
              <button class="button text-white -md w-100 fw-500 -deep-green-1 ml-10" type="submit" onclick="applyCoupon()">Apply<span class="lg:d-none">&nbsp;coupon</span></button>
            </div>
          </div>

          <div class="col-auto d-none">
            <div class="shopCart-footer__item">
              <button class="button -md -deep-green-1 text-white">Update cart</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-end" data-anim="slide-up delay-4">
        <div class="col-xl-4 col-lg-5 layout-pt-lg">
          <div class="py-30 bg-light-4 rounded-8 border-light">
            <h5 class="px-30 text-20 fw-500">Cart Total</h5>

            <div class="d-flex justify-between px-30 item mt-25">
              <div class="py-15 fw-500 text-dark-1">Subtotal</div>
              <div class="py-15 fw-500 text-dark-1" id="subtotal">₦0.00</div>
            </div>

            <div class="d-flex justify-between px-30 item mt-">
              <div class="py-15 fw-500 text-dark-1">Discount</div>
              <div class="py-15 fw-500 text-dark-1" id="discount">₦0.00</div>
            </div>

            <div class="d-flex justify-between px-30 item border-top-dark">
              <div class="pt-15 fw-500 text-dark-1">Total</div>
              <div class="pt-15 fw-500 text-dark-1" id="total-price2">₦0.00</div>
            </div>
          </div>

          <a href="<?php echo CHECKOUT ?>" class="button -md -deep-green-1 text-white col-12 mt-30">Proceed to checkout</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <section class="layout-pt-md layout-pb-lg d-none">
  <div class="container">
    <div class="row justify-end">
      <div class="col-12">
        <div class="px-30 pr-60 py-25 rounded-8 bg-light-6 md:d-none">
          <div class="row justify-between">
            <div class="col-md-4">
              <div class="fw-500 text-purple-1">Product</div>
            </div>
            <div class="col-md-2">
              <div class="fw-500 text-purple-1">Price</div>
            </div>
            <div class="col-md-2">
              <div class="fw-500 text-purple-1">Yards</div>
            </div>
            <div class="col-md-2">
              <div class="fw-500 text-purple-1">Subtotal</div>
            </div>
            <div class="col-md-1">
              <div class="d-flex justify-end">
                <div class="fw-500 text-purple-1">Remove</div>
              </div>
            </div>
          </div>
        </div>

        <div class="px-30 pr-60 md:px-0">

          <div class="row y-gap-20 justify-between items-center pt-30 pb-30 border-bottom-light">
            <div class="col-md-4">
              <div class="d-flex items-center">
                <div class="">
                  <div class="size-100 bg-image rounded-8 js-lazy" data-bg="img/shop/products/1.png"></div>
                </div>
                <div class="fw-500 text-dark-1 ml-30">Cosy Chair - Beige, Leather</div>
              </div>
            </div>

            <div class="col-lg-2 col-auto md:mt-15">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Price
                </div>
                <p>$298</p>
              </div>
            </div>

            <div class="col-lg-2 col-auto">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-">
                  Yards
                </div>

                <div class="input-counter md:mt- js-input-counter">
                  <input class='input-counter__counter' type="number" placeholder="value..." value='1' />

                  <div class="input-counter__controls">
                    <button class='input-counter__up js-down'>
                      <i class='icon' data-feather="minus"></i>
                    </button>

                    <button class='input-counter__down js-up'>
                      <i class='icon' data-feather="plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-2 col-auto">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Subtotal
                </div>

                <p>$1.298</p>
              </div>
            </div>

            <div class="col-lg-2 col-auto">
              <div class="md:d-non d-flex justify-end">
                <i class="icon" data-feather="x"></i>
              </div>
            </div>
          </div>

          <div class="row y-gap-20 justify-between items-center pt-30 pb-30 border-bottom-light">
            <div class="col-md-4">
              <div class="d-flex items-center">
                <div class="">
                  <div class="size-100 bg-image rounded-8 js-lazy" data-bg="img/shop/products/2.png"></div>
                </div>
                <div class="fw-500 text-dark-1 ml-30">Cosy Chair - Beige, Leather</div>
              </div>
            </div>

            <div class="col-md-2 md:mt-15">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Price
                </div>
                <p>$298</p>
              </div>
            </div>

            <div class="col-md-2">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Yards
                </div>

                <div class="input-counter md:mt-20 js-input-counter">
                  <input class='input-counter__counter' type="number" placeholder="value..." value='1' />

                  <div class="input-counter__controls">
                    <button class='input-counter__up js-down'>
                      <i class='icon' data-feather="minus"></i>
                    </button>

                    <button class='input-counter__down js-up'>
                      <i class='icon' data-feather="plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-1">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Subtotal
                </div>

                <p>$1.298</p>
              </div>
            </div>

            <div class="col-md-1">
              <div class="md:d-none d-flex justify-end">
                <i class="icon" data-feather="x"></i>
              </div>
            </div>
          </div>

          <div class="row y-gap-20 justify-between items-center pt-30 pb-30 border-bottom-light">
            <div class="col-md-4">
              <div class="d-flex items-center">
                <div class="">
                  <div class="size-100 bg-image rounded-8 js-lazy" data-bg="img/shop/products/3.png"></div>
                </div>
                <div class="fw-500 text-dark-1 ml-30">Cosy Chair - Beige, Leather</div>
              </div>
            </div>

            <div class="col-md-2 md:mt-15">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Price
                </div>
                <p>$298</p>
              </div>
            </div>

            <div class="col-md-2">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Yards
                </div>

                <div class="input-counter md:mt-20 js-input-counter">
                  <input class='input-counter__counter' type="number" placeholder="value..." value='1' />

                  <div class="input-counter__controls">
                    <button class='input-counter__up js-down'>
                      <i class='icon' data-feather="minus"></i>
                    </button>

                    <button class='input-counter__down js-up'>
                      <i class='icon' data-feather="plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-1">
              <div class="">
                <div class="shopCart-products__title d-none md:d-block mb-10">
                  Subtotal
                </div>

                <p>$1.298</p>
              </div>
            </div>

            <div class="col-md-1">
              <div class="md:d-none d-flex justify-end">
                <i class="icon" data-feather="x"></i>
              </div>
            </div>
          </div>

        </div>

        <div class="shopCart-footer px-16 mt-30">
          <div class="row justify-between y-gap-30">
            <div class="col-xl-5">
              <form class="" action="https://creativelayers.net/themes/educrat-html/post">
                <div class="d-flex justify-between border-dark">
                  <input class="rounded-8 px-25 py-20" type="text" placeholder="Coupon Code">
                  <button class="text-black fw-500" type="submit">Apply<span class="lg:d-none"> coupon</span></button>
                </div>
              </form>
            </div>

            <div class="col-auto">
              <div class="shopCart-footer__item">
                <button class="button -md -purple-3 text-purple-1">Update cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-5 layout-pt-lg">
        <div class="py-30 bg-light-4 rounded-8 border-light">
          <h5 class="px-30 text-20 fw-500">
            Cart Totals
          </h5>

          <div class="d-flex justify-between px-30 item mt-25">
            <div class="py-15 fw-500 text-dark-1">Subtotal</div>
            <div class="py-15 fw-500 text-dark-1">$1.298</div>
          </div>

          <div class="d-flex justify-between px-30 item border-top-dark">
            <div class="pt-15 fw-500 text-dark-1">Total</div>
            <div class="pt-15 fw-500 text-dark-1">$3.298</div>
          </div>
        </div>

        <a href="shop-checkout.html" class="button -md -purple-1 text-white col-12 mt-30">Proceed to checkout</a>
      </div>
    </div>
  </div>
</section> -->

<?php
include_once "comp/otherproducts.php";
include_once "comp/footer.php";
include_once "comp/tail.php";
?>