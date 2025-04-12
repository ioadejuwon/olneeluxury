  <!-- Shop -->

  <section class="layout-pt-md layout-pb-lg">
    <div data-anim-wrap class="container" style="width:95%; margin:0% auto;">
      <div class="row justify-center text-center" data-anim-child="slide-up delay-2">
        <div class="col-auto">
          <div class="sectionTitle ">
            <h2 class="sectionTitle__title ">Best Selling Products</h2>
            <p class="sectionTitle__text ">Beautifully Functional. Purposefully Designed. Consciously Crafted.</p>
          </div>
        </div>
      </div>

      <div class="row y-gap-30 justify-center pt-10 lg:pt-20" style="margin:0% auto;" data-anim-child="slide-up delay-2">

        <?php
        $prodsql = mysqli_query($conn, "SELECT * FROM products LIMIT 4");
        while ($row_prod = mysqli_fetch_assoc($prodsql)) {
          $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
          $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
          $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
          $original_price = '&#8358;' . number_format($price);
          $discounted_price = '&#8358;' . number_format($dis_price);
          $product_id = $row_prod['productid'];

          $availableYards = (int)$row_prod['yards'];
          $availability = (int)$row_prod['availability'];

          // Get the thumbnail image
          $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
          $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
          // $image_path_thumbnail = 'admin/'.$row_prod_img_thumbnail['image_path'];
          // $product_img = $image_path_thumbnail;

          // $image_path_thumbnail = $row_prod_img_thumbnail['image_path'];
          if (!empty($row_prod_img_thumbnail['image_path'])) {
            $image_path_thumbnail2 = $row_prod_img_thumbnail['image_path'];
          } else {
            $image_path_thumbnail2 = DEFAULT_IMG;
          }
          $image_path_thumbnail = 'admin/' . $image_path_thumbnail2;


          // Get the non-thumbnail images
          $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
          $other_images = [];
          while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
            $other_images[] = $row_prod_img['image_path'];
          }
          include 'comp/products.php';
        }
        ?>

      </div>

      <div class="row justify-center pt-60 lg:pt-40 d-none">
        <div class="col-auto">
          <a href="#" class="button -md -outline-light-5 text-dark-1">
            View All Courses
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- End Shop -->