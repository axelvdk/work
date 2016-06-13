<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


echo'<div style="text-align:center;">';
echo'<h1 style="text-align:center;">';

echo $lang_porto_titre[$lang];

echo'</h1>';

echo'<p><h2 id="csl">';
echo $lang_porto_realisation[$lang];
echo'</h2></p>';
echo'<div style="width:740px;margin:0 auto 30px auto">';
include'./scripts/easygallery/easygallery.php';
echo'</div>';

//commentaires client
echo'<div >';
echo'<marquee scrollamount="2" direction="up" style="border:1px solid white;margin:0 0 30px 32px;" height="110px" width="700px">';
echo'<center><font color="white" size="+1"><b>';

echo $lang_porto_critique1[$lang];
echo'<br><br><br>';

echo $lang_porto_critique2[$lang];
echo'<br><br><br>';

echo $lang_porto_critique3[$lang];
echo'<br><br><br>';

echo $lang_porto_critique4[$lang];
echo'<br><br><br>';

echo $lang_porto_critique5[$lang];
echo'<br><br><br>';

echo $lang_porto_critique6[$lang];
echo'<br><br><br>';

echo $lang_porto_critique7[$lang];
echo'<br><br><br>';

echo $lang_porto_critique8[$lang];
echo'<br><br><br>';

echo $lang_porto_critique9[$lang];

echo'</b></font></center>';
echo'</marquee>';


echo'</div>';
//// /coment client

echo'<p><h2 id="csl">' . $lang_porto_onenparle[$lang] . '</h2>';

echo'<ul id="home_niv1" style="list-style-type:none;padding-left:100px">';

echo'<li style="margin: 5px 0 5px 0">';
echo'<a href="./fichier/bizz.pdf" target="_blank">';
echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
echo $lang_porto_parle1[$lang];
echo'</a>';
echo'</li>';

echo'<li style="margin: 5px 0 5px 0">';
echo'<a href="./fichier/tribunebxl.pdf" target="_blank">';
echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
echo $lang_porto_parle2[$lang];
echo'</a>';
echo'</li>';

echo'<li style="margin: 5px 0 5px 0">';
echo'<a href="./fichier/dh.pdf" target="_blank">';
echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
echo $lang_porto_parle3[$lang];
echo'</a>';
echo'</li>';

echo'<li style="margin: 5px 0 5px 0">';
echo'<a href="./fichier/eventail.pdf" target="_blank">';
echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
echo $lang_porto_parle4[$lang];
echo'</a>';
echo'</li>';

echo'<li style="margin: 5px 0 5px 0">';
echo'<a href="./fichier/evenement.pdf" target="_blank">';
echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
echo $lang_porto_parle5[$lang];
echo'</a>';
echo'</li>';

echo'<li style="margin: 5px 0 5px 0">';
echo'<a href="./fichier/elledeco.pdf" target="_blank">';
echo'<img style="vertical-align:top;margin-right:10px;" src="./img/ext_fichier/mini2_pdf_icon.png">';
echo $lang_porto_parle6[$lang];
echo'</a>';
echo'</li>';

echo'</ul>';

echo'</p>';
echo'</div>';