<?php

include('includes/security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
  
    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
                
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active " data-toggle="tab" href="#productdetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Product Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#productinfo" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add Product</span></a> </li>
                        
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div class="tab-pane active " id="productdetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-dark">
                                                    <tr class="text-light">
                                                        <th>ID</th>
                                                        <th>Company&nbsp;Name </th>
                                                        <th>Product&nbsp;Name </th>
                                                        <th>Unit</th>
                                                        <th>Packing&nbsp;Size</th>
                                                        <th colspan="2">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $prodData = new Product();                                      
                                                        $sno= 1;
                                                        if($prodData->productData() != ""){
                                                            foreach($prodData->productData() as $row):

                                                                $companyname = $row['companyname'] ;
                                                    ?>
                                    
                                                        <tr>
                                                            <td> <?= $sno; ?></td>
                                                            <td> <?= $row['companyname']; ?></td>
                                                            <td> <?= $row['productname']; ?></td>
                                                            <td> <?= $row['unit']; ?></td>
                                                            <td> <?= $row['packing_size']; ?></td>
                                                            
                                                            <?= '<td> 
                                                                <button class="btn btn-warning" onclick="editProductDetails(\''.$row['id'].' \', \''.$row['companyname'].' \',\''.$row['productname'].' \', \''.$row['unit'].' \',\''.$row['packing_size'].' \')">Edit</button>
                                                            </td>' ?>


                                                            <td> 
                                                                <button class="btn btn-danger deleteProd" data-id= "<?= $row['id'];?>">Delete</button>
                                                            </td>
                                                        
                                                        </tr>
                                                    <?php
                                                    $sno++;
                                                    endforeach;
                                                }
                                                    
                                                    ?>       
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="productinfo" role="tabpanel">
                            <div class="p-15"><br>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label> Company</label>
                                                <!-- <input type="hidden" name='id'> -->

                                                <select name="companyname" id="" class="form-control">
                                                    <option value="">Select Company</option>
                                                      <?php  $compData = new Company();
                                                             $cdata = $compData->companyData(); 
                                                            foreach($cdata as $Cdata):
                                                        ?>
                                                        <option value="<?= $Cdata['companyname']; ?>" ><?= $Cdata['companyname']?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Name </label>
                                                <input type="text" name="productname" class="form-control" id="Product" placeholder="Enter Product Name" required />
                                                <p class="error product-error text-danger col-md-8"></p>
                                            </div>

                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select name="unitname" id="" class="form-control">
                                                    <option value="">Select Unit</option>
                                                    <?php 
                                                    $unitData = new Unit();
                                                    $udata = $unitData->unitData(); 
                                                    foreach($udata as $Udata):
                                                    ?>
                                                    <option value="<?= $Udata['unitname']; ?>" ><?= $Udata['unitname']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>Packing Size</label>
                                                <input type="text" name="packingsize" class="form-control" placeholder="Enter Packing Size">
                                            </div>

                                            <button type="button" name="submit" class="btn btn-primary addProduct">Submit</button>    
                                            
                                        </form>
                                    </div>
                                </div>
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


<script type="text/javascript">

    $(document).ready(function(){

        var form_data = {};
        $('.addProduct').click(function(){


    
            var dataArray = $('form').serializeArray();
                for(var i=0;i<dataArray.length;i++)
                {
                    form_data[dataArray[i].name] = dataArray[i].value;
                }

            // console.log(dataArray);

            if(form_data != ""){
                $.ajax({
                url:'ajax_response',
                type : 'post',
                data : {'form_data':form_data, 'action':'add_product'},
                success:function(response) 
                {
                    
                    var json = JSON.parse(response);
                    console.log(json);
                    $.toast({
                        text: json.message,
                        heading: json.status,
                        icon: json.status.toLowerCase(),
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600',
                        beforeShow: function () {},
                        afterShown: function () {},
                        beforeHide: function () {},
                        afterHidden: function () {
                            //window.location.href = 'manage_product';
                        }
                    });

                   
                }
            });
            }
               
            
        })

        $('.deleteProd').click(function(){
            let id = $(this).data('id');
            swal({
                text: "Confirm to delete product?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete){

                    $.ajax({
                        url:'ajax_response',
                        type : 'post',
                        data : {'id':id, 'action':'delete_product'},
                        success:function(response) 
                        {
                            var json = JSON.parse(response);
                            $.toast({
                                text: json.message,
                                heading: json.status,
                                icon: json.status.toLowerCase(),
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3000,
                                stack: 5,
                                position: 'top-right',
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#9EC600',
                                beforeShow: function () {},
                                afterShown: function () {},
                                beforeHide: function () {},
                                afterHidden: function () {
                                   window.location.href = 'manage_product';
                                }
                            });

                        
                        }
                    });
                }
            });
        });
        
    })
        
    function CheckProduct(prod)
    {
        error = false; 
        $(".product-error").html("");
        
        if(!prod){
            msg = "Enter the product name";
            error = true;
        }else if(!isNaN(prod)){
            msg = 'Please enter alphabet only';
            error = true;
        }
        $.ajax({
                url:'ajax_response?action=checkProductDuplicate&prod='+prod,
                success:function(data) 
                {
                    console.log(data);
                    if (data>0) {
                        Swal.fire({
                            title: ' ',
                            text : 'This product name already exists',
                            type: 'danger',
                            showConfirmButton: true,
                            confirmButtonColor: '#66CDAA',
                            confirmButtonText: 'ok',
                            })
                        error = true;
                    }
                    if (error){
                        $('#Product').val('');
                    }   
                }
            });   
    }

    function editProductDetails(id, companyname, productname, unit, packingsize){
        {
	    $.confirm({
            title: 'Update Product Details',
            type: 'green',
            content: '' +

            '<form action="" class="formName ">' +
            '<div class="form-group">'+   
                  '<label for="name">Company Name</label>'+
             //   '<input type="text" class="form-control" value="'+companyname+'" id="companyname">'+
           // '</div>'+

           
            '<select name="companyname" id="companyname" class="form-control">'+
                //'<option value="'+companyname+'">'+companyname+'</option>'+
                '<?php 
                    $cdata = $compData->companyData(); 
                    foreach($cdata as $Cdata):
                        if($Cdata['companyname'])
                        {
                            $sel = 'selected';
                        }
                        else
                        {
                            $sel = '';
                        }
            
                        echo '<option value="'.$Cdata['companyname'].'" "'.$sel.'">'.$Cdata['companyname'].'</option>';
                    endforeach; 
                ?>'+
               
            '</select>'+

            '<div class="form-group">'+   
                '<label for="name">Product Name</label>'+
                '<input type="text" class="form-control" value="'+productname+'" id="productname">'+
            '</div>'+

            '<div class="form-group">'+   
                '<label for="name">Unit </label>'+
                '<input type="text" class="form-control" value="'+unit+'" id="unit">'+
            '</div>'+

            '<div class="form-group">'+   
                '<label for="name">Packing Size</label>'+
                '<input type="text" class="form-control" value="'+packingsize+'" id="packingsize">'+
            '</div>'+

            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Update',
                    btnClass: 'btn-warning',
                    action: function () 
                    {
                        error = true;
                        var companyname_new =  this.$content.find('#companyname').val();
                        var productname_new =  this.$content.find('#productname').val();
                        var unit_new =  this.$content.find('#unit').val();
                        var packingsize_new =  this.$content.find('#packingsize').val();
                        
                        if(error){
                            $.ajax({
                                url : 'ajax_response?action=UpdateProductDetails&companyname='+companyname_new+'&productname='+productname_new+'&unit='+unit_new+'&packingsize='+packingsize_new+'&id='+id,
                                success : function(data)
                                {   
                                    console.log(data);
                                    var json = JSON.parse(data)
                                    $.toast({
                                            text: json.msg,
                                            heading: json.sts,
                                            icon: json.sts.toLowerCase(),
                                            showHideTransition: 'fade',
                                            allowToastClose: true,
                                            hideAfter: 3000,
                                            stack: 5,
                                            position: 'top-right',
                                            textAlign: 'left',
                                            loader: true,
                                            loaderBg: '#9EC600',
                                            beforeShow: function () {},
                                            afterShown: function () {},
                                            beforeHide: function () {},
                                            afterHidden: function () {
                                                window.location.href = 'manage_product';
                                            }
                                        });
                                }
                            });
                        }
                    }
                },
                cancel: function () {
                    $.alert({
                            title: 'Error',
                            content: 'Not updated'
                    });
                },
            },
            
        });
	}
        
    }

</script>
