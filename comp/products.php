<div class="w-1/5 xl:w-1/3 lg:w-1/2 sm:w-1/2">

<div id="productForm" class="productCard -type-1 text-center"
    data-product-id="<?php echo $product_id; ?>" data-price="<?php echo $price; ?>"
    data-image="<?php echo $image_path_thumbnail; ?>" data-name="<?php echo $product_name; ?>"
    data-discounted-price="<?php echo $dis_price; ?>">
    <div class="productCard__image">
        <div class="ratio ratio-63:57">
            <img class="absolute-full-center rounded-8"
                src="<?php echo $image_path_thumbnail; ?>" alt="product image">
        </div>
        <div class="productCard__controls z-3">
            <a href="#" class="productCard__icon">
                <i class="fa-regular fa-send"></i>
            </a>
            <a data-barba href="<?php echo $image_path_thumbnail; ?>"
                class="gallery__item js-gallery productCard__icon"
                data-gallery="<?php echo $product_id ?>">
                <i class="fa-regular fa-images"></i>
            </a>
            <a href="<?php echo PRODUCT_DETAIILS . $product_id; ?>"
                class="productCard__icon">
                <i class="fa-regular fa-eye"></i>
            </a>
        </div>
    </div>
    <!-- <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="product_img" value="<?php echo $image_path_thumbnail; ?>">
    <input type="hidden" name="price" value="<?php echo $price; ?>"> -->
    <input type="hidden" name="yards" value="1">
    <div class="productCard__content mt-15">
        <!-- <h4 class="text-17 fw-500 mt-15 no-big-screen">
            <?php
            // echo $product_name; 
            if (strlen($product_name) > 18) {
                echo substr($product_name, 0, 16) . '...';
            } else {
                echo $product_name;
            }
            ?>
        </h4> -->
        <h4 class="text-17 fw-500 mt- text-line-clamp-1">
            <?php echo $product_name; ?>
        </h4>
        <div class="text-17 fw-500 text-deep-green-1 mt-5 price">
            <?php echo $price; ?>
        </div>
        <div class="productCard__button d-inline-block add_to_cart_btn" style="width: 100% !important">
            <button type="button" class="button fs-16 w-100 text-white -deep-green-1  mt-5 add-to-cart-btn" data-product-id="<?php echo $product_id; ?>"
                style="width:100%; font-size: 16px; line-height: 18px; font-weight: 500; height: 60px;">
                Add To Cart
            </button>
        </div>
    </div>
</div>

<?php foreach ($other_images as $image_path): ?>
    <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery" data-gallery="<?php echo $product_id ?>"></a>
<?php endforeach; ?>
</div>