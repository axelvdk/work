<?php

/*
 * 28/11/2011 remise en place de Element nouveauté
 * 28/11/2011 remise en place de Element Select detail
 * 10/05/2011 rajout des unite vente dans selectdetail
 * 11/5/2011 rajout des fichiers dans elementselectdetail
 * 26/7/11 rajout de la tva dans elementselect et elementselectdetail selectelement free
 * 26/7/2011 reconciliation avec le projet roels, on repasse en mysqli pour quitter dbo trop lent
 * 12/8/2011 rajout de transp_spec dans selest element free
 * 22/9 corection dans element nouveauté   bindParam devient:$stmt->bind_param('si', $type, $limit);
 * 23/9/11 correctif dans element recherche bug
 * 19/10/11 rajout type liaison dans query select
 * 20/10/11 rajout de mulmtipliant dans requet select free
 * 21/2/2012 modification dans recherche vesr $element->setLien_photo(array($data['lien'])); venant de sans le tableau
 * 29/2/2012 modification pour l'ordre des photos dans elementselect et elementselectdetail attention sql a jour 120229
 */

/**
 * Description of ElementFactoryclass
 *
 * @author CÃ©dric
 */
class ElementFactory {

    public static function ElementNouveaute($lang, $type, $limit, $option, $limit) {


        $conn = Utilitaires::connexion();

        $query = "SELECT    element.id,
                            element.ref,
                            element.desc_" . $lang . ",
                            element.ean,
                            element.nom_" . $lang . ",
                            photo.id,
                            photo.lien
		FROM element
                
		LEFT JOIN photo_lie
		On photo_lie.maitre=element.id
                
		LEFT JOIN photo
		ON photo_lie.esclave=photo.id

		WHERE element.type= ?
		AND element.actif='1'
		AND element.archive='0'
		AND photo_lie.esclave != 'NULL'
		AND photo.lien != 'NULL'
                " . $option . "

		ORDER BY element.id DESC, photo.ordre DESC
                LIMIT ? ";


        $stmt = $conn->prepare($query) or die('erreur preparation' . $conn->errorInfo());

        if ($stmt) {


//$stmt->execute(array($type)) or die(print_r($conn->errorInfo()));
            $stmt->bind_param('si', $type, $limit);
            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() != 0) {
//if ($stmt->rowCount() != 0) {

                $stmt->bind_result($id_element, $ref_element, $desc_element, $ean_element, $nom_element, $id_photo, $lien_photo);

                /*    $stmt->bindColumn(1, $id_element);
                  $stmt->bindColumn(2, $ref_element);
                  $stmt->bindColumn(3, $desc_element);
                  $stmt->bindColumn(4, $ean_element);
                  $stmt->bindColumn(5, $nom_element);
                  $stmt->bindColumn(6, $id_photo);
                  $stmt->bindColumn(7, $lien_photo); */

                while ($stmt->fetch()) {

                    $element = new element();
                    $element->setId_element($id_element);
                    $element->setRef_element($ref_element);
                    $element->setDesc_element($desc_element);
                    $element->setEan($ean_element);
                    $element->setNom_element($nom_element);
                    $element->setId_photo($id_photo);
                    $element->setLien_photo($lien_photo);

//on crée un tableau d'objet
                    $elements[] = $element;
                }
//on melange le tableau
                shuffle($elements);

                return $elements;



                $stmt->close();
                $conn->close();
            }
        }
    }

    public static function ElementSelect($lang, $user_id, $cat_maitre, $limit_inf, $nbr_affichage, $px=true) {

//$px si true calcul des prix, si non, juste les infos produits

        unset($_SESSION['nbr_resultat']);

        if ((!isset($limit_inf)) OR ($limit_inf < 0)) {

            $limit_inf = '0';
        }

        $limit_sup = $limit_inf + $nbr_affichage;

        $conn = Utilitaires::connexion();

        $query = "SELECT
                        element_lie.type,
			element.id,
			element.ref,
			element.nom_" . $lang . ",
			element.desc_" . $lang . ",
			element.type,
                        element.ean,
			
                        element_unite_vente.unite_" . $lang . ",
                        element_unite_vente.multipliant
                      

		FROM element_lie

		LEFT JOIN element
		ON element_lie.esclave = element.id

		LEFT JOIN element_ordre
		ON element_lie.esclave = element_ordre.esclave
		AND element_lie.maitre = element_ordre.maitre

		LEFT JOIN element_secure
		ON element.id = element_secure.id_element

		LEFT JOIN photo_lie
		ON photo_lie.maitre = element.id

		LEFT JOIN photo
		ON photo.id = photo_lie.esclave

                LEFT JOIN element_unite_vente
                ON element_unite_vente.id=element.unite_vente
                
		LEFT JOIN client
		ON client.id = ?

		WHERE element_lie.maitre = ?
		AND element.archive = '0'
		AND element.actif='1'
		AND element.visible_" . $lang . " = '1'
		AND (element_secure.id_user = ? OR element_secure.id_element IS NULL)


		GROUP BY element.id
                ORDER BY element.type ASC, element_ordre.ordre ASC


		";


        $stmt = $conn->prepare($query) or die('erreur preparation' . $conn->errorInfo());

        if ($stmt) {
            $stmt->bind_param('iii', $user_id, $cat_maitre, $user_id);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() != 0) {
               
                $_SESSION['nbr_resultat'] = $stmt->num_rows();

                $stmt->bind_result($type_lie,$id_element, $ref_element, $nom_element, $desc_element, $type_element, $ean, $unite_vente, $unite_multipliant);


          
                $i = 0;

                while ($stmt->fetch()) {

                    //////////////////  PHOTOS


                    $query3 = "   SELECT

                                    photo.nom_" . $lang . ",
                                    photo.id,
                                    photo.lien

                                FROM photo_lie

                                LEFT JOIN photo
                                ON photo_lie.esclave=photo.id

                                WHERE photo_lie.maitre = ?
                                AND photo.actif='1'

                                ORDER BY photo_lie.ordre ASC



		";

                    $stmt3 = $conn->prepare($query3) or die('erreur preparation' . $conn->errorInfo());

                    if ($stmt3) {

                         $stmt3->bind_param('i', $id_element);

            $stmt3->execute();

            $stmt3->store_result();

            if ($stmt3->num_rows() != 0) {
                

                $stmt3->bind_result($photo_nom,$photo_id,$photo_lien);
////////////////////////
                   //     $stmt3->execute(array($id_element)) or die(print_r($conn->errorInfo()));



                    /*   if ($stmt3->rowCount() != 0) {


                            $stmt3->bindColumn(1, $photo_nom);
                            $stmt3->bindColumn(2, $photo_id);
                            $stmt3->bindColumn(3, $photo_lien);

*/
                            while ($stmt3->fetch()) {
                                $tabphoto_nom[] = $photo_nom;
                                $tabphoto_id[] = $photo_id;
                                $tabphoto_lien[] = $photo_lien;
                            }
                        }
                    }


                    $stmt3->close();

//ATTENTION dans cette requete il est considéré que les grilles tarif > 2 sont privées 
//Projet ROELS a refaire avec une indication que la grille est privée

                    $query2 = "   SELECT
                                    
                                    prix.montant,
                                    prix.reduction,
                                    prix_tva.tva,
                                    prix_cat.ref
                                    
                                FROM prix_cat
                                
                                LEFT JOIN prix
                                ON prix.id_element= ?
                                AND prix_cat.id=prix.cat_prix
                                
                                LEFT JOIN prix_tva
                                ON prix_tva.id=prix.code_tva
                                
                                LEFT JOIN prix_cat_lie
                                ON prix_cat_lie.id_cat=prix_cat.id
                                
                                WHERE prix_cat.id>0
                                AND (prix_cat_lie.id_client=? OR prix_cat.id<=2)

                                ORDER BY prix_cat.id ASC

                            ";

                    $stmt2 = $conn->prepare($query2);

                    if ($px == true) {//si on a besoin du prix
                        if ($stmt2) {


                            $stmt2->bind_param('ii', $id_element, $user_id);

                            $stmt2->execute();

                            $stmt2->store_result();

                            if ($stmt2->num_rows() != 0) {

                                $stmt2->bind_result($montant, $reduction, $tva, $cat_prix);
                                /*  $stmt2->bindColumn(1, $montant);
                                  $stmt2->bindColumn(2, $tva);
                                  $stmt2->bindColumn(3, $cat_prix);
                                 */

                                while ($stmt2->fetch()) {
                                    $tabmontant[] = $montant;
                                    $tabreduction[] = $reduction;
                                    $tabtva[] = $tva;
                                    $tabcatprix[] = $cat_prix;
                                }
                            }
                        }


                        $stmt2->close();
                    }

                    $element = new element();
                    $element->setId_element($id_element);
                    $element->setRef_element($ref_element);
                    $element->setNom_element($nom_element);
                    $element->setDesc_element($desc_element);
                    $element->setType_element($type_element);
                    $element->setType_liaison($type_lie);
                    $element->setEan($ean);
                    $element->setNom_photo($tabphoto_nom);
                    $element->setId_photo($tabphoto_id);
                    $element->setLien_photo($tabphoto_lien);
                    $element->setUnite($unite_vente);
                    $element->setMultipliant($unite_multipliant);
                    
                    if ($px == true) {//si on a besoin du prix
                        $element->setPrix($tabmontant);
                        $element->setReduction($tabreduction);
                        $element->setCat_prix($tabcatprix);
                        $element->setTva($tabtva);

                        unset($tabmontant);
                        unset($tabcatprix);
                        unset($tabtva);
                        unset($tabreduction);
                        unset($tabphoto_id,$tabphoto_nom,$tabphoto_lien);
                    }

//on crée un tableau d'objet si on est dans les limites

                    if (($i >= $limit_inf) AND ($i < $limit_sup)) {
                        $elements[] = $element;
                    }

                    $i++;
                }

                $stmt->close();
                $conn->close();
            }
        }

        return $elements;
    }

    public static function ElementSelectDetail($lang, $user_id, $id_element, $limit_inf, $nbr_affichage) {

        unset($_SESSION['nbr_resultat']);

        if ((!isset($limit_inf)) OR ($limit_inf < 0)) {

            $limit_inf = '0';
        }

        $limit_sup = $limit_inf + $nbr_affichage;

        $conn = Utilitaires::connexion();

        $query = "SELECT
			element.id,
			element.ref,
			element.nom_" . $lang . ",
			element.desc_" . $lang . ",
			element.type,
                        element.ean,
                        element_unite_vente.unite_" . $lang . ",
                        element_unite_vente.multipliant
                       

		FROM element_lie  
										
		LEFT JOIN element 
		ON element_lie.esclave = element.id  
		
		LEFT JOIN element_ordre
		ON element_lie.esclave = element_ordre.esclave
		AND element_lie.maitre = element_ordre.maitre
										
		LEFT JOIN element_secure
		ON element.id = element_secure.id_element 
	
		LEFT JOIN photo_lie
		ON photo_lie.maitre = element.id
										
		LEFT JOIN photo
		ON photo.id = photo_lie.esclave
	
        
		LEFT JOIN client
		ON client.id = ?

                LEFT JOIN element_unite_vente
                ON element_unite_vente.id=element.unite_vente
										
		WHERE element.id = ?
		AND element.archive = '0'
		AND element.actif='1'
		AND element.visible_" . $lang . " = '1'
		AND (element_secure.id_user = ? OR element_secure.id_element IS NULL)

                
		GROUP BY element.id
                ORDER BY element.type ASC, element_ordre.ordre ASC

               
		";


        $stmt = $conn->prepare($query) or die('erreur preparation' . $conn->errorInfo());

        if ($stmt) {

             $stmt->bind_param('iii', $user_id, $id_element, $user_id);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() != 0) {
                $_SESSION['nbr_resultat'] = $stmt->num_rows();

                $stmt->bind_result($id_element,$ref_element,$nom_element,$desc_element,$type_element,$ean,$unite_vente,$multipliant);

                /*
            $stmt->execute(array($user_id, $id_element, $user_id)) or die(print_r($conn->errorInfo()));



            if ($stmt->rowCount() != 0) {


                $stmt->bindColumn(1, $id_element);
                $stmt->bindColumn(2, $ref_element);
                $stmt->bindColumn(3, $nom_element);
                $stmt->bindColumn(4, $desc_element);
                $stmt->bindColumn(5, $type_element);
                $stmt->bindColumn(6, $ean);
                $stmt->bindColumn(7, $photo_nom);
                $stmt->bindColumn(8, $id_photo);
                $stmt->bindColumn(9, $photo_lien);
                $stmt->bindColumn(10, $unite_vente);




//     $stmt->bind_result($id_element,$ref_element,$nom_element,$desc_element,$type_element,$ean, $photo_nom,$id_photo,$photo_lien);

*/
                
                $i = 0;

                while ($stmt->fetch()) {

//////////////////  PHOTOS


                    $query3 = "   SELECT

                                    photo.nom_" . $lang . ",
                                    photo.id,
                                    photo.lien

                                FROM photo_lie

                                LEFT JOIN photo
                                ON photo_lie.esclave=photo.id

                                WHERE photo_lie.maitre = ?
                                AND photo.actif='1'

                                ORDER BY photo_lie.ordre ASC



		";

                    $stmt3 = $conn->prepare($query3) or die('erreur preparation' . $conn->errorInfo());

                    if ($stmt3) {

                         $stmt3->bind_param('i', $id_element);

            $stmt3->execute();

            $stmt3->store_result();

            if ($stmt3->num_rows() != 0) {
                

                $stmt3->bind_result($photo_nom,$photo_id,$photo_lien);
////////////////////////
                   //     $stmt3->execute(array($id_element)) or die(print_r($conn->errorInfo()));



                    /*   if ($stmt3->rowCount() != 0) {


                            $stmt3->bindColumn(1, $photo_nom);
                            $stmt3->bindColumn(2, $photo_id);
                            $stmt3->bindColumn(3, $photo_lien);

*/
                            while ($stmt3->fetch()) {
                                $tabphoto_nom[] = $photo_nom;
                                $tabphoto_id[] = $photo_id;
                                $tabphoto_lien[] = $photo_lien;
                            }
                        }
                    }


                    $stmt3->close();
////////////////////////////options
//
                    $query5 = "SELECT
                    option_groupe.sorte,
                    option_groupe.nom_" . $lang . ",
                    option_groupe.groupe,
                    option_liste.id,
                    option_liste.nom_" . $lang . ",
                    option_lie.valeur

                from option_groupe

                LEFT JOIN option_liste
                ON option_groupe.type=option_liste.type
                AND option_groupe.groupe=option_liste.groupe

                LEFT JOIN option_lie ON option_lie.groupe=option_groupe.groupe
                AND option_lie.id_maitre= ?

                WHERE option_groupe.type='element'
                    ORDER BY option_groupe.groupe, option_liste.id
                    ";



                    $stmt5 = $conn->prepare($query5) or die('erreur preparation' . $conn->errorInfo());

                    if ($stmt5) {

 $stmt5->bind_param('i', $id_element);

            $stmt5->execute();

            $stmt5->store_result();

            if ($stmt5->num_rows() != 0) {
                

                $stmt5->bind_result($groupe_sorte, $groupe_nom, $groupe_id, $liste_id, $liste_nom, $liste_valeur);
                
                /*
                        $stmt5->execute(array($id_element)) or die(print_r($conn->errorInfo()));



                        if ($stmt5->rowCount() != 0) {

                            $stmt5->bindColumn(1, $groupe_sorte);
                            $stmt5->bindColumn(2, $groupe_nom);
                            $stmt5->bindColumn(3, $groupe_id);
                            $stmt5->bindColumn(4, $liste_id);
                            $stmt5->bindColumn(5, $liste_nom);
                            $stmt5->bindColumn(6, $liste_valeur);

*/
                            while ($stmt5->fetch()) {
                                $tabgroupe_sorte[] = $groupe_sorte;
                                $tabgroupe_nom[] = $groupe_nom;
                                $tabgroupe_id[] = $groupe_id;
                                $tabliste_id[] = $liste_id;
                                $tabliste_nom[] = $liste_nom;
                                $tabliste_valeur[] = $liste_valeur;
                            }
                        }
                    }


                    $stmt5->close();
///////////////////////////fichiers

                    $query4 = "   SELECT

                                    fichier.nom_" . $lang . ",
                                    fichier.id,
                                    fichier.lien

                                FROM fichier_lie

                                LEFT JOIN fichier
                                ON fichier_lie.esclave=fichier.id

                                WHERE fichier_lie.maitre = ?
                                AND fichier.actif='1'

                                ORDER BY fichier_lie.id



		";

                    $stmt4 = $conn->prepare($query4) or die('erreur preparation' . $conn->errorInfo());

                    if ($stmt4) {

                         $stmt4->bind_param('i', $id_element);

            $stmt4->execute();

            $stmt4->store_result();

            if ($stmt4->num_rows() != 0) {
                

                $stmt4->bind_result($fichier_nom, $fichier_id, $fichier_lien);
                
                /*

                        $stmt4->execute(array($id_element)) or die(print_r($conn->errorInfo()));



                        if ($stmt4->rowCount() != 0) {


                            $stmt4->bindColumn(1, $fichier_nom);
                            $stmt4->bindColumn(2, $fichier_id);
                            $stmt4->bindColumn(3, $fichier_lien);

*/
                            while ($stmt4->fetch()) {
                                $tabfichier_nom[] = $fichier_nom;
                                $tabfichier_id[] = $fichier_id;
                                $tabfichier_lien[] = $fichier_lien;
                            }
                        }
                    }


                    $stmt4->close();
////////////////// MONTANT


                    $query2 = "   SELECT
                                    
                                    prix.montant,
                                    prix_tva.tva,
                                    prix_cat.ref
                                    
                                FROM prix_cat
                                
                                LEFT JOIN prix
                                ON prix.id_element= ?
                                AND prix_cat.id=prix.cat_prix
                                
                                LEFT JOIN prix_tva
                                ON prix_tva.id=prix.code_tva
                                WHERE prix_cat.id>0

                                ORDER BY prix_cat.id



		";

                    $stmt2 = $conn->prepare($query2) or die('erreur preparation' . $conn->errorInfo());

                    if ($stmt2) {

 $stmt2->bind_param('i', $id_element);

            $stmt2->execute();

            $stmt2->store_result();

            if ($stmt2->num_rows() != 0) {
                

                $stmt2->bind_result($montant, $tva, $cat_prix);
                /*
                        $stmt2->execute(array($id_element)) or die(print_r($conn->errorInfo()));



                        if ($stmt2->rowCount() != 0) {


                            $stmt2->bindColumn(1, $montant);
                            $stmt2->bindColumn(2, $tva);
                            $stmt2->bindColumn(3, $cat_prix);



*/

                            while ($stmt2->fetch()) {
                                $tabmontant[] = $montant;
                                $tabtva[] = $tva;
                                $tabcatprix[] = $cat_prix;
                            }
                        }
                    }


                    $stmt2->close();

/////////////////

                    $element = new element();
                    $element->setId_element($id_element);
                    $element->setRef_element($ref_element);
                    $element->setNom_element($nom_element);
                    $element->setDesc_element($desc_element);
                    $element->setType_element($type_element);
                    $element->setPrix($tabmontant);
                    $element->setTva($tabtva);
                    $element->setCat_prix($tabcatprix);
                    $element->setEan($ean);
                    $element->setUnite($unite_vente);
                    $element->setMultipliant($multipliant);
                    $element->setNom_photo($tabphoto_nom);
                    $element->setId_photo($tabphoto_id);
                    $element->setLien_photo($tabphoto_lien);
                    $element->setNom_fichier($tabfichier_nom);
                    $element->setId_fichier($tabfichier_id);
                    $element->setLien_fichier($tabfichier_lien);

                    $element->setGroupe_Sorte($tabgroupe_sorte);
                    $element->setGroupe_nom($tabgroupe_nom);
                    $element->setGroupe_id($tabgroupe_id);
                    $element->setListe_id($tabliste_id);
                    $element->setListe_nom($tabliste_nom);
                    $element->setListe_valeur($tabliste_valeur);





                    unset($tabmontant);
                    unset($tabtva);
                    unset($tabcatprix);
                    unset($tabphoto_id);
                    unset($tabphoto_nom);
                    unset($tabphoto_lien);
                    unset($tabfichier_id);
                    unset($tabfichier_nom);
                    unset($tabfichier_lien);

                    unset($tabgroupe_sorte);
                    unset($tabgroupe_nom);
                    unset($tabgroupe_id);
                    unset($tabliste_id);
                    unset($tabliste_nom);
                    unset($tabliste_valeur);
//on crée un tableau d'objet si on est dans les limites
//     if(($i>=$limit_inf)AND ($i<$limit_sup)) {
//        $elements[]=$element;
// }
                    $i++;
                }



                $stmt->close();
            }
        }
