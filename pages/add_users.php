<?php
include('includes/security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/db_connect.php');
?>

<style type="text/css">

  .select_all{

    cursor: pointer;

  }

</style>

<?php
$co_id = $_SESSION['co_id'];


if(isset($_POST['submit']))
{    
    echo $outlets = $_POST['outlet']; // Array
    
    $desig_id = $_POST['role'];

    $user_name = $_POST['user_name'];

    $login_name = $_POST['login_name'];

    $password = $_POST['pwd'];

    $sql = "INSERT INTO `login_master`(`co_id`, `user_name`, `user_login`, `user_password`, `desig_id`) VALUES ('$co_id' , '$user_name' , '$login_name' , '$password' , '$desig_id')";

    $query = mysqli_query($conn , $sql);

    if($query)
    {
        for($i=0;$i<sizeof($outlets);$i++)
        {
            $outlet = explode('_',$outlets[$i]);
            $ol_id = $outlet[0];
            $ol_name = $outlet[1];
            
            $sql_ins = "INSERT INTO `user_outlet_access`(`co_id`, `LoginName`, `UserLevel`, `UnitId`, `UnitName`) VALUES ('$_SESSION[co_id]' , '$login_name' , '$desig_id' , '$ol_id' , '$ol_name')";
            mysqli_query($conn , $sql_ins);
        }
        
        $_SESSION['str'] = 'success';

        $_SESSION['msg'] = 'Login Details Added Successfully';

    }
    else
    {
        $_SESSION['str'] = 'error';

        $_SESSION['msg'] = 'Try again';

        //header('Location:users.php');
    }
}


if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="UPDATE `user_register` SET `status`='$status' where `id`='$id'";
		mysqli_query($CONN,$update_status_sql);
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'Delete')
	{

        $user_login = $_GET['user_login'];
        
        $res_login = mysqli_query($conn , "DELETE FROM `login_master` WHERE `user_login`='$user_login' and `co_id` = '$co_id'");
        
        $res_user_acs = mysqli_query($conn , "DELETE FROM `user_outlet_access` WHERE `LoginName`='$user_login' and `co_id` = '$co_id'");
        
        if($res_login AND $res_user_acs)
        {
            $_SESSION['str'] = 'success';
        
            $_SESSION['msg'] = 'Login Details Deleted Successfully';
            
            header('Location:add_user.php');    
        }
        else
        {
        	$_SESSION['str'] = 'error';
    
            $_SESSION['msg'] = 'Try again';
    
    		header('Location:add_user.php');
        }
    }
?>
                    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#userdetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">User Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#adduser" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add User</span></a> </li>
                    
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div class="tab-pane active " id="userdetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
											 	<thead class="bg-dark text-light">
												    <tr>
												      <th>S.N.</th>
												      <th>User&nbsp;Name</th>
												      <th>Login&nbsp;Name</th>
												      <th>Action</th>
												    </tr>
											  	</thead>
											    <tbody>
											    	<?php 
                                                      $sn = 1;
                                                      $sql = "SELECT  `user_name`, `user_login`, `user_password` , `desig_id` FROM `login_master` WHERE `co_id` = '$co_id'";
                                                      $query = mysqli_query($conn, $sql);
                                                      while($row = mysqli_fetch_assoc($query))
                                                      {
											    	
											    	    echo '<tr>';
												            echo '<td>'.$sn.'</td>';
												            echo '<td>'.$row['user_name'].'</td>';
												            echo '<td>'.$row['user_login'].'</td>';
												            echo '<td><a href="add_user.php?action=Delete&user_login='.$row['user_login'].'" class="btn btn-danger status_btn btn-md">Delete</a></td>';
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

                        
                        <div class="tab-pane" id="adduser" role="tabpanel">
                            <div class="p-15"><br>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="hidden" name='id'>
                                                        <input type="text" name="user_name" class="form-control" placeholder="Enter Full Name">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Username </label>
                                                        <input type="text" name="login_name" class="form-control" placeholder="Enter Username">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="pwd" class="form-control" placeholder="Enter Password">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select name="role" id="" class="form-control">
                                
                                                            <option value = "" disabled> Select </option>
                                                            <?php 
                                                            $sql2 = "SELECT `desig_name`, `desig_id` from `designation_master` WHERE  `co_id`= '$co_id' AND `desig_is_active`=1 group by `desig_name` ORDER BY `desig_id` ";
                                                            $qry2 = mysqli_query($conn, $sql2);
                                                            while($row2 = mysqli_fetch_assoc($qry2))
                                                            {
                                                                echo'<option value="'.$row2['desig_id'].'">'.$row2['desig_name'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group"> 
                                                    <h5>Outlet </h5>
                                                        <div class="input-group mb-3">
                                                            <select name="outlet" class="form-control select2" multiple="" id="outlet" onchange="selectAll(this.value)">
                                                            <option value = "All">Select All</option>
                                                            <?php
                                                                $sql5 = mysqli_query($conn , "SELECT * FROM `outlet_details` WHERE `co_id` = '$_SESSION[co_id]'");
                                                                while($rows5 = mysqli_fetch_array($sql5))
                                                                {
                                                            ?>
                                                                <option value = "<?php echo $rows5['UnitId'].'_'.$rows5['ol_name']; ?>"><?php echo $rows5['ol_name']; ?> </option>
                                                            <?php
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="row">
                                                <div class="form-group col-md-12 btn-block">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>    
                                            
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
include('includes/scripts.php');
include('includes/footer.php');
?>


<?php
    if(isset($_SESSION['str']))
    {
?>
    <script>
        $.toast({
            heading: "<?php echo $_SESSION['str']; ?>",
            text : "<?php echo $_SESSION['msg']; ?>",
            position : 'top-right',
            loaderBg : '#fff',
            icon : "<?php echo strtolower($_SESSION['str']); ?>",
            hideAfter : 2000,
            Stack : 6,
            position: 'top-right',
    	    textAlign: 'left',
    	    loader: true,
    	    loaderBg: '#9EC600',
    	    beforeShow: function () {},
    	    afterShown: function () {},
    	    beforeHide: function () {},
    	    afterHidden: function () {
    	        window.location.href = 'add_user.php';
    	    }
        });
    </script>
<?php
    unset($_SESSION['str']);
    unset($_SESSION['msg']);
   }
?>

<script type="text/javascript" >
    
  function selectAll(value) 

{

  if (value == 'All') 

  {

    $.ajax({

      url:'ajax_response.php?action=AllOutlet',

      success:function (data) 

      {

        $('#outlet').html(data);
        $('#outlet .select2-selection__choice').css('color','red');

      }

    })

  }

}
</script>