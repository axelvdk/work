<?php

/*
 *
 * 16mai2011 modif bug nbarticle dans
 * 20/10/11 rajout le la gestion du multipliant, qui permet de travailler un article par qte de caisse
 * 25/11/11 rajout de $numserie = $id_product.'_-_'.$id_model; et $id_model=0 si vide dans ajoutarticle pour bug repetition de l'article dns le panier quand on se connecte
 * 23/1/12 rajout de mysql_real_escape_string dans les divers insert mysql...
 * 18/10/12 modification ajout_sql pour prendre en compte multipliant et style lorsqu'il recr?e l'objet
 * 14/03/2013 ajout article: rajout du paramettre loc_vente
 */

/**
 * Description of PanierFactoryclass
 *
 * @author C�dric
 */

class PanierFactory {
    static function construct() {

        if (isset($_SESSION['panier'])) {
            $var = unserialize($_SESSION['panier']);
        } else {
            $var = new Panier();
        }

        return $var;
    }

    static function ajout_sql() {


      //  $connection = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW);
        $var = self::construct();

        if (file_exists('./connect.php')) {
            include './connect.php';
        } else {
            include '../connect.php';
        }


        if (!isset($var->num_dossier)) {

            //si pas de numero de dossier dans l'objet, on va chercher le dernier dossier en encodage

            $query = "SELECT dossier.id
	    FROM dossier
	    LEFT JOIN dossier_detail ON dossier_detail.id_dossier = dossier.id
	    WHERE id_client ='" . $_SESSION['id_client'] . "'
	    AND dossier_detail.etat = '10'
	    ORDER BY dossier.id DESC
	    LIMIT 1";


            $result = mysqli_query($connection,$query) or die(mysqli_error() . ' Erreur dans ajout sql: ' . $query);

            if (mysqli_num_rows($result) > 0) {

                $data = mysqli_fetch_array($result);
                $id_dossier = $data['id'];

                // on doit recreer l'objet
                //a faire tester si l'article existe encore

                $query = "SELECT dossier_detail.id_art,
				 dossier_detail.ref_art,
				 dossier_detail.ref_model,
				 dossier_detail.nom_art,
				 dossier_detail.nom_model,
                                 dossier_detail.id_model,
                                 dossier_detail.qtee,
                                 dossier_detail.prix,
                                 dossier_detail.loc_vente,
                                 dossier_detail.date1,
                                 dossier_detail.date2,
                                 dossier_detail.tva,
                                 element.style,
                                 element_unite_vente.multipliant
                         FROM dossier_detail

                         LEFT JOIN dossier
                         ON dossier.id=dossier_detail.id_dossier

                         LEFT JOIN element
                         ON element.id=dossier_detail.id_art

                         LEFT JOIN element AS model
                         ON model.id=dossier_detail.id_model

                        LEFT JOIN element_unite_vente
                        ON element_unite_vente.id=element.unite_vente

                         WHERE dossier.id='" . $id_dossier . "'
			   AND dossier_detail.etat='10';
";




                $result = mysqli_query($connection,$query) or die(mysqli_error() . ' Erreur dans ajout sql: ' . $query);
                while ($data = mysqli_fetch_array($result)) {
                    if ($data['id_model'] == '') {
                        $data['id_model'] = 0;
                    }


                    $numserie = $data['id_art'] . '_-_' . $data['id_model'];

                    $quantite = $data['qtee'];
                    $montantHT = $data['prix'];
                    $tva = $data['tva'];

                    //on va verifier que le prix n'a pas chang?
                    if((isset($data['id_model'])) and ($data['id_model']!='') and (!is_null($data['id_model'])) and ($data['id_model'] !=0) ){
                     $calprix=  ElementFactory::ElementPrix($data['id_model'], $user_id, $px=true);
                    }
                    else{
                    $calprix=  ElementFactory::ElementPrix($data['id_art'], $user_id, $px=true);

                    }

                    //on regarde si c'est une loc ou une vente et on attribue le prix
                    if ($data['loc_vente'] == 1) {

                $tabpx_loc = $calprix['loc'];
                $date_deb = date("Y-m-d", strtotime($data['date1']));
                $date_fin = date("Y-m-d", strtotime($data['date2']));
                $diff_unixtime = strtotime($date_fin) - strtotime($date_deb);
                $diff_jours = intval($diff_unixtime / 86400) + 1;


                foreach ($tabpx_loc as $value) {
                    //var_dump($value);
                    if ($value["period_min"] <= $diff_jours AND $diff_jours <= $value["period_max"]) {
                        $montantHT = $value["montant"];
                        $tva = $value["tva"];
                    }
                }
                    }
                else{
                       $montantHT=$calprix["vente"][0]["montant"];
                }
                    if (!empty($numserie)) {

                        $var->article[$numserie]['ref'] = $data['ref_art'];
                        $var->article[$numserie]['nom'] = $data['nom_art'];
                        $var->article[$numserie]['ref_model'] = $data['ref_model'];
                        $var->article[$numserie]['nom_model'] = $data['nom_model'];

                        if ($var->article[$numserie])
                            $var->article[$numserie]['qte'] += $quantite;
                        else {
                            $var->article[$numserie]['qte'] = $quantite;
                        }

                        if (isset($var->calculmontant) && $var->calculmontant == true) {
                            $var->article[$numserie]['prix'] = $montantHT;
                            $var->article[$numserie]['tva'] = $tva;
                            $var->CalculMontantArticle($numserie, $var->article[$numserie]['prix'], $quantite);
                            $var->CalculTotal($var->article[$numserie]['prix'] * $quantite);
                        }

                        $var->article[$numserie]['multipliant'] = $data['multipliant'];
                        $var->article[$numserie]['style'] = $data['style'];
                        $var->article[$numserie]['loc_vente'] = $data['loc_vente'];
                        $var->article[$numserie]['date_deb'] = $data['date1'];
                        $var->article[$numserie]['date_fin'] = $data['date2'];
                    }

                    $var->nbarticle = $var->nbarticle + $quantite;
                }
            } else {
                //si il n'existe pas: on cr?e un nouveau dossier

                $query = "INSERT INTO dossier SET
                                    id_client='" . $_SESSION['id_client'] . "',
                                    date_crea='" . date("d/m/y H:i:s") . "',
                                    ip='" . $_SERVER["REMOTE_ADDR"] . "'
                                    ";


                $result = mysqli_query($connection,$query) or die(mysqli_error() . ' Erreur dans ajot sql: ' . $query);
                $id_dossier = mysqli_insert_id($connection);
            }

            $var->num_dossier = $id_dossier;
        }

        //detail du dossier
        //on vide le dossier correction d'une eventuelle difference entre l'objet et la bdd

        $query = "DELETE FROM dossier_detail WHERE
                           id_dossier='" . $var->num_dossier . "' AND etat='10'
                                                      ";

        $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans ajout sql: ' . $query);

        $query = "ALTER TABLE dossier_detail
AUTO_INCREMENT=1  ";

        $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans ajout sql: ' . $query);

        foreach ($var->article as $clee => $valeur) {
            $chaine = explode('_-_', $clee, 2);

            $id_product = $chaine[0]; //id de l'element
            $id_model = $chaine[1]; //modele qui conditionne le prix
            if ($id_model == '') {
                $id_model = 0;
            }

            $query = "INSERT INTO dossier_detail SET
                           id_dossier='" . mysqli_real_escape_string($connection,$var->num_dossier) . "',
                           id_art='" . mysqli_real_escape_string($connection,$id_product) . "',
                           id_model='" . mysqli_real_escape_string($connection,$id_model) . "',
                           ref_art='" . mysqli_real_escape_string($connection, $valeur['ref']) . "',
			   ref_model='" . mysqli_real_escape_string($connection,$valeur['ref_model']) . "',
                            nom_art='" . mysqli_real_escape_string($connection,$valeur['nom']) . "',
				nom_model='" . mysqli_real_escape_string($connection,$valeur['nom_model']) . "',
                           qtee='" . mysqli_real_escape_string($connection,$valeur['qte']) . "',
                           prix='" . mysqli_real_escape_string($connection,$valeur['prix']) . "',
                               tva='" . mysqli_real_escape_string($connection,$valeur['tva']) . "',
                                     loc_vente='" . mysqli_real_escape_string($connection,$valeur['loc_vente']) . "',
                            date1='" . mysqli_real_escape_string($connection,$valeur['date_deb']) . "',
                             date2='" . mysqli_real_escape_string($connection,$valeur['date_fin']) . "',
                           etat='10',
                           note='test',
                           date_crea='" . date("d/m/y H:i:s") . "',
                           ip='" . $_SERVER["REMOTE_ADDR"] . "'
  ON DUPLICATE KEY UPDATE
                        qtee='" . mysqli_real_escape_string($connection,$valeur['qte']) . "',
                           date_crea='" . date("d/m/y H:i:s") . "',
                           ip='" . $_SERVER["REMOTE_ADDR"] . "'

                           ";

            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans ajout sql: ' . $query);
        }


        return $var;
    }

