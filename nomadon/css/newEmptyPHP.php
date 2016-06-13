<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
@font-face {
    font-family: 'QuicksandLight';
    src: url('../img/fonts/Quicksand_Light-webfont.eot');
    src: url('../img/fonts/Quicksand_Light-webfont.eot?#iefix') format('embedded-opentype'),
        url('../img/fonts/Quicksand_Light-webfont.woff') format('woff'),
        url('../img/fonts/Quicksand_Light-webfont.ttf') format('truetype'),
        url('../img/fonts/Quicksand_Light-webfont.svg#QuicksandLight') format('svg');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'QuicksandLightOblique';
    src: url('../img/fonts/Quicksand_Light_Oblique-webfont.eot');
    src: url('../img/fonts/Quicksand_Light_Oblique-webfont.eot?#iefix') format('embedded-opentype'),
        url('../img/fonts/Quicksand_Light_Oblique-webfont.woff') format('woff'),
        url('../img/fonts/Quicksand_Light_Oblique-webfont.ttf') format('truetype'),
        url('../img/fonts/Quicksand_Light_Oblique-webfont.svg#QuicksandLightOblique') format('svg');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'QuicksandBook';
    src: url('../img/fonts/Quicksand_Book-webfont.eot');
    src: url('../img/fonts/Quicksand_Book-webfont.eot?#iefix') format('embedded-opentype'),
        url('../img/fonts/Quicksand_Book-webfont.woff') format('woff'),
        url('../img/fonts/Quicksand_Book-webfont.ttf') format('truetype'),
        url('../img/fonts/Quicksand_Book-webfont.svg#QuicksandBook') format('svg');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'QuicksandBookOblique';
    src: url('../img/fonts/Quicksand_Book_Oblique-webfont.eot');
    src: url('../img/fonts/Quicksand_Book_Oblique-webfont.eot?#iefix') format('embedded-opentype'),
        url('../img/fonts/Quicksand_Book_Oblique-webfont.woff') format('woff'),
        url('../img/fonts/Quicksand_Book_Oblique-webfont.ttf') format('truetype'),
        url('../img/fonts/Quicksand_Book_Oblique-webfont.svg#QuicksandBookOblique') format('svg');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'QuicksandBold';
    src: url('../img/fonts/Quicksand_Bold-webfont.eot');
    src: url('../img/fonts/Quicksand_Bold-webfont.eot?#iefix') format('embedded-opentype'),
        url('../img/fonts/Quicksand_Bold-webfont.woff') format('woff'),
        url('../img/fonts/Quicksand_Bold-webfont.ttf') format('truetype'),
        url('../img/fonts/Quicksand_Bold-webfont.svg#QuicksandBold') format('svg');
    font-weight: normal;
    font-style: normal;

}

html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, blockquote, pre, a, abbr, acronym, address, code, del, dfn, em, img, q, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, .search_box p
{
    margin:0;
    padding:0;
    border:0;
    font-weight:inherit;
    font-style:inherit;
    font-size:100%;
    font-family:inherit;
    vertical-align:baseline;

}

body{

    font-family: 'QuicksandBold',Verdana,Arial,sans-serif;
    color:#736b6a;
    font-weight: normal;
    min-width: 1000px;
    width: 95%;
    margin: 15px auto 15px auto;
    background-image:url('../img/back.png');
    background-repeat: repeat-x;
    

}
img 
{
    border:none;
}

a{
    text-decoration: none;
    color:#736b6a;
}

a:hover{
    text-decoration: none;
}

.clear{clear:both;}


h1 {

}


/*******************************************************************************/
/* LOGO */
/*******************************************************************************/

#logo{

    float: left;

}
/*******************************************************************************/
/* MENU 1 */
/*******************************************************************************/
.kwicks {  

    position:  absolute;
    margin: 35px 0 0 0;
    margin-left : 50%;
    left : -300px;
    width:600px

}

@media all and (max-width:1050px){
    .kwicks {
        left: 0;
        margin: 35px 0 0 225px;
    } 
}

.kwicks li{  
    font-size: x-large;

    background-color: #012f63;
    cursor: pointer;  
    float: left;
    list-style-type: none;
    height: 50px;
    width:140px;
    margin:5px;
    padding-top: 5px;

    text-align: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    border-radius: 5px;
}

.kwicks a{
    display: block;
    width: 100%;
    height: 100%;        
    color: white;
}

