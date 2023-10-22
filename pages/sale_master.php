<?php

include('includes/security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
$date= date('d-m-Y');
$bill_id = 0;
$get_BillNo = "SELECT * FROM `bill_header`  WHERE `co_id` = '$_SESSION[co_id]' ORDER BY `id` desc limit 1 ";
$rslt = mysqli_query($conn , $get_BillNo);
while($row = mysqli_fetch_array($rslt))
{
    $bill_id = $row['id'];
}

function generate_bill_no($id)
{
    if($id == '')
    {
        $id1 = '0';
    }else{
        $id1 = $id;
    }
    $id1 = $id1 + 1;
    return  $id1;
}

?>

<style>
    .custom-control-input, .custom-control-label {
        outline: initial!important;
        box-shadow: initial!important;
    }
    .custom-control-label, .form-check-label {
        line-height: 1.5rem;
        padding-top: 1px;
    }
    .custom-control-label {
        position: relative;
        margin-bottom: 0;
        vertical-align: top;
    }
    .item_commnets
    {
        border: 1px solid #979797;
        border-radius: 4px 0px 0px 4px;
        background-color: #F9F9F9;
        /*box-shadow: inset 0 1px 3px 0 rgb(0 0 0 / 50%);*/
        height: 28px;
        padding-left: 10px;
        color: #303030;
        font-weight: 300;
        width: 70%;
        outline: none;
        margin-top : 10px;
    }
    
    .mod_btn
    {
        border: 1px solid #05B361;
        border-radius: 0px 4px 4px 0px;
        background-color: #05B361;
        /*box-shadow: inset 0 1px 3px 0 rgb(0 0 0 / 50%);*/
        height: 28px;
        padding-left: 10px;
        color: #fff;
        font-weight: 600;
        width: 20%;
        outline: none;
        margin-top : 10px;
        cursor:pointer;
    }
    
    .tr_comment
    {
        background: #ffe4c4 !important;   
    }
    
    .disc_list 
	{
      height: 400px;
      padding:10px;
      overflow-y: scroll;
    }
	
	.disc_list::-webkit-scrollbar {
        display: none;
    }
    .price_sub input[type=text] {
        height: 25px;
        width: 50px;
        border-radius: 2px;
        background-color: #EFEFEF;
        box-shadow: inset 1px 1px 3px 0 rgb(0 0 0 / 17%);
        padding: 0;
        margin: 0;
        border: 0;
        text-align: center;
        outline: none;
        font-family: 'Hind';
        margin: 0 6px;
    }
    
  
    .price_sub button#sub {
        width: 18px;
        height: 18px;
        background-color: #ed4134;
        border: 0;
        color: #fff;
        border-radius: 100px;
        padding: 0;
        margin: 0;
        font-size: 21px;
        line-height: 20px;
        font-family: 'Hind';
        outline: none;
        cursor: pointer;
    }
    .price_sub button#add 
    {
        width: 18px;
        height: 18px;
        background-color: #7ED321;
        border: 0;
        color: #fff;
        border-radius: 100px;
        padding: 0;
        margin: 0;
        font-size: 21px;
        line-height: 20px;
        font-family: 'Hind';
        outline: none;
        cursor: pointer;
    }

</style>
 

