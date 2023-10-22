<?php

   // $conn = mysqli_connect('localhost','root','','ims_project') or die('not connected db.');
    // Create connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        print_r($conn);
       // die("Connection failed: " . $conn->connect_error);
    }
   
?>