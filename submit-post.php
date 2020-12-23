<?php
    include_once 'connect.php';

    if(isset($_POST['submit'])){
        $username       = $_POST['user_name'];
        $description    = $_POST['discription'];

        $target  = "photos/".basename($_FILES['fileToUpload']['name']);
        $image   = $_FILES['fileToUpload']['name'];

        $query =   "INSERT INTO POSTS(username, photo, description)
                    VALUES ('$username', 'photos/$image', '$description') "; 
            
        if(mysqli_query($conn, $query)){
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target);

            $increment_posts = mysqli_query($conn, "UPDATE users
                                                    SET posts = posts+1
                                                    WHERE username = '$username'"
                                        );

            $conn->close();
            header("Location: feed.php?username=$username");
            exit();
        }
    }
?>