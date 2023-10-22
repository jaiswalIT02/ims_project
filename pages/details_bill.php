<?php
    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 

    $co_id = $_SESSION['co_id'];

    if(isset($_GET['action']) && $_GET['action'] == 'view')
	{
        $id = $_GET['id'];
        $bill_id = $_GET['billid'];

        // $order = new Order();
        // dd($order->getOrder());

       // $sql = "SELECT * FROM `bill_header` WHERE `co_id`= '$co_id' AND `id` = '$id' AND `bill_id` = '$bill_id' ";
       // $res = mysqli_query($conn,$sql);
       $where = " WHERE `co_id`= '$co_id' AND `id` = '$id' AND `bill_id` = '$bill_id' ";
       $data = SelectData('bill_header', $select='*', $where, $des=null, $group_by=null, ' bill_id DESC' , $limit=null);

       //dd($data);
        // while($row = mysqli_fetch_array($res))
        // {
        //     $bill_id = $row['bill_id'];
        //     $name = $row['name'];
        //     $bill_type = $row['bill_type'];
        //     $date = date('d-m-Y',strtotime($row['date']));
        // }

?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h5 mb-0 text-gray-800">Bill Details</h3>
    </div>
</div>



<div class="row">
    <div class="col-md-10">
        <div class="col-md-12" style="height:900px;">
            <div class="box-body">

                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        Detailed Bill                                        
                    </div>

                    <div class="row ml-3 mr-3">
                        <div class="col-md-6">
                            <?php echo 'Bill No :- '.$data[0]['bill_id'] .'<br>' ;
                                    echo 'Cust. Name :- '.$data[0]['name'] .'<br>' ;
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo 'Bill Date :- '.date('d.m.Y',strtotime($data[0]['date'])).'<br>' ;
                                    echo 'Bill Type :- '.$data[0]['bill_type'].'<br>' ;
                                }
                            ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table" width="80%" cellspacing="0">
                                <thead class="">
                                    <tr class="">
                                        <th>S.N.</th>
                                        <th>Company&nbsp;Name </th>
                                        <th>Product&nbsp;Type </th>
                                        <th>Unit</th>
                                        <th>Price</th> 
                                        <th>Qty.</th> 
                                        <th>Total</th>                                          
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                  
                                        $cond = " WHERE `co_id`= '$co_id' AND `bill_id` = ".$data[0]['bill_id']." ";
                                       
                                        $OrderDetail = SelectData('bill_details', '*', $cond, null, null, null, null);
                                       
                                        foreach($OrderDetail as $row){
                                        }

                                        // $query="SELECT * FROM `bill_details` WHERE `co_id`= '$co_id' AND `bill_id` = '$bill_id' order by `bill_id` DESC " ;
                                        // $result=mysqli_query($conn,$query);
                                         $sno= 1;
                                         $total = 0 ;
                                        // while($row= mysqli_fetch_array($result))

                                        {  
                                    ?>
                                        <tr>
                                            <td> <?= $sno; ?></td>
                                            <td> <?= $row['product_company'] ?></td>
                                            <td> <?= $row['product_name'] ?></td>
                                            <td> <?= $row['product_unit'] ?></td>
                                            <td> <?= $row['product_price']; ?></td>
                                            <td> <?= $row['product_quantity']; ?></td>
                                            <td> <?= $row['product_total']; ?></td>                                                           
                                        </tr>
                                    <?php
                                            $sno++;
                                            $total = $total + $row['product_total']; 
                                        }
                                    ?>   
                                </tbody>
                            </table>
                            <div align="right" class="font-weight-bold">
                                <?php echo 'Grand Total :-'.$total; ?>
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


