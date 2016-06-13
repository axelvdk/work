<?php

/*
 * 16/8/2011 ajout de nom et prenom dans crrerclient coord fac
  19/8/2011 ajout en session du login client meme si la connexion echoue pour recuperer dans le frmaulaire la donnée
 *          dans connect_client
 * 29/08/2011 ajout du chargement du panier a la connexion du client
 * 16/11/2011 debug avec modif du query deficient de consulter client fac
 * 13 mars 2011 on enleve le rajoutsql car si le referer du header qui suit est panier_detail, il y a deux fois 
 * le rajout en sql, ce qui double les quantites (faire panier hors connection valider le panier, se loguer et header
 * vers panier detail, les qte sont doubles.
 * 6sept 2012 modifications des classe pw_perdu et new (problemes de fichiers langues: mauvais lien et mauvaise variable/constante)
 * 20/03/2013 rajout du parametre page_retour et remplacement de HTTP_REFERER par $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] se basant sur
 * des infos serveurs et non plus client( qui peut avoir deconnecté le param http_referer
 * 20/03/2013 rajout de nom et prenom
 */

/**
 * Description of ClientFactory
 *
 * @author Cédric
 */
class ClientFactory {

    public static function Connect_client($login, $pass, $page_retour = Null) {
        $connection = mysqli_connect(BDD_HOST, BDD_USER, BDD_PW, BDD_BASE);
        //si la variable $page_retour n'a  aps ete définie on va essayer un http_referer
        if (is_null($page_retour)) {
            //$page_retour=$_SERVER['HTTP_REFERER'];
            $page_retour = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        if (!empty($login) AND (!empty($pass))) {
            include 'connect.php';
            $query = "SELECT id,login,nom,prenom,telephone,pass,actif from client WHERE login='" . mysqli_real_escape_string($connection,$login) . "' AND pass='" . sha1(mysql_real_escape_string($pass)) . "'";
            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client: ' . $query);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_array($result);
                if ($data['pass'] == sha1($pass)) {
                    if ($data['actif'] == 1) {
                        $_SESSION['id_client'] = $data['id'];
                        $_SESSION['login_client'] = $data['login'];
                        $_SESSION['nom_client'] = $data['nom'];
                        $_SESSION['prenom_client'] = $data['prenom'];
                        $_SESSION['tel_client'] = $data['telephone'];

                        include_once './class/autoload.php';

//attention a ne pas remettre en route sans avoir lu le log de modif
                        //  $panier = PanierFactory::ajout_sql();

                        header('location: ' . $page_retour);
                        return true;
                    } else {

                        return 'NON_ACTIF';
                    }
                }
            }

            mysqli_close($connection);
        }
        $_SESSION['login_client'] = $login;
    }

    public static function CreerClient($email, $login, $pass, $pass2, $nom, $prenom, $telephone, $fax, $lang, $actif, $last_ip, $last_connect) {




        $client = new Client();

        $client->setEmail($email);
        $client->setLogin($login);
        $client->setPass($pass, $pass2);
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setTelephone($telephone);
        $client->setFax($fax);
        $client->setLang($lang);

        include 'connect.php';



        if (empty($client->erreur)) {//on place en bdd
            $query = "INSERT INTO client SET
                                    email='" . mysqli_real_escape_string($connection,$client->email) . "',
                                    login='" . mysqli_real_escape_string($connection,$client->login) . "',
                                    pass='" . mysqli_real_escape_string($connection,$client->pass) . "',
                                    nom='" . mysqli_real_escape_string($connection,$client->nom) . "',
                                    prenom='" . mysqli_real_escape_string($connection,$client->prenom) . "',
                                    telephone='" . mysqli_real_escape_string($connection,$client->telephone) . "',
                                    fax='" . mysqli_real_escape_string($connection,$client->fax) . "',
                                    last_ip='" . mysqli_real_escape_string($connection,$last_ip) . "',
                                    last_connect='" . mysqli_real_escape_string($connection,$last_connect) . "',
                                    actif='" . mysqli_real_escape_string($connection,$actif) . "',
                                    archive='0',
                                    lang='" . mysqli_real_escape_string($connection,$lang) . "',
                                    type=2
";
            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client: ' . $query);

            $client->setId(mysqli_insert_id($connection));
        }

        mysqli_close($connection);

        return $client;
    }

