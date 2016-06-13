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
 * 12/12/06 rajout de loc_vente dans select detail/period_min /max dans prix
 * 19/03/2013 rajout de ElementPrix, modification de ElementSelect/Detail/free pour en tenir compte 
 * A FAIRE MODIFICATION DE RECHERCHE POUR 19/03/2013
 * 19/03/2013 On enleve la gestion des prix par utilisateur pour l'instant
 */

/**
 * Description of ElementFactoryclass
 *
 * @author CÃ©dric
 */
class ElementFactory {

    public static function ElementPrix($id_element, $user_id,$px){
        
        //ATTENTION dans cette requete il est considéré que les grilles tarif > 2 sont privées 
//Projet ROELS a refaire avec une indication que la grille est privée
        $conn = Utilitaires::connexion();
        
                    $query2 = "   SELECT
                                    
                                    prix.montant,
                                    prix.reduction,
                                    prix_tva.tva,
                                    prix_cat.ref,
                                    prix.period_min,
                                    prix.period_max
                                    
                                FROM prix_cat
                                
                                LEFT JOIN prix
                                ON prix.id_element= ?
                                AND prix_cat.id=prix.cat_prix
                                
                                LEFT JOIN prix_tva
                                ON prix_tva.id=prix.code_tva
                                
                                LEFT JOIN prix_cat_lie
                                ON prix_cat_lie.id_cat=prix_cat.id
                                
                                WHERE prix_cat.id>0
                               

                                ORDER BY prix_cat.id ASC

                            ";

                    $stmt2 = $conn->prepare($query2);

                    if ($px == true) {//si on a besoin du prix
                        if ($stmt2) {


                            $stmt2->bind_param('i', $id_element);

                            $stmt2->execute();

                            $stmt2->store_result();

                            if ($stmt2->num_rows() != 0) {

                                $stmt2->bind_result($montant, $reduction, $tva, $cat_prix, $period_min, $period_max);
                                /*  $stmt2->bindColumn(1, $montant);
                                  $stmt2->bindColumn(2, $tva);
                                  $stmt2->bindColumn(3, $cat_prix);
                                 */
                                $ui = 0;
                                $uu = 0;
                                while ($stmt2->fetch()) {

                                    if ((is_null($period_min)) or (is_null($period_max))) {
                                        //si les periodes sont vodes, c'est une vente
                                        $tabprix_vente[$ui]['montant'] = $montant;
                                        $tabprix_vente[$ui]['reduction'] = $reduction;
                                        $tabprix_vente[$ui]['tva'] = $tva;
                                        $tabprix_vente[$ui]['cat_prix'] = $cat_prix;
                                        $ui++;
                                    } else {
                                        //c'est une location
                                        $tabprix_loc[$uu]['montant'] = $montant;
                                        $tabprix_loc[$uu]['reduction'] = $reduction;
                                        $tabprix_loc[$uu]['tva'] = $tva;
                                        $tabprix_loc[$uu]['cat_prix'] = $cat_prix;
                                        $tabprix_loc[$uu]['period_min'] = $period_min;
                                        $tabprix_loc[$uu]['period_max'] = $period_max;
                                        $uu++;
                                 
                                    }
                                }
                          
                                unset($ui, $uu);
                            }
                        }


                        $stmt2->close();
                        $conn->close();
                    }
             
                    $tabprix=  array("loc"=>$tabprix_loc,"vente"=>$tabprix_vente);
                    return $tabprix;
    }
    
    
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

