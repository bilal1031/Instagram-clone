<?php
    $post_id = $_GET['post_id'];
    $curr_us = $_GET['curr_us'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Image Detail | Instaclone</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
         <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <style>
                * {
                box-sizing: border-box;
                }

                /* Create two equal columns that floats next to each other */
                .column {
                float: left;
                width: 600px;
                padding: 10px;
                height: 550px; /* Should be removed. Only for demonstration */
                border: 1px ; 
                background-color:#ffffff;
                }

                /* Clear floats after the columns */
                .row:after {
                content: "";
                display: table;
                clear: both;
                }
                .vertical-center {
                margin: 0;
                position: absolute;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                }
                </style>
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
            <div class="navigation__search-container">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="navigation__icons">
                <a href="explore.html" class="navigation__link">
                    <i class="fa fa-compass"></i>
                </a>
                <a href="#" class="navigation__link">
                    <i class="fa fa-heart-o"></i>
                </a>
                <a href="profile.php" class="navigation__link">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
        </nav>
        <main class="image-detail">
        <?php
                include_once 'connect.php';

                $result = mysqli_query($conn, "SELECT
                                                    username,
                                                    photo,
                                                    likes,
                                                    comments,
                                                    datediff(now(), time_stamp) AS created_at
                                                FROM posts
                                                WHERE post_id = $post_id"
                                        );
                
                $row = mysqli_fetch_array($result);
                
                $username        = $row['username']; 
                $photo           = $row['photo'];
                $likes           = $row['likes'];
                $comments        = $row['comments'];
                $created_at      = $row['created_at'];

                
                $result2 = mysqli_query($conn, "SELECT
                                                    profile_picture
                                                FROM users
                                                WHERE username = '$username'"
                                        );
                
                $row2 = mysqli_fetch_array($result2);

                $profile_picture = $row2['profile_picture'];                        
            ?>
                
            <section class="image">
            <table >
            <tr>
                <td><div style="width:100px"></div></td>
                <td><div class="column">
                     <img 
                                src="<?php echo $photo ?>"
                                class="image__avatar"
                                style="width:100%;height:100%"
                       />
                </div></td>
                <td><div style="width:5px ;backgroud-color:#9e9e9e;"></div></td>
                <td><div class="column" >
                    <div class="photo__header">
                     <img 
                                src =   <?php 
                                            if($profile_picture == null)
                                                echo "images/avatar.svg";
                                            else
                                                echo $profile_picture;
                                        ?>
                                style="width:50px;height:50px"
                                class="photo__avatar"
                       />
                      <a><?php echo $username ?></a>
                    </div>
                    <div style ="height:300px; background-color:#ffffff; overflow:auto; " class= "photo__info">
                    <ul class="photo__comments" id="commentlist">

                        <?php
                            $result3 = mysqli_query ($conn, "SELECT
                                                                commentername,
                                                                comment_text
                                                            FROM comments
                                                            WHERE post_id = $post_id
                                                            ORDER BY time_stamp; "
                                                    );
                            
                            while($row3 = mysqli_fetch_array($result3)){
                                $commentername = $row3['commentername'];
                                $comment_text  = $row3['comment_text'];
                        ?>
                            <li class="photo__comment">
                            <span class="photo__comment-author"><?php echo $commentername?></span> <?php echo $comment_text?>
                            </li> 
                        <?php
                            }
                        ?>   
                    </ul>
                    </div>
                    <div style ="height:30px ">
                     <div class="photo__icons">
                            <span class="photo__icon">
                                <i class="fa fa-heart-o heart fa-lg"></i>
                            </span>
                            <span class="photo__icon">
                                <i class="fa fa-comment-o fa-lg"></i>
                            </span>
                        </div>
                    </div>
                    <span class="photo__likes" name="likes"><?php echo $likes ?> likes</span>
                     <span class="photo__time-ago" name="timeofpost"> <?php echo $created_at ?> ago</span>
                    <div style ="height:70px" class="photo_comment">
                                       <div class="photo__add-comment-container" >
                        <form action="comment.php?post_id=<?php echo $post_id?>&username=<?php echo $curr_us?>&return_to=image_detail" method="post" id="myForm">
                            <div><textarea type="text" id="comment"name="comment" placeholder="Add a comment..." class="photo__add-comment"></textarea>
                            <button class="w3-circle w3-blue " id="sub" style="width:50px;height:50px;position: absolute; right: 0;">></button>
                            <div style="height:5px"></div>
                        </form> 
                       
                    </div>
                 </div></td>

            </tr>
                </table>
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