<?php
// include_once '../inc/config.php';
// include_once "../inc/drc.php";

// $data = json_decode(file_get_contents('php://input'), true);

// if ($data) {
//     $price = $data['price'];
//     $product_id = $data['product_id'];
//     $product_img = $data['product_img'];
//     $cart_id = $data['cart_id'];

//     $stmt = $conn->prepare("INSERT INTO olnee_cart (cart_id, productid, product_img,quantity, price) VALUES (?, ?, ?,1, ?)");
//     $stmt->bind_param("ssss", $cart_id, $product_id, $product_img, $price);

//     if ($stmt->execute()) {
//         echo json_encode(['status' => 'success']);
//     } else {
//         echo json_encode(['status' => 'error', 'message' => $stmt->error]);
//     }

//     $stmt->close();
//     $conn->close();
// } else {
//     echo json_encode(['status' => 'error', 'message' => 'No data received']);
// }
