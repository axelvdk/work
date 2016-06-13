
<?php

echo'<h1>' . $lang_video[$lang] . '</h1>';


$lien_video = $element->getLien_video();
$nom_video = $element->getNom_video();




if (isset($lien_video)) {
    $i = 0;
  echo'<ul class="gallery clearfix">';
    foreach ($lien_video as $value) {

        //on prend le nom du fichier sans extension
      
        $info = pathinfo('./video/' . $value);
        $file_name = basename('./video/' . $value, '.' . $info['extension']);


        //on verifie que les films en format ogv/mp4/webm sont existant
//si non, on les crées

        if (!file_exists('./video/tmp/' . $file_name . '.mp4') OR !file_exists('./video/tmp/' . $file_name . '.ogv') OR !file_exists('./video/tmp/' . $file_name . '.webm')) {
            echo'<li><img src="./img/ext_fichier/mini_film.png">' . $nom_video[$i] . ' ' . $lang_video_nondispo[$lang] . '</li>';

            // ______________CREATION DES FILMS_____________________


            system('ffmpeg -i ./video/' . $value . ' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libvorbis -r 29.97 -b 768k  -ab 64k -s 640x480 ./video/tmp/' . $file_name . '.ogv >> /dev/null&');
            system('ffmpeg -i ./video/' . $value . ' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libvorbis -ac 2 -ab 96k  -b 345k -s 640x480 ./video/tmp/' . $file_name . '.webm >> /dev/null&');
            system('ffmpeg -i ./video/' . $value . ' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libfaac -ab 96k -vcodec libx264 -level 21 -refs 2 -b 345k -bt 345k -threads 0 -s 640x480 ./video/tmp/' . $file_name . '.mp4 >> /dev/null&');

            // system('ffmpeg -i ./video/' . $value . ' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libvorbis -r 29.97 -b 768k -ar 24000 -ab 64k -s 640x480 ./video/tmp/' . $file_name . '.ogv >> /dev/null&');
            //  system('ffmpeg -i ./video/' . $value . ' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libvorbis -ac 2 -ab 96k -ar 44100   -b 345k -s 640x480 ./video/tmp/' . $file_name . '.webm >> /dev/null&');
            //  system('ffmpeg -i ./video/' . $value . ' -vf "movie=./video/watermark640x480.png [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" -acodec libfaac -ab 96k -vcodec libx264 -level 21 -refs 2 -b 345k -bt 345k -threads 0 -s 640x480 ./video/tmp/' . $file_name . '.mp4 >> /dev/null&');
        } else {
            echo'<li><img src="./img/ext_fichier/mini_film.png">' . $nom_video[$i];

            echo'<div>';

            $info = pathinfo('./video/' . $value);
            $file_name = basename('./video/' . $value, '.' . $info['extension']);

            //si oui, on active la balise video
            echo'<video width="480" height="360" controls autobuffer style="margin:auto;">';
            echo'<source src="video/tmp/' . $file_name . '.mp4" type="video/mp4" />';
            echo'<source src="video/tmp/' . $file_name . '.webm" type="video/webm" />';
            echo'<source src="video/tmp/' . $file_name . '.ogv" type="video/ogg" />';

            echo'<script type="text/javascript" src="./scripts/jwplayer/jwplayer.js"></script>';
            echo'<div id="container">Loading the player ...</div>
<script type="text/javascript">
jwplayer("container").setup({
flashplayer: "./scripts/jwplayer/player.swf",
file: "video/tmp/' . $file_name . '.mp4",
height: 360,
width: 480
});
</script>';

            /* <object width="320" height="240" type="application/x-shockwave-flash" data="__FLASH__.SWF">
              <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
              <param name="movie" value="__FLASH__.SWF" />
              <param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
              <!-- fallback image. note the title field below, put the title of the video there -->
              <img src="__VIDEO__.JPG" width="640" height="360" alt="__TITLE__"
              title="No video playback capabilities, please download the video below" />
              </object>
             */

         //   echo'<p>' . $lang_video_html5nd1[$lang] . '</p>';

         //   echo'<p>' . $lang_video_html5nd2[$lang] . '</p>';

         //   echo'<p><a href="video/tmp/' . $file_name . '.mp4">' . $file_name . '.mp4</a></p>';
         //   
         echo'</video>';



            echo'</div></li>';
        }

        $i++;
    }

    echo'</ul>';
    echo'<div class="clear"></div>';
    $i = 0;
    foreach ($lien_video as $value) {





        $i++;
    }
} else {//si pas de video liés au produit
    echo'<p>' . $lang_video_nonexist[$lang] . '</p>';
}

?>
