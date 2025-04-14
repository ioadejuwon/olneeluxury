<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script> -->
<link rel="stylesheet" href="assets/dropzone/dropzone.min.css">
<script src="assets/dropzone/dropzone.min.js"></script>
<style>
  /* .dropzone { */
  /* border: 1px dashed #6c757d; */
  /* background: #f8f9fa; */
  /* padding: 30px; */
  /* text-align: center; */
  /* border-radius: 10px; */
  /* cursor: pointer; */
  /* } */

  .dropzone {
    border: 1px dashed #ccc;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    background-color: #f9f9f9;
  }

  .dropzone .dz-message {
    color: #888 !important;
    font-weight: 500;
  }

  
/* 

  .preview-container {
    margin-top: 10px;
    display: flex;
    flex-direction: row;
    gap: 10px;
    flex-wrap: wrap;
  }

  .dz-preview {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 6px;
    background-color: #f9f9f9;
  }

  .dz-image {
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 4px;
    margin-right: 10px;
  }

  .dz-filename{
    color: black !important;
  }
  .dz-size{
    color: black !important;
  }
  .dz-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .dz-details {
    display: flex;
    flex-direction: column;
  }

  .dz-remove {
    color: red !important;
    cursor: pointer;
    margin-top: 4px;
    font-size: 12px;
  } */
</style>
<?php

session_start();

include_once "inc/config.php";
$pagetitle = "Categories";
include_once "inc/drc.php";
if (!isset($_SESSION['user_id'])) {
  header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
  exit; // Make sure to exit after sending the redirection header
} else {
  $user_id = $_SESSION['user_id'];
}
include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";
$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$user_id}'");
$row = mysqli_fetch_assoc($sql);
$user_id = $row["user_id"];
$fname = $row['fname'];
$categories = mysqli_query($conn, "SELECT * FROM olnee_categories ORDER BY created_at DESC");
?>
<?php include_once "ad_comp/adm-sidebar.php" ?>

