<?php
    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
    include('includes/db_connect.php');

    $co_id = $_SESSION['co_id'];

    $d1 = date('d/m/Y');

    if(isset($_POST['submit']))
    {
        $date = $_POST['date']; 
    }

?>

<div class="row">
    <div class="col-md-10">
        <div class="col-md-12 box">
            <div class="box-body">
                <div class="card shadow mb-4">
                    <div class="card-header">Sale Report</div>
                    <div class="card-body">
                        <form action="" method='POST'>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name= "date" max="<?php echo date('Y-m-d') ?>" min="<?= date("Y-m-dd")?>" value="<?php echo $date; ?>" required />
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="submit"  class="btn btn-primary" name="submit" value="Submit" style="margin-top: 1.9rem!important"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>
<?php
    if(isset($_POST['submit']))
    {
?>
    <div class="col-md-10">
        <div class="col-md-12 box">
            <div class="box-body">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <?php echo 'Sales Report Of Date :-' .'&nbsp;'. date('d-m-Y', strtotime($date)) ;?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-dark">
                                    <tr class="text-light">
                                        <th>S.N.</th>
                                        <th>Customer&nbsp;Name </th>
                                        <th>Bill&nbsp;Type </th>
                                        <th>Bill&nbsp;Date</th>
                                        <th>Bill&nbsp;Total</th>  
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  
                                     $sql1 = "SELECT * FROM `bill_header` WHERE `co_id` = '$_SESSION[co_id]' AND `date` >= '$date' AND `date` <= '$date' ";
                                     $sno = 1; 
                                     $query = mysqli_query($conn , $sql1);
                                     if(mysqli_num_rows($query) > 0)
                                     {
                                        while($row = mysqli_fetch_array($query))
                                        {
                                ?>
                                            <tr>
                                                <td><?php echo $sno; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['bill_type']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($row['date'])); ?></td>
                                                <td><?php echo $row['product_total']; ?></td>
                                                <td> 
                                                  <button class="btn btn-info"><a class="text-light" href="details_bill.php?action=view&id=<?php echo $row['id'] ?>&billid=<?php echo $row['bill_id'] ?>">View</a></button>
                                                </td>
                                            </tr>
                                <?php
                                            $sno++;
                                        }
                               
                                    }
                                    else
                                    {
                                        echo '<tr><td colspan="5">Sorry ! Data not Found</td></tr>';
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

<?php 
    }
?>
</div>

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>
