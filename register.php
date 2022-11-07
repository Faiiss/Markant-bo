<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="./css/style.css"/>
</head>

<body>
<header>
        <nav class="navbar">
            <a href="index.html"><img src="img/markant_logo_1.png" class="logo" alt=""></a>
            <ul class="nav__list" id="navi__list">
                <li class="list__item"><a href="home.html">Home</a></li>
                <li class="list__item"><a href="#">Agenda</a></li>
                <li class="list__item"><a class="active" href="index.php">Nieuws</a></li>
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
<section>
<form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
</section>
<?php
    }
?>
</body>
</html>