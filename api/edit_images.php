<?php
include_once '../inc/config.php'; // Include your database configuration
include_once '../inc/randno.php';

header('Content-Type: application/json'); // Ensure the content type is JSON

$response = []; // Initialize response array

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $product_id = $_POST['product_id'];
    $img_id = $imgID;
    $uploadDir = 'products/'; // Make sure this directory exists and is writable

    // Extract file details
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    // Generate a unique name for the file
    // $uniqueName = uniqid('', true); // Generate a unique ID
    // $newFileName = $uniqueName . '.' . $fileType; // Append file extension
    // $targetFile = $uploadDir . $newFileName;
    $uniqueName = $product_id . '-' . $imgID; // Generate a unique ID
    $newFileName = $uniqueName . '.' . $fileType; // Append file extension
    $targetFile = $uploadDir . $newFileName;

    // Validate file type and size
    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']) && $fileSize <= 3145728) { // 3MB
        if (move_uploaded_file($fileTmpName, "../".$targetFile)) {
            // Insert file path into the database
            $sql = "INSERT INTO product_images (product_id, img_id, image_path, thumbnail) VALUES (?, ?, ?, 0)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $product_id, $img_id, $targetFile);

            if (mysqli_stmt_execute($stmt)) {
                $response = ['status' => 'success', 'message' => 'File uploaded successfully.', 'product_id' => $product_id];
            } else {
                $response = ['status' => 'error', 'message' => 'Database error: ' . mysqli_stmt_error($stmt)];
            }
            mysqli_stmt_close($stmt);
        } else {
            $response = ['status' => 'error', 'message' => 'Error moving uploaded file.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid file type or size.'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'No file uploaded or file upload error.'];
}

mysqli_close($conn);

echo json_encode($response); // Send JSON response
?>