<div class="dashboard__content bg-light-4">
  <div class="row pb- justify-between">
    <div class="col-auto">
      <h2 class="text-30 lh-12 fw-700">Product Categories</h2>
      <div class="mt-5">
        Manage your Categories here
      </div>
    </div>
    <div class="col-auto md:mt-10 md:mb-10 mt-5">
      <a data-toggle="modal" data-target="#modal-categories" class="button -icon -deep-green-1 text-white">Add New Category</a>
    </div>
  </div>
  <div class="row y-gap-30 pt-30">
    <div class="col-xl-12 col-md-12">
      <div class="rounded-16 text-white shadow-4 h-100">
        <!-- <div class="text-18 lh-1 text-dark-1 fw-500 mb-30">Table</div> -->
        <table class="table w-1/1">
          <thead>
            <tr>
              <th>Category Name</th>
              <th>No. of Products</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="categoryTableBody">
            <?php
            $count_row_cateegories = mysqli_num_rows($categories);
            if ($count_row_cateegories != 0) {
              while ($row_categories = mysqli_fetch_assoc($categories)) {
                $categoryname = $row_categories['categoryName'];
                $category_id = $row_categories['categoryid'];
                $products_cat = mysqli_query($conn, "SELECT * FROM products WHERE productcategory = '$category_id'");
                // while ($prod_categories = mysqli_fetch_assoc($products_cat)) {
                // $prod_categories = mysqli_fetch_assoc($products_cat);
                $count_row_store = mysqli_num_rows($products_cat);
            ?>
                <tr id="category-<?php echo $category_id; ?>">
                  <td class="name-<?php echo $category_id; ?>"><?php echo $categoryname ?></td>
                  <td><?php echo $count_row_store ?></td>
                  <td class="dropdown">
                    <!-- <img src="assets/img/icons/more_horiz.png" alt="" width="50%"> -->
                    <img src="assets/img/icons/more_horiz.png" alt="" width="50%">
                    <div class="dropdown-content">
                      <a data-toggle="modal" data-target="#edit-<?php echo $category_id; ?>">Edit Category</a>
                      <a class="copyButton" data-info="<?php echo 'Category \'' . $categoryname . '\' link copied' ?>" data-link="<?php echo BASE_URL . $category_id ?>" data-target="#copy-<?php echo $category_id; ?>">Copy Category link</a>
                      <a data-toggle="modal" data-target="#delete-<?php echo $category_id; ?>">Delete</a>
                    </div>
                  </td>
                </tr>

                <div id="modalTableBody">
                  <div class="modal fade" id="delete-<?php echo $category_id; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <!-- <h5 class="modal-title"></h5> -->
                          <h2 class="modal-title h4">Delete Category</h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="assets/img/icons/close.png" alt="close" width="30%">
                          </button>
                        </div>
                        <div class="modal-body p-4">
                          <p class="text-dark">Are you sure you want to delete the category "<span class="fw-600"><?php echo $categoryname ?></span>". This process is irreversible.</p>
                          <p class="text-dark">The products currently listed under the category "<span class="fw-600"><?php echo $categoryname ?></span>" will still be available.</p>
                          <ul class="row gx-4 mt-4">
                            <li class="col-6 d-none">
                              <button class="button -outline-dark-3 -md w-100" data-bs-dismiss="modal">Close</button>
                              <!-- <button class="button -md -deep-green-1 text-white" type="submit" id="submit">nn</button> -->
                            </li>

                            <li class="col-12">
                              <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-category-btn" data-categoryid="<?php echo $category_id; ?>">Delete Category</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="edit-<?php echo $category_id; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="assets/img/icons/close.png" alt="close" width="30%">
                          </button>
                        </div>
                        <div class="modal-body pt-0">
                          <form id="editForm-<?php echo $category_id; ?>" class="editForm contact-form row y-gap-10" data-categoryid="<?php echo $category_id; ?>" enctype="multipart/form-data">
                            <div class="col-12">
                              <label class="form-label text-16 lh-1 fw-500 text-dark-1 mb-2">Category Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="categoryname" id="categoryname-<?php echo $category_id; ?>" value="<?php echo htmlspecialchars($categoryname); ?>" placeholder="Enter category name" required>
                            </div>

                            <div class="col-12 mt-3">
                              <label class="form-label">Category Image</label>
                              <div id="dropzoneEdit-<?php echo $category_id; ?>" class="dropzone dropzoneEdit"></div>
                              <div id="previewContainer-<?php echo $category_id; ?>" class="preview-container"></div>
                            </div>

                            <div class="col-12 mt-4 border-top pt-3">
                              <button class="button -md -deep-green-1 text-white flex-fill" type="submit" id="submit">
                                Edit Category
                              </button>
                            </div>
                          </form>



                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              <?php
              }
            } else {

              ?>
              <tr class="layout-pt-lg layout-pb-lg section-bg mt-30 empty">
                <div class="section-bg__item bg-light-6"></div>
                <td colspan="6" class="container desction">
                  <div class="row y-gap-20 justify-center text-center">
                    <div class="col-auto mt-10">
                      <img class="mb-20" src="assets/img/store.png" style="width:15%">
                      <div class="sectionTitle ">
                        <h2 class="sectionTitle__title ">No Category added!</h2>
                        <p class="sectionTitle__text h4 pt-5">
                          Your product categories will appear here!
                        </p>
                      </div>
                      <div class="row justify-center pt-15">
                        <div class="col-auto">
                          <a data-toggle="modal" data-target="#modal-categories" class="button -icon  -deep-green-1 text-white">
                            Add New Category <i class="icon-arrow-top-right text-13 ml-10"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-categories" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img src="assets/img/icons/close.png" alt="close" width="30%">
        </button>
      </div>
      <div class="modal-body pt-0">
        <form id="categoryForm" class="contact-form row y-gap-10" enctype="multipart/form-data">
          <div class="col-12">
            <label class="text-16 lh-1 fw-500 text-dark-1 mb-2">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="categoryname" id="categoryname" placeholder="Enter category name" required><br><br>
          </div>

          <div class="col-12">
            <label class="text-16 lh-1 fw-500 text-dark-1 mb-2">Category Image <span class="text-danger">*</span></label>
            <div id="dropzoneArea" class="dropzone"></div>
            <div id="previewContainer" class="preview-container"></div>
          </div>
          

          <div class="d-flex w-100  border-top-dark mt-5">
            <button class="button -md -deep-green-1 text-white flex-fill" type="submit" id="submitBtn">
              Add Category
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="api/category5.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>

<!-- <form class="contact-form row y-gap-10 d-none" id="categoryFom" method="POST">

  <div class="col-12" id="">
    <label class="text-16 lh-1 fw-500 text-dark-1 mb-2">Category Name <span class="text-error-1">*</span> </label>
    <input type="text" name="categoryname" id="category" placeholder="Enter the name of the category" required>
  </div>

  <div class="col-12" id="">
    <input type="file" class="form-control" id="categoryimg" name="categoryimg" accept="image/*">
  </div>

  <div class="d-flex w-100  border-top-dark mt-5">
    <button class="button -md -deep-green-1 text-white flex-fill" type="submit" id="submit">
      Add Category
    </button>
  </div>
</form> -->