    public static function CreerClient_coord_fac($id_client, $societe, $nom, $prenom, $tva, $rue, $num, $boite, $cp, $commune, $pays, $actif) {

        //verifier unicite tva, si existe (sauf NA), supprimer le client avec l'ide recu

        $client_coord_fac = new Client_coord_fac();


        $client_coord_fac->setSociete($societe);
        $client_coord_fac->setNom($nom);
        $client_coord_fac->setPrenom($prenom);
        $client_coord_fac->setTva($tva);
        $client_coord_fac->setRue($rue);
        $client_coord_fac->setNum($num);
        $client_coord_fac->setBoite($boite);
        $client_coord_fac->setCp($cp);
        $client_coord_fac->setCommune($commune);
        $client_coord_fac->setPays($pays);
        $client_coord_fac->setActif($actif);
        $client_coord_fac->setId_client($id_client);




        if (empty($client_coord_fac->erreur)) {//on place en bdd
            include 'connect.php';
            $query = "INSERT INTO client_coord_fac SET
                                    Societe='" . mysqli_real_escape_string($connection,$client_coord_fac->societe) . "',
                                    nom='" . mysqli_real_escape_string($connection,$client_coord_fac->nom) . "',
                                    prenom='" . mysqli_real_escape_string($connection,$client_coord_fac->prenom) . "',
                                    tva='" . mysqli_real_escape_string($connection,$client_coord_fac->tva) . "',
                                    rue='" . mysqli_real_escape_string($connection,$client_coord_fac->rue) . "',
                                    num='" . mysqli_real_escape_string($connection,$client_coord_fac->num) . "',
                                    boite='" . mysqli_real_escape_string($connection,$client_coord_fac->boite) . "',
                                    cp='" . mysqli_real_escape_string($connection,$client_coord_fac->cp) . "',
                                    commune='" . mysqli_real_escape_string($connection,$client_coord_fac->commune) . "',
                                    pays='" . mysqli_real_escape_string($connection,$client_coord_fac->pays) . "',
                                    actif='" . mysqli_real_escape_string($connection,$client_coord_fac->actif) . "'
";
            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client_coord_fac: ' . $query);

            $esclave = mysqli_insert_id($connection);

            $query = "INSERT INTO client_coord_fac_lie SET
                                    maitre='" . mysqli_real_escape_string($connection,$id_client) . "',
                                    esclave='" . mysqli_real_escape_string($connection,$esclave) . "'
 ";

            $result = mysqli_query($connection,$query) or die(mysqli_error() . ' Erreur dans creer client_coord_fac: ' . $query);

            $client_coord_fac->setId($esclave);

            mysqli_close($connection);
        }



        return $client_coord_fac;
    }

    public static function CreerClient_coord_livr($id_client, $nom, $prenom, $societe, $contact, $gsm, $tva, $rue, $num, $boite, $cp, $commune, $pays, $actif) {

        //verifier unicite tva, si existe (sauf NA), supprimer le client avec l'ide recu

        $client_coord_livr = new Client_coord_livr();


        $client_coord_livr->setSociete($societe);
        $client_coord_livr->setNom($nom);
        $client_coord_livr->setPrenom($prenom);
        $client_coord_livr->setContact($contact);
        $client_coord_livr->setGsm_contact($gsm);
        $client_coord_livr->setRue($rue);
        $client_coord_livr->setNum($num);
        $client_coord_livr->setBoite($boite);
        $client_coord_livr->setCp($cp);
        $client_coord_livr->setCommune($commune);
        $client_coord_livr->setPays($pays);
        $client_coord_livr->setActif($actif);
        $client_coord_livr->setId_client($id_client);




        if (empty($client_coord_livr->erreur)) {//on place en bdd
            include 'connect.php';
            $query = "INSERT INTO client_coord_livr SET
                                    Societe='" . mysqli_real_escape_string($connection,$client_coord_livr->societe) . "',
                                    nom='" . mysqli_real_escape_string($connection,$client_coord_livr->nom) . "',
                                    prenom='" . mysqli_real_escape_string($connection,$client_coord_livr->prenom) . "',
                                    contact='" . mysqli_real_escape_string($connection,$client_coord_livr->contact) . "',
                                    telephone_contact='" . mysqli_real_escape_string($connection,$client_coord_livr->gsm) . "',
                                    rue='" . mysqli_real_escape_string($connection,$client_coord_livr->rue) . "',
                                    num='" . mysqli_real_escape_string($connection,$client_coord_livr->num) . "',
                                    boite='" . mysqli_real_escape_string($connection,$client_coord_livr->boite) . "',
                                    cp='" . mysqli_real_escape_string($connection,$client_coord_livr->cp) . "',
                                    commune='" . mysqli_real_escape_string($connection,$client_coord_livr->commune) . "',
                                    pays='" . mysqli_real_escape_string($connection,$client_coord_livr->pays) . "',
                                    actif='" . mysqli_real_escape_string($connection,$client_coord_livr->actif) . "'
";
            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client_coord_livr: ' . $query);

            $esclave = mysqli_insert_id();

            $query = "INSERT INTO client_coord_livr_lie SET
                                    maitre='" . mysqli_real_escape_string($connection,$id_client) . "',
                                    esclave='" . mysqli_real_escape_string($connection,$esclave) . "'
 ";

            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client_coord_livr: ' . $query);

            $client_coord_livr->setId($esclave);

            mysqli_close($connection);
        }



        return $client_coord_livr;
    }