    public static function ElementSelect($lang, $user_id, $cat_maitre, $limit_inf, $nbr_affichage, $px = true) {

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
                        element.loc_vente,
			
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

                $stmt->bind_result($type_lie, $id_element, $ref_element, $nom_element, $desc_element, $type_element, $ean, $loc_vente, $unite_vente, $unite_multipliant);



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


                            $stmt3->bind_result($photo_nom, $photo_id, $photo_lien);
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


                    
                    //RECHERCHE DU PRIX
                    $tabprix= self::ElementPrix($id_element, $user_id,$px);

                    
                    
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
                        $element->setPrix_vente($tabprix["vente"]);
                        $element->setPrix_loc($tabprix["loc"]);
                        $element->setLoc_vente($loc_vente);
                        // $element->setReduction($tabreduction);
                        //   $element->setCat_prix($tabcatprix);
                        //  $element->setTva($tabtva);

                        unset($tabprix["vente"]);
                        unset($tabprix["loc"]);
                        unset($tabphoto_id, $tabphoto_nom, $tabphoto_lien);
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

    public static function ElementSelectSSCat($lang, $user_id, $cat_maitre, $limit_inf, $nbr_affichage, $px = true) {

//$px si true calcul des prix, si non, juste les infos produits

        unset($_SESSION['nbr_resultat']);

        if ((!isset($limit_inf)) OR ($limit_inf < 0)) {

            $limit_inf = '0';
        }

        $limit_sup = $limit_inf + $nbr_affichage;

        $conn = Utilitaires::connexion();


        $query = "SELECT  
element.id AS id1,
element.nom_" . $lang . " AS nom1,
element.type AS type1,
element.loc_vente AS loc_vente1,
element.ref AS ref1,
element.desc_" . $lang . " AS desc1,
element.ean AS ean1,

joinel2.id AS id2,
joinel2.nom_" . $lang . " AS nom2,
joinel2.type AS type2,
joinel2.loc_vente AS loc_vente2,
joinel2.ref AS ref2,
joinel2.desc_" . $lang . " AS desc2,
joinel2.ean AS ean2,

joinel3.id AS id3,
joinel3.nom_" . $lang . " AS nom3,
joinel3.type AS type3,
joinel3.loc_vente AS loc_vente3,
joinel3.ref AS ref3,
joinel3.desc_" . $lang . " AS desc3,
joinel3.ean AS ean3,

joinel4.id AS id4,
joinel4.nom_" . $lang . " AS nom4,
joinel4.type AS type4,
joinel4.loc_vente AS loc_vente4,
joinel4.ref AS ref4,
joinel4.desc_" . $lang . " AS desc4,
joinel4.ean AS ean4,

joinel5.id AS id5,
joinel5.nom_" . $lang . " AS nom5,
joinel5.type AS type5,
joinel5.loc_vente AS loc_vente5,
joinel5.ref AS ref5,
joinel5.desc_" . $lang . " AS desc5,
joinel5.ean AS ean5,

joinel6.id AS id6,
joinel6.nom_" . $lang . " AS nom6,
joinel6.type AS type6,
joinel6.loc_vente AS loc_vente6,
joinel6.ref AS ref6,
joinel6.desc_" . $lang . " AS desc6,
joinel6.ean AS ean6,

joinel7.id AS id7,
joinel7.nom_" . $lang . " AS nom7,
joinel7.type AS type7,
joinel7.loc_vente AS loc_vente7,
joinel7.ref AS ref7,
joinel7.desc_" . $lang . " AS desc7,
joinel7.ean AS ean7,

joinel8.id AS id8,
joinel8.nom_" . $lang . " AS nom8,
joinel8.type AS type8,
joinel8.loc_vente AS loc_vente8,
joinel8.ref AS ref8,
joinel8.desc_" . $lang . " AS desc8,
joinel8.ean AS ean8,

joinel9.id AS id9,
joinel9.nom_" . $lang . " AS nom9,
joinel9.type AS type9,
joinel9.loc_vente AS loc_vente9,
joinel9.ref AS ref9,
joinel9.desc_" . $lang . " AS desc9,
joinel9.ean AS ean9,

joinel10.id AS id10,
joinel10.nom_" . $lang . " AS nom10,
joinel10.type AS type10,
joinel10.loc_vente AS loc_vente10,
joinel10.ref AS ref10,
joinel10.desc_" . $lang . " AS desc10,
joinel10.ean AS ean10

FROM element_lie 

left join element on element_lie.maitre=element.id
left join element AS joinel2 on joinel2.id=element_lie.esclave

left join element_lie AS join2 on join2.maitre=joinel2.id
left join element AS joinel3 on joinel3.id=join2.esclave

left join element_lie AS join3 on join3.maitre=joinel3.id
left join element AS joinel4 on joinel4.id=join3.esclave

left join element_lie AS join4 on join4.maitre=joinel4.id
left join element AS joinel5 on joinel5.id=join4.esclave

left join element_lie AS join5 on join5.maitre=joinel5.id
left join element AS joinel6 on joinel6.id=join5.esclave

left join element_lie AS join6 on join6.maitre=joinel6.id
left join element AS joinel7 on joinel7.id=join6.esclave

left join element_lie AS join7 on join7.maitre=joinel7.id
left join element AS joinel8 on joinel8.id=join7.esclave

left join element_lie AS join8 on join8.maitre=joinel8.id
left join element AS joinel9 on joinel9.id=join8.esclave

left join element_lie AS join9 on join9.maitre=joinel8.id
left join element AS joinel10 on joinel10.id=join9.esclave

where element_lie.maitre=?";


        $stmt = $conn->prepare($query) or die('erreur preparation' . $conn->errorInfo());

        if ($stmt) {
            $stmt->bind_param('i', $cat_maitre);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() != 0) {

                $_SESSION['nbr_resultat'] = $stmt->num_rows();

                $stmt->bind_result($id_element1, $nom_element1, $type_element1, $loc_vente1, $ref_element1, $desc_element1, $ean1, $id_element2, $nom_element2, $type_element2, $loc_vente2, $ref_element2, $desc_element2, $ean2, $id_element3, $nom_element3, $type_element3, $loc_vente3, $ref_element3, $desc_element3, $ean3, $id_element4, $nom_element4, $type_element4, $loc_vente4, $ref_element4, $desc_element4, $ean4, $id_element5, $nom_element5, $type_element5, $loc_vente5, $ref_element5, $desc_element5, $ean5, $id_element6, $nom_element6, $type_element6, $loc_vente6, $ref_element6, $desc_element6, $ean6, $id_element7, $nom_element7, $type_element7, $loc_vente7, $ref_element7, $desc_element7, $ean7, $id_element8, $nom_element8, $type_element8, $loc_vente8, $ref_element8, $desc_element8, $ean8, $id_element9, $nom_element9, $type_element9, $loc_vente9, $ref_element9, $desc_element9, $ean9, $id_element10, $nom_element10, $type_element10, $loc_vente10, $ref_element10, $desc_element10, $ean10
                );



                $i = 0;
                $i2 = 0;
                while ($stmt->fetch()) {
                    if ($type_element1 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element1;
                        $elementum[$i2]['nom_element'] = $nom_element1;
                        $elementum[$i2]['type_element'] = $type_element1;
                        $elementum[$i2]['loc_vente'] = $loc_vente1;
                        $elementum[$i2]['ref_element'] = $ref_element1;
                        $elementum[$i2]['desc_element'] = $desc_element1;
                        $elementum[$i2]['ean_element'] = $ean_element1;
                        $i2++;
                    }
                    if ($type_element2 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element2;
                        $elementum[$i2]['nom_element'] = $nom_element2;
                        $elementum[$i2]['type_element'] = $type_element2;
                        $elementum[$i2]['loc_vente'] = $loc_vente2;
                        $elementum[$i2]['ref_element'] = $ref_element2;
                        $elementum[$i2]['desc_element'] = $desc_element2;
                        $elementum[$i2]['ean_element'] = $ean_element2;
                        $i2++;
                    }
                    if ($type_element3 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element3;
                        $elementum[$i2]['nom_element'] = $nom_element3;
                        $elementum[$i2]['type_element'] = $type_element3;
                        $elementum[$i2]['loc_vente'] = $loc_vente3;
                        $elementum[$i2]['ref_element'] = $ref_element3;
                        $elementum[$i2]['desc_element'] = $desc_element3;
                        $elementum[$i2]['ean_element'] = $ean_element3;
                        $i2++;
                    }
                    if ($type_element4 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element4;
                        $elementum[$i2]['nom_element'] = $nom_element4;
                        $elementum[$i2]['type_element'] = $type_element4;
                        $elementum[$i2]['loc_vente'] = $loc_vente4;
                        $elementum[$i2]['ref_element'] = $ref_element4;
                        $elementum[$i2]['desc_element'] = $desc_element4;
                        $elementum[$i2]['ean_element'] = $ean_element4;
                        $i2++;
                    }
                    if ($type_element5 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element5;
                        $elementum[$i2]['nom_element'] = $nom_element5;
                        $elementum[$i2]['type_element'] = $type_element5;
                        $elementum[$i2]['loc_vente'] = $loc_vente5;
                        $elementum[$i2]['ref_element'] = $ref_element5;
                        $elementum[$i2]['desc_element'] = $desc_element5;
                        $elementum[$i2]['ean_element'] = $ean_element5;
                        $i2++;
                    }
                    if ($type_element6 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element6;
                        $elementum[$i2]['nom_element'] = $nom_element6;
                        $elementum[$i2]['type_element'] = $type_element6;
                        $elementum[$i2]['loc_vente'] = $loc_vente6;
                        $elementum[$i2]['ref_element'] = $ref_element6;
                        $elementum[$i2]['desc_element'] = $desc_element6;
                        $elementum[$i2]['ean_element'] = $ean_element6;
                        $i2++;
                    }
                    if ($type_element7 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element7;
                        $elementum[$i2]['nom_element'] = $nom_element7;
                        $elementum[$i2]['type_element'] = $type_element7;
                        $elementum[$i2]['loc_vente'] = $loc_vente7;
                        $elementum[$i2]['ref_element'] = $ref_element7;
                        $elementum[$i2]['desc_element'] = $desc_element7;
                        $elementum[$i2]['ean_element'] = $ean_element7;
                        $i2++;
                    }
                    if ($type_element8 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element8;
                        $elementum[$i2]['nom_element'] = $nom_element8;
                        $elementum[$i2]['type_element'] = $type_element8;
                        $elementum[$i2]['loc_vente'] = $loc_vente8;
                        $elementum[$i2]['ref_element'] = $ref_element8;
                        $elementum[$i2]['desc_element'] = $desc_element8;
                        $elementum[$i2]['ean_element'] = $ean_element8;
                        $i2++;
                    }
                    if ($type_element9 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element9;
                        $elementum[$i2]['nom_element'] = $nom_element9;
                        $elementum[$i2]['type_element'] = $type_element9;
                        $elementum[$i2]['loc_vente'] = $loc_vente9;
                        $elementum[$i2]['ref_element'] = $ref_element9;
                        $elementum[$i2]['desc_element'] = $desc_element9;
                        $elementum['ean_element'] = $ean_element9;
                        $i2++;
                    }
                    if ($type_element10 == 'art') {
                        $elementum[$i2]['id_element'] = $id_element10;
                        $elementum[$i2]['nom_element'] = $nom_element10;
                        $elementum[$i2]['type_element'] = $type_element10;
                        $elementum[$i2]['loc_vente'] = $loc_vente10;
                        $elementum[$i2]['ref_element'] = $ref_element10;
                        $elementum[$i2]['desc_element'] = $desc_element10;
                        $elementum[$i2]['ean_element'] = $ean_element10;
                        $i2++;
                    }
                }

                shuffle($elementum);

                foreach ($elementum as $key => $value) {



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

                        $stmt3->bind_param('i', $value['id_element']);

                        $stmt3->execute();

                        $stmt3->store_result();

                        if ($stmt3->num_rows() != 0) {


                            $stmt3->bind_result($photo_nom, $photo_id, $photo_lien);
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
                                    prix_cat.ref,
                                    prix.period_min,
                                    prix.period_max
                                    
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


                            $stmt2->bind_param('ii', $value['id_element'], $user_id);

                            $stmt2->execute();

                            $stmt2->store_result();

                            if ($stmt2->num_rows() != 0) {

                                $stmt2->bind_result($montant, $reduction, $tva, $cat_prix, $period_min, $period_max);
                                /*  $stmt2->bindColumn(1, $montant);
                                  $stmt2->bindColumn(2, $tva);
                                  $stmt2->bindColumn(3, $cat_prix);
                                 */
                                $ui=0;$uu=0;
                                while ($stmt2->fetch()) {

                                    if ((is_null($period_min)) or (is_null($period_max))) {
                                        //si les periodes sont vodes, c'est une vente
                                        $tabprix_vente[$ui]['montant'] = $montant;
                                        $tabprix_vente[$ui]['reduction'] = $reduction;
                                        $tabprix_vente[$ui]['tva'] = $tva;
                                        $tabprix_vente[$ui]['cat_prix'] = $cat_prix;
                                        $ui++;
                                    } else {
                                        //c'est une location
                                        $tabprix_loc[$uu]['montant'] = $montant;
                                        $tabprix_loc[$uu]['reduction'] = $reduction;
                                        $tabprix_loc[$uu]['tva'] = $tva;
                                        $tabprix_loc[$uu]['cat_prix'] = $cat_prix;
                                        $tabprix_loc[$uu]['period_min'] = $period_min;
                                        $tabprix_loc[$uu]['period_max'] = $period_max;
                                        $uu++;
                                    }
                                }
                                unset($ui, $uu);
                            }
                        }

                        $stmt2->close();
                    }

                    $element = new element();
                    $element->setId_element($value['id_element']);
                    $element->setRef_element($value['ref_element']);
                    $element->setNom_element($value['nom_element']);
                    $element->setDesc_element($value['desc_element']);
                    $element->setType_element($value['type_element']);
                    $element->setType_liaison($type_lie);
                    $element->setEan($value['ean']);
                    $element->setNom_photo($tabphoto_nom);
                    $element->setId_photo($tabphoto_id);
                    $element->setLien_photo($tabphoto_lien);
                    $element->setUnite($unite_vente);
                    $element->setMultipliant($unite_multipliant);

                    if ($px == true) {//si on a besoin du prix
                        $element->setPrix_vente($tabprix_vente);
                        $element->setPrix_loc($tabprix_loc);

                        unset($tabprix_vente,$tabprix_loc);
                    }
                    unset($tabphoto_id, $tabphoto_nom, $tabphoto_lien);
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
                        element.loc_vente,
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

                $stmt->bind_result($id_element, $ref_element, $nom_element, $desc_element, $type_element, $ean, $unite_vente, $loc_vente, $multipliant);

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


                            $stmt3->bind_result($photo_nom, $photo_id, $photo_lien);
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

                    ///////////////////////////videos

                    $query4 = "   SELECT

                                    video.nom_" . $lang . ",
                                    video.id,
                                    video.lien

                                FROM video_lie

                                LEFT JOIN video
                                ON video_lie.esclave=video.id

                                WHERE video_lie.maitre = ?
                                AND video.actif='1'

                                ORDER BY video_lie.id



		";

                    $stmt5 = $conn->prepare($query4) or die('erreur preparation' . $conn->errorInfo());

                    if ($stmt5) {

                        $stmt5->bind_param('i', $id_element);

                        $stmt5->execute();

                        $stmt5->store_result();

                        if ($stmt5->num_rows() != 0) {


                            $stmt5->bind_result($video_nom, $video_id, $video_lien);

                            /*

                              $stmt4->execute(array($id_element)) or die(print_r($conn->errorInfo()));



                              if ($stmt4->rowCount() != 0) {


                              $stmt4->bindColumn(1, $fichier_nom);
                              $stmt4->bindColumn(2, $fichier_id);
                              $stmt4->bindColumn(3, $fichier_lien);

                             */
                            while ($stmt5->fetch()) {
                                $tabvideo_nom[] = $video_nom;
                                $tabcideo_id[] = $video_id;
                                $tabvideo_lien[] = $video_lien;
                            }
                        }
                    }


                    $stmt5->close();





//RECHERCHE DU PRIX
                    $tabprix=  self::ElementPrix($id_element, $user_id, $px=true);

                    $element = new element();
                    $element->setId_element($id_element);
                    $element->setRef_element($ref_element);
                    $element->setNom_element($nom_element);
                    $element->setDesc_element($desc_element);
                    $element->setType_element($type_element);
                    $element->setPrix_vente($tabprix["vente"]);
                    $element->setPrix_loc($tabprix["loc"]);
                    //$element->setTva($tabtva);
                    //$element->setCat_prix($tabcatprix);
                    $element->setEan($ean);
                    $element->setUnite($unite_vente);
                    $element->setLoc_vente($loc_vente);
                    //$element->setPeriod_min($tabperiod_min);
                    //$element->setPeriod_max($tabperiod_max);
                    $element->setMultipliant($multipliant);
                    $element->setNom_photo($tabphoto_nom);
                    $element->setId_photo($tabphoto_id);
                    $element->setLien_photo($tabphoto_lien);
                    $element->setNom_fichier($tabfichier_nom);
                    $element->setId_fichier($tabfichier_id);
                    $element->setLien_fichier($tabfichier_lien);
                    $element->setNom_video($tabvideo_nom);
                    $element->setId_video($tabvideo_id);
                    $element->setLien_video($tabvideo_lien);

                    $element->setGroupe_Sorte($tabgroupe_sorte);
                    $element->setGroupe_nom($tabgroupe_nom);
                    $element->setGroupe_id($tabgroupe_id);
                    $element->setListe_id($tabliste_id);
                    $element->setListe_nom($tabliste_nom);
                    $element->setListe_valeur($tabliste_valeur);





                    unset($tabprix_vente);
                    unset($tabprix_loc);
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
//    if(($i>=$limit_inf)AND ($i<$limit_sup)) {
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
                        element.style,
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

            $resultat = $stmt->execute();
 
            $stmt->store_result();
          
            if ($stmt->num_rows() != 0) {

                $stmt->bind_result($id_element, $ref_element, $nom_element, $desc_element, $type_element,$style, $ean, $poids, $transp_spec, $photo_nom, $id_photo, $photo_lien, $unite_vente, $multipliant);

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
//recherche du prix
                    $tabprix=  self::ElementPrix($id_element, $user_id, $px=true);
                    
                    $element = new element();
                    $element->setId_element($id_element);
                    $element->setRef_element($ref_element);
                    $element->setNom_element($nom_element);
                    $element->setDesc_element($desc_element);
                    $element->setType_element($type_element);
                    $element->setStyle($style);
                    $element->setPrix_vente($tabprix["vente"]);
                    $element->setPrix_loc($tabprix["loc"]);
                    // $element->setTva($tabtva);
                    // $element->setCat_prix($tabcatprix);
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

                $query = "SELECT 	element.id,
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
                        prix_cat.ref,
                        prix.period_min,
                        prix.period_max

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
                            $i=0;$u=0;
                            while ($data2 = mysql_fetch_array($result2)) {

                                
                                //CECI DOIT DISPARAITRE POUR UTILISER ELEMENTPRIX (cela ne marche sans douites pas sans le faire
                                    if ((is_null($period_min)) or (is_null($period_max))) {
                                        //si les periodes sont vodes, c'est une vente
                                        $tabprix_vente[$i]['montant'] = $montant;
                                        $tabprix_vente[$i]['reduction'] = $reduction;
                                        $tabprix_vente[$i]['tva'] = $tva;
                                        $tabprix_vente[$i]['cat_prix'] = $cat_prix;
                                        $i++;
                                    } else {
                                        //c'est une location
                                        $tabprix_loc[$u]['montant'] = $montant;
                                        $tabprix_loc[$u]['reduction'] = $reduction;
                                        $tabprix_loc[$u]['tva'] = $tva;
                                        $tabprix_loc[$u]['cat_prix'] = $cat_prix;
                                        $tabprix_loc[$u]['period_min'] = $period_min;
                                        $tabprix_loc[$u]['period_max'] = $period_max;
                                        $u++;
                                    }
                                }
                                unset($i, $u);

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
