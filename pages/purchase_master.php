<?php
    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<?php
    /*
    if(isset($_POST['submit']))
    {
        $company = $_POST['companyname'];
        $product = $_POST['productname'];
        $unit = $_POST['unit'];
        $quantity = $_POST['quantity'];
        $packing = $_POST['packingsize'];
        $price = $_POST['price'];
        $party = $_POST['partyname'];
        $purchasetype = $_POST['purchasetype'];
        $expirydate = $_POST['expirydate'];
        
        mysqli_query($conn, "INSERT INTO `purchase_master` (id,companyname,productname, unit,quantity, packing_size,price,partyname,purchasetype,expirydate) values('','$company','$product','$unit','$quantity','$packing','$price','$party','$purchasetype','$expirydate')" );
        $count = 0;
        $sql = mysqli_query($conn, "SELECT * FROM `stock_master` WHERE `companyname` = '$company' AND `productname`= '$product'");
        $count = mysqli_num_rows($sql);
        if($count == 0) {
            mysqli_query($conn, "INSERT INTO `stock_master` (id,companyname,productname, unit, quantity, price) values ('', '$company','$product','$unit','$quantity','$price')" );
        }else {
        $result = mysqli_query($conn, "UPDATE `stock_master` SET quantity= quantity + $quantity WHERE `companyname` = '$company'");
            if($result)
            {
                $_SESSION['msg'] = "Item Purchased sucessfully.";
                $_SESSION['str'] = 'success';
                //header('location:purchase_master.php');  
            } 
        }   
    }

    if(isset($_GET['delete']))
    {
        $del_id=$_GET['delete'];
        $sql="DELETE FROM `purchase_master` WHERE `id`='$del_id'" ;
        $result=mysqli_query($conn , $sql);
        if($result){
            $_SESSION['msg'] = "Purchased Item Deleted Successfully";
            $_SESSION['str'] = "success";
        }else{
            $_SESSION['msg'] = "Not deleted !";
            $_SESSION['str'] = "error";        
        }
    }
    */
    
