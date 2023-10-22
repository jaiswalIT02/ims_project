<?php

include('includes/security.php');
include('includes/header.php'); 
include('includes/navbar.php');      

	$co_id = $_SESSION['co_id'];
	if(isset($_POST['form_submit']))
	{
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&";

		$ol_name = $_POST['ol_name'];
		$ol_city = $_POST['ol_city'];
		$ol_pin = $_POST['ol_pin'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$has_ot_kitchen = $_POST['has_ot_kitchen'];
		$sql = "INSERT INTO `outlet_details`(`co_id`, `ol_name`, `ol_city`, `ol_pin`, `ol_state`, `ol_country`, `has_outlet_kitchen`) VALUES ('$co_id', '$ol_name', '$ol_city', '$ol_pin', '$state', '$country' , '$has_ot_kitchen')";
		$query = mysqli_query($conn , $sql);
		//$sql2 = "INSERT INTO `order_ref_nos`(`co_id`, `UnitId`, `order_id`) VALUES ('$brandcode','$ot_id','1')";
    	//mysqli_query($conn,$sql2);

		 if($query)

        {

            $user_name_ol = $ol_name." "."Outlet";
            $login_name_ol = $ol_name."@".substr(str_shuffle($chars),0, 2);
            $pwd_ol = substr(str_shuffle($chars),0, 8);
            $sql1 = "INSERT INTO `login_master`(`co_id`, `user_name`, `user_login`, `user_password`, `desig_id`) VALUES ('$co_id' , '$user_name_ol', '$login_name_ol', '$pwd_ol', '3')";
            mysqli_query($conn , $sql1);    

            

        	$_SESSION['str'] = 'success';



            $_SESSION['msg'] = 'Insert Record Successfully';



			//header('Location:outlet_details.php');

        }
        else
        {
        	$_SESSION['str'] = 'danger';

            $_SESSION['msg'] = 'Try again';
			//header('Location:outlet_details.php');

        }
	}



?>


  
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
					
					<ul class="nav nav-tabs customtab2" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#otdetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Outlet Details</span></a> </li>

						<li class="nav-item" id="home-bake"> <a class="nav-link" data-toggle="tab" href="#addot" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add Outlet</span></a> </li>
					</ul>

                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="otdetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
												<thead class="bg-dark">
                                                	<tr class="text-light">

														<th>S.N.</th>

														<th>Outlet&nbsp;Location</th>

														<th>Outlet&nbsp;State</th>

														<th>Outlet&nbsp;Country</th>

														<th>Action</th>

													</tr>	

												</thead>

												<tbody>

												<?php



												$sn = 1;


												$sql = "SELECT `co_id`, `UnitId`, `ol_name`, `ol_city`, `ol_pin`, `ol_state`, `ol_country`, `has_outlet_kitchen` FROM `outlet_details` WHERE `co_id` = '$co_id'";



												$query = mysqli_query($conn , $sql);
                                                while($row = mysqli_fetch_assoc($query))
												{
                                                echo '<tr>';
													echo '<td>'.$sn.'</td>';
													echo '<td>'.$row['ol_name'].'</td>';
													echo '<td>'.$row['ol_state'].'</td>';
													echo '<td>'.$row['ol_country'].'</td>';
												    
                                                    echo '<td><a href="outlet_details.php?action=Delete&ol_id='.$row['UnitId'].'&ol_name='.$row['ol_name'].'" class="btn btn-danger status_btn btn-md">Delete</a>&nbsp;<button type="button" onclick="editOutletDetails(\''.$row['UnitId'].'\' , \''.$row['ol_name'].'\' , \''.$row['ol_city'].'\' , \''.$row['ol_pin'].'\' , \''.$row['ol_state'].'\' , \''.$row['ol_country'].'\' , \''.$row['has_outlet_kitchen'].'\')" class="btn btn-success status_btn btn-md">Update</button></td>';
                
												echo '</tr>';



												$sn++;



												}

												?>

												</tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
             
                        <div class="tab-pane " id="addot" role="tabpanel">
                            <div class="p-15"><br>
                            <div class="card shadow mb-4">
                                    <div class="card-body">
									    <form action="" method="post" class="form-horizontal form-element">

											<div class="row m-5">

												<div class="col-md-6">

												

													<div class="form-group row">

														<input type="text" class="form-control" id="olName" name="ol_name" onblur="validation(this.value , 'OutletName' , 'olName')" placeholder="Outlet Name" required>

														<span id="OutletName" class="text-danger"></span>

													</div>

													

													<div class="form-group row">

														<input type="text" class="form-control" id="olCity" onblur="validation(this.value , 'Outlet_City' , 'olCity')" name="ol_city" placeholder="Outlet City" required>

														<span id="Outlet_City" class="text-danger"></span>

													</div>



													<div class="form-group row">

														<input type="text" class="form-control" id="olPincode" onblur="validation(this.value , 'Outlet_Pin' , 'olPincode')" name="ol_pin" placeholder="Outlet Pincode" required>

														<span id="Outlet_Pin" class="text-danger"></span>

													</div>



													<div class="form-group row">

														<input type="text" class="form-control" id="olState" onblur="validation(this.value , 'Outlet_State' , 'olState')" name="state" placeholder="Outlet State" required>

														<span id="Outlet_State" class="text-danger"></span>

													</div>

													

													<div class="form-group row">

														<select class="form-control" name="has_ot_kitchen" required >

															<option value="Outlet Kitchen">Outlet Kitchen</option>

															<option value="Central Kitchen">Central Kitchen</option>

														</select>

													</div>



													<div class="form-group row">

														<input type="text" class="form-control" id="olCountry" onblur="validation(this.value , 'Outlet_Country' , 'olCountry')" name="country"  value="India">

														<span id="Outlet_Country" class="danger"></span>

													</div>

												</div>

											</div><hr>



											<div class="row">

												<div class="col-md-2">

													<button type="submit" name="form_submit" class="btn btn-success btn-block">Submit</button>  

												</div>

											</div>

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

	include("includes/footer.php");

?>



<?php

    if(isset($_SESSION['str'])){

?>

  <script>

   $.toast({

          heading: "<?php echo $_SESSION['str']; ?>",

          text : "<?php echo $_SESSION['msg']; ?>",

          position : 'top-right',

          loaderBg : '#fff',

          icon : "<?php echo strtolower($_SESSION['str']); ?>",

          hideAfter : 2500,

          Stack : 6

        });

  </script>

<?php

    unset($_SESSION['str']);

    unset($_SESSION['msg']);

   }

?>



<?php

  if($_SESSION['OPT_mode'] == 'bakers')

  {

?>

  <script type="text/javascript">

     $('#home-bake').hide();

  </script>

<?php

  

  }

?>



<script type="text/javascript">



function validation(value , check , input)

{

    error = false; 

    $('#'+check).html('');

    //var pattern = /^[a-zA-Z]+$/;

    

    if(check == 'OutletName')

    {

        if(!value)

        {

            msg = 'please enter the outlet location ';

  			error = true;

        }

    }

    

    if(check == 'Outlet_City')

    {

        if(!value)

        {

            msg = 'please enter the outlet city';

            error = true;

        }

    }

    

    if(check == 'Outlet_Pin')

    {

        if(!value)

        {

            msg = 'please enter the outlet pincode';

            error = true;

        }

        else if(isNaN(value)

        {

            msg = 'please enter the numeric value';

            error = true;

        }

    }

    

    if(check == 'Outlet_State')

    {

        if(!value)

        {

            msg = 'please enter the outlet state';

            error = true;

        }

    }

    

    if(check == 'Outlet_Country')

    {

        if(!value)

        {

            msg = 'please enter the outlet country';

            error = true;

        }

    }

    

    if (error) {

        $('#'+check).html(msg);

        $('#'+input).val('');

    }    

}

function editOutletDetails(exist_ol_id , exist_ol_name , exist_ol_city , exist_ol_pin , exist_ol_state , exist_ol_country , exist_ol_has_kitchen)
{
    $.confirm({
        title: 'Edit Outlet Details',
        type : 'green',
        content: '' +
        '<form action="" class="formName m-5 col-md-10">' +
        '<div class="form-group">' +
            '<label class="control-label font-weight-bold">Outlet Location<span class="text-danger text-center">*</span></label>'+
            '<input type="text" value="'+exist_ol_name+'" class="form-control" id="olName" onblur="checkOutletDuplicate(this.value)" required>'+
            '<span class="text-danger" id="OutletName"></span>'+
        '</div>' +
        '<div class="form-group">' +
            '<label class="control-label font-weight-bold">Order Goes To<span class="text-danger text-center">*</span></label>' +
            '<select class="form-control" name="is_outlet_kitchen" id="isHasKitchen" required>'+
                '<option value="Outlet Kitchen" <?php if(exist_ol_has_kitchen == 'Outlet Kitchen') { echo 'selected';} ?> >Outlet Kitchen</option>'+
                '<option value="Central Kitchen" <?php if(exist_ol_has_kitchen == 'Central Kitchen') { echo 'selected';} ?> >Central Kitchen</option>'+
            '</select>'+
            '<span class="text-danger" id="IsHasKitchen"></span>'+
         '</div>' +
        '<div class="form-group">' +
            '<label class="control-label font-weight-bold">Pincode<span class="text-danger text-center">*</span></label>'+
            '<input type="text" name="ol_pincode" value="'+exist_ol_pin+'" class="form-control" id="olPincode">'+
            '<span class="text-danger" id="OlPincode"></span>'+
        '</div>' +
        '<div class="form-group">'+
            '<label class="control-label font-weight-bold">City<span class="text-danger text-center">*</span></label>'+
            '<input type="text" name="ol_city" value="'+exist_ol_city+'" id="olCity" class="form-control">'+
            '<span class="text-danger" id="OlCity"></span>'+
        '</div>'+
        '<div class="form-group">'+
            '<label for="outlet_state" class="control-label font-weight-bold">State<span class="text-danger text-center">*</span></label>'+
	        '<?php
	            $state = array('Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand',
                                'Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim',
                                'Tamil Nadu','Telangana','Tripura','Uttarakhand','Uttar Pradesh','West Bengal','Andaman and Nicobar Islands','Chandigarh','Dadra and Nagar Haveli',
                                'Daman and Diu','Delhi','Lakshadweep','Puducherry');
	        ?>'+
	        '<select class="form-control required" id="olstate" name="state" required>'+
	        '<option value="'+exist_ol_state+'">'+exist_ol_state+'</option>'+
            '<?php
                for($i = 0; $i < sizeof($state); $i++)
                {
                    if($state[$i] == exist_ol_state)
                    {
                        $sel =  'selected';
                    }
                    else
                    {
                        $sel =  '';    
                    }
                    echo '<option value="'.$state[$i].'" '.$sel.'>'.$state[$i].'</option>';
                }
            ?>'+
			'</select>'+
		    '<span id="OutletState" class="text-danger"></span>'+
        '</div>'+
        '<div class="form-group">'+
          '<label for="companyCountry" class="form-label font-weight-bold">Country<span class="text-danger text-center">*</span></label>'+
          '<select class="form-control" id="olCountry" name="country" required>'+
            '<option value="India" <?php if(exist_ol_country == 'India'){ echo 'selected'; }?> >India</option>'+
          '</select>'+
		  '<span id="OutletCountry" class="danger"></span>'+
        '</div>'+
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Update',
                btnClass: 'btn-success status_btn',
                action: function () 
                {
                    error = true;
                    
                    var new_olName =  this.$content.find('#olName').val();  
                    var new_isHasKitchen = this.$content.find('#isHasKitchen').val();
                    var new_olPincode =  this.$content.find('#olPincode').val();
                    var new_olCity = this.$content.find('#olCity').val();
                    var new_olstate = this.$content.find('#olstate').val();
                    var new_olCountry = this.$content.find('#olCountry').val();
                    
                    $.ajax({
                        url : 'get_ajax_response.php?action=UpdateOutletDetails&new_olName='+new_olName+'&new_isHasKitchen='+new_isHasKitchen+'&new_olPincode='+new_olPincode+'&new_olCity='+new_olCity+'&new_olstate='+new_olstate+'&new_olCountry='+new_olCountry+'&new_olId='+exist_ol_id,
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
                    	            window.location.href = 'outlet_details.php';
                    	        }
                    	    });
                        }
                    });
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
}




</script>