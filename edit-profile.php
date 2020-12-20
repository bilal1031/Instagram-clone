<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Profile | Instaclone</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <?php
            $username = $_GET['username'];
            include_once 'connect.php';

            $result = mysqli_query  ($conn, "SELECT 
                                                profile_name,
                                                profile_picture,
                                                password,
                                                bio,
                                                email
                                            FROM users
                                            WHERE username = '$username' "
                                    );

            $row = mysqli_fetch_array($result);

            $profile_name       = $row['profile_name'];
            $profile_picture    = $row['profile_picture'];
            $password           = $row['password'];
            $bio                = $row['bio'];
            $email              = $row['email'];

        ?>
        <nav class="navigation">
            <a href="feed.php?username=<?php echo $username?>">
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
                <a href="profile.html" class="navigation__link">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
        </nav>
        <main class="edit-profile">
            <section class="profile-form">
                <header class="profile-form__header">
                    <div class="profile-form__avatar-container">
                            <img 
                            src= <?php 
                                    if($profile_picture == null)
                                        echo "images/avatar.svg";
                                    else
                                        echo $profile_picture;
                                ?>
                            class="profile-form__avatar"
                        />
                    </div>
                    <h4 class="profile-form__title"><?php echo $username?></h4>
                </header>
                <form action="submit-profile.php?curr_us=<?php echo $username?>" method = "post" class="edit-profile__form">
                    <div class="edit-profile__form-row">
                        <label for="name" class="edit-profile__label">Name
                        </label>
                        <input 
                            name = "name"
                            type="text"
                            value="<?php echo $profile_name?>"
                            class="edit-profile__input"
                        />
                    </div>
                    <div class="edit-profile__form-row">
                        <label for="username" class="edit-profile__label">
                            Username
                        </label>
                        <input 
                            type="text"
                            name="username"
                            value="<?php echo $username?>"
                            class="edit-profile__input"
                        />
                    </div>
                    <div class="edit-profile__form-row">
                        <label for="Password" class="edit-profile__label">
                            Password
                        </label>
                        <input 
                            type="text"
                            name ="password"
                            value = "<?php echo $password?>"
                            class="edit-profile__input"
                        />
                    </div>
                    <div class="edit-profile__form-row">
                        <label for="bio" class="edit-profile__label">
                            Bio
                        </label>
                        <textarea name ="bio" class="edit-profile__textarea"><?php echo $bio?></textarea>
                    </div>
                    <div class="edit-profile__form-row">
                        <label for="email" class="edit-profile__label">
                            Email
                        </label>
                        <input 
                            type="email"
                            class="edit-profile__input"
                            name ="email"
                            value = "<?php echo $email?>"
                        />
                    </div>
                    <div class="edit-profile__form-row">
                        <label class="edit-profile__label"></label>
                        <input type="submit" name = "submit" value="Submit">
                    </div>
                </form>
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