.kwicks a:hover{
    color: rgb(85, 80, 79);
}
/*

.kwicks {  
  
    
    background-image:url(../img/menu1/no_flicker.jpg);
    left : -350px;
    margin: 65px 0 0 0;
    margin-left : 50%;

}


@media all and (max-width:1050px){
   .kwicks {
       left: 0;
    margin: 65px 0 0 15%;
} 
}


.kwicks li{  
    display: block;  
    overflow: hidden;  
    padding: 0;  
    cursor: pointer;  
    float: left;
    width: 100px;
    height: 40px;
    margin-right: 0px;
    background-image:url(../img/menu1/kwicks_sprite.png);
    background-repeat:no-repeat;
}
.kwicks a{
    display:block;
    height:40px;
    text-indent:-9999px;
    outline:none;
}

#kwick1 {
    background-position:0px 0px;
}
#kwick2 {
    background-position:-162px 0px;
}
#kwick3 {
    background-position:-324px 0px;
}
#kwick4 { 
    background-position:-486px 0px;
}
#kwick5 { 
    background-position:-648px 0px;
}
#kwick6 { 
    background-position:-810px 0px;
}
#kwick7 { 
    background-position:-972px 0px;
}

#kwick1.active, #kwick1:hover { 
    background-position: 0 bottom;
}
#kwick2.active, #kwick2:hover{
    background-position: -162px bottom;
}
#kwick3.active, #kwick3:hover {
    background-position: -324px bottom;
}
#kwick4.active, #kwick4:hover {
    background-position: -486px bottom; 
}

#kwick5.active, #kwick5:hover {
    background-position: -648px bottom; 
}
#kwick6.active, #kwick6:hover {
    background-position: -810px bottom; 
}
#kwick7.active, #kwick7:hover {
    background-position: -972px bottom; 
}

#kwick1 a{
    background-image:url(../img/menu1/end.png);
    background-repeat:no-repeat;
    background-position: left 0px;
}

#kwick1 a:hover{
    background-position: left -80px;
}

#kwick7 a{
    background-image:url(../img/menu1/end.png);
    background-repeat:no-repeat;
    background-position: right -40px;
}
#kwick7 a:hover{
    background-position: right -120px;
}
*/
/*******************************************************************************/
/* MENU 2 */
/*******************************************************************************/

#menu2{

    margin:10px 0 0 0;
    padding:0;   
    text-align: center;
    font-size: 1em;
    background-color: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    border-radius: 5px;

}
#menu2 a{
    color: #55504f;
    cursor: help;
}

#menu2 a:hover{
    color:black;
    text-decoration: underline;
}
/*******************************************************************************/
/* MENU GAUCHE */
/*******************************************************************************/


#menu_g{
    float: left;
    padding: 0px;
    margin:10px 1% 0 0;
    width:19%;
    min-height:300px;
    background-color: #ffffff;
    /*box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    border-radius: 5px;*/
}


ul.tree, ul.tree ul{ 
    list-style-type:none; 
}

ul.tree li{
    padding-left:1.2em;
    border-left:1px gray dotted;
    background:url(../img/menu_g/sitemap-horizontal.gif) no-repeat left 10px;
    margin-left:1em;
}

ul.tree a{
    padding-left:0.2em; 
}

ul.tree a.selected{ 
    font-weight:bold; 
}
/*
ul.tree li.last{
    background:url(../img/menu_g/sitemap-last.gif) no-repeat -12px -2px;
    border:none;
}

*/

/*
div.block {
    margin-bottom: 1em;
    width: 191px;
    padding-bottom: 6px;
    background-color: red;
}
*/
/*
div.block h4 {
    text-transform: uppercase;
    font-family: Helvetica, Sans-Serif;
    font-weight: bold;
    font-size: 1.2em;
    padding-left:0.5em;
    border-bottom:1px solid #595A5E;
    padding-top:2px;
    line-height:1.3em;
    color: #374853;
    height: 19px;
    background: transparent url('../img/block_header.gif') no-repeat top left;
}
*/

div.block ul {
    list-style: none; 
}

div.block ul.tree li { 
    padding-left:1.2em;
}

div.block a:hover { 
    text-decoration: underline; 
}
/*
#left_column div.block .block_content a.button_large, #right_column div.block .block_content a.button_large { margin:0 0 0 -3px; }
*/

/*
div.block .block_content {
    border-left: 1px #d0d3d8;
    border-right: 1px #d0d3d8;
    padding:0.5em 0.7em 0pt;
    background: #f1f2f4 url('../img/menu_g/block_bg.jpg') repeat-x bottom left;
    min-height:20px;
}
*/

div.block li {
    padding: 0.2em 0 0.2em 0em;
    list-style-position: outside;
}

/*
div.block a {
    color: #595a5e;
    text-decoration: none;
}
*/

/* Block categories */
div#categories_block_left ul.tree { 
    padding-left:0.5em;
}

div#categories_block_left ul.tree li {
    border:none;
    padding-left:15px;
    background: none;
    margin-left:0;
    font-weight:normal;
    font-size:1em;
    line-height:13px;
    margin-top:2px;
}

