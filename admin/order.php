<?php 
    session_start();
    

    include_once "inc/config.php";
    $pagetitle = "Dashboard";
    include_once "inc/drc.php"; 

    

    if(!isset($_SESSION['user_id'])){
        header("location: ".ADMIN_LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
        exit; // Make sure to exit after sending the redirection header
    }else{
      $user_id = $_SESSION['user_id'];
        
    }

    $orders_sql = mysqli_query($conn, "SELECT * FROM olnee_orders WHERE order_id = $order_id");
    $count_row_orders = mysqli_num_rows($orders_sql);
    if($count_row_orders < 1){
      header( "location: ". ORDERS);
    }

    

    include_once "ad_comp/adm-head.php"; 
    include_once "ad_comp/adm-header.php"; 


    $order_id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
    $row = mysqli_fetch_assoc($sql);
    // $user_id = $row["user_id"];

  


    $products_sql = mysqli_query($conn, "SELECT * FROM products ");
    $count_row_product = mysqli_num_rows($products_sql);

    $categories_sql = mysqli_query($conn, "SELECT * FROM olnee_categories");
    $count_row_categories = mysqli_num_rows($categories_sql);


    $total_amount = 0;
  
    while ($row_orders = mysqli_fetch_assoc($orders_sql)) {
                            
      $order_amount = $row_orders['total'];
      // Add the value to the total amount
      $total_amount += $order_amount;

    }
    $total_amount = '&#8358;'.number_format($total_amount,2);
    


    
    include_once "ad_comp/adm-sidebar.php" 
?>

          
      <div class="dashboard__content bg-light-4">
        <div class="row pb- mb-10">
          <div class="col-auto">

            <h1 class="text-30 lh-12 fw-700">Order ID: <?php echo $orderid ?></h1>
            <div class="mt-10">Lorem ipsum dolor sit amet, consectetur.</div>

          </div>
        </div>


        <div class="row y-gap-30">
          <div class="col-xl-4">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Basic Information</h2>
              </div>

              <div class="py-30 px-30">
                <div class="y-gap-30">

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/1.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Darlene Robertson</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/2.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Jane Cooper</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                      <div class="d-flex justify-center items-center size-20 bg-blue-3 rounded-full mt-8">
                        <span class="text-11 lh-1 text-white fw-500">5</span>
                      </div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/3.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Arlene McCoy</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                      <div class="d-flex justify-center items-center size-20 bg-green-5 rounded-full mt-8">
                        <span class="text-11 lh-1 text-white fw-500">2</span>
                      </div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/4.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Albert Flores</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/5.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Cameron Williamson</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                      <div class="d-flex justify-center items-center size-20 bg-yellow-4 rounded-full mt-8">
                        <span class="text-11 lh-1 text-white fw-500">3</span>
                      </div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/6.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Kristin Watson</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/7.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Annette Black</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                    </div>
                  </div>

                  <div class="d-flex justify-between">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/8.png" alt="image" class="size-50">
                      </div>
                      <div class="ml-10">
                        <div class="lh-11 fw-500 text-dark-1">Jacob Jones</div>
                        <div class="text-14 lh-11 mt-5">Head of Development</div>
                      </div>
                    </div>

                    <div class="d-flex items-end flex-column pt-8">
                      <div class="text-13 lh-1">35 mins</div>

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-8">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
              <div class="d-flex items-center justify-between py-20 px-30 border-bottom-light">
                <div class="d-flex items-center">
                  <div class="shrink-0">
                    <img src="img/avatars/small/2.png" alt="image" class="size-50">
                  </div>
                  <div class="ml-10">
                    <div class="lh-11 fw-500 text-dark-1">Arlene McCoy</div>
                    <div class="text-14 lh-11 mt-5">Active</div>
                  </div>
                </div>

                <a href="#" class="text-14 lh-11 fw-500 text-orange-1 underline">Delete Conversation</a>
              </div>

              <div class="py-40 px-40">
                <div class="row y-gap-20">
                  <div class="col-xl-7 col-lg-10">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/4.png" alt="image" class="size-50">
                      </div>
                      <div class="lh-11 fw-500 text-dark-1 ml-10">Albert Flores</div>
                      <div class="text-14 lh-11 ml-10">35 mins</div>
                    </div>
                    <div class="d-inline-block mt-15">
                      <div class="py-20 px-30 bg-light-3 rounded-8">
                        How likely are you to recommend our company to your friends and family?
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-7 offset-xl-5 col-lg-10 offset-lg-2">
                    <div class="d-flex items-center justify-end">
                      <div class="text-14 lh-11 mr-10">35 mins</div>
                      <div class="lh-11 fw-500 text-dark-1 mr-10">You</div>
                      <div class="shrink-0">
                        <img src="img/avatars/small/3.png" alt="image" class="size-50">
                      </div>
                    </div>
                    <div class="d-inline-block mt-15">
                      <div class="py-20 px-30 bg-light-7 -dark-bg-dark-2 text-purple-1 rounded-8 text-right">
                        Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-7 col-lg-10">
                    <div class="d-flex items-center">
                      <div class="shrink-0">
                        <img src="img/avatars/small/6.png" alt="image" class="size-50">
                      </div>
                      <div class="lh-11 fw-500 text-dark-1 ml-10">Cameron Williamson</div>
                      <div class="text-14 lh-11 ml-10">35 mins</div>
                    </div>
                    <div class="d-inline-block mt-15">
                      <div class="py-20 px-30 bg-light-3 rounded-8">
                        Ok, Understood!
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="py-25 px-40 border-top-light">
                <div class="row y-gap-10 justify-between">
                  <div class="col-lg-7">
                    <input class="-dark-bg-dark-1 py-20 w-1/1" type="text" placeholder="Type a Message">
                  </div>
                  <div class="col-auto">
                    <button class="button -md -purple-1 text-white shrink-0">Send Message</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

            
<?php 
    include_once "ad_comp/adm-footer.php"; 
    include_once "ad_comp/adm-tail.php"; 
?>