<?php

/**
 * Description of DossierFactory
 *
 * A FAIRE il faut consulter les etats de dossier dans dossier_detail, pas dans dossier
 * @author cédric
 */
class DossierFactory {

    static function construct() {

        if (isset($_SESSION['dossier'])) {
            $var = unserialize($_SESSION['dossier']);
        } else {
            $var = new Dossier();
        }
        return $var;
    }
    
    public static function Creer_session($nom_event, $date_deb, $date_fin, $date_livr_aller,
            $heure_livr_aller, $nom_contact_aller, $gsm_contact_aller, $livr_aller, $transp_aller, $lieu_livr_aller, 
            $rue_livr_aller, $num_livr_aller, $boite_livr_aller, $cp_livr_aller, $commune_livr_aller,
            $pays_livr_aller, $livr_aller_conditions, $date_livr_retour, $heure_livr_retour, 
            $nom_contact_retour, $gsm_contact_retour, $livr_retour, $transp_retour, $lieu_livr_retour, $rue_livr_retour, 
            $num_livr_retour, $boite_livr_retour, $cp_livr_retour, $commune_livr_retour, $pays_livr_retour,
            $livr_retour_conditions, $livr_info_general){
        
            $dossier = new Dossier();

            $dossier->setNom_event($nom_event);
            $dossier->setDate_deb($date_deb);
            $dossier->setDate_fin($date_fin);
            $dossier->setDate_livr_aller($date_livr_aller);
            $dossier->setHeure_livr_aller($heure_livr_aller);
            $dossier->setNom_contact_aller($nom_contact_aller);
            $dossier->setGsm_contact_aller($gsm_contact_aller);
            $dossier->setLivr_aller($livr_aller);
            $dossier->setTransp_aller($transp_aller);
            $dossier->setLieu_livr_aller($lieu_livr_aller);
            $dossier->setRue_livr_aller($rue_livr_aller);
            $dossier->setNum_livr_aller($num_livr_aller);
            $dossier->setBoite_livr_aller($boite_livr_aller);
            $dossier->setCp_livr_aller($cp_livr_aller);
            $dossier->setCommune_livr_aller($commune_livr_aller);
            $dossier->setPays_livr_aller($pays_livr_aller);
            $dossier->setLivr_aller_conditions($livr_aller_conditions);
            $dossier->setDate_livr_retour($date_livr_retour);
            $dossier->setHeure_livr_retour($heure_livr_retour);
            $dossier->setNom_contact_retour($nom_contact_retour);
            $dossier->setGsm_contact_retour($gsm_contact_retour);
            $dossier->setLivr_retour($livr_retour);
            $dossier->setTransp_retour($transp_retour);
            $dossier->setLieu_livr_retour($lieu_livr_retour);
            $dossier->setRue_livr_retour($rue_livr_retour);
            $dossier->setNum_livr_retour($num_livr_retour);
            $dossier->setBoite_livr_retour($boite_livr_retour);
            $dossier->setCp_livr_retour($cp_livr_retour);
            $dossier->setCommune_livr_retour($commune_livr_retour);
            $dossier->setPays_livr_retour($pays_livr_retour);
            $dossier->setLivr_retour_conditions($livr_retour_conditions);
            $dossier->setLivr_info_general($livr_info_general);  

            return $dossier;
    }
    
