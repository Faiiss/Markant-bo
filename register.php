<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
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
                <li class="list__item"><a href="agenda.html">Agenda</a></li>
                <li class="list__item"><a href="index.php">Nieuws</a></li>
                <li class="list__item"><a href="login.php">login</a></li>
                <li class="list__item"><a class="active" href="register.php">Register</a></li>
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
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
<section class="login__section">
<form class="login__form"" action="" method="post">
        <h1 class="login__title">Registration</h1>
        <input type="text" class="login__input" name="username" placeholder="Username" required />
        <input type="text" class="login__input" name="email" placeholder="Email Adress">
        <input type="password" class="login__input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login__button">
        <p class="link"><a class="login__link" href="login.php">Click to Login</a></p>
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
                    <a href="agenda.html">
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