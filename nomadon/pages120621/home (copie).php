<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    google.load("jquery", "1.3");
</script>

<link rel="stylesheet" href="css/prettyPopin.css" type="text/css" media="screen" charset="utf-8" />
<script src="scripts/jquery.prettyPopin.js" type="text/javascript" charset="utf-8"></script>

<?php
$i=0;
echo'<div id="home">';
    echo'<a href="pages/home_location.php" rel="prettyPopin"><section class="carre" id="bkcolor1"><p>'.$lang_location[$lang].'</p></section></a>';
    
    echo'<section class="carre" id="bkcolor7"></section>';
    $i++;
    echo'<a href="pages/home_formation.php" rel="prettyPopin"><section class="carre" id="bkcolor2"><p>'.$lang_formation[$lang].'</p></section></a>';
    $i++;
    echo'<a href="pages/home_support.php" rel="prettyPopin"><section class="carre" id="bkcolor3"><p>'.$lang_support[$lang].'</p></section></a>';
    $i++;
    echo'<a href="pages/home_pack.php" rel="prettyPopin"><section class="carre" id="bkcolor4"><p>'.$lang_fiches[$lang].'</p></section></a>';
    $i++;
    echo'<a href="pages/form.html" rel="prettyPopin"><section class="carre" id="bkcolor5"><p>'.$lang_grib[$lang].'</p></section></a>';
    
    echo'<section class="carre" id="bkcolor8"></section>';
    $i++;
    echo'<a href="pages/form.html" rel="prettyPopin"><section class="carre" id="bkcolor6"><p>'.$lang_aider[$lang].'</p></section></a>';
echo'</div>';
echo'<script type="text/javascript" charset="utf-8">

    $(document).ready(function(){';

for ($index = 0; $index <= $i; $index++) {
    

        echo'$("a[rel^=\'prettyPopin\']:eq('.$index.')").prettyPopin(
        {
            modal : false, /* true/false */            
            width : 600, /* false/integer */
            height: false, /* false/integer */
            opacity: 0.5, /* value from 0 to 1 */
            animationSpeed: \'fast\', /* slow/medium/fast/integer */
            followScroll: true, /* true/false */
            loader_path: \'images/prettyPopin/loader.gif\'/*, /* path to your loading image */
            /*callback: function(){alert(\'This popin has a callback1\')} /* callback called when closing the popin */});
';
    }
    
    echo'});
</script>';