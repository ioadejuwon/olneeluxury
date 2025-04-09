<?php
include_once "admin/inc/config.php";
include_once "admin/inc/drc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="MartVille Technologies">

    <meta name="description" content="Experience the Perfect Blend of Style and Comfort with our Premium Men’s Fabric." />
    <meta property="og:title" content="<?php echo $pagetitle . ' - Olnee Luxury' ?>" />
    <meta property="og:url" content="https://olneeluxury.com" />
    <meta name="og:description" content="Experience the Perfect Blend of Style and Comfort with our Premium Men’s Fabric." />

    <meta name="twitter:site" content="@" />
    <meta name="twitter:card" content="summary" />

    <meta name="application-name" content="Olnee Luxury" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Olnee Luxury" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="theme-color" content="#ffffff" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff" />
    <!-- <meta name="facebook-domain-verification" content="znfjwpevns3jhyzsnxuulz5q86paei"/> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="viewport" content="height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="admin/assets/img/fav.png">
    <link rel="icon" type="image/png" href="admin/assets/img/fav.png">
    <!-- <link rel="manifest" href="favicon/site.html"> -->
    <link rel="mask-icon" href="admin/assets/img/fav.png" color="#0010f7">

    <!-- Google fonts -->
    <link rel="preconnect" href="admin/assets/fonts.googleapis.com/index.html">
    <link rel="preconnect" href="admin/assets/fonts.gstatic.com/index.html" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="admin/assets/cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css" />
    <link rel="stylesheet" href="admin/assets/cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <link href="admin/assets/fonts.googleapis.com/css2f511.css?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="admin/assets/unpkg.com/leaflet%401.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="admin/assets/css/vendors.css">
    <link rel="stylesheet" href="admin/assets/css/main.css">
    <link rel="stylesheet" href="admin/assets/css/styles141.css">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">

    <!-- Page loading scripts-->
    <script src="admin/assets/js/pageloader.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script type="text/javascript" src="admin/assets/js/jquery.min.js"></script>
    <script src="admin/assets/js/vendors.js"></script>
    <title><?php echo $pagetitle; ?> - Olnee Luxury</title>
</head>

<body class="preloader-visible" data-barba="wrapper">
    <!-- preloader start -->
    <div class="progress-container js-preloader">
        <div class="progress-bar"></div>
    </div>
    <!-- preloader end -->
    <main class="main-content">

        <!-- <div class="scrolling-message">
            <div class="message-wrapper">
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
                <span class="message-text">This is a scrolling message at the top of the website. You can close it!</span>
            </div>
            <button class="close-btn-notification">
                <img src="admin/assets/img/icons/close-wh.png" alt="close" width="50%">
            </button>
        </div> -->

        <div class="scrolling-message" id="scrollingMessage">
            <div class="message-wrapper">
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
                <span class="message-text">🔥 Don't miss our flash sale! 50% off all items for the next 24 hours! 🔥</span>
            </div>
            <button class="close-btn-notification" id="closeBanner">
                <img src="admin/assets/img/icons/close-wh.png" alt="close" width="50%">
            </button>
        </div>