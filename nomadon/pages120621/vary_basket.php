<?php

//recuperation des données et slash?
$client['DESCRCLI'] = $fac_societe;
$client['LANGCLI'] = $lang;
$client['ADRFACT'] = $fac_rue . ' ' . $fac_num . ' ' . $fac_boite;
$client['ZIPFACT'] = $fac_pays.'-'.$fac_cp; //pays en ISO puis cp
$client['CITYFACT'] = $fac_commune;
$client['TITLE'] = NULL;
$client['FIRSTNAME'] = $fac_prenom;
$client['LASTNAME'] = $fac_nom;
$client['EMAIL'] = $email;
$client['GSM'] = $telephone;
$client['TELEPHONE'] = $telephone;
$client['FAX'] = NULL;
$client['NUMTVA'] = $fac_tva;

$vary_basket['REFERENCE'] = $nom_event;
$vary_basket['DATELIV'] = NULL;
if ($livr_aller == 'livraison') {
$vary_basket['DATELIV'] = dateVary($date_livr_aller);} 
$vary_basket['DATERET'] = dateVary($date_livr_retour);
$vary_basket['DATEENLEV'] = NULL;
if ($livr_aller != 'livraison') {
$vary_basket['DATEENLEV'] = dateVary($date_livr_aller);}  
$vary_basket['DATEEVENTD'] = dateVary($date_deb);
$vary_basket['DATEEVENTF'] = dateVary($date_fin);
$vary_basket['HEUREEVENTD'] = NULL; //heure event
$vary_basket['HEUREEVENTF'] = NULL; //heure event
$vary_basket['LIVBY'] = '1';
if ($livr_aller == 'livraison') {
$vary_basket['LIVBY'] = '2';}
$vary_basket['LIVADRID'] = NULL;
$vary_basket['LIVLIEU'] = $lieu_livr_aller;
$vary_basket['LIVRUE'] = $rue_livr_aller;
$vary_basket['LIVNUMRUE'] = $num_livr_aller.' '.$boite_livr_aller;
$vary_basket['LIVZIP'] = $pays_livr_aller.'-'.$cp_livr_aller;
$vary_basket['LIVCITY'] = $commune_livr_aller;
$vary_basket['LIVLONGITUDE'] = NULL;
$vary_basket['LIVLATITUDE'] = NULL;
$vary_basket['LIVACCES'] = '0';
$vary_basket['LIVACCESNOTE'] = NULL;
if($livr_aller_conditions !=''){
$vary_basket['LIVACCES'] = '1';
$vary_basket['LIVACCESNOTE'] = $livr_aller_conditions;}
$vary_basket['LIVHEURED'] = $heure_livr_aller[1];
$vary_basket['LIVHEUREF'] = $heure_livr_aller[2];
$vary_basket['LIVNOTE'] = $livr_info_general;
$vary_basket['LIVCONTACT1'] = $nom_contact_aller;
$vary_basket['LIVCONFON1'] = NULL;
$vary_basket['LIVCONTEL1'] = $gsm_contact_aller;
$vary_basket['LIVCONTACT2'] = NULL;
$vary_basket['LIVCONFON2'] = NULL;
$vary_basket['LIVCONTEL2'] = NULL;
$vary_basket['RETBY'] = '1';
if ($livr_aller == 'livraison') {
$vary_basket['RETBY'] = '2';}
$vary_basket['RETADRID'] = NULL;
$vary_basket['RETLIEU'] = $lieu_livr_retour;
$vary_basket['RETRUE'] = $rue_livr_retour;
$vary_basket['RETNUMRUE'] = $num_livr_retour.' '.$boite_livr_retour;
$vary_basket['RETZIP'] = $pays_livr_retour.'-'.$cp_livr_retour;
$vary_basket['RETCITY'] = $commune_livr_retour;
$vary_basket['RETLONGITUDE'] = NULL;
$vary_basket['RETLATITUDE'] = NULL;
$vary_basket['RETACCES'] = '0';
$vary_basket['RETACCESNOTE'] = NULL;
if($livr_aller_conditions !=''){
    $vary_basket['RETACCES'] = '2';
$vary_basket['RETACCESNOTE'] = $livr_retour_conditions;}
$vary_basket['RETHEURED'] = $heure_livr_retour[1];
$vary_basket['RETHEUREF'] = $heure_livr_retour[2];
$vary_basket['RETNOTE'] = $livr_info_general;
$vary_basket['RETCONTACT1'] = $nom_contact_retour;
$vary_basket['RETCONFON1'] = NULL;
$vary_basket['RETCONTEL1'] = $gsm_contact_retour;
$vary_basket['RETCONTACT2'] = NULL;
$vary_basket['RETCONFON2'] = NULL;
$vary_basket['RETCONTEL2'] = NULL;



