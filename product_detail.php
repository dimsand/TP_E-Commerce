<?php
session_start();
include_once('env.php');
include_once('functions.php');
include_once('./tpl/header.php');
$product_id = null;
if(!empty($_GET['product_id'])){
  $product_id = $_GET['product_id'];
}
$product = getProductDetails($product_id);
?>

<main>
  <div class="product_details">
    <div class="bloc_img_product">
      <img src="https://dummyimage.com/300x180/78909c/000.png&text=Produit <?=$product_id?>" alt="" />
      <div class="shop_product">
        <div class="price_product">
          <?=$product['price']?>
        </div>
        <div class="add_cart_product">
          <a class="btn btn_gros" href="./traitements.php?traitement=addCart&product_id=<?=$product_id?>">Ajouter au panier</a>
        </div>
      </div>
    </div>
    <div class="presentation_product">
      <div class="titre_product">
        <h1><?=$product['name']?> <span class="brand"><?=$product['brand']?></span></h1>
      </div>
      <div class="description_product">
        <p>
          <?=$product['description']?>
        </p>
      </div>
    </div>
  </div>
</main>

<?php include_once('./tpl/footer.php'); ?>
