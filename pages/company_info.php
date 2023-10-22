<?php

    include('includes/security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<?php 

    if(isset($_POST['submit']))
    {     
        $id = $_POST['id'];
        $companyname = $_POST['companyname'];
        $sql = "INSERT INTO `company_name` (id,companyname) values('$id','$companyname')";
        $result = mysqli_query($conn,$sql);
        if($result > 0) {
            $_SESSION['str'] = "success";
            $_SESSION['msg'] = "Company name Inserted Successfully";
        }else {
            $_SESSION['str'] = "error";
            $_SESSION['msg'] = "try again.";
        }      
    }
    
    if(isset($_GET['delete']))
    {
        $del_id=$_GET['delete'];
        $sql="DELETE FROM `company_name` WHERE `id`='$del_id'" ;
        $result=mysqli_query($conn , $sql);
        if($result){
            $_SESSION['str'] = "success";
            $_SESSION['msg'] = "Company name Deleted Successfully";
        }else{
            $_SESSION['str'] = "Error";
            $_SESSION['msg'] = "Data not Deleted";
        }
    }

    
?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body">
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#companydetails" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Company Details</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#addcompany" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add Company</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active " id="companydetails" role="tabpanel">
                            <div class="p-15">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-dark text-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Unit Name </th>
                                                        <th colspan="2" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php           
                                                        $comp = new Company();
                                                        $sno= 1;
                                                        foreach($comp->companyData() as $row):   
                                                    ?>
                                                        <tr>
                                                            <td> <?php echo $sno; ?></td>
                                                            <td> <?php echo $row['companyname']; ?></td>
                                                            <?php echo 
                                                            "<td> 
                                                                <button type='button' onclick='editCompanyDetails(\"".$row["id"]." \",\"".$row["companyname"]." \")' class='btn btn-warning btn-md'>Update</button>
                                                            </td>";
                                                            
                                                            echo '<td><a href="company_info?delete='.$row['id'].'" class="btn btn-danger btn-md">Delete</a> </td>'
                                                            ?>
                                                        </tr>
                                                    <?php
                                                       $sno++; 
                                                       endforeach;                                                   
                                                    ?>    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="addcompany" role="tabpanel">
                            <div class="p-15"><br>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                    
                                            <div class="form-group">
                                                <label> Company Name </label>
                                                <input type="hidden" name='id'>
                                                <input type="text" name="companyname" class="form-control" id="Company" placeholder="Enter Company name" onblur="CheckCompany(this.value)" required/>
                                            </div>

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
    	        window.location.href = 'company_info';
    	    }
        });
    </script>
<?php
    unset($_SESSION['str']);
    unset($_SESSION['msg']);
   }
?>


<script>

    function CheckCompany(comp)
        {
            error = false; 
            $(".unit-error").html("");
            
            if(!comp){
                msg = "Enter the company name";
                error = true;
            }else if(!isNaN(comp)){
                msg = 'Please enter alphabet only';
                error = true;
            }
            $.ajax({
                    url:'ajax_response.php?action=checkCompanyDuplicate&comp='+comp,
                    success:function(data) 
                    {
                        console.log(data);
                        if (data>0) {
                            Swal.fire({
                                title: ' ',
                                text : 'This company already exists',
                                type: 'danger',
                                showConfirmButton: true,
                                confirmButtonColor: '#66CDAA',
                                confirmButtonText: 'ok',
                                })
                            error = true;
                        }
                        if (error){
                            $('#Company').val('');
                        }   
                    }
                });   
        }

    function editCompanyDetails(id, companyname)
    {
        //alert('check PLZ');
        {
            $.confirm({
                title: 'Update Company Details',
                type: 'green',
                content: '' +
                '<form action="" class="formName ">' +
                '<div class="form-group">'+   
                    '<label for="companyname">Company Name</label>'+
                    '<input type="text" class="form-control" value="'+companyname+'" id="Companyname" required >'+
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
                            var companyname_new =  this.$content.find('#Companyname').val();
                            
                            if(error){
                                //alert("pressed");
                                $.ajax({
                                    url : 'ajax_response.php?action=UpdateComapanyDetails&companyname='+companyname_new+'&id='+id,
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
                                                window.location.href = 'company_info';
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