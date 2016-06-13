
<?php
//fichier langue lang_conf_commande
include_once realpath(dirname(__FILE__) . '/../class/autoload.php');


$texte = '
<table width="100%" border="0">
  <tr>
    <td>
    
        <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        ' . $lang_politesse[$lang] . '
        </font></td></tr>
        <tr><td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">';

$texte .='<br>
<strong>' . $lang_orderdate[$lang] . '</strong>
' . $date_crea . '<br>
 <strong>' . $lang_ordernum[$lang] . '</strong>
' . $dossier_id . '<br>   <br>
    <strong>' . $lang_ref_dossier[$lang] . '</strong>
' . $nom_event . '<br>
<strong>' . $lang_date_dossier[$lang] . '</strong>
' . $date_deb . ' '.$date_fin.'<br><br>
     </font></td></tr>         ';
//coordonnées contact
$texte .= '<tr><td width="50%">
     <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>' . $lang_coord[$lang] . '</strong><br>'
          .  $nom . ' ' . $prenom . '<br>
      ' . $email . '<br>
      ' . $telephone . '<br><br></font></td>';

//coordonnées facturation
$texte .= '<td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>' . $lang_adresse_fac[$lang] . '</strong><br>
        ' . $fac_societe . ' ' . $fac_tva . '<br>
         ' .  $fac_nom . ' ' . $fac_prenom . '<br>
      ' . $fac_rue . ' ' . $fac_num . ' ' . $fac_boite . '<br>
      ' . $fac_cp . ' ' . $fac_commune . '<br>
      ' . $fac_pays . '<br><br>';




// texte mail
$texte .='  </font> </td></tr>';

// ceci uniquement dans le cas d'un payement par banque

/*  $message .="
  Please use the following details to transfer your total order value:<br /><br />
  Bank Name: LBBW-Bank Stuttgart<br />
  Branch: ---<br />
  Account Name: Fa. moto plus+ GmbH<br />
  Account No.: 2498768<br />
  IBAN:: DE22600501010002498768<br />
  BIC/SWIFT: SOLADEST<br /><br />
  Your order will not ship until we receive payment in the above account.<br />
  <br>

  ";
 */

$texte .="</table>";


// Details de livraison et facturation
 $texte .='

  <table style="border-top:1px solid black; border-bottom:1px solid black;" width="100%" border="0">
  <tr>
  <td width="50%"> <font size="1"><strong>
  <font face="Verdana, Arial, Helvetica, sans-serif">

  '.$lang_adresse_liv1[$lang].'<br>

  </font></strong></td> 
  <td> <font size=\"1\"><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">

  '.$lang_adresse_liv2[$lang].'<br>

  </font> </strong></td>        </tr>
  <tr>
  <td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">

  '.$date_livr_aller.' '.$heure_livr_aller[0].'<br />
  '.$nom_contact_aller.' '.$gsm_contact_aller.'<br />';
 

if($livr_aller=='livraison'){
   $texte.='
  '.$lang_livraison[$lang].'<br />
      '.$lieu_livr_aller.'<br />
      '.$rue_livr_aller.' '.$num_livr_aller.' '.$boite_livr_aller.'<br />
  '.$cp_livr_aller.' '.$commune_livr_aller.'<br />
  '.$pays_livr_aller.'<br>
      '.$livr_aller_conditions.'<br>';
}
else{
     $texte.='
  '.$lang_enlevement[$lang].'<br><br>';
}
 $texte.='
  

  </font></td>
  <td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">

  '.$date_livr_retour.' '.$heure_livr_retour[0].'<br />
  '.$nom_contact_retour.' '.$gsm_contact_retour.'<br />';
 
 
if($livr_retour=='livraison'){
   $texte.='
  '.$lang_livraison[$lang].'<br />
      '.$lieu_livr_retour.'<br />
      '.$rue_livr_retour.' '.$num_livr_retour.' '.$boite_livr_retour.'<br />
  '.$cp_livr_retour.' '.$commune_livr_retour.'<br />
  '.$pays_livr_retour.'<br>
      '.$livr_retour_conditions.'<br>';
   

}
else{
     $texte.='
  '.$lang_enlevement[$lang].'<br><br>';
}
 $texte.='
  

  </font></td>       </tr>
  <tr><td>
  '.$livr_info_general.'
      </td></tr>
  </table>
  <table><tr><td> <br> <br> <br> </td></tr></table>
  ';
 

