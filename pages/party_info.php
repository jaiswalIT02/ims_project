<?php
include('includes/security.php');
include('includes/header.php'); 

include('includes/navbar.php'); 
?>

<?php
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $businessname = $_POST['businessname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $sql = mysqli_query($conn, "SELECT * FROM `party_info` WHERE `id` = '$id'");
    $count = mysqli_num_rows($sql);
    if($count > 0)
    {
        $_SESSION['msg'] = "Already this Party pls choose another one ";
        $_SESSION['str'] = 'warning';
        //header('location:party_info.php');
    }
    else 
    {    
        $result= mysqli_query($conn, "INSERT INTO `party_info` (id,name,businessname, contact, address, city) values('','$name','$businessname','$contact','$address','$city');" );
        if($result)
        {
            $_SESSION['msg'] = "Party added sucessfully.";
            $_SESSION['str'] = 'success';
            //header('location:party_info.php');
        } 
    }      
}

if(isset($_GET['delete']))
{
    $del_id=$_GET['delete'];
    $sql="DELETE FROM `party_info` WHERE `id`='$del_id'" ;
    $result=mysqli_query($conn , $sql);
    if($result)
    {
        $_SESSION['msg'] = "Deleted Successfully";
        $_SESSION['str'] = "success";
        //header('Location:party_info.php');
    }
    else
    {
        $_SESSION['msg'] = "Not Deleted !";
        $_SESSION['str'] = "error";
        //header('location:party_info.php');
    }
}
?>
                    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#partydetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Party Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#partyinfo" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add Party Information</span></a> </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="partydetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-dark">
                                                    <tr class="text-light">
                                                        <th>ID </th>
                                                        <th> Name </th>
                                                        <th>Business Name </th>
                                                        <th>Contact</th>
                                                        <th>Address</th>
                                                        <th>City </th>
                                                       
                                                        <th colspan="2" align="center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include('includes/db_connect.php');                    
                                                        $query="SELECT * FROM `party_info` " ;
                                                        $result=mysqli_query($conn,$query);
                                                        $sno = 0;
                                                        while($row= mysqli_fetch_array($result))
                                                        {
                                                            $sno++;
                                                            if($row > 0){

                                                    ?>
                                                        
                                                        <tr>
                                                            <td> <?php echo $sno; ?></td>
                                                            <td> <?php echo $row['name']; ?></td>
                                                            <td> <?php echo $row['businessname']; ?></td>
                                                            <td> <?php echo $row['contact']; ?></td>
                                                            <td> <?php echo $row['address']; ?></td>
                                                            <td> <?php echo $row['city']; ?></td>
                                                           
                                                            <?php
                                                               
                                                                echo '<td> 
                                                                <button class="btn btn-warning" onclick="editPartyDetails(\''.$row['id'].' \', \''.$row['name'].' \',\''.$row['businessname'].' \', \''.$row['contact'].' \',\''.$row['address'].' \', \''.$row['city'].' \')">Edit</button>
                                                            </td>' ?>
                                                           
                                                            <td> 
                                                                <button class="btn btn-danger"><a class="text-light" href="party_info.php?delete=<?php echo $row['id'] ?>">Delete</a></button>
                                                            </td>
                                                        
                                                        </tr>
                                                    <?php
                                                                }else {
                                                                    echo 'No data found';
                                                                }}
                                                    ?>   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="tab-pane" id="partyinfo" role="tabpanel">
                            <div class="p-15"><br>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="hidden" name='id'>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Full Name">
                                            </div>

                                            <div class="form-group">
                                                <label>Business Name </label>
                                                <input type="text" name="businessname" class="form-control" placeholder="Enter Businss Name">
                                            </div>

                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" name="contact" class="form-control" placeholder="Enter Contact no ">
                                            </div>

                                            <div class="form-group">
                                                <label>Full Address</label>
                                                <input type="text" name="address" class="form-control" placeholder="Enter Full Address">
                                            </div>

                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="city" name="city" class="form-control" placeholder="Enter City name">
                                            </div>

                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>    
                                            
                                                <div id="success" class=" alert alert-success text-center " style="display: none">
                                                     <?php if(isset($msg)){  echo $msg ; }?>
                                                </div>
                                            
                                                <div id="error" class=" alert alert-danger text-center " style="display:none">
                                                        Username alraedy exists.
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
    	        window.location.href = 'party_info';
    	    }
        });
    </script>
<?php
    unset($_SESSION['str']);
    unset($_SESSION['msg']);
   }
?>


<script type="text/javascript">
   
    function editPartyDetails(id, name, businessname, contact, address , city)
    {
        {
	    $.confirm({
            title: 'Update Party Details',
            type: 'green' ,
            content: '' +

            '<form action="" class="formName ">' +
            '<div class="form-group">'+   
                '<label for="name">Name</label>'+
                '<input type="text" class="form-control" value="'+name+'" id="Name">'+
            '</div>'+

            '<div class="form-group">'+   
                '<label for="name">Business name</label>'+
                '<input type="text" class="form-control" value="'+businessname+'" id="Businessname">'+
            '</div>'+

            '<div class="form-group">'+   
                '<label for="name">Contact</label>'+
                '<input type="text" class="form-control" value="'+contact+'" id="Contact">'+
            '</div>'+

            '<div class="form-group">'+   
                '<label for="name">Address</label>'+
                '<input type="text" class="form-control" value="'+address+'" id="Address">'+
            '</div>'+

            '<div class="form-group">'+   
                '<label for="name">City</label>'+
                '<input type="text" class="form-control" value="'+city+'" id="City">'+
            '</div>'+

            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Update',
                    btnClass: 'btn-warning',
                    action: function () 
                    {
                        error = true;
                        var name_new =  this.$content.find('#Name').val();
                        var businessname_new =  this.$content.find('#Businessname').val();
                        var contact_new =  this.$content.find('#Contact').val();
                        var address_new =  this.$content.find('#Address').val();
                        var city_new =  this.$content.find('#City').val();
                
                        if(error){
                            $.ajax({
                                url : 'ajax_response.php?action=UpdatePartyDetails&name='+name_new+'&businessname='+businessname_new+'&contact='+contact_new+'&address='+address_new+'&city='+city_new+'&id='+id,
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
                                                window.location.href = 'party_info.php';
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

