<?php
include_once 'config.php';

$response = array(); // Initialize response array

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["couponCode"])) {
    $code = trim($_POST["couponCode"]);

    $stmt = $conn->prepare("SELECT couponName, couponType, couponValue FROM olnee_coupons WHERE couponCode = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // echo json_encode([
        //     "status" => 'success',
        //     "discount" => [
        //         "couponName" => $row["couponName"],
        //         "couponType" => $row["couponType"],
        //         "couponValue" => (float) $row["couponValue"]
        //     ]
        // ]);
        $response = [
            "status" => 'success',
            "discount" => [
                "couponName" => $row["couponName"],
                "couponType" => $row["couponType"],
                "couponValue" => (float) $row["couponValue"]
            ]
        ];
    } else {
        $response = [
            "status" => 'error',
            "message" => "Coupon code is invalid or expired."
        ];
    }
    // $stmt->close();
    // $conn->close();
} else {
    $response = [
        "status" => 'error',
        "message" => "Invalid request method or missing couponCode."
    ];
}
echo json_encode($response);
exit;