    static function Enregistrer_doc_livraison(
            $type_livr,$pw_download,$nbr_download,$datelimite_download,$date_livr,$heure_livr,
            $fac_societe,$fac_tva,$fac_rue,$fac_num,$fac_boite,$fac_cp,
            $fac_commune,$fac_pays,$fac_note,$livr_societe,$livr_rue,$livr_num,
            $livr_boite,$livr_cp,$livr_commune,$livr_pays,$livr_contact,$livr_telephone_contact,
            $livr_note_livraison,$livr_note,$actif) {

            if (file_exists('./connect.php')) {
                include './connect.php';
            } else {
                include '../connect.php';
            }
            
        $query = "INSERT INTO document_livraison SET
                type_livraison='".mysqli_real_escape_string($connection,$type_livr)."',
                pw_download='".mysqli_real_escape_string($connection,$pw_download)."',
                nbr_download='".mysqli_real_escape_string($connection,$nbr_download)."',
                datelimite_download='".mysqli_real_escape_string($connection,$datelimite_download)."',
                date_livr='".mysqli_real_escape_string($connection,$date_livr)."',
                heure_livr='".mysqli_real_escape_string($connection,$heure_livr)."',
                fac_societe='".mysqli_real_escape_string($connection,$fac_societe)."',
                fac_tva='".mysqli_real_escape_string($connection,$fac_tva)."',
                fac_rue='".mysqli_real_escape_string($connection,$fac_rue)."',
                fac_num='".mysqli_real_escape_string($connection,$fac_num)."',
                fac_boite='".mysqli_real_escape_string($connection,$fac_boite)."',
                fac_cp='".mysqli_real_escape_string($connection,$fac_cp)."',
                fac_commune='".mysqli_real_escape_string($connection,$fac_commune)."',
                fac_pays='".mysqli_real_escape_string($connection,$fac_pays)."',
                fac_note='".mysqli_real_escape_string($connection,$fac_note)."',
                livr_societe='".mysqli_real_escape_string($connection,$livr_societe)."',
                livr_rue='".mysqli_real_escape_string($connection,$livr_rue)."',
                livr_num='".mysqli_real_escape_string($connection,$livr_num)."',
                livr_boite='".mysqli_real_escape_string($connection,$livr_boite)."',
                livr_cp='".mysqli_real_escape_string($connection,$livr_cp)."',
                livr_commune='".mysqli_real_escape_string($connection,$livr_commune)."',
                livr_pays='".mysqli_real_escape_string($connection,$livr_pays)."',
                livr_contact='".mysqli_real_escape_string($connection,$livr_contact)."',
                livr_telephone_contact='".mysqli_real_escape_string($connection,$livr_telephone_contact)."',
                livr_note_livraison='".mysqli_real_escape_string($connection,$livr_note_livraison)."',
                livr_note='".mysqli_real_escape_string($connection,$livr_note)."',
                actif='".mysqli_real_escape_string($connection,$actif)."'";
             $result=mysqli_query($connection,$query) or die (mysqli_error($connection).' Erreur : '.$query);
             $dernier_id=mysqli_insert_id($connection);
             
             return $dernier_id; 
    }


