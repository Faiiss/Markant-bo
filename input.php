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
    header('Location: main.php');
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
    <title>Document</title>
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
<section>
<h2>posten</h2>
        <form action="input.php" method="POST" novalidate>
          <label for="titel">titel</label>
          <input class="input" type="text" value="<?php echo $titel; ?>" name="titel" id="titel" required>
          <?php if(!empty($errors['titel'])): ?>
              <em class="errors"><?php echo $errors['titel'] ?></em>
          <?php endif;?>

          <label for="foto"><br>foto</label>
          <input class="input" type="text" value="<?php echo $foto; ?>" name="foto" id="foto" required>
          <?php if(!empty($errors['foto'])): ?>
              <em class="errors"><?php echo $errors['foto'] ?></em>
          <?php endif;?>

          <label for="content"><br>message</label>
          <textarea class="input  texter" name="content" id="content" required><?php echo $content; ?></textarea>
          <?php if(!empty($errors['content'])): ?>
              <em class="errors"><?php echo $errors['content'] ?></em>
          <?php endif;?>
              <label for="short"><br>short message</label>
          <textarea class="input  texter" name="short" id="short" required><?php echo $short; ?></textarea>
          <?php if(!empty($errors['short'])): ?>
              <em class="errors"><?php echo $errors['short'] ?></em>
          <?php endif;?>
          <br>

          <button class="submit" type="submit">Submit</button>
        </form>
</section>
</body>
</html>