<?php
    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
    //include('includes/db_connect.php');
?>

<?php
	//$co_id = $_SESSION['co_id'];
	
    if (isset($_POST['submit'])) 
    {
    	if (isset($_POST['access_dg']) && sizeof($_POST['access_dg']) > 0) 
    	{
    		$dg_id = $_POST['desig_id'];
    		
    		$sql1 = "DELETE FROM `access_master` WHERE `desig_id` = '$dg_id' AND `co_id` = '$_SESSION[co_id]' ";
    		
    		mysqli_query($conn, $sql1);
    		
    		for ($i=0; $i < sizeof($_POST['access_dg']); $i++) 
    		{ 
    			$lave_alloc = explode('@', $_POST['access_dg'][$i]);
    			
    			if($lave_alloc[1] == 'Home'){
    			    $dept_font_icon = 'fas fa-fw fa-home';
    			}else if($lave_alloc[1] == 'Settings'){
    			    $dept_font_icon = 'fas fa-fw fa-cog';
    			}else if($lave_alloc[1] == 'Reports'){
    			    $dept_font_icon = 'fas fa-fw fa-chart-area';
    			}
    			
    	        $sql2 = "INSERT INTO `access_master`(`co_id`, `desig_id`, `dept_id`, `dept_name`, `dept_icon`,  `dept_order_no`, `module_id`, `module_name`, `module_filename`, `module_order_no`) VALUES ('$_SESSION[co_id]', '$dg_id', '$lave_alloc[0]', '$lave_alloc[1]', '$dept_font_icon', '$lave_alloc[2]', '$lave_alloc[3]', '$lave_alloc[4]', '$lave_alloc[5]', '$lave_alloc[6]')"."; ";
    	        
    			$res = mysqli_query($conn, $sql2);
    		}
    	}

    	if ($res) 
        {
            $_SESSION['sts'] = 'Success';
            $_SESSION['msg'] = 'Module Successfully Added.';
            // header('Location:mod_alloc.php');
        }
        else
        {
            $_SESSION['sts'] = 'Error';
            $_SESSION['msg'] = 'Please Try Again.';
            //header('Location:mod_alloc.php');
            
        }
    }
    
?>



              
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-header p-10">
                <h4 class="box-title" style=""><strong>Module Allocation</strong></h4>
            </div><hr>
            <div class="box-body">
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#userdetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Add Module</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#adduser" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down"></span></a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="userdetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="box-body">
                                            <div class="col-12">
                                                <div class="box box-default mb-0">
                                                    <form method="post" class="form-horizontal form-element">
                                                        <div class="box-body">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <select name="desig_id" id="lavel"  class="form-control" onchange="module_alloc(this.value)">
                                                                                <option value="">Select User Type</option>
                                                                                <?php
                                                                                    $sql = "SELECT `desig_id`, `desig_name` FROM `designation_master` WHERE  `co_id` = '$_SESSION[co_id]' ";
                                                                                    $query = mysqli_query($conn, $sql);
                                                                                    while($row = mysqli_fetch_assoc($query))
                                                                                    {
                                                                                    ?>
                                                                                        <option value = "<?php echo $row['desig_id']; ?>"><?php echo $row['desig_name']; ?> </option>
                                                                                    <?php
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body" id="module_detail">
                                            <div class="col-12">
                                                <div class="box">
                                                    <div class="box-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="desig_id" id="level_inp">
                                                            <div class="row text-dark" id="module-access"></div>
                                                            <div class="row justify-content-center">
                                                                <input type="submit" name="submit" value="Submit" class="btn btn-success status_btn">&nbsp;
                                                                <input type="reset" name="reset" value="Reset" class="btn btn-danger status_btn">
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
            </div>
        </div>
    </div>
</div>


<?php
    include('includes/scripts.php');
    include('includes/footer.php');

?>

<?php
    if(isset($_SESSION['sts']))
    {
?>
    <script type="text/javascript">
		$.toast({
	        text: '<?php echo $_SESSION['msg']; ?>',
	        heading: '<?php echo $_SESSION['sts']; ?>',
	        icon: '<?php echo strtolower($_SESSION['sts']); ?>',
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
	            window.location.href = 'mod_alloc';
	        }
	    });
	</script>
<?php
        unset($_SESSION['sts']);
	    unset($_SESSION['msg']);
    }
?>

<script type="text/javascript">
	$('#module_detail').hide();
	function module_alloc(id) 
	{
		if (id != '') 
		{
			$.ajax({
				url: 'ajax_response?action=accessmod&desig_id='+id,
				success : function(data) 
				{

					console.log(data);
					$('#module_detail').show();
					$('#level_inp').val(id);
					$("#module-access").html(data);
					$('#module-access .select2').select2();
					$('#module-access .select2-selection__choice').css('color','red');
					//$('#module-access .select2-selection select2-selection--multiple').css('color','red');
					
				}
			});
		}
	}
	
	function add_css()
	{
	    $('#module-access .select2-selection__choice').css('color','red');
	}
</script>


<script>

    $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
    });

    // Material Select Initialization
    $(document).ready(function() {
       $('.mdb-select').materialSelect();
    });

</script>