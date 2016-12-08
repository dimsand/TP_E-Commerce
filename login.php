<?php
session_start();
include_once('env.php');
include_once('functions.php');
include_once('./tpl/header.php');
?>
<main>
  <div class="login">
    <form class="" action="./traitements.php?traitement=login" method="post">
      <div class="inputs">
        <label for="username">Identifiant</label>
        <input type="text" id="username" name="username" value="">
      </div>
      <div class="inputs">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" value="">
      </div>
      <div class="">
        <input class="btn" type="submit" name="login" value="Se connecter">
      </div>
    </form>
  </div>
</main>

<?php include_once('./tpl/footer.php'); ?>