div#categories_block_left ul.tree li ul li{
    padding-left:15px;
    background:none;
    font-size:0.9em;
    font-weight:normal;
}

div#categories_block_left ul.tree li ul li ul li{
    padding-left:15px;
    font-size:0.8em;
}

div#categories_block_left ul.tree a{
    padding-left:0;
}

div#categories_block_left ul.tree a:hover{
    text-decoration:underline;
}

div#categories_block_left ul.tree a.selected{
    color: #55504f;
    font-weight: bold;
    text-decoration:underline;
}

div#categories_block_left span.grower{
    display:block;
    float:left;
    background-position: 0px 3px;
    background-repeat: no-repeat;
    width:9px;
    height:15px;
    margin: 0 0 0 -10px!important;
    margin: 0 0 0 -6px;
    padding: 0;
}

div#categories_block_left span.OPEN {
    background-image: url('../img/menu_g/less.gif'); 
}

div#categories_block_left span.CLOSE{
    background-image: url('../img/menu_g/more.gif');
}


/*******************************************************************************/
/* CONTAINER */
/*******************************************************************************/
#containers{
    float: left;
    margin: 0;
    width: 80%;
    min-height:450px;

}

#contenu{
    float: left;
    margin: 10px 0 0 0;
    width: 100%;
    min-height:450px;
    background-color: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    border-radius: 5px;
}

/*******************************************************************************/
/* FOOTER */
/*******************************************************************************/


footer#principal{
    margin-top: 10px;  
    background-color: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    border-radius: 5px;
}
/*******************************************************************************/
/* CHOIX LANGUES*/
/*******************************************************************************/

p.lang {
    font-size: 12px;
    margin:5px 0 0 0;
    float: right;
} 

p.lang img{
    margin-left: 5px;
}
/*
p.lang a{
    color: #d7d3d4;
    padding:0px;
    text-decoration:none;
}

p.lang a:hover {
    color:#ffffff;
    text-decoration:underline;
}
p.lang a.current {
    color:#ffffff;
    text-decoration:underline;
}
*/
/*******************************************************************************/
/* PANNEAU COMPTE */
/*******************************************************************************/

div#compte{
    float:right;
    margin-top: 0px;

}

div#compte a{
    margin: 0;
    padding: 0;
    color:#736b6a;
    font-size: 11px;
}

div#compte p.compte_h{
    margin: 0;
    padding:0 10px 0 10px;
    background-color: #ffffff;

}

div#compte p.compte_m1{
    margin: 0;
    padding:5px 10px 0 10px;
    background-color: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    border-radius: 10px 10px 0 0;
}

div#compte p.compte_m2{
    margin: 0;
    padding:0 10px 0 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    background-color: #ffffff;
}

div#compte p.panier{
    margin: 0;
    padding:0 10px 5px 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    background-color: #ffffff;
    border-radius: 0 0 10px 10px;
}

div#compte p.panier img{
    vertical-align:middle;
    margin-bottom:6px;
}



/*
div#compte p.panier_order{
    float:right;
    width:100px;
    margin: 5px 3px 5px 0px;
}

div#compte p.panier_order span.blocklk {
    float:left;
    width:auto;
    height:22px;
}

div#compte p.panier_order span.blocklk a{
    float:left;
    height:19px;
    padding:3px 5px 0 5px;
    font-size:14px;
    color:#fff;
    font-weight:bold;
    text-align:center;
    background:grey;
}

div#compte p.panier_order span.blocklk span.blocklk_gauche {
    float:left;
    width:2px;
    height:22px;
}

div#compte p.panier_order span.blocklk span.blocklk_droit {
    float:left;
    width:2px;
    height:22px;
}
*/






/***************************************************************************************************************************************/
/*catalogue*/
/***************************************************************************************************************************************/

section#catalogue{
    margin: 0;
    padding: 0;
}
#catalogue article{
    width:25%;
    height:330px;
    overflow: hidden;
    margin: 0 4% 20px 4% ;
    padding: 0;
    float:left;
}
#catalogue header{
    text-align: center;
    margin: 20px 0 20px 0;}
/***************************************************************************************************************************************/
/*panier_detail*/
/***************************************************************************************************************************************/

#searchform{
    margin: 0;
    padding: 0;
}

#searchform input[type=image]{
    vertical-align: middle;
}

input#recherche{
    font-family: 'QuicksandBold',Verdana,Arial,sans-serif;
    font-style: italic;
    color:#736b6a;
    margin:0;
    padding: 0;
    font-size: 10px;
    width: 120px;
}
/*
#search label{
    float: left;
        width: 250px;
        text-align: right;
        font-weight: bold;
        cursor: pointer;
        margin-right: 10px;
        margin-top: .4em;
}*/