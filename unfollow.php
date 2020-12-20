<?php
    include_once 'connect.php';
    
    $follower     = $_GET['follower'];
    $unfollowing  = $_GET['unfollowing'];
    $return       = $_GET['return'];

    if($return == 'explore'){
        $for_us  = $_GET['for'];
        $get     = $_GET['get'];
    }

    $remove_relation     = mysqli_query ($conn, "DELETE FROM followings
                                                 WHERE  username = '$follower' 
                                                            AND 
                                                        following = '$unfollowing' " 
                                        );
    
    if($remove_relation){

        $decrement_follower  = mysqli_query ($conn, " UPDATE users 
                                                      SET followers  =  CASE
                                                                            WHEN followers > 0 
                                                                            THEN followers - 1
                                                                            ELSE 0
                                                                        END
                                                      WHERE username = '$unfollowing'"
                                            );
    
        $decrement_following = mysqli_query ($conn, " UPDATE users 
                                                      SET followings =  CASE
                                                                            WHEN followings > 0 
                                                                            THEN followings - 1
                                                                            ELSE 0
                                                                        END
                                                      WHERE username = '$follower'"
                                            );
    }                     

    if($return == 'profile')
        header("Location: profile.php?curr_us=$follower&profile_for=$unfollowing");
    else if($return == 'explore')
        header("Location: explore.php?curr=$follower&for=$for_us&get=$get");
    exit();
?>