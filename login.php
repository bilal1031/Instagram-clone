<?php
    include_once 'connect.php';

    $username  = $_POST['username'];
    $password  = $_POST['password'];

    $result = mysqli_query($conn,  "SELECT 1 AS 'verified'
                                    FROM users
                                    WHERE   username = '$username' 
                                                AND
                                            password = '$password' ");

    $row        = mysqli_fetch_array($result);
    $verified   = $row['verified'];

    if($verified)
        header("Location: feed.php?username=$username");
    else{
        //echo "Wrong passward or Username!";
        header("Location: index.php");
    }
        
    exit();
?>