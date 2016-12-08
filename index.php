<?php
session_start();
include_once('env.php');
include_once('functions.php');
include_once('./tpl/header.php');
$category_id = null;
if(!empty($_GET['category_id'])){
  $category_id = $_GET['category_id'];
}
$products = getListProducts($category_id);
?>

<main>
  <div class="list-products">
    <?php foreach ($products as $product_id => $product): ?>
      <div class="wrapper">
        <div class="card radius shadowDepth1">
          <div class="card__image border-tlr-radius">
            <img src="https://dummyimage.com/300x180/78909c/000.png&text=Produit <?=$product_id?>" alt="image" class="border-tlr-radius">
          </div>
          <div class="card__content card__padding">
            <div class="card__cart">
                <a class="cart-toggle cart-icon" href="./traitements.php?traitement=addCart&product_id=<?=$product_id?>"></a>
            </div>
            <div class="card__meta">
    					<a href="./index.php?category_id=<?=$product['category_id']?>"><?=getCategLabel($product['category_id'])?></a><time>17th March</time>
    				</div>
            <article class="card__article">
              <h2><a href="#"><?=$product['name']?></a></h2>
              <p><?=(strlen(trim($product['description']))>100)?substr(trim($product['description']),0,100)."...":$product['description']?></p>
              <div class="product_more">
                <a class="btn" href="./product_detail.php?product_id=<?=$product_id?>">Plus d'infos</a>
              </div>
            </article>
          </div>
          <div class="card__action">
            <div class="card__author">
              <div class="card__author-content">
                By <?=$product['brand']?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include_once('./tpl/footer.php'); ?>
