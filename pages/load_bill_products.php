<?php
session_start();
?>
<table class="table table-bordered text-center" width="100%" cellspacing="0">
<thead class="bg-dark">
    <tr class="text-light"> 
        <th>Company&nbsp;Name </th>
        <th>Product&nbsp;Name </th>
        <th>Unit</th>
        <th>Packing&nbsp;Size</th>
        <th>Product Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th colspan="2">Action</th>
    </tr>
</thead>
<?php
$qty_found = 0;
$qty_session = 0;
$max= 0;

if(isset($_SESSION['cart']))
{
    $max = sizeof($_SESSION['cart']);
}

for($i=0;$i <$max; $i++)
{
    $company_session = "";
    $product_session = "";
    $unit_session = "";
    $packing_session = "";
    $price_session = "";
    if($_SESSION['cart'][$i])
    {
    foreach($_SESSION['cart'][$i] as $key=> $val)
        {
        if($key == "company")
            {
                $company_session = $val;
            }
        else if($key == "product")
            {
                $product_session = $val;
            }
        else if($key == "unit")
            {
                $unit_session = $val ;
            }
        else if($key == "packing")
            {
                $packing_session = $val;
            }
        else if($key == "quantity")
            {
                $qty_session = $val;
            }
        else if($key == "price")
            {
                $price_session = $val;
            }
        }
        ?>
        <tbody>
            <tr>
                <td><?php echo $company_session ?></td>
                <td><?php echo $product_session ?></td>
                <td><?php echo $unit_session ?></td>
                <td><?php echo $packing_session ?></td> 
                <td><?php echo $price_session ?></td>    
                <td><?php echo $qty_session; ?></td>
                <td> <?php echo ($qty_session*$price_session); ?></td>                                            
                <td> 
                    <button class="btn btn-warning" onclick='updateUser(<?php echo $row["id"] ?>)'>Edit</button>
                </td>
                <td> 
                    <button class="btn btn-danger"><a class="text-light" href="purchage_master.php?delete=<?php echo $row['id'] ?>">Delete</a></button>
                </td>
            </tr>
        </tbody>
        <?php
    
    }
}

?>

</table>