    static function consulterPanier() {
        $var = self::construct();
        return $var;
    }
    static function ajouterDossierPayement()
    {
       $connection = mysqli_connect('127.0.0.1', 'root', '', 'nomadon');
        $query = 'INSERT INTO `dossier_payement`(`dossier`,`montant`,`comission`) VALUES'
                  . ' ('.$_SESSION['id_client'].','.$_SESSION['prix_total'].','. 0.15 .')';

        $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer dossier payement : ' . $query);
        unset($_SESSION['panier']);

    }
    static function supprimerPanier() {
        unset($_SESSION['style_reel']);
        $var = self::construct();
           //echo $var->num_dossier;
        if (file_exists('./connect.php')) {
            include './connect.php';
        } else {
            include '../connect.php';
        }

        $query = "DELETE FROM dossier_detail WHERE
                           id_dossier='" . $var->num_dossier . "' AND etat='10'
                                                      ";

        $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans supprimerl: ' . $query);

        $query2 = "DELETE FROM dossier WHERE
                           id='" . $var->num_dossier . "'
                                                      ";

        $result2 = mysqli_query($connection,$query2) or die(mysqli_error($connection) . ' Erreur dans supprimer: ' . $query2);
        //echo "supperssion";var_dump($result2);

        }

    // Ajoute un article dans le Panier
    static function ajouterArticle($numserie, $quantite, $montantHT = 0, $tva = 21,$loc_vente = 0,$date_deb = NULL,$date_fin = NULL) {

            //loc_vente: 0vente / 1 loc
        //date_deb / fin dates d edebut et fin de location
        $connection = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW);
        $quantite = str_replace(',', '.', $quantite);
        if (!is_numeric($quantite)) {
            $quantite = 1;
        }


