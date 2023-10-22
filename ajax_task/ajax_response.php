<?php
$prodData = new Product();
$stock = new Stock();

if(isset($_SESSION['co_id'])){
    $co_id = $_SESSION['co_id'];

}
if(isset($_POST['action']) && $_POST['action'] == 'add_product'){
   
    $formdata = $_POST['form_data'];

    $data = ['co_id'=>$co_id,'companyname'=> $formdata['companyname'],
                'productname'=> $formdata['productname'],
                'unit'=> $formdata['unitname'],           
                'packing_size'=> $formdata['packingsize'],
    ];

    if($prodData->addProduct($data)){
        $arr = array('status' => 'Success', 'message' => 'Product added successfully');
    }else{
        $arr = array('status'=> 'Error', 'message' => 'Something error, Try again!');
    }

    echo json_encode($arr);
}

else if(isset($_POST['action']) && $_POST['action'] == 'delete_product'){
    
    
    if($prodData->deleteProduct($_POST['id'])){
        $arr = array('status' => 'Success', 'message' => 'Product deleted successfully');
    }else{
        $arr = array('status'=> 'Error', 'message' => 'Something error, Try again!');
    }

    echo json_encode($arr);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_purchase'){
   
    $formdata = $_POST['form_data'];

   // dd($formdata);

    $data = [   'co_id'=>$co_id,
                'companyname'=> $formdata['companyname'],
                'productname'=> $formdata['productname'],
                'unit'=> $formdata['unit'],    
                'quantity'=> $formdata['quantity'],
                'price'=> $formdata['price'],       
                'partyname'=> $formdata['partyname'],
                'purchasetype'=> $formdata['quantity'],
                'packing_size'=> $formdata['packingsize'],
                'expirydate'=> $formdata['expirydate']
            ];
        
    //dd($data);die;

    if($stock->addPurchase($data)){
        $arr = array('status' => 'Success', 'message' => 'Item purchsed successfully');
    }else{
        $arr = array('status'=> 'Error', 'message' => 'Something error, Try again!');
    }

    echo json_encode($arr);
}

else if(isset($_POST['action']) && $_POST['action'] == 'delete_purchase'){
    
    
    if($stock->deletePurchase($_POST['id'])){
        $arr = array('status' => 'Success', 'message' => 'Item deleted successfully');
    }else{
        $arr = array('status'=> 'Error', 'message' => 'Something error, Try again!');
    }

    echo json_encode($arr);
}

if(isset($_GET['action']) && $_GET['action'] == 'GetProduct')
{
    $value = $_GET['company'];
    $query = "SELECT `companyname`,`productname` FROM `product_info` WHERE `companyname` = '$value' GROUP BY `productname` ";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    echo '<option value="" >Select Product</option>';
    while ($row = mysqli_fetch_array($result))
    {  
        if($row > 0){          
            echo '<option value="'.$row['productname'].'" >'.$row['productname'].'</option>';
        }else{
            echo '<option value="" >"Not Found !"</option>';   
        }
    }  
}

else if (isset($_GET['action']) && $_GET['action'] == 'AllOutlet') 
{
    $sql5 = mysqli_query($conn , "SELECT `UnitId`, `ol_name` FROM `outlet_details` WHERE `co_id`= '$_SESSION[co_id]' ");
    while($rows5 = mysqli_fetch_array($sql5))
    {
        echo'<option value = "'.$rows5['UnitId'].'_'.$rows5['ol_name'].'" selected>'.$rows5['ol_name'].'</option>';
    }
}
   
else if(isset($_GET['action']) && $_GET['action'] == 'GetUnit')
{
    $value = $_GET['product'];
    $query = "SELECT `unit`,`productname` FROM `product_info` WHERE `productname` = '$value' GROUP BY `unit` ORDER BY `productname`";
    $result = mysqli_query($conn, $query);
    
    echo '<option value="" >Select Unit</option>';
    while ($row = mysqli_fetch_array($result))
    {            
        echo '<option value="'.$row['unit'].'" >'.$row['unit'].'</option>';
    } 
}

