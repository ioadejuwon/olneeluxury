<?php
$pagetitle = "Collection";
include_once "comp/head.php";
include_once "comp/header.php";




?>



<section class="page-header -type-1 mt-60 text-white">
    <div class="overlay"> </div>
    <div class="container">
        <div class="page-header__content">
            <div class="row justify-cente text-left">
                <div class="col-auto pt-30 pb-30">
                    <div data-anim="slide-up delay-1">
                        <h1 class="page-header__title text-white">Our Collection</h1>
                    </div>

                    <div data-anim="slide-up delay-2">
                        <p class="page-header__text">
                            We’re on a mission to deliver Comfortable Clothing at a reasonable
                            price.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<section class="layout-pt-md layout-pb-lg border-top-light">
    <div data-anim-wrap class="container">

        <div class=" js-section-slider" data-gap="30" data-pagination data-slider-cols="xl-3 lg-3 md-2">
            <div class="swiper-wraper row y-gap-30">

                <?php
                $categories = mysqli_query($conn, "SELECT * FROM olnee_categories");
                while ($row_categories = mysqli_fetch_assoc($categories)) {
                    $categoryname = $row_categories['categoryName'];
                    $category_id = $row_categories["categoryid"];
                ?>

                <div class="swiper-slid col-lg-3">
                    <div class=" bg-light-1 rounded-8 with-image-bg " style="background-image: url('admin/assets/img/landing.jpg');">
                        <div class="eventCard -type-3 rounded-8">
                            <div class="eventCard__date">
                                <h3 class="text-30 lh-12 fw-600 ml-15 text-white capitalise"><?php echo $categoryname ?></h3>
                            </div>
                            <div class="eventCard__button">
                                <a href="<?php echo CATEGORY.$category_id ?>" class="button -icon -white text-deep-green-1">
                                    View Category
                                    <i class="icon-arrow-top-right text-13 ml-10"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</section>


<?php
include_once "comp/cart.php";
include_once "comp/footer.php";
include_once "comp/tail.php";
?>