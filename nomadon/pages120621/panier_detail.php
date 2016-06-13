

<?php
include_once './class/autoload.php';

//include_once './class/Utilitaire_galerie.class.php';

if (isset($_SESSION['id_client'])) {
    $panier = PanierFactory::ajout_sql();
      
        
} else {
    $panier = PanierFactory::consulterPanier();
}

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
//les données client:
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

    $result = mysql_query($query);

    if (mysql_num_rows($result) > 0) {

        $data = mysql_fetch_array($result);
    }





    $requete_paypal.='<input type="hidden" name="address_override" value="1">';
    $requete_paypal.='<input type="hidden" name="first_name" value="' . $data['prenom'] . '">';
    $requete_paypal.='<input type="hidden" name="last_name" value="' . $data['nom'] . '">';
    $requete_paypal.='<input type="hidden" name="address1" value="' . $data['adresse'] . $data['num'] . '/' . $data['boite'] . '">';
    //$requete_paypal.='<input type="hidden" name="address2" value="Bat A">';
    $requete_paypal.='<input type="hidden" name="city" value="' . $data['commune'] . '">';
    $requete_paypal.='<input type="hidden" name="zip" value="' . $data['cp'] . '">';
    $requete_paypal.=' <input type="hidden" name="country" value="' . $data['Pays'] . '">';
    $requete_paypal.=' <input type="hidden" name="night_phone_a" value="' . $data['telephone'] . '">';
    //  $requete_paypal.='<input type="hidden" name="night_phone_b" value="146000000">';
    // $requete_paypal.=' <input type="hidden" name="night_phone_c" value="">';
}

echo'<div id=page>';

echo'<h1>' . $lang_titre[$lang] . '</h1>';

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



foreach ($panier->article as $ref_article => $valeurs) {

    $chaine = explode('_-_', $ref_article, 2);

    $id_product = $chaine[0]; //id de l'element
    $id_model = $chaine[1]; //modele qui conditionne le prix
    $qte = $valeurs['qte']; // la quantite
    if ($valeurs['multipliant'] != 0) {
        $multipliant = $valeurs['multipliant'];
    } else {
        $multipliant = 1;
    }


    $elements = ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id=' . $id_product);
    $models = ElementFactory::ElementSelectFREE($_SESSION['lang'], 0, 'element.id=' . $id_model);


    // on verifie que l'article existe toujours, si non on le supprime dans la table et l'objet
    if (!is_null($elements)) {
        foreach ($elements as $element) {
            $lien_photo = $element->lien_photo;
            $ref_element = $element->ref_element;
            $nom_element = $element->nom_element;
            $prix = $element->prix['0']; //sera ecrasé si il y a un model
            $tva = $element->tva['0']; //sera ecras? si il y a un model
            $poids = $element->poids;

            if (($transp_spec < $element->transp_spec))
                $transp_spec = $element->transp_spec;
        }

        if (!is_null($models)) {
            foreach ($models as $model) {

                $ref_model = '_' . $model->ref_element;
                $nom_model = $model->nom_element;
                $prix = $model->prix['0'];
                $tva = $model->tva['0'];
                $poids = $model->poids;
            }
        }


        echo'<tr>';
        echo '<td id="thumb"><img src="fonctions/fly_thumb.php?links=' . $lien_photo[0] . '&wm=80&w=80&h=80" alt="' . $nom_element . '" border="0"></td>';
        echo '<td><p>' . $ref_element . $ref_model . '</p></td>';
        echo '<td id="nom"><p>' . $nom_element . '<br><br>' . $nom_model . '</p></td>';

        //echo'<form name="modif_panier" action="./pages/panier.php">';
        echo'<form name="modif_panier" action="./' . $_SESSION['lang'] . '-ajtart.html">';

        echo '<td id="quantite"><p>';
        echo'<a href="./' . $_SESSION['lang'] . '-ajtart.html?id_product=' . $ref_article . '&maj=' . ($qte - 1 * $multipliant) . '"><img src="./img/moins.gif" width="14" height="10" alt="moins"/></a>';

        echo'<input type="text" name="maj" action="get" value="' . number_format($qte, 0) . '" size="1" />';

        echo'<a href="./' . $_SESSION['lang'] . '-ajtart.html?id_product=' . $ref_article . '&maj=' . ($qte + 1 * $multipliant) . '"><img src="./img/plus.gif" width="14" height="10" alt="plus"/></a>';
        echo'<input class="hide" type="submit" value="' . $ref_article . '" name="id_product" / >';
        if ($element->unite_vente != '') {
            echo'<p style="margin:0;padding:0;font-size:10px;">(par ' . $element->unite_vente . ')</p>';
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

        echo'<td id="supprimer"><p><a href="./pages/panier.php?id_product=' . $ref_article . '&supprime=1"><img src="./img/delete_petit.png"  alt="delete"/></a></p></td>';
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



    $fraistransport = TransportFactory::Transport_Calcul($data['Pays'], $poids_total, $transp_spec);


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

        if ($qte <= 0) {
            $fraistransportsql = 'NULL';
            $tauxtvatransport = 'NULL';
        }
        //on place les frais de transport en bd
        include './connect.php';
        $query = "INSERT INTO dossier_transport SET dossier='" . $panier->num_dossier . "', montant=" . $fraistransportsql . ", tva=" . $tauxtvatransport . " ON DUPLICATE KEY UPDATE montant=" . $fraistransportsql . ", tva=" . $tauxtvatransport . "";
        mysql_query($query);
        mysql_close();
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
if(isset($divtva)){
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





echo'<form action="./fr-pg82-' . $site . '.html" method="post">';

$requete_paypal.='<input type="hidden" name="handling_cart" value="' . $fraistransportsql . '">';

echo $requete_paypal;

if ($erreur_traitement != 1) {

    if (isset($_SESSION['id_client'])) {
        echo'<input type="image" src="./img/valider_grd.png" style="margin:10px 0 0 350px;float:left;border:none"  name="submit" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    }
    
    else {
        //si pas de id_client on links vers login
        echo'<a href="./fr-pg8-' . $site . '.html"><img src="./img/valider_grd.png" style="margin:10px 0 0 350px;float:left;border:none" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'"></a>';
    }
}
echo'</form>';

echo'<form action="./fr-pg71-' . $site . '.html" method="post">';

$requete_paypal.='<input type="hidden" name="delete" value="delete">';
echo $requete_paypal;
echo'<input type="image"  style="float:left;border:none; margin-top:40px;" src="./img/annuler_grd.png"  name="submit" alt="'.$lang_annuler[$lang].'" title="'.$lang_annuler[$lang].'">';
    

echo'</form>';

echo'<div class="clear"></div>';
echo'</div> <!--gauche-->';



?>
<!--  
  <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_ext-enter">
<input type="hidden" name="redirect_cmd" value="_xclick">
<input type="hidden" name="first_name" value="Prénom">
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
<input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Paiement sécurisé par carte bancaire"/>
  </form>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QB3MS5PKSNQC2">
<input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
<img alt="" border="0" src="https://www.sandbox.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
-->

<?php
echo'</div>'; ///page