/*
else if(isset($_GET['action']) && $_GET['action'] == 'GetPrice')
{
    $value = $_GET['price'];
    $query = "SELECT `price` FROM `stock_master` WHERE `price` = '$value'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    //echo '<option value="" >Select Unit</option>';
    while ($row = mysqli_fetch_array($result))
    {            
        echo $row['price'];
    } 
}
*/

else if(isset($_GET['action']) && $_GET['action'] == 'UpdateComapanyDetails')
{
    $update_id= $_GET['id'];

    $companyname = $_GET['companyname'];
    
    $sql = "UPDATE `company_name` SET `companyname` = '$companyname' WHERE `id` = '$update_id'";
    
    if(mysqli_query($conn , $sql))
    {
        $msg = 'Company Details Updated Successfully';
        $sts = 'success';
    }
    else
    {
        $msg = 'Please try again';
        $sts = 'error';
    }

    $arr = array('sts' => $sts, 'msg' => $msg , 'companyname' => $companyname, 'sql' => $sql);
    echo json_encode($arr);
    
}

else if(isset($_GET['action']) && $_GET['action'] == 'UpdateUnitDetails')
{
    $update_id= $_GET['id'];

    $unitname = $_GET['unitname'];
    
    $sql = "UPDATE `unit_master` SET `unitname` = '$unitname' WHERE `id` = '$update_id'";
    
    if(mysqli_query($conn , $sql))
    {
        $msg = 'Unit Details Updated Successfully';
        $sts = 'success';
    }
    else
    {
        $msg = 'Please try again';
        $sts = 'error';
    }

    $arr = array('sts' => $sts, 'msg' => $msg);
    echo json_encode($arr);
    
}

if(isset($_GET['action']) && $_GET['action'] == 'UpdateStockDetails')
{
    $update_id= $_GET['id'];

    $quantity = $_GET['quantity'];

    $price = $_GET['price'];
    
    $sql = "UPDATE `stock_master` SET `quantity` = '$quantity', `price` = '$price' WHERE `id` = '$update_id'";
    
    if(mysqli_query($conn , $sql))
    {
        $msg = 'Stock Details Updated Successfully';
        $sts = 'success';
    }
    else
    {
        $msg = 'Please try again';
        $sts = 'error';
    }

    $arr = array('sts' => $sts, 'msg' => $msg , 'quantity' => $quantity, 'price' => $price,'sql' => $sql);
    echo json_encode($arr);
    
}

if(isset($_GET['action']) && $_GET['action'] == 'UpdatePartyDetails')
{
    $update_id= $_GET['id'];

    $name = $_GET['name'];

    $businessname = $_GET['businessname'];

    $contact = $_GET['contact'];

    $address = $_GET['address'];

    $city = $_GET['city'];
    
    $sql = "UPDATE `party_info` SET `name` = '$name', `businessname` = '$businessname',`contact` = '$contact', `city` = '$city', `address` = '$address' WHERE `id` = '$update_id'";
    
    if(mysqli_query($conn , $sql))
    {
        $msg = 'Party Details Updated Successfully';
        $sts = 'success';
    }
    else
    {
        $msg = 'Please try again';
        $sts = 'error';
    }

    $arr = array('sts' => $sts, 'msg' => $msg , 'name' => $name, 'businessname' => $businessname, 'contact' => $contact, 'address' => $address, 'city' => $city);
    echo json_encode($arr);
    
}

if(isset($_GET['action']) && $_GET['action'] == 'UpdateProductDetails')
{
    $update_id= $_GET['id'];

    $productname = $_GET['productname'];

    $companyname = $_GET['companyname'];

    $unit = $_GET['unit'];

    $packingsize = $_GET['packingsize'];

    
    $sql = "UPDATE `product_info` SET `productname` = '$productname', `companyname` = '$companyname',`unit` = '$unit', `packing_size` = '$packingsize' WHERE `id` = '$update_id'";
    
    if(mysqli_query($conn , $sql))
    {
        $msg = 'Product Details Updated Successfully';
        $sts = 'success';
    }
    else
    {
        $msg = 'Please try again';
        $sts = 'error';
    }

    $arr = array('sts' => $sts, 'msg' => $msg , `productname` => $productname, `companyname` => $companyname, `unit` => $unit, `packing_size` => $packingsize);
    echo json_encode($arr);
    
}

