<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <script src="./js/hamburgermenu.js" defer></script>
    <script src="./js/icons.js" defer></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header>
        <nav class="navbar">
            <a href="index.html"><img src="img/markant_logo_1.png" class="logo" alt=""></a>
            <ul class="nav__list" id="navi__list">
                <li class="list__item"><a href="home.html">Home</a></li>
                <li class="list__item"><a href="#">Agenda</a></li>
                <li class="list__item"><a href="index.php">Nieuws</a></li>
                <li class="list__item"><a class="active" href="login.php">login</a></li>
            </ul>
            <div class="menu" id="toggle__button">
                <div class="menu-line"></div>
                <div class="menu-line"></div>
                <div class="menu-line"></div>
            </div>
        </nav>
</header>
<?php
    require('./PHP/db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: ./input.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
<section class="login__section">
<form class="login__form" method="post" name="login">
        <h1 class="login__title">Login</h1>
        <input type="text" class="login__input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login__input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login__button"/>
        <p ><a class="login__link" href="register.php">Nieuwe registratie </a></p>
  </form>
</section>
<?php
    }
?>
    <footer>
        <div class="footer__content">
            <ul class="footer__list">
                <li class="footer__item">
                    <a href="home.html">
                        <button class="footer__button">Home</button>
                    </a>
                </li>
                <li class="footer__item">
                    <a href="index.php">
                        <button class="footer__button">Nieuws</button>
                    </a>
                </li>
                <li class="footer__item">
                    <a href="">
                        <button class="footer__button">Agenda</button>
                    </a>
                </li>
                <li class="footer__item">
                    <a href="login.php">
                        <button class="footer__button">Login</button>
                    </a>
                </li>
            </ul>
            <ul class="footer__socials">
                <li class="footer__social">
                    <a href="https://www.facebook.com/markantmantelzorg/">
                        <i class="fa-brands fa-facebook footer__icon"></i>
                    </a>
                </li>
                <li class="footer__social">
                    <a href="https://twitter.com/markant020">
                        <i class="fa-brands fa-twitter footer__icon"></i>
                    </a>
                </li>
                <li class="footer__social">
                    <a href="https://www.linkedin.com/company/markant-centrum-voor-mantelzorg">
                        <i class="fa-brands fa-linkedin footer__icon"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer__credits">
            <p class="footer__title">Front-end by @faissdesigns <br> © 2022 Markant, Centrum voor Mantelzorg</p>
        </div>
    </footer>
</body>
</html>