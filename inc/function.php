<?php

function route($indis = 0){
    if(isset($_GET['route'])){
        $url = trim(strip_tags($_GET['route']));
       // print_r($url);die;
        if(strpos($url,'/') !== false){
            $exp = explode('/',$url);
            if(isset($exp[$indis])){
                return $exp[$indis];
            }else{
                return false;
            }
        }else{
            if($indis == 0){
                return $url;
            }else{
                return false;
            }
        }
    }else{
        return false;
    }
}

function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function InsertData($table_name, $values){
    global $conn;
    $sql = "INSERT INTO ";
    if($table_name!="")
    {
        $sql .=$table_name;
    }
    if($values != ''){
        $sql.=' SET ';
        $c= count($values);
        $i = 1;
        foreach($values as $key =>$val){
            if($i==$c){
                $sql.="$key= '$val'";
            }else{
                $sql.="$key= '$val',  ";
            }
            $i++;
        }
    }

    //dd($sql);die;

   
    $result = $conn->query($sql);
    return $result;

}

function SelectData($table_name, $select='*', $where=null, $des=null, $group_by=null, $order_by=null , $limit=null)
{  
    global $conn;
	
	//print_r($conn);
    $sql = "SELECT ";
    if($select){
        $sql .=$select.' FROM ';
    }
   
    if($table_name!="")
    {
        $sql .=$table_name;
    }

    if(isset($where)){
        $sql .= $where;
    }

    if(isset($order_by)){
        $sql .=' ORDER BY '.$order_by;
    }   

    if($group_by){
        $sql .=' GROUP BY '.$group_by;
    }
    if($limit){
        $sql .=' LIMIT '.$limit;
    }

   
    //dd($sql);

    if(!$result = $conn->query($sql)){
        return "Database Table Not found";
    }
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc())
        {
            $resulsts[] =  $row;
        }
    }else{
        return false;
    }
    return $resulsts;
} 


function UpdateData($table_name, $values, $where)
{
    global $conn;
    $sql = " UPDATE "; 
    if($table_name!="")
    {
        $sql .=$table_name;
    }

    if($values != ''){
        $sql.=' SET ';
        $c= count($values);
        $i = 1;
        foreach($values as $key =>$val){
            if($i==$c){
                $sql.="$key= '$val'";
            }else{
                $sql.="$key= '$val',  ";
            }
            $i++;
        }
    }

    if(isset($where)){
        $sql .= $where;
    }  

    //dd($sql);

    $result = $conn->query($sql);
    return $result;
}

function SelectDataRows($table_name, $data, $where= null)
{
    global $conn;
    $sql = "SELECT ".$data." FROM ". $table_name. $where ;
       
    if(!$result = $conn->query($sql)){
        return "Database Table Not found";
    }
    return $result;
}

function getNumRows($table_name, $select='*', $where=null, $order_by=null, $des=null, $group_by=null, $limit=null){
    global $conn;
    $sql = "SELECT ";
    if($select){
        $sql .=$select.' FROM ';
    }
   
    if($table_name!="")
    {
        $sql .=$table_name;
    }

    if(isset($where)){
        $sql .= $where;
    }

    if($group_by){
        $sql .=' GROUP BY '.$group_by;
    }
    if($limit){
        $sql .=' LIMIT '.$limit;
    }

    //dd($sql);

    if(!$result = $conn->query($sql)){
        return "Database Table Not found";
    }
    
    if($result->num_rows > 0){
        return $result->num_rows;
    }else{
        return false;
    }
}

function NumOfRows($table_name, $data, $where=null)
{
    $Qry = SelectDataRows($table_name, $data , $where); 
   
    $numofRows = $Qry->num_rows;
    
    return $numofRows;
}

function createUrlSlug($urlString)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString);
    return $slug;
}


function send_mail($to_address, $subject, $mail_content) {

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->SMTPDebug 	= 0; 
    $mail->CharSet 		= 'UTF-8';
    $mail->Debugoutput 	= 'html';
    $mail->Host 		= 'smtp.gmail.com';
    $mail->Port 		= '587';
    $mail->SMTPAuth 	= true;
    $mail->Username 	= 'tarunjaiswal@tranktechies.com';
    $mail->Password 	= 'olbovmazimrobzhn';
    $mail->SMTPAutoTLS  = false;
    $mail->SMTPSecure   = 'tls';
    $mail->setFrom('tarunjaiswal@tranktechies.com','tarunjaiswal@tranktechies.com');
    $mail->addReplyTo('tarunjaiswal@tranktechies.com');
    if($to_address){
            $mail->addAddress($to_address);
    }

    $mail->Subject 		= $subject;
    $mail->isHTML(true);
    $mail->msgHTML($mail_content, dirname(__FILE__));

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}


function getCurrencies($return_currencies = null){
    $p = file_get_contents('https://www.tcmb.gov.tr/kurlar/today.xml');
    $str = simplexml_load_string($p, "SimpleXMLElement", LIBXML_NOCDATA);
    $full_array = [];
    $return_array = [];
    foreach($str->Currency as $get_item){
        $item = (array)$get_item;
        $currency_code = $item['@attributes']['CurrencyCode'];
        if($currency_code == 'XDR'){
            continue;
        }
        $item_arr = [
            'name_tr' => $item['Isim'],
            'name_en' => $item['CurrencyName'],
            'code' => $currency_code,
            'unit' => $item['Unit'],
        ];
        if($currency_code == 'USD'){
            $item_arr['rate'] = $item['ForexSelling'];
            $item_arr['name_tr'] = 'Türk Lirası';
            $item_arr['name_en'] = 'Turkish Lira';
            $item_arr['code'] = 'TRY';
            $currency_code = 'TRY';
        }else{
            if($item['CrossRateUSD']){
                $item_arr['rate'] = $item['CrossRateUSD'];
            }else{
                $get_rate = (float)$item['CrossRateOther'];
                $rate = 1 / $get_rate;
                $item_arr['rate'] = $rate;
            }
        }
        $full_array[$currency_code] = $item_arr;
        if(is_array($return_currencies) && in_array($currency_code,$return_currencies)){
            $return_array[$currency_code] = $item_arr;
        }
    }

    if(is_array($return_currencies)){
        $return = $return_array;
    }else{
        $return = $full_array;
    }
    return $return;
}


function formatExcelPrice($price,$decimals = 0,$decimal_sep = '.',$thousand_sep = ','){
    return number_format($price,$decimals,$decimal_sep,$thousand_sep);
}



 
  



   