else if(isset($_GET['action']) && $_GET['action'] == 'checkUnitDuplicate')
{
    $unit = $_GET['unit'];

    $sql =  "SELECT `unitname` FROM `unit_master` WHERE `unitname` = '$unit' ";

    $res = mysqli_query($conn, $sql);

    $rowcount=mysqli_num_rows($res);

    echo $rowcount;

}

else if(isset($_GET['action']) && $_GET['action'] == 'checkCompanyDuplicate')
{
    $companyname = $_GET['comp'];

    $sql =  "SELECT `companyname` FROM `company_name` WHERE `companyname` = '$companyname'  ";

    $res = mysqli_query($conn, $sql);

    $rowcount=mysqli_num_rows($res);

    echo $rowcount;

}

else if(isset($_GET['action']) && $_GET['action'] == 'checkProductDuplicate')
{
    $productname = $_GET['prod'];

    $sql =  "SELECT `productname` FROM `product_info` WHERE `productname` = '$productname' ";

    $res = mysqli_query($conn, $sql);

    $rowcount=mysqli_num_rows($res);

    echo $rowcount;

}

else if (isset($_GET['action']) && $_GET['action'] == 'accessmod') 
{

    $dg_sql = "SELECT `co_id`, `desig_id`, `module_filename` FROM `access_master` WHERE `desig_id` = '$_GET[desig_id]' AND `co_id` = '$co_id' ";

    $dg_res = mysqli_query($conn, $dg_sql);

    while($dg_row = mysqli_fetch_assoc($dg_res))

    {

        $mod_file_name[] = $dg_row['module_filename'];

    }

    $sql1 = "SELECT `dept_id`, `co_id`, `dept_name`, `dept_order_no` FROM `dept_master`  WHERE `co_id` = '$co_id'  ORDER BY `dept_order_no`";

    $res1 = mysqli_query($conn, $sql1);

    while ($row1 = mysqli_fetch_assoc($res1)) 

    {

        echo '<div class="col-12">';
            echo '<div class="form-group">';
                echo '<h5>'.$row1['dept_name'].'</h5>';
                echo '<select name="access_dg[]"  class="form-control select2 text-dark" multiple onchange="add_css()">';

                    $sql2 = "SELECT `co_id`, `dept_id`, `module_id`, `module_name`, `module_filename`, `module_order_no` FROM `dept_modules` WHERE `dept_id` = '$row1[dept_id]' AND  `co_id` = '$co_id' ORDER BY `module_name`";

                    $res2 = mysqli_query($conn, $sql2);

                    $i = 1;

                    while ($row2 = mysqli_fetch_assoc($res2)) 

                    {

                        if (in_array($row2['module_filename'], $mod_file_name)) {

                            $sel = 'selected';

                        } else {

                            $sel = '';

                        }

                        echo'<option value="'.$row2['dept_id'].'@'.$row1['dept_name'].'@'.$row1['dept_order_no'].'@'.$row2['module_id'].'@'.$row2['module_name'].'@'.$row2['module_filename'].'@'.$row2['module_order_no'].'@'.$i.'" '.$sel.'>'.$row2['module_name'].'</option>';

                        $i++;

                    }

                echo '</select>';

            echo'</div>';

        echo'</div>';

    }

}

