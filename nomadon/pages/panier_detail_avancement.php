<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php

//si on est dans panier detail 

if ($_GET['p']==101) {
    
    echo'<img src="./img/avancement_panier_on.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    echo'<img src="./img/avancement_fac_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    echo'<img src="./img/avancement_transp_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    echo'<img src="./img/avancement_pay_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
}

if ($_GET['p']==103) {
    
    echo'<a href="./fr-pg101-' . $site . '.html"><img src="./img/avancement_panier_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'"></a>';
    echo'<img src="./img/avancement_fac_on.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    echo'<img src="./img/avancement_transp_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    echo'<img src="./img/avancement_pay_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
}

if ($_GET['p']==104) {
    
    echo'<a href="./fr-pg101-' . $site . '.html"><img src="./img/avancement_panier_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'"></a>';
    echo'<a href="./fr-pg103-' . $site . '.html"><img src="./img/avancement_fac_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'"></a>';
    echo'<img src="./img/avancement_transp_on.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
    echo'<img src="./img/avancement_pay_off.png" alt="'.$lang_valider[$lang].'" title="'.$lang_valider[$lang].'">';
}