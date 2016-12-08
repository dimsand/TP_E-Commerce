<?php
session_start();
include_once('env.php');
include_once('functions.php');
include_once('./tpl/header.php');

// On regarde la valeur de la variable 'traitement' passé en GET pour savoir quel traitement on fait
if(isset($_GET['traitement'])){
  switch($_GET['traitement']){
    case TRAIT_ADD_CART:
      if(!empty($_GET['product_id'])){
        $product_id = $_GET['product_id'];
      }
      if(addCart($product_id)){
        setMsgFlash("Le produit a été ajouté au panier.", 'success');
        header('Location: ./cart.php ');
      }else{
        setMsgFlash("Le produit n'a pas correctement été ajouté au panier. Veuillez réessayer.");
        header('Location: ./index.php ');
      }
      break;
    case TRAIT_LOGIN:
      if(!empty($_POST['username']) && !empty($_POST['password'])){
        if($_POST['username'] == TEST_USER_USERNAME && md5(sha1($_POST['password'])) == TEST_USER_PASSWORD){
          $_SESSION['User']['id'] = TEST_USER_ID;
          $_SESSION['User']['username'] = $_POST['username'];
          $_SESSION['User']['password'] = md5(sha1($_POST['password']));
          getTmpCart($_SESSION['User']['id']);
          setMsgFlash("Vous êtes connecté", 'success');
          header('Location: ./index.php ');
        }else{
          setMsgFlash("L'identifiant ou le mot de passe n'est pas valide");
          header('Location: ./login.php ');
        }
      }else{
        setMsgFlash("Entrer un indentifiant et un mot de passe");
        header('Location: ./login.php ');
      }
      break;
    case TRAIT_LOGOUT:
      $_SESSION = array();
      session_destroy();
      header('Location: ./index.php ');
      break;
    case TRAIT_PAIEMENT:
      if(!empty($_POST['num_cb']) && !empty($_POST['date_exp']) && !empty($_POST['crypto'])){
        $error = false;
        if(!preg_match("/^([0-9]{16})$/", $_POST['num_cb'])){  // On vérifie que le numéro de cb contient bien 16 chiffres
          setMsgFlash("Le numéro de carte bancaire doit avoir 16 chiffres");
          $error = true;
        }
        if(!preg_match("/^([0-9]{2})(\/)([0-9]{2})$/", $_POST['date_exp'])){  // On vérifie que la date d'exp de la cb est bien sous le format mois/année
          setMsgFlash("La date d'expiration de la carte bancaire doit être sous le format dd/aa (avec dd = jour et aa = année)");
          $error = true;
        }
        if(!preg_match("/^([0-9]{3})$/", $_POST['crypto'])){  // On vérifie que le cryptogramme de la cb ai bien 3 chiffres
          setMsgFlash("Le cryptogramme doit comporter 3 chiffres");
          $error = true;
        }
        if($error){
          header('Location: ./paiement.php');
        }else{
          header('Location: ./confirmation.php?success=true');
        }
      }else{
        setMsgFlash("Merci de remplir tous les champs");
        header('Location: ./paiement.php');
      }
      break;
  }
}

?>
