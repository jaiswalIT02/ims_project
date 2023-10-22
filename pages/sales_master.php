<?php
include('includes/security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
//include('includes/db_connect.php');                    
?>

 
<?php
date_default_timezone_set("Asia/Kolkata");  
$date= date('d-m-Y');

if(isset($_POST['submit']))
{
    $cust_name = $_POST['name'];
    $bill_type = $_POST['billtype'];
	//$bill_no = $_POST['billno'];
    $bill_date = $_POST['billdate'];
    $companyname = $_POST['companyname'];
    $productname = $_POST['productname'];
    $unitname = $_POST['unit'];
    $packingsize = $_POST['packingsize'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $totalprice = $_POST['total_price'];

    echo $result = mysqli_query($conn, "INSERT INTO `sale_master` (bill_no,name,billtype,billdate,companyname,productname, unit, packing_size,price,quantity,total_price) values('','$cust_name','$bill_type','$bill_date','$companyname','$productname','$unitname','$packingsize','$price','$quantity','$totalprice')");
  
}
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">Sale A Products </div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="post" >
                        <div class="row ">
                            <div class="col-md-3 mx-auto">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name= "name" value="" placeholder="Enter Name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-3 mx-auto">
                                <div class="form-group">
                                    <label>Purchase Type</label>
                                    <select name="billtype" id="purchasetype" class="form-control">
                                        <option class="disabled">Select Bill Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="online">Online</option>                        
                                    </select>
                                </div>
                            </div>

<!--
                            <div class="col-lg-3 mx-auto">
                                <div class="form-group">
                                    <label>Bill No</label>
                                    <div class="input-group">      
                                       <input type="number" name="billno" class="form-control" value="00001" readonly>
                                    </div>
                                </div>
                            </div>
-->
                            <div class="col-lg-3 mx-auto">
                                <div class="form-group">
                                    <label>Bill Date</label>
                                    <div class="input-group">      
                                        <input type="text" name="billdate" class="form-control pull-right date" value="<?php echo $date; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="text-center">
                        <h4>Select a product</h4><hr>
                    </div>
                    
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                <label>Company <code> *</code></label>
                                <input type="hidden" name='id'>

                                <select name="companyname" id="company" class="form-control" onchange="select_company(this.value)" required>
                                    <option value="">Select Company</option>
                                    <?php 
                                        $sql = "SELECT `companyname` FROM `stock_master` GROUP BY `companyname` " ; 
                                        $qry = mysqli_query($conn ,  $sql);
                                        while($row = mysqli_fetch_array($qry))
                                        {
                                        $position = $row['companyname'] ;
                                    ?>
                                        <option value="<?php echo $row['companyname']?>" ><?php echo $row['companyname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            </div>
                        
                            <div class="col-md-2">
                                <div class="form-group">
                                    
                                    <label>Product <code> *</code></label>
                                    <select name="productname" id="product" class="form-control" onchange="select_product(this.value)">
                                        <option value="" >Select Product</option>
                                        <?php 
                                            $sql = "SELECT `productname` FROM `stock_master` GROUP BY `productname`" ; 
                                            $qry = mysqli_query($conn ,  $sql);
                                            while($row = mysqli_fetch_array($qry))
                                            {
                                            $position = $row['productname'] ;
                                    ?>
                                            <option value="<?php echo $row['productname']?>" ><?php echo $row['productname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unit  <code> *</code></label>
                                    <select name="unit" id="unit" class="form-control" >
                                        <option value="">Select Unit</option>
                                        <?php 
                                            $sql = "SELECT `unitname` FROM `stock_master` GROUP BY `unitname` " ; 
                                            $qry = mysqli_query($conn ,  $sql);
                                            while($row = mysqli_fetch_array($qry))
                                            {
                                            $position = $row['unitname'] ;
                                        ?>
                                            <option value="<?php echo $row['unitname']?>" ><?php echo $row['unitname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Size<code>*</code></label>
                                    <select name="packingsize" id="packing" class="form-control" onchange="select_packing(this.value)">
                                        <option value="">Packing Size</option>
                                        <?php 
                                            $sql = "SELECT `packing_size` FROM `product_info` GROUP BY `packing_size` ORDER BY `packing_size` ASC" ; 
                                            $qry = mysqli_query($conn ,  $sql);
                                            while($row = mysqli_fetch_array($qry))
                                            {
                                            $position = $row['packing_size'] ;
                                        ?>
                                            <option value="<?php echo $row['packing_size']?>" ><?php echo $row['packing_size']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group ">
                                    <label>Price</label>
                                    <input type="text" id="price" name="price" value="0" onkeyup="select_product()"  class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control" id="quantity"  onkeyup="quantity_val(this.value)"  name= "quantity">
                                    <div><span class="error quantity-error text-danger"></span></div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total Price</label>
                                    <input type="text" id="total_price" name="total_price"  value="0" class="form-control" readonly>                       
                                </div>
                            </div><br><br>

                            <div class="col-md-2 mx-auto" style="margin-top:2.5%;">
                                    <button type="submit" name="submit" oclick="add_session();" class="btn btn-primary text-center" > + Add </button>    
                            </div>
                            
                        </div>
                    
                </div>
            </div>
        </form>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="text-center">Taken Products</div>
                  <!---  <div id="bill_products"></div>
                     <h5><div id="total_bill" style="float:right;padding-top:5px;"><span>Total:</span><span>0</span></div></h5> -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark">
                                <tr class="text-light">
                                    <th>Sl. No.</th>                                                        
                                    <th>Bill</th>
                                    <th>Customer Name </th>
                                    <th>Bill Date </th>
                                    <th>Product Name</th>
                                    <th>Total Amt.</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                   
                                    $query="SELECT * FROM `sale_master`" ;
                                    $result=mysqli_query($conn,$query);
                                    $sno= 1;
                                    while($row= mysqli_fetch_array($result))
                                    {
                                ?>
                                    <tr>
                                        <td> <?php echo $sno; ?></td>
                                        <td> <?php echo $row['bill_no']; ?></td>
                                        <td> <?php echo $row['cust_name']; ?></td>
                                        <td> <?php echo $row['bill_date']; ?></td>
                                        <td> <?php echo $row['product_details']; ?></td>
                                        <td> <?php echo $row['total_amount']; ?></td>
                                        
                                        <?php echo '<td> 
                                            <button class="btn btn-warning" onclick="editProductDetails()">Edit</button>
                                        </td>' ?>

                                        <td> 
                                            <button class="btn btn-danger"><a class="text-light" href="add_product.php?delete=<?php echo $row['id'] ?>">Delete</a></button>
                                        </td>
                                    
                                    </tr>
                                <?php
                                $sno++;
                                    }
                                
                                ?>
                                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function select_company(company){
        //alert(company);
        $.ajax({
			url:  "ajax_response.php?action=GetProduct&company=" +company,
			success: function(data)
			{
				//console.log(data);
				$("#product").html(data)
			}
		});
    }

    function select_product(product)
    {
        $.ajax({
            url:  "ajax_response.php?action=GetUnit&product=" +product,
            success: function(data)
            {
                console.log(data);
                $("#unit").html(data)
                $("#price").html(data);
            }
        });
    }
/*
    function select_product(price)
    {
        $.ajax({
            url:  "ajax_response.php?action=GetPrice&price=" +price,
            success: function(data)
            {
                console.log(data);
               // $("#unit").html(data)
                $("#price").html(data);
            }
        });
    }
*/
    var packing_value = 0;
    function select_packing(packing)
	{
        $("#price").val(packing);
        $("#total_price").val(packing);
        packing_value = packing;
	}

    function quantity_val(qty)
	{
        var total = packing_value*qty;
        $("#total_price").val(total);
	}
    
    function add_session()
    { 
    // alert('lock karo');
        var product_company = document.getElementById('company').value;
        var product = document.getElementById('product').value;
        var unit = document.getElementById('unit').value;
        var packing_size = document.getElementById('packing').value;
        var price = document.getElementById('price').value;
        var quantity = document.getElementById('quantity').value;
        var total = document.getElementById('total_price').value;

        $.ajax({
            url : 'save_in_session.php?action=GetSession&company='+product_company+'&product='+product+'&unit='+unit+'&packing='+packing_size+'&price='+price+'&quantity='+quantity+'&total_price='+total,
            success : function(data){
                console.log(data);
                alert(data);
                //$("#bill_products").html(data)
            }
        });

       /*
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange= function(){
                if(xmlhttp.readyState == 4 && xmlhttp.state== 200) {
                    alert(xmlhttp.responseText);
                }
        };
        xmlhttp.open('GET', 'save_in_session.php?company='+product_company+'&product='+product+'&unit='+unit+'&packing='+packing_size+'&price='+price+'&quantity='+quantity+'&total_price='+total, true);
        xmlhttp.send();
        */
    
    }

    function load_bill_products()
    {
        $.ajax({
            url:  "load_bill_products.php",
            success: function(data)
            {
                $("#bill_products").html(data)
            }
        });
    }
    load_bill_products();
    
 function quantityval(quantity)
{
    error = false; 
	$(".quantity-error").html("");
	
	if(!quantity){
	    m = "Enter the product quantity";
	    error = true;
        
        if(error) {
            //$('.quantity-error').html(m);
           // $('#quantity').val('');
           alert(m);
        }
	}else if(isNaN(quantity)){
  		m = 'Please enter numeric only';
  		error = true;
        alert(m);
        if(error) {
            //$('.quantity-error').html(m);
           // $('#quantity').val('');
            }
         
  	}  
}
</script>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>