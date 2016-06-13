<?php
if(!isset($_SESSION)) session_start();
class CreationDescriptionFille{

    private $_id_fille;
    private $_nom;
    private $_page_php;

    public function __construct($id_fille,$nom)
    {
        $this->_id_fille = $id_fille;
        $_SESSION['id_fille_description']=$this->_id_fille;
        $this->_nom = $nom;
        $this->_page_php = file_get_contents('description.php');
    }
    public function getPage_php_body()
    {
        $url = urlencode("escorte-massage-bruxelles-".$this->_nom.".php");
        $check = file_put_contents($url,$this->_page_php);
        return $url;
    }

}

?>