<?php
session_start();
include_once "inc/config.php";
$pagetitle = "Settings";
include_once "inc/drc.php";
if (!isset($_SESSION['user_id'])) {
    header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
    exit; // Make sure to exit after sending the redirection header
} else {
    $user_id = $_SESSION['user_id'];
}
include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";
$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
$row = mysqli_fetch_assoc($sql);
// $unique_id = $row["user_id"];
$fname = !empty($row["fname"]) ? $row["fname"] : "No info entered";
$lname = !empty($row["fname"]) ? $row["lname"] : "No info entered";
$uname = !empty($row["fname"]) ? $row["uname"] : "No info entered";
// $countryCode = $row['countryCode'];
$admin_phone = $row['admin_phone'];
$admin_phone = (!empty($phoneNumber)) ?  $phoneNumber : 'No phone number entered';
$admin_email = $row['admin_email'];
$admin_email = !empty($admin_email) ? $admin_email : "No admin email entered";

$admin_address = $row['admin_address'];
$admin_state = $row['admin_state'];
$admin_country = $row['admin_country'];

$address = $admin_address. ", ". $admin_state. ", ". $admin_country;
$address = strlen($address > 4) ? $address : "No address entered";
// $address = !empty($address) ? $address : "No address entered";



$sql_store = mysqli_query($conn, "SELECT * FROM olnee_storedata");
$row_store = mysqli_fetch_assoc($sql_store);
// $unique_id = $row["user_id"];

$contact_phone = $row_store['contact_phone'];

$contact_email = $row_store['contact_email'];
$contact_email = !empty($contact_email) ? $contact_email : "No contact email entered";

$store_address = $row_store['store_address'];
$store_address = !empty($store_address) ? $store_address : "No store address entered";

$store_state = $row_store['store_state'];
$store_state = !empty($store_state) ? $store_state : "No store state entered";

$store_country = $row_store['store_country'];
$store_country = !empty($store_country) ? $store_country : "No store country entered";

