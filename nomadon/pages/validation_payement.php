<?php

include_once './class/autoload.php';
include_once './vendor/autoload.php';
include_once './class/PanierFactory.class.php';
include_once './class/DossierFactory.class.php';

$stripe=[
  'publishable'=>'pk_test_ZFS3r2R3EzU2L0b5sV2Noz5u',
  'private'=>'sk_test_jAC2j1sVCIvpKPRwABDJREsE'
];
if(isset($_POST['dossier_livraison']))
{

    $_SESSION['dossier_livraison'] = $_POST;

}
if(isset($_POST['stripeToken']))
{
    try {
      echo "prix tot : ".$_SESSION['prix_total_stripe'];
        //Stripe::setApiKey($stripe['private']);
        \Stripe\Stripe::setApiKey($stripe['private']);

            \Stripe\Charge::create([
              "amount" => $_POST['prix_total'],
              "currency" => "eur",
              "source" => $_POST['stripeToken'], // obtained with Stripe.js
              "description" => "Charge for Nomadon"
            ]);
            PanierFactory::ajouterDossierPayement();
            $dossier_livraison = $_SESSION['dossier_livraison'];
            DossierFactory::Enregistrer_doc_livraison(
                    $dossier_livraison['transp_aller'],'',0,'','','',
                    $dossier_livraison['nom_livraison'],'',$dossier_livraison['rue_livraison'],$dossier_livraison['num_livraison'],$dossier_livraison['boite_livraison'],$dossier_livraison['cp_livraison'],
                    $dossier_livraison['commune_liraison'],$dossier_livraison['pays'],'',$dossier_livraison['nom_transp'],$dossier_livraison['rue_livraison'],$dossier_livraison['num_livraison'],
                    $dossier_livraison['boite_livraison'],$dossier_livraison['cp_livraison'],$dossier_livraison['commune_livraison'],$dossier_livraison['pays'],$dossier_livraison['telephone_livraison'],
                    '',$dossier_livraison['nom_livraison'],
                    '','',1);
                    $_SESSION['dossier_livraison'] = array();
                    unset($_SESSION['dossier_livraison']);
                    $panier = PanierFactory::consulterPanier();
                    $delete_panier = PanierFactory::supprimerPanier();
                    $_SESSION['panier']=array();
                    $_SESSION['download'] = 0;
                    unset($_SESSION['panier']);

                    $panier = PanierFactory::consulterPanier();

    } catch (Stripe_CardError $ex) {

    }
}


$dossier = DossierFactory::consulterDossierDetail();
//$connection = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW, BDD_BASE);
/*
 * echo'<pre>';
   var_dump($dossier);
   echo'</pre>';
*/
//exit;
//on prepare les champs form pour paypal

$requete_paypal = '<input type="hidden" name="cmd" value="_cart">';
$requete_paypal.='<input type="hidden" name="lc" value="FR">';
$requete_paypal.='<input type="hidden" name="upload" value="1">';
$requete_paypal.='<input type="hidden" name="no_note" value="1">';
$requete_paypal.='<input type="hidden" name="no_shipping" value="1">';
$requete_paypal.='<input type="hidden" name="business" value="cedric_1299580639_biz@lsq.be">';
$requete_paypal.='<input type="hidden" name="currency_code" value="EUR">';
$requete_paypal.='<input type="hidden" name="invoice" value="' . $panier->num_dossier . '">';
//$requete_paypal.='<input type="hidden" name="custom" value="champ libre?">';

