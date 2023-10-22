<?php

include('includes/security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 


if(isset($_GET['delete'])){
    $del_id=$_GET['delete'];
    $sql="DELETE FROM `stock_master` WHERE `id`='$del_id'" ;
    $result=mysqli_query($conn , $sql);
    if($result){
        $_SESSION['msg'] = "Stock Item Deleted Successfully";
        $_SESSION['str'] = "success";
       
    }else{
        $_SESSION['msg'] = "Not deleted !";
        $_SESSION['str'] = "error";
       
}
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
                
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#stockdetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Stock Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#partyinfo" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down"></span></a> </li>
                       
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="stockdetails" role="tabpanel">
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
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php                  
                                                     
                                                        $stock = new Stock();
                                                        $sno= 1;
                                                        if($stock->getStock() != ""){ 
                                                        foreach($stock->getStock() as $row):
                                                    ?>
                                                        
                                                        <tr>
                                                            <td> <?php echo $sno; ?></td>
                                                            <td> <?php echo $row['companyname'] ?></td>
                                                            <td> <?php echo $row['productname'] ?></td>
                                                            <td> <?php echo $row['unit'] ?></td>
                                                            <td> <?php echo $row['quantity'] ?></td>
                                                            
                                                            <td> <?php echo $row['price'] ?></td>
                                                         
                                                            <td> 
                                                            <button class="btn btn-danger"><a class="text-light" href="stock_master?delete=<?php echo $row['id'] ?>">Delete</a></button>
                                                            </td>
                                                        
                                                        </tr>
                                                    <?php
                                                    $sno++;
                                                    endforeach;
                                                }else{
                                                    ?>
                                                        <tr class="text-center">
                                                            <td colspan= "7">No data found !</td>
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
    	        window.location.href = 'stock_master';
    	    }
        });
    </script>
<?php
    unset($_SESSION['str']);
    unset($_SESSION['msg']);
   }
?>
