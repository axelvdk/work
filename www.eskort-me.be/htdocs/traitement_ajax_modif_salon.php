<?php
if(!isset($_SESSION)) session_start();
require_once('managers/salonManager.php');
$salonManager = new SalonManager();
$filleBySalon = $salonManager->selectFilleBySalon($_SESSION['salon']);
$dataSalon = $salonManager->selectSalonById($_SESSION['id_salon']);
 
if(isset($_POST['action']))
{
    if($_POST['action']=='delete')
    {
        if( file_exists($_SERVER['DOCUMENT_ROOT'].$_POST['chemin_photo'])) {            
            echo json_encode(unlink($_SERVER['DOCUMENT_ROOT'].$_POST['chemin_photo']));
        }
        else
        {
            echo $_SERVER['DOCUMENT_ROOT'].$_POST['chemin_photo'];
        }
    }
}

if(isset($_POST['action']))
{
	if($_POST['action']=='modification_salon')
	{
		if(isset($_POST['description_fr']))
		{
			if(isset($_POST['photo']))
			{
				for($i=0;$i<count($_POST['photo']);$i++) {
					switch ($_POST['photo'][$i]) {
						case 'photo1' :
							uploadPhoto($_POST['photo'][$i]);
							break;
						case 'photo2' :
							uploadPhoto($_POST['photo'][$i]);
							break;
						case 'photo3' :
							uploadPhoto($_POST['photo'][$i]);
							break;
						case 'photo4' :
							uploadPhoto($_POST['photo'][$i]);
							break;
						case 'photo5' :
							uploadPhoto($_POST['photo'][$i]);
							break;
						case 'photo6' :
							uploadPhoto($_POST['photo'][$i]);
							break;
					}
				}
			}	
			if($salonManager->updateSalonDescriptionFr($_POST['description_fr'],$_POST['tel'],$_SESSION['id_salon']))
			{
				header('Location: http://www.eskort-me.be/modif-salon.php');
			}
		}
	}
}


/**
 * Image resize
 * @param int $width
 * @param int $height
 */
function resize($width, $height,$numero){
    /* Get original image x y*/
    list($w, $h) = getimagesize($_FILES['image'.$numero]['tmp_name']);
    /* calculate new image size with ratio */
    $ratio = max($width/$w, $height/$h);
    $h = ceil($height / $ratio);
    $x = ($w - $width / $ratio) / 2;
    $w = ceil($width / $ratio);
    /* new file name */
    if(isset($_POST['action']))
    {
        if($_POST['action']=="inscription_salon") {
            if(!file_exists("photos_salon/".$_SESSION['id_salon']. wd_remove_accents($_SESSION['salon']))) {
                mkdir("photos_salon/" . $_SESSION['id_salon'] . wd_remove_accents($_SESSION['salon']));
            }
            $path = "photos_salon/". $_SESSION['id_salon'].wd_remove_accents($_SESSION['salon'])."/".$_SESSION['id_salon'].wd_remove_accents($_SESSION['salon']).$numero.'.png';
        }
        if($_POST['action']=="modification_salon")
        {
            if(!file_exists("photos_salon/".$_SESSION['id_salon']. wd_remove_accents($_SESSION['salon']))) {
                mkdir("photos_salon/" . $_SESSION['id_salon'] . wd_remove_accents($_SESSION['salon']));
            }
            $path = "photos_salon/". $_SESSION['id_salon'].wd_remove_accents($_SESSION['salon'])."/".$_SESSION['id_salon'].wd_remove_accents($_SESSION['salon']).$numero.'.png';
        }
		
    }

    /* read binary data from image file */
    $imgString = file_get_contents($_FILES['image'.$numero]['tmp_name']);
    /* create image from string */
    $image = imagecreatefromstring($imgString);
    $tmp = imagecreatetruecolor($width, $height);
    imagecopyresampled($tmp, $image,
        0, 0,
        $x, 0,
        $width, $height,
        $w, $h);
    /* Save image */
    switch ($_FILES['image'.$numero]['type']) {
        case 'image/jpeg':
            imagejpeg($tmp, $path, 100);
            break;
        case 'image/png':
            imagepng($tmp, $path, 0);
            break;
        case 'image/gif':
            imagegif($tmp, $path);
            break;
        default:
            exit;
            break;
    }
    return $path;
    /* cleanup memory */
    imagedestroy($image);
    imagedestroy($tmp);
}
function uploadPhoto($num)
{
   // settings
    $numero = " ";
    switch($num)
    {
        case "photo1" : $numero = "1"; break;
        case "photo2" : $numero = "2"; break;
        case "photo3" : $numero = "3"; break;
        case "photo4" : $numero = "4"; break;
        case "photo5" : $numero = "5"; break;
        case "photo6" : $numero = "6"; break;
    }

   // $_FILES['image'.$numero]['name']=$_SESSION['id_salon'].$_SESSION['salon'].$numero;
    
    if(isset($_POST['action']))
    {
        if($_POST['action']=="inscription_salon") {
            $file_name = $_SESSION['id_salon'] . $_SESSION['salon'] . $numero;
        }
        if($_POST['action']=="modification_salon")
        {
            $file_name = $_SESSION['id_salon'] . $_SESSION['salon'] . $numero;
        }
    }
   // $file_name = $_SESSION['id_salon'].$_SESSION['salon'].$numero;
    $max_file_size = 2000*2000; // 200kb
    $valid_exts = array('jpeg', 'jpg', 'png','gif');
    // thumbnail sizes
    //$sizes = array(100 => 100, 150 => 150, 250 => 250);
    //print_r($_FILES['image'.$numero]['name']);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'.$numero])) {
        if( $_FILES['image'.$numero]['size'] < $max_file_size ){
            // get file extension
            $ext = strtolower(pathinfo($_FILES['image'.$numero]['name'], PATHINFO_EXTENSION));
            $salon = wd_remove_accents($_SESSION['salon']);
            if(isset($_POST['inscription']))
            {
                if($_POST['action']=="inscription_salon") {
                    $_FILES['image'.$numero]['name']=$_SESSION['id_salon'].$salon.$numero.'.png';
                }
                if($_POST['action']=="modification_salon")
                {
                    $_FILES['image'.$numero]['name']=$_SESSION['id_salon'].$salon.$numero.'.png';
                }
            }


            if (in_array($ext, $valid_exts)) {
                /* resize image */
                //foreach ($sizes as $w => $h) {
					if($numero==1)
						$files[] = resize(270, 390,$numero);
					else
						$files[] = resize(100, 100,$numero);
                //}
            } else {
                $msg = 'Unsupported file';
            }
        } else{
            $msg = 'Please upload image smaller than 200KB';
        }
    }
}
function wd_remove_accents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}
?>
	
