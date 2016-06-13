<?php

/*
 * 10/12/2010 rajout du log pour les clients
 * 27/01/2011 remplacement eregi_replace en  preg_replace l:42
 * 28/01/2011 rajout des underscor
 */

/**
 * Description of Utilitaires
 
 * pc_jointe doit etre un tableau comme suit:
 *$pc_jointe['chemin'] = './test.xml';
 *$pc_jointe['type'] = 'xml';
 *$pc_jointe['nom'] = 'fichier.xml';
 
 * 
 * * @author C?dric
 */
class Maileur {

  
    static function envoimail($lang, $sujet, $texte, $email_dest, $pc_jointe=NULL, $email_exp=NULL) {
        //inclusion des donnees de bdd avec un chemin portable
        
         include realpath(dirname(__FILE__) . '/../config/config_commande.php');   
        
        if(!is_null($email_exp)){$expediteur=$email_exp;$site_name=$email_exp;}


// on génère un identifiant aléatoire pour le fichier
        $file_id = md5(uniqid(rand())) . $_SERVER['SERVER_NAME'];
        $file_id2 = md5(uniqid(rand())) . $_SERVER['SERVER_NAME'];
// on va maintenant lire le fichier logo et l'encoder
       /* $path = $logo_email; // chemin vers le fichier   'images/colis.jpg';
        $fp = fopen($path, 'rb');
        $content = fread($fp, filesize($path));
        fclose($fp);
        $content_encode = chunk_split(base64_encode($content));*/

        $texte_html = '<html><head></head><body><table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>

';


//creation du texte en html, rajout des diverses balises et images.

        $texte_html .="<td width=\"1\">
<img src=\"cid:$file_id\" alt=\"\"  >
</td>
        </tr>
      </table>";


// texte mail
        $texte_html .=$texte;


        $texte_html .='</font>';

        $texte_html .="
      </p></td>
  </tr>
</table></body></html>
";


//on converti la base en text brut 
//    $texte_plain  = str_replace('<br>', '"\n"', $texte); //remplacement de <br> et <br> en /n
//  $texte_plain  = str_replace('<br />', '"\n"', $texte_plain);
        $texte_plain = strip_tags($texte);
//$texte_plain .= "votre texte plain\n";
//  $texte_plain .= "a ecrire ici plain\n";



        $entetes = "From: " . $site_name . " <" . $expediteur . ">\n";
        $entetes .= "BCC: " . $mail_bcc . "\n";
        $entetes .= "Mime-Version: 1.0\n";
//$entetes .="Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $mime_boundary = "----" . $site . "----" . md5(mt_rand(1, 999) . time());
        $entetes .= "Content-Type: multipart/related; boundary=\"$mime_boundary\"\n";
        $entetes .= "X-Sender: <www." . $site_name . ">\n";
        $entetes .= "X-Mailer: PHP/" . phpversion() . " \n";
        $entetes .= "X-Priority: 3 (normal) \n";
        $entetes .= "X-auth-smtp-user: " . $expediteur . "\n";
        $entetes .= "X-abuse-contact: " . $expediteur . "\n";
        $entetes .= "Importance: Normal\n";
        $entetes .= "Reply-to: " . $expediteur . "\n";


//header general
        $mess = "--$mime_boundary\n";

        $mess .= "Content-Type: multipart/alternative; charset=ISO-8859-1;\n";
        $mime_boundary_2 = "----" . $site_name . "----" . md5(mt_rand(1, 999) . time());

        $mess .=" boundary=\"$mime_boundary_2\"\n";
        $mess .= "Content-Transfer-Encoding: 8bit\n\n";

        $mess .= "--$mime_boundary_2\n";

// header texte plain

        $mess .= "Content-Type: text/plain; charset=ISO-8859-1\n";
        $mess .= "Content-Transfer-Encoding: 8bit\n\n";
        $mess .= $texte_plain;
        $mess .="\n";
        $mess .= "--$mime_boundary_2\n";
// header texte en html


        $mess .= "Content-Type: text/html; charset=ISO-8859-1\n";
        $mess .= "Content-Transfer-Encoding: 8bit\n\n";
        $mess .= $texte_html;

        $mess .= "--" . $mime_boundary_2 . "--\n";


// header image




        $mess .= "\n\n";

        $mess .= "--" . $mime_boundary . "\n";



        $mess .= "Content-Type: image/jpg; name=\"logo\"\n";
        $mess .= "Content-Transfer-Encoding: base64\n";
        $mess .= "Content-ID: <$file_id>\n\n";
        $mess .= $content_encode . "\n";
        $mess .= "\n\n";




//piece jointe
     

        if (!is_null($pc_jointe) AND is_array($pc_jointe)) {

            $pc_jointe_type=$pc_jointe['type'];
            $pc_jointe_nom=$pc_jointe['nom'];
            $pc_jointe_chemin=realpath(dirname(__FILE__) . '/../'.$pc_jointe['chemin']);
           /* $fp = fopen($pc_jointe_chemin, "rb");*/
            //$fichierattache = fread($fp, filesize($pc_jointe_chemin));
            //fclose($fp);
            //$fichierattache = chunk_split(base64_encode($fichierattache));
            $mess .= "--" . $mime_boundary . "\n";
            $mess .= "Content-Type: application/$pc_jointe_type; name=\"$pc_jointe_nom\"\n";
            $mess .= "Content-Transfer-Encoding: base64\n";
            $mess .= "Content-Disposition: attachment; filename=\"$pc_jointe_nom\"\n";
            $mess .= "Content-ID: <$file_id2>\n\n";
            $mess .= $fichierattache . "\n";
            $mess .= "\n\n";
        }


        $mess .= "--" . $mime_boundary . "--\n";


        mail($email_dest, $sujet, $mess, $entetes);
    }

}

?>