else if(isset($_GET['action']) && $_GET['action'] == 'getProductName')
{
    $response_data = '';
    $product_catg = $_GET['product'];
    $sql_product_mst = "SELECT * FROM `stock_master` WHERE `companyname` = '$product_catg'  ";
    $query_product_mst = mysqli_query($conn , $sql_product_mst);
    $response_data .= '<option value="">Select Product </option>';
    while($row_product_mst = mysqli_fetch_assoc($query_product_mst))
    {
        $product_details = json_encode($row_product_mst);
        $response_data .= '<option value=\''.$product_details.'\'>'.$row_product_mst['productname'].'</option>';   
    }
    
    echo $response_data;
}

else if(isset($_POST['action']) && $_POST['action'] == 'sale_product')
{
    $full_name = $_POST['name'];
    $billtype = $_POST['bill_type'];
    $date = date('Y-m-d');
    $ItemDetail = $_POST['item_detail'];
   
    $totalamt = $_POST['subTotal'];
    // $updt_BillNo = "UPDATE `bill_header` SET `bill_no` = (`bill_no` + 1) WHERE `co_id` = '$_SESSION[co_id]'  ";
    
    // mysqli_query($conn , $updt_BillNo);

    // $get_BillNo = "SELECT `co_id`,`id`,`bill_no` FROM `bill_header` WHERE `co_id` = '$_SESSION[co_id]'  ";
    
    // $rslt = mysqli_query($conn , $get_BillNo);

    // $row = mysqli_fetch_array($rslt);

    
    $OutletSource = explode('@' , $_POST['odSource']);
    $ot_id = $OutletSource[0];
    $ot_name = $OutletSource[1];
    
    
    $sqlUpdateOrderId = "UPDATE `order_ref_nos` SET `order_id` = (`order_id`+1) WHERE `co_id` = '$_SESSION[co_id]' AND `UnitId`='$ot_id'"; 
    mysqli_query($conn, $sqlUpdateOrderId);
    
    $orderquery = "SELECT `co_id`, `UnitId`, `order_id` FROM `order_ref_nos` WHERE `co_id` = '$_SESSION[co_id]' AND `UnitId`='$ot_id'";
    $rslt = mysqli_query($conn , $orderquery);
    $row = mysqli_fetch_array($rslt);
    $ord_id = $row['order_id'];
    
    $sql_ins_bill_header = "INSERT INTO `bill_header` (`co_id`, `name`, `bill_type`, `date`, `bill_id`, `product_total`) VALUES ('$co_id', '$full_name', '$billtype', '$date', '$ord_id', '$totalamt')";
    $qry_ins_bill_header= mysqli_query($conn,  $sql_ins_bill_header);

    if($qry_ins_bill_header)
    {
        foreach($ItemDetail as $productDetail)
        {
            $sql_ins_bill_detail = "INSERT INTO `bill_details`( `co_id`, `bill_id`, `product_company`, `product_name`, `product_unit`, `product_price`, `product_quantity`, `product_total`) VALUES ('$co_id', '$ord_id', '$productDetail[companyname]', '$productDetail[productname]','$productDetail[unit]', '$productDetail[price]', '$productDetail[ItemQty]',  '$productDetail[ProductSubTotal]' ) ";  
            mysqli_query($conn , $sql_ins_bill_detail);

            $quantity = $productDetail['ItemQty'];

            $sql_stock = mysqli_query($conn, "SELECT * FROM `stock_master` WHERE `companyname` = '$productDetail[companyname]' AND `productname`= '$productDetail[productname]'");
            
            $count = mysqli_num_rows($sql_stock);

            if($count > 0)
            {
                $result = mysqli_query($conn, "UPDATE `stock_master` SET `quantity` = `quantity` - $quantity WHERE `companyname` = '$productDetail[companyname]' AND `productname` = '$productDetail[productname]' ");
            }
            mysqli_query($conn , $result);
        }   
            $arr = array('sts' => 'Success' , 'msg' => 'Order Purchased Successfully. ' , 'sql_ins_bill_detail' => $sql_ins_bill_detail); 
    }  
    else
    {
        $arr = array('sts' => 'Error' , 'msg' => 'Try Again.' , 'sql_ins_bill_detail' => $sql_ins_bill_detail); 
    }
        
    echo json_encode($arr);

}
    

?>