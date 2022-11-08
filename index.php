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
    <link rel="stylesheet" href="./css/style.css" defer>
    <script src="js/hamburgermenu.js" defer></script>
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
        <h4 class="footertitle">Front end door Faiss</h4>
    </footer>
</body>

</html>