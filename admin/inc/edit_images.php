<?php
include_once 'config.php'; // Include your database configuration
include_once 'randno.php';
include_once 'drc.php';

header('Content-Type: application/json'); // Ensure the content type is JSON

$response = []; // Initialize response array

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get product ID and generate image ID
    $product_id = $_POST['product_id'];
    $img_id = generateImageID();
    
    // Define upload locations
    $uploadLocation = PRODUCTS_IMG_DIR; // Ensure this directory exists and is writable
    $uploadDir = '../' . $uploadLocation; // Ensure this directory exists and is writable
    
    // Create directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the folder with full permissions (adjust as needed)
    }

    // Extract file details
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    // Generate a unique name for the file
    $uniqueName = $product_id . '-' . generateImageID(); // Generate a unique ID
    $newFileName = $uniqueName . '.' . $fileType; // Append file extension
    $targetFile = $uploadDir . $newFileName;
    $FileLocation = $uploadLocation . $newFileName;

    // Validate file type and size
    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']) && $fileSize <= 3145728) { // 3MB
        // Check image dimensions (optional)
        list($width, $height) = getimagesize($fileTmpName);
        if ($width > 5000 || $height > 5000) {  // Max dimensions (adjust as needed)
            $response = ['status' => 'error', 'message' => 'Image is too large. Maximum dimensions are 5000px by 5000px.'];
            echo json_encode($response);
            exit;
        }
        // Move uploaded file
        if (move_uploaded_file($fileTmpName, $targetFile)) {
            // Insert file path into the database
            $sql = "INSERT INTO product_images (product_id, img_id, image_path, thumbnail) VALUES (?, ?, ?, 0)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $product_id, $img_id, $FileLocation);

            if (mysqli_stmt_execute($stmt)) {
                $response = [
                    'status' => 'success',
                    'message' => 'File uploaded successfully.',
                    'product_id' => $product_id,
                    'file_name' => $newFileName,
                    'file_size' => $fileSize
                ];
            } else {
                $response = ['status' => 'error', 'message' => 'Database error: ' . mysqli_stmt_error($stmt)];
            }
            mysqli_stmt_close($stmt);
        } else {
            $response = ['status' => 'error', 'message' => 'Error moving uploaded file.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid file type or size. Allowed types: jpg, jpeg, png, gif. Max size: 3MB.'];
    }
} else {
    // File upload error or no file uploaded
    $response = ['status' => 'error', 'message' => 'No file uploaded or file upload error.'];
}
echo json_encode($response); // Send JSON response
mysqli_close($conn); // Close database connection