<?php

class Order{

    private $table;

    function __construct(){
        $this->table = 'bill_header';
    }

    function getOrder(){
        $co_id = $_SESSION['co_id'];
        $where = " WHERE `co_id` = '".$co_id."'";
        $data = SelectData($this->table, $select='*', $where, $des=null, $group_by=null, ' bill_id DESC' , $limit=null);

        return $data;
    }
/*


function get_total($bill_id, $conn)
{
    $total = 0;
    $sql="SELECT * FROM `bill_details` WHERE `bill_id`='$bill_id' AND `co_id`= '$co_id' "; 
    $res=mysqli_query($conn , $sql);
    while($row2 = mysqli_fetch_array($res))
    {
        $total = $total+($row2['product_quantity'] * $row2['product_price'] ) ;
    }
    return $total;
}
*/
}