$delivery = !empty($row_store["deliveryPolicy"]) ? $row_store["deliveryPolicy"] : "No Delivery Policy entered";
$return = !empty($row_store["returnPolicy"]) ? $row_store["returnPolicy"] : "No Return Policy entered";
?>
<?php include_once "ad_comp/adm-sidebar.php" ?>
<div class="dashboard__content bg-light-4">
    <div class="row pb- mb-10">
        <div class="col-auto">
            <h2 class="text- lh-12 fw-700">Settings </h2>
            <div class="mt-5">Your can check your store settings.</div>
        </div>
    </div>
    <div class="row y-gap-30">
        <div class="col-12">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                <div class="tabs -active-deep-green-2 js-tabs pt-0">
                    <div
                        class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls pb-8">
                        <button class="tabs__button text-light-1 js-tabs-button is-active"
                            data-tab-target=".-tab-item-0" type="button">
                            Profile
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button d-none"
                            data-tab-target=".-tab-item-1" type="button">
                            Edit Profile
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-2"
                            type="button">
                            Store information
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-3"
                            type="button">
                            Change Password
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button d-none" data-tab-target=".-tab-item-4"
                            type="button">
                            Social Profiles
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button d-none" data-tab-target=".-tab-item-5"
                            type="button">
                            Notifications
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button d-none" data-tab-target=".-tab-item-6"
                            type="button">
                            Close Account
                        </button>
                    </div>
                    <div class="tabs__content py-30 px-30 js-tabs-content">
                        <div class="tabs__pane -tab-item-0 is-active">
                            <div class="row y-gap-20 x-gap-20 items-center">
                                <div class="col-auto">
                                    <img class="size-100" src="assets/img/fav.png" alt="image">
                                </div>
                                <div class="col-auto">
                                    <div class="text-20 fw-500 text-dark-1"><?php echo $fname . " " . $lname ?></div>
                                    <div class="text-14 lh-1 mt-10">PNG or JPG no bigger than 800px wide and tall.</div>
                                </div>
                            </div>
                            <div class="border-top-light pt-30 mt-30">
                                <div class="contact-form row y-gap-30">
                                    <div class="text-20 fw-500 text-dark-1">Personal Information</div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">First Name</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $fname; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Last Name</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $lname; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Email</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $admin_email; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Phone</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $admin_phone; ?> </div>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Admin Type</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $admin_type ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Address</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $address; ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-1">
                            <div class="row y-gap-20 x-gap-20 items-center d-none">
                                <div class="col-auto">
                                    <img class="size-100" src="assets/img/dashboard/edit/1.png" alt="image">
                                </div>
                                <div class="col-auto">
                                    <div class="text-16 fw-500 text-dark-1">Your avatar</div>
                                    <div class="text-14 lh-1 mt-10">PNG or JPG no bigger than 800px wide and tall.</div>
                                    <div class="d-flex x-gap-10 y-gap-10 flex-wrap pt-15">
                                        <div>
                                            <div
                                                class="d-flex justify-center items-center size-40 rounded-8 bg-light-3">
                                                <div class="icon-cloud text-16"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div
                                                class="d-flex justify-center items-center size-40 rounded-8 bg-light-3">
                                                <div class="icon-bin text-16"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top-light">
                                <form action="#" class="contact-form row y-gap-10">
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">First Name</label>
                                        <input type="text" value="<?php echo $fname; ?>" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Last Name</label>
                                        <input type="text" value="<?php echo $lname; ?>" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone</label>
                                        <input type="number" value="<?php echo $admin_phone; ?>" placeholder="Phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email Address</label>
                                        <input type="email" name="admin_email" value="<?php echo $admin_email; ?>" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Address</label>
                                        <input type="email" name="admin_address" value="<?php echo $admin_address; ?>" placeholder=" Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State</label>
                                        <input type="email" name="admin_state" value="<?php echo $admin_state; ?>" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country</label>
                                        <input type="email" name="admin_country" value="<?php echo $admin_country; ?>" placeholder="Country">
                                    </div>

                                    
                                    <div class="col-12">
                                        <button class="button -md -deep-green-1 text-white">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tabs__pane -tab-item-2">

                            <div>
                                <form action="" method="POST" id="store-update" class="contact-form row y-gap-10">
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone</label>
                                        <input type="number" name="contact_phone" value="<?php echo $contact_phone; ?>" placeholder="Contact Phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email</label>
                                        <input type="email" name="contact_email" value="<?php echo $contact_email; ?>" placeholder="Contact Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Address</label>
                                        <input type="text" name="store_address" value="<?php echo $store_address; ?>" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State</label>
                                        <input type="text" name="store_state" value="<?php echo $store_state; ?>" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country</label>
                                        <input type="text" name="store_country" value="<?php echo $store_country; ?>" placeholder="Country">
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Policy</label>
                                        <textarea placeholder="Text..." name="delivery" value="" rows="7"><?php echo $delivery; ?></textarea>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Return Policy</label>
                                        <textarea placeholder="Text..." name="return" value="" rows="7"><?php echo $return; ?></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button class="button -md -deep-green-1 text-white">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tabs__pane -tab-item-3">
                            <form action="#" class="contact-form row y-gap-30">
                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Current password</label>
                                    <input type="text" placeholder="Current password">
                                </div>
                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">New password</label>
                                    <input type="text" placeholder="New password">
                                </div>
                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Confirm New Password</label>
                                    <input type="text" placeholder="Confirm New Password">
                                </div>
                                <div class="col-12">
                                    <button class="button -md -deep-green-1 text-white">Save Password</button>
                                </div>
                            </form>
                        </div>
                        <div class="tabs__pane -tab-item-4">
                            <form action="#" class="contact-form row y-gap-30">
                                <div class="col-md-6">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Twitter</label>
                                    <input type="text" placeholder="Twitter Profile">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Facebook</label>
                                    <input type="text" placeholder="Facebook Profile">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Instagram</label>
                                    <input type="text" placeholder="Instagram Profile">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">LinkedIn Profile URL</label>
                                    <input type="text" placeholder="LinkedIn Profile">
                                </div>
                                <div class="col-12">
                                    <button class="button -md -terabyte-1 text-white">Save Social Profile</button>
                                </div>
                            </form>
                        </div>
                        <div class="tabs__pane -tab-item-5">
                            <form action="#" class="contact-form">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-16 fw-500 text-dark-1">Notifications - Choose when and how to
                                            be notified</div>
                                        <p class="text-14 lh-13 mt-5">Select push and email notifications you'd like to
                                            receive</p>
                                    </div>
                                </div>
                                <div class="pt-60">
                                    <div class="row y-gap-20 justify-between">
                                        <div class="col-auto">
                                            <div class="text-16 fw-500 text-dark-1">Choose when and how to be notified
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-30">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Subscriptions</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top-light pt-20 mt-20">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Recommended Courses</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top-light pt-20 mt-20">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Replies to my comments</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top-light pt-20 mt-20">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Activity on my comments</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-60">
                                    <div class="row y-gap-20 justify-between">
                                        <div class="col-auto">
                                            <div class="text-16 fw-500 text-dark-1">Email notifications</div>
                                        </div>
                                    </div>
                                    <div class="pt-30">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Send me emails about my Cursus
                                                    activity and updates I requested</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top-light pt-20 mt-20">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Promotions, course
                                                    recommendations, and helpful resources from Cursus.</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top-light pt-20 mt-20">
                                        <div class="row y-gap-20 justify-between">
                                            <div class="col-auto">
                                                <div class="text-16 fw-500 text-dark-1">Announcements from instructors
                                                    whose course(s) I’m enrolled in.</div>
                                                <p class="text-14 lh-13 mt-5">Notify me about activity from the profiles
                                                    I'm subscribed to</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-switch">
                                                    <div class="switch" data-switch=".js-switch-content">
                                                        <input type="checkbox">
                                                        <span class="switch__slider"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-30">
                                    <div class="col-12">
                                        <button class="button -md -terabyte-1 text-white">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tabs__pane -tab-item-6">
                            <form action="#" class="contact-form row y-gap-30">
                                <div class="col-12">
                                    <div class="text-16 fw-500 text-dark-1">Close account</div>
                                    <p class="mt-10">Warning: If you close your account, you will be unsubscribed from
                                        all your 5 courses, and will lose access forever.</p>
                                </div>
                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Enter Password</label>
                                    <input type="text" placeholder="Enter Password">
                                </div>
                                <div class="col-12">
                                    <button class="button -md -terabyte-1 text-white">Close Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="api/settings.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>