function dateVary($date) {
    $explode = explode("-", $date);
    $annee = $explode[2];
    $mois = $explode[1];
    $jour = $explode[0];
    return $annee . $mois . $jour;
}

// Get an instance of Domdocument 
$xml = new DOMDocument();

// specify the version and encoding
$xml->version = '1.0';
$xml->encoding = 'ISO-8859-1';

// Create a comment
$comment_elt = $xml->createComment(utf8_encode('V0.0'));

// Put this comment at the Root of the XML doc
$xml->appendChild($comment_elt);

$tag_basket = $xml->createElement('BASKET');

//client
$tag_client = $xml->createElement('CLIENT');
foreach ($client as $key => $value) {

    $tag = $xml->createElement($key, utf8_encode($value));
    $tag_client->appendChild($tag);
}
$tag_basket->appendChild($tag_client);

//basket

$tag_basket_h = $xml->createElement('BASKET_HEADER');
foreach ($vary_basket as $key => $value) {

    $tag = $xml->createElement($key, utf8_encode($value));
    $tag_basket_h->appendChild($tag);
}
$tag_basket->appendChild($tag_basket_h);

//lignes basket g�n�r� dans mail_conf_com

$tag_basket_lines = $xml->createElement('BASKET_LINES');

foreach ($vary_basket_line as $keys => $values) {
    $tags = $xml->createElement('LINE');

//les lignes a boucler
    foreach ($values as $key => $value) {
        $tag = $xml->createElement($key, utf8_encode($value));
        $tags->appendChild($tag);
    }
    //
    $tag_basket_lines->appendChild($tags);
    ;
}

$tag_basket->appendChild($tag_basket_lines);


//pour mettre en page le document xml commenter si en ligne

$xml->formatOutput = true;

$xml->appendChild($tag_basket);

$xml->saveXML();

$xml_chemin='./xml/vary'.$dossier_id.'.xml';

$xml->save($xml_chemin);


/*
CLIENT
Balise Description Type dans Vary SQL Valeur possible
USERID * ID Contact BigInt Valeur ou NULL
CODECLIENT * Code client Varchar(20) Texte ou NULL
DESCRCLI ** Description Client Varchar(40) Texte ou NULL
LANGCLI ** Langue du Client Char(2) FR,NL,EN,DE
ADRFACT ** Adresse du client text Texte ou NULL
ZIPFACT ** Code postal du client Varchar(20) Texte ou NULL
CITYFACT ** LocalitÃ© du client Varchar(50) Texte ou NULL
TITLE **Titre Varchar(20) NULL ou ***
FIRSTNAME ** PrÃ©nom Varchar(40) Texte ou NULL
LASTNAME ** Nom Varchar(40) Texte ou NULL
EMAIL ** Adresse email Varchar(100) Texte ou NULL
GSM ** NÂ° TÃ©lÃ©phone mobile Varchar(20) Texte ou NULL
TELEPHONE ** NÂ° TÃ©lÃ©phone Varchar(20) Texte ou NULL
FAX ** NÂ° FAX Varchar(20) Texte ou NULL
NUMTVA ** NumÃ©ro de TVA ou NA Varchar(20) Texte (NumÃ©ro de
TVA ou NA ) ou NULL
* A renseignÃ© pour les clients connus, ne pas mentionnÃ© la balise ou NULL si client inconnu
** A renseignÃ© pour les clients inconnus, sans effets pour les clients connus
*** Monsieur, Madame, Mademoiselle, MaÃ®tre, Docteur, De Heer, Mevrouw, Juffrouw,
Meester, Dokter, Mister, Miss, Misses, Master, Doctor, Herr, Madame, Fehlen, Meister, Dr.

*/

