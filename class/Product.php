<?php 

class Product{

    private $table; 
    
    function __construct(){
        $this->table = 'product_info';
        $this->co_id = $_SESSION['co_id'];
    }

    function productData(){
        
        $where = " WHERE `co_id` = '".$this->co_id."'";
        $data = SelectData($this->table, $select='*', $where, $des=null, $group_by=null, $order_by=null , $limit=null);

        return $data;
    }

    function addProduct($data){
        $qry = InsertData($this->table,$data);
        return $qry;
    }

    function deleteProduct($id){
        
        global $conn;
        $sql = "DELETE FROM ".$this->table." WHERE `id` = ".$id." AND `co_id` = '".$this->co_id."'";
      
        $delete = $conn->query($sql);
        if($delete){
            return true;
        }else{
            return false;
        }

    }
    
}