<?php
    include_once 'connect.php';
    
    $follower   = $_GET['follower'];
    $following  = $_GET['following'];
    $return     = $_GET['return'];

    if($return == 'explore'){
        $for_us  = $_GET['for'];
        $get     = $_GET['get'];
    }

    $create_relation     = mysqli_query ($conn, " INSERT INTO 
                                                  followings (username, following) 
                                                  VALUES ('$follower','$following')" 
                                        );
    
    if($create_relation){
        $increment_follower  = mysqli_query ($conn, " UPDATE users 
                                                      SET followers  = followers + 1
                                                      WHERE username = '$following'"
                                            );
    
        $increment_following = mysqli_query ($conn, " UPDATE users 
                                                      SET followings = followings + 1
                                                      WHERE username = '$follower'"
                                            );
    }                     

    if($return == 'profile')
        header("Location: profile.php?curr_us=$follower&profile_for=$following");
    else if($return == 'explore')
        header("Location: explore.php?curr=$follower&for=$for_us&get=$get");
    exit();
?>