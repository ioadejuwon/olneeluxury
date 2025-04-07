<?php
$pagetitle = "Collection";
require_once "admin/inc/config.php";
include_once "admin/inc/drc.php";

$category_id = $_GET['id'];

$categoryquery = "SELECT categoryName FROM olnee_categories WHERE categoryid = ?";
$stmt = mysqli_prepare($conn, $categoryquery);
mysqli_stmt_bind_param($stmt, "s", $category_id); // Bind the parameter
mysqli_stmt_execute($stmt); // Execute the prepared statement
$result = mysqli_stmt_get_result($stmt); // Get the result
$count_row_category = $result->num_rows;

if ($count_row_category < 1) {
    header("location: " . COLLECTION);
}

$row_categories = mysqli_fetch_assoc($result);
$categoryname = $row_categories["categoryName"];
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
                        <h1 class="page-header__title text-white"><?php echo $categoryname ?></h1>
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


<section class="layout-pt-md layout-pb-lg">
    <div class="container">
        <div class="row x-gap-60 ">
            <div class="col-lg-3 display-none">

                <div data-anim="slide-up delay-3" class="sidebar -shop">
                    <div class="sidebar__item">

                        <div class="sidebar__search mb-30">
                            <div class="search">
                                <form action="">
                                    <button class="submit" type="submit">
                                        <i class="icon" data-feather="search"></i>
                                    </button>
                                    <input class="field" type="text" placeholder="Search">
                                </form>
                            </div>
                        </div>

                        <h5 class="sidebar__title">Categories</h5>

                        <div class="sidebar-content -list d-none">
                            <a class="text-dark-1" href="#">College</a>
                            <a class="text-dark-1" href="#">Gym</a>
                            <a class="text-dark-1" href="#">High School</a>
                            <a class="text-dark-1" href="#">Primary</a>
                            <a class="text-dark-1" href="#">School</a>
                            <a class="text-dark-1" href="#">University</a>
                        </div>
                        <div class="sidebar-content -tags">

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Courses</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Learn</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Online</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Education</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">LMS</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Training</a>
                            </div>

                        </div>
                    </div>

                    <div class="sidebar__item">
                        <h5 class="sidebar__title">Filter by price</h5>

                        <div class="sidebar-content -slider">
                            <div class="js-price-rangeSlider">
                                <div class="px-5">
                                    <div class="js-slider"></div>
                                </div>

                                <div class="mt-25">
                                    <div class="d-flex items-center justify-between text-14">
                                        <span>Min Price: <span class="js-lower"></span></span>
                                        <span>Max Price: <span class="js-upper"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar__item">
                        <h5 class="sidebar__title">Tags</h5>

                        <div class="sidebar-content -tags">

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Courses</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Learn</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Online</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Education</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">LMS</a>
                            </div>

                            <div class="sidebar-tag">
                                <a class="text-11 fw-500 text-dark-1" href="#">Training</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-12" data-anim="slide-up delay-3">
                <div class="row c justify-between items-center d-none">
                    <div class="col-auto d-non">
                        <div class="text-14">
                            Showing <span class="fw-500 text-dark-1">250</span> total results
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="d-flex items-center">
                            <div class="fw-500 text-dark-1 mr-20">Sort by:</div>

                            <div class="dropdown js-shop-dropdown">
                                <div class="d-flex items-center text-14">
                                    <span class="js-dropdown-title">Default Sorting</span>
                                    <i class="icon size-20 ml-40" data-feather="chevron-down"></i>
                                </div>

                                <div class="dropdown__item">
                                    <div class="text-14 y-gap-15 js-dropdown-list">
                                        <div>
                                            <a class="d-block decoration-none js-dropdown-link" href="#">Default
                                                Sorting</a>
                                        </div>
                                        <div>
                                            <a class="d-block decoration-none js-dropdown-link" href="#">Clothing</a>
                                        </div>
                                        <div>
                                            <a class="d-block decoration-none js-dropdown-link" href="#">Glasses</a>
                                        </div>
                                        <div>
                                            <a class="d-block decoration-none js-dropdown-link" href="#">T-Shirts</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row y-gap-30 pt-">
                    <?php
                    $prodsql = mysqli_query($conn, "SELECT * FROM products WHERE productcategory = '$category_id'");
                    $count_row_products = mysqli_num_rows($prodsql);
                    if ($count_row_products > 0) {
                        while ($row_prod = mysqli_fetch_assoc($prodsql)) {
                            $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
                            $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
                            $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
                            $original_price = '&#8358;' . number_format($price);
                            $discounted_price = '&#8358;' . number_format($dis_price);
                            $product_id = $row_prod['productid'];

                            $availability = $row_prod['availability'];

                            // Get the thumbnail image
                            $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
                            $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
                            // $image_path_thumbnail = 'admin/' . $row_prod_img_thumbnail['image_path'];
                            // $product_img = $image_path_thumbnail;

                            // // Get the non-thumbnail images
                            // $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
                            // $other_images = [];
                            // while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                            //     $other_images[] = 'admin/' . $row_prod_img['image_path'];
                            //     // $other_images[] += $row_prod_img['image_path'];
                            // }

                            $image_path_thumbnail = $row_prod_img_thumbnail['image_path'];
                            if (empty($image_path_thumbnail)) {
                                $image_path_thumbnail2 = DEFAULT_IMG;
                            }else{
                                $image_path_thumbnail2 = $row_prod_img_thumbnail['image_path'];
                            }
                            $image_path_thumbnail = 'admin/' . $image_path_thumbnail2;
    
    
    
                            // Get the non-thumbnail images
                            $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
                            $other_images = [];
                            while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                                $other_images[] = 'admin/' . $row_prod_img['image_path'];
                                // $other_images[] += $row_prod_img['image_path'];
                            }


                            include 'comp/products.php';
                        }
                    } else {
                    ?>
                        <section class="layout-pt-lg layout-pb-lg section-bg mt-30">
                            <div class="section-bg__item bg-light-6"></div>
                            <div class="container">
                                <div class="row y-gap-20 justify-center text-center">
                                    <div class="col-auto">
                                        <div class="sectionTitle ">
                                            <h2 class="sectionTitle__title ">No Products in this Category</h2>
                                            <p class="sectionTitle__text h4 pt-15">
                                                There are no products in this category yet!
                                                <br>
                                                Please check the other products we have in store.
                                            </p>
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
                    <?php
                    }
                    ?>
                </div>

                <div class="row justify-center pt-60 lg:pt-40 d-none">
                    <div class="col-auto">
                        <div class="pagination -buttons">
                            <button class="pagination__button -prev">
                                <i class="icon icon-chevron-left"></i>
                            </button>

                            <div class="pagination__count">
                                <a href="#">1</a>
                                <a class="-count-is-active" href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">67</a>
                            </div>

                            <button class="pagination__button -next">
                                <i class="icon icon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



<?php
include_once "comp/cart.php";
include_once "comp/footer.php";
include_once "comp/tail.php";
?>