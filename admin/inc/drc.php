<?php
// ini_set('session.gc_maxlifetime', 7200); // 2 hours
// session_set_cookie_params(7200);
// session_start();

// $user_id = $_SESSION['user_id'];

$footeryear = date("Y");
define('FOOTERYEAR', $footeryear);

define('NAIRA', '₦');
define('DOLLAR', '$');
define('EURO', '€');

// SMTP DETAILS

define('BRAND_EMAIL', 'admin@olneeluxury.com');
define('REPLY_TO', 'tech@olneeluxury.com');
define('COMPANY', 'Olnee Luxury');
define('MAIL', 'tech@olneeluxury.com');
define('DEFAULT_IMG', 'product-img/product.png');


define('PHONE', '2348108806808');
define('CUSTOMERS_IMG_DIR', 'customers-cam/');
define('PRODUCTS_IMG_DIR', 'product-img/');
define('CATEGORY_IMG_DIR', 'cat-img/');

// Check if the site is running locally or on a hosting site
if ($_SERVER['HTTP_HOST'] == 'localhost:8888') {
    // Local environment
    define('BASE_URL', 'http://localhost:8888/olnee/');
    define('ADMIN_URL', 'http://localhost:8888/olnee/admin/');
}elseif ($_SERVER['HTTP_HOST'] == 'oreoluwas-macbook-pro.local:8888') {
    // Local environment
    define('BASE_URL', 'http://oreoluwas-macbook-pro.local:8888/olnee/');
    define('ADMIN_URL', 'http://oreoluwas-macbook-pro.local:8888/olnee/admin/');
} else {
    // Hosting environment
    define('BASE_URL', 'https://olneeluxury.com/');
    define('ADMIN_URL', 'https://admin.olneeluxury.com/');
}

// Pages
define('HOME', BASE_URL);
define('SHOP', BASE_URL.'catalog');
define('PRODUCT_DETAIILS', BASE_URL.'product?item=');
define('CART', BASE_URL.'cart');
define('WISHLIST', BASE_URL.'wishlist');
define('COLLECTION', BASE_URL.'collections');
define('PICTURES', BASE_URL.'pictures');
define('CATEGORY', BASE_URL.'category?id=');
define('BLOG', BASE_URL.'blog');
define('SEARCH', BASE_URL.'search');
define('CHECKOUT', BASE_URL.'checkout');
define('ORDER', BASE_URL.'order?id=');
define('CONFIRM_PAY', BASE_URL.'inc/conxfirm');
define('ACCOUNT', BASE_URL.'account');
define('LOGIN', BASE_URL.'login');
define('LOGOUT', BASE_URL.'logout');
define('REGISTER', BASE_URL.'register');
define('CONTACT', BASE_URL.'contact');

// define('WHATSAPP_ORDER', 'https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodeURIComponent(data.mainMSG)}');




define('ADMIN_LOGIN', ADMIN_URL.'login');
define('SIGNUP', ADMIN_URL.'signup');
define('DASHBOARD', ADMIN_URL);
define('ADD_PRODUCT', ADMIN_URL.'create');
define('CATEGORIES', ADMIN_URL.'categories');
define('PRODUCTS', ADMIN_URL.'product');
define('REVIEWS', ADMIN_URL.'reviews');
define('ADM_PICTURES', ADMIN_URL.'pictures');
define('ADM_PROFILES', ADMIN_URL.'admin');
define('ORDERS', ADMIN_URL.'orders');
define('DELIVERY', ADMIN_URL.'delivery');
define('COUPON', ADMIN_URL.'coupon');
define('PROFILE', ADMIN_URL.'profile');
define('SETTINGS', ADMIN_URL.'settings');
define('ADD_IMAGE', ADMIN_URL.'image');
define('EDIT_PRODUCT', ADMIN_URL.'edit');
// define('DELETE_PRODUCT', ADMIN_URL.'inc/delete');
// define('DELETE_CAT', BASE_URL.'inc/deletecat');
define('EDIT_THUMBNAIL', ADMIN_URL.'editthumbnail');
define('EDIT_IMAGES', ADMIN_URL.'editimages');
define('ORDER_DETAILS', ADMIN_URL.'order?id=');


define( 'WASHARE', 'https://api.whatsapp.com/send?phone=&text=Check out this product from our store%0D%0A%0D%0A' );
define( 'XSHARE', 'https://twitter.com/intent/tweet?text=Check out this product from our store%0D%0A%0D%0A' );
define( 'TELEGRAMSHARE', 'https://telegram.me/share/url?url=Check%20out%20my%store%0D%0A%0D%0A' );
define( 'FBSHARE', 'https://web.facebook.com/sharer.php?quote=Check out this product from our store%0D%0A%0D%0A' );
define( 'IGSHARE', 'https://www.instagram.com/direct/new/?text=Check out this product from our store%0D%0A%0D%0A' );


define('ADMIN_LOGOUT', ADMIN_URL.'logout'); // Logout Link

// define('LOGOUT', BASE_URL.'logout?id='.$user_id); // Logout Link




$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'; // Get the protocol (http or https)
$host = $_SERVER['HTTP_HOST']; // Get the host (domain name)
$uri = $_SERVER['REQUEST_URI']; // Get the current request URI
$current_url = $protocol . $host . $uri; // Combine the protocol, host, and URI to get the full URL
// echo "Current URL: $current_url"; // Output the current URL
// $t = $pagetitle;


// function timeAgo($datetime, $full = false) {
//     $now = new DateTime(); // Current time
//     $ago = new DateTime($datetime); // Input time
//     $ago->modify('-1 hour'); // Adjust for server being 1 hour behind
//     $diff = $now->diff($ago); // Difference between the two times
//      // Initialize the array!
//      $timeAgo = [];
//     // Time units
//     $units = [
//         'year' => $diff->y,
//         'month' => $diff->m,
//         'day' => $diff->d,
//         'hour' => $diff->h,
//         'minute' => $diff->i,
//         'second' => $diff->s,
//     ];
//     // Filter out empty units
//     foreach ($units as $unit => $value) {
//         if ($value) {
//             $timeAgo[] = $value . ' ' . $unit . ($value > 1 ? 's' : '');
//         }
//     }
//     if (!$full) {
//         $timeAgo = array_slice($timeAgo, 0, 1); // Show only the first non-zero unit
//     }
//     return $timeAgo ? implode(', ', $timeAgo) . ' ago' : 'Just now';
// }

function timeAgo($datetime, $full = false) {
    $now = new DateTime();
    
    // ADD THIS: if it's a number (timestamp), format it
    if (is_numeric($datetime)) {
        $datetime = date('Y-m-d H:i:s', $datetime);
    }

    $ago = new DateTime($datetime);
    // $ago->modify('- hour'); // server adjustment
    $isFuture = $ago > $now;

    $diff = $now->diff($ago);

    $timeAgo = [];

    $units = [
        'year' => $diff->y,
        'month' => $diff->m,
        'day' => $diff->d,
        'hour' => $diff->h,
        'minute' => $diff->i,
        'second' => $diff->s,
    ];
    foreach ($units as $unit => $value) {
        if ($value) {
            $timeAgo[] = $value . ' ' . $unit . ($value > 1 ? 's' : '');
        }
    }
    if (!$full) {
        $timeAgo = array_slice($timeAgo, 0, 1);
    }

    if ($timeAgo) {
        return implode(', ', $timeAgo) . ($isFuture ? ' left' : ' ago');
    } else {
        return 'just now';
    }
}