if (isset($_SESSION['id_client'])) {
//les donn�es client:
    include './connect.php';
    $query = "Select

                    client.email,
                    client.nom,
                    client.prenom,
                    client.telephone,
                    client_coord_fac.societe,
                    client_coord_fac.tva,
                    client_coord_fac.rue,
                    client_coord_fac.num,
                    client_coord_fac.boite,
                    client_coord_fac.cp,
                    client_coord_fac.commune,
                    client_coord_fac.Pays

                FROM
                    client_coord_fac

                LEFT JOIN
                    client_coord_fac_lie
                ON client_coord_fac_lie.esclave=client_coord_fac.id

                LEFT JOIN client
                ON client_coord_fac_lie.maitre=client.id

                WHERE client.id='" . $_SESSION['id_client'] . "'

                LIMIT 1
        ";

    $result = mysqli_query($connection,$query);


    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
    }


    $requete_paypal.='<input type="hidden" name="address_override" value="1">';
    $requete_paypal.='<input type="hidden" name="first_name" value="' . @$data['prenom'] . '">';
    $requete_paypal.='<input type="hidden" name="last_name" value="' . @$data['nom'] . '">';
    $requete_paypal.='<input type="hidden" name="address1" value="' . @$data['adresse'] . @$data['num'] . '/' . @$data['boite'] . '">';
    //$requete_paypal.='<input type="hidden" name="address2" value="Bat A">';
    $requete_paypal.='<input type="hidden" name="city" value="' . @$data['commune'] . '">';
    $requete_paypal.='<input type="hidden" name="zip" value="' . @$data['cp'] . '">';
    $requete_paypal.=' <input type="hidden" name="country" value="' . @$data['Pays'] . '">';
    $requete_paypal.=' <input type="hidden" name="night_phone_a" value="' . @$data['telephone'] . '">';
    //  $requete_paypal.='<input type="hidden" name="night_phone_b" value="146000000">';
    //  $requete_paypal.=' <input type="hidden" name="night_phone_c" value="">';
}

echo'<div id=page>';

echo'<div id="avancement">';

include_once './pages/panier_detail_avancement.php';
echo'</div>';
echo '<div id=panier_detail>';


//titre des colonnes

echo'<table id="panier_detail">';

echo'<tr>';
echo'<th></th>';
echo'<th><p>' . $lang_ref[$lang] . '</p></th>';
echo'<th><p>' . $lang_nom[$lang] . '</p></th>';
echo'<th><p>' . $lang_qte[$lang] . '</p></th>';
echo'<th><p>' . $lang_pu[$lang] . '</p></th>';
echo'<th><p>' . $lang_pt[$lang] . '</p></th>';
echo'<th><p>' . $lang_tva[$lang] . '</p></th>';
echo'<th><p>' . $lang_supp[$lang] . '</p></th>';
echo'</tr>';


$prix_total = 0;
$compteur = 1;

$i = 0;

