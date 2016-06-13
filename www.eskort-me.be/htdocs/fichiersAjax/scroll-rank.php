<?php
require_once('../managers/filleManager.php');
require_once($_SERVER['DOCUMENT_ROOT']."/creationDescriptionFille.php");

$filles = new FilleManager();
if(isset($_POST['action'])&&($_POST['action']=="rank"))
{
	$data = $filles->selectRank($_POST['nb'],isset($_POST['page']) ? intVal($_POST['page']) : 1);
}



for($i = 0; $i < count($data);  $i++){
	
	if(!file_exists($_SERVER['DOCUMENT_ROOT']."/escorte-massage-bruxelles-".$data[$i]['nom'].".php")){
		
		//$description = new CreationDescriptionFille($data[$i]['id_fille'],$data[$i]['nom']);
        //$data[$i]['link'] = $description->getPage_php_body()."?id_fille=".$data[$i]['id_fille'];
        
        /* A la main ? */
        $ctn = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/description.php');
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/escorte-massage-bruxelles-'.$data[$i]['nom'].'.php',$ctn);
        
        $data[$i]['link'] = 'escorte-massage-bruxelles-'.$data[$i]['nom'].'.php?id_fille='.$data[$i]['id_fille'];
        
	}
	else{
		$data[$i]['link'] = 'escorte-massage-tantrique-bruxelles-'.$data[$i]['nom'].'-'.$data[$i]['id_fille'];
	}
}


echo json_encode($data);