    public static function ModifClient_coord_fac($id_client, $id_client_lie, $societe, $nom, $prenom, $tva, $rue, $num, $boite, $cp, $commune, $pays, $actif) {

        //verifier unicite tva, si existe (sauf NA), supprimer le client avec l'ide recu
        $query = "SELECT * from client_coord_fac_lie where
                                    maitre='" . mysqli_real_escape_string($connection,$id_client) . "' AND
                                    esclave='" . mysqli_real_escape_string($id_client_lie) . "'
 ";

        $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans creer client_coord_fac: ' . $query);





        if (mysqli_num_rows($result) > 0) {//on place en bdd
            include 'connect.php';
            $query = "update client_coord_fac SET
                                    Societe='" . mysqli_real_escape_string($connection,$societe) . "',
                                    nom='" . mysqli_real_escape_string($connection,$nom) . "',
                                    prenom='" . mysqli_real_escape_string($connection,$prenom) . "',
                                    tva='" . mysqli_real_escape_string($connection,$tva) . "',
                                    rue='" . mysqli_real_escape_string($connection,$rue) . "',
                                    num='" . mysqli_real_escape_string($connection,$num) . "',
                                    boite='" . mysqli_real_escape_string($connection,$boite) . "',
                                    cp='" . mysqli_real_escape_string($connection,$cp) . "',
                                    commune='" . mysqli_real_escape_string($connection,$commune) . "',
                                    pays='" . mysqli_real_escape_string($connection,$pays) . "',
                                    actif='" . mysqli_real_escape_string($connection,$actif) . "'
                                        Where id='" . mysqli_real_escape_string($connection,$id_client_lie) . "'
";
            $result = mysqli_query($connection,$query) or die(mysqli_error() . ' Erreur dans creer client_coord_fac: ' . $query);

            echo $query;



            mysqli_close($connection);
        }
    }

