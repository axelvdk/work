<?php

// fichier de configuration pour la créations les photos lors de l(utilisation du module photo via ftp

if($_SERVER["REMOTE_ADDR"]=="127.0.0.1")
{
define ('C_DOSSIER_FTP',"../ftp/"); //adresse du ftp local
}
else
{
define ('C_DOSSIER_FTP',"./ftp/"); //adresse du ftp distant
}


define ('C_DOSSIER_PHOTO',"../photo/element/"); //dossier ou sera copier la photo apres tretemùent

define ('C_DOSSIER_FICHIER',"../fichier/"); //dossier ou sera copier la photo apres tretemùent

define ('C_IMG_COP',"../photo/filigrane.png"); // fichier photo pour le filigrane

define ('C_DOSSIER_BUG',"../log/ftp_gestion/");//chemin dossier bug

define ('C_FILIGRANE_HR_1_0',"0"); //Filigrane par defaut HR 1=oui 0=non

define ('C_FILIGRANE_BR_1_0',"1"); //Filigrane par defaut BR 1=oui 0=non

define ('C_FILIGRANE_THUMB_1_0',"0"); //Filigrane par defaut sur thumb 1=oui 0=non

define ('C_TAILLELARG_HR',"0"); //largeur de la grande photo HR souhaitée (0 si pas de hr)// lors de la creation le meilleur valeur hauteur/largeur est retenu

define ('C_TAILLEHAUT_HR',"0"); //hauteur de la grande photo HR souhaitée (0 si pas de hr)

define ('C_TAILLELARG_BR',"800"); //largeur de la grande photo BRsouhaitée // lors de la creation le meilleur valeur hauteur/largeur est retenu

define ('C_TAILLEHAUT_BR',"600"); //hauteur de la grande photo souhaitée BR

define ('C_TAILLELARG_THUMB',"300"); //largeur du thumb souhaitée

define ('C_TAILLEHAUT_THUMB',"150"); //hauteur du thumb souhaitée

define ('C_COPY',false); //texte en copyright false si pas de texte