?>

    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
                
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#purchasedetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Purchase Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#purchasehere" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Purchase here</span></a> </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="purchasedetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-dark">
                                                    <tr class="text-light">
                                                        <th>S.N.</th>
                                                        <th>Company&nbsp;Name </th>
                                                        <th>Product&nbsp;Name </th>
                                                        <th>Unit</th>
                                                        <th>Quantity</th>
                                                        <th>Packing&nbsp;Size</th>
                                                        <th>Price</th>
                                                        <th>Party&nbsp;Name</th>
                                                        <th>Purchase&nbsp;Type</th>
                                                        <th>Expiry&nbsp;Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                      $stock = new Stock();
                                                      $sno= 1;
                                                      if($stock->getPurchase() != ""){
                                                      foreach($stock->getPurchase() as $row):
                                                    ?>
                                                        
                                                        <tr>
                                                            <td> <?php echo $sno; ?></td>
                                                            <td> <?php echo $row['companyname'] ?></td>
                                                            <td> <?php echo $row['productname'] ?></td>
                                                            <td> <?php echo $row['unit'] ?></td>
                                                            <td> <?php echo $row['quantity'] ?></td>
                                                            <td> <?php echo $row['packing_size'] ?></td>
                                                            <td> <?php echo $row['price'] ?></td>
                                                            <td> <?= str_replace(' ', '&nbsp;' ,$row['partyname']) ?></td>
                                                            <td> <?php echo $row['purchasetype'] ?></td>
                                                            <td><?= date("d.m.Y", strtotime($row['expirydate'])); ?></td>
                                                            
                                                            <td> 
                                                            <button class="btn btn-danger deletePurchase" data-id= "<?=  $row['id']?>">Delete</a></button>
                                                            </td>
                                                        
                                                        </tr>
                                                    <?php
                                                    $sno++;
                                                      endforeach;
                                                      }else{
                                                        ?>
                                                            <tr class="text-center">
                                                                <td colspan = "11">No data found !</td>
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
                        </div>
             
                        <div class="tab-pane " id="purchasehere" role="tabpanel">
                            <div class="p-15"><br>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form action="" method="POST" >
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Company</label>
                                                        <select name="companyname" id="" class="form-control" onchange="select_company(this.value)">
                                                            <option value="disabled">Select Company</option>
                                                            <?php 
                                                                $sql = "SELECT `companyname` FROM `company_name` GROUP BY `companyname` " ; 
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
                                            
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label> Product</label>
                                                        

                                                        <select name="productname" id="product" class="form-control" onchange="select_product(this.value)">
                                                            <option class="disabled">Select Product</option>
                                                            <?php 
                                                                $sql = "SELECT `productname` FROM `product_info` GROUP BY `productname`" ; 
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
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Unit</label>
                                                        <select name="unit" id="unit" class="form-control" onchange="select_packing(this.value)">
                                                            <option value="">Select Unit</option>
                                                            <?php 
                                                                $sql = "SELECT `unitname` FROM `unit_master` GROUP BY `unitname` ORDER BY `unitname` ASC" ; 
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

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="text" class="form-control" name= "quantity" value="0" placeholder="Quantity">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Packing Size</label>
                                                        <select name="packingsize" id="packing" class="form-control">
                                                            <option value="">Select Packing Size</option>
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

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="text" name="price" value="0" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Party Name</label>
                                                        <select name="partyname" id="partyname" class="form-control" >
                                                            <option class="disabled">Select Party Name</option>
                                                            <?php
                                                                $sql = "SELECT `businessname` FROM `party_info` GROUP BY `businessname` ORDER BY `businessname` ASC" ; 
                                                                $qry = mysqli_query($conn ,  $sql);
                                                                while($row = mysqli_fetch_array($qry))
                                                                {
                                                                $position = $row['businessname'] ;
                                                            ?>
                                                            
                                                            <option value="<?php echo $row['businessname']?>" ><?php echo $row['businessname']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Purchase Type</label>
                                                        <select name="purchasetype" id="purchasetype" class="form-control" onchange="selectunit(this.value)">
                                                            <option value="disabled">Select Purchase Type</option>
                                                            <option value="cash">Cash</option>
                                                            <option value="card">Card</option>
                                                            <option value="online">Online</option>
                                                           
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Expiray Date</label>
                                                        <input type="text" name="expirydate" class="form-control pull-right date" placeholder="YYYY-MM-DD" >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="button" name="submit" class="btn btn-primary text-center addPurchase" >Purchase</button>      
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>


<script type="text/javascript">
        var form_data = {};
        
        $('.addPurchase').click(function(){
 
            var dataArray = $('form').serializeArray();
                for(var i=0;i<dataArray.length;i++)
                {
                    form_data[dataArray[i].name] = dataArray[i].value;
                }

            // console.log(dataArray);

            if(form_data != ""){
                $.ajax({
                url:'ajax_response',
                type : 'post',
                data : {'form_data':form_data, 'action':'add_purchase'},
                success:function(response) 
                {
                    
                    var json = JSON.parse(response);
                    console.log(json);
                    $.toast({
                        text: json.message,
                        heading: json.status,
                        icon: json.status.toLowerCase(),
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600',
                        beforeShow: function () {},
                        afterShown: function () {},
                        beforeHide: function () {},
                        afterHidden: function () {
                            window.location.href = 'purchase_master';
                        }
                    });

                   
                }
            });
            }
               
            
        })

        $('.deletePurchase').click(function(){
            let id = $(this).data('id');
          
            swal({
                text: "Confirm to delete?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete){

                    $.ajax({
                        url:'ajax_response',
                        type : 'post',
                        data : {'id':id, 'action':'delete_purchase'},
                        success:function(response) 
                        {
                            var json = JSON.parse(response);
                            $.toast({
                                text: json.message,
                                heading: json.status,
                                icon: json.status.toLowerCase(),
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3000,
                                stack: 5,
                                position: 'top-right',
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#9EC600',
                                beforeShow: function () {},
                                afterShown: function () {},
                                beforeHide: function () {},
                                afterHidden: function () {
                                   window.location.href = 'purchase_master';
                                }
                            });

                        
                        }
                    });
                }
            });
        });

    function select_company(company){
        $.ajax({
			url:  "ajax_response.php?action=GetProduct&company=" +company,
			success: function(data)
			{
				//console.log(data);
				$("#product").html(data)
			}
		});
    }

    function select_product(product){
        $.ajax({
			url:  "ajax_response.php?action=GetUnit&product=" +product,
			success: function(data)
			{
				//console.log(data);
				$("#unit").html(data)
			}
		});
        
    }


    function select_packing(packing)
	{
       // alert(packing);
		$.ajax({
			url:  "ajax_response.php?action=GetPackingSize&unit="+packing,
			success: function(data)
			{
				//console.log(data);
				$("#packingsize").html(data)
			}
		});
	}


</script>



<?php
    if(isset($_SESSION['str']))
    {
?>
    <script>
        $.toast({
            heading: "<?php echo $_SESSION['str']; ?>",
            text : "<?php echo $_SESSION['msg']; ?>",
            position : 'top-right',
            loaderBg : '#fff',
            icon : "<?php echo strtolower($_SESSION['str']); ?>",
            hideAfter : 2000,
            Stack : 6,
            position: 'top-right',
    	    textAlign: 'left',
    	    loader: true,
    	    loaderBg: '#9EC600',
    	    beforeShow: function () {},
    	    afterShown: function () {},
    	    beforeHide: function () {},
    	    afterHidden: function () {
    	        window.location.href = 'purchage_master.php';
    	    }
        });
    </script>
<?php
    unset($_SESSION['str']);
    unset($_SESSION['msg']);
   }
?>
