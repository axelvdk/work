<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<div style="text-align:center;">';
    echo'<h1 style="text-align:center;">';

    echo $lang_conseil_titre[$lang];
    
    echo'</h1>';
    
    echo'<p><h2 id="csl">';
    echo $lang_conseil_cklists[$lang];
    echo'</h2></p>';
    
    echo'<p>';
    echo $lang_conseil_cklists2[$lang];
    echo'</p>';
        echo'<ul id="home_niv1"  style="list-style-type:none;padding-left:100px">';
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/an_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_anniv[$lang];
        echo'</a>';
        echo'</li>';
        
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/ba_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_bapt[$lang];
        echo'</a>';
        echo'</li>';
        
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/co_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_comm[$lang];
        echo'</a>';
        echo'</li>';
        echo'<li>';
        
         echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/conf_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_conf[$lang];
        echo'</a>';
        echo'</li>';
       
        
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/def_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_def[$lang];
        echo'</a>';
        echo'</li>';
       
        
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/mar_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_mar[$lang];
        echo'</a>';
        echo'</li>';
        
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/inaug_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_inaug[$lang];
        echo'</a>';
        echo'</li>';
 
        
        echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/mar_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_ckl_mar[$lang];
        echo'</a>';
        echo'</li>';

      
        echo'</ul>';
        /*echo $lang_conseil_txt10[$lang];
        echo'</li><li>';
        echo $lang_conseil_txt11[$lang];
      */
 

        echo'<p ><h2 id="csl">'.$lang_conseil_misenplace[$lang].'</h2>';
        echo'<p style="margin:8px auto 0 auto;width:310px">'.$lang_conseil_misenplace2[$lang].'</p></p>';
        
          echo'<ul id="home_niv1" style="list-style-type:none;padding-left:100px">'; 
           echo'<li style="margin: 5px 0 5px 0">'; 
        echo'<a href="./fichier/mar_'.$lang.'.pdf" target="_blank">';
        echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
        echo $lang_conseil_sav_fair[$lang];
        echo'</a>';
        echo'</li>';
       
        echo'</ul>';
echo'</p>';
echo'</div>';