    public static function Client_Change_PW($identifiant, $lang) {

        include_once './lang/lang_class_clientfactory.php';

        if ($identifiant != '') {
            include 'connect.php';
            //
            ////rechercher ds bd l'equivalent id login de e-mail + time, faire md5 avec les 3 données

            $query = "    SELECT  id, login, email
                    FROM client
                    WHERE login = '" . mysqli_real_escape_string($connection,$identifiant) . "'
                    OR email = '" . mysqli_real_escape_string($connection,$identifiant) . "'
                    ";

            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans Client_Change_PW: ' . $query);

            if (mysqli_num_rows($result) == 1) {
                $donnee = mysqli_fetch_array($result);

                //le sha1 avec aléatoire
                // $ctrl=sha1($login.$id.rand(1000, 5000));
                define('ALPHABET', 'azertyuipqsdfghjklmwxcvbnAZERTYUPQSDFGHJKLMWXCVBN1234567890'); //Entrez les caractères que vous voulez
                $longueur = 8;
                $ctrl = substr(str_shuffle(str_repeat(ALPHABET, $longueur)), 0, $longueur);


                $query = "	INSERT INTO client_change_pw
					SET 
					id_client = '" . mysqli_real_escape_string($connection,$donnee['id']) . "',
					login = '" . mysqli_real_escape_string($connection,$donnee['login']) . "',
					ctrl = '" . mysqli_real_escape_string($connection,$ctrl) . "',
					date = '" . time() . "'
					
				";



                $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans Client_Change_PW: ' . $query);

                //ecrire dans newemail les données avec les donnée de temps

                //var_dump($lang);
                $Destinataire = $donnee['email'];
                $Sujet = $lang_client_change_pw_mail_titre[$lang];

                $From = "From:" . MAIL_ADMIN . "\n";
                $From .= "MIME-version: 1.0\n";
                $From .= "Content-type: text/html; charset= iso-8859-1\n";

                $Message = "

<html>
<b>" . $lang_client_change_pw_mailcontenu[$lang] . " " . SITE_ADRESS . " </b><br><br>" . $lang_client_change_pw_mailcontenu2[$lang] . "
<br><br>

" . $lang_client_change_pw_login[$lang] . " " . $donnee['login'] . "<br>
" . $lang_client_change_pw_ctrl[$lang] . " " . $ctrl . "<br>

<p><a href=\"http://" . SITE_ADRESS . "/" . $_SESSION['lang'] . "-modifpw1-" . $donnee['login'] . "-" . $ctrl . ".html\">" . $lang_client_change_pw_maillien1[$lang] . "</a>" . $lang_client_change_pw_mailliendef1[$lang] . "</p><br>

<p><a href=\"http://" . SITE_ADRESS . "/" . $_SESSION['lang'] . "-modifpw0-" . $donnee['login'] . "-" . $ctrl . ".html\">" . $lang_client_change_pw_maillien2[$lang] . "</a>" . $lang_client_change_pw_mailliendef2[$lang] . "</p>";

                ;

                if (!mail($Destinataire, $Sujet, $Message, $From)) {

                    $message = $lang_client_change_pw_message1[$lang];
                } else {

                    $message = $lang_client_change_pw_message2[$lang];
                }
            } elseif (mysqli_num_rows($result) == 0) {

                $message = $lang_client_change_pw_message1[$lang];
            }
            //si pas de concordance (log n'existe pas
            return $message;
        }
    }

    public static function Client_Change_PW_Confirmation($action, $login, $ctrl, $pass, $pass2, $lang) {

        include_once './lang/lang_class_clientfactory.php';

        $client = new Client();

        include 'connect.php';


        //supprimer les requetes de plus de 48heures
        $t = time() - (48 * 60 * 60);



        $query = "DELETE FROM client_change_pw WHERE date <'" . $t . "' ";

        $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans Client_Change_PW_Confirmation: ' . $query);


        if ($action == 'annulation') {
            $query = "DELETE FROM client_change_pw WHERE login='" . $login . "' ";

            $result = mysqli_query($connection,$query) or die(mysqli_error($connection) . ' Erreur dans Client_Change_PW_Confirmation: ' . $query);


            $client->setErreur($lang_client_change_pw_confirmation_annulation[$lang]);
        } elseif ($action == 'valide') {

            $client->setPass($pass, $pass2);


            if (empty($client->erreur)) {//on place en bdd
                $query = mysqli_query("SELECT * FROM client_change_pw WHERE login='" . $login . "' ORDER By date DESC");
                $data = mysqli_fetch_array($query);



                //comparaison si different on bloque

                if ($ctrl != $data['ctrl']) {


                    $client->setErreur($lang_client_change_pw_confirmation_nul[$lang]);
                } elseif ($ctrl == $data['ctrl']) {
                    //si on annule on annule...






                    $query2 = "DELETE FROM client_change_pw WHERE login='" . $login . "' ";

                    $result = mysqli_query($connection,$query2) or die(mysqli_error($connection) . ' Erreur dans Client_Change_PW_Confirmation: ' . $query);




                    $query2 = "UPDATE client SET
                            pass='" . mysqli_real_escape_string($connection,$client->pass) . "'
                            WHERE login='" . $login . "' ";

                    $result = mysqli_query($connection,$query2) or die(mysqli_error($connection) . ' Erreur dans Client_Change_PW_Confirmation: ' . $query);



                    $client->setErreur($lang_client_change_pw_confirmation_ok[$lang]);
                }
            }
        }


        mysqli_close($connection);


        return $client;
    }

