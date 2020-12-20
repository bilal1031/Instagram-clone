<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Feed | Instaclone</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head> 
    <body>
    <?php
        include_once 'connect.php';
        $us = $_GET['username'];
    ?>

        <nav class="navigation">
            <a href="feed.php?username=<?php echo $us?>">
                <img 
                    src="images/navLogo.png"
                    alt="logo"
                    title="logo"
                    class="navigation__logo"
                />
            </a>
            <div class="navigation__search-container">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="navigation__icons">
                <a href="explore.php" class="navigation__link">
                    <i class="fa fa-compass"></i>
                </a>
                <a href="#" class="navigation__link">
                    <i class="fa fa-heart-o"></i>
                </a>
                <a href="profile.php?curr_us=<?php echo $us ?>&profile_for=<?php echo $us ?>" class="navigation__link">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
        </nav>
        <main class="feed">
            <?php

                $result = mysqli_query($conn, " select 
                                                    followings.following AS follower,
                                                    (
                                                        SELECT users.profile_picture
                                                        FROM users
                                                        WHERE username = followings.following
                                                    ) AS following_dp,
                                                    posts.post_id AS post_id,
                                                    posts.photo AS photo, 
                                                    likes,
                                                    (
                                                        SELECT 1
                                                        FROM likes
                                                        WHERE likes.post_id = posts.post_id
                                                                AND
                                                              likes.likername = followings.username
                                                    ) AS is_liked,
                                                    comments,
                                                    (
                                                        SELECT commentername
                                                        FROM comments
                                                        WHERE comments.post_id = posts.post_id
                                                        ORDER BY time_stamp DESC
                                                        LIMIT 1
                                                    ) AS commenter_name,
                                                    (
                                                        SELECT comment_text
                                                        FROM comments
                                                        WHERE comments.post_id = posts.post_id
                                                        ORDER BY time_stamp DESC
                                                        LIMIT 1
                                                    ) AS comment_text,
                                                    datediff(now(), posts.time_stamp) AS time_stamp
                                                    
                                                from followings
                                                join posts
                                                on posts.post_id =  (
                                                                        SELECT posts.post_id
                                                                        FROM posts
                                                                        WHERE posts.username = followings.following
                                                                        ORDER BY posts.time_stamp DESC
                                                                        LIMIT 1
                                                                    )
                                                where followings.username = '$us'
                                                group by followings.following;"
                                        );

                while($row = mysqli_fetch_array($result)){
                    $follower       = $row['follower'];
                    $following_dp   = $row['following_dp'];
                    $post_id        = $row['post_id'];
                    $photo          = $row['photo'];
                    $likes          = $row['likes'];
                    $is_liked       = $row['is_liked'];
                    $comments_count = $row['comments'];
                    $commenter_name = $row['commenter_name'];
                    $comment_text   = $row['comment_text'];
                    $created_at     = $row['time_stamp'];

            ?>
            <section class="photo">
                <header class="photo__header">
                    <div class="photo__header-column">
                        <img
                            class="photo__avatar"
                            src= <?php 
                                    if($following_dp == null)
                                        echo "images/avatar.svg";
                                    else
                                        echo $following_dp;
                                ?>
                            style="width:30px;height:30px"
                        />
                    </div>
                    <div class="photo__header-column">
                        <a href = "profile.php?curr_us=<?php echo $us?>&profile_for=<?php echo $follower?>">
                            <?php echo $follower?>
                        </a>
                    </div>
                </header>
                <div class="photo__file-container">
                    <img
                        class="photo__file"
                        src=<?php echo $photo?>
                    />
                </div>
                <div class="photo__info">
                    <div class="photo__icons">
                        <span class="photo__icon">
                             
                        <a href="like.php?is_liked=<?php echo $is_liked ?>&post_id=<?php echo $post_id ?>&username=<?php echo $us ?>">
                            <?php 
                                if($is_liked == 1)
                                    echo "<i class = \"fa heart fa-lg heart-red fa-heart\"></i>";
                                else
                                    echo "<i class = \"fa fa-heart-o heart fa-lg\"></i>";
                             ?>
                        </a> 
                        </span>
                        <span class="photo__icon">
                            <i class="fa fa-comment-o fa-lg"></i>
                        </span>
                    </div>
                    <span class="photo__likes"><?php echo $likes ?> likes</span>
                    <ul class="photo__comments">
                        <li class="photo__comment">
                            <span class="photo__comment-author"><?php echo $commenter_name ?></span><?php echo $comment_text ?>
                        </li>
                        <li class="photo__comment">
                            <span class="photo__comment-author"><?php echo $comments_count-1 ?> more comments...</span>
                        </li>
                    </ul>
                    <span class="photo__time-ago"><?php echo $created_at ?> days</span>
                        <div class="photo__add-comment-container">
                        <form action="comment.php?post_id=<?php echo $post_id ?>&username=<?php echo $us ?>&return_to=feed" method="POST">
                            <textarea name = "comment" placeholder="Add a comment..." class="photo__add-comment"></textarea>
                            <input type = "submit" class="fa fa-ellipsis-h"></input>
                        </form>
                        </div>
                </div>
            </section>
            <?php
                }
            ?>
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