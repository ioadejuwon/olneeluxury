<?php
include_once 'config.php'; // Include your database configuration
include_once 'randno.php';
include_once 'drc.php';

header('Content-Type: application/json'); // Ensure the content type is JSON

$response = []; // Initialize response array

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadLocation = CUSTOMERS_IMG_DIR; // Make sure this directory exists and is writable
    $uploadDir = '../' . $uploadLocation; // Make sure this directory exists and is writable

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Creates the folder with full permissions (adjust as needed)
    }
    $cam_id = generateCamID(); // Generate a unique ID for the image
    // Extract file details
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Generate a unique name for the file
    $uniqueName =   'ctm-' . generateImageID(); // Generate a unique ID
    $newFileName = $uniqueName . '.' . $fileType; // Append file extension
    $targetFile = $uploadDir . $newFileName;
    $FileLocation = $uploadLocation . $newFileName;

    // Validate file type and size
    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']) && $fileSize <= 3145728) { // 3MB
        if (move_uploaded_file($fileTmpName, $targetFile)) {
            // Insert file path into the database
            $sql = "INSERT INTO olnee_customer_cam (img_id, image_path) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $cam_id, $FileLocation);
            if (mysqli_stmt_execute($stmt)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Image uploaded successfully.',
                    'img_id' => $cam_id,
                    'img_path' => $FileLocation  // Add this so JS can use it
                ];
                // $response = ['status' => 'success', 'message' => 'Image uploaded successfully.', 'img_id' => $cam_id];
            } else {
                $response = ['status' => 'error', 'message' => 'Database error: ' . mysqli_stmt_error($stmt)];
                echo json_encode($response);
                exit;
            }
            mysqli_stmt_close($stmt);
        } else {
            $response = ['status' => 'error', 'message' => 'Error moving uploaded file.'];
            echo json_encode($response);
            exit;
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid file type or size.'];
        echo json_encode($response);
        exit;
    }
} else {
    $response = ['status' => 'error', 'message' => 'No file uploaded or file upload error.'];
    echo json_encode($response);
    exit;
}

echo json_encode($response); // Send JSON response
mysqli_close($conn);