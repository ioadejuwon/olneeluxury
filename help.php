<?php
$pagetitle = "Order";
include_once "comp/head.php";
include_once "comp/header.php"
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





<section class="layout-pb-lg mt-25">
    <div data-anim-wrap class="container">
        <div class="row justify-center text-center">
            <div class="col-xl-6 col-lg-8">
                <form class="form-single-field -help" action="">
                    <input type="text" placeholder="Enter a question, topic or keyword">
                    <button class="button -purple-1 text-white" type="submit">
                        <i class="icon-search text-20 mr-15"></i>
                        Search
                    </button>
                </form>
            </div>
        </div>

        <div class="row y-gap-30 justify-between pt-90 lg:pt-50">

            <div class="col-lg-4 col-md-6">
                <div class="py-40 px-45 rounded-16 bg-light-4">
                    <div class="d-flex justify-center items-center size-70 rounded-full bg-white">
                        <img src="img/help-center/1.svg" alt="icon">
                    </div>
                    <h4 class="text-20 lh-11 fw-500 mt-25">Getting Started</h4>
                    <p class="mt-10">Lorem ipsum is placeholder text commonly used in site.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="py-40 px-45 rounded-16 bg-light-4">
                    <div class="d-flex justify-center items-center size-70 rounded-full bg-white">
                        <img src="img/help-center/2.svg" alt="icon">
                    </div>
                    <h4 class="text-20 lh-11 fw-500 mt-25">Account / Profile</h4>
                    <p class="mt-10">Lorem ipsum is placeholder text commonly used in site.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="py-40 px-45 rounded-16 bg-light-4">
                    <div class="d-flex justify-center items-center size-70 rounded-full bg-white">
                        <img src="img/help-center/3.svg" alt="icon">
                    </div>
                    <h4 class="text-20 lh-11 fw-500 mt-25">Troubleshooting</h4>
                    <p class="mt-10">Lorem ipsum is placeholder text commonly used in site.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="py-40 px-45 rounded-16 bg-light-4">
                    <div class="d-flex justify-center items-center size-70 rounded-full bg-white">
                        <img src="img/help-center/4.svg" alt="icon">
                    </div>
                    <h4 class="text-20 lh-11 fw-500 mt-25">Purchase / Refunds</h4>
                    <p class="mt-10">Lorem ipsum is placeholder text commonly used in site.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="py-40 px-45 rounded-16 bg-light-4">
                    <div class="d-flex justify-center items-center size-70 rounded-full bg-white">
                        <img src="img/help-center/5.svg" alt="icon">
                    </div>
                    <h4 class="text-20 lh-11 fw-500 mt-25">Course Taking</h4>
                    <p class="mt-10">Lorem ipsum is placeholder text commonly used in site.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="py-40 px-45 rounded-16 bg-light-4">
                    <div class="d-flex justify-center items-center size-70 rounded-full bg-white">
                        <img src="img/help-center/6.svg" alt="icon">
                    </div>
                    <h4 class="text-20 lh-11 fw-500 mt-25">Mobile General</h4>
                    <p class="mt-10">Lorem ipsum is placeholder text commonly used in site.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="layout-pt-lg layout-pb-lg bg-light-4">
    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-xl-8 col-lg-9 col-md-11">

                <div class="sectionTitle ">

                    <h2 class="sectionTitle__title ">Frequently Asked Questions.</h2>

                    <p class="sectionTitle__text ">Some of our Frequently Asked Questions</p>

                </div>


                <div class="accordion -block text-left pt-60 lg:pt-40 js-accordion">

                    <div class="accordion__item">
                        <div class="accordion__button">
                            <div class="accordion__icon">
                                <div class="icon" data-feather="plus"></div>
                                <div class="icon" data-feather="minus"></div>
                            </div>
                            <span class="text-17 fw-500 text-dark-1">Do you offer discount?</span>
                        </div>

                        <div class="accordion__content">
                            <div class="accordion__content__inner">
                                <p>
                                    Yes, we do. We announce our discounts on our social media pages.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <div class="accordion__button">
                            <div class="accordion__icon">
                                <div class="icon" data-feather="plus"></div>
                                <div class="icon" data-feather="minus"></div>
                            </div>
                            <span class="text-17 fw-500 text-dark-1">What is the course refund policy?</span>
                        </div>

                        <div class="accordion__content">
                            <div class="accordion__content__inner">
                                <p>
                                    We offer refunds within 30 days of purchase if you are not satisfied with the course. Please contact our support team for assistance.
                                </p>
                            </div>
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