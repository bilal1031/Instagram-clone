<?php
    include_once 'connect.php';
    
    $comment  = $_POST['comment'];
    $post_id  = $_GET['post_id'];
    $username = $_GET['username'];
    $return_to= $_GET['return_to'];

    if($comment != null){
        $result = mysqli_query($conn, "INSERT INTO 
                                        comments(commentername, post_id, comment_text)
                                        values ('$username','$post_id','$comment')"
                              );

        $increment_comments = mysqli_query($conn, " UPDATE posts
                                                    SET comments = comments+1
                                                    WHERE post_id = $post_id"
                                        );
    }

    if($return_to == "feed"){
        header("Location: feed.php?username=$username");
    }else{
        header("Location: image-detail.php?post_id=$post_id&curr_us=$username");
    }
    exit();
?>