<?php

session_start();

include_once "inc/config.php";
$pagetitle = "Profile";
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
$countryCode = $row['countryCode'];
$phoneNumber = $row['phoneNo'];
$phone = $countryCode . $phoneNumber;
$phone = (!empty($countryCode) && !empty($phoneNumber)) ? $countryCode . $phoneNumber : 'No info entered';
$email = $row['email'];
$email = !empty($row["email"]) ? $row["email"] : "No info entered";
?>
<?php include_once "ad_comp/adm-sidebar.php" ?>
<div class="dashboard__content bg-light-4">
    <div class="row pb- mb-10">
        <div class="col-auto">
            <h2 class="text-30 lh-12 fw-700">Profile </h2>
            <div class="mt-5">Your can check your profile details here.</div>
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
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-1"
                            type="button">
                            Edit Profile
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-2"
                            type="button">
                            Password
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button d-none" data-tab-target=".-tab-item-3"
                            type="button">
                            Social Profiles
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button d-none" data-tab-target=".-tab-item-4"
                            type="button">
                            Notifications
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-5"
                            type="button">
                            Close Account
                        </button>
                    </div>
                    <div class="tabs__content py-30 px-30 js-tabs-content">
                        <div class="tabs__pane -tab-item-0 is-active">
                            <div class="row y-gap-20 x-gap-20 items-center">
                                <div class="col-auto">
                                    <!-- <img class="size-100" src="assets/img/dashboard/edit/1.png" alt="image"> -->
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
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $email; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Phone</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $phone; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Address</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $phone; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">State</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $phone; ?> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">Country</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $phone; ?> </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-16 lh-1  text-dark-1 mb-10">About Yourself</div>
                                        <div class="text-18 fw-500 lh-1 mt-10"><?php echo $phone; ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs__pane -tab-item-1">
                            <div class="row y-gap-20 x-gap-20 items-center d-none">
                                <div class="col-auto">
                                    <!-- <img class="size-100" src="assets/img/dashboard/edit/1.png" alt="image"> -->
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
                                <form action="#" class="contact-form row">
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
                                        <input type="text" value="<?php echo $phone; ?>" placeholder="Phone">
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Birthday</label>
                                        <input type="text" placeholder="Birthday">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Address Line 1</label>
                                        <input type="text" value="<?php echo $address; ?>" placeholder="Address Line 1">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State</label>
                                        <input type="text" value="<?php echo $state; ?>" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country</label>
                                        <input type="text" value="<?php echo $country; ?>" placeholder="Country">
                                    </div>
                                    <div class="col-12">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">About Yourself</label>
                                        <textarea placeholder="Text..." value="<?php echo $about; ?>"
                                            rows="7"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="button -md -deep-green-1 text-white">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tabs__pane -tab-item-2">
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
                                    <button class="button -md -terabyte-1 text-white">Save Password</button>
                                </div>
                            </form>
                        </div>
                        <div class="tabs__pane -tab-item-3">
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
                        <div class="tabs__pane -tab-item-4">
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
                        <div class="tabs__pane -tab-item-5">
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
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>