//Colonnes du detail
$texte .="

<table style=\"border-bottom:1px solid;\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
        <td>
            <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> 
                <strong>$lang_listecom[$lang]</strong>
            </font>
        </td>
    </tr>
    
    <tr>
        <td>
            <table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" >
                <tr>
                    <td colspan=\"2\" style=\"border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;\">
                        <div align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
                            <strong><font size=\"1\">$lang_qte[$lang]</font></strong></font>
                        </div>
                    </td>
          
                    <td style=\"border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;\">
                        <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
                            <strong>$lang_product[$lang]</strong>
                        </font>
                    </td>

                    <td style=\"border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;\">
                        <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
                            <strong>$lang_ref[$lang]</strong>
                        </font>
                    </td>

                    <td style=\"border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;\" width=\"150\">
                        <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
                            <strong>$lang_pu[$lang]</strong>
                        </font>
                    </td>

                    <td style=\"border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;\" width=\"150\">
                        <div align=\"right\">
                            <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
                                <strong><font size=\"1\">$lang_tva[$lang]</strong>
                            </font>
                        </div>
                    </td>   

                    <td style=\"border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;\" width=\"150\">
                        <div align=\"right\">
                            <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
                                    <strong><font size=\"1\">$lang_pt[$lang]</font></strong>
                            </font>
                        </div>
                    </td>
                </tr>

";


//list($id_prod[$i], $id_model[$i], $ref_prod[$i], $nom_prod[$i], $qtee_prod[$i], $prix_prod[$i], $tva_prod[$i])=$data;
// le detail a boucler
$prix_col = 0;
foreach ($id_prod as $number_variable => $variable) {
    
    $prix_ligne = $qtee_prod[$number_variable] * $prix_prod[$number_variable];
    $prix_total = $prix_total + $prix_ligne;
    $montant_tva = number_format($prix_prod[$number_variable] * $tva_prod[$number_variable] / 100, 2);
    //$montant_tva_ligne = number_format($prix_ligne * $tva / 100,2);
    $montant_tva_ligne = $qtee_prod[$number_variable] * $montant_tva;
    //$tva_col = $tva_col + ($prix_ligne * ($tva_prod[$number_variable] / 100));

    $vary_basket_line[$number_variable]['ITEMCODE']=$ref_prod[$number_variable];
    $vary_basket_line[$number_variable]['QUANTITY']=$qtee_prod[$number_variable];
    $texte .='

                <tr>
                    <td width="20" style="border-right: 0px solid; border-bottom: 1px solid; border-color: #ffffff;">
                        <div align="center">
                            <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                                ' . $qtee_prod[$number_variable] . '
                                   
                            </font>
                        </div>
                    </td>
                    
                    <td width="20" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;">
                        <div align="center">
                            <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                                
                            </font>
                        </div>
                    </td>
          
                    <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;">
                        <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                            <strong>
                                ' . $nom_prod[$number_variable] . '
                            </strong>
                                <!--<br />Shipping time: 3-4 Days<em><br></em>-->   
                        </font>
                     </td>
                     
                    <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;">
                        <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                            ' . $ref_prod[$number_variable] . '
                                <!--<br><em></em>-->
                        </font>
                    </td>
                    
                    <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;" width="150">
                        <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                            ' . $prix_prod[$number_variable] . ' EUR
                        </font>
                    </td>

                    <td width="20" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;"  width="150">
                        <div align="right">
                            <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                            ' . $tva_prod[$number_variable] . '
                            </font>
                        </div>
                    </td>
                    
                    <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;" width="150">
                        <div align="right">
                            <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                             ' . $prix_ligne . ' EUR
                            </font>
                        </div>
                    </td>
                </tr>
';

$tabtva[$tva_prod[$number_variable]][] = $montant_tva_ligne;
}
$tvatransport = $fraistransport[0] * $fraistransport[1] / 100;

$tabtva[$fraistransport[1]][] = $tvatransport;

$prix_total = $prix_total + $fraistransport[0];