/*
BASKET_HEADER
Balise Description Type dans Vary SQL Valeur possible
REFERENCE RÃ©fÃ©rence du dossier Varchar(60) Texte ou NULL
DATELIV *Date Livraison char(8) Texte (AAAAMMJJ)
DATERET Date Retour char(8) Texte (AAAAMMJJ)
DATEENLEV **Date dâenlÃ¨vement char(8) Texte (AAAAMMJJ)
DATEEVENTD Date dÃ©but Ã©vÃ©nement char(8) Texte (AAAAMMJJ)
DATEEVENTF Date fin Ã©vÃ©nement char(8) Texte (AAAAMMJJ)
HEUREEVENTD Heure dÃ©but Ã©vÃ©nement char(4) Texte (HHmm)
HEUREEVENTF Heure dÃ©but Ã©vÃ©nement char(4) Texte (HHmm)
NOTE Note libre text Texte ou NULL
LIVBY Transport dÃ©part Par : tinyint 1 = Client, 2 = SociÃ©tÃ©
LIVADRID *** ID de lâadresse de Liv. bigint Valeur ou NULL
LIVLIEU Lieu de la livraison Varchar(100) Texte ou NULL
LIVRUE Rue de la livraison Varchar(50) Texte ou NULL
LIVNUMRUE NumÃ©ro dans la rue le la livraison Varchar(10) Texte ou NULL
LIVZIP Code postal de la livraison Varchar(20) Texte ou NULL
LIVCITY LocalitÃ© de la livraison Varchar(50) Texte ou NULL
LIVLONGITUDE **** Longitude de la livraison real Valeur ou NULL
LIVLATITUDE **** Latitude de la livraison real Valeur ou NULL
LIVACCES AccÃ¨s idÃ©al pour la livraison tinyint NULL ou
0 : indÃ©fini
1 : LâaccÃ¨s EST idÃ©al pour la livraison
2 : LâaccÃ¨s NâEST PAS idÃ©al pour la livraison
LIVACCESNOTE Note si lâaccÃ¨s NâEST PAS idÃ©al pour la livraison text Texte ou NULL
LIVHEURED Heure min livraison /EnlÃ¨vement Char(4) Texte (HHmm)
LIVHEUREF Heure max livraison /EnlÃ¨vement Char(4) Texte (HHmm)
LIVNOTE Note livraison text Texte ou NULL
LIVCONTACT1 Contact 1 livraison Varchar(100) Texte ou NULL
LIVCONFON1 Fonction contact 1 livraison Varchar(20) Texte ou NULL
LIVCONTEL1 TÃ©lÃ©phone contact 1 livraison Varchar(20) Texte ou NULL
LIVCONTACT2 Contact 2 liv. Varchar(100) Texte ou NULL
LIVCONFON2 Fonction contact 2 livraison Varchar(20) Texte ou NULL
LIVCONTEL2 TÃ©lÃ©phone contact 2 livraison Varchar(20) Texte ou NULL
RETBY Transport retour par : Tinyint 1 = Client, 2 = SociÃ©tÃ©
RETADRID *** ID de lâadresse de reprise bigint Valeur ou NULL
RETLIEU Lieu de la reprise Varchar(100) Texte ou NULL
RETRUE Rue de la reprise Varchar(50) Texte ou NULL
RETNUMRUE NumÃ©ro dans la rue le la reprise Varchar(10) Texte ou NULL
RETZIP Code postal de la reprise Varchar(20) Texte ou NULL
RETCITY LocalitÃ© de la reprise Varchar(50) Texte ou NULL
RETLONGITUDE **** Longitude de la reprise real Valeur ou NULL
RETLATITUDE **** Latitude de la reprise real Valeur ou NULL
RETACCES AccÃ¨s idÃ©al pour la reprise tinyint NULL ou
0 : indÃ©fini
1 : LâaccÃ¨s EST idÃ©al pour la reprise
2 : LâaccÃ¨s NâEST PAS idÃ©al pour la reprise
RETACCESNOTE Note si lâaccÃ¨s NâEST PAS idÃ©al pour la livraison text Texte ou NULL
RETHEURED Heure min reprise /Retour Char(4) Texte (HHmm)
RETHEUREF Heure max reprise /Retour Char(4) Texte (HHmm)
RETNOTE Note reprise text Texte ou NULL
RETCONTACT1 Contact 1 reprise Varchar(100) Texte ou NULL
RETCONFON1 Fonction contact 1 reprise Varchar(20) Texte ou NULL
RETCONTEL1 TÃ©lÃ©phone contact 1 reprise Varchar(20) Texte ou NULL
RETCONTACT2 Contact 2 reprise Varchar(100) Texte ou NULL
RETCONFON2 Fonction contact 2 reprise Varchar(20) Texte ou NULL
RETCONTEL2 TÃ©lÃ©phone contact 2 reprise Varchar(20) Texte ou NULL

** Null si DATELIV est renseignÃ©
*** Est prÃ©sent an cas dâÃ©volution des fonctionnalitÃ©s : RÃ©cupÃ©ration et utilisation des adresses
de livraison du client.
**** Est prÃ©sent an cas dâÃ©volution des fonctionnalitÃ©s : Utilisation de Google maps sur le site

BASKET_LINES
LINE
Balise Description Type dans Vary SQL Valeur possible
ITEMCODE Code Article Varchar(20)
QUANTITY QuantitÃ© real

*/

