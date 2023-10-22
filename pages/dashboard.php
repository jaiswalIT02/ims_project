<?php

  //dd($_SESSION);
  include('includes/security.php');
  include('includes/header.php'); 
  include('includes/navbar.php'); 

  // echo "<pre>";
  // print_r($_SESSION);
  // exit;

  $co_id = $_SESSION['co_id'];


  $count_user = 0;
  if($_SESSION['desig_id'] == 0){
                                                        
    $sql3 = "SELECT * from `login_master`  WHERE `co_id` = '$co_id' LIMIT 0, 10"; 
  }else if($_SESSION['desig_id'] == 1){
   
    $sql3 = "SELECT  `user_name`, `user_login`, `user_password` , `desig_id` FROM `login_master` WHERE `co_id` = '$co_id' AND `desig_id` != 0 LIMIT 0, 10"; 
  }else{
   
       $sql3 = "SELECT  `user_name`, `user_login`, `user_password` , `desig_id` FROM `login_master` WHERE `co_id` = '$co_id' AND `desig_id`!= 0 AND `desig_id`!= 1 LIMIT 0, 10"; 
  }
  $result = mysqli_query($conn, $sql3);
  $count_user = mysqli_num_rows($result);

  $count_bill = 0;
  $today = date('Y-m-d');  
  $sql = "SELECT * FROM `bill_header` WHERE `co_id`= '$co_id' AND `date` = '$today' ";
  $result1 = mysqli_query($conn, $sql);
  $count_bill = mysqli_num_rows($result1);

?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered User</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total User : <?php echo $count_user; ?></h4><br>

               <center><a href="add_user" class="text-gray text-center"><---></a></center>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Sale Today</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total Bill : <?php echo $count_bill; ?></h4><br>

               <center><a href="view_bill" class="text-gray text-center"><---></a></center>

              </div>
            </div>
            <div class="col-auto">
               <i class="fas fa-dollar-sign fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example 
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><h4>Total Bill : <?php echo $count_bill; ?></h4><br></div>
            </div>

            

            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-black-300"></i>
            </div>

            
            <center><a href="view_bill.php" class="text-gray text-center"></a></center>
          </div>
        </div>
      </div>
    </div> --->

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">10%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Content Row -->




<?php
  include('includes/scripts.php');
  include('includes/footer.php');
?>