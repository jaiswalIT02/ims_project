<?php

    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 

?>



<div class="col-md-12">
    <div class="card">
        <div class="card-header">View Bills</div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark">
                                <tr class="text-light">
                                    <th>S.N.</th>
                                    <th>Bill&nbsp;N.</th>
                                    <th>Customer&nbsp;Name </th>
                                    <th>Bill&nbsp;Type </th>
                                    <th>Bill&nbsp;Date</th>
                                    <th>Bill&nbsp;Total</th>  
                                    <th>View Details</th>
                                    <th>View Encripted Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php      
                                    $today = date('Y-m-d'); 
                                    $order = new Order();
                                    //dd($order->getOrder() );
                                    // $query="SELECT * FROM `bill_header` WHERE `co_id`= '$co_id' AND `date` >= '$today' AND `date` <= '$today'  order by `bill_id` DESC " ;

                                    //    $query="SELECT * FROM `bill_header` WHERE `co_id`= '$co_id'  order by `bill_id` DESC " ;
                                    
                                    //     $result=mysqli_query($conn,$query);
                                        
                                        $sno= 1;
                                    //     while($row= mysqli_fetch_array($result))
                                            
                                    //     {  
                                    //         $enc_val = base64_encode($_SESSION['co_id']).'@'.base64_encode($row['id']).'@'.base64_encode($row['bill_id']);
                                    //         $encryption = base64_encode($enc_val);
                                    foreach($order->getOrder() as $row):
                                ?>
                                    <tr>
                                        <td> <?= $sno ?></td>
                                        <td> <?= $row['bill_id'] ?></td>
                                        <td> <?= $row['name'] ?></td>
                                        <td> <?= $row['bill_type'] ?></td>
                                        <td> <?= $date = date('d-m-Y',strtotime( $row['date'])); ?></td>
                                        <td> <?= $row['product_total']; ?></td>
                                        <td> 
                                            <button class="btn btn-info"><a class="text-light" href="details_bill?action=view&id=<?php echo $row['id'] ?>&billid=<?php echo $row['bill_id'] ?>">View</a></button>
                                        </td>
                                       <?php
                                        //echo '<td style="background-color:#fff;"><a href="details_bill.php?q='.$encryption.'" class="btn btn-primary status_btn btn-md" target="_blank">View</a></td>';
                                                    
                                      ?>
                                    </tr>
                                <?php
                                $sno++;
                                    //}
                                    endforeach;
                                
                                ?>
                                        
                            </tbody>
                        </table>
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