foreach ($panier->article as $ref_article => $valeurs) {

    $chaine = explode('_-_', $ref_article, 2);

    $id_product = $chaine[0];// id de l'element

    $id_model = $chaine[1]; // modele qui conditionne le prix
    $qte = $valeurs['qte']; // la quantite
    $prix=$valeurs['prix'];
    $tva=$valeurs['tva'];

    if($valeurs['multipliant'] != 0) {
        $multipliant = $valeurs['multipliant'];
    } else {
        $multipliant = 1;
    }
    $elements = ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id=' . $id_product);


    if(isset($_SESSION['style_reel']))
    {
        if( $elements[0]->getStyle() === "reel" )
            $_SESSION['style_reel'] += 1 ;
    }
    else {
        //initialisation
        if( $elements[0]->getStyle() === "reel" )
            $_SESSION['style_reel'] = 1 ;
        else
            $_SESSION['style_reel'] = 0 ;
    }

    $models = ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id=' . $id_model);
    //echo'<pre>';
    //var_dump($elements);
    // echo'</pre>';
    // on verifie que l'article existe toujours, si non on le supprime dans la table et l'objet
    if (!is_null($elements)) {
        foreach ($elements as $element) {

            $lien_photo = $element->getLien_photo();
            $ref_element = $element->getRef_element();
            $nom_element = $element->getNom_element();
            //$tabprix_vente = $element->getPrix_vente(); //sera ecras� si il y a un model
            //$prix=$tabprix_vente[0]['montant'];
            //$prix=  Pani
            //$tva=$tabprix_vente[0]['tva'];//sera ecras? si il y a un model
            //$tva = $element->getTva();
            $poids = $element->getPoids();

            if (($transp_spec < $element->getTransp_spec()))
                $transp_spec = $element->getTransp_spec();
        }

        if (!is_null($models)) {
            foreach ($models as $model) {

                $ref_model = '_' . $model->getRef_element();
                $nom_model = $model->getNom_element();
                 $tabprix_vente = $model->getPrix_vente();
                $prix=$tabprix_vente[0]['montant'];
                $tva=$tabprix_vente[0]['tva'];
                //$prix = $model->getPrix();
                //$tva = $model->getTva();
                $poids = $model->getPoids();
            }
        }


        echo'<tr>';
        echo '<td id="thumb"><img src="fonctions/fly_thumb.php?links=' . $lien_photo[0] . '&wm=80&w=80&h=80" alt="' . $nom_element . '" border="0"></td>';
        echo '<td><p>' . $ref_element . $ref_model . '</p></td>';
        echo '<td id="nom"><p>' . $nom_element . '<br><br>' . $nom_model;

        //si location on place les dur�es:
        if ($valeurs['loc_vente']==1) {
                  echo'<br>'.$lang_location[$lang].' '.$valeurs['date_deb'].' > '.$valeurs['date_fin'];

        }

        echo'</p></td>';

        //echo'<form name="modif_panier" action="./pages/panier.php">';
        echo'<form name="modif_panier" action="./' . $_SESSION['lang'] . '-ajtart.html">';

        echo '<td id="quantite"><p>';
        echo'<a href="./' . $_SESSION['lang'] . '-ajtart.html?id_product=' . $ref_article . '&maj=' . ($qte - 1 * $multipliant) . '"><img src="./img/moins.gif" width="14" height="10" alt="moins"/></a>';

        echo'<input type="text" name="maj" action="get" value="' . number_format($qte, 0) . '" size="1" />';

        echo'<a href="./' . $_SESSION['lang'] . '-ajtart.html?id_product=' . $ref_article . '&maj=' . ($qte + 1 * $multipliant) . '"><img src="./img/plus.gif" width="14" height="10" alt="plus"/></a>';
        echo'<input class="hide" type="submit" value="' . $ref_article . '" name="id_product" / >';
        if ($element->getUnite_vente != '') {
            echo'<p style="margin:0;padding:0;font-size:10px;">(par ' . $element->getUnite_vente . ')</p>';
        }
        echo'</td>';

        echo'</form>';

        echo '</p><td id="detail"><p>' . $prix . ' &euro;</p></td>';

        $prix_ligne = $qte * $prix;
        $prix_total = $prix_total + $prix_ligne;
        $montant_tva = number_format($prix * $tva / 100, 2);
        $montant_tva_ligne = number_format($prix_ligne * $tva / 100, 2);


        $requete_paypal.='<input type="hidden" name="quantity_' . $compteur . '" value="' . $qte . '">';
        $requete_paypal.='<input type="hidden" name="item_name_' . $compteur . '" value="' . $nom_element . ' ' . $nom_model . '">';
        $requete_paypal.='<input type="hidden" name="item_number_' . $compteur . '" value="' . $ref_article . '">';
        $requete_paypal.='<input type="hidden" name="amount_' . $compteur . '" value="' . $prix . '">';
        $requete_paypal.='<input type="hidden" name="tax_' . $compteur . '" value="' . $montant_tva . '">';


        echo '<td id="detail"><p>' . number_format($prix_ligne, '2') . ' &euro;</p></td>';
        echo '<td id="detail"><p>' . $tva . '%</p></td>';

        echo'<td id="supprimer"><p><a href="./' . $_SESSION['lang'] . '-ajtart.html?id_product=' . $ref_article . '&maj=0"><img src="./img/delete_petit.png"  alt="delete"/></a></p></td>';
        echo'</tr>';
        echo'';


        // creation des inputs pour bouton
    } else {
        //si le produit n'existe plus, on le supprime de l'objet
        $panier = PanierFactory::supprimerArticle($ref_article);
    }

//on cree un tableau avec une distinction par tva
    $tabtva[$tva][] = $montant_tva_ligne;

    $poids_total = $poids_total + ($poids * $qte);

    $compteur++;
    unset($ref_model);
    unset($nom_model);
}