<div class="col-md-12">
    <div class="card">
        <div class="card-header">Manage Sale</div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="post" autocomplete="off">
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name= "name" value="" id="full_name" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Purchase Type</label>
                                    <select name="bill_type" id="purchasetype" class="form-control">
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="online">Online</option>                        
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>Bill No</label>
                                    <div class="input-group">      
                                       <input type="number" name="bill_no" class="form-control" value="<?php echo generate_bill_no($bill_id) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>Bill Date</label>
                                    <div class="input-group">      
                                        <input type="text" name="date" class="form-control pull-right date" value="<?php echo $date; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="orderSource">Order Source</label>
                                    <select class="form-control" id="odSource" name="odSource" onchange="getpaymode(this.value)">
                                        <?php
                                            $sql ="SELECT * FROM `user_outlet_access` WHERE `co_id` = '$_SESSION[co_id]' ";
                                            $query = mysqli_query($conn , $sql);
                                            $NumOfRows = mysqli_num_rows($query);
                                            if($NumOfRows > 1)
                                            {
                                                echo '<option>Select Outlet</option>';
                                            }
                                            while($row = mysqli_fetch_array($query))
                                            {
                                                echo '<option value="'.$row['UnitId'].'@'.$row['UnitName'].'">'.$row['UnitName'].'</option>';
                                                $un_id = $row['UnitId'];
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>               
                                        
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Company <code> *</code></label>
                                    
                                    <select name="companyname" id="company" class="form-control" onchange="getProductName(this.value)" required >
                                        <option value="">Select Company</option>
                                        <?php 
                                            $sql = "SELECT `companyname` FROM `stock_master`  WHERE `co_id` = '$_SESSION[co_id]' GROUP BY `companyname` " ; 
                                            $qry = mysqli_query($conn ,  $sql);
                                            while($row = mysqli_fetch_array($qry))
                                            {
                                            $position = $row['companyname'] ;
                                        ?>
                                            <option value="<?php echo $row['companyname']?>" ><?php echo $row['companyname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                      
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Product <code> *</code></label>
                                    <select name="productname" id="product" class="form-control"  onchange="ItemToCart(this.value, 'plus', 'select')" required>
                                        <option value="">Select Product</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Taken Products</div><hr>
                                <!---  <div id="bill_products"></div>
                                <h5><div id="total_bill" style="float:right;padding-top:5px;"><span>Total:</span><span>0</span></div></h5> -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-dark">
                                            <tr class="text-light">                             
                                                <th>Company&nbsp;Name </th>
                                                <th>Product&nbsp;Name </th>
                                                <th>Unit</th>
                                                <th>Product Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th><div class="item_name"><i class="fa fa-times" aria-hidden="true" onclick="DistroyItemCart()" style="width:18px"></i></div</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart_body">  </tbody>
                                        
                                    </table>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10"></div>
                                        <div class="col-md-2 mx-auto text-right" >
                                            Total Amount: <input class="form-control" id="total" type="text" name="subTotal" style="text-align:right;" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 text-center"><button type="button" name="btn_submit" onclick=SaveOrderDetail() class="btn btn-success status_btn btn-block">Generate Bill</button></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>    

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<script type="text/javascript">
    function select_company(company)
    {
        $.ajax({
			url:  "ajax_response.php?action=GetProduct&company=" +company,
			success: function(data)
			{
				$("#product").html(data)
			}
		});
    }

    function select_product(product)
    {
        $.ajax({
            url:  "ajax_response.php?action=GetUnit&product=" +product,
            success: function(data)
            {
               // console.log(data);
                $("#unit").html(data)
                $("#price").html(data);
            }
        });
    }
/*
    function select_product(price)
    {
        $.ajax({
            url:  "ajax_response.php?action=GetPrice&price=" +price,
            success: function(data)
            {
                console.log(data);
               // $("#unit").html(data)
                $("#price").html(data);
            }
        });
    }
*/
    var packing_value = 0;
    function select_packing(packing)
	{
        $("#price").val(packing);
        $("#total_price").val(packing);
        packing_value = packing;
	}

    function quantity_val(qty)
	{
        var total = packing_value*qty;
        $("#total_price").val(total);
	}
       
    function quantityval(quantity)
    {
        error = false; 
        $(".quantity-error").html("");
        
        if(!quantity){
            m = "Enter the product quantity";
            error = true;
            
            if(error) {
                //$('.quantity-error').html(m);
            // $('#quantity').val('');
            alert(m);
            }
        }else if(isNaN(quantity)){
            m = 'Please enter numeric only';
            error = true;
            alert(m);
            if(error) {
                //$('.quantity-error').html(m);
            // $('#quantity').val('');
                }
            
        }  
    }


    function DistroyItemCart()
    {
        item_detail = [];
        item_id = [];
        applied = 0;
        $('#cart_body').html('');
        $("#total").val('');
        $('#taxamt').val('');
        $("#netamt").val('');
    }

    function getProductName(product_catg)
    {
        $.ajax({
           url : 'ajax_response.php?action=getProductName&product='+product_catg,
           success : function(data)
           {
               console.log(data);
               $('#product').html(data);
           }
        });
    }
    
    var sno = 0;
    var item_detail = [];
    var item_id = [];
    var SubTotal = 0, GST = 0, Total = 0;
    var ChargeTotal = 0 , charge_tax_amt  = 0;
    var applied = 0;
    function ItemToCart(json, index, from, qty)
    {
        if(from == 'select'){
            var item = JSON.parse(json);
        } else {
            var item = json;
        }
        
        if(applied == 0)
        {
            SubTotal = 0, discAmt = 0, GST = 0, Total = 0;
            if(item == 'Remove')
            {
                item_detail.splice(index, 1);
                item_id.splice(index, 1);
            }
            else
            {
                var found = item_id.findIndex((element) => element == item.id);
                if(found >= 0)
                {
                    if(index == 'item_commnets')
                    {
                        item_detail[found]['comments'] = $('#item_commnets'+item.id).val();  
                    }
                    else
                    {
                        if(index == 'minus' && item.ItemQty > 1) {
                            item_detail[found]['ItemQty'] = (parseInt(item_detail[found]['ItemQty']) - 1).toFixed(3);
                        } else if((index == 'plus')) {
                            item_detail[found]['ItemQty'] = (parseInt(item_detail[found]['ItemQty']) + 1).toFixed(3);   
                        } else if(index = 'Quantity' && qty > 0) {
                            item_detail[found]['ItemQty'] = qty.toFixed(3);
                        }
                        
                        item_detail[found]['ProductSubTotal'] = (item_detail[found]['ItemQty'] * item.price).toFixed(2);
                       
                        item_detail[found]['ProductTotal']    = (parseFloat(item_detail[found]['ProductSubTotal']) + parseFloat(item_detail[found]['product_gst_amt'])).toFixed(2)
                    }
                }
                else
                {
                    if(from != 'discount')
                    {
                        comments = '';
                        item_detail.push({ 'id':item.id, 'productname':item.productname, 'companyname':item.companyname, 'unit':item.unit, 'ItemQty':'1.00', 'price':item.price, 'ProductSubTotal':item.price, 'comments':comments});
                        item_id.push(item.id);
                    }
                }
            }
            
            var text = "";
            for (i = 0; i < item_detail.length; i++) 
            {
                if(item_detail[i]['comments'] != '') {
                    tr = 'class="tr_comment"';
                    style = 'style="display:inline"';
                } else {
                    tr = '';
                    style = 'style="display:none"';
                }
                
                text += '<tr '+tr+'>'+
                            
                            '<td class="Companyname">'+
                                '<p title="'+item_detail[i]['companyname']+'" onclick="displayCommentBox('+item_detail[i]['id']+')">'+item_detail[i]['companyname']+'</p>'+
                            '</td>'+
                            '<td class="ProductName">'+
                                '<p title="'+item_detail[i]['productname']+'" onclick="displayCommentBox('+item_detail[i]['id']+')">'+item_detail[i]['productname']+'</p>'+
                            '</td>'+
                            '<td class="Unit">'+
                                '<p title="'+item_detail[i]['unit']+'" onclick="displayCommentBox('+item_detail[i]['id']+')">'+item_detail[i]['unit']+'</p>'+
                            '</td>'+
                            '<td class="Price">'+
                                '<p title="'+item_detail[i]['price']+'" onclick="displayCommentBox('+item_detail[i]['id']+')">'+item_detail[i]['price']+'</p>'+
                            '</td>'+
                            '<td>'+
                                '<div id="field1" class="price_sub">'+
                                    '<button type="button" id="sub" class="sub text-center" onclick=\'ItemToCart('+JSON.stringify(item_detail[i])+', "minus", "cart");\'>-</button>'+
                                        '<input type="text" id="item_qty_'+item_detail[i]['id']+'" value="'+item_detail[i]['ItemQty']+'" min="1" onblur=\'ItemToCart('+JSON.stringify(item_detail[i])+', "Quantity", "cart", this.value);\'/>'+
                                    '<button type="button" id="add" class="add text-center" onclick=\'ItemToCart('+JSON.stringify(item_detail[i])+', "plus", "cart");\'>+</button>'+
                                '</div>'+
                            '</td>'+
                            //'<td class="price_table">'+item_detail[i]['price']+'</td>'+
                            '<td>'+parseFloat(item_detail[i]['ProductSubTotal']).toFixed(2)+'</td>'+
                        
                            '<td>'+
                                '<div class="item_name">'+
                                    '<i class="fa fa-times" aria-hidden="true" onclick="ItemToCart(\'Remove\', '+i+')" style="width:18px"></i>'+ 
                                '</div>'+
                            '</td>'+
                    '</tr>';
                    
                SubTotal = (parseFloat(SubTotal) + parseFloat(item_detail[i]['ProductSubTotal'])).toFixed(2);
                discAmt = (parseFloat(discAmt) + parseFloat(item_detail[i]['product_disc_amt'])).toFixed(2);
                GST = (parseFloat(GST)+parseFloat(item_detail[i]['product_gst_amt'])).toFixed(2);
                Total = parseFloat(Total) + parseFloat(item_detail[i]['ProductTotal']);
            }
            
            //SubTotal = SubTotal.toFixed(2)
            
            GST = (parseFloat(GST) + parseFloat(charge_tax_amt)).toFixed(2)
            Total = (parseFloat(Total) + parseFloat(ChargeTotal) + parseFloat(charge_tax_amt));
            Total = Math.round(Total);
            console.log(item_detail);
            
            $('#cart_body').html(text);
            
            $("#total").val(SubTotal);
            $('#discamt').val(discAmt);
            $('#taxamt').val(GST);
            $("#netamt").val(Total);
        }
    }

    function SaveOrderDetail()
    {
        //var full_name = $('#full_name').val();

        var arr_data = {};
        arr_data['action'] = 'sale_product';
        
        var dataArray = $('form').serializeArray();
        for(var i=0;i<dataArray.length;i++)
        {
          arr_data[dataArray[i].name] = dataArray[i].value;
        }
        
        arr_data['item_detail'] = item_detail;
        console.log(arr_data);
        
        $.ajax({
        type : "POST",
        url : 'ajax_response.php',
        data : arr_data,
        success : function(data)
        {
            console.log(data);
            var json = JSON.parse(data);
            $.toast({
                text: json.msg,
                heading: json.sts,
                icon: json.sts.toLowerCase(),
                showHideTransition: 'fade',
                allowToastClose: true,
                hideAfter: 5000,
                stack: 5,
                position: 'top-right',
                textAlign: 'left',
                loader: true,
                loaderBg: '#9EC600',
                beforeShow: function () {},
                afterShown: function () {},
                beforeHide: function () {},
                afterHidden: function () {
                   window.location.href = 'sale_master.php';
                }
            });
        }
    });      
        
    }
</script>

