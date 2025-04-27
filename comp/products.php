<div class="w-1/5 xl:w-1/4 lg:w-1/2 sm:w-1/2">

    <div id="productForm" class="productCard -type-1 text-center"
        data-product-id="<?php echo $product_id; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $image_path_thumbnail; ?>" data-name="<?php echo $product_name; ?>" data-discounted-price="<?php echo $dis_price; ?>" data-available-yards="<?php echo $availableYards; ?>">
        <div class="productCard__image">
            <div class="ratio ratio-63:57">
                <img class="absolute-full-center rounded-8"
                    src="<?php echo $image_path_thumbnail; ?>" alt="<?php echo $product_name ?>">
            </div>
            <div class="productCard__controls z-3">
                <a data-toggle="modal" data-target="<?php echo '#share-' . $product_id ?>" class="productCard__icon">
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
            <h4 class="text-17 fw-600 mt- text-line-clamp-1  mb-1 capitalize-each">
                <?php echo $product_name; ?>
            </h4>
            <div class="text-17 fw-500 text-deep-green-1 mt-5 price">
                <?php echo $price; ?>
            </div>
            <?php

            if ($availability == 1 && $availableYards > 0) {
            ?>
                <div class="productCard__button d-inline-block add_to_cart_bt" style="width: 100% !important">
                    <button type="button" class="button fs-16 w-100 text-white -deep-green-1  mt-5 add-to-cart-btn" data-product-id="<?php echo $product_id; ?>"
                        style="width:100%; font-size: 16px; line-height: 18px; font-weight: 500; height: 60px;">
                        Add To Cart
                    </button>
                </div>

            <?php

            } elseif ($availability == 0 || $availableYards < 1) {
            ?>
                <div class="productCard__button d-inline-block" style="width: 100% !important">
                    <button disabled type="button" class="button fs-16 w-100 text-white -yellow-3  mt-5"
                        style="width:100%; font-size: 16px; line-height: 18px; font-weight: 500; height: 60px;">
                        Out of Stock
                    </button>
                </div>

            <?php
            }

            ?>

        </div>
    </div>

    <?php foreach ($other_images as $image_path): ?>
        <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery" data-gallery="<?php echo $product_id ?>"></a>
    <?php endforeach; ?>
</div>

<div class="modal fade " id="share-<?php echo $product_id; ?>" tabindex="">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-dark">
                <h4 class="modal-title">Share Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="admin/assets/img/icons/close.png" alt="" width="20%">
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark">
                    Share a link to the product "<span class="fw-600"><?php echo $product_name ?></span>" using any of the links below.
                </p>

                <div class="row mb-5 pt-15 justify-center items-center border-top-dark">
                    <div class="col-auto icon-outline p-2 mr-30">
                        <a href="<?php echo WASHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                            <!-- <i class="icon-instagram"></i> -->
                            <img src="admin/assets/img/icons/wa.png" alt="">
                        </a>
                    </div>
                    <div class="col-auto icon-outline p-2 mr-30 d-none">
                        <a href="<?php echo IGSHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                            <img src="admin/assets/img/icons/ig.png" alt="">
                        </a>
                    </div>
                    <div class="col-auto icon-outline p-2 mr-30 d-none">
                        <a href="<?php echo FBSHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                            <img src="admin/assets/img/icons/fb.png" alt="">
                        </a>
                    </div>
                    <div class="col-auto icon-outline p-2 mr-30">
                        <a href="<?php echo XSHARE . PRODUCT_DETAIILS . $product_id ?>" target="_blank" class="text-deep-green-1 text-24">
                            <img src="admin/assets/img/icons/x.png" alt="">
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>