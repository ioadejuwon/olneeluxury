<?php
// require 'db.php'; // Your database connection file
include_once 'config.php';
include_once "randno.php";
include_once "drc.php";


$response = array(); // Initialize response array

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["couponCode"])) {
    $code = trim($_POST["couponCode"]);

    $stmt = $conn->prepare("SELECT * FROM olnee_coupons WHERE couponCode = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "success" => true,
            "discount" => [
                "couponName" => $row["couponName"],
                "couponType" => $row["couponType"],
                "couponValue" => (float) $row["couponValue"]
            ]
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
