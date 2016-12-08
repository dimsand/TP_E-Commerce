<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Site E-Commerce</title>
    <link rel="stylesheet" href="./css/style.css" media="screen" title="no title">
    <link rel="stylesheet" href="./css/card.css" media="screen" title="no title">
  </head>
  <body>
    <header>
      <div class="icon">
        <a href="./"><img src="./img/online-shop.png" alt="" id="img_logo"/></a>
        <div class="brand">E-Commerce</div>
      </div>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <ul>
          <li><a class="btn" href="./index.php">Accueil</a></li>
          <li><a class="btn" href="./cart.php">Mon panier</a></li>
          <?php if(!isConnected()): ?>
            <li><a class="btn" href="./login.php">Se connecter</a></li>
          <?php else: ?>
            <li><a class="btn" href="./traitements.php?traitement=logout">Déconnexion</a></li>
          <?php endif; ?>
        </ul>
      </nav>
      <?php if(!empty($_SESSION['result'])): ?>
        <div class="user_info">
          <span class="user_name"><?=(!empty($_SESSION['result']['prenom']))?$_SESSION['result']['prenom']:''?> <?=(!empty($_SESSION['result']['nom']))?$_SESSION['result']['nom']:''?></span><br><br>
          <a class="btn" href="./result.php">Mon site</a>
          <a class="btn" href="./action.php?reset=1">Reset</a>
        </div>
      <?php endif; ?>
    </header>

    <?=getMsgFlash();?>
