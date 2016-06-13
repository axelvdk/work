<?php
if (isset ($_GET['p'])){
    $style='style="width:85%"';
}
echo'<h1>'.$lang_home_tarifs_tva_h1[$lang].'</h1>';
echo'<p class="txt_justify" '.@$style.'><img src="./img/home_tarifs_tva.jpg" class="img_prettypopin" title="' . $lang_home_tarifs_tva_h1[$lang] . '" alt="' . $lang_home_tarifs_tva_h1[$lang] . '"/>'.$lang_home_tarifs_tva_p1[$lang].'</p>';
echo'<p class="txt_justify" '.@$style.'>'.$lang_home_tarifs_tva_p2[$lang].'</p>';
echo'<p class="txt_justify" '.@$style.'>'.$lang_home_tarifs_tva_p3[$lang].'</p>';
echo'<p class="txt_justify" '.@$style.'>'.$lang_home_tarifs_tva_p4[$lang].'</p>';
echo'<p class="txt_justify" '.@$style.'>'.$lang_home_tarifs_tva_p5[$lang].'</p>';
echo'<div class="clear"></div>';


if (isset ($_GET['p'])){//si la page est ouverte via index2.php
echo'<p class="bouton bouton_left"><a href="./public/conditions_generales.pdf" title="">'.$lang_home_tarifs_tva_bouton1[$lang].'</a></p>';
echo'<p class="bouton bouton_left"><a href="' . $lang . '-pg18-' . $site . '.html" title="">'.$lang_home_tarifs_tva_bouton2[$lang].'</a></p>';
echo'<p class="bouton bouton_left"><a href="' . $lang . '-pg1-' . $site . '.html" title="">'.$lang_home_tarifs_tva_bouton3[$lang].'</a></p>';
}
else{
echo'<p class="bouton bouton_left"><a href="./public/conditions_generales.pdf">'.$lang_home_tarifs_tva_bouton1[$lang].'</a></p>';
echo'<p class="bouton bouton_left"><a href="./pages/home_index.php?q=18" rel="internal">'.$lang_home_tarifs_tva_bouton2[$lang].'</a></p>';   
}
echo'<div class="clear"></div>';


?>
