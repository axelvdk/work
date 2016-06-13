<?php if(isset($_SESSION)) session_start();

    require_once('../managers/filleManager.php');

    if(isset($_POST['action']))
    {
        switch($_POST['action'])
        {
            case 'filtres' : $filleManager = new FilleManager();
                             $criteres = array(
                            'bonnet'=>$_POST['bonnet'],
                            'bonnet_num'=>$_POST['bonnet_num'],
                            'cheveux'=>$_POST['cheveux'],
                            'peau'=>$_POST['peau'],
                            'yeux'=>$_POST['yeux'],
                            'ethnie'=>$_POST['ethnie'],
                            'tailleMin'=>$_POST['tailleMin'],
                            'tailleMax'=>$_POST['tailleMax'],
                            'poidsMin'=>$_POST['poidsMin'],
                            'poidsMax'=>$_POST['poidsMax'],
                            'ageMin'=>$_POST['ageMin'],
                            'ageMax'=>$_POST['ageMax'],
                            'bikini'=>$_POST['bikini'],
                            'tatoo'=>$_POST['tatoo'],
                            'percing'=>$_POST['percing'],
                            'alcohol'=>$_POST['alcohol'],
                            'fumeuse'=>$_POST['fumeuse']);

                echo json_encode($filleManager->selectFilleFiltre($criteres));

                break;
        }
    }



?>