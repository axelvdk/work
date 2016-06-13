<?php
/* 
*12 aout 2011 changement du order by en montant et plus poids
 * 12 aout 2011 rajout du query . pour gestion du transporteur forcé
 */

/**
 * Description of transportFactory
 *
 * @author Cédric
 */
class TransportFactory {

    public static function Transport_Calcul($pays,$poids,$transp_spec=NULL) {

//transp_spec est l'usage d'un transporteur special, on va forcer l'utilisation de celui-ci
 if($poids=='0'){return array (0);}
 if (!empty($poids)AND(!empty($pays))){

   include 'connect.php';
            $query= "SELECT zone from pays WHERE code='".$pays."' ";

            $result=mysql_query($query) or die (mysql_error().' Erreur dans creer client: '.$query);

            if (mysql_numrows($result)>0) {
                $data= mysql_fetch_array($result);
                mysql_close();
                $zone=$data['zone'];

            }
           

        }


        if (!empty($poids)AND(!empty($pays))AND(is_numeric($zone)) AND (is_numeric($poids))) {
            include 'connect.php';
            $query= "SELECT transport.montant, prix_tva.tva from transport 
                    LEFT JOIN prix_tva 
                    ON prix_tva.id = transport.code_tva 
                    WHERE transport.zone=$zone AND transport.poids_max > $poids";
            
            if (!is_null($transp_spec)AND is_numeric($transp_spec)) {
                $query .=" AND transporteur = $transp_spec";
            }
            
            $query .=" ORDER BY montant ASC";

            $result=mysql_query($query) or die (mysql_error().' Erreur dans creer client: '.$query);
  
            if (mysql_numrows($result)>0) {
                $data= mysql_fetch_array($result);
                mysql_close();
                $transport=array ($data['montant'],$data['tva']);
                return $transport;

            }
             mysql_close();
            
        }

    }

}