//on melange le tableau
//shuffle ($elements);

        return $element;
    }

    public static function ElementSelectFREE($lang, $user_id, $request_where) {





        $conn = Utilitaires::connexion();

        $query = "SELECT
			element.id,
			element.ref,
			element.nom_" . $lang . ",
			element.desc_" . $lang . ",
			element.type,
                        element.ean,
                        element.poids,
                        element.transp_spec,
			photo.nom_" . $lang . ",
                        photo.id,
			photo.lien,
                        element_unite_vente.unite_" . $lang . ",
                        element_unite_vente.multipliant

		FROM element

                LEFT JOIN element_unite_vente
                ON element_unite_vente.id=element.unite_vente
		
		LEFT JOIN element_secure
		ON element.id = element_secure.id_element

		LEFT JOIN photo_lie
		ON photo_lie.maitre = element.id

		LEFT JOIN photo
		ON photo.id = photo_lie.esclave

		LEFT JOIN client
		ON client.id = ?

		WHERE $request_where


		GROUP BY element.id
                ORDER BY element.type ASC


		";



        $stmt = $conn->prepare($query);

        if ($stmt) {

             $stmt->bind_param('i', $user_id);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() != 0) {
                

                $stmt->bind_result($id_element,$ref_element,$nom_element,$desc_element,$type_element,$ean,$poids,$transp_spec,$photo_nom,$id_photo,$photo_lien,$unite_vente,$multipliant);

                
                /*
            $stmt->execute(array($user_id));



            if ($stmt->rowCount() != 0) {

//$stmt->bind_result($id_element,$ref_element,$nom_element,$desc_element,$type_element,$ean,$poids, $photo_nom,$id_photo,$photo_lien);

                $stmt->bindColumn(1, $id_element);
                $stmt->bindColumn(2, $ref_element);
                $stmt->bindColumn(3, $nom_element);
                $stmt->bindColumn(4, $desc_element);
                $stmt->bindColumn(5, $type_element);
                $stmt->bindColumn(6, $ean);
                $stmt->bindColumn(7, $poids);
                $stmt->bindColumn(8, $photo_nom);
                $stmt->bindColumn(9, $id_photo);
                $stmt->bindColumn(10, $photo_lien);
                $stmt->bindColumn(11, $unite_vente);
*/
                $i = 0;

                while ($stmt->fetch()) {


//////////////////

                    $query2 = "   SELECT
                                    
                                    prix.montant,
                                    prix_tva.tva,
                                    prix_cat.ref
                                    
                                FROM prix_cat
                                
                                LEFT JOIN prix
                                ON prix.id_element= ?
                                AND prix_cat.id=prix.cat_prix
                                
                                LEFT JOIN prix_tva
                                ON prix_tva.id=prix.code_tva
                                WHERE prix_cat.id>0

                                ORDER BY prix_cat.id



		";


                    $stmt2 = $conn->prepare($query2);

                    if ($stmt2) {
                        
                         $stmt2->bind_param('i', $id_element);

            $stmt2->execute();

            $stmt2->store_result();

            if ($stmt2->num_rows() != 0) {
                

                $stmt2->bind_result($montant,$tva, $cat_prix);
                
                /*
// $stmt2->bind_param('i',$id_element);

                        $stmt2->execute(array($id_element));



                        if ($stmt2->rowCount() != 0) {


//      $stmt2->bind_result($montant,$cat_prix);
                            $stmt2->bindColumn(1, $montant);
                            $stmt2->bindColumn(2, $tva);
                            $stmt2->bindColumn(3, $cat_prix);
*/

                            while ($stmt2->fetch()) {
                                $tabmontant[] = $montant;
                                $tabtva[] = $tva;
                                $tabcatprix[] = $cat_prix;
                            }
                        }
                    }


                    $stmt2->close();

/////////////////

                    $element = new element();
                    $element->setId_element($id_element);
                    $element->setRef_element($ref_element);
                    $element->setNom_element($nom_element);
                    $element->setDesc_element($desc_element);
                    $element->setType_element($type_element);
                    $element->setPrix($tabmontant);
                    $element->setTva($tabtva);
                    $element->setCat_prix($tabcatprix);
                    $element->setEan($ean);
                    $element->setPoids($poids);
                    $element->setTransp_spec($transp_spec);
                    $element->setNom_photo($nom_photo);
                    $element->setId_photo($id_photo);
                    $element->setLien_photo(array($photo_lien));
                    $element->setUnite($unite_vente);
                    $element->setMultipliant($multipliant);

                    unset($tabmontant);
                    unset($tabcatprix);
                    unset($tabtva);
//on crée un tableau d'objet si on est dans les limites


                    $elements[] = $element;
                }



                $stmt->close();
            }
        }

        
        return $elements;
    }

    public static function ElementRecherche($lang, $string, $operateur, $user_id, $cat_maitre, $limit_inf, $nbr_affichage) {

        unset($_SESSION['nbr_resultat']);

        if ((!isset($limit_inf)) OR ($limit_inf < 0)) {

            $limit_inf = '0';
        }

        $limit_sup = $limit_inf + $nbr_affichage;

        if (!isset($debut))
            $debut = 0;
        if (!isset($limit))
            $limit = 1000;
        if (empty($string)) {
            $noresult = 1;
        } elseif (!empty($string)) {
            $recherche = strtolower($string);                //on passe en minuscule
            $mots = str_replace("+", " ", trim($recherche));  //on remplace les + par des espaces
            $mots = str_replace("\"", " ", $mots);            //idem pour \
            $mots = str_replace(",", " ", $mots);            //idem pour ,
            $mots = str_replace(":", " ", $mots);            //idem pour :
            $recherche = rawurlencode($mots);              //on encode la recherche

            $tab = explode(" ", $mots);
            $nb = count($tab);

            if ($noresult != 1) {

                include './connect.php';

                $query= "SELECT 	element.id,
				element.ref,
				element.nom_" . $lang . " AS element_nom,
				element.desc_" . $lang . " AS element_desc,
				element.visible_" . $lang . ",
				element.actif,
                                element.type,
                                element.ean,
                                photo.nom_" . $lang . " AS photo_nom,
                                photo.id AS photo_id,
                                photo.lien

				FROM element

                                                             

                                LEFT JOIN element_secure
                                ON element.id = element_secure.id_element

                                LEFT JOIN photo_lie
                                ON photo_lie.maitre = element.id

                                LEFT JOIN photo
                                ON photo.id = photo_lie.esclave

                                LEFT JOIN client
                                ON client.id = $user_id
								

				WHERE  element.type='art'

				AND	element.archive = '0'

				AND
				(
										
					element.actif='1'
					AND element.visible_" . $lang . " = '1'
										
				)

				AND
				(
					element.nom_" . $lang . " LIKE '%" . $tab[0] . "%'
					OR element.ref LIKE '%" . $tab[0] . "%'
					OR element.desc_" . $lang . " LIKE '%" . $tab[0] . "%'
				)

                                ";




                for ($i = 1; $i < $nb; $i++) {
                    $query.="$operateur 	(
						element.nom_" . $lang . " LIKE '%" . $tab[$i] . "%'
						OR element.ref LIKE '%" . $tab[$i] . "%'
						OR element.desc_" . $lang . " LIKE '%" . $tab[$i] . "%'
												)
						";
                }

                $query.=" GROUP BY element.id

			ORDER BY element.nom_" . $lang . " Limit $debut,$limit ";   // requête limitante.



                $result = mysql_query($query) or die(mysql_errno());


                if (mysql_num_rows($result) > 0) {
                    $_SESSION['nbr_resultat'] = mysql_num_rows($result);
                    $i = 0;



                    while ($data = mysql_fetch_array($result)) {

                        $query2 = "SELECT
			prix.montant,
                        prix_cat.ref

		FROM prix

                LEFT JOIN prix_cat
                ON prix_cat.id=prix.cat_prix

                LEFT JOIN prix_cat_lie
                ON prix_cat_lie.id_cat=prix_cat.id
		WHERE id_element = '" . $data['id'] . "'
AND (prix_cat_lie.id_client='" . $user_id . "' OR prix_cat.id<=2)
                ORDER BY prix_cat.id



		";

                        $result2 = mysql_query($query2);

                        if (mysql_num_rows($result2) > 0) {

                            while ($data2 = mysql_fetch_array($result2)) {

                                $tabmontant[] = $data2['montant'];
                                $tabcatprix[] = $data2['cat_prix'];
                            }

                            $element = new element();
                            $element->setId_element($data['id']);
                            $element->setRef_element($data['ref']);
                            $element->setNom_element($data['element_nom']);
                            $element->setDesc_element($data['element_desc']);
                            $element->setPrix($tabmontant);
                            $element->setCat_prix($tabcatprix);
                            $element->setEan($data['ean']);
                            $element->setUnite($data['unite']);
                            $element->setNom_photo($data['photo_nom']);
                            $element->setId_photo($data['photo_id']);
                            $element->setLien_photo(array($data['lien']));

                            unset($tabmontant);
                            unset($tabcatprix);
//on crée un tableau d'objet si on est dans les limites

                            if (($i >= $limit_inf) AND ($i < $limit_sup)) {
                                $elements[] = $element;
                            }
                            $i++;
                        }
                    }
                    mysql_close();
                }
            }



            return $elements;
        }
    }

}

?>
