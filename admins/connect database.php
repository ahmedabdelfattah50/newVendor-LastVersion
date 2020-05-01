<?php
 
    // this is the code of connection to the database ######## (newvendor_data)

    $dsn = 'mysql: host=localhost;dbname=newvendor_data';    
    $user = 'root';    
    $pass = '';
    
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    try {
        $con = new PDO($dsn , $user , $pass , $option);        
        $con -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        // echo "You are connected to database";
    } catch(PDOException $e) {
        echo "Failed to connect to the database" . $e -> getMessage();
    }