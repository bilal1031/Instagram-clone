    <html>
    <style>
        .center {
            margin: auto;
            width: 50%;
            padding: 10px;
        }
        .centerimg{
            margin:10px auto 20px;
        }
        li {
            float:left;
            padding-left:3px;
            list-style-type:none;
        }
            .your-class input{
            float:left;
        }
        .color-class{
            color: #8E8E8E;
            padding:5px;
        }
        .margintop{
            margin-top:10px;
            padding-top:10px;
        }
    </style>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body style="margin-top:50px">

    <?php
        $curr_us = $_GET['username'];
    ?>

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
            <a href="#" class="navigation__link">
                <i class="fa fa-compass"></i>
            </a>
            <a href="#" class="navigation__link">
                <i class="fa fa-heart-o"></i>
            </a>
            <a href="#" class="navigation__link">
                <i class="fa fa-user-o"></i>
            </a>
        </div>
    </nav>

    <div class="container">
    <div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-8">
        
        <?php
            include_once 'connect.php';

            $result = mysqli_query($conn, " SELECT 
                                                users.profile_name      AS profile_name,
                                                users.profile_picture   AS profile_picture
                                            FROM users
                                            WHERE users.username = '$curr_us' "
                                );

            $row = mysqli_fetch_array($result);

            $profile_name       = $row['profile_name'];
            $profile_picture    = $row['profile_picture'];

        ?>
        
        <li class="people__person">
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
                    <span class="people__username"><?php echo $curr_us?></span>
                    <span class="people__full-name"><?php echo $profile_name?></span>
                </div>
            </div>
        </li>

    <div class="your-class">
    <form action="submit-post.php" method="post" enctype="multipart/form-data">
        <textarea cols="40" name="discription" rows="10" style="position:relative; width:100%;"placeholder="Write your text here"></textarea><br>
        <label>Select image to upload.</label><br><br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="hidden" id="user_name" name="user_name" value="<?php echo $curr_us?>"></input>
        <input type="submit" value="Post" style="float:right; background-color: #3897f0; color:#fff" name="submit">
    </form>
    </div>
    </div>

        </div>
        <div class="col-sm-2">
        
        </div>
    </div>
    </div>

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
        crossorigin="anonymous">
    </script>
    <script src="js/app.js"></script>

    </body>
    </html>