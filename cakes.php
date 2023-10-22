<?php
	include("includes/header.php");
	
	if(isset($_POST['submit']))
	{
	    date_default_timezone_set('Asia/Kolkata');   
	    
	    $dateTime = date('Y-m-d h:i:s');
	    $cake_catg	 = $_POST['cake_catg'];
	    $weight = $_POST['cakeWeight'];
	    //echo $weight;
	    
	    if($weight == 'new')
	    {
	      $weight = $_POST['newWeight']; 
	    }
	    

	    $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $temp_name = $_FILES['file']['tmp_name'];
        $file_destination = 'upload/album/'.$file_name;
        
    
        if (($file_name != " ") && ($weight != ""))
        {
            
            if(!file_exists($file_destination))
            {
                
                 if(move_uploaded_file($temp_name, $file_destination))
                 {
    
                    $sql = "INSERT INTO `outlet_cake_album`(`co_id`, `cake_catg`, `cake_weight`, `cake_pic`,`entry_date_time`) VALUES ('$_SESSION[co_id]','$cake_catg','$weight','$file_destination','$dateTime')";
                    
             	    $res =  mysqli_query($connect,$sql);
             	    
    		     }
            }
            else
            {
                
                $file_destinate = 'upload/album/'.rand(10 , 100).$file_name;
                
                 if(move_uploaded_file($temp_name, $file_destinate))
                 {
                 
                    $sql = "INSERT INTO `outlet_cake_album`(`co_id`, `cake_catg`, `cake_weight`, `cake_pic`,`entry_date_time`) VALUES ('$_SESSION[co_id]','$cake_catg','$weight','$file_destinate','$dateTime')";
                    
             	    $res =  mysqli_query($connect,$sql);
             	    
    		     }
                
            }

        }
        if ($res) 
        {
            $_SESSION['sts'] = 'Success';
            $_SESSION['msg'] = 'Cake Successfully Added in Album.';
            header('Location:cakes.php');
            
        }
        else
        {
            $_SESSION['sts'] = 'Error';
            $_SESSION['msg'] = 'Please Try Again.';
            header('Location:cakes.php');
            
        }
    
	}
	if(isset($_GET['action']) && $_GET['action'] == 'Delete'){

      $id = $_GET['cake_id'];
      $image_destination = $_GET['image_destination'];

      mysqli_query($connect , "DELETE FROM `outlet_cake_album` WHERE `cake_id`='$id'");
      unlink($image_destination);

      header('location:cakes.php');
    }

	
?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid" style="background-color:#F06F81">
			<div class="box-header p-10">
			   <h4 class="box-title" style="color:white;"><strong>Manage Cake Album</strong></h4>
			</div>
			
			<div class="box-body pb-0">
			   <form action="" method="post" class="form-horizontal form-element" enctype="multipart/form-data">
				   <div class="col-md-12">
					  <div class="form-group row">
                        <div class="col-md-3">
                            <label for="category_name" class="control-label font-weight-bold">Category Name</label>
                            <select class="form-control required" id="category_name" name="cake_catg" required>
                                <option disabled selected></option>
                                <?php  
                                    $catg_sql = "SELECT cake_catg FROM `cake_category_master` WHERE `co_id` = '$_SESSION[co_id]' OR `co_id` = '0'";
                                    $catg_res = mysqli_query($connect, $catg_sql);
                                    while ($catg_row = mysqli_fetch_assoc($catg_res)) 
                                    {
                                        echo '<option value="'.$catg_row['cake_catg'].'">'.$catg_row['cake_catg'].'</option>';              
                                    }
                                ?>
                            </select>
                            <span class="text-danger" id="Catg-Name"></span>
                        </div>
                        <div class="col-md-3">
                            <label for="cakeweight" class="form-label font-weight-bold">Cake Weight (Kg)</label>  
                            <select class="form-control required" id="Weight" name="cakeWeight" onchange="newWeightInput(this.value)" style="display:block;" required>
                                <option disabled selected></option>
                                <option value="0.5">0.5 kg</option>
                                <option value="1">1 Kg</option>
                                <option value="1.5">1.5 Kg</option>
                                <option value="2.0">2.0 Kg</option>
                                <option value="2.5">2.5 Kg</option>
                                <option value="3.0">3.0 Kg</option>
                                <option value="3.5">3.5 Kg</option>
                                <option value="4.0">4.0 Kg</option>
                                <option value="4.5">4.5 Kg</option>
                                <option value="5.0">5.0 Kg</option>
                                <option value="new">Custom Weight</option>
                            </select>
                            <input type="text" name="newWeight" class="form-control" id="newweight" minlength="1" maxlength="5" onblur="validation(this.value , 'Name' , 'newweight')"  style="display:none;">
                            <span class="text-danger" id="Name"></span><br>
                        </div>
                        <div class="col-md-3">
                            <label for="photo" class="form-label font-weight-bold">Photo</label>
                            <div class="custom-file">
							  <input type="file" name="file" class="form-control" id="image" onblur="validation(this.value , 'File', 'file')"  required>
							  <!--<label class="custom-file-label" for="customFile">Choose file</label>-->
						    </div>
						    <span class="text-danger" id="File"></span><br>
                        </div>
                        <div class="col-md-3">
							<input type="submit" name="submit" class="btn btn-success btn-md mr-4" style="margin-top: 1.9rem!important" value="Upload" />
							<!--<button type="reset" class="btn btn-md btn-default" style="margin-top: 1.9rem!important">Reset</button>-->
						</div>
                      </div>
					  <br/>
        		   </div>
			   </form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid" style="background-color:#F06F81;">
		   <div class="box-header"></div>
		   <div class="box-body">
			<table id="dtBasicExample" class="table table-striped table-bordered table-sm responsive-table" cellspacing="0" width="100%">
			 	<thead>
				    <tr>
				      <th class="th-sm">Picture</th>
				      
				      <th class="th-sm">Category</th>
				      
				      <th class="th-sm">Minimum&nbsp;Weight</th>
				      
				      <th>Action</th>
				      
				    </tr>
			  	</thead>
			    <tbody>
				     <?php 
                        $sql1 = "SELECT `co_id`, `cake_id`, `cake_catg`, `cake_weight`, `cake_pic` FROM `outlet_cake_album` WHERE `co_id` = '$_SESSION[co_id]'";

                        $query = mysqli_query($connect , $sql1);

                        while($row = mysqli_fetch_array($query)){

                        	echo '<tr>';

                        	 echo '<td><a href="'.$row['cake_pic'].'"  data-fancybox="gallery" data-width="600" data-height="550" ><img src="'.$row['cake_pic'].'" class="img-avatar-nu" height="40px" width="40px"></a></td>';

                        	 echo '<td>'.$row['cake_catg'].'</td>';

                        	 echo '<td>'.$row['cake_weight'].' Kg</td>';

                        	 echo '<td><a href="cakes.php?action=Delete&cake_id='.$row['cake_id'].'&image_destination='.$row['cake_pic'].'" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

                        	 echo '</tr>';

				        } 
				     ?>
				</tbody>
			</table>
		   </div>
		</div>
	</div>
