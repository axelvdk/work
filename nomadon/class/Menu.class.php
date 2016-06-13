<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author cedric
 */
class Menu {

    public static function Menu_arbre1($cat, $defaut, $lang, $site, $profondeur=10) {

        $profondeur = 10; //a cause du bind_result, pas de solution pour regler la taille
        //$defaut numero de la categorie de depart,
        //$lang langue de l'utilisateur
        //$profondeur $profondeur de la requete sql
        //
        //
        //menu utilisé nomadon

        GLOBAL $site;
        GLOBAL $lang;
        GLOBAL $menu;
        GLOBAL $array_nom;
        GLOBAL $array_type;
        GLOBAL $array_lien;
        GLOBAL $array_defaut;

        function boucle($val) {
            GLOBAL $site;
            GLOBAL $lang;


            GLOBAL $menu;
            GLOBAL $array_nom;
            GLOBAL $array_type;
            GLOBAL $array_lien;
            GLOBAL $array_defaut;
            $u = 0;
            $ul = 0;

            if (!is_null($val)) {


                foreach ($val as $id_cat => $tab) {


                    if (is_numeric($id_cat)) {
                        if ($u == 0) {
                            $menu .='<ul>';
                            $ul = 1;
                        }
                        
                        if($array_type[$id_cat]=='cat'){
                           
                        
                        $menu .='<li>';
                        //   $menu .='<a href="' . $lang . '-pg2,cat1-' . $site . ',cat.html" title="">' . $array_det[$id_cat] . $id_cat . '</a>';
                        $menu .='<a href="' . $lang . '-pg2,cat' . $id_cat . '-' . $site . ',' . $array_lien[$id_cat] . '.html" '.$array_defaut[$id_cat].' title="' . $array_lien[$id_cat] . '">' . $array_nom[$id_cat] .'</a>';

                        boucle($tab);
                        $menu .='</li>';
                        
                        }
                        if($array_type[$id_cat]=='art'){
                           
                        
                        $menu .='<li>';
                        //   $menu .='<a href="' . $lang . '-pg2,cat1-' . $site . ',cat.html" title="">' . $array_det[$id_cat] . $id_cat . '</a>';
                        $menu .='<a href="' . $lang . '-pg21,cat' . $id_cat . '-' . $site . ',' . $array_lien[$id_cat] . '.html" '.$array_defaut[$id_cat].' title="' . $array_lien[$id_cat] . '">' . $array_nom[$id_cat] .'</a>';

                        boucle($tab);
                        $menu .='</li>';
                        
                        }
}
                        $u++;
                    
                }
            }
            if ($ul == 1) {
                $menu .='</ul>';
            }

            return $tab;
        }

        $conn = Utilitaires::connexion();

        $query = "SELECT 
            element.id,
            element.nom_" . $lang . ",
            element.type,";

        for ($index = 2; $index < $profondeur + 1; $index++) {
            $query .= "
            
            joinel" . $index . ".id,
            joinel" . $index . ".nom_" . $lang . ",
            joinel" . $index . ".type";

            if ($index < $profondeur)
                $query .= ",";
        }

        $query .= " FROM `element`";



        $query .=" LEFT JOIN element_lie AS join1
                  ON (join1.esclave=element.id and element.type='cat' AND element.archive='0' and element.visible_" . $lang . "='1' AND element.actif='1')";


        for ($index = 2; $index < $profondeur + 1; $index++) {
            $indexm = $index - 1;


            $query .= " LEFT JOIN element_lie AS join" . $index . "
                       ON join" . $index . ".maitre=join" . $indexm . ".esclave  AND join" . $index . ".type is null

                       LEFT JOIN element AS joinel" . $index . "
                       ON (join" . $index . ".esclave=joinel" . $index . ".id AND  joinel" . $index . ".archive='0' AND joinel" . $index . ".visible_" . $lang . "='1' AND joinel" . $index . ".actif='1')";
        }


        $query .=" WHERE join1.maitre='" . $cat . "' ";


        $stmt = $conn->prepare($query) or die($stmt->$error);

        if ($stmt) {

            $stmt->execute() or die($stmt->$error);
        }

        $stmt->store_result();
        $i = 0;

        //on prepare le bind_result en tenant compte de la profondeur

        for ($index1 = 0; $index1 < $profondeur; $index1++) {

            $nom_id = 'id' . $index1;
            $nom_nom = 'nom' . $index1;
            $nom_type = 'type' . $index1;
        }

        if ($stmt->num_rows() != 0) {
            $stmt->bind_result($id1, $nom1, $type1, $id2, $nom2, $type2, $id3, $nom3, $type3, $id4, $nom4, $type4, $id5, $nom5, $type5, $id6, $nom6, $type6, $id7, $nom7, $type7, $id8, $nom8, $type8, $id9, $nom9, $type9, $id10, $nom10, $type10 );
            $i = 0;
            while ($stmt->fetch()) {

                // $array[$id1][$nom1][$id2][$nom2][$id3][$nom3][$id4][$nom4][$id5][$nom5] ='hello';
                $array[$id1][$id2][$id3][$id4][$id5][$id6][$id7][$id8][$id9][$id10] = NULL;
                $array_nom[$id1] = $nom1;
                $array_nom[$id2] = $nom2;
                $array_nom[$id3] = $nom3;
                $array_nom[$id4] = $nom4;
                $array_nom[$id5] = $nom5;
                $array_nom[$id6] = $nom6;
                $array_nom[$id7] = $nom7;
                $array_nom[$id8] = $nom8;
                $array_nom[$id9] = $nom9;
                $array_nom[$id10] = $nom10;
                
                $array_type[$id1] = $type1;
                $array_type[$id2] = $type2;
                $array_type[$id3] = $type3;
                $array_type[$id4] = $type4;
                $array_type[$id5] = $type5;
                $array_type[$id6] = $type6;
                $array_type[$id7] = $type7;
                $array_type[$id8] = $type8;
                $array_type[$id9] = $type9;
                $array_type[$id10] = $type10;
                
                $array_lien[$id1] = Utilitaires::UrlPropre($nom1);
                $array_lien[$id2] = Utilitaires::UrlPropre($nom2);
                $array_lien[$id3] = Utilitaires::UrlPropre($nom3);
                $array_lien[$id4] = Utilitaires::UrlPropre($nom4);
                $array_lien[$id5] = Utilitaires::UrlPropre($nom5);
                $array_lien[$id6] = Utilitaires::UrlPropre($nom6);
                $array_lien[$id7] = Utilitaires::UrlPropre($nom7);
                $array_lien[$id8] = Utilitaires::UrlPropre($nom8);
                $array_lien[$id9] = Utilitaires::UrlPropre($nom9);
                $array_lien[$id10] = Utilitaires::UrlPropre($nom10);
                
                if ($id1==$defaut){$array_defaut[$id1] = 'class="selected"';$nom_defaut=$nom1;}
                elseif ($id2==$defaut){$array_defaut[$id2] = 'class="selected"';$nom_defaut=$nom2;}
                elseif ($id3==$defaut){$array_defaut[$id3] = 'class="selected"';$nom_defaut=$nom3;}
                elseif ($id4==$defaut){$array_defaut[$id4] = 'class="selected"';$nom_defaut=$nom4;}
                elseif ($id5==$defaut){$array_defaut[$id5] = 'class="selected"';$nom_defaut=$nom5;}
                elseif ($id6==$defaut){$array_defaut[$id6] = 'class="selected"';$nom_defaut=$nom6;}
                elseif ($id7==$defaut){$array_defaut[$id7] = 'class="selected"';$nom_defaut=$nom7;}
                elseif ($id8==$defaut){$array_defaut[$id8] = 'class="selected"';$nom_defaut=$nom8;}
                elseif ($id9==$defaut){$array_defaut[$id9] = 'class="selected"';$nom_defaut=$nom9;}
                elseif ($id10==$defaut){$array_defaut[$id10] = 'class="selected"';$nom_defaut=$nom10;}
            }
        }


        //on construire le menu

        $menu = '<ul class="tree dhtml">'; //niv1


        foreach ($array as $id_cat1 => $tab2) {

            $menu .='<li>'; //niv11
            $menu .='<a href="' . $lang . '-pg2,cat' . $id_cat1 . '-' . $site . ',' . $array_lien[$id_cat1] . '.html" '.$array_defaut[$id_cat1].' title="' . $array_lien[$id_cat1] . '">' . $array_nom[$id_cat1] . '</a>';


            //ss menu
            $menu .='<ul>';

            boucle($tab2);

            $menu .='</ul>';
            // /ssmenu

            $menu .='</li>';
        }



        $menu .='</ul>';
        $menus['menu']=$menu;
        $menus['cat_par_defaut']=$nom_defaut;
        return $menus;
    }

}

?>
