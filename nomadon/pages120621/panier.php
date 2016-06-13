<?php
session_start();
ob_start();

include_once '../class/autoload.php';

if(!isset($_SESSION['lang'])) {
    header("Location:../index.php");
    ob_end_clean();
}

//on regarde si il faut multiplier les articles par un coeficient "caisse", la class panier 
//va toujours arrondir a la valeur supperieur pour avoir uyn equivalent caisse, si mult_producy est envoyé, c
//'est que l'on a demandé au client le nombre de caisse et pas le nombre de produit
if(isset ($_REQUEST['mult_product']) AND is_numeric($_REQUEST['mult_product'])){
    $multipliant=$_REQUEST['mult_product'];
    
}
// on décomposesi dans le cas ou un model est envoyé,

$chaine=explode('_-_', $_REQUEST['id_product'], 2);

$id_product=$chaine[0];
$id_model=$chaine[1];

//mise a jour de la quantite

if(isset($_REQUEST['maj'])) {
  if(isset ($multipliant)){
      $qte=$_REQUEST['maj']*$multipliant;
  }
  else{
      $qte=$_REQUEST['maj'];
  }
    $panier=PanierFactory::miseAJourQteArticle($_REQUEST['id_product'], $qte);

    
}

//supprimer un article
elseif($_REQUEST['supprime']==1) {
    $panier=PanierFactory::supprimerArticle($_REQUEST['id_product']);
}


//ajout d'un article
else {
    if ($id_model !='') {//si un model existe bien cette variable est initiée, on prend le prix du model

        $prix=ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id='.$id_model);//on va chercher le prix du modele


        foreach ($prix as $variable) {
            $px=$variable->prix[0];
        }
    }

    else {//si pas de model on prend le prix de l'article

        $prix=ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id='.$id_product);//on va chercher le prix du produit
        

        foreach ($prix as $variable) {
            $px=$variable->prix[0];
            
        }
    }

 if(isset ($multipliant)){
      $qte=$_REQUEST['qte']*$multipliant;
  }
  else{
      $qte=$_REQUEST['qte'];
  }
    $panier=PanierFactory::ajouterArticle($_REQUEST['id_product'], $qte,$px);

//$panier=PanierFactory::supprimerArticle($_REQUEST['id_product']);
}


header("Location:".$_SESSION['pageretour']);

ob_end_clean();
?>
