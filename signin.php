<?php
    include "connection.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT 1 AS 'verified'
            FROM users
            WHERE   username = '$username' 
            AND
            password = '$password';";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    if ($row['verified']){
         header("Location:feed.php?username=$username");
         exit();
    } else {
      echo "No user found!";
      header("Location:index.php");
      exit();
    }
    $conn->close();
    

?>