<?php

include('includes/header.php'); 

$date = date('Y-m-d');
?>
<style>
  span
  {
    color:red;
    margin-left:2.2rem; 
  }

  
</style>

<?php

  $usernameErr = $passwordErr = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
      if (!($_POST["username"]))
      {
        $usernameErr = "username is required";
      }else {
        $username = explode('@', $_POST['username']);
        $user = $username[0];
        $brandcode = $username[1];
      }

      if (!($_POST["password"])) {
          $passwordErr = "password is required";
      } else {
          $password = $_POST["password"];
      }
  }


if(isset($_POST['login']))
{
  if(isset($brandcode) && $brandcode != ''){
    $sql_log = "SELECT * FROM `login_master` WHERE `co_id` = '$brandcode' AND `user_login` = '$user' AND `user_password` = '". $_POST["password"]."'";
    $res = mysqli_query($conn,$sql_log);
   // $row  = mysqli_fetch_array($res);
    $count = mysqli_num_rows($res);
    
    if($count>0)
    {
      $result = mysqli_query($conn, "SELECT `co_id`,`brand_name`, `full_name`,`co_logo`, `OPT_mode`, `co_email`, `co_phone`, `no_of_outlets` FROM `company_details` WHERE `co_id`= '$brandcode'");
      $row2 = mysqli_fetch_array($res);
      $row = mysqli_fetch_assoc($result);
  
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
       $_SESSION["password"] = $row2['user_password'];

       /*
       $_SESSION['user'] = ['brand_name'=>$row['brand_name'],
                            'company_logo' => $row['co_logo'],
                            'OPT_mode' => $row['OPT_mode'],
                            'co_email' => $row['co_email'],
                            'co_phone' => $row['co_phone'],
                            'no_of_outlets' => $row['no_of_outlets'],
                            'co_id' => $row2['co_id'],
                            'full_name' => $row2['user_name'],
                            'user_login' => $row2['user_login'],
                            'desig_id' => $row2['desig_id'],
                          ];
      */
      if ($_POST['rememberme']) 
          {
            setcookie("usernamecookie",$_POST["username"], time()+ (10 * 365 * 24 * 60 * 60));
            setcookie("passwordcookie",$_POST["password"], time()+ (10 * 365 * 24 * 60 * 60));
            setcookie("remembermecookie",$_POST['rememberme'], time()+ (10 * 365 * 24 * 60 * 60));
          }
          if($_SESSION['desig_id'] == 1 || $_SESSION['desig_id'] == 3){
             mysqli_query($conn, "UPDATE `company_details` SET `last_login`='$date' WHERE `co_id` = '$_SESSION[co_id]'"); 
          }
          mysqli_query($conn, "UPDATE `company_details` SET `is_first_login`= '0' WHERE `co_id` = '$_SESSION[co_id]'");
          
          $_SESSION['sts'] = 'Success';
          $_SESSION['msg'] = 'Successfully login.';	
          $_SESSION['reload'] = 'dashboard';
    } else
    {
      $_SESSION['sts'] = 'Error';
      $_SESSION['msg'] = 'Inavlid login details.';
      $_SESSION['reload'] = 'index';	
    }
    
  
  }else{
    $_SESSION['sts'] = 'Error';
    $_SESSION['msg'] = 'Inavlid company code.';
    $_SESSION['reload'] = 'index';	
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
                    </div>
                    <span class="user-error"><?php echo $usernameErr; ?></span><br>
                    

                    <div class="input-group">
                      <div class="input-group-append">
                          <div class="btn btn-primary"><i class="fas fa-lock "></i></div>
                      </div>
                      <input type="password" name="password" class="form-control form-control-user" value='<?php if (isset($_COOKIE['passwordcookie'])){echo ($_COOKIE['passwordcookie']);} ?>' placeholder="Password" />
                    </div>
                    <span class="pass-error"><?php echo $passwordErr; ?></span><br>

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