//$prix_total_affiche=number_format($prix_total, '2');
//$montant_tva=$panier->totalTTC-$panier->totalHT;
//prix htva
echo'<tr>';
echo'<td style="border:none;"></td>';
echo'<td style="border:none;"></td>';
echo'<td style="border:none;"></td>';
echo'<td style="border:none;"></td>';
echo'<td id="detail_bas"><p>Sous Total:</p></td>';
echo '<td id="detail_bas"><p>' . number_format($prix_total, '2') . ' &euro;</p></td>';
echo'</tr>';

if (isset($_SESSION['id_client'])) {

    $fraistransport = TransportFactory::Transport_Calcul(@$data['Pays'], $poids_total, $transp_spec);


    if ((is_null($fraistransport[0])) AND ($qte > 0)) {

        //on assigne une erreur
        $erreur_traitement = 1;
        echo'<tr>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td id="detail_bas2" colspan="2">';
        //echo'<p>incl. '.$panier->TVA.'% tva: '.$montant_tva.' &euro;</p>';

        echo'<p>Problemes de calcul transport</p>';

        $fraistransportsql = 'NULL'; //pour passer la valeur null dans mysql...
    } else {
        echo'<tr>';

        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td id="detail_bas"><p>Livraison:</p></td>';
        echo '<td id="detail_bas"><p>' . $fraistransport[0] . ' &euro;</p></td>';
        //  echo '<td id="detail_bas2"><p>' . $fraistransport[1] . '%</p></td>';//tva transport
        echo'</tr>';


        $tvatransport = $fraistransport[0] * $fraistransport[1] / 100;

        $tabtva[$fraistransport[1]][] = $tvatransport;
        $prix_total = $prix_total + $fraistransport[0];
        $fraistransportsql = $fraistransport[0];
        $tauxtvatransport = $fraistransport[1];
        $_SESSION['prix_total'] = $prix_total;
       // ECHO $_SESSION['prix_total'];

        if ($qte <= 0) {
            $fraistransportsql = 'NULL';
            $tauxtvatransport = 'NULL';
        }

        //on place les frais de transport en bd
        include './connect.php';
        $query = "INSERT INTO dossier_transport SET dossier='" . $panier->num_dossier . "', montant=" . $fraistransportsql . ", tva=" . $tauxtvatransport . " ON DUPLICATE KEY UPDATE montant=" . $fraistransportsql . ", tva=" . $tauxtvatransport . "";
        mysqli_query($connection,$query);
        mysqli_close($connection);
        echo'<tr>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td style="border:none;"></td>';
        echo'<td id="detail_bas"><p>Total:</p></td>';
        echo '<td id="detail_bas"><p>' . number_format($prix_total, 2) . ' &euro;</p></td>';
        echo'</tr>';
    }
} else {
    echo'<tr>';
    echo'<td style="border:none;"></td>';
    echo'<td style="border:none;"></td>';
    echo'<td style="border:none;"></td>';
    echo'<td style="border:none;"></td>';
    echo'<td id="detail_bas2" colspan="2">';
    //echo'<p>incl. '.$panier->TVA.'% tva: '.$montant_tva.' &euro;</p>';

    echo'<p>excl. Frais de transport</p>';
}

echo'</td>';
echo'</tr>';