    public static function ConsulterClient_fac($id) {

        include 'connect.php';


        $query = "Select
                    client_coord_fac.id,
                    client_coord_fac.societe,
                    client_coord_fac.nom,
                    client_coord_fac.prenom,
                    client_coord_fac.tva,
                    client_coord_fac.rue,
                    client_coord_fac.num,
                    client_coord_fac.boite,
                    client_coord_fac.cp,
                    client_coord_fac.commune,
                    client_coord_fac.Pays

                FROM client_coord_fac_lie
                
                LEFT JOIN client_coord_fac 
                ON client_coord_fac.id=client_coord_fac_lie.esclave
                
                WHERE client_coord_fac_lie.maitre='" . $id . "'
                    
                ORDER BY client_coord_fac.id DESC
        ";

        $result = mysqli_query($connection,$query);

        if (mysqli_num_rows($result) > 0) {

            while ($data = mysqli_fetch_array($result)) {
                $client_coord_fac = new Client_coord_fac();
                $client_coord_fac->setId_client_fac($data[id]);
                $client_coord_fac->setSociete($data[societe]);
                $client_coord_fac->setNom($data[nom]);
                $client_coord_fac->setPrenom($data[prenom]);
                $client_coord_fac->setTva($data[tva]);
                $client_coord_fac->setRue($data[rue]);
                $client_coord_fac->setNum($data[num]);
                $client_coord_fac->setBoite($data[boite]);
                $client_coord_fac->setCp($data[cp]);
                $client_coord_fac->setCommune($data[commune]);
                $client_coord_fac->setPays($data[Pays]);

                $client_coord_fac_tab[] = $client_coord_fac;
            }
        }



        return $client_coord_fac_tab;
    }

    public static function ConsulterClient_livr($id_client, $id_livraison = NULL) {

        include 'connect.php';

        //Si $id_livraison est null on va rechecher l'ensemble des adresses de livraison, 
        //dans le cas contraire uniquement celle demmandée

        if (!is_null($id_livraison)) {

            $request_sup = "AND client_coord_livr_lie.esclave='" . $id_livraison . "'";
        }

        $query = "Select
                    client_coord_livr.id,
                    client_coord_livr.nom,
                    client_coord_livr.prenom,
                    client_coord_livr.societe,
                    client_coord_livr.contact,
                    client_coord_livr.telephone_contact,
                    client_coord_livr.note_livraison,
                    client_coord_livr.rue,
                    client_coord_livr.num,
                    client_coord_livr.boite,
                    client_coord_livr.cp,
                    client_coord_livr.commune,
                    client_coord_livr.Pays

                FROM client_coord_livr_lie
                
                LEFT JOIN client_coord_livr 
                ON client_coord_livr.id=client_coord_livr_lie.esclave
                
          
          
               WHERE client_coord_livr_lie.maitre='" . $id_client . "' ";
        
        $query.=$request_sup;
        $query.=" ORDER BY client_coord_livr.id DESC
        ";



        $result = mysqli_query($connection,$query);

        if (mysqli_num_rows($result) > 0) {

            while ($data = mysqli_fetch_array($result)) {
                $client_coord_livr = new Client_coord_livr();
                $client_coord_livr->setId_client_livr($data[id]);
                $client_coord_livr->setNom($data[nom]);
                $client_coord_livr->setPrenom($data[prenom]);
                $client_coord_livr->setSociete($data[societe]);
                $client_coord_livr->setContact($data[contact]);
                $client_coord_livr->setGsm_contact($data[telephone_contact]);
                $client_coord_livr->setNote_livr($data[note_livraison]);
                //$client_coord_fac->setTva($data[tva]);
                $client_coord_livr->setRue($data[rue]);
                $client_coord_livr->setNum($data[num]);
                $client_coord_livr->setBoite($data[boite]);
                $client_coord_livr->setCp($data[cp]);
                $client_coord_livr->setCommune($data[commune]);
                $client_coord_livr->setPays($data[Pays]);

                $client_coord_fac_livr[] = $client_coord_livr;
            }
        }



        return $client_coord_fac_livr;
    }

}

?>
