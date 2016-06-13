<?php
if(!isset($_SESSION)) session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/managers/filleManager.php');
if(isset($_POST['action']))
{
	if($_POST['action']=='filemtime')
	{
		echo json_encode(filemtime($_POST['photo']));
	}
	if($_POST['action']=='activer')
	{
		$filleManager= new FilleManager();
		echo json_encode($filleManager->active($_POST['id_fille'],$_POST['activation']));
	}
	if($_POST['action']=='supprimer')
	{
		$filleManager= new FilleManager();
		$nom = $filleManager->getDataFilleById($_POST['id_fille']);
		
		if( file_exists($_SERVER['DOCUMENT_ROOT'].'/photos/'.$_POST['id_fille'].$nom['nom'])) {
			for($i=1;$i<=6;$i++)
			{
				if(file_exists($_SERVER['DOCUMENT_ROOT'].'/photos/'.$_POST['id_fille'].$nom['nom']."/".$_POST['id_fille'].$nom['nom'].$i.'.png'))
				{
					unlink($_SERVER['DOCUMENT_ROOT'].'/photos/'.$_POST['id_fille'].$nom['nom']."/".$_POST['id_fille'].$nom['nom'].$i.'.png');
				}
				if(file_exists($_SERVER['DOCUMENT_ROOT'].'/data0/images/'.$_POST['id_fille'].$nom['nom']."/".$_POST['id_fille'].$nom['nom'].$i.'.png'))
				{
					unlink($_SERVER['DOCUMENT_ROOT'].'/data0/images/'.$_POST['id_fille'].$nom['nom']."/".$_POST['id_fille'].$nom['nom'].$i.'.png');
				}
				if(file_exists($_SERVER['DOCUMENT_ROOT'].'/data0/thumbnails/'.$_POST['id_fille'].$nom['nom']."/".$_POST['id_fille'].$nom['nom'].$i.'.png'))
				{
					unlink($_SERVER['DOCUMENT_ROOT'].'/data0/thumbnails/'.$_POST['id_fille'].$nom['nom']."/".$_POST['id_fille'].$nom['nom'].$i.'.png');
				}
			}
        }
		rmdir($_SERVER['DOCUMENT_ROOT'].'/photos/'.$_POST['id_fille'].$nom['nom']);
		rmdir($_SERVER['DOCUMENT_ROOT'].'/data0/images/'.$_POST['id_fille'].$nom['nom']);
		rmdir($_SERVER['DOCUMENT_ROOT'].'/data0/thumbnails/'.$_POST['id_fille'].$nom['nom']);
		unlink('escort-massage-bruxelles-'.$nom['nom'].'.php');
		echo json_encode($filleManager->supprimer($_POST['id_fille']));
	}
}
if(isset($_POST['inscription']))
{
    if($_POST['inscription']=='inscription_fille')
    {
        $filleManager = new FilleManager();
        $fille = $_POST;
		if($filleManager->add($fille)) $ajout = true; else $ajout=false;
		
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
		if($ajout) 
          header('Location: http://www.eskort-me.be/dataFille.php?id_f='.$_SESSION['last_id_fille']);
    }
    if($_POST['inscription']=='modification_fille')
    {
        $filleManager = new FilleManager();
        $fille = $_POST;

        if($filleManager->update($fille))
        {
            if(isset($_POST['photo']))
            {
                for($i=0;$i<count($_POST['photo']);$i++){
                    switch ($_POST['photo'][$i]){
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
            header('Location: http://www.eskort-me.be/dataFille.php?id_f='.$_POST['id_fille_modif']);
        }
        else
        {
            echo "pas ok";
        }
		
    }
}
if(isset($_POST['action']))
{
    if($_POST['action']=='delete')
    {
        if( file_exists($_SERVER['DOCUMENT_ROOT'].$_POST['chemin_photo'])) {
           // echo "existe";
		    unlink($_SERVER['DOCUMENT_ROOT'].$_POST['chemin_images']);
		    unlink($_SERVER['DOCUMENT_ROOT'].$_POST['chemin_thumb']);
            echo json_encode(unlink($_SERVER['DOCUMENT_ROOT'].$_POST['chemin_photo']));
        }
        else
        {
            echo $_SERVER['DOCUMENT_ROOT'].$_POST['chemin_photo'];
            //echo " existe pas";
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
    if(isset($_POST['inscription']))
    {
		
        if($_POST['inscription']=="inscription_fille") {
            if(!file_exists("photos/".$_SESSION['last_id_fille']. wd_remove_accents($_POST['pseudo']))) {
                mkdir("photos/" . $_SESSION['last_id_fille'] . wd_remove_accents($_POST['pseudo']));
            }
            $path = "photos/". $_SESSION['last_id_fille'].wd_remove_accents($_POST['pseudo'])."/".$_SESSION['last_id_fille'].wd_remove_accents($_POST['pseudo']).$numero.'.png';
			
			if(!file_exists("data0/images/".$_SESSION['last_id_fille']. wd_remove_accents($_POST['pseudo']))) {
                mkdir("data0/images/".$_SESSION['last_id_fille'] . wd_remove_accents($_POST['pseudo']));
            }
			$path_data_zero = "data0/images/" . $_SESSION['last_id_fille'] . wd_remove_accents($_POST['pseudo'])."/".$_SESSION['last_id_fille'].wd_remove_accents($_POST['pseudo']).$numero.'.png';  
			
			if(!file_exists("data0/thumbnails/".$_SESSION['last_id_fille']. wd_remove_accents($_POST['pseudo']))) {
                mkdir("data0/thumbnails/".$_SESSION['last_id_fille'] . wd_remove_accents($_POST['pseudo']));
            }
			$path_data_zero_thumb = "data0/thumbnails/" . $_SESSION['last_id_fille'] . wd_remove_accents($_POST['pseudo'])."/".$_SESSION['last_id_fille'].wd_remove_accents($_POST['pseudo']).$numero.'.png';  
        
		}
        if($_POST['inscription']=="modification_fille")
        {
            if(!file_exists("photos/".$_POST['id_fille_modif']. wd_remove_accents($_POST['pseudo']))) {
                mkdir("photos/" . $_POST['id_fille_modif'] . wd_remove_accents($_POST['pseudo']));
            }	
			
            $path = "photos/". $_POST['id_fille_modif'].wd_remove_accents($_POST['pseudo'])."/".$_POST['id_fille_modif'].wd_remove_accents($_POST['pseudo']).$numero.'.png';
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$path)) unlink($_SERVER['DOCUMENT_ROOT'].$path);
			if(!file_exists("data0/images/".$_POST['id_fille_modif'].wd_remove_accents($_POST['pseudo']))) {
                mkdir("data0/images/".$_POST['id_fille_modif']. wd_remove_accents($_POST['pseudo']));
            }
			
			$path_data_zero = "data0/images/" .$_POST['id_fille_modif']. wd_remove_accents($_POST['pseudo'])."/".$_POST['id_fille_modif'].wd_remove_accents($_POST['pseudo']).$numero.'.png';
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$path_data_zero)) unlink($_SERVER['DOCUMENT_ROOT'].$path_data_zero);
			if(!file_exists("data0/thumbnails/".$_POST['id_fille_modif'].wd_remove_accents($_POST['pseudo']))) {
                mkdir("data0/thumbnails/".$_POST['id_fille_modif']. wd_remove_accents($_POST['pseudo']));
            }
			
			$path_data_zero_thumb = "data0/thumbnails/" .$_POST['id_fille_modif']. wd_remove_accents($_POST['pseudo'])."/".$_POST['id_fille_modif'].wd_remove_accents($_POST['pseudo']).$numero.'.png';
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$path_data_zero_thumb)) unlink($_SERVER['DOCUMENT_ROOT'].$path_data_zero_thumb);
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
			imagejpeg($tmp, $path_data_zero, 100);
			imagejpeg($tmp, $path_data_zero_thumb, 100);
            break;
        case 'image/png':
            imagepng($tmp, $path, 0);
			imagepng($tmp, $path_data_zero, 0);
			imagepng($tmp, $path_data_zero_thumb, 0);
            break;
        case 'image/gif':
            imagegif($tmp, $path);
			imagegif($tmp, $path_data_zero);
			imagegif($tmp, $path_data_zero_thumb);
            break;
        default:
            exit;
            break;
    }
	
    //return $chemin;
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
	
    // $_FILES['image'.$numero]['name']=$_SESSION['last_id_fille'].$_POST['pseudo'].$numero;
    // echo $_FILES['image'.$numero]['name']."  ";
    if(isset($_POST['inscription']))
    {
        if($_POST['inscription']=="inscription_fille") 
		{
            $file_name = $_SESSION['last_id_fille'].$_POST['pseudo'].$numero;
			$_SESSION['file_name_photo']=$file_name;
        }
        if($_POST['inscription']=="modification_fille")
        {
            $file_name = $_POST['id_fille_modif'].$_POST['pseudo'].$numero;
        }
    }
   // $file_name = $_SESSION['last_id_fille'].$_POST['pseudo'].$numero;
    $max_file_size = 2000*2000; // 200kb
    $valid_exts = array('jpeg', 'jpg', 'png','gif');
    // thumbnail sizes
    //$sizes = array(100 => 100, 150 => 150, 250 => 250);
    //print_r($_FILES['image'.$numero]['name']);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'.$numero])) {
        if( $_FILES['image'.$numero]['size'] < $max_file_size ){
            // get file extension
            $ext = strtolower(pathinfo($_FILES['image'.$numero]['name'], PATHINFO_EXTENSION));
            $nom = wd_remove_accents($_POST['pseudo']);
            if(isset($_POST['inscription']))
            {
                if($_POST['inscription']=="inscription_fille"){
                    $_FILES['image'.$numero]['name']=$_SESSION['last_id_fille'].$nom.$numero.'.png';
				   // $_FILES['image'.$numero]['name']=$file_name.'.png';
                }
                if($_POST['inscription']=="modification_fille")
                {
                    $_FILES['image'.$numero]['name']=$_POST['id_fille_modif'].$nom.$numero.'.png';
                }
            }
            if (in_array($ext, $valid_exts)) {
                /* resize image */
                //foreach ($sizes as $w => $h) {
					
                    $files[] = resize(270, 390,$numero);
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
