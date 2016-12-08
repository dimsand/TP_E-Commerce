<?php

// Fonction debug pour simplifier visuellement les var_dump
function debug($var = null){
  if(!is_null($var)){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
  }
}

// On récupère la liste des produits (source : ./products.json)
// Si $category_id passé, on fitlre par catégorie la liste des produits
function getListProducts($category_id = null){
  if(is_null($category_id)){
    if(file_exists(LIST_PRODUCTS) && is_readable(LIST_PRODUCTS) && is_writable(LIST_PRODUCTS)){
      $products_json = file_get_contents(LIST_PRODUCTS);
      $products = json_decode($products_json, true);
      return $products;
    }else{
      return false;
    }
  }else{
    if(file_exists(LIST_PRODUCTS) && is_readable(LIST_PRODUCTS) && is_writable(LIST_PRODUCTS)){
      $products_json = file_get_contents(LIST_PRODUCTS);
      $products = json_decode($products_json, true);
      $product_filtered = array();
      foreach ($products as $product_id => $product) {
        if($product['category_id'] == $category_id){
          $product_filtered[$product_id] = $product;
        }
      }
      return $product_filtered;
    }else{
      return false;
    }
  }
}

// On récupère le label de la catégorie en fonction de son id (source des catégories dans ./categories.json)
function getCategLabel($category_id){
  if(!is_null($category_id)){
    if(file_exists(LIST_CATEGORIES) && is_readable(LIST_CATEGORIES) && is_writable(LIST_CATEGORIES)){
      $categories_json = file_get_contents(LIST_CATEGORIES);
      $categories = json_decode($categories_json, true);
      $category_label = "";
      foreach ($categories as $id => $category) {
        if($id == $category_id){
          $category_label = $category;
        }
      }
      return $category_label;
    }else{
      return false;
    }
  }
}

// Gestion des messages flash (erreur ou info selon le $level entré)
function setMsgFlash($msg, $level = 'error'){
  if(!isset($_SESSION['flash'])){
    $_SESSION['flash'] = array();
  }
  if(!empty($msg)){
    $nb_msg_flash = count($_SESSION['flash']) + 1;
    $_SESSION['flash'][$nb_msg_flash]['msg'] = $msg;
    $_SESSION['flash'][$nb_msg_flash]['level'] = $level;
  }
}

// Affichage du message flash
function getMsgFlash(){
  if(!empty($_SESSION['flash'])){
    foreach ($_SESSION['flash'] as $key => $flash) {
      $msg_flash = "<div class='flash_msg ".$flash['level']."'>".$flash['msg']."</div>";
    }
    unset($_SESSION['flash']);
    return $msg_flash;
  }
  return "";
}

// Retourne true si l'user est connecté, sinon retourne false
function isConnected(){
  if(!empty($_SESSION['User']['id'])){
    return $_SESSION['User']['id'];
  }else{
    return false;
  }
}

function getProductDetails($product_id_search){
  if(!is_null($product_id_search)){
    if(file_exists(LIST_PRODUCTS) && is_readable(LIST_PRODUCTS) && is_writable(LIST_PRODUCTS)){
      $products_json = file_get_contents(LIST_PRODUCTS);
      $products = json_decode($products_json, true);
      $product_details = array();
      foreach ($products as $product_id => $product) {
        if($product_id == $product_id_search){
          $product_details = $product;
        }
      }
      return $product_details;
    }else{
      return false;
    }
  }
}

function addCart($product_id){
  if(!empty($product_id)){
    if(!empty($_SESSION['User']['id'])){
      $user = $_SESSION['User']['id'];
    }else{
      $user = 'tmp';
    }
    if(!isset($_SESSION['Cart'][$user]['products'])){
      $_SESSION['Cart'][$user]['products'] = array();
    }
    $products_details = getProductDetails($product_id);
    $_SESSION['Cart'][$user]['products'][] = $products_details;
    if(!isset($_SESSION['Cart'][$user]['total_price'])){
      $_SESSION['Cart'][$user]['total_price'] = 0;
    }
    $_SESSION['Cart'][$user]['total_price'] = $_SESSION['Cart'][$user]['total_price'] + $products_details['price'];
    return true;
  }
  return false;
}

function getTmpCart($user_id){
  if(!empty($user_id)){
    if(!isset($_SESSION['Cart'][$user_id]['products']) && isset($_SESSION['Cart']['tmp']['products'])){
      $_SESSION['Cart'][$user_id]['products'] = $_SESSION['Cart']['tmp']['products'];
      $_SESSION['Cart'][$user_id]['total_price'] = $_SESSION['Cart']['tmp']['total_price'];
      unset($_SESSION['Cart']['tmp']);
      setMsgFlash("Votre panier est maintenant associé à votre compte.", 'info');
    }
  }
}

function getCart($user = 'tmp'){
  if(isset($_SESSION['Cart'][$user])){
    return $_SESSION['Cart'][$user]['products'];
  }else{
    return false;
  }
}

?>
