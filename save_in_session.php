<?php
session_start();
include('includes/db_connect.php'); 
/* 
if(isset($_GET['company']) )
{
  echo $_GET['company'];
}   

*/

if(isset($_GET['action']) && $_GET['action'] == 'GetSession')
{
    $company = $_GET['company'];

    $product = $_GET['product'];

    $unit = $_GET['unit'];

    $packing = $_GET['packing'];

    $price = $_GET['price'];

    $quantity = $_GET['quantity'];

    $total = $_GET['total_price'];
    
    $arr = array( $company,  $product,  $unit,  $packing,  $quantity,  $price,  $total);
  
    echo json_encode($arr);

if(isset($_SESSION['cart']))
{
  $max = sizeof($_SESSION['cart']);
  $check_available = 0;
  $check_available = check_duplicate_product($company, $product, $unit, $packing);
  $available_qty = 0;
  $check_qty = 0;
  if($check_available == 0)
  {
    $available_qty = check_qty($company, $product, $unit, $packing , $conn);
    if($available_qty >= $qty)
    {
        $b = array("company" => $company, "product" => $product, "unit" => $unit, "packing" => $packing, "quantity" => $quantity);
        array_push($_SESSION['cart'],$b );
    }else
    {
      echo "Enter qurt is not available.";
    }
  }else
  {
    $av_qty = 0 ;
    $exist_qty = 0 ;
    $exist_qty = check_qty($company, $product, $unit ,$packing); 
    $exist_qty = $exist_qty + $qty;
    $av_qty = check_qty($company, $product, $unit ,$packing , $conn);
    if($av_qty >= $exist_qty)
    {
        $check_product_no_session = check_product_no_session($company, $product, $unit ,$packing);
        $b = array("company" => $company, "product" => $product, "unit" => $unit, "packing" => $packing, "quantity" => $quantity);
        $_SESSION['cart'][$check_product_no_session] = $b;
    }
  }
}
/*
else
{
  $available_qty = check_qty($company, $product, $unit, $packing, $conn);
  if($available_qty >= $qty)
  {
      $_SESSION['cart'] = array(array('company' => $company, 'product' => $product, 'unit' =>  $unit, 'packing' => $packing, 'quantity' => $quantity));
  }else
  {
    echo "Enter quantity is not available.";
  }
}
*/
    function check_qty($company, $product, $unit, $packing, $conn)
    {
      $product_qty= 0;
      $res = mysqli_query($conn, "SELECT * FROM `stock_master` WHERE `companyname` = '$company' AND `productname`= '$product' AND `unit` = '$unit' `packing_size` = '$packing' ");
      while($row= mysqli_fetch_array($res)){
        $product_qty = $row['quantity'];
      }
      return $product_qty;
    }

    function check_duplicate_product($company, $product, $unit, $packing)
    {
      $found = 0;
      $max = sizeof($_SESSION['cart']);
      for($i=0;$i <$max; $i++)
      {
          if($_SESSION['cart'][$i])
          {
              $company_session = "";
              $product_session = "";
              $unit_session = "";
              $packing_session = "";

              foreach($_SESSION['cart'][$i] as $key=> $val)
              {
                if($key == "company")
                {
                  $company_session = $val;
                }else if($key == "product")
                {
                  $product_session = $val;
                }else if($key == "unit")
                {
                  $unit_session = $val ;
                }else if($key == "packing")
                {
                  $packing_session = $val;
                }

              }
            if($company_session == $company && $product_session == $product && $unit_session == $unit && $packing_session == $packing)
            {
              $found = $found+1;

            }
          }
      }
      return $found;
    }
  
    function check_quantity($company, $product, $unit, $packing)
    {
      $qty_found = 0;
      $qty_session = 0;

      $max = sizeof($_SESSION['cart']);
      for($i=0;$i <$max; $i++)
      {
          $company_session = "";
          $product_session = "";
          $unit_session = "";
          $packing_session = "";
          if($_SESSION['cart'][$i])
          {
            foreach($_SESSION['cart'][$i] as $key=> $val)
              {
                if($key == "company")
                {
                  $company_session = $val;
                }else if($key == "product")
                {
                  $product_session = $val;
                }else if($key == "unit")
                {
                  $unit_session = $val ;
                }else if($key == "packing")
                {
                  $packing_session = $val;
                }else if($key == "quantity")
                {
                  $qty_session = $val;
                }
              }
            if($company_session == $company && $product_session == $product && $unit_session == $unit && $packing_session == $packing)
            {
              $qty_found = $qty_session;

            }
          }
      }
      return $qty_found;
    }

    function check_product_no_session($company, $product, $unit, $packing)
    {
      $recordno = 0;
      $max = sizeof($_SESSION['cart']);
      for($i=0;$i <$max; $i++)
      {
          if($_SESSION['cart'][$i])
          {
              $company_session = "";
              $product_session = "";
              $unit_session = "";
              $packing_session = "";

              foreach($_SESSION['cart'][$i] as $key=> $val)
              {
                if($key == "company")
                {
                  $company_session = $val;
                }else if($key == "product")
                {
                  $product_session = $val;
                }else if($key == "unit")
                {
                  $unit_session = $val ;
                }else if($key == "packing")
                {
                  $packing_session = $val;
                }

              }
            if($company_session == $company && $product_session == $product && $unit_session == $unit && $packing_session == $packing)
            {
              $recordno = $i;

            }
          }
      }
      return $recordno;
    }
    
}



?>