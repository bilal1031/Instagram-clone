<?php
    function usercheck($username){
        $flag = false;
            include "connect.php";
             
            $result = mysqli_query($conn,  "SELECT 1 AS 'verified' 
                                            FROM users 
                                            WHERE username = '$username'");
            $row        = mysqli_fetch_array($result);

            if($row['verified'])
                $flag = true;
            else
                $flag = false;

        return $flag;
    }

    if(isset($_POST["register"]))
    {   
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $profilename    = $_POST['profilename'];
        $email          = $_POST['email'];
        $bio            = $_POST['bio'];

        if (isset($_POST['register'])) {
            if(usercheck($username)){
               header("Location:registration.php?reg=0");
               exit();
            }else{
                include "connect.php";

                $target = "photos/".basename($_FILES['image']['name']);
                $image = $_FILES['image']['name'];
                //echo 'photos/'.$image;
               
                $query =   "INSERT INTO users (username,password,profile_name,profile_picture,email,bio) 
                            VALUES ('$username', '$password', '$profilename', 'photos/$image', '$email', '$bio')";

                $result = mysqli_query($conn, $query);

                if($result){
                    move_uploaded_file($_FILES['image']['tmp_name'], $target);
                    $conn->close();
                    header("Location:registration.php?reg=1");
                    exit();
                }else{
                    $conn->close();
                    header("Location:registration.php?reg=0");
                    exit();
                    echo("Error description: " . mysqli_error($conn));
                }
            }
        }
    }else{
        header("Location:404.php");
        exit(); 
    }  
 ?>