<?php
require_once 'config.php'; // DB connection & constants
require_once 'randno.php'; // Contains generateCatID()
require_once 'drc.php'; // Contains generateCatID()

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$category_id = $_POST['categoryid'] ?? '';
$category_name = trim($_POST['categoryname'] ?? '');

if (!$category_id || $category_name === '') {
    echo json_encode(['status' => 'error', 'message' => 'Missing category ID or name.']);
    exit;
}

// Sanitize input
$category_name = mysqli_real_escape_string($conn, $category_name);

// Check for duplicate name (excluding current category)
$stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_categories WHERE categoryName = ? AND categoryid != ?");
$stmt->bind_param("ss", $category_name, $category_id);
$stmt->execute();
$stmt->bind_result($duplicate_count);
$stmt->fetch();
$stmt->close();

if ($duplicate_count > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Category name already exists.']);
    exit;
}

// Check if an image was uploaded
if (isset($_FILES['categoryimg']) && $_FILES['categoryimg']['error'] === UPLOAD_ERR_OK) {
    // Validate file
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = $_FILES['categoryimg']['name'];
    $file_tmp = $_FILES['categoryimg']['tmp_name'];
    $file_size = $_FILES['categoryimg']['size'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
        exit;
    }

    if ($file_size > 3145728) { // 3MB
        
    }


    // Fetch the current image path to delete the old image
    $stmt = $conn->prepare("SELECT categoryimg FROM olnee_categories WHERE categoryid = ?");
    $stmt->bind_param("s", $category_id);
    $stmt->execute();
    $stmt->bind_result($old_img_path);
    $stmt->fetch();
    $stmt->close();

    // Unlink the old image if it exists and is a file
    if ($old_img_path) {
        $full_old_img_path = '../' . $old_img_path;
        if (file_exists($full_old_img_path) && is_file($full_old_img_path)) {
            unlink($full_old_img_path);
        }else{
            echo json_encode(['status' => 'error', 'message' => 'Coukd not delete old image']);
        exit;
        }
    }



    // Generate unique name and upload
    $unique_name = $category_id . '-' . generateCatID();
    $new_file_name = $unique_name . '.' . $ext;
    $upload_dir = '../' . CATEGORY_IMG_DIR;
    $upload_path = $upload_dir . $new_file_name;
    $db_file_path = CATEGORY_IMG_DIR . $new_file_name;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!move_uploaded_file($file_tmp, $upload_path)) {
        echo json_encode(['status' => 'error', 'message' => 'Image upload failed']);
        exit;
    }

    // Update both name and image
    $stmt = $conn->prepare("UPDATE olnee_categories SET categoryName = ?, categoryimg = ? WHERE categoryid = ?");
    $stmt->bind_param("sss", $category_name, $db_file_path, $category_id);
} else {
    // No image uploaded: only update name
    $stmt = $conn->prepare("UPDATE olnee_categories SET categoryName = ? WHERE categoryid = ?");
    $stmt->bind_param("ss", $category_name, $category_id);
}

// Execute the update
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Category updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Update failed: ' . $stmt->error]);
}
$stmt->close();