//$tva_col = $tva_col + $tvatransport;
// $prix_total = $prix_col + $prix_transport + $tva_col;

$texte .='

            </table>
        </td>
    </tr>
</table>


    <div align="right">
        <font size="1" face="Arial, Helvetica, sans-serif">
            ' . $lang_sstotal[$lang] . ' ' . number_format($prix_total, 2) . ' EUR
        </font>
    </div>';

$prix_total = $prix_total + $fraistransport[0];

$texte .='
    <div align="right">
        <font size="1" face="Arial, Helvetica, sans-serif">
            <br>' . $lang_transport[$lang] . '(' . $lang_tva2[$lang] . ' ' . $fraistransport[1] . '%): ' . number_format($fraistransport[0], 2) . ' EUR
        </font>
    </div>';


if (isset($tabtva)) {
 
    foreach ($tabtva as $key => $value) {

        if (!is_null($key) AND $key != 0) {
            $dtva = array_sum($tabtva[$key]);
            $texte .='<div align="right">
        <font size="1" face="Arial, Helvetica, sans-serif">
            <br>' . $lang_tva[$lang] . ' ' . $key . '% : ' . number_format($dtva, 2) . ' EUR
        </font>
    </div>
';
            
            $divtva[] = $dtva;
        }
    }
  
    $tavtotal = array_sum($divtva);
}

$texte .='<!--<br>
        <div align="right"><font size="1" face="Arial, Helvetica, sans-serif">
        incl. UST 19%: - EUR</font></div>
        -->
    <div align="right">
        <font size="2" face="Arial, Helvetica, sans-serif">
            <br><b>' . $lang_total[$lang] . number_format($prix_total + $tavtotal, 2) . ' EUR</b>
        </font>
    </div>



';

/*
  $texte .='<br><br><strong>'.$lang_adress_fac[$lang].'</strong><br>
  ' . $nom . ' ' . $prenom . '<br>
  ' . $societe . '<br>
  ' . $rue . ' ' . $num . ' ' . $boite . '<br>
  ' . $cp . ' ' . $commune . '<br>
  ' . $pays . '<br>
  ';
 */

$texte .='<br><br><strong>' . $lang_festi_add0[$lang] . '</strong><br>
         ' . $lang_festi_add1[$lang] . '<br>
         ' . $lang_festi_add2[$lang] . '<br>
         ' . $lang_festi_add3[$lang] . '<br>
         ' . $lang_festi_add4[$lang] . '<br>
         ' . $lang_festi_add5[$lang] . '<br>
             ' . $lang_festi_add6[$lang] . '<br>
';



/*
  if ($_POST['type_payement'] == 'payement_livraison') {
  $texte .="
  Payement au plus tard à la livraison(avant déchargement, pas de chèque, ni bancontact). <br>
  Pour certains produits, le payement d'un acompte pourra être exigé.<br><br>
  En cas de payement anticipé par virement, merci d'utiliser les informations suivantes :<br>
  ";
  } else {
 * 
 */

//}
/*
  $texte .="

  Banque: FORTIS BNP-PARISBAS<br />

  Compte No.: 001-3035707-71<br />
  IBAN:: BE49 0013  0357 0771<br />
  BIC/SWIFT: GEBABEBB<br /><br />

  COMMUNICATION STRUCTUREE: " . $txn_id . "
  <br>";

 */
$texte .="<br><br></td></tr></table>";

include './pages/vary_basket.php';
echo $texte;
$fichier_joint=array('chemin'=>$xml_chemin,'type'=>'xml','nom'=>'click to Vary.xml');
Maileur::envoimail($lang, $sujet[$lang], $texte, $email,$fichier_joint);
/*
  $texte_html = '<html><head></head><body><table width="100%" border="0">
  <tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td></td>

  ';


  //creation du texte en html, rajout des diverses balises et images.

  $texte_html .="<td width=\"1\">
  <img src=\"cid:$file_id\" alt=\"RoelsPaints\"  >
  </td>
  </tr>
  </table>";


  // texte mail
  $texte_html .=$texte;


  $texte_html .='</font>';/////////////////

  $texte_html .="
  </p>//////////////</td>
  </tr>
  </table></body></html>
  "; */
?>