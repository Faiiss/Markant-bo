<?php
require './PHP/functions.php';
$connection = dbConnect();
//checken of id is meesgestuurd in de URL :)
if(!isset($_GET['id'])){
    echo "de ID is niet gezet";
    exit;
}
//checken of het een integer is :o
$id = $_GET['id'];
$check_int = filter_var($id, FILTER_VALIDATE_INT);
if($check_int == false){
    echo "dit is geen integer";
    exit;
}
$statement = $connection->prepare('SELECT * FROM `post` WHERE id=?');
$params = [$id];
$statement->execute($params);
$post = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/hamburgermenu.js" defer></script>
    <script src="./js/icons.js" defer></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Artikel</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.html"><img src="img/markant_logo_1.png" class="logo" alt=""></a>
            <ul class="nav__list" id="navi__list">
                <li class="list__item"><a href="home.html">Home</a></li>
                <li class="list__item"><a href="#">Agenda</a></li>
                <li class="list__item"><a class="active" href="index.php">Nieuws</a></li>
                <li class="list__item"><a  href="login.php">Login</a></li>
            </ul>
            <div class="menu" id="toggle__button">
                <div class="menu-line"></div>
                <div class="menu-line"></div>
                <div class="menu-line"></div>
            </div>
        </nav>
    </header>
    <section class="artikel__section">
    <h2 class="artikel__titel"><?php echo $post['titel']; ?></h2>
    <article class="artikel__main">
        <img src="<?php echo $post['foto']?>" alt="" class="artikel__img">
        <p class="artikel__inhoud"><?php echo $post['content']; ?></p>
        <a href="index.php">
            <button class="artikel__button">terug</button>
        </a>
    </article>
    </section>
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