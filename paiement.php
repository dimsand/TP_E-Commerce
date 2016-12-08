<?php
session_start();
include_once('env.php');
include_once('functions.php');
include_once('./tpl/header.php');
$user_id = isConnected();
if(!$user_id){
  $user_id = 'tmp';
}
$cart = getCart($user_id);
?>

<main>
  <div class="table_cart">
    <h1>Paiement</h1>
    <ul id="progressbar">
      <li class="active">Mon panier</li>
      <li <?=(!isConnected())?'':'class="active"'?>>Identification</li>
      <li class="active">Paiement</li>
      <li>Confirmation</li>
    </ul>
    <div class="paiement_form">
      <form class="" action="./traitements.php?traitement=paiement" method="post">
        <div class="inputs">
          <label for="num_cb">Numéro de carte bancaire</label>
          <input type="text" id="num_cb" name="num_cb" value="">
        </div>
        <div class="inputs inline-2">
          <label for="date_exp">Date d'exp.</label>
          <input type="text" id="date_exp" name="date_exp" value="" placeholder="mm/aa">
        </div>
        <div class="inputs inline-2">
          <label for="crypto">Cryptogramme</label>
          <input type="text" id="crypto" name="crypto" value="">
        </div>
        <div class="">
          <input class="btn" type="submit" name="login" value="Se connecter">
        </div>
      </form>
    </div>
  </div>
</main>

<?php include_once('./tpl/footer.php'); ?>
