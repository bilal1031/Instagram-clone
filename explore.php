<?php
    $curr_us   = $_GET['curr'];
    $for_us    = $_GET['for'];
    $get       = $_GET['get'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Explore | Instaclone</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <nav class="navigation">
            <a href="feed.php?username=<?php echo $curr_us?>">
                <img 
                    src="images/navLogo.png"
                    alt="logo"
                    title="logo"
                    class="navigation__logo"
                />
            </a>
            <div class="navigation__icons">
                <a href="explore.html" class="navigation__link">
                    <i class="fa fa-compass"></i>
                </a>
                <a href="#" class="navigation__link">
                    <i class="fa fa-heart-o"></i>
                </a>
                <a href="profile.html" class="navigation__link">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
        </nav>
        <main class="explore">
            <section class="people">
                <ul class="people__list">

                <?php
                    include_once 'connect.php';

                    if($get == "followings"){
                        $result = mysqli_query($conn, " SELECT
                                                            followings.following    AS 'usernamee', 
                                                            users.profile_name      AS 'profile_name', 
                                                            users.profile_picture   AS 'profile_picture',
                                                            (
                                                                SELECT  1
                                                                FROM    followings
                                                                WHERE   followings.username = '$curr_us'
                                                                            AND
                                                                        followings.following = usernamee
                                                            )                       AS 'isFollowing'
                                                        FROM followings
                                                        JOIN users
                                                        ON followings.following   = users.username
                                                        WHERE followings.username = '$for_us' "
                                              );

                    }else if($get == "followers"){
                        $result = mysqli_query($conn, " SELECT
                                                            followings.username     AS 'usernamee',  
                                                            users.profile_name      AS 'profile_name',
                                                            users.profile_picture   AS 'profile_picture',
                                                            (
                                                                SELECT  1
                                                                FROM    followings
                                                                WHERE   followings.username = '$curr_us'
                                                                            AND
                                                                        followings.following = usernamee
                                                            )                       AS 'isFollowing'
                                                        FROM followings
                                                        JOIN users
                                                        ON followings.username   = users.username
                                                        WHERE followings.following = '$for_us' "
                                              );

                    }else if($get == 'search'){
                        if(isset($_POST['search_for']))
                            $for_us = $_POST['search_for'];
                        else
                            $for_us = $_GET['for'];
                        
                        $result = mysqli_query($conn, "SELECT 
                                                            users.username 			    AS 'usernamee',
                                                            users.profile_name 		    AS 'profile_name',
                                                            users.profile_picture 	    AS 'profile_picture',
                                                            (
                                                                SELECT  1
                                                                FROM    followings
                                                                WHERE   followings.username = '$curr_us' 
                                                                            AND
                                                                        followings.following = usernamee
                                                            )						    AS 'isFollowing'
                                                        FROM users
                                                        WHERE 	users.username     LIKE '%$for_us%'     -- searching for
                                                                    OR
                                                                users.profile_name LIKE '%$for_us%' "
                                              );
                    }

                    while($row = mysqli_fetch_array($result)){

                        $usernamee          = $row['usernamee'];
                        $profile_name       = $row['profile_name'];
                        $profile_picture    = $row['profile_picture'];
                        $ifFollowing        = $row['isFollowing'];
                ?>
                
                    <li class="people__person">
                        <a href= "profile.php?curr_us=<?php echo $curr_us?>&profile_for=<?php echo $usernamee?>">
                            <div class="photo__header">
                                <div class="people__avatar-container">
                                    <img 
                                        src =   <?php 
                                                    if($profile_picture == null)
                                                        echo "images/avatar.svg";
                                                    else
                                                        echo $profile_picture;
                                                ?>
                                        class="people__avatar"
                                    />
                                </div>
                                <div class="people__info">
                                    <span class="people__username"><?php echo $usernamee?></span>
                                    <span class="people__full-name"><?php echo $profile_name?></span>
                                </div>
                            </div>
                        </a>
                        <div class="people__column">
                            <?php if($curr_us != $usernamee){?>
                                <?php if($ifFollowing == 1){ ?>
                                    <a href="unfollow.php?follower=<?php echo $curr_us?>&unfollowing=<?php echo $usernamee?>&for=<?php echo $for_us?>&get=<?php echo $get?>&return=explore" >Following</a>
                                <?php }else{?>
                                    <a href="follow.php?follower=<?php echo $curr_us?>&following=<?php echo $usernamee?>&for=<?php echo $for_us?>&get=<?php echo $get?>&return=explore">Follow</a>
                                <?php } 
                            }?>       
                        </div>
                    </li>
                <?php 
                    }
                ?>

                </ul>
            </section>
        </main>
        <footer class="footer">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">about us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">language</a></li>
                </ul>
            </nav>
            <span class="footer__copyright">© 2017 instagram</span>
        </footer>
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
        <script src="js/app.js"></script>
    </body>
</html>