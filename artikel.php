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
    <link rel="stylesheet" href="./css/artikel.css">
    <script src="js/hamburgermenu.js"></script>
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
            </ul>
            <div class="menu" id="toggle__button">
                <div class="menu-line"></div>
                <div class="menu-line"></div>
                <div class="menu-line"></div>
            </div>
        </nav>
    </header>
    <article class="artikel__main">
        <div class="artikel__text-box">
            <h2 class="artikel__titel"><?php echo $post['titel']; ?></h2>
            <p class="artikel__inhoud"><?php echo $post['content']; ?></p>
        </div>
        <img src="<?php echo $post['foto']?>" alt="" class="artikel__img">
        <a href="index.php">
            <button class="artikel__button">terug</button>
        </a>
    </article>
</body>
</html>