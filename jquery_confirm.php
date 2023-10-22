
<html>
    <head>
    <title>Jquery Confirm</title>
    <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
    </head>
    <body>
       
            <button class="example1 btn btn-primary" >Click me</button>
       
    

    
    
    
<?php

include("includes/footer.php");

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
                            


    
    </script>
</html>


