<?php

    $localhost = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'pontoweb';

    
    $conectaBD = mysqli_connect($localhost,$user,$password,$database);
    mysqli_set_charset($conectaBD, 'UTF8');
     
/*    
    if (!$conectaBD) {
        die("Connection failed: " . mysqli_connect_error());
    }
     * 
     */
   
    /*
    echo "Connected successfully";
    mysqli_close($conectaBD);
     * 
     * 
     */