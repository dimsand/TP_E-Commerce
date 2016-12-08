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
  <div class="confirm_paiement">
    <h1>Mon panier</h1>
    <ul id="progressbar">
      <li class="active">Mon panier</li>
      <li <?=(!isConnected())?'':'class="active"'?>>Identification</li>
      <li class="active">Paiement</li>
      <li class="active">Confirmation</li>
    </ul>
    <?php if(!empty($_GET['success']) && $_GET['success'] == 'true'): ?>
        <div class="flash_msg success">
          Votre paiement a été accepté.<br><a href="./">Retour à l'accueil</a>
        </div>
      <?php else: ?>
        <div class="flash_msg error">
          Il y a eu un problème avec votre paiement.
        </div>
      <?php endif; ?>
  </div>
</main>

<?php include_once('./tpl/footer.php'); ?>
