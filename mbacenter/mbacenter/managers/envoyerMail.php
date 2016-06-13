<?php
require 'http://localhost/mbacenter/managers/PHPMailer-master/class.phpmailer.php';
require 'http://localhost/mbacenter/managers/PHPMailer-master/class.smtp.php';
class EnvoyerMail{

private $_Id_employe;
private $_mail;
private $_nom;
private $_prenom;
private $_message_type;


public function __construct(array $donnees)
{
	$this->hydrate($donnees);
}
public function hydrate(array $donnees)
{
	foreach ($donnees as $key => $value)
	{
		// On récupère le nom du setter correspondant à l'attribut.
		$method = 'set'.ucfirst($key);
		 
		// Si le setter correspondant existe.
		if (method_exists($this, $method))
		{
		// On re?cupe?re le nom du setter correspondant a? l'attribut.
			$this->$method($value);
		}
	}
}
//getters
public function getId_employe()
{
	return $this->_Id_musicien;
}

public function getMessage_type()
{
	return $this->_message_type;
}
public function getMail()
{
	return $this->_mail;
}
public function getNom()
{
	return $this->_nom;
}	

//setters

public function setId_employe($id_employe)
{
	$this->_id_employe=$id_employe;
}

public function setMail($mail)
{
	$this->_mail=$mail;
}
public function setNom($nom)
{
	$this->_nom=$nom;
}
public function setMessage_type($message)
{
	$this->_message_type=$message;
}
public function sendMail()
{

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->SMTPDebug=false;
	$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '';                 // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->From = 'ax_sz@hotmail.com';
	$mail->FromName = 'Mailer';
	$mail->addAddress($this->_mail, $this->_nom);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Activation du compte d\'un nouvel employé';
	$mail->Body    = $this->creerMessage();
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		//echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	   // echo 'Message has been sent';
	}
	$mail->SmtpClose(); 

	unset($mail); 
}

public function creerMessage()
{
	if($this->_message_type=='activation')
	{
		//for($i=0;$i<count($mail);$i++){
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $this->_mail))
			{
				$passage_ligne = "\r\n";
			}
			else
			{
				$passage_ligne = "\n";
			}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_html = "<html><head></head><body>";
		$message_html.= "<!--<table align='center'><tr><td><img 
		src='http://s28.postimg.org/dj94bng5p/dom_final_3.png'/></td></tr></table>-->";
		$message_html.= "<br/><br/><br/>";
		$message_html.= "Bonjour Hubert Silly," <br/><br/>;
		 
		$message_html.= "Un nouvel employé vient de s'inscrire sur votre site, vous devez activer son compte pour
		qu'il puisse se loguer.
		Pour ce faire, vous devez juste activer votre compte 
		en cliquant sur ce lien ci-dessous : <br/><br/>";
		// je fais le passage des paramètres vers la page gestion_client.php, j'ai mis en sha1 l'id du client et mail=blue
		// indique qu'on vient du lien et non d'une connexion, ce qui est utile par rapport à l'activation de certains boutons
		$message_html.= "<a href='http://localhost/mbacenter/register-sign-in.php?=>Lien</a><br/><br/>";

		$message_html.= "Cordialement";
		 
		$message_html.= "</body></html>";
		//==========
		 
		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$sujet = "MBA center europe : Activation du compte du nouvel employé";
		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "From: \"MBA center europe\"<axelsuperstarofthewholeworld@gmail.com>".$passage_ligne;
		$header.= "Reply-to: \"MBA center europe\"<axelsuperstarofthewholeworld@gmail.com>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." 
		boundary=\"$boundary\"".$passage_ligne;

		return $message_html." ".$sujet;
		break; 
	}
}
}
}

?>