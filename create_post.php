<!DOCTYPE html>
               <?php
               $username = $_GET['username'];
                function getprofile(){
                   include_once 'connection.php';
                    $username = $_GET['username'];
                    $sql = "SELECT profile_picture FROM users WHERE username = '$username';";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_array($result);
                    return $row['profile_picture'];
                }

                
                
            ?> 
                
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
                height: 300px; /* Should be removed. Only for demonstration */
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
            <a href="feed.php?username=<?php echo $curuser?>">
                <img 
                    src="images/navLogo.png"
                    alt="logo"
                    title="logo"
                    class="navigation__logo"
                />
            </a>
            
        </nav>
        <main class="image-detail">
 
            <section class="image">
            <table >
            <tr>
                <td><div style="width:400px"></div></td>
                <td><div style="width:5px;backgroud-color:#9e9e9e;"></div></td>
                <td><div class="column" >
                    <div class="photo__header">
                     <img 
                                src="<?php echo "/photos/".getprofile()?>"
                                style="width:50px;height:50px"
                                class="photo__avatar"
                       />
                    <a href ="profile.php?curuser=<?php echo $username; ?>&username=<?php echo $username ?>" class="photo__username"><?php echo $username ?></a>
                    </div>
                    <div style="height:90px"></div>
                    <div style ="height:50px" class="photo_comment">
                        <div class="photo__add-comment-container">
                        <form id="myForm" action="post_query.php" method="post"  enctype="multipart/form-data">
                            <input type="file" name="image" id="image"/> 
                            <div><textarea type="text" id="text"name="text" placeholder="What are you thinking..." class="photo__add-comment"></textarea>
                            <input type="hidden" id="user_name" name="username" value="<?php echo $username?>"></input>
                            <button type="submit" class="w3-circle w3-blue " name ="button" id="sub" style="width:50px;height:50px;position: absolute; right: 0;">></button>
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
        <script src="js/loadpic.js"></script>
        
    </body>
</html>