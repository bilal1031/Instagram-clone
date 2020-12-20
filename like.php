<?php
    include_once 'connect.php';
    
    $is_liked = $_GET['is_liked'];
    $post_id  = $_GET['post_id'];
    $username = $_GET['username'];

    if($is_liked == 1){
        $result = mysqli_query($conn, "DELETE 
                                       FROM likes
                                       WHERE likername = '$username'
                                              AND 
                                             post_id = $post_id "
                              );

        $decrement_likes = mysqli_query($conn, "UPDATE posts
                                                SET likes = likes-1
                                                WHERE post_id = $post_id"
                                        );
    }else{
        $result = mysqli_query($conn, " INSERT INTO 
                                        likes(post_id, likername)
                                        values ($post_id, '$username')"
                              );

        $increment_likes = mysqli_query($conn, "UPDATE posts
                                                SET likes = likes+1
                                                WHERE post_id = $post_id"
                                        );
    }

    header("Location: feed.php?username=$username");
    exit();
?>