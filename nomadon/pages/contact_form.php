<?php
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