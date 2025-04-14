<?php
include_once 'config.php';
include_once 'randno.php';
include_once 'drc.php';
session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoryname'])) {
// $category_name = mysqli_real_escape_string($conn, $_POST['categoryname']); // Get the category name from the form
// $category_id = generateCategoryID(); // Use the generate function from randno.php

// // Use a prepared statement to prevent SQL injection
// $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_categories WHERE categoryName = ?");
// $stmt->bind_param("s", $category_name);
// $stmt->execute();
// $stmt->bind_result($count_row);
// $stmt->fetch();
// $stmt->close();

// if ($count_row > 0) {
//     echo json_encode(['status' => 'error', 'message' => 'Category already exists!']);
//     exit;
// }
//     // $sql = "INSERT INTO olnee_categories (categoryid, categoryName) VALUES ('$category_id', '$category_name')";
//     $stmt = $conn->prepare("INSERT INTO olnee_categories (categoryid, categoryimg, categoryName) VALUES (?, ?, ?)");
//     $stmt->bind_param("sss", $category_id, $category_img, $category_name);

//     if ($stmt->execute()) {
//         echo json_encode(['status' => 'success', 'message' => 'Category created successfully!']);
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
//         exit;
//     }
//     $stmt->close();
//     $conn->close();
// } else {
//     echo json_encode(['status' => 'error', 'message' => 'Invalid request!']);
//     exit;
// }


header('Content-Type: application/json'); // Ensure the content type is JSON

$response = []; // Initialize response array


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $name = $_POST['categoryname'];

    if (!isset($_FILES['categoryimg'])) {
        $response = [
            'status' => 'error',
            'message' => 'No image uploaded.'
        ];
        echo json_encode($response);
        exit;
    }
    if (isset($_POST['categoryname']) && $_POST['categoryname'] == '') {
        $response = [
            'status' => 'error',
            'message' => 'Category name is required.'
        ];
        echo json_encode($response);
        exit;
    }
    if ($_FILES['categoryimg']['error'] !== UPLOAD_ERR_OK) {
        $response = ['status' => 'error', 'message' => 'File upload error'];
        echo json_encode($response);
        exit;
    }
    if ($_FILES['categoryimg']['size'] > 3145728) { // 3MB
        $response = [
            'status' => 'error',
            'message' => 'File size exceeds limit'
        ];
        echo json_encode($response);
        exit;
    }
    if (!in_array(strtolower(pathinfo($_FILES['categoryimg']['name'], PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
        $response = [
            'status' => 'error',
            'message' => 'Invalid file type'
        ];
        echo json_encode($response);
        exit;
    }

    $category_name = mysqli_real_escape_string($conn, $_POST['categoryname']); // Get the category name from the form


    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_categories WHERE categoryName = ?");
    $stmt->bind_param("s", $category_name);
    $stmt->execute();
    $stmt->bind_result($count_row);
    $stmt->fetch();
    $stmt->close();

    if ($count_row > 0) {
        $response = [
            'status' => 'error',
            'message' => 'Category already exists!'
        ];
        echo json_encode($response);
        exit;
    }


    // $image = $_FILES['categoryimg'];

    $uploadLocation = CATEGORY_IMG_DIR; // Make sure this directory exists and is writable
    $uploadDir = '../' . $uploadLocation; // Make sure this directory exists and is writable

    // $uploadDir = 'category-img/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Creates the folder with full permissions (adjust as needed)
    }
    $category_id = generateCategoryID(); // Use the generate function from randno.php

    // $uploadPath = $uploadDir . basename($image['name']);

    // Extract file details
    $fileName = $_FILES['categoryimg']['name'];
    $fileTmpName = $_FILES['categoryimg']['tmp_name'];
    $fileSize = $_FILES['categoryimg']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $uniqueName = $category_id . '-' . generateCatID(); // Generate a unique ID
    $newFileName = $uniqueName . '.' . $fileType; // Append file extension
    $targetFile = $uploadDir . $newFileName;
    $FileLocation = $uploadLocation . $newFileName;


    if (move_uploaded_file($fileTmpName, $targetFile)) {
        // $sql = "INSERT INTO olnee_categories (categoryid, categoryName) VALUES ('$category_id', '$category_name')";
        $stmt = $conn->prepare("INSERT INTO olnee_categories (categoryid, categoryimg, categoryName) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $category_id, $FileLocation, $category_name);

        // if ($stmt->execute()) {
        //     echo json_encode(['status' => 'success', 'message' => 'Category created successfully!']);
        // } else {
        //     echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
        //     exit;
        // }

        if ($stmt->execute()) {
            $response = [
                'status' => 'success',
                'message' => 'Category created successfully!',
                'category_id' => $category_id
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error: ' . $stmt->error
            ];
        }
        echo json_encode($response);
        exit;

        // echo json_encode(['status' => 'success', 'message' => 'Uploaded successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Upload failed']);
    }
}
echo json_encode($response); // Send JSON response
mysqli_close($conn);
