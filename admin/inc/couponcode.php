<?php
include_once 'config.php';
include_once "randno.php";
include_once "drc.php";


$response = array(); // Initialize response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['couponname']) || empty($_POST['couponcode']) || empty($_POST['value']) || empty($_POST['couponType']) || empty($_POST['user_id'])) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in the required field';
    } else {
        // Capture and sanitize input
        $user_id = $_POST['user_id'];
        $couponname = $_POST['couponname'];
        $couponcode = $_POST['couponcode'];
        $coupontype = $_POST['couponType'];
        $couponvalue = (int)$_POST['value'];
        $date = date("D., jS M.");

        $couponid = $coupon_id; // Generate a unique ID
        // $category_link = $domainstore . $biz_id . '?category=' . $categoryID;

        // Check if the category already exists using a prepared statement
        $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_coupons WHERE couponCode = ?");
        $stmt->bind_param("s", $couponcode);
        $stmt->execute();
        $stmt->bind_result($count_row);
        $stmt->fetch();
        $stmt->close();

        if($count_row >0){
            $response['status'] = 'error';
            $response['message'] = 'Coupon Code already exists!';
        }elseif (empty($couponcode) || preg_match('/[^a-zA-Z0-9-]/ ', $couponcode)) {
            $response['status'] = 'error';
            $response['message'] = 'Coupon Code - One or more characters is not allowed!';
        }elseif (empty($couponname) || preg_match('/[^a-zA-Z0-9 -%]/ ', $couponname)) {
            $response['status'] = 'error';
            $response['message'] = 'Coupon Name - One or more characters is not allowed!';
        } else {
            // Insert the new category using a prepared statement
            $stmt = $conn->prepare("INSERT INTO olnee_coupons (user_id, coupon_id, couponName, couponCode, couponType, couponValue) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssii", $user_id, $couponid, $couponname, $couponcode, $coupontype, $couponvalue);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Coupon code added successfully!';
                $response['couponname'] = $couponname;
                $response['couponcode'] = $couponcode;
                
                if($coupontype == 1){
                    $response['coupontype'] = 'Percentage Off';
                    $response['couponvalue'] = $couponvalue.'% off';
                }elseif($coupontype == 2){
                    $response['coupontype'] = 'Fixed Amount';
                    // $response['couponpercent'] = 'Free Delivery';
                    $response['couponvalue'] = NAIRA.number_format($couponvalue, 2);
                }
                

                $response['coupondate'] = $date;;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to add coupon code. Please try again.';
            }

            $stmt->close();
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
