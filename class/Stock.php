<?php

    class Stock{
        function __construct(){
            $this->table= "stock_master";
            $this->purchase_table = "purchase_master";
        }

        function addPurchase($data){
         
            $where = " WHERE `co_id` = '".$data['co_id']."' AND `companyname` = '".$data['companyname']."' AND `productname`= '".$data['productname']."'";
            
            $select = SelectData($this->table, 'quantity', $where, $des=null, $group_by=null,  $order_by=null , 1);
           
            $stock_data = array('co_id'=> $data['co_id'], 'companyname'=> $data['companyname'], 'productname' => $data['productname'], 'unit'=>$data['unit'], 'quantity'=>$data['quantity'] ,'price'=> $data['price']);
            
            $values = array('quantity' => $select[0]['quantity'] + intval($data['quantity']));

            if($select){
                $qry = UpdateData($this->table, $values, $where);
            }else{
                $qry = InsertData($this->table,$stock_data);
            }

          //  print_r($qry);die;
           
            $qry = InsertData($this->purchase_table,$data);
            return $qry;
        }

        function getPurchase(){
            $co_id = $_SESSION['co_id'];
            $qry =  $where = " WHERE `co_id` = '".$co_id."'";
            $qry =  SelectData($this->purchase_table, $select='*', $where, $des=null, $group_by=null,  $order_by=null , $limit=null);

            return $qry;
        }

        function deletePurchase($id){
            $co_id = $_SESSION['co_id'];
            global $conn;
            $sql = "DELETE FROM ".$this->purchase_table." WHERE `id` = ".$id." AND `co_id` = '".$co_id."'";
          
            $delete = $conn->query($sql);
            if($delete){
                return true;
            }else{
                return false;
            }
        }


        function getStock(){
            $co_id = $_SESSION['co_id'];
            $qry =  $where = " WHERE `co_id` = '".$co_id."'";
            $qry =  SelectData($this->table, $select='*', $where, $des=null, $group_by=null,  $order_by=null , $limit=null);

            return $qry;
        }

    }