        $var = self::construct();



        if (isset($_SESSION['id_client'])) {
            if (file_exists('./connect.php')) {
                include './connect.php';
            } else {
                include '../connect.php';
            }

            $chaine = explode('_-_', $numserie, 2);

            $id_product = $chaine[0]; //id de l'element
            $query_p = "SELECT
                                element.nom_" . $_SESSION['lang'] . " AS nom_art,
                                element.ref,
                                element.style,
                                element_unite_vente.multipliant
                        FROM element
                        LEFT JOIN element_unite_vente
                        ON element_unite_vente.id=element.unite_vente

                        WHERE element.id='" . $id_product . "'
                       ";
            $result_p = mysqli_query($connection,$query_p);
            $data_p = mysqli_fetch_array($result_p);

            $nom_art = $data_p['nom_art'];
            $ref_art = $data_p['ref'];
            $style_art = $data_p['style'];

            $id_model = $chaine[1]; //modele qui conditionne le prix
            if ($id_model == '') {
                $id_model = 0;
            }
            $numserie = $id_product . '_-_' . $id_model;

            if (!is_null($id_model) AND $id_model != 0) {

                $query_m = "SELECT nom_" . $_SESSION['lang'] . " AS nom_mod,ref FROM element WHERE id='" . $id_model . "'";
                $result_m = mysqli_query($connection,$query_m);
                $data_m = mysqli_fetch_array($result_m);
                $ref_model = $data_m['ref'];
                $nom_model = $data_m['nom_mod'];
            }
            $var->article[$numserie]['nom'] = $nom_art;
            $var->article[$numserie]['ref'] = $ref_art;
            $var->article[$numserie]['nom_model'] = $nom_model;
            $var->article[$numserie]['ref_model'] = $ref_model;

            $query = "INSERT INTO dossier_detail SET
                           id_dossier='" . mysqli_real_escape_string($connection,$var->num_dossier) . "',
                           id_art='" . mysqli_real_escape_string($connection,$id_product) . "',
                           id_model='" . mysqli_real_escape_string($connection,$id_model) . "',
                           ref_art='" . mysqli_real_escape_string($connection,$ref_art) . "',
			       ref_model='" . mysqli_real_escape_string($connection,$ref_model) . "',
                            nom_art='" . mysqli_real_escape_string($connection,$nom_art) . "',
				nom_model='" . mysqli_real_escape_string($connection,$nom_model) . "',
                           qtee='" . mysqli_real_escape_string($connection,$quantite) . "',
                           loc_vente='" . mysqli_real_escape_string($connection,$loc_vente) . "',
                            date1='" . mysqli_real_escape_string($connection,$date_deb) . "',
                             date2='" . mysqli_real_escape_string($connection,$date_fin) . "',
                           etat='10',
                           date_crea='" . date("d/m/y H:i:s") . "',
                           ip='" . $_SERVER["REMOTE_ADDR"] . "'
                    ON DUPLICATE KEY UPDATE
                        qtee='" . mysqli_real_escape_string($connection,$var->article[$numserie]['qte']) . "',
                           date_crea='" . date("d/m/y H:i:s") . "',
                           ip='" . $_SERVER["REMOTE_ADDR"] . "'
                           ";

            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client: ' . $query);
        }

///////
        else {
            if (file_exists('./connect.php')) {
                include './connect.php';
            } else {
                include '../connect.php';
            }

            $chaine = explode('_-_', $numserie, 2);

            $id_product = $chaine[0]; //id de l'element
            $query_p = "SELECT
                                element.nom_" . $_SESSION['lang'] . " AS nom_art,
                                element.ref,
                                element.style,
                                element_unite_vente.multipliant
                        FROM element
                        LEFT JOIN element_unite_vente
                        ON element_unite_vente.id=element.unite_vente

                        WHERE element.id='" . $id_product . "'
                       ";


            $result_p = mysqli_query($connection,$query_p);
            $data_p = mysqli_fetch_array($result_p);

            $nom_art = $data_p['nom_art'];
            $ref_art = $data_p['ref'];
            $style_art = $data_p['style'];

            $id_model = $chaine[1]; //modele qui conditionne le prix
            if ($id_model == '') {
                $id_model = 0;
            }
            $numserie = $id_product . '_-_' . $id_model;
            if (!is_null($id_model) AND $id_model != 0) {

                $query_m = "SELECT nom_" . $_SESSION['lang'] . " AS nom_mod,ref FROM element WHERE id='" . $id_model . "'";
                $result_m = mysqli_query($connection,$query_m);
                $data_m = mysqli_fetch_array($result_m);

                $ref_model = $data_m['ref'];
                $nom_model = $data_m['nom_mod'];
            }

            $var->article[$numserie]['nom'] = $nom_art;
            $var->article[$numserie]['ref'] = $ref_art;
            $var->article[$numserie]['nom_model'] = $nom_model;
            $var->article[$numserie]['ref_model'] = $ref_model;
        }