</div>



<?php
	include("includes/footer.php");
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
	        afterHidden: function () {}
	    });
	    //window.setTimeout(function(){window.location.href = "<?php echo $_SESSION['reload']; ?>";}, 3000);
	</script>
<?php
        unset($_SESSION['sts']);
	    unset($_SESSION['msg']);
    }
?>

<script type="text/javascript">
    $('[data-fancybox]').fancybox({
       loop : false,
       buttons : [
           "zoom",
           "share",
           "download",
           "fullScreen",
           "slideShow",
           "thumbs",
           "close"
           ],
    });
</script>



<script type="text/javascript">
 $(document).ready(function() {
	$('#example1').DataTable( {
		
	} );
} );


/* Image pop up */
$(function() {
	$('.pop').on('click', function() {
		$('.imagepreview').attr('src', $(this).find('img').attr('src'));
		$('#imagemodal').modal('show');   
	});		
});


</script>

<script>
   function validation(value, check, input) 
    {
      var weight = $('#'+input).val();
      var dotposition = weight.lastIndexOf(".");
      error = false; 
      $('#'+check).html('');

      if (check == 'Name') {
        if (!value) {
          msg = 'enter the cake weight';
          error = true;
        } else if(isNaN(value)){
          msg = 'please enter numeric only';
          error = true;
        } /*else if(dotposition < 0 || dotposition+2 >= weight.length){
          msg = 'only enter the 3 decimal number';
          error = true;   
        }*/
      } 
      
      if (error) {
        $('#'+check).html(msg);
        $('#'+input).val('');
      }
    }
    
    function newWeightInput(value)
    {
        if(value == 'new')
        {
           $('#Weight').css('display','none');
           $('#newweight').css('display','block');
        }
    }
</script>
<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

</script>

<script>
(function($) {
    $.fn.checkFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {

            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();

                }

            });

        });
    };

})(jQuery);

$(function() {
    $('#image').checkFileType({
        allowedExtensions: ['jpg','jpeg','png'],
        error: function() {
            alert('Not valid extension');
            $('#image').val(" ");
        }
    });

});
</script>

<script type="text/javascript">
  $(document).ready(function(){
      
       var weight = $('#weight').val();
       
       if(weight == 'new')
       {
           $('#weight').css('display','none');
           $('#newweight').css('display','block');
       }
      
       $('.btn-danger').on('click',function(e){
        e.preventDefault();
        const href = $(this).attr('href')
        Swal.fire({
           title: 'Are You Sure',
           text: 'You want to delete this image?',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Delete Image',
        }).then((result) => {
               if(result.value){
                   document.location.href = href;
               }
        })
    })
  })
</script>
