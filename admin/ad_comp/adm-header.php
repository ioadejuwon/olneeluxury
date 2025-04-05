<header class="header -dashboard -dark-bg-dark-1 js-header">
    <div class="header__container py-20 px-30">
        <div class="row justify-between items-center">
            <div class="col-auto">
                <div class="d-flex items-center">
                    <div class="header__explore text-dark-1">
                        <button class="d-flex items-center js-dashboard-home-9-sidebar-toggle text-dark-1">
                            <i class="icon -dark-text-white icon-explore"></i>
                        </button>
                    </div>

                    <div class="header__logo ml-30 md:ml-20">
                        <a data-barba href="<?php echo BASE_URL ?>">
                            <!-- <img class="no-big-screen" src="assets/img/icon.png" alt="logo" width="50px"> -->
                            <!-- <img class="lg:d-none" src="assets/img/icon.png" alt="logo" width="50px"> -->
                            <h2 class="mt-4">Olnee Luxury</h2>

                        </a>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex items-center">

                    <div class="d-flex items-center sm:d-none d-none">

                        <div class="relative">
                            <div class="d-flex items-center text-light-1 justify-center size-50 rounded-16 -hover-dshb-header-light" data-el-toggle=".js-msg-toggle">
                                <i class="text-24 icon icon-email"></i>
                            </div>
                        </div>


                        <div class="relative">
                            <div class="d-flex items-center text-light-1 justify-center size-50 rounded-16 -hover-dshb-header-light cart-toggle-btn">
                                <i class="text-24 icon icon-notification"></i>
                            </div>

                            <div class="dropdown-content cart-dropdown">
                                <div class="toggle-bottom -notifications bg-white -dark-bg-dark-1 shadow-4 border-light rounded-8 mt-10">
                                    <div class="py-30 px-30">
                                        <div class="y-gap-40">

                                            <div class="d-flex items-center ">
                                                <div class="shrink-0">
                                                    <img src="" alt="image">
                                                </div>
                                                <div class="ml-12">
                                                    <h4 class="text-15 lh-1 fw-500">Your resume updated!</h4>
                                                    <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative d-flex items-center ml-10 d-none">
                        <div data-el-toggle=".js-profile-toggle">
                            <img class="size-50 d-none" src="assets/img/icon.png" alt="image">
                        </div>

                        <div class="toggle-element js-profile-toggle">
                            <div class="toggle-bottom -profile bg-white -dark-bg-dark-1 shadow-4 border-light rounded-8 mt-10">
                                <div class="px-30 py-30">

                                    <div class="sidebar -dashboard">

                                        <div class="sidebar__item -is-active -dark-bg-dark-2">
                                            <a href="dashboard.html" class="d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                                                <i class="text-20 icon-discovery mr-15"></i>
                                                Dashboard
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="dshb-courses.html" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-play-button mr-15"></i>
                                                My Courses
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="dshb-bookmarks.html" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-bookmark mr-15"></i>
                                                Bookmarks
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="dshb-messages.html" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-message mr-15"></i>
                                                Messages
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="dshb-listing.html" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-list mr-15"></i>
                                                Create Course
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="dshb-reviews.html" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-comment mr-15"></i>
                                                Reviews
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="dshb-settings.html" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-setting mr-15"></i>
                                                Settings
                                            </a>
                                        </div>

                                        <div class="sidebar__item ">
                                            <a href="#" class="d-flex items-center text-17 lh-1 fw-500 ">
                                                <i class="text-20 icon-power mr-15"></i>
                                                Logout
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="content-wrapper js-content-wrapper">
    <div class="dashboard -home-9 js-dashboard-home-9">


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toggles = document.querySelectorAll("[data-el-toggle]");
                const toggleElements = document.querySelectorAll(".toggle-element");

                toggles.forEach(toggle => {
                    toggle.addEventListener("click", function(event) {
                        event.preventDefault();
                        const targetSelector = this.getAttribute("data-el-toggle");
                        const targetElement = document.querySelector(targetSelector);
                        targetElement.classList.toggle("active");

                        // Close other open dropdowns
                        toggleElements.forEach(element => {
                            if (element !== targetElement) {
                                element.classList.remove("active");
                            }
                        });
                    });
                });

                document.addEventListener("click", function(event) {
                    let isClickInside = false;
                    toggles.forEach(toggle => {
                        const targetSelector = toggle.getAttribute("data-el-toggle");
                        const targetElement = document.querySelector(targetSelector);
                        if (toggle.contains(event.target) || (targetElement && targetElement.contains(event.target))) {
                            isClickInside = true;
                        }
                    });

                    if (!isClickInside) {
                        toggleElements.forEach(element => {
                            element.classList.remove("active");
                        });
                    }
                });
            });
        </script>