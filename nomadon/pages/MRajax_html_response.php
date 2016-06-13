<?php

//page de reponse de la requette ajax mondial relay
//A MODIFIER 
$language = 'en';


include_once '../config/config_mondialrelay.php';

$pays = $_REQUEST['pays'];
$cp = $_REQUEST['cp'];
$ville = $_REQUEST['ville'];

////////////////////////////////////////////////////////////////////////////////////////////////

error_reporting(0); //permet d'eviter un warning de nusoap.php qui bloque le reste du deroulement

require_once('/usr/share/php/nusoap/nusoap.php');

$client = new nusoap_client($nusoap_client, true);
$client->soap_defencoding = 'utf-8';
$params = array(
    'Enseigne' => $enseigne,
    'Pays' => $pays,
    //'NumPointRelais' => ""; //avoir le detail d'un point relais
    'Ville' => $ville,
    'CP' => $cp,
    'Latitude' => "", //permet de trouver le point relais le plus proche en utilisant geolocalisation html 5 au lieu de cp/ville
    'Longitude' => "", //idem
    'Taille' => $taille,
    'Poids' => $poids,
    'Action' => $action,
    'DelaiEnvoi' => "", //
    'RayonRecherche' => "", //
        //'TypeActivite' => "", //
        //'NACE' => "", //
);

//on genere le code de securité
$security = implode("", $params);
$security.=$pw;

$params['Security'] = strtoupper(md5($security));

$result = $client->call(
        'WSI3_PointRelais_Recherche', $params, 'http://api.mondialrelay.com/', 'http://api.mondialrelay.com/WSI3_PointRelaisRecherche'
);

//on verifie qu'il n'y a pas d'erreurs
if ($client->fault) {
    echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    $err = $client->getError();
    if ($err) {
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } elseif ($result [WSI3_PointRelais_RechercheResult][STAT] != 0) {
        
        if($result ["WSI3_PointRelais_RechercheResult"]["STAT"]==40){
            echo '<h2>Un paramettre est manquant</h2>';
        }
        elseif($result ["WSI3_PointRelais_RechercheResult"]["STAT"]==36){
            echo '<h2>Code Postal Invalide</h2>';
        }
        else{echo '<h2>Error code</h2><pre>' . $result ["WSI3_PointRelais_RechercheResult"]["STAT"] . '</pre>';}
    } else {




        if ($result[WSI3_PointRelais_RechercheResult][PointsRelais] == "") {
            echo'<div>';
            echo 'pas de resultat';
            echo'</div>';
        } else {
            $i = 0;
            foreach ($result[WSI3_PointRelais_RechercheResult][PointsRelais][PointRelais_Details] as $values) {

                //réinitialisation du tableau
                $params_detail = array();

                //création de l'adresse pour le detail point relais en popup
                $params_detail['resize'] == "";
                $security_detail = '<' . $enseigne10 . '>' . $values['Num'] . $values['Pays'] . '<' . $pw . '>';
                $params_detail['crc'] = strtoupper(md5($security_detail));

                if (count($values) == 0) {
                    echo'<div>';
                    echo 'pas de resultat';
                    echo'</div>';
                } else {
                    if ($i < 9) {//limiter a 9 resultats
                        echo'<div class="shop">';


                        echo'<input type="hidden" name="num_pr" value="' . $values['Num'] . '">';
                        echo '<p>';

                        echo '<div>' . $values['LgAdr1'] . ' <span class="num">-' . $values['Num'] . '-</span></div>'; //nom //numero du point relais

                        echo '<div>' . $values['LgAdr2'] . '</div>'; //nom ligne 2

                        echo '<div>' . $values['LgAdr3'] . '</div>'; //adresse+num

                        echo '<div>' . $values['LgAdr4'] . '</div>'; //adresse ligne2

                        echo '<div>' . $values['CP'] . ' ' . $values['Ville'] . '</div>'; //cp //commune

                        echo'<a href="?numrelais='.$values['Num'].'"> <img class="conf" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '" src="./img/valider.png"></a>';
                        echo '<a onclick="window.open(\'\',\'popup\',\'width=360,height=410,top=0,left=0,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0\')" target="popup" href="http://www.mondialrelay.com/public/permanent/details_relais.aspx?language=' . $language . '&ens=' . $enseigne . '49&num=' . $values['Num'] . '&pays=' . $values['Pays'] . '&resize=' . $params_detail['resize'] . '&crc=' . $params_detail['crc'] . '">';
                        echo '<img class="conf" alt="' . $lang_valider[$lang] . '" title="' . $lang_valider[$lang] . '" src="./img/detail.png">';
                        echo'</a>';


                        //  echo $values['Pays'] . '</td></tr>';//pays
                        /*
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Lundi']);
                          echo'</td></tr>';
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Mardi']);
                          echo'</td></tr>';
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Mercredi']);
                          echo'</td></tr>';
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Jeudi']);
                          echo'</td></tr>';
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Vendredi']);
                          echo'</td></tr>';
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Samedi']);
                          echo'</td></tr>';
                          echo'<tr>';
                          echo'<td>';
                          var_dump($values['Horaires_Dimanche']);
                          echo'</td></tr>';
                         */

                        echo'</div>'; //class shop
                        $i++;
                    }
                }
            }
            echo'<div class="clear">';
        }
    }
}
?>