    static function consulterDossierDetail() {
        $var = self::construct();
        return $var;
    }
    public static function Lister_dossiers($id_dossier, $id_client, $ordre, $condition) {


	$bdd = Utilitaires::connexion();
//la longeur du varchar dossier payement est trop court !!
	//il faut joindre detail du dossier avec les montants
	$query = "SELECT
			dossier.id AS id_dossier,
			dossier.id_client,
			dossier.date_crea AS date_crea_dossier,
			dossier.ref_dossier,
			dossier.note AS note_dossier,
			dossier.ip,
			
			GROUP_CONCAT(DISTINCT dossier_payement.type) AS types_payement,
			MAX(dossier_payement.date) AS date_dernier_payement,
			sum(dossier_payement.montant) AS total_payement,
			sum(dossier_payement.comission) AS total_commission,
			dossier_payement.identifiant AS reference_payement,
			dossier_payement.note AS note_payement,
			
			dossier_transport.montant AS montant_transport,
			dossier_transport.tracking,
			dossier_transport.transporteur,
			
			client.login AS login_client,
			client.email AS email_client,
			client.nom AS nom_client
			
			FROM dossier
LEFT JOIN dossier_detail
			ON dossier_detail.id_dossier=dossier.id
			LEFT JOIN dossier_payement
			ON dossier_payement.dossier=dossier.id

			LEFT JOIN dossier_transport
			ON dossier_transport.dossier=dossier.id

			LEFT JOIN client
			ON client.id=dossier.id_client

			WHERE dossier.id > 0

		";

	if (isset($id_dossier)) {

	    $query.=" AND dossier.id = '" . $id_dossier . "' ";
	}
//condition supplémentaires
	switch ($condition) {
	    case encodage:$query.="AND dossier_detail.etat ='10'";
		break;
	    case offre:$query.="AND dossier_detail.etat ='20'";
		break;
	    case offre_option:$query.="AND dossier_detail.etat ='30'";
		break;
	    case commande:$query.="AND dossier_detail.etat ='40'";
		break;
	    case preparation:$query.="AND dossier_detail.etat ='50'";
		break;
	    case bo:$query.="AND dossier_detail.etat ='60'";
		break;
	    case expedie:$query.="AND dossier_detail.etat ='70'";
		break;
	    default:$query.='';
		break;
	}



	$query.=" GROUP BY dossier.id ";

	// si on demande un classement par ordre:
	// 


	switch ($ordre) {
	    case client_login:$query.='ORDER BY client.login';
		break;
	    case client_mail:$query.='ORDER BY client.email';
		break;
	    case client_nom:$query.='ORDER BY client.nom';
		break;
	    case date:$query.='ORDER BY dossier.date_crea';
		break;
	    default:$query.='ORDER BY dossier.id';
		break;
	}

	//$stmt=$bdd->query($query)or die (print_r($bdd->errorInfo()));
	$stmt=$bdd->query($query) or die ('erreur Dossier Factory'.$bdd->error);


 //$stmt->store_result;
            if($stmt->num_rows!=0) {


	    while ($data = $stmt->fetch_assoc()) {


		$dossier = new Dossier();

		$dossier->setId_dossier($data['id_dossier']);
		$dossier->setId_client($data['id_client']);
		$dossier->setDate_crea_dossier($data['date_crea_dossier']);
		$dossier->setRef_dossier($data['ref_dossier']);
		$dossier->setNote_dossier($data['note_dossier']);
		$dossier->setIp($data['ip']);
		$dossier->setTypes_payement($data['types_payement']);
		$dossier->setDate_dernier_payement($data['date_dernier_payement']);
		$dossier->setTotal_payement($data['total_payement']);
		$dossier->setTotal_commission($data['total_commission']);
		$dossier->setReference_payement($data['reference_payement']);
		$dossier->setNote_payement($data['note_payement']);
		$dossier->setMontant_transport($data['montant_transport']);
		$dossier->setTracking($data['tracking']);
		$dossier->setTransporteur($data['transporteur']);
		$dossier->setLogin_client($data['login_client']);
		$dossier->setEmail_client($data['email_client']);
		$dossier->setNom_client($data['nom_client']);

                
		$query = "SELECT
		    SUM(qtee * prix) AS dossier_total,
		    GROUP_CONCAT(DISTINCT etat) AS dossier_detail_etat
		    FROM dossier_detail
		    WHERE id_dossier = '".$data['id_dossier']."'
		    GROUP BY id_dossier
		    ";

		$stmt2=$bdd->query($query) or die ('erreur Dossier Factory'.$bdd->error);


		if ($stmt2->num_rows != 0) {

		    $data2 = $stmt2->fetch_assoc();
		    $dossier->setDossier_total($data2['dossier_total']);
		    $dossier->setDossier_detail_etat($data2['dossier_detail_etat']);
		}
		$dossiers[] = $dossier;
		$stmt2->close();
	    }
	}

	$stmt->close();


	return $dossiers;
    }

    public static function Lister_detail_dossier($id_dossier) {


	$dossier = self::Lister_dossiers($id_dossier, $id_client, $ordre, $condition);

	if (!is_null($dossier)) {
	    $bdd = Utilitaires::connexion();
	    foreach ($dossier as $value_dossier) {

		$query = "SELECT  id,
				id_art,
				id_model,
				ref_art,
				nom_art,
				qtee,
				prix,
				etat,
				date_crea
				FROM dossier_detail WHERE id_dossier='".$value_dossier->getId_dossier()."'";
		$stmt=$bdd->query($query) or die ('erreur Dossier Factory'.$bdd->error);
      
		if ($stmt->num_rows > 0) {

		    while ($res = $stmt->fetch_assoc()) {
			$dossier_detail = new DossierDetail();
			$dossier_detail->setId($res['id']);
			$dossier_detail->setId_art($res['id_art']);
			$dossier_detail->setId_model($res['id_model']);
			$dossier_detail->setRef_art($res['ref_art']);
			$dossier_detail->setNom_art($res['nom_art']);
			$dossier_detail->setQtee($res['qtee']);
			$dossier_detail->setPrix($res['prix']);
			$dossier_detail->setEtat($res['etat']);
			$dossier_detail->setDate_crea($res['date_crea']);

			$dossier_details[]=$dossier_detail;
		    }
		}
	    }
	}
$return[]=$value_dossier;
$return[]=$dossier_details;
	return $return;
    }

}

?>