if (isset($tabtva)) {
    foreach ($tabtva as $key => $value) {
        if (!is_null($key) AND $key != 0) {
            $dtva = array_sum($tabtva[$key]);
            echo'<tr>';
            echo'<td style="border:none;"></td>';
            echo'<td style="border:none;"></td>';
            echo'<td style="border:none;"></td>';
            echo'<td style="border:none;"></td>';
            echo'<td id="detail_bas"><p>TVA:' . $key . '%</p></td>';
            echo '<td id="detail_bas"><p>' . number_format($dtva, 2) . ' &euro;</p></td>';
            echo'</tr>';


            //   $divtva[]=array_sum($tabtva[$key]);//calcul du totalde la tva
            $divtva[] = $dtva;
        }
    }
    if (isset($divtva)) {
        $tavtotal = array_sum($divtva);
    }
}


echo'<tr id="panier_detail_tot">';
echo'<td style="border:none;"></td>';
echo'<td style="border:none;"></td>';
echo'<td style="border:none;"></td>';
echo'<td style="border:none;"></td>';
echo'<td id="detail_bas"><p>Total:</p></td>';
echo '<td id="detail_bas"><p>' . number_format($prix_total + $tavtotal, '2') . ' &euro;</p></td>';
echo'</tr>';

echo'</table>';

echo'<div class="panier_detail_bouton">';

//echo'<a href="' . $_SESSION['pageretour_catalogue'] . '"><img src="./img/retour_catalogue.png" class="panier_detail_btretour" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '"></a>';


if (!empty($panier->article)) {//si le panier est vide pas de bouton

    echo'<form action="./fr-pg107-' . $site . '.html" method="post">';



    $requete_paypal2.='<input type="hidden" name="delete" value="delete">';
    echo $requete_paypal2;
    //echo'<input type="image"  src="./img/vider_panier.png"  name="submit" alt="' . $lang_annuler[$lang] . '" title="' . $lang_annuler[$lang] . '">';


    echo'</form>';

    echo'<form action="#" method="post">';

    $requete_paypal.='<input type="hidden" name="handling_cart" value="' . $fraistransportsql . '">';

    echo $requete_paypal;

    if ($erreur_traitement != 1) {

        if (isset($_SESSION['id_client'])) {
           // stripe

        } else {
            //si pas de id_client on links vers login
            echo'<a href="./fr-pg103-' . $site . '.html"><img src="./img/valider_commande.png" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '"></a>';
        }
    }
    echo'</form>';
}

?>
  <form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable'];?>"
    data-amount="<?php echo $_SESSION['prix_total_stripe']*100; ?>"
    data-name="Demo Site"
    data-description="Commande"
    data-locale="auto"
    data-zip-code="true"
    data-currency="eur">
  </script>
  <input type="hidden" name="prix_total" value = "<?php echo $_SESSION['prix_total_stripe']*100; ?>"/>
</form>
<?php
echo '</div>'; //panier_detail_bouton
echo'<div class="clear"></div>';
echo'</div> <!--gauche-->';
?>
<!--
  <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_ext-enter">
<input type="hidden" name="redirect_cmd" value="_xclick">
<input type="hidden" name="first_name" value="Pr�nom">
<input type="hidden" name="last_name" value="Nom">
<input type="hidden" name="address1" value="9 rue de l?Eglise">
<input type="hidden" name="address2" value="Bat A">
<input type="hidden" name="city" value="Paris">
<input type="hidden" name="zip" value="75000">
<input type="hidden" name="country" value="FR">
<input type="hidden" name="night_phone_a" value="33">
<input type="hidden" name="night_phone_b" value="146000000">
<input type="hidden" name="night_phone_c" value="">
<input type="hidden" name="business" value=" moi@monffsite.com">
<input type="hidden" name="item_name" value="n nom de l?objet">
<input type="hidden" name="item_number" value=" identifiant interne">
<input type="hidden" name="amount" value=" 10.00">
<input type="hidden" name="no_note" value="1"/>
<input type="hidden" name="no_shipping" value="1"/>
<input type="hidden" name="lc" value="FR"/>
<input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Paiement s�curis� par carte bancaire"/>
  </form>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QB3MS5PKSNQC2">
<input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus s�curis�e !">
<img alt="" border="0" src="https://www.sandbox.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
-->

<?php
echo'</div>'; ///page
