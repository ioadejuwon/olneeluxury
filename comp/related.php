<section class="layout-pt-md layout-pb-lg">
  <div class="container">
    <div class="row justify-center text-center">
      <div class="col-auto">
        <div class="sectionTitle ">
          <h2 class="sectionTitle__title ">Related Products</h2>
          <p class="sectionTitle__text ">Some product(s) you may also like</p>
        </div>
      </div>
    </div>

    <div class="row y-gap-32 pt-60 sm:pt-40">
      <?php
      // $prodsql = mysqli_query($conn, "SELECT * FROM products WHERE productcategory = '$product_cat_id' ORDER BY  RAND() LIMIT 4 ");
      $prodsql = mysqli_query($conn, "SELECT * FROM products  ORDER BY  RAND() LIMIT 4 ");
      while ($row_prod = mysqli_fetch_assoc($prodsql)) {
        $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
        $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
        $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
        $original_price = '&#8358;' . number_format($price);
        $discounted_price = '&#8358;' . number_format($dis_price);
        $product_id = $row_prod['productid'];

        // Get the thumbnail image
        $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
        $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
        $image_path_thumbnail = $row_prod_img_thumbnail['image_path'];

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
  </div>
</section>