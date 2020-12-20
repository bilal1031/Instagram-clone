<?php

    if(isset($_POST['submit'])){

        $curr_us        = $_GET['curr_us'];
        $new_username   = $_POST['username'];
        $name           = $_POST['name'];
        $password       = $_POST['password'];
        $email          = $_POST['email'];
        $bio            = $_POST['bio'];
        
        include_once 'connect.php';

        $result = mysqli_query ($conn, "UPDATE users
                                        SET 
                                            username     = '$new_username',
                                            profile_name = '$name',
                                            password     = '$password',
                                            email        = '$email',
                                            bio          = '$bio'
                                        WHERE 
                                            username     = '$curr_us' " 
                                );
        if(!$result){
            echo "SOMETHING WENT WRONG!";
        }
    }
    
    header("Location: edit-profile.php?username=$curr_us");
    exit();
?>