<?php
echo'<div style="text-align:center;">';
echo'<h1>'.$lang_titre[$lang].'</h1>'; 
        //<!-- Appel de googme map-->
echo'<iframe width="562" height="314" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.be/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=Chauss%C3%A9e+de+Boondael,+152-154&amp;aq=&amp;sll=50.823207,4.378511&amp;sspn=0.000535,0.00142&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Chauss%C3%A9e+de+Boondael+152,+Ixelles+1050+Ixelles,+Bruxelles&amp;t=h&amp;layer=c&amp;cbll=50.823134,4.378581&amp;panoid=dxyylxNPxwvUeBg2W4Vn5g&amp;cbp=13,32.79,,0,-2.72&amp;ll=50.815168,4.383717&amp;spn=0.017028,0.048237&amp;z=14&amp;output=svembed"></iframe>';
echo'<br />';
echo'<p>';
echo'<a href="http://maps.google.be/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=Chauss%C3%A9e+de+Boondael,+152-154&amp;aq=&amp;sll=50.823207,4.378511&amp;sspn=0.000535,0.00142&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Chauss%C3%A9e+de+Boondael+152,+Ixelles+1050+Ixelles,+Bruxelles&amp;t=h&amp;layer=c&amp;cbll=50.823134,4.378581&amp;panoid=dxyylxNPxwvUeBg2W4Vn5g&amp;cbp=13,32.79,,0,-2.72&amp;ll=50.815168,4.383717&amp;spn=0.017028,0.048237&amp;z=14" id="def">';

echo $lang_plan[$lang].'</a>';
echo'</p>';

      

                echo'<h2 id="contact">'.$lang_contact_ecrit[$lang].'</h2><p style="font-size:18px">';
            echo $lang_contact_ecrit_nom[$lang].'<br>';
            echo $lang_contact_ecrit_adress[$lang].'<br>';
           echo $lang_contact_ecrit_com[$lang].'<br>';
           echo $lang_contact_ecrit_tel[$lang].'<br><br></p>';

echo'<h2 id="contact">'.$lang_contact_email[$lang].'</h2>  ';   

       echo'<div id="contacts">';
       
            echo'<form action="#" method="post" name="form_contact" id="form_contact">';
            
                echo'<fieldset>';
                echo'<input type="hidden" name="envoi" value="1" />';
                
                echo'<p>';
                echo'<label for="nom">Votre nom</label>';
               echo' <input name="nom" id="nom" type="text" value="" />';
                echo'</p>';
                
                echo'<p><label for="email">Votre adresse email</label>';
                echo'<input name="email" id="email" type="text" value="" />';
                echo'</p>';
                
                echo'<p><label for="message">Votre message</label>';
                echo'<textarea name="messages" id="messages" cols="40" rows="10"></textarea>';
          echo'</p>';
   
  echo'<p>';
     echo'<input border="0" type="image" title="'.$lang_valider[$lang].'" alt="'.$lang_valider[$lang].'" name="submit" src="./img/valider.png">';
     
     echo'<input type="reset" value="" title="'.$lang_annuler[$lang].'" alt="'.$lang_annuler[$lang].'"name="cancel" style="background : url(./img/annuler.png);background-repeat: no-repeat; border:none; width:35px; height:35px;">
 ';
 
     echo'</p>';
                echo'</fieldset>';
            echo'</form>';
        echo'</div>';
        echo'</div>';