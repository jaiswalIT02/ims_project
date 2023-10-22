
<!DOCTYPE html>
<html lang="en">
  <?php
    include('db_connect.php');
    //echo "<h1>".  basename($_SERVER['PHP_SELF']) . "</h1>";
   
    $pages = basename($_SERVER['PHP_SELF']);
    switch($pages){
    case "index.php": 
    $pages = "Home Page";
    break;
    case "dashboard.php": 
      $pages = "Dashboard";
      break;
    case "add_user.php": 
      $pages = "Manage User";
      break;
    case "add_unit.php": 
      $pages= "Unit Manager";
        break;
    case "party_info.php": 
      $pages= "Party Manager";
      break;
    case "company_info.php": 
      $pages= "Companay Manager";
        break;
    case "add_product.php": 
      $pages= "Product Manager";
      break;
    case "purchage_master.php": 
      $pages= "Purchase Master";
      break;
    case "stock_master.php": 
      $pages= "Stock Master";
      break;
    case "sale_master.php": 
      $pages= "Manage Sale ";
      break;
    case "view_bill.php": 
      $pages= "View Bill ";
      break;
    case "mod_alloc.php": 
      $pages= "Manage Module";
      break;
  }

  ?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  
  <title>  <?php echo $pages;?></title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/toast.min.css" rel="stylesheet">

</head>

<body id="page-top" style="background-color:lightgray;">

  <!-- Page Wrapper -->
  <div id="wrapper">
