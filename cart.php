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
    <h1>Mon panier</h1>
    <ul id="progressbar">
      <li class="active">Mon panier</li>
      <li <?=(!isConnected())?'':'class="active"'?>>Identification</li>
      <li>Paiement</li>
      <li>Confirmation</li>
    </ul>
    <?php if(!empty($cart)): ?>
      <table class="rtable">
        <thead>
          <tr>
            <th>Qte</th>
            <th>Produit</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($cart as $product): ?>
            <tr>
              <td><?='1'?></td>
              <td><?=$product['name']?> <span class="brand"><?=$product['brand']?></span></td>
              <td><?=number_format((float)$product['price'],2)?> €</td>
            </tr>
          <?php endforeach; ?>
          <tr class="ligne_total">
            <td colspan="2">Total</td>
            <td><?=number_format((float)$_SESSION['Cart'][$user_id]['total_price'],2)?> €</td>
          </tr>
          </tbody>
        </table>
      <?php else: ?>
        <div class="flash_msg info">
          Vous n'avez pas encore d'articles dans votre panier.
        </div>
      <?php endif; ?>
  </div>
  <div class="paiement">
    <div class="help_paiement">
      <img src="./img/paiement_type.jpg" alt="Type de paiement possible" height="105"/>
    </div>
    <div class="">
      <?php if(!isConnected()): ?>
        <p>Connectez-vous pour procéder au paiement !</p>
        <p><a href="./login.php">Se connecter</a></p>
      <?php else: ?>
        <a class="btn btn_gros" href="./paiement.php">Valider et payer</a>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php include_once('./tpl/footer.php'); ?>
