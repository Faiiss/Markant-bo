<?php
require './PHP/functions.php';
$connection = dbConnect();

$result = $connection->query('SELECT * FROM `post` ORDER BY id DESC');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markant </title>
    <script src="./js/hamburgermenu.js" defer></script>
    <script src="./js/icons.js" defer></script>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="index.html"><img src="img/markant_logo_1.png" class="logo" alt=""></a>
            <ul class="nav__list" id="navi__list">
                <li class="list__item"><a  href="home.html">Home</a></li>
                <li class="list__item"><a href="#">Agenda</a></li>
                <li class="list__item"><a class="active" href="index.php">Nieuws</a></li>
                <li class="list__item"><a href="login.php">login</a></li>
            </ul>
            <div class="menu" id="toggle__button">
                <div class="menu-line"></div>
                <div class="menu-line"></div>
                <div class="menu-line"></div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Artikels</h2>
            <ul class="blog__lijst">
                <?php foreach ($result as $row) : ?>
                    <li>

                        <div class="blog-post">
                            <div class="blog-post-img">
                                <img src=<?php echo $row['foto']?> alt="img/no-image.webp">
                            </div>
                            <div class="blog-post-info">
                                <div class="blog-post-datum">
                                    <span><?php echo $row['datum']; ?></span>
                                </div>
                                <h1 class="blog-post-titel"><?php echo $row['titel']; ?></h1>
                                <p class="blog-post-text">
                                <?php echo $row['short']; ?>
                                </p>
                                <a href="artikel.php?id=<?php echo $row['id'];?>">
                                <button class="blog-post-cta"> Meer lezen <span>&rarr;</span></button></a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
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