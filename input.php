<?php
require './PHP/functions.php';


session_start();
if(!isset($_SESSION["username"])) {
    header("Location: ");
    exit();
};
$connection = dbConnect();

$titel = '';
$content = '';
$foto = '';
$short = '';

//Opslag variabele voor errors
$errors = [];


if($_SERVER['REQUEST_METHOD'] == "POST"){
  //gegevens opslaan
  $titel = $_POST['titel'];
  $content = $_POST['content'];
  $foto = $_POST['foto'];
  $datum = date('Y-m-d');
  $short = $_POST['short'];

  //fouten controleren / valideren van input

  if(isEmpty($titel)){
    $errors['titel'] = 'Vul titel in';
  }
  if(isEmpty($short)){
    $errors['titel'] = 'Vul iets in';
  }
  if(!hasMinLength($content, 5)){
    $errors['content'] = 'Meer woorden aub.';
  }
  if(isEmpty($foto)){
    $errors['foto'] = 'Vul foto path';
  }

  //print_r($errors);

  if(count($errors) == 0){
    $sql = "INSERT INTO `post` (`titel`, `content`, `foto`, `datum`, `short`) 
            VALUES (:titel, :content, :foto, :datum, :short);";
    
    $statement = $connection->prepare($sql);
    $params = [
        'titel' => $titel,
        'content' => $content,
        'foto' => $foto,
        'datum' => $datum,
        'short' => $short

    ];

    $statement->execute($params);


    //stuur bezoeker naar bedankt pagina
    header('Location: index.php');
    exit;
  }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/hamburgermenu.js" defer></script>
    <script src="./js/icons.js" defer></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
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
<section class="post__section">
  <h2 class="post__title">Bericht maken</h2>
        <form class="post__form"action="input.php" method="POST" novalidate>
           <label class="post__label title" for="titel">Titel</label>
           <input class="post__input" type="text" value="<?php echo $titel; ?>" name="titel" id="titel" required>
           <?php if(!empty($errors['titel'])): ?>
             <em class="errors"><?php echo $errors['titel'] ?></em>
           <?php endif;?>

           <label class="post__label" for="foto"><br>foto path</label>
           <input class="post__input" type="text" value="<?php echo $foto; ?>" name="foto" id="foto" required>
           <?php if(!empty($errors['foto'])): ?>
               <em class="errors"><?php echo $errors['foto'] ?></em>
           <?php endif;?>

           <label class="post__label" for="content"><br>Bericht</label>
           <textarea class="input  texter" name="content" id="content" required><?php echo $content; ?></textarea>
           <?php if(!empty($errors['content'])): ?>
               <em class="errors"><?php echo $errors['content'] ?></em>
           <?php endif;?>
               <label class="post__label" for="short"><br>Samenvatting</label>
           <textarea class="input  texter" name="short" id="short" required><?php echo $short; ?></textarea>
           <?php if(!empty($errors['short'])): ?>
               <em class="errors"><?php echo $errors['short'] ?></em>
           <?php endif;?>
           <br>

           <button class="post__submit" type="submit">Verstuur</button>
        </form>
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