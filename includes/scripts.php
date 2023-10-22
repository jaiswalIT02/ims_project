  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <script src="jquery/jquery.js"></script>

  <!-- UltimatePro Admin App -->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="plugin/datatables/jquery.dataTables.min.js"></script>

<script src="plugin/datatables/dataTables.bootstrap.min.js"></script>


<!-- UltimatePro Admin for demo purposes -->


<!-- UltimatePro Admin for advanced form element -->

<!-----<script src="plugin/fancyBox/js/jquery.fancybox.js"></script>---------->

<script src="plugin/fancyBox/js/jquery.fancybox.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<script src="js/toast.min.js" ></script>
<script src="js/sweet.alert.min.js"></script>


<?php
if(isset($_SESSION['str']) && $_SESSION['str'] != ''){
    ?>
<script type="text/javascript">

swal({
  title: "<?php echo $_SESSION['status']; ?>",
  //text: "",
  icon: "<?php echo $_SESSION['status_code'];?>",
  button: "OK ",
}); 
</script>
<?php 
  unset($_SESSION['status']);
}
?>
  <?php
/*

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    if($password === $confirm_password)
    {
        $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run)
        {
            echo "done";
            $_SESSION['success'] =  "Admin is Added Successfully";
            header('Location: register.php');
        }
        else 
        {
            echo "not done";
            $_SESSION['status'] =  "Admin is Not Added";
            header('Location: register.php');
        }
    }
    else 
    {
        echo "pass no match";
        $_SESSION['status'] =  "Password and Confirm Password Does not Match";
        header('Location: register.php');
    }

}
*/
?>