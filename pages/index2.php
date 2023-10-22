<?php
session_start();
include('includes/header.php'); 
include('includes/db_connect.php');
?>
<style>
  span
  {
    color:red;
    
  }
</style>

<?php

/*
if(isset($_POST['login'])) {
  include('includes/db_connect.php');
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $count = 0;
  $result = mysqli_query($conn,"SELECT * FROM user_master WHERE username='$username' and password = '$password' ");
  $count = mysqli_num_rows($result);

  if($count > 0)
  {
    header('location: dashboard.php');
    ?>

<?php
  }else{ 
        $msg = 'Invalid username or password !'
    
    ?>
   
    <?php
  }
}

*/
/*
$username = $password = "";

if(count($_POST)>0) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  
  $result = mysqli_query($conn,"SELECT * FROM `user_register` WHERE `user_login` = '$username' AND `password` = '$password' ");
  $usertype = mysqli_fetch_array($result);
  echo '<pre>';
  print_r($usertype);
  exit;
  if($usertype['desig_id'] == '1')
  {
      $_SESSION['user_login'] = $username;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['sts'] = 'Success';
      $_SESSION['msg'] = 'Successfully login.';	
      header('location:dashboard.php');
  }
  else {
    $_SESSION['sts'] = 'Error';
    $_SESSION['msg'] = 'Inavlid login credentials.';
    $_SESSION['reload'] = 'index.php';	
  }
}
*/


$usernameErr = $passwordErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }
}
$username = $password = "";
if(isset($_POST['login'])) 
{

  if ($username == '' || $password == '' ) 
  {
    $username = $_POST["username"];
    $password = $_POST["password"];   
    $logquery = "SELECT * FROM  `user_register` WHERE `user_login` = '$username' AND `password` = '$password' ";
    $res = mysqli_query($conn, $logquery);
   // $result = mysqli_fetch_array($res);
    $count = mysqli_num_rows($res);
    //echo $count;    
  
    if ($count>0) 
			{
			    
		    $qry = "SELECT `brand_name`, `full_name`,`co_logo`, `OPT_mode`, `co_email`, `co_phone`, `no_of_outlets` FROM `company_details` WHERE `co_id`= '$brandcode'";
				$result = mysqli_query($conn, $qry);
				$row = mysqli_fetch_assoc($result);
				$row2 = mysqli_fetch_assoc($res);

				$_SESSION['brand_name'] = $row['brand_name'];
				$_SESSION['company_logo'] = $row['co_logo'];
				$_SESSION['OPT_mode'] = $row['OPT_mode'];
				$_SESSION['co_email'] = $row['co_email'];
				$_SESSION['co_phone'] = $row['co_phone'];
				$_SESSION['no_of_outlets'] = $row['no_of_outlets'];
				$_SESSION['co_id'] = $row2['co_id'];
				$_SESSION['full_name'] = $row2['user_name'];
				$_SESSION['user_login'] = $row2['user_login'];
				$_SESSION['desig_id'] = $row2['desig_id'];
				//$_SESSION['is_first_login'] = $row2['is_first_login'];
				
				
				if ($_POST['rememberme']) 
				{

					setcookie("usernamecookie",$brandname, time()+ (10 * 365 * 24 * 60 * 60));
					setcookie("passwordcookie",$password, time()+ (10 * 365 * 24 * 60 * 60));
					setcookie("remembermecookie",$_POST['rememberme'], time()+ (10 * 365 * 24 * 60 * 60));
				}
				if($_SESSION['desig_id'] == 1 || $_SESSION['desig_id'] == 3){
				   mysqli_query($connect , "UPDATE `company_details` SET `last_login`='$date' WHERE `co_id` = '$_SESSION[co_id]'"); 
				}
				mysqli_query($connect , "UPDATE `company_details` SET `is_first_login`= '0' WHERE `co_id` = '$_SESSION[co_id]'");
				$_SESSION['sts'] = 'Success';
        $_SESSION['msg'] = 'Successfully login.';	
        //$_SESSION['reload'] = 'dashboard.php';
				header('Location:dashboard.php');
			}else{
				$_SESSION['sts'] = 'Error';
        $_SESSION['msg'] = 'Inavlid login credentials.';
        $_SESSION['reload'] = 'index.php';	        
			}

      
  }
  
}


?>




<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
            
              </div>

                <form class="user" action="" method="POST">

                    <div class="input-group">
                      <div class="input-group-append">
                        <div class="btn btn-primary" ><i class="fas fa-user fa-sm"></i></div>
                      </div>
                      <input type="text" name="username" class="form-control form-control-user" value='<?php if (isset($_COOKIE['usernamecookie'])){echo($_COOKIE['usernamecookie']);} ?>' placeholder=" Username" />
                    </div><br>
                    <span class="user-error"><?php echo $usernameErr; ?></span>
                    

                    <div class="input-group">
                      <div class="input-group-append">
                          <div class="btn btn-primary"><i class="fas fa-lock "></i></div>
                      </div>
                      <input type="password" name="password" class="form-control form-control-user" value='<?php if (isset($_COOKIE['passwordcookie'])){echo($_COOKIE['passwordcookie']);} ?>' placeholder="Password" />
                    </div><br>
                    <p class="error pass-error"><?php echo $passwordErr; ?></p>

                    <div class="row">
									      <div class="col-6">
									         <div class="checkbox">
									         	<input type="checkbox" id="basic_checkbox_1" name="rememberme" value="1" <?php if (isset($_COOKIE['remembermecookie'])){echo 'checked';} ?>>
										        <label for="basic_checkbox_1" style="font-size:16px;">Remember Me</label>
									        </div>
									      </div>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>
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
?>

<?php
    if(isset($_SESSION['sts'])){
?>
  <script>
    $.toast({
          heading: "<?php echo $_SESSION['sts']; ?>",
          text : "<?php echo $_SESSION['msg']; ?>",
          position : 'top-right',
          loaderBg : '#fff',
          icon : "<?php echo strtolower($_SESSION['sts']); ?>",
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
    	    }
        });
        window.setTimeout(function(){window.location.href = "<?php echo $_SESSION['reload']; ?>";}, 3000);
  </script>
<?php
    unset($_SESSION['sts']);
    unset($_SESSION['msg']);
   }
?>
