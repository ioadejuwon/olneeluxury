<?php
include_once '../inc/config.php'; // Include your database configuration
include_once '../inc/drc.php'; // Include your database configuration

$imgdelete_id = mysqli_real_escape_string($conn, $_GET['productid']);
if(isset($_GET['productid'])){

    if($imgdelete_id){
        if(isset($_GET['img_id'])){
            $imglink = mysqli_real_escape_string($conn, $_GET['img_id']);

            $selectprod_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '{$imgdelete_id}' AND img_id = '{$imglink}'");
            $pimgrowdelete = mysqli_fetch_assoc($selectprod_img); // Fetch the result

            if ($pimgrowdelete) {

                $img = '../' . $pimgrowdelete['image_path'];
                unlink($img); // Delete the image file
            }
            if($pimgrowdelete['thumbnail'] == 1){
                $sqlUpdate = "UPDATE product_images SET thumbnail = 1 WHERE product_id = ?";
                $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
                mysqli_stmt_bind_param($stmtUpdate, "s", $imgdelete_id); // Change 'i' to 's' for string
                if (mysqli_stmt_execute($stmtUpdate)) {
                    mysqli_commit($conn); // Commit transaction
                }
            }

            $sql2 = mysqli_query($conn, "DELETE FROM product_images WHERE img_id = '{$imglink}' AND product_id = '{$imgdelete_id}'");
            if($sql2){
                header("Location: ".EDIT_PRODUCT.'?productid='.$imgdelete_id);

            }
        }
    }
} else {
    header("Location: ".EDIT_PRODUCT.'?productid='.$imgdelete_id);
}
