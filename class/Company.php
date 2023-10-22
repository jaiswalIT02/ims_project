<?php 

class Company{

    private $table;

    function __construct(){
        $this->table = 'company_name';
        
    }

    function companyData(){
        $co_id = $_SESSION['co_id'];
        $where = " WHERE `co_id` = '".$co_id."'";
        $data = SelectData( $this->table, $select='*', $where=null, $des=null, $group_by=null, $order_by=null , $limit=null);

        return $data;
    }
    
}