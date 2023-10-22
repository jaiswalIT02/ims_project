<?php 

class Unit{

    private $table;

    function __construct(){
        $this->table = 'unit_master';
        
    }

    function unitData(){
        $co_id = $_SESSION['co_id'];
        $where = " WHERE `co_id` = '".$co_id."'";
        $data = SelectData($this->table, $select='*', $where, $des=null, $group_by=null, $order_by=null , $limit=null);

        return $data;
    }
    
}