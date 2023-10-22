<?php
    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<?php

if(isset($_POST['submit'])){
    
    //$id = $_POST['id'];
    $unitname = $_POST['unitname'];
    $sql = "INSERT INTO `unit_master` (unitname) values('$unitname');";
    $result = mysqli_query($conn,$sql);
    if($result > 0) {
        $_SESSION['msg'] = "Unit Name inserted successfully";
        $_SESSION['str'] = "success" ;
    }else {
        $_SESSION['str'] = "error";
        $_SESSION['msg'] = "Please try again.";
    }    
}


if(isset($_GET['delete']))
{
    $del_id=$_GET['delete'];
    $sql="DELETE FROM `unit_master` WHERE `id`='$del_id'" ;
    $result=mysqli_query($conn , $sql);
    if($result){
        $_SESSION['msg'] = "Unit name Deleted Successfully";
        $_SESSION['str'] = "success";    
    }else{
        $_SESSION['msg'] = "Data not Deleted.";
        $_SESSION['str'] = "error";
    }
}
?>

                    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">  
       
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#userdetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Unit Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#adduser" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add Unit</span></a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="userdetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-dark text-light">
                                                    <tr>
                                                        <th> SR. No.</th>
                                                        <th>Unit Name </th>
                                                        <th colspan="2" class="text-center">Action</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $unitData = new Unit();                                      
                                                        $sno= 1;
                                                        if($unitData->unitData() != ""){
                                                           foreach($unitData->unitData() as $row):
                                                    ?>
                                                        <tr>
                                                            <td> <?php echo $sno;?></td>
                                                            <td> <?php echo $row['unitname']; ?></td>
                                                            <?php echo 
                                                            "<td> 
                                                                <button type='button' onclick='editUnitDetails(\"".$row["id"]."\",\"".$row["unitname"]."\")' class='btn btn-warning btn-md'>Update</button>
                                                            </td> "
                                                             ?>                                                         
                                                            <td> 
                                                                <button class="btn btn-danger"><a class="text-light" href="add_unit.php?delete=<?php echo $row['id'] ?>">Delete</a></button>
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

                        <div class="tab-pane" id="adduser" role="tabpanel">
                            <div class="p-15"><br>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <div><label> Unit Name </label></div><br>
                                                <input type="text" name="unitname" id="Units" class="form-control" placeholder="Enter Unitname" onblur="CheckUnit(this.value)" required />
                                                <p class="error unit-error text-danger col-md-8"></p> 
                                            </div><br>

                                            <div>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>  <br>   
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
    	        window.location.href = 'add_unit.php';
    	    }
        });
    </script>
<?php
    unset($_SESSION['str']);
    unset($_SESSION['msg']);
   }
?>

<script type="text/javascript">

    
    $('.example1').on('click', function(){
        $.confirm({
            title: 'Confirm!',
            content: 'Simple confirm!',
            buttons: {
                confirm: function(){
                    $.alert('Confirmed!');
                },
                cancel: function(){
                    $.alert('Canceled!');
                },
                somethingElse: {
                    text: 'Something else',
                    btnClass: 'btn-blue',
                    keys: [
                        'enter',
                        'shift'
                    ],
                    action: function(){
                        this.$content // reference to the content
                        $.alert('Something else?');
                    }
                }
            }
        });
    });

    function CheckUnit(unit)
    {
        error = false; 
        $(".unit-error").html("");
        
        if(!unit){
            msg = "Enter the unit";
            error = true;
        }else if(!isNaN(unit)){
            msg = 'Please enter alphabet only';
            error = true;
        }
        $.ajax({
                url:'ajax_response.php?action=checkUnitDuplicate&unit='+unit,
                success:function(data) 
                {
                    console.log(data);
                    if (data>0) {
                        Swal.fire({
                            title: ' ',
                            text : 'This unit already exists',
                            type: 'danger',
                            showConfirmButton: true,
                            confirmButtonColor: '#66CDAA',
                            confirmButtonText: 'ok',
                            })
                        error = true;
                    }
                    if (error){
                        $('#Units').val('');
                    }   
                }
            });   
    }

    function editUnitDetails(id, unitname)
    {
       {
	    $.confirm({
            title: 'Update Unit Details',
            type: 'green',
            content: '' +
            '<form action="" class="formName ">' +
            '<div class="form-group">'+   
                '<label for="unitname"> Unit Name</label>'+
                '<input type="text" class="form-control" value="'+unitname+'" id="Unitname" required >'+
                '<span id="UserEmail" class="text-danger"></span>'+
            '</div><br>'+     
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Update',
                    btnClass: 'btn-warning',
                    action: function () 
                    {
                        error = true;
                        var unitname_new =  this.$content.find('#Unitname').val();
                        if(error){
                            $.ajax({
                                url : 'ajax_response.php?action=UpdateUnitDetails&unitname='+unitname_new+'&id='+id,
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
                                            window.location.href = 'add_unit.php';
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



