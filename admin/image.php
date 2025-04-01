<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<style>
   .dropzone {
      border: 1px dashed #21565e;
      border-radius: 8px;
      /* padding: 20px; */
      text-align: center;
    }
</style>
<?php 
    session_start();
  
    include_once "../inc/config.php"; 
    $pagetitle = "Add New Product";
    include_once "../inc/drc.php"; 

    
    $product_id = $_GET['productid'];

    $products_num = mysqli_query($conn, "SELECT * FROM products WHERE productid = '$product_id'");
    // $prod_categories = mysqli_fetch_assoc($products_cat);
    $count_row_product = mysqli_num_rows($products_num);

    if(!isset($_SESSION['user_id'])){
      header("location: ".ADMIN_LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
      exit; // Make sure to exit after sending the redirection header
    }elseif($product_id == '' || $count_row_product < 1){
      header("location: ".PRODUCTS);// redirect to login page if not signed in
    }else{
        $user_id = $_SESSION['user_id'];
    }
  
  
  
  include_once "ad_comp/adm-head.php"; 
  include_once "ad_comp/adm-header.php"; 


    // include_once "../inc/add-course.php"; 


    $sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
    $row = mysqli_fetch_assoc($sql);

    $fname = $row['fname'];

    $categories = mysqli_query($conn, "SELECT * FROM olnee_categories");

?>

            
          <?php include_once "ad_comp/adm-sidebar.php" ?>


          <div class="dashboard__content bg-light-4">
              <div class="row pb- mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">Add New Product</h1>
                  <div class="mt-10">You can enter the product information here.</div>

                </div>
              </div>

              <div class="row y-gap-60">
                <div class="col-12">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Product Information</h2>
                    </div>
                  

                    <div class="py-30 px-30">
                    
                      <form action="../api/upload_images.php" class="dropzone" id="product-images-dropzone">
                          <input type="hidden" name="productid" id="product_id" value="<?php echo $_GET['productid']; ?>">
                      </form>
                      <!-- <button type="button" id="upload-button">Upload Images</button> -->

                      <div class="row justify-end">
                          
                        <div id="error-message"></div>
                        <div class="col-auto">
                          <button class="button -md -deep-green-1 text-white" type="submit" id="upload-button">
                            Upload Product
                          </button>
                        </div>
                      </div>


                      
                    </div>
                  </div>
                </div>
              </div>

            </div>



    

            <script src="../api/product.js"></script>
<?php 
    include_once "ad_comp/adm-footer.php"; 
    include_once "ad_comp/adm-tail.php"; 
?>