        if ($data_p['multipliant'] != 0) {
            $qua = $quantite / $data_p['multipliant'];
            $qua = ceil($qua);
            $quantite = $qua * $data_p['multipliant'];
        }

        if (!empty($numserie)) {
            if ($var->article[$numserie])
                $var->article[$numserie]['qte'] += $quantite;
            else {
                $var->article[$numserie]['qte'] = $quantite;
            }

            if (isset($var->calculmontant) && $var->calculmontant == true) {
                $var->article[$numserie]['prix'] = $montantHT;
                $var->article[$numserie]['tva'] = $tva;
                $var->CalculMontantArticle($numserie, $var->article[$numserie]['prix'], $quantite);
                $var->CalculTotal($var->article[$numserie]['prix']);
            }
            $var->article[$numserie]['multipliant'] = $data_p['multipliant'];
            $var->article[$numserie]['style'] = $data_p['style'];
            $var->article[$numserie]['loc_vente'] = $loc_vente;
            $var->article[$numserie]['date_deb'] = $date_deb;
            $var->article[$numserie]['date_fin'] = $date_fin;
        }


        $var->nbarticle = $var->nbarticle + $quantite;


        return $var;
    }

    // Supprime un article du Panier
    static function supprimerArticle($numserie) {

        $var = self::construct();
        if (!empty($numserie) && $var->article[$numserie]) {
            if (isset($var->calculmontant) && $var->calculmontant == true) {
                $var->CalculTotal(- $var->article[$numserie]['montantHT']);
            }
            $var->nbarticle = $var->nbarticle - $var->article[$numserie]['qte'];
            unset($var->article[$numserie]);
        }
        return $var;
    }

    // Met ? jour la quantite d'un article s?lectionn? dans le Panier
    static function miseAJourQteArticle($numserie, $quantite) {

        $quantite = str_replace(',', '.', $quantite);
        if (!is_numeric($quantite)) {
            $quantite = 1;
        }


        $var = self::construct();

        if (($quantite) < 0) {
            $quantite = 0;
        }

        if (!empty($numserie) && $var->article[$numserie]) {
            if ($var->article[$numserie]['multipliant'] != 0) {

                $qua = $quantite / $var->article[$numserie]['multipliant'];
                $qua = ceil($qua);
                $quantite = $qua * $var->article[$numserie]['multipliant'];
            }
            if (isset($var->calculmontant) && $var->calculmontant == true) {


                $diff = $quantite - $var->article[$numserie]['qte'];
                $var->CalculMontantArticle($numserie, $var->article[$numserie]['prix'], $diff);
                $diff *= $var->article[$numserie]['prix'];
                $var->CalculTotal($diff);
            }
            $var->nbarticle = $var->nbarticle - $var->article[$numserie]['qte'] + $quantite;

            $var->article[$numserie]['qte'] = $quantite;
        }

        if (($var->article[$numserie]['qte']) <= 0) {
            unset($var->article[$numserie]);
        }
        return $var;
    }

    static function ContientElementReel($panier) {
        //regarde si il existe des elements reel dans le panier, cela conditionne la demande de livraison
        $i = 0;
        foreach ($panier->article as $value) {
            $is_reel[$i] = $value['style'];
            $i++;
        }
        if (in_array('reel', $is_reel)) {
            return 1;
        }else
            return 0